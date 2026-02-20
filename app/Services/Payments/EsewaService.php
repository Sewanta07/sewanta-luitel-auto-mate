<?php

namespace App\Services\Payments;

use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EsewaService
{
    public function buildPaymentPayload(Payment $payment): array
    {
        $productCode = (string) config('esewa.product_code');
        $secretKey = (string) config('esewa.secret_key');

        if ($productCode === '' || $secretKey === '') {
            throw new \RuntimeException('eSewa payment configuration is incomplete. Please set ESEWA_PRODUCT_CODE and ESEWA_SECRET_KEY.');
        }

        $totalAmount = number_format((float) $payment->amount, 2, '.', '');
        $signedFields = 'total_amount,transaction_uuid,product_code';

        $signatureString = sprintf(
            'total_amount=%s,transaction_uuid=%s,product_code=%s',
            $totalAmount,
            $payment->order_id,
            $productCode
        );

        $signature = base64_encode(hash_hmac('sha256', $signatureString, $secretKey, true));

        return [
            'endpoint' => config('esewa.form_url'),
            'fields' => [
                'amount' => $totalAmount,
                'tax_amount' => '0',
                'total_amount' => $totalAmount,
                'transaction_uuid' => $payment->order_id,
                'product_code' => $productCode,
                'product_service_charge' => '0',
                'product_delivery_charge' => '0',
                'success_url' => route('payments.esewa.success'),
                'failure_url' => route('payments.esewa.failure'),
                'signed_field_names' => $signedFields,
                'signature' => $signature,
            ],
        ];
    }

    public function parseSuccessPayload(?string $encodedData): array
    {
        if (empty($encodedData)) {
            return [];
        }

        $decoded = base64_decode($encodedData, true);
        if ($decoded === false) {
            return [];
        }

        $payload = json_decode($decoded, true);

        return is_array($payload) ? $payload : [];
    }

    public function verifyTransaction(string $transactionUuid, string $amount): array
    {
        try {
            $response = Http::timeout(15)
                ->acceptJson()
                ->get(config('esewa.status_check_url'), [
                    'product_code' => config('esewa.product_code'),
                    'total_amount' => number_format((float) $amount, 2, '.', ''),
                    'transaction_uuid' => $transactionUuid,
                ]);

            $body = $response->json();
            $status = strtoupper((string) ($body['status'] ?? ''));
            $isSuccess = in_array($status, ['COMPLETE', 'SUCCESS'], true);

            return [
                'verified' => $response->successful() && $isSuccess,
                'status' => $status,
                'response' => $body,
            ];
        } catch (\Throwable $exception) {
            Log::error('eSewa verification error', [
                'transaction_uuid' => $transactionUuid,
                'message' => $exception->getMessage(),
            ]);

            return [
                'verified' => false,
                'status' => 'ERROR',
                'response' => ['error' => $exception->getMessage()],
            ];
        }
    }
}
