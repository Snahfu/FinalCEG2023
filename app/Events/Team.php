<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Team implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $koin;
    public function __construct($id, $koin)
    {
        $this->id = $id;
        $this->koin = $koin;
    }

    public function broadcastOn()
    {
        return new Channel('teamPusher');
    }

    public function broadcastAs()
    {
        return 'team';
    }
}
