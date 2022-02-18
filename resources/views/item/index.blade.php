@extends('layouts.app')
@section('title')
{{trans('item.title1') }}
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">

        @include('layouts.notif')

        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">
                {{trans('item.title1') }}
                    <a href="{{ route('items.create') }}" class="btn btn-sm btn-primary float-right">{{trans('item.btn1') }}</a>
                </div>
                <div class="card-body">
                    <br>
                    <!-- MULAI DATE RANGE PICKER -->
                    <div class="row input-daterange">
                        <div class="col-md-6">
                            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="{{trans('item.fromdate') }}" readonly />
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="{{trans('item.todate') }}" readonly />
                        </div>
                        
                    </div>
                    <!-- AKHIR DATE RANGE PICKER -->
                    <br>
                <div class="row">
                        <div class="col-md-6">
                            <input type="text"   class="form-control filter-input" id="name" name="name" placeholder="{{trans('item.filtername') }}" data-column="1"/>
                        </div>
                        <div class="col-md-6">
                            <input type="number"   class="form-control filter-input" id="price" name="price" placeholder="{{trans('item.filterprice') }}" data-column="2"/>
                        </div>
                
                    </div> 
                    <br>
                    <div class="row">
                        <div class="col-md" style="text-align: end">
                            <button type="button" name="filter" id="filter" class="btn btn-primary">{{trans('item.btn6') }}</button>
                            <button type="button" name="refresh" id="refresh" class="btn btn-default">{{trans('item.btn7') }}</button>
                        </div>
                    </div>
                    
                    <br>
                    <table class="table text-center table-bordered table-striped" id="ItemsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> {{trans('item.table1') }} </th>
                                <th> {{trans('item.table2') }} </th>
                                <th> {{trans('item.table3') }} </th>
                                <th> {{trans('item.table4') }} </th>
                                <th> {{trans('item.table5') }} </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>
</div>
@endsection
@section('script')
<!-- MULAI DATEPICKER JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.noConflict();
        var table = $('#ItemsTable').DataTable({
            "processing": true,
            "serverSide": true,
            "dom"       : "lrtpi",
            "responsive": true,
            ajax: {
                url: "{{ route('api.items') }}",
                type: 'GET',
                data: {
                    region:  "{{ Session::get('tz') }}"
                } //jangan lupa kirim parameter tanggal 
            },
            "columns": [{
                    "data": "DT_RowIndex",
                    name: 'DT_RowIndex'
                },
                {
                    "data": "name"
                },
                {
                    "data": "price"
                },
                {
                    "data": "created_at"
                },
                {
                    "data": "updated_at"
                },
                {
                    "data": "action",
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    //     $('.filter-input').keyup(function() {
    //     table.column( $(this).data('column') )
    //     .search( $(this).val() )
    //     .draw();
    // });
    });
    
</script>
<script>


    //jalankan function load_data diawal agar data ter-load
    // load_data();
    //Iniliasi datepicker pada class input
    $('.input-daterange').datepicker({
        todayBtn: 'linked',
        format: 'yyyy-mm-dd',
        autoclose: true
    });
    $('#filter').click(function() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var name = $('#name').val();
        var price = $('#price').val();
        if (from_date != '' && to_date != '') {
            $('#ItemsTable').DataTable().destroy();
            load_data(from_date, to_date,name,price);
        } else {
            $('#ItemsTable').DataTable().destroy();
            load_data('', '',name,price);
        }
    });
    $('#refresh').click(function() {
        $('#from_date').val('');
        $('#to_date').val('');
        $('#name').val('');
        $('#price').val('');
        $('#ItemsTable').DataTable().destroy();
        load_data();
    });



    function load_data(from_date = '', to_date = '', name = '', price = '') {
        var table =$('#ItemsTable').DataTable({
            "processing": true,
            "dom"       : "lrtpi",
            "serverSide": true,
            "responsive": true,
            ajax: {
                url: "{{ route('api.items') }}",
                type: 'GET',
                data: {
                    from_date: from_date,
                    to_date: to_date,
                    name: name,
                    price: price,
                    region:  "{{ Session::get('tz') }}"
                } //jangan lupa kirim parameter tanggal 
            },
            "columns": [{
                    "data": "DT_RowIndex",
                    name: 'DT_RowIndex'
                },
                {
                    "data": "name"
                },
                {
                    "data": "price"
                },
                {
                    "data": "created_at"
                },
                {
                    "data": "updated_at"
                },
                {
                    "data": "action",
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
            
        });
    //     $('.filter-input').keyup(function() {
    //     table.column( $(this).data('column') )
    //     .search( $(this).val() )
    //     .draw();
    // });
    };
</script>
@endsection