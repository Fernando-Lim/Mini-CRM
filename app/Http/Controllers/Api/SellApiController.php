<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Item;
use App\Models\Sell;
use DateTimeInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Http\Resources\SellResource;

class SellApiController extends Controller
{
    public function getSells(Request $request)
    {
        if ($request->ajax()) {
            Session::put('tz', $request->region);
            if (!empty($request->from_date)) {
                //Jika tanggal awal(from_date) hingga tanggal akhir(to_date) adalah sama maka
                if ($request->from_date === $request->to_date) {
                    //kita filter tanggalnya sesuai dengan request from_date
                    if (!empty($request->item_id) && !empty($request->employee_id)) {
                        $sell = Sell::with(['employee' => function ($query) {
                            $query->select(['id', 'first_name']);
                        }]);
                        $sell = $sell->with(['item' => function ($query) {
                            $query->select(['id', 'name']);
                        }]);
                        $sell = $sell->select('id', 'date', 'item_id', 'price', 'discount', 'employee_id');
                        $sell = $sell->whereDate('date', '=', $request->from_date)->orderBy('date', 'DESC')
                            ->where('item_id', '=', $request->item_id)
                            ->where('employee_id', '=', $request->employee_id)->get();
                    } elseif (!empty($request->item_id)) {
                        $sell = Sell::with(['employee' => function ($query) {
                            $query->select(['id', 'first_name']);
                        }]);
                        $sell = $sell->with(['item' => function ($query) {
                            $query->select(['id', 'name']);
                        }]);
                        $sell = $sell->select('id', 'date', 'item_id', 'price', 'discount', 'employee_id');
                        $sell = $sell->whereDate('date', '=', $request->from_date)->orderBy('date', 'DESC')
                            ->where('item_id', '=', $request->item_id)->get();
                    } elseif (!empty($request->employee_id)) {
                        $sell = Sell::with(['employee' => function ($query) {
                            $query->select(['id', 'first_name']);
                        }]);
                        $sell = $sell->with(['item' => function ($query) {
                            $query->select(['id', 'name']);
                        }]);
                        $sell = $sell->select('id', 'date', 'item_id', 'price', 'discount', 'employee_id');
                        $sell = $sell->whereDate('date', '=', $request->from_date)->orderBy('date', 'DESC')
                            ->where('employee_id', '=', $request->employee_id)->get();
                    } else {
                        $sell = Sell::with(['employee' => function ($query) {
                            $query->select(['id', 'first_name']);
                        }]);
                        $sell = $sell->with(['item' => function ($query) {
                            $query->select(['id', 'name']);
                        }]);
                        $sell = $sell->select('id', 'date', 'item_id', 'price', 'discount', 'employee_id');
                        $sell = $sell->whereDate('date', '=', $request->from_date)->orderBy('date', 'DESC')->get();
                    }
                } else {
                    //kita filter dari tanggal awal ke akhir
                    if (!empty($request->item_id) && !empty($request->employee_id)) {
                        $sell = Sell::with(['employee' => function ($query) {
                            $query->select(['id', 'first_name']);
                        }]);
                        $sell = $sell->with(['item' => function ($query) {
                            $query->select(['id', 'name']);
                        }]);
                        $sell = $sell->select('id', 'date', 'item_id', 'price', 'discount', 'employee_id');
                        $sell = $sell->whereBetween('date', [$request->from_date, $request->to_date])
                            ->where('item_id', '=', $request->item_id)
                            ->where('employee_id', '=', $request->employee_id)
                            ->orderBy('date', 'DESC')->get();
                    } elseif (!empty($request->item_id)) {
                        $sell = Sell::with(['employee' => function ($query) {
                            $query->select(['id', 'first_name']);
                        }]);
                        $sell = $sell->with(['item' => function ($query) {
                            $query->select(['id', 'name']);
                        }]);
                        $sell = $sell->select('id', 'date', 'item_id', 'price', 'discount', 'employee_id');
                        $sell = $sell->whereBetween('date', [$request->from_date, $request->to_date])
                            ->where('item_id', '=', $request->item_id)
                            ->orderBy('date', 'DESC')->get();
                    } elseif (!empty($request->employee_id)) {
                        $sell = Sell::with(['employee' => function ($query) {
                            $query->select(['id', 'first_name']);
                        }]);
                        $sell = $sell->with(['item' => function ($query) {
                            $query->select(['id', 'name']);
                        }]);
                        $sell = $sell->select('id', 'date', 'item_id', 'price', 'discount', 'employee_id');
                        $sell = $sell->whereBetween('date', [$request->from_date, $request->to_date])
                            ->where('employee_id', '=', $request->employee_id)
                            ->orderBy('date', 'DESC')->get();
                    } else {
                        $sell = Sell::with(['employee' => function ($query) {
                            $query->select(['id', 'first_name']);
                        }]);
                        $sell = $sell->with(['item' => function ($query) {
                            $query->select(['id', 'name']);
                        }]);
                        $sell = $sell->select('id', 'date', 'item_id', 'price', 'discount', 'employee_id');
                        $sell = $sell->whereBetween('date', [$request->from_date, $request->to_date])->get();
                    }
                }
            } //Load data default
            else {
                if (!empty($request->item_id) && !empty($request->employee_id)) {
                    $sell = Sell::with(['employee' => function ($query) {
                        $query->select(['id', 'first_name']);
                    }]);
                    $sell = $sell->with(['item' => function ($query) {
                        $query->select(['id', 'name']);
                    }]);
                    $sell = $sell->select('id', 'date', 'item_id', 'price', 'discount', 'employee_id')
                        ->where('item_id', '=', $request->item_id)
                        ->where('employee_id', '=', $request->employee_id)
                        ->orderBy('date', 'DESC')->get();
                } elseif (!empty($request->item_id)) {
                    $sell = Sell::with(['employee' => function ($query) {
                        $query->select(['id', 'first_name']);
                    }]);
                    $sell = $sell->with(['item' => function ($query) {
                        $query->select(['id', 'name']);
                    }]);
                    $sell = $sell->select('id', 'date', 'item_id', 'price', 'discount', 'employee_id')
                        ->where('item_id', '=', $request->item_id)
                        ->orderBy('date', 'DESC')->get();
                } elseif (!empty($request->employee_id)) {
                    $sell = Sell::with(['employee' => function ($query) {
                        $query->select(['id', 'first_name']);
                    }]);
                    $sell = $sell->with(['item' => function ($query) {
                        $query->select(['id', 'name']);
                    }]);
                    $sell = $sell->select('id', 'date', 'item_id', 'price', 'discount', 'employee_id')
                        ->where('employee_id', '=', $request->employee_id)
                        ->orderBy('date', 'DESC')->get();
                } else {
                    $sell = Sell::with(['employee' => function ($query) {
                        $query->select(['id', 'first_name']);
                    }]);
                    $sell = $sell->with(['item' => function ($query) {
                        $query->select(['id', 'name']);
                    }]);
                    $sell = $sell->select('id', 'date', 'item_id', 'price', 'discount', 'employee_id')
                        ->orderBy('date', 'DESC')->get();
                }
            }

            return datatables()->of($sell)
                ->addIndexColumn()
                ->addColumn("price", function ($sell) {
                    return number_format($sell->price, 2);
                })
                ->addColumn("date", function ($sell) {
                    $value = Session::get('tz', 'UTC');
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $sell->date, 'UTC');
                    $date->setTimezone($value);
                    return $date;
                })
                ->addColumn('action', function ($sell) {
                    return '<a href="/sells/' . $sell->id . '/edit"
                    class="btn btn-primary btn-sm btn-block">Edit</a>
                    <a href="/sells/' . $sell->id . '/destroy"
                    class="btn btn-danger btn-sm btn-block">Delete</a>';
                })
                ->rawColumns(['date', 'action'])
                ->make(true);
        }
        return view('sell.index');
    }

    public function index()
    {
        $sells = Sell::with('employee');
        $sells = $sells->with('item')->get();
        return SellResource::collection($sells);
    }


    public function show(Sell $sell)
    {
        return new SellResource($sell->load(['employee']), $sell->load(['item']));
    }
}
