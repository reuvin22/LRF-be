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

    public function broadcastWith()
    {
        return [
            'segment' => [
                'segment_id' => $this->segment->segment_id,
                'attendance_id' => $this->segment->attendance_id,
                'type' => $this->segment->type,
                'segment_type' => $this->segment->segment_type,
                'site_id' => $this->segment->site_id,
                'site_name' => $this->segment->site_name,
                'start_time' => optional($this->segment->start_time)?->toISOString(),
                'end_time' => optional($this->segment->end_time)?->toISOString(),
                'action' => $this->action,
            ]
        ];
    }
}
