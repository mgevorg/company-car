<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function listEmployees(): JsonResponse
    {
        $employees = Employee::all(['id', 'name', 'position']);

        return response()->json($employees);
    }
}
