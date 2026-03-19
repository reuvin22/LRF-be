<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SegmentEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $segment;
    public $action;

    public function __construct($segment, $action)
    {
        $this->segment = $segment;
        $this->action = $action;
    }

    public function broadcastOn()
    {
        return new Channel('segments');
    }

    public function broadcastAs()
    {
        return 'segment.event';
    }
}
