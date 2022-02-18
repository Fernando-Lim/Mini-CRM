<?php

namespace App\Http\Controllers\Api;

use App\Models\Companie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CompanieResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class CompanieApiController extends Controller
{
    public function getCompanies(Request $request)
    {
        if ($request->ajax()) {
            Session::put('tz', $request->region);
            //Jika request from_date ada value(datanya) maka
            if (!empty($request->from_date)) {
                //Jika tanggal awal(from_date) hingga tanggal akhir(to_date) adalah sama maka
                if ($request->from_date === $request->to_date) {
                    //kita filter tanggalnya sesuai dengan request from_date
                    $companie = Companie::whereDate('created_at', '=', $request->from_date)
                        ->where('name', 'LIKE', "%$request->name%")
                        ->where('email', 'LIKE', "%$request->email%")
                        ->where('website', 'LIKE', "%$request->website%")->latest()->get();
                } else {
                    //kita filter dari tanggal awal ke akhir
                    $companie = Companie::whereBetween('created_at', array($request->from_date, $request->to_date))
                        ->where('name', 'LIKE', "%$request->name%")
                        ->where('email', 'LIKE', "%$request->email%")
                        ->where('website', 'LIKE', "%$request->website%")->latest()->get();
                }
            } //load data default
            else {
                $companie = Companie::select('id', 'name', 'email', 'logo', 'website', 'created_at', 'updated_at')
                    ->where('name', 'LIKE', "%$request->name%")
                    ->where('email', 'LIKE', "%$request->email%")
                    ->where('website', 'LIKE', "%$request->website%")->latest()->get();
            }
            return datatables()->of($companie)
                ->addIndexColumn()
                ->addColumn("created_at", function ($companie) {
                    $value = Session::get('tz', 'UTC');
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $companie->created_at, 'UTC');
                    $date->setTimezone($value);
                    return $date;
                })
                ->addColumn("updated_at", function ($companie) {
                    $value = Session::get('tz', 'UTC');
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $companie->updated_at, 'UTC');
                    $date->setTimezone($value);
                    return $date;
                })
                ->addColumn('image', function ($companie) {
                    $url = Storage::url('logos/' . $companie->logo);
                    return '<img src="' . $url . '" width="100" height="100" class="img-fluid" alt="logo">';
                })
                ->addColumn('action', function ($companie) {
                    return '<a href="/companies/' . $companie->id . '/edit"
                            class="btn btn-primary btn-sm btn-block">Edit</a>
                            <a href="/companies/' . $companie->id . '/destroy"
                            class="btn btn-danger btn-sm btn-block">Delete</a>';
                })
                ->rawColumns(['created_at', 'updated_at', 'image', 'action'])
                ->make(true);
        }
        return view('companie.index');
    }

    public function index()
    {
        $companies = Companie::get();
        return CompanieResource::collection($companies);
    }

    public function show(Companie $company)
    {
        return new CompanieResource($company);
    }
}
