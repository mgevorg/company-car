<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;


class EmployeeRepository
{
    public function getAllEmployees(): Collection
    {
        return Employee::with('position')->get();
    }

    public function createEmployee(array $data): Employee
    {
        return Employee::create($data);
    }

    public function updateEmployee(int $id, array $data): Employee
    {
        $employee = Employee::findOrFail($id);
        $employee->update($data);

        return $employee;
    }

    public function deleteEmployee(int $id): void
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
    }

    public function getEmployeeById(int $id): Employee
    {
        return Employee::with('position')->findOrFail($id);
    }
}


