<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\FilterAvailableCarsRequest;
use App\Http\Requests\CreateBookingRequest;
use App\Repositories\CarRepository;
use App\Repositories\BookingRepository;
use Illuminate\Http\JsonResponse;

class CarBookingController extends Controller
{
    private CarRepository $carRepository;
    private BookingRepository $bookingRepository;

    public function __construct(CarRepository $carRepository, BookingRepository $bookingRepository)
    {
        $this->carRepository = $carRepository;
        $this->bookingRepository = $bookingRepository;
    }

    public function availableCars(FilterAvailableCarsRequest $request): JsonResponse
    {
        $filters = $request->validated();
        try {
            $availableCars = $this->carRepository->getAvailableCarsForEmployee($filters);

            return response()->json($availableCars);
        } catch (Exception $e) {
//            return response()->json("Invalid input data", 500);
        }
        $availableCars = $this->carRepository->getAvailableCarsForEmployee($filters);

        return response()->json($availableCars);
    }

    public function createBooking(CreateBookingRequest $request): JsonResponse
    {
        $data = $request->validated();

        $booking = $this->bookingRepository->createBooking(
            $data['car_id'],
            auth()->id(),
            $data['start_time'],
            $data['end_time']
        );

        return response()->json($booking, 201);
    }
}
