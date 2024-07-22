<?php

namespace App\Events;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ConfirmAppointment
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $user;
    public function __construct(public Appointment $appointment)
    {
        $this->user=Auth::user();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('appointment.'.$this->user->id),
        ];
    }
    public function broadcastWith(): array
    {
        return [
            'message'=>'You have one message',
            'appointment' => $this->appointment,
            'doctor'=>$this->appointment->doctor,
            'hospital'=>$this->appointment->hospital
        ];
    }
    public function BroadcastAs(): string
    {
        return 'appointment.'.$this->user->id;
    }
}
