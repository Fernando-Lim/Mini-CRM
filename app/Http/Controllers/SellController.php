<?php

namespace App\Http\Controllers;

use App\Models\Companie;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\SellStoreRequest;
use App\Models\Item;
use App\Models\Sell;
use App\Models\SellSummary;
use App\Models\Summary;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $employees = Employee::latest()->paginate(10);
        // return view('employee.index',compact('employees'));
        return view('sell.index');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::select('id', 'first_name')->latest()->get();
        $items = Item::select('id', 'name', 'price')->latest()->get();
        return view('sell.create', compact('employees', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SellStoreRequest $request)
    {
        Sell::create([
            'date' => $request->date,
            'item_id' => $request->item_id,
            'price' => $request->price,
            'discount' => $request->discount,
            'employee_id' => $request->employee_id
        ]);

        $summary = SellSummary::where('date', '=', Carbon::parse($request->date)->format('Y-m-d'))->where('employee_id', '=', $request->employee_id)->first();
        $getPriceTotal = empty($summary)? 0 : $summary->price_total;
        $finalPriceTotal = $getPriceTotal + $request->price;
        $getDiscountTotal = empty($summary)? 0 : $summary->discount_total;
        $finalDiscountTotal = $getDiscountTotal + ($request->price * $request->discount / 100);
        $total = $finalPriceTotal - $finalDiscountTotal;
        SellSummary::updateOrCreate(
            ['date' => Carbon::parse($request->date)->format('Y-m-d'), 'employee_id' => $request->employee_id],
            [
                'price_total' => $finalPriceTotal,
                'discount_total' => $finalDiscountTotal,
                'total' => $total
            ]
        );

        return redirect()->route('sells.create')->with('message', ['text' => __('sell.status2'), 'class' => 'success']);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sell $sell)
    {
        $employees = Employee::select('id', 'first_name')->get();
        $items = Item::select('id', 'name', 'price')->get();
        return view('sell.edit', compact('sell', 'employees', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SellStoreRequest $request, Sell $sell)
    {
        $sell->update([
            'date' => $request->date,
            'item_id' => $request->item_id,
            'price' => $request->price,
            'discount' => $request->discount,
            'employee_id' => $request->employee_id
        ]);

        return redirect()->route('sells.edit', $sell->id)->with('message', ['text' => __('sell.status3'), 'class' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sell $sell)
    {
        $sell->delete();
        return redirect()->route('sells.index')->with('message', ['text' => __('sell.status4'), 'class' => 'success']);
    }
}
