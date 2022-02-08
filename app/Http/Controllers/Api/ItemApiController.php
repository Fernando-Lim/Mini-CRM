<?php

namespace App\Http\Controllers\Api;

use App\Models\Companie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CompanieResource;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class ItemApiController extends Controller
{
    public function getItems(Request $request)
    {
        if ($request->ajax()) {
            Session::put('tz', $request->region);
            //Jika request from_date ada value(datanya) maka
            if (!empty($request->from_date)) {
                //Jika tanggal awal(from_date) hingga tanggal akhir(to_date) adalah sama maka
                if ($request->from_date === $request->to_date) {
                    //kita filter tanggalnya sesuai dengan request from_date
                    $item = Item::whereDate('created_at', '=', $request->from_date)->get();
                } else {
                    //kita filter dari tanggal awal ke akhir
                    $item = Item::whereBetween('created_at', array($request->from_date, $request->to_date))->get();
                }
            } //load data default
            else {
                $item = Item::select('id', 'name', 'price', 'created_at', 'updated_at')->latest()->get();
            }
            return datatables()->of($item)
                ->addIndexColumn()
                ->addColumn("price", function ($item) {
                    $value = number_format($item->price,2);
                    return $value;
                })
                ->addColumn("created_at", function ($item) {
                    $value = Session::get('tz','UTC');
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at, 'UTC');
                    $date->setTimezone($value);
                    return $date;
                })
                ->addColumn("updated_at", function ($item) {
                    $value = Session::get('tz','UTC');
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $item->updated_at, 'UTC');
                    $date->setTimezone($value);
                    return $date;
                })
                ->addColumn('action', function ($item) {
                    return '<a href="/items/' . $item->id . '/edit"
                            class="btn btn-primary btn-sm btn-block">Edit</a>
                            <a href="/items/' . $item->id . '/destroy"
                            class="btn btn-danger btn-sm btn-block">Delete</a>';
                })
                ->rawColumns(['created_at', 'updated_at', 'action'])
                ->make(true);
        }
        return view('item.index');
    }

    public function index()
    {
        $items = Item::get();
        return ItemResource::collection($items);
    }

    public function show(Item $item)
    {
        return new ItemResource($item);
    }
}
