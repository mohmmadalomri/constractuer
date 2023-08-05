<?php

namespace App\Http\Controllers\Api;

use App\Http\Traits\ImageTrait;
use App\Models\WeaklySchedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    use ImageTrait;

    public function index()
    {
        $employees = Employee::with('user', 'profession','WeaklySchedules')->get();
        $professionWithUrls = $employees->map(function ($employee) {
            $employee->image = url('attachments/employees/'.$employee->id .'/'. $employee->image);
            return $employee;
        });
        return response()->json([
            'employees' => $professionWithUrls
        ], 200);
    }

    public function store(Request $request)
    {
        // Step 1: Validate Input Data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|min:6', // Assuming a minimum of 6 characters for the password.
            'phone' => 'required|numeric',
            'status' => 'required|in:supervisor,employee,not_employee',
            'hourly_salary' => 'numeric|min:0',
            'monthly_salary' => 'numeric|min:0',
            'breath_day' => 'required|date',
            'image' => '',
            'user_id' => 'required',
            'profession_id' => 'required',
            'company_id' => 'required',

            // Validation for working hours for each day
            'Sunday_start_time' => 'required_with:Sunday_end_time|date_format:H:i:s',
            'Sunday_end_time' => 'required_with:Sunday_start_time|date_format:H:i:s|after:Sunday_start_time',
            'Monday_start_time' => 'required_with:Monday_end_time|date_format:H:i:s',
            'Monday_end_time' => 'required_with:Monday_start_time|date_format:H:i:s|after:Monday_start_time',
            'Tuesday_start_time' => 'required_with:Tuesday_end_time|date_format:H:i:s',
            'Tuesday_end_time' => 'required_with:Tuesday_start_time|date_format:H:i:s|after:Tuesday_start_time',
            'Wednesday_start_time' => 'required_with:Wednesday_end_time|date_format:H:i:s',
            'Wednesday_end_time' => 'required_with:Wednesday_start_time|date_format:H:i:s|after:Wednesday_start_time',
            'Thursday_start_time' => 'required_with:Thursday_end_time|date_format:H:i:s',
            'Thursday_end_time' => 'required_with:Thursday_start_time|date_format:H:i:s|after:Thursday_start_time',
            'Friday_start_time' => 'required_with:Friday_end_time|date_format:H:i:s',
            'Friday_end_time' => 'required_with:Friday_start_time|date_format:H:i:s|after:Friday_start_time',
            'Saturday_start_time' => 'required_with:Saturday_end_time|date_format:H:i:s',
            'Saturday_end_time' => 'required_with:Saturday_start_time|date_format:H:i:s|after:Saturday_start_time',
        ]);
        // Step 2: Encrypt the Password
        $encryptedPassword = Hash::make($validatedData['password']);
        // Step 3: Create Employee Record
        $employee = Employee::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $encryptedPassword,
            'phone' => $validatedData['phone'],
            'status' => $validatedData['status'],
            'hourly_salary' => $validatedData['hourly_salary'] ?? 0,
            'monthly_salary' => $validatedData['monthly_salary'] ?? 0,
            'breath_day' => $validatedData['breath_day'],
            'user_id' => $validatedData['user_id'],
            'company_id' => $validatedData['company_id'],
            'profession_id' => $validatedData['profession_id'],
            // You would also set the 'user_id', 'company_id', 'profession_id', etc., if applicable.


        ]);
        if ($request->hasfile('image')) {
            $employee_image = $this->saveImage($request->image, 'attachments/employees/'.$employee->id);
            $employee->image = $employee_image;
            $employee->save();
        }
        $employee->image = url('attachments/employees/'.$employee->id .'/'. $employee->image);

        // Step 3: Save Employee Working Hours for Each Day
        $daysOfWeek = ['Sunday','Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        foreach ($daysOfWeek as $day) {
            $start_time = $request->input($day . '_start_time');
            $end_time = $request->input($day . '_end_time');

            // You may add additional validation for the start_time and end_time if needed.
            if ($start_time && $end_time) {
                WeaklySchedule::create([
                    'employee_id' => $employee->id,
                    'day_of_week' => $day,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                ]);
            }
        }

        // Step 4: Success Indication
        return response()->json([
            'message' => 'Employee created successfully!',
            'data' => $employee,
            'WeaklySchedule'=>$employee->WeaklySchedules
        ], 201);
    }

    public function show($id)
    {
        $employee = Employee::with('user', 'profession','WeaklySchedules')->find($id);
        $employee->image = url('attachments/employees/'.$employee->id .'/'. $employee->image);
        return response()->json([
            'employee' => $employee,

        ], 200);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        if ($employee) {
            $data['profession_id'] = $request->profession_id ? $request->profession_id : $employee->profession_id;
            $data['hourly_salary'] = $request->hourly_salary ? $request->hourly_salary : $employee->hourly_salary;
            $data['monthly_salary'] = $request->monthly_salary ? $request->monthly_salary : $employee->monthly_salary;

            $employee->update($data);
            $employee->image = url('attachments/employees/'.$employee->id .'/'. $employee->image);
            return response()->json([
                'status' => true,
                'message' => 'employee Information Updated Successfully',
                'data' => $employee,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'employee Information Updated error',
            ]);
        }
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        if (!$employee) {
            return response()->json([
                'status' => false,
                'message' => 'not found employee',
            ]);
        }
        $this->deleteFile('employees',$id);
        $employee->delete();
        return response()->json([
            'status' => true,
            'message' => 'employee Information deleted Successfully',
        ]);
    }
}
