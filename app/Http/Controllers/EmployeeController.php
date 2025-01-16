<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private EmployeeRepository $employeeRepository;
    public function __construct()
    {
        $this->employeeRepository = new EmployeeRepository();
    }
    public function getAllEmployees(): JsonResponse
    {
        try {
            $employees = $this->employeeRepository->getAllEmployees();
            return response()->json($employees);
        } catch (Exception $e) {
            return response()->json("Invalid input", 500);
        }
    }

    public function createEmployee(CreateEmployeeRequest $reqest): JsonResponse
    {
        try {
            $data = $reqest->validated();
            $employees = $this->employeeRepository->createEmployee($data);
            return response()->json($employees);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
