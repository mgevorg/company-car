For all routes:
Accept:application/json
Content-Type:application/json




first route: GET localhost/api/cars/available
{
"employee_id": 1,
"start_time": "2025-01-17 10:00:00",
"end_time": "2025-01-30 18:00:00",
"car_id": 4,
"comfort_category_id": 2
}

second route POST localhost/api/bookings
{
"car_id": 22,
"employee_id": 1,
"start_time": "2026-01-16 10:00:00",
"end_time": "2026-01-16 12:00:00",
"comfort_category_id": 3
}

third route GET localhost/api/employees

fourth route: POST localhost/api/employees

{
"name": "Name Lastname",
"position_id": 3
}
