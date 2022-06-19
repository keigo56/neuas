<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    private array $data = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('emails.appointment')
            ->with('status', $this->data['status'])
            ->with('notes', $this->data['notes'])
            ->with('student_name', $this->data['student_name'])
            ->with('department_name', $this->data['department_name'])
            ->with('documents', $this->data['documents'])
            ->with('appointment_date', $this->data['appointment_date'])
            ->with('time_schedule', $this->data['time_schedule'])
            ;
    }
}
