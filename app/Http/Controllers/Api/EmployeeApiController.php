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
            Session::put('tz', $request->region);
            if (!empty($request->from_date)) {
                //Jika tanggal awal(from_date) hingga tanggal akhir(to_date) adalah sama maka
                if ($request->from_date === $request->to_date) {
                    //kita filter tanggalnya sesuai dengan request from_date

                    if (!empty($request->companie_id)) {
                        $employee = Employee::with(['companie' => function ($query) {
                            $query->select(['id', 'name']);
                        }])->select('id', 'first_name', 'last_name', 'email', 'phone', 'companie_id', 'created_at', 'updated_at');
                        $employee = $employee->whereDate('created_at', '=', $request->from_date)
                        ->where('first_name', 'LIKE', "%$request->first_name%")
                            ->where('last_name', 'LIKE', "%$request->last_name%")
                            ->where('companie_id', '=', $request->companie_id)
                            ->where('email', 'LIKE', "%$request->email%")
                            ->where('phone', 'LIKE', "%$request->phone_number%")
                            ->latest()->get();
                    } else {
                        $employee = Employee::with(['companie' => function ($query) {
                            $query->select(['id', 'name']);
                        }])->select('id', 'first_name', 'last_name', 'email', 'phone', 'companie_id', 'created_at', 'updated_at');
                        $employee = $employee->whereDate('created_at', '=', $request->from_date)
                        ->where('first_name', 'LIKE', "%$request->first_name%")
                            ->where('last_name', 'LIKE', "%$request->last_name%")
                            ->where('email', 'LIKE', "%$request->email%")
                            ->where('phone', 'LIKE', "%$request->phone_number%")
                            ->latest()->get();
                    }
                } else {
                    //kita filter dari tanggal awal ke akhir
                    if (!empty($request->companie_id)) {
                        $employee = Employee::with(['companie' => function ($query) {
                            $query->select(['id', 'name']);
                        }])->select('id', 'first_name', 'last_name', 'email', 'phone', 'companie_id', 'created_at', 'updated_at');
                        $employee = $employee->whereBetween('created_at', array($request->from_date, $request->to_date))
                        ->where('first_name', 'LIKE', "%$request->first_name%")
                        ->where('last_name', 'LIKE', "%$request->last_name%")
                        ->where('companie_id', '=', $request->companie_id)
                        ->where('email', 'LIKE', "%$request->email%")
                        ->where('phone', 'LIKE', "%$request->phone_number%")
                        ->latest()->get();
                    }else{
                        $employee = Employee::with(['companie' => function ($query) {
                            $query->select(['id', 'name']);
                        }])->select('id', 'first_name', 'last_name', 'email', 'phone', 'companie_id', 'created_at', 'updated_at');
                        $employee = $employee->whereBetween('created_at', array($request->from_date, $request->to_date))
                        ->where('first_name', 'LIKE', "%$request->first_name%")
                        ->where('last_name', 'LIKE', "%$request->last_name%")
                        ->where('email', 'LIKE', "%$request->email%")
                        ->where('phone', 'LIKE', "%$request->phone_number%")
                        ->latest()->get();
                    }
                }
            } //Load data default
            else {
                if (!empty($request->companie_id)) {
                    $employee = Employee::with(['companie' => function ($query) {
                        $query->select(['id', 'name']);
                    }]);
                    $employee = $employee->select('id', 'first_name', 'last_name', 'email', 'phone', 'companie_id', 'created_at', 'updated_at')
                        ->where('first_name', 'LIKE', "%$request->first_name%")
                        ->where('last_name', 'LIKE', "%$request->last_name%")
                        ->where('companie_id', '=', $request->companie_id)
                        ->where('email', 'LIKE', "%$request->email%")
                        ->where('phone', 'LIKE', "%$request->phone_number%")
                        ->latest()->get();
                } else {
                    $employee = Employee::with(['companie' => function ($query) {
                        $query->select(['id', 'name']);
                    }]);
                    $employee = $employee->select('id', 'first_name', 'last_name', 'email', 'phone', 'companie_id', 'created_at', 'updated_at')
                        ->where('first_name', 'LIKE', "%$request->first_name%")
                        ->where('last_name', 'LIKE', "%$request->last_name%")
                        ->where('email', 'LIKE', "%$request->email%")
                        ->where('phone', 'LIKE', "%$request->phone_number%")
                        ->latest()->get();
                }
            }

            return datatables()->of($employee)
                ->addIndexColumn()
                ->addColumn("created_at", function ($employee) {
                    $value = Session::get('tz', 'UTC');
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $employee->created_at, 'UTC');
                    $date->setTimezone($value);
                    return $date;
                })
                ->addColumn("updated_at", function ($employee) {
                    $value = Session::get('tz', 'UTC');
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $employee->updated_at, 'UTC');
                    $date->setTimezone($value);
                    return $date;
                })
                ->addColumn('action', function ($employee) {
                    return '<a href="/employees/' . $employee->id . '/edit"
                    class="btn btn-primary btn-sm btn-block">Edit</a>
                    <a href="/employees/' . $employee->id . '/destroy"
                    class="btn btn-danger btn-sm btn-block">Delete</a>';
                })
                ->rawColumns(['created_at', 'updated_at', 'action'])
                ->make(true);
        }
        return view('employee.index');
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
