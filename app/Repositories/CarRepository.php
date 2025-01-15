<?php

namespace App\Repositories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CarRepository
{
    public function getAvailableCarsForEmployee($filters): Collection
    {
        $employeeId = $filters['employee_id'] ?? null;
        $startTime = $filters['start_time'] ?? null;
        $endTime = $filters['end_time'] ?? null;
        $modelId = $filters['model_id'] ?? null;
        $comfortCategoryId = $filters['comfort_category_id'] ?? null;

        return Car::query()
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
            ->when($modelId, function ($query) use ($modelId) {
                $query->where('id', $modelId);
            })
            ->when($comfortCategoryId, function ($query) use ($comfortCategoryId) {
                $query->where('comfort_category_id', $comfortCategoryId);
            })
            ->when($employeeId, function ($query) use ($employeeId) {
                $query->whereHas('comfortCategory.positions', function ($q) use ($employeeId) {
                    $q->where('positions.id', function ($subquery) use ($employeeId) {
                        $subquery->select('employees.position_id')
                            ->from('employees')
                            ->where('employees.id', $employeeId)
                            ->limit(1);
                    });
                });
            })
            ->with(['comfortCategory', 'driver'])
            ->get();
    }
}

