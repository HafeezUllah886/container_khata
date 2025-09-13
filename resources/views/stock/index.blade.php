@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Stock ({{$filter}}) Total: {{ $purchases->count() }}</h3>
                    
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <table class="table" id="buttons-datatables">
                    <thead>
                        <th>#</th>
                        <th>P_Date</th>
                        <th>Year</th>
                        <th>Maker</th>
                        <th>Model</th>
                        <th>Chassis</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $key => $purchase)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ date('d M Y', strtotime($purchase->date)) }}</td>
                                <td>{{ $purchase->year }}</td>
                                <td>{{ $purchase->maker }}</td>
                                <td>{{ $purchase->model }}</td>
                                <td>{{ $purchase->chassis }}</td>
                                <td>{{ $purchase->total }}</td>
                                <td><span class="badge {{$purchase->status == "Available" ? "bg-success" : "bg-danger"}}">{{$purchase->status}}</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <button class="dropdown-item" onclick="newWindow('{{route('purchase.show', $purchase->id)}}')"
                                                    onclick=""><i
                                                        class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                    View
                                                </button>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tbody>
                        <th colspan="6" class="text-end">Total</th>
                        <th>{{$purchases->sum('total')}}</th>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Default Modals -->

  
@endsection
@section('page-css')
<link rel="stylesheet" href="{{ asset('assets/libs/datatable/datatable.bootstrap5.min.css') }}" />
<!--datatable responsive css-->
<link rel="stylesheet" href="{{ asset('assets/libs/datatable/responsive.bootstrap.min.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/libs/datatable/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/selectize/selectize.min.css') }}">
@endsection

@section('page-js')
<script src="{{ asset('assets/libs/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/jszip.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>

@endsection
