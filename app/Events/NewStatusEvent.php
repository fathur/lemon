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

    # public $broadcastQueue = 'statuses';

    /**
     * @var
     */
    public $status;

    /**
     * Create a new event instance.
     *
     * @param $status
     */
    public function __construct($status)
    {
        //
        $this->status = $status;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {

        $user = \Auth::user();

        $usersName = $user->followers->pluck('username');

        $channels = [];
        foreach ($usersName as $username) {
            array_push($channels, new PrivateChannel("user.{$username}"));
        }

        return $channels;
    }

    public function broadcastAs()
    {
        return 'status.new';
    }

//    public function broadcastWith()
//    {
//        return [];
//    }
}
