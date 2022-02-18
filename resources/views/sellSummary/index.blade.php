@extends('layouts.app')
@section('title')
    {{ trans('sellSummary.title1') }}
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @include('layouts.notif')

            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        {{ trans('sellSummary.title1') }}
                    </div>
                    <div class="card-body">
                        <br>
                        <!-- MULAI DATE RANGE PICKER -->
                        <div class="row input-daterange">
                            <div class="col-md-6">
                                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="{{ trans('sellSummary.fromdate') }}
        " readonly />
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="{{ trans('sellSummary.todate') }}
        " readonly />
                            </div>
                            
                        </div>
                        <!-- AKHIR DATE RANGE PICKER -->
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <input list="company" type="text" class="form-control filter-input" id="company_name"
                                    name="company_name" placeholder="{{ trans('sellSummary.filtercompany') }}"
                                    data-column="2" />
                                <datalist data-column="2" id="company">
                                    <option value="">{{ trans('sellSummary.filtercompany') }}
                                    </option>
                                    @forelse ($companies as $companie)
                                        <option value="{{ $companie->name }}">{{ $companie->name }}</option>
                                    @empty
                                        <option value="" selected>{{ trans('sellSummary.status1') }}
                                        </option>
                                    @endforelse
                                </datalist>
                            </div>
                            <div class="col-md-4">
                                <input list="employee_fn" type="text" class="form-control filter-input" id="first_name"
                                    name="first_name" placeholder="{{ trans('sellSummary.filterfirstname') }}"
                                    data-column="3" />
                                <datalist data-column="3" id="employee_fn">
                                    <option value="">{{ trans('sellSummary.filtername') }}</option>
                                    @forelse ($employees as $employee)
                                        <option value="{{ $employee->first_name }}">{{ $employee->first_name }}
                                        </option>
                                    @empty
                                        <option value="" selected>{{ trans('sellSummary.status1') }}</option>
                                    @endforelse
                                </datalist>
                            </div>
                            <div class="col-md-4">
                                <input list="employee_ln" type="text" class="form-control filter-input" id="last_name"
                                    name="last_name" placeholder="{{ trans('sellSummary.filterlastname') }}"
                                    data-column="3" />
                                <datalist data-column="3" id="employee_ln">
                                    <option value="">{{ trans('sellSummary.filtername') }}</option>
                                    @forelse ($employees as $employee)
                                        <option value="{{ $employee->last_name }}">{{ $employee->last_name }}
                                        </option>
                                    @empty
                                        <option value="" selected>{{ trans('sellSummary.status1') }}</option>
                                    @endforelse
                                </datalist>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md" style="text-align: end">
                                <button type="button" name="filter" id="filter"
                                    class="btn btn-primary">{{ trans('sellSummary.btn2') }}
                                </button>
                                <button type="button" name="refresh" id="refresh"
                                    class="btn btn-default">{{ trans('sellSummary.btn3') }}
                                </button>
                            </div>
                        </div>
                        <br>
                        <table class="table text-center table-bordered table-striped" id="SellSummariesTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('sellSummary.table1') }}</th>
                                    <th>{{ trans('sellSummary.table2') }}</th>
                                    <th>{{ trans('sellSummary.table3') }}</th>
                                    <th>{{ trans('sellSummary.table4') }}</th>
                                    <th>{{ trans('sellSummary.table5') }}</th>
                                    <th>{{ trans('sellSummary.table6') }}</th>
                                    <th>{{ trans('sellSummary.table7') }}</th>
                                    <th>{{ trans('sellSummary.table8') }}</th>
                                    <th>{{ trans('sellSummary.table9') }}</th>
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
            var table = $('#SellSummariesTable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": "lrtpi",
                "responsive": true,
                ajax: {
                    url: "{{ route('api.sellSummaries') }}",
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
                        "data": "date",
                        name: 'action'
                    },
                    {
                        "data": "company"
                    },
                    {
                        "data": "employee.first_name"
                    },
                    {
                        "data": "employee.last_name"
                    },
                    {
                        "data": "created_at"
                    },
                    {
                        "data": "updated_at"
                    },
                    {
                        "data": "price_total"
                    },
                    {
                        "data": "discount_total"
                    },
                    {
                        "data": "total"
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
            var company_name = $('#company_name').val();
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            if (from_date != '' && to_date != '') {
                $('#SellSummariesTable').DataTable().destroy();
                load_data(from_date, to_date,company_name,first_name,last_name);
            } else {
                $('#from_date').val('');
                $('#to_date').val('');
                $('#SellSummariesTable').DataTable().destroy();
                load_data('', '',company_name,first_name,last_name);
            }
        });
        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#company_name').val('');
            $('#first_name').val('');
            $('#last_name').val('');
            $('#SellSummariesTable').DataTable().destroy();
            load_data();
        });



        function load_data(from_date = '', to_date = '', company_name = '', first_name = '', last_name = '') {
            var table = $('#SellSummariesTable').DataTable({
                "processing": true,
                "dom": "lrtpi",
                "serverSide": true,
                "responsive": true,
                ajax: {
                    url: "{{ route('api.sellSummaries') }}",
                    type: 'GET',
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        company_name: company_name,
                        first_name: first_name,
                        last_name: last_name,
                        region: "{{ Session::get('tz') }}"
                    } //jangan lupa kirim parameter tanggal 
                },
                "columns": [{
                        "data": "DT_RowIndex",
                        name: 'DT_RowIndex'
                    },
                    {
                        "data": "date"
                    },
                    {
                        "data": "company"
                    },
                    {
                        "data": "employee.first_name"
                    },
                    {
                        "data": "employee.last_name"
                    },
                    {
                        "data": "created_at"
                    },
                    {
                        "data": "updated_at"
                    },
                    {
                        "data": "price_total"
                    },
                    {
                        "data": "discount_total"
                    },
                    {
                        "data": "total"
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
