<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\ContactUs;

class ContactUsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ContactUs;

    /**
     * Create a new event instance.
     * ContactUsEvent constructor.
     * @param ContactUs $ContactUs
     */
    public function __construct(ContactUs $ContactUs)
    {
        //
        $this->ContactUs = $ContactUs;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function GetContactUs(){
        return $this->ContactUs;
    }
}
