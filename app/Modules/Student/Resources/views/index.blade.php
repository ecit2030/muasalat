@extends('layouts.app')

@section('styles')
    <!-- Data table css -->
    <link href="{{ asset('assets/plugins/datatables/DataTables/css/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables/Buttons/css/buttons.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatables/Responsive/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" />

    <!-- Slect2 css -->
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0 text-primary">المستخدمين</h4>
        </div>
        <div class="page-rightheader">
            <div class="btn-list">
                @if (auth()->user()->isAbleTo(['create_clients']))
                    <a class="btn btn-outline-primary" href="{{ route('admin.clients.create') }}">
                        <i class="fe fe-plus"></i>
                        إضافة
                    </a>
                @endif

            </div>
        </div>
    </div>
    <!--End Page header-->

    <!-- Row -->
    <div class="row">
        <div class="col-12">

            <!--div-->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">المستخدمين</div>
                </div>
                <div class="card-body">
                    <div class="">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">الاسم</th>
                                        <th class="border-bottom-0">البريد الإلكتروني</th>
                                        <th class="border-bottom-0">رقم الهاتف</th>
                                        <th class="border-bottom-0">تاريخ الميلاد</th>
                                        <th class="border-bottom-0">الرصيد</th>
                                        <th class="border-bottom-0">إجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>{{ $client->first_name . ' ' . $client->last_name }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ $client->phone }}</td>
                                            <td>{{ $client->birth_date }}</td>
                                            <td>{{ $client->wallet }}</td>
                                            <td class="d-flex">

                                                @if (auth()->user()->isAbleTo(['read_clients']))
                                                    <a href="{{ route('admin.clients.show', $client->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fe fe-eye"></i></a>
                                                @endif

                                                @if (auth()->user()->isAbleTo(['update_clients']))
                                                    <a href="{{ route('admin.clients.edit', $client->id) }}"
                                                        class="btn btn-primary btn-sm"><i class="fe fe-edit"></i></a>
                                                @endif

                                                @if (auth()->user()->isAbleTo(['delete_clients']))
                                                    <x-button.delete :route="route('admin.clients.destroy', $client->id)" />
                                                @endif


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/div-->

        </div>
    </div>
    <!-- /Row -->
@endsection('content')

@section('scripts')
    <!-- INTERNAL Data tables -->
    <script src="{{ asset('assets/plugins/datatables/DataTables/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/DataTables/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/Buttons/js/dataTables.buttons.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/datatables/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/Responsive/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.js') }}"></script>
@endsection
