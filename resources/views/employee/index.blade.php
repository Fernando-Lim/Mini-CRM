@extends('layouts.app')
@section('title')
    {{ __('employee.title1') }}
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @include('layouts.notif')

            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        {{ __('employee.title1') }}
                        <a href="{{ route('employees.create') }}"
                            class="btn btn-sm btn-primary float-right">{{ __('employee.btn1') }}</a>
                    </div>
                    <div class="card-body">
                        <br>
                        <!-- MULAI DATE RANGE PICKER -->
                        <div class="row input-daterange">
                            <div class="col-md-6">
                                <input type="text" name="from_date" id="from_date" class="form-control"
                                    placeholder="{{ __('employee.fromdate') }}" readonly />
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="to_date" id="to_date" class="form-control"
                                    placeholder="{{ __('employee.todate') }}" readonly />
                            </div>
                            
                        </div>
                        <!-- AKHIR DATE RANGE PICKER -->
                        <br>
                        <div class="row">
                            <div class="col-md-2">
                                <input type="text" class="form-control filter-input" id="first_name" name="first_name"
                                    placeholder="{{ __('employee.filterfirstname') }}" data-column="1" />
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control filter-input" id="last_name" name="last_name"
                                    placeholder="{{ __('employee.filterlastname') }}" data-column="2" />
                            </div>

                            <div class="col-md-3  companie-select">
                                <select name="companie_id" id="companie_id" class="form-control">
                                    <option value="">{{ trans('employee.filtercompany') }}</option>
                                    @forelse ($companies as $companie)
                                        <option value="{{ $companie->id }}">{{ $companie->name }}</option>
                                    @empty
                                        <option value="" selected>{{ trans('sell.status1') }}</option>
                                    @endforelse
                                </select>
                                @include('layouts.error', ['name' => 'item_id'])
                            </div>

                            <div class="col-md-3">
                                <input type="text" class="form-control filter-input" id="email" name="email"
                                    placeholder="{{ __('employee.filteremail') }}" data-column="4" />
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control filter-input" id="phone_number" name="phone_number"
                                    placeholder="{{ __('employee.filterphonenumber') }}" data-column="5" />
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md" style="text-align: end">
                                <button type="button" name="filter" id="filter"
                                    class="btn btn-primary">{{ __('employee.btn6') }}</button>
                                <button type="button" name="refresh" id="refresh"
                                    class="btn btn-default">{{ __('employee.btn7') }}</button>
                            </div>
                        </div>

                        <br>
                        <table class="table text-center table-bordered table-striped" id="EmployeesTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('employee.table1') }}</th>
                                    <th>{{ __('employee.table2') }}</th>
                                    <th>{{ __('employee.table3') }}</th>
                                    <th>{{ __('employee.table4') }}</th>
                                    <th>{{ __('employee.table5') }}</th>
                                    <th>{{ __('employee.table6') }}</th>
                                    <th>{{ __('employee.table7') }}</th>
                                    <th>{{ __('employee.table8') }}</th>
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
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.noConflict();
            var table = $('#EmployeesTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": "lrtpi",
                "responsive": true,
                ajax: {
                    url: "{{ route('api.employees') }}",
                    type: 'GET',
                    data: {
                        region: "{{ Session::get('tz') }}"
                    }
                },
                "columns": [{
                        "data": "DT_RowIndex",
                        name: 'DT_RowIndex'
                    },
                    {
                        "data": "first_name"
                    },
                    {
                        "data": "last_name"
                    },
                    {
                        "data": "companie.name"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "phone"
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
            // $('.filter-input').keyup(function() {
            //     table.column($(this).data('column'))
            //         .search($(this).val())
            //         .draw();
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
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var companie_id = $('#companie_id').val();
            var email = $('#email').val();
            var phone_number = $('#phone_number').val();
            if (from_date != '' && to_date != '') {
                $('#EmployeesTable').DataTable().destroy();
                load_data(from_date, to_date,first_name,last_name,companie_id,email,phone_number);
            } else {
                $('#from_date').val('');
                $('#to_date').val('');
                $('#EmployeesTable').DataTable().destroy();
                load_data('', '',first_name,last_name,companie_id,email,phone_number);
            }
        });
        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#first_name').val('');
            $('#last_name').val('');
            $('#companie_id').val('');
            $('#email').val('');
            $('#phone_number').val('');
            $('#EmployeesTable').DataTable().destroy();
            load_data();
        });



        function load_data(from_date = '', to_date = '', first_name = '', last_name = '', companie_id = '', email = '',
            phone_number = '') {
            var table = $('#EmployeesTable').DataTable({
                "processing": true,
                "dom": "lrtpi",
                "serverSide": true,
                "responsive": true,
                ajax: {
                    url: "{{ route('api.employees') }}",
                    type: 'GET',
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        first_name: first_name,
                        last_name: last_name,
                        companie_id: companie_id,
                        email: email,
                        phone_number: phone_number,
                        region: "{{ Session::get('tz') }}"
                    } //jangan lupa kirim parameter tanggal 
                },
                "columns": [{
                        "data": "DT_RowIndex",
                        name: 'DT_RowIndex'
                    },
                    {
                        "data": "first_name"
                    },
                    {
                        "data": "last_name"
                    },
                    {
                        "data": "companie.name"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "phone"
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
            // $('.filter-input').keyup(function() {
            //     table.column($(this).data('column'))
            //         .search($(this).val())
            //         .draw();
            // });
        };
    </script>
@endsection
