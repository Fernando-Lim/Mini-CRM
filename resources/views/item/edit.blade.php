@extends('layouts.app')
@section('title')
{{trans('item.title3') }}
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">

        @include('layouts.notif')

        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">
                {{trans('item.title3') }}
                    <a href="{{ route('items.index') }}" class="btn btn-sm btn-secondary float-right">{{trans('item.btn4') }}</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('items.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <label for=""> {{trans('item.table1') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ $item->name }}">
                                @include('layouts.error', ['name' => 'name'])
                            </div>
                            <div class="col-6">
                                <label for=""> {{trans('item.table2') }}</label>
                                <input type="number" class="form-control" name="price" value="{{ $item->price }}">
                                @include('layouts.error', ['name' => 'price'])
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 " style="display: none;">
                                <label for="">{{ __('Created By Id') }}</label>
                                <div class="mt-2">
                                    <input type="text" name="created_by_id" class="form-control" value="{{ $item->created_by_id }}">
                                    @include('layouts.error', ['name' => 'created_by_id'])
                                </div>
                            </div>
                            <div class="col-6 " style="display: none;">
                                <label for="">{{ __('Updated By Id') }}</label>
                                <div class="mt-2">
                                    <input type="text" name="updated_by_id" class="form-control" value="{{ Auth::id() }}">
                                    @include('layouts.error', ['name' => 'updated_by_id'])
                                </div>
                            </div>
                        </div>
                        <div class="row p-3">
                            <button class="btn btn-primary btn-block" type="submit"> {{trans('item.btn5') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection