@extends('layouts.app')
@section('title')
{{trans('sellSummary.title2') }}
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">

        @include('layouts.notif')

        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">
                    Sales Preview
                    <a href="{{ route('sellSummaries.index') }}" class="btn btn-sm btn-secondary float-right"> {{trans('sellSummary.btn1') }}</a>
                </div>
                <div class="card-body">

                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-4">
                            <label for=""> {{trans('sellSummary.table1') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ $sellSummary->date }}" readonly>
                            @include('layouts.error', ['name' => 'name'])
                        </div>
                        <div class="col-4">
                            <label for=""> {{trans('sellSummary.table2') }}</label>
                            <input type="email" class="form-control" name="email" value="{{ $sellSummary->employee->first_name }}" readonly>
                            @include('layouts.error', ['name' => 'email'])
                        </div>
                        <div class="col-4">
                            <label for=""> {{trans('sellSummary.table3') }}</label>
                            <input type="email" class="form-control" name="email" value="{{ $sellSummary->employee->companie->name ?? 0}}" readonly>
                            @include('layouts.error', ['name' => 'email'])
                        </div>
                    </div>
                    <label class="mt-4" for=""> {{trans('sellSummary.detail') }} </label>
                    <table class="table text-center table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{trans('sellSummary.table1') }}</th>
                                <th>{{trans('item.title1') }}</th>
                                <th>{{trans('item.table2') }}</th>
                                <th>{{trans('sell.table4') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                        <div class="row p-3">
                            <tbody>
                                @foreach($sells as $sell)
                                <tr>
                                    <td> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $sell->date, 'UTC')->setTimezone(Session::get('tz', 'UTC'))}} </td>
                                    <td> {{$sell->item->name}} </td>
                                    <td> {{$sell->price}} </td>
                                    <td> {{$sell->discount}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                    <div class="row">
                        <div class="col-4">
                            <label for="">{{trans('sellSummary.table6') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ $sellSummary->price_total }}" readonly>
                            @include('layouts.error', ['name' => 'name'])
                        </div>
                        <div class="col-4">
                            <label for=""> {{trans('sellSummary.table7') }}</label>
                            <input type="email" class="form-control" name="email" value="{{ $sellSummary->discount_total }}" readonly>
                            @include('layouts.error', ['name' => 'email'])
                        </div>
                        <div class="col-4">
                            <label for=""> {{trans('sellSummary.table8') }}</label>
                            <input type="email" class="form-control" name="email" value="{{ $sellSummary->total }}" readonly>
                            @include('layouts.error', ['name' => 'email'])
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection