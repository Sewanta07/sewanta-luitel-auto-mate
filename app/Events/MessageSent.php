<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        public Message $message,
        public string $conversationId,
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
        return 'chat.message.sent';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->message->id,
            'sender_id' => $this->message->sender_id,
            'receiver_id' => $this->message->receiver_id,
            'conversation_id' => $this->conversationId,
            'message' => $this->message->message,
            'is_read' => (bool) $this->message->is_read,
            'created_at' => optional($this->message->created_at)?->toISOString(),
        ];
    }
}
