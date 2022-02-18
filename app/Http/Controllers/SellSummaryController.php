<?php

namespace App\Http\Controllers;

use App\Models\Companie;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeStoreRequest;
use App\Models\SellSummary;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Sell;
use Illuminate\Support\Carbon;

class SellSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::select('id', 'first_name','last_name')->latest()->get();
        $companies = Companie::select('id', 'name')->latest()->get();

        // $employees = Employee::latest()->paginate(10);
        // return view('employee.index',compact('employees'));
        return view('sellSummary.index', compact('employees', 'companies'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::select('id', 'first_name')->latest()->get();
        $sells = Sell::select('id', 'date', 'item_id', 'price', 'discount', 'employee_id')->get();
        $items = Item::select('id', 'name', 'price')->get();
        return view('sellSummary.index', compact('employees', 'sells', 'items'));
    }

    public function edit(SellSummary $sellSummary)
    {
        $employees = Employee::with(['companie' => function ($query) {
            $query->select(['id', 'name']);
        }])->select('id', 'first_name', 'companie_id')->get();
        // $employees = Employee::select('id', 'first_name','companie_id')->get();
        $sells = Sell::with(['item' => function ($query) {
            $query->select(['id', 'name']);
        }])->select('id', 'date', 'item_id', 'price', 'discount', 'employee_id');
        $sells = $sells->whereDate('date', '=', Carbon::parse($sellSummary->date)->format('Y-m-d'))->where('employee_id', '=', $sellSummary->employee_id)->get();
        return view('sellSummary.show', compact('sellSummary', 'employees', 'sells'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
