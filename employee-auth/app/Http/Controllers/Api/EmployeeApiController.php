<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use DateTimeInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class EmployeeApiController extends Controller
{
    
    public function getEmployees(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->from_date)) {
                //Jika tanggal awal(from_date) hingga tanggal akhir(to_date) adalah sama maka
                if ($request->from_date === $request->to_date) {
                    //kita filter tanggalnya sesuai dengan request from_date
                    

                    $employee = Employee::select('id', 'first_name', 'last_name', 'email', 'phone', 'created_at');
                    $employee = $employee->whereDate('created_at', '=', $request->from_date)->where('companie_id', '=' ,$request->companyid)->latest()->get();
                } else {
                    //kita filter dari tanggal awal ke akhir
                    $employee = Employee::select('id', 'first_name', 'last_name', 'email', 'phone', 'created_at');

                    $employee = $employee->whereBetween('created_at', array($request->from_date, $request->to_date))->where('companie_id', '=' ,$request->companyid)->latest()->get();
                }
            } //Load data default
            else {
                $employee = Employee::select('id', 'first_name', 'last_name', 'email', 'phone' ,'companie_id', 'created_at')->where('companie_id', '=' ,$request->companyid)->latest()->get();
            }

            return datatables()->of($employee)
                ->addIndexColumn()
                ->addColumn("created_at", function ($employee) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $employee->created_at, 'UTC');
                    return $date;
                })
                ->rawColumns(['created_at'])
                ->make(true);
        }
        return view('home');
    }

    public function index()
    {
        $employees = Employee::with('companie')->get();
        return EmployeeResource::collection($employees);
    }
    

    public function show(Employee $employee)
    {
        return new EmployeeResource($employee->load(['companie']));
    }
}
