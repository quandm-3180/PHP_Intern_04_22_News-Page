<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostStatusChangesNotificationEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $message;
    protected $authorId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $authorId)
    {
        $this->message = $message;
        $this->authorId = $authorId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('channel-notification-' .  $this->authorId);
    }

    public function broadcastAs()
    {
        return 'notification-event';
    }

    public function broadcastWith()
    {
        return $this->message;
    }
}
