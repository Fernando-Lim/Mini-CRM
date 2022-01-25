@extends('layouts.app')
@section('title')
{{ __('companie.title1') }}
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">

        @include('layouts.notif')

        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">
                    {{ __('companie.title1') }}
                    <a href="{{ route('companies.create') }}" class="btn btn-sm btn-primary float-right">{{ __('companie.btn1') }}</a>
                </div>
                <div class="card-body">
                    <br>
                    <!-- MULAI DATE RANGE PICKER -->
                    <div class="row input-daterange">
                        <div class="col-md-4">
                            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="{{ __('companie.fromdate') }}" readonly />
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="{{ __('companie.todate') }}" readonly />
                        </div>
                        <div class="col-md-4">
                            <button type="button" name="filter" id="filter" class="btn btn-primary">{{ __('companie.btn6') }}</button>
                            <button type="button" name="refresh" id="refresh" class="btn btn-default">{{ __('companie.btn7') }}</button>
                        </div>
                    </div>
                    <!-- AKHIR DATE RANGE PICKER -->
                    <br>
                <div class="row">
                        <div class="col-md-4">
                            <input type="text"   class="form-control filter-input" placeholder="{{ __('companie.filtername') }}" data-column="1"/>
                        </div>
                        <div class="col-md-4">
                            <input type="text"   class="form-control filter-input" placeholder="{{ __('companie.filteremail') }}" data-column="2"/>
                        </div>
                        <div class="col-md-4">
                            <input type="text"   class="form-control filter-input" placeholder="{{ __('companie.filterwebsite') }}" data-column="4"/>
                        </div>
                
                    </div> 
                    
                    <br>
                    <table class="table text-center table-bordered table-striped" id="CompaniesTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('companie.table1') }}</th>
                                <th>{{ __('companie.table2') }}</th>
                                <th>{{ __('companie.table3') }}</th>
                                <th>{{ __('companie.table4') }}</th>
                                <th>{{ __('companie.table5') }}</th>
                                <th>{{ __('companie.table6') }}</th>
                                <th>{{ __('companie.table7') }}</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.noConflict();
        var table = $('#CompaniesTable').DataTable({
            "processing": true,
            "serverSide": true,
            "dom"       : "lrtpi",
            "responsive": true,
            ajax: {
                url: "{{ route('api.companies') }}",
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
                    "data": "email"
                },
                {
                    "data": "image",
                    name: 'image',
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "website"
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
        $('.filter-input').keyup(function() {
        table.column( $(this).data('column') )
        .search( $(this).val() )
        .draw();
    });
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
        if (from_date != '' && to_date != '') {
            $('#CompaniesTable').DataTable().destroy();
            load_data(from_date, to_date);
        } else {
            alert('Both Date is required');
        }
    });
    $('#refresh').click(function() {
        $('#from_date').val('');
        $('#to_date').val('');
        $('#CompaniesTable').DataTable().destroy();
        load_data();
    });



    function load_data(from_date = '', to_date = '') {
        var table =$('#CompaniesTable').DataTable({
            "processing": true,
            "dom"       : "lrtpi",
            "serverSide": true,
            "responsive": true,
            ajax: {
                url: "{{ route('api.companies') }}",
                type: 'GET',
                data: {
                    from_date: from_date,
                    to_date: to_date,
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
                    "data": "email"
                },
                {
                    "data": "image",
                    name: 'image',
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "website"
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
        $('.filter-input').keyup(function() {
        table.column( $(this).data('column') )
        .search( $(this).val() )
        .draw();
    });
    };
</script>
@endsection