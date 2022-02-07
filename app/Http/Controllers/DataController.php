<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Companie;

class DataController extends Controller
{
    public function open()
    {
        $data = "This data is open and can be accessed without the client being authenticated";
        return response()->json(compact('data'), 200);
    }

    public function closed()
    {
        $data = "Only authorized users can see this";
        return response()->json(compact('data'), 200);
    }

    public function getEmployees(Request $request)
    {
        $getCompanyId = $request->only('company_id');

        
        $employee = Employee::with(['companie' => function ($query) {
            $query->select(['id', 'name']);
        }])->select('id', 'first_name', 'last_name', 'email', 'phone', 'companie_id', 'created_at', 'updated_at');
        $employee = $employee->where('companie_id', $getCompanyId)->get();

        return response()->json(compact('employee'), 200);
    }
    public function getEmployeesTestPermissions()
    {



        $employee = Employee::with(['companie' => function ($query) {
            $query->select(['id', 'name']);
        }])->select('id', 'first_name', 'last_name', 'email', 'phone', 'companie_id', 'created_at', 'updated_at');
        $employee = $employee->where('companie_id', '1')->get();

        return response()->json(compact('employee'), 200);
    }
    public function getEmployeesTest()
    {


        Companie::factory()->create();
        $employee = Employee::factory()->create();
        
        $employee = $employee->where('companie_id', '1')->get('');


        if ($employee->first()) {
            return response()->json(compact('employee'), 200);
        } else {
            return response()->json(['error' => 'invalid'], 401);
        }
    }
}
