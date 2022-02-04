@extends('layouts.app')
@section('title')
{{trans('item.title2') }}
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">

        @include('layouts.notif')

        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">
                {{trans('item.title2') }}
                    <a href="{{ route('items.index') }}" class="btn btn-sm btn-secondary float-right">{{trans('item.btn4') }}</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="">{{trans('item.table1') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @include('layouts.error', ['name' => 'name'])
                            </div>
                            <div class="col-6">
                                <label for="">{{trans('item.table2') }}</label>
                                <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                                @include('layouts.error', ['name' => 'price'])
                            </div>
                        </div>
                        <div class="row p-3">
                            <button class="btn btn-primary btn-block" type="submit">{{trans('item.btn1') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection