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


                    $sellSummary = SellSummary::with(['employee' => function ($query) {
                        $query->select(['id', 'first_name', 'companie_id']);
                    }])->select('id', 'date', 'employee_id', 'created_at', 'updated_at', 'price_total', 'discount_total', 'total');
                    $sellSummary = $sellSummary->whereDate('date', '=', $request->from_date)->latest()->get();
                } else {
                    //kita filter dari tanggal awal ke akhir
                    $sellSummary = SellSummary::with(['employee' => function ($query) {
                        $query->select(['id', 'first_name', 'companie_id']);
                    }])->select('id', 'date', 'employee_id', 'created_at', 'updated_at', 'price_total', 'discount_total', 'total');
                    $sellSummary = $sellSummary->whereBetween('date', [$request->from_date, $request->to_date])->latest()->get();
                }
            } //Load data default
            else {
                $sellSummary = SellSummary::with(['employee' => function ($query) {
                    $query->select(['id', 'first_name', 'companie_id']);
                }]);

                $sellSummary = $sellSummary->select('id', 'date', 'employee_id', 'created_at', 'updated_at', 'price_total', 'discount_total', 'total')->latest()->get();
            }

            return datatables()->of($sellSummary)
                ->addIndexColumn()
                ->addColumn("price_total", function ($sellSummary) {
                    $value = number_format($sellSummary->price_total,2);
                    return $value;
                })
                ->addColumn("discount_total", function ($sellSummary) {
                    $value = number_format($sellSummary->discount_total,2);
                    return $value;
                })
                ->addColumn("total", function ($sellSummary) {
                    $value = number_format($sellSummary->total,2);
                    return $value;
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
