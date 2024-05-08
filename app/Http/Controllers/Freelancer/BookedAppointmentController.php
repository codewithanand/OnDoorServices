<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Appointment;
use App\Models\BookedAppointment;

class BookedAppointmentController extends Controller
{
    public function store($appointmentId){
        $appointment = Appointment::find($appointmentId);
        $appointment->booked = 1;
        $appointment->update();

        $bookedAppointment = new BookedAppointment;
        $bookedAppointment->appointment_id = $appointmentId;
        $bookedAppointment->freelancer_id = auth()->user()->id;
        $bookedAppointment->booking_date = date("Y-m-d");
        $bookedAppointment->save();

        return redirect()->back()->with("success", "Appointment booked successfully");
    }

    public function complete($bookingId){
        $booked_appointment = BookedAppointment::find($bookingId);
        if($booked_appointment){
            $appointment = Appointment::find($booked_appointment->appointment_id);
            $appointment->completed = 1;
            $appointment->update();

            $booked_appointment->status = 1;
            $booked_appointment->completed_date = date("Y-m-d");
            $booked_appointment->update();
            return redirect()->back()->with("success", "Job marked completed successfully");
        }
        else{
            return redirect()->back()->with("error", "Incorrect booking id");
        }
    }

    public function revert($bookingId){
        $booked_appointment = BookedAppointment::find($bookingId);
        if($booked_appointment){
            $appointment = Appointment::find($booked_appointment->appointment_id);
            $appointment->booked = 0;
            $appointment->update();


            $booked_appointment->delete();
            return redirect()->back()->with("success", "Job restored successfully");
        }
        else{
            return redirect()->back()->with("error", "Incorrect booking id");
        }
    }
}
