<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Booking;


class BookingRepository
{
    public function createBooking(array $data): Booking
    {
        return Booking::create($data);
    }

    public function getBookingsForEmployee(int $employeeId): Collection
    {
        return Booking::where('employee_id', $employeeId)->get();
    }
}


