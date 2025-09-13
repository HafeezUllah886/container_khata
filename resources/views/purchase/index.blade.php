@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <form>
                <div class="row">
                    <div class="col-md-5">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">From</span>
                            <input type="date" class="form-control" id="start" placeholder="Username" name="start" value="{{$start}}" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">To</span>
                            <input type="date" class="form-control" id="end" placeholder="Username" name="end" value="{{$end}}" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-md-2">
                       <input type="submit" value="Filter" class="btn btn-success w-100">
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Purchases</h3>
                    <div>
                        <a id="export-btn" class="btn btn-info">Export to Excel</a>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">Import from Excel</button>
                    <button type="button" class="btn btn-primary" onclick="newWindow('{{ route('purchase.create') }}')" >Create New</button>
                    </div>

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
                            <th>Yen</th>
                            <th>Dirham</th>
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
                                    <td>{{ number_format($purchase->total) }}</td>
                                    <td>{{ number_format($purchase->net_dirham) }}</td>
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
                                                @if($purchase->status == "Available")
                                                <li>
                                                    <a class="dropdown-item" onclick="newWindow('{{route('purchase.edit', $purchase->id)}}')">
                                                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="{{route('purchases.delete', $purchase->id)}}">
                                                        <i class="ri-delete-bin-2-fill align-bottom me-2 text-danger"></i>
                                                        Delete
                                                    </a>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tbody>
                            <th colspan="6" class="text-end">Total</th>
                            <th>{{number_format($purchases->sum('total'))}}</th>
                            <th>{{number_format($purchases->sum('net_dirham'))}}</th>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Purchases</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('purchases.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Choose Excel File | <a href="{{route('download.sample')}}">Download Sample File</a></label>
                            <input type="file" required name="excel" id="excel" accept=".xlsx" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
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
@endsection
@section('page-js')
    <script src="{{ asset('assets/libs/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.print.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/vfs_fonts.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatable/jszip.min.js')}}"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#export-btn').click(function() {
                var start = $('#start').val();
                var end = $('#end').val();
                var url = '{{ route("purchases.export") }}' + '?start=' + start + '&end=' + end;
                window.open(url, '_blank');
            });
        });
    </script>
@endsection

