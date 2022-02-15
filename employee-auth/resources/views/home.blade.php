@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        <br>
                        <!-- MULAI DATE RANGE PICKER -->
                        <div class="row input-daterange">
                            <div class="col-md-4">
                                <input type="text" name="from_date" id="from_date" class="form-control"
                                    placeholder="From Date" readonly />
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date"
                                    readonly />
                            </div>
                            <div class="col-md-4">
                                <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                                <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                            </div>
                        </div>
                        <!-- AKHIR DATE RANGE PICKER -->
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control filter-input" placeholder="First Name"
                                    data-column="1" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control filter-input" placeholder="Last Name"
                                    data-column="2" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control filter-input" placeholder="Email" data-column="3" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control filter-input" placeholder="Phone Number"
                                    data-column="4" />
                            </div>
                        </div>
                        <br>
                        <table class="table text-center table-bordered table-striped" id="EmployeesTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    @endsection


    @section('script')
        <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc="
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
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
                            companyid: "{{Auth::user()->companie_id ?? 0}}"
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
                            "data": "email"
                        },
                        {
                            "data": "phone"
                        },
                        {
                            "data": "created_at"
                        }
                    ]
                });
                $('.filter-input').keyup(function() {
                    table.column($(this).data('column'))
                        .search($(this).val())
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
                    $('#EmployeesTable').DataTable().destroy();
                    load_data(from_date, to_date);
                } else {
                    alert('Both Date is required');
                }
            });
            $('#refresh').click(function() {
                $('#from_date').val('');
                $('#to_date').val('');
                $('#EmployeesTable').DataTable().destroy();
                load_data();
            });



            function load_data(from_date = '', to_date = '') {
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
                            companyid: "{{Auth::user()->companie_id ?? 0}}"
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
                            "data": "email"
                        },
                        {
                            "data": "phone"
                        },
                        {
                            "data": "created_at"
                        }
                    ]
                });
                $('.filter-input').keyup(function() {
                    table.column($(this).data('column'))
                        .search($(this).val())
                        .draw();
                });
            };
        </script>

    @endsection
