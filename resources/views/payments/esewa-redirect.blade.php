<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to eSewa</title>
</head>
<body>
    <p>Redirecting to eSewa...</p>
    <form id="esewaPaymentForm" action="{{ $endpoint }}" method="POST">
        @foreach($fields as $name => $value)
            <input type="hidden" name="{{ $name }}" value="{{ $value }}">
        @endforeach
    </form>

    <script>
        document.getElementById('esewaPaymentForm').submit();
    </script>
</body>
</html>
