<?php

namespace App\Http\Livewire\Student;

use App\Models\AppointmentProofOfPayment;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProofOfPayment extends Component
{

    use WithFileUploads;

    public $student_proof_of_payments = [];
    public $new_student_proof_of_payments = [];
    public $appointmentId = '';

    protected $listeners = ['update_proof_of_payment' => 'update_proof_of_payment'];

    public function render()
    {
        $this->student_proof_of_payments = AppointmentProofOfPayment::query()
            ->where('appointment_id', $this->appointmentId)
            ->get()
            ->map(function ($pof){
                return [
                    'url' => $pof->image_path
                ];
            })
            ->toArray();
        return view('livewire.student.update-proof-of-payment');
    }

    public function update_proof_of_payment($appointmentId)
    {
        $this->appointmentId = $appointmentId;
        $this->dispatchBrowserEvent('toggle-appointment-update-proof-of-payment-modal');
    }

    public function update_proof_of_payment_action()
    {
        AppointmentProofOfPayment::query()
            ->where( 'appointment_id',$this->appointmentId)
            ->delete();

        foreach ($this->new_student_proof_of_payments as $photo) {
            $image_path = $photo->storePublicly('proof_of_payment','public');
            AppointmentProofOfPayment::query()
                ->create([
                    'appointment_id' => $this->appointmentId,
                    'image_path' => $image_path,
                ]);
        }

        $this->dispatchBrowserEvent('close-appointment-update-proof-of-payment-modal');
    }

    public function cancelUpdate()
    {
        $this->reset('new_student_proof_of_payments','student_proof_of_payments');
        $this->dispatchBrowserEvent('close-appointment-update-proof-of-payment-modal');
    }
}
