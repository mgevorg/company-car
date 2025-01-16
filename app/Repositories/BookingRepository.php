<?php

namespace App\Repositories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class BookingRepository
{
    public function createBooking(array $data): Booking
    {
        $employeeId = $data['employee_id'];
        $carId = $data['car_id'];
        $comfortCategoryId = $data['comfort_category_id'];
        $startTime = $data['start_time'];
        $endTime = $data['end_time'];

        $isDriver = Car::query()
            ->where('id', $carId)
            ->whereHas('driver', function ($query) use ($employeeId) {
                $query->where('id', $employeeId);
            })
            ->exists();

        if ($isDriver) {
            throw ValidationException::withMessages(['employee_id' => 'The employee cannot be the driver of the car.']);
        }

        $isCategoryAllowed = DB::table('position_comfort_category')
            ->where('position_id', function ($subquery) use ($employeeId) {
                $subquery->select('position_id')
                    ->from('employees')
                    ->where('id', $employeeId)
                    ->limit(1);
            })
            ->where('comfort_category_id', $comfortCategoryId)
            ->exists();

        if (!$isCategoryAllowed) {
            throw ValidationException::withMessages(['comfort_category_id' => 'The comfort category is not allowed for the employee\'s position.']);
        }

        $isCarAvailable = Car::query()
            ->where('id', $carId)
            ->whereDoesntHave('bookings', function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->whereBetween('start_time', [$startTime, $endTime])
                        ->orWhereBetween('end_time', [$startTime, $endTime])
                        ->orWhere(function ($q) use ($startTime, $endTime) {
                            $q->where('start_time', '<=', $startTime)
                                ->where('end_time', '>=', $endTime);
                        });
                });
            })
            ->exists();

        if (!$isCarAvailable) {
            throw ValidationException::withMessages(['car_id' => 'The car is not available for the selected time period.']);
        }

        // Создаем бронирование
        return Booking::create([
            'car_id' => $carId,
            'employee_id' => $employeeId,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);
    }

    public function getBookingsForEmployee(int $employeeId): Collection
    {
        return Booking::where('employee_id', $employeeId)->get();
    }
}


