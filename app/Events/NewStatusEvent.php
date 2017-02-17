<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewStatusEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $broadcastQueue = 'statuses';

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');

        return [
            new PrivateChannel('user.1'),
            new PrivateChannel('user.2'),
            new PrivateChannel('user.3'),
            new PrivateChannel('user.4'),
        ];
    }

    public function broadcastAs()
    {
        return 'status.new';
    }

    public function broadcastWith()
    {
        return [];
    }
}
