<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageReadUpdated implements ShouldBroadcastNow
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        public string $conversationId,
        public array $messageIds,
        public int $readerId,
        public string $readAt,
    ) {
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.'.$this->conversationId),
            new PrivateChannel('dashboard.admin'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'chat.message.read';
    }

    public function broadcastWith(): array
    {
        return [
            'conversation_id' => $this->conversationId,
            'message_ids' => array_map('intval', $this->messageIds),
            'reader_id' => $this->readerId,
            'read_at' => $this->readAt,
        ];
    }
}
