<?php 
namespace App\CrudMachanism;

use Carbon\Carbon;
use App\Models\Booking;

class BookingMachanism
{
    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function createBooking()
    {

        $data = [];
        $data['user_id']       = $this->booking['user_id'];
        $data['service_id']    = $this->booking['form_data']['service_id'];
        $data['schedule_date'] = Carbon::parse($this->booking['form_data']['schedule_date'])->format('y-m-d');
        $data['schedule_time'] = Carbon::parse($this->booking['form_data']['schedule_time'])->format('g:i a');

        $booking = Booking::create($data);

    }
}