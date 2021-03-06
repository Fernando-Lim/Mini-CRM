<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\SellSummaryResource;
use App\Models\Companie;
use App\Models\SellSummary;
use DateTimeInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class SellSummaryApiController extends Controller
{
    public function getSellSummaries(Request $request)
    {
        if ($request->ajax()) {
            Session::put('tz', $request->region);
            if (!empty($request->from_date)) {
                //Jika tanggal awal(from_date) hingga tanggal akhir(to_date) adalah sama maka
                if ($request->from_date === $request->to_date) {
                    //kita filter tanggalnya sesuai dengan request from_date


                    $sellSummary = SellSummary::with('companie', 'employee');
                    $employee = Employee::with('companie');
                    $sellSummary = $sellSummary->whereHas('employee', function ($query) use ($request) {
                        $query->select(['id', 'first_name', 'last_name', 'companie_id'])
                            ->where('first_name', 'LIKE', "%$request->first_name%")
                            ->where('last_name', 'LIKE', "%$request->last_name%");
                        $getCompany = $request->company_name;
                        $query->whereHas('companie', function ($query2) use ($getCompany) {
                            $query2->where('name', 'LIKE', "%{$getCompany}%");
                        });
                    });
                    $sellSummary = $sellSummary->whereDate('date', '=', $request->from_date)->orderBy('date', 'DESC')
                    ->get();
                } else {
                    //kita filter dari tanggal awal ke akhir
                    $sellSummary = SellSummary::with('companie', 'employee');
                    $employee = Employee::with('companie');
                    $sellSummary = $sellSummary->whereHas('employee', function ($query) use ($request) {
                        $query->select(['id', 'first_name', 'last_name', 'companie_id'])
                            ->where('first_name', 'LIKE', "%$request->first_name%")
                            ->where('last_name', 'LIKE', "%$request->last_name%");
                        $getCompany = $request->company_name;
                        $query->whereHas('companie', function ($query2) use ($getCompany) {
                            $query2->where('name', 'LIKE', "%{$getCompany}%");
                        });
                    });
                    $sellSummary = $sellSummary->whereBetween('date', [$request->from_date, Carbon::parse($request->to_date)->format('Y-m-d 23:59:59')])->orderBy('date', 'DESC')
                    ->get();
                }
            } //Load data default
            else {

                $sellSummary = SellSummary::with('companie', 'employee');
                $employee = Employee::with('companie');
                $sellSummary = $sellSummary->whereHas('employee', function ($query) use ($request) {
                    $query->select(['id', 'first_name', 'last_name', 'companie_id'])
                        ->where('first_name', 'LIKE', "%$request->first_name%")
                        ->where('last_name', 'LIKE', "%$request->last_name%");
                    $getCompany = $request->company_name;
                    $query->whereHas('companie', function ($query2) use ($getCompany) {
                        $query2->where('name', 'LIKE', "%{$getCompany}%");
                    });
                })->orderBy('date', 'DESC')
                ->get();

                // $sellSummary = $sellSummary->select('id', 'date', 'employee_id', 'created_at', 'updated_at', 'price_total', 'discount_total', 'total')->latest()->get();
            }

            return datatables()->of($sellSummary)
                ->addIndexColumn()
                ->addColumn("price_total", function ($sellSummary) {
                    return number_format($sellSummary->price_total, 2);
                })
                ->addColumn("discount_total", function ($sellSummary) {
                    return number_format($sellSummary->discount_total, 2);
                })
                ->addColumn("total", function ($sellSummary) {
                    return number_format($sellSummary->total, 2);
                })
                ->addColumn("date", function ($sellSummary) {
                    return '<h6><a href="/sellSummaries/' . $sellSummary->id . '/edit">' . $sellSummary->date . '</a></h6>';
                })
                ->addColumn("company", function ($sellSummary) {
                    $findEmployee = Employee::where('id', '=', $sellSummary->employee_id)->first();
                    $getCompanyID = empty($findEmployee) ? 0 : $findEmployee->companie_id;
                    $findCompany = Companie::where('id', '=', $getCompanyID)->first();
                    return empty($findCompany) ? 0 : $findCompany->name;
                })
                ->addColumn("created_at", function ($sellSummary) {
                    $value = Session::get('tz', 'UTC');
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $sellSummary->created_at, 'UTC');
                    $date->setTimezone($value);
                    return $date;
                })
                ->addColumn("updated_at", function ($sellSummary) {
                    $value = Session::get('tz', 'UTC');
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $sellSummary->updated_at, 'UTC');
                    $date->setTimezone($value);
                    return $date;
                })
                ->rawColumns(['date', 'company', 'created_at', 'updated_at'])
                ->make(true);
        }
        return view('sellSummary.index');
    }

    public function index()
    {
        $sellSummaries = SellSummary::with('employee', 'companie')->get();
        return SellSummaryResource::collection($sellSummaries);
    }


    public function show(SellSummary $sellSummary)
    {
        return new SellSummaryResource($sellSummary->load(['employee', 'companie']));
    }
}
