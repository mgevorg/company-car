<?php

namespace App\Repositories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CarRepository
{
    public function getAvailableCarsForEmployee(int $employeeId, string $startTime, string $endTime): Collection
    {
        $employeePosition = DB::table('employees')->where('id', $employeeId)->value('position');

        return Car::whereDoesntHave('bookings', function ($query) use ($startTime, $endTime) {
            $query->where(function ($q) use ($startTime, $endTime) {
                $q->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($nested) use ($startTime, $endTime) {
                        $nested->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                    });
            });
        })
            ->whereHas('comfortCategory.positions', function ($query) use ($employeePosition) {
                $query->where('name', $employeePosition);
            })
            ->get();
    }
}

