@extends('layout.popups')
@section('content')
        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="card" id="demo">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end d-print-none p-2 mt-4">
                                <a href="javascript:window.print()" class="btn btn-success ml-4"><i class="ri-printer-line mr-4"></i> Print</a>
                            </div>
                            <div class="card-header border-bottom-dashed p-4">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h1>{{projectNameHeader()}}</h1>
                                    </div>
                                    <div class="flex-shrink-0 mt-sm-0 mt-3">
                                        <h3>Purchase Ledger</h3>
                                    </div>
                                </div>
                            </div>
                            <!--end card-header-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">From</p>
                                        <h5 class="fs-14 mb-0">{{ date("d M Y", strtotime($from)) }}</h5>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">To</p>
                                        <h5 class="fs-14 mb-0">{{date("d M Y", strtotime($to))}}</h5>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Printed On</p>
                                        <h5 class="fs-14 mb-0"><span id="total-amount">{{ date("d M Y") }}</span></h5>
                                        {{-- <h5 class="fs-14 mb-0"><span id="total-amount">{{ \Carbon\Carbon::now()->format('h:i A') }}</span></h5> --}}
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr class="table-active">
                                                <th scope="col">#</th>
                                                <th scope="col">ID</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Maker</th>
                                                <th scope="col">Model</th>
                                                <th scope="col">Year</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Tax</th>
                                                <th scope="col">Auction Fee</th>
                                                <th scope="col">Auction Tax</th>
                                                <th scope="col">Transport Charges</th>
                                                <th scope="col">Net</th>
                                            </tr>
                                        </thead>
                                        <tbody id="products-list">
                                           
                                        @foreach ($purchases as $key => $purchase)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td> {{$purchase->id}}</td>
                                                <td>{{ date('d M Y', strtotime($purchase->date)) }}</td>
                                                <td>{{$purchase->maker}}</td>
                                                <td>{{$purchase->model}}</td>
                                                <td>{{$purchase->year}}</td>
                                                <td class="text-end">{{ number_format($purchase->price) }}</td>
                                                <td class="text-end">{{ number_format($purchase->ptax) }}</td>
                                                <td class="text-end">{{ number_format($purchase->afee) }}</td>
                                                <td class="text-end">{{ number_format($purchase->atax) }}</td>
                                                <td class="text-end">{{ number_format($purchase->transport_charges) }}</td>
                                                <td class="text-end">{{ number_format($purchase->total) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="6" class="text-end p-1 m-0">Total</th>
                                                <th class="text-end p-1 m-0">{{ number_format($purchases->sum('price')) }}</th>
                                                <th class="text-end p-1 m-0">{{ number_format($purchases->sum('ptax')) }}</th>
                                                <th class="text-end p-1 m-0">{{ number_format($purchases->sum('afee')) }}</th>
                                                <th class="text-end p-1 m-0">{{ number_format($purchases->sum('atax')) }}</th>
                                                <th class="text-end p-1 m-0">{{ number_format($purchases->sum('transport_charges')) }}</th>
                                                <th class="text-end p-1 m-0">{{ number_format($purchases->sum('total')) }}</th>
                                              
                                            </tr>
                                        </tfoot>
                                    </table><!--end table-->
                                </div>
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

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
@endsection

