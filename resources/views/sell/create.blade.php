@extends('layouts.app')
@section('title')
{{trans('sell.title2') }}
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">

        @include('layouts.notif')

        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">
                {{trans('sell.title2') }}
                    <a href="{{ route('sells.index') }}" class="btn btn-sm btn-secondary float-right">{{trans('sell.btn4') }}</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('sells.store')}}" method="POST">
                        @csrf
                        <div class="row" style="display: none;">
                            <div class="col-6">
                                <label for="">Date</label>
                                <input type="text" class="form-control" name="date" value="{{ Carbon\Carbon::now()->toDateTimeString()}}">
                                @include('layouts.error', ['name' => 'date'])
                            </div>
                        </div>
                        
                            <div class="row mt-3">
                                <div class="col-md-12  item-select">
                                    <label for="">{{trans('sell.table2') }}</label>
                                    <select name="item_id" class="form-control">
                                        <option value="" selected disabled>{{trans('sell.optionitem') }}</option>
                                        @forelse ($items as $item)
                                        <option data-price="{{ $item->price }}" value="{{ $item->id }}">{{ $item->name }}</option>
                                        @empty
                                        <option value="" selected>{{trans('sell.status1') }}</option>
                                        @endforelse
                                    </select>
                                    @include('layouts.error', ['name' => 'item_id'])
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6 ">
                                    <label for="">{{trans('sell.table3') }}</label>
                                    <input type="number" class="form-control price-input" name="price" value="{{ old('price')}}" readonly>
                                    @include('layouts.error', ['name' => 'price'])
                                </div>
                                <div class="col-6">
                                    <label for="">{{trans('sell.table4') }}</label>
                                    <input type="number" class="form-control" name="discount" value="{{ old('discount')}}">
                                    @include('layouts.error', ['name' => 'discount'])
                                </div>
                            </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="">{{trans('sell.table5') }}</label>
                                <select name="employee_id" class="form-control">
                                    <option value="" selected disabled>{{trans('sell.optionemployee') }}</option>
                                    @forelse ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->first_name }}</option>
                                    @empty
                                    <option value="" selected>{{trans('sell.status1') }}</option>
                                    @endforelse
                                </select>
                                @include('layouts.error', ['name' => 'employee_id'])
                            </div>
                        </div>
                        <div class="row p-3">
                            <button class="btn btn-primary btn-block" type="submit">{{trans('sell.btn1') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $('.item-select').on('change', function() {
        $('.price-input')
            .val(
                $(this).find(':selected').data('price')
            );
    });
</script>
@endsection