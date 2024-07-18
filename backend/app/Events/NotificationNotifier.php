<?php

namespace App\Events;

use App\Models\AppointmentNotifications;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class NotificationNotifier  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public AppointmentNotifications $notifications)
    {
       //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('notification.'.$this->notifications->user_id),
        ];
    }
    public function broadcastWith(): array
    {
        return [
            'message'=>'You have one message',
        ];
    }
    public function BroadcastAs(): string
    {
        return 'notify.'.$this->notifications->user_id;
    }
}
