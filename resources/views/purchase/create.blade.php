@extends('layout.popups')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6"><h3> Create Purchase </h3></div>
                                <div class="col-6 d-flex flex-row-reverse"><button onclick="window.close()" class="btn btn-danger">Close</button></div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="card-body">
                    <form action="{{ route('purchase.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="date">Purchase Date</label>
                                    <input type="date" name="date" id="date" value="{{ isset($lastpurchase) && $lastpurchase->date ? date('Y-m-d', strtotime($lastpurchase->date)) : date('Y-m-d') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="auction">Auction</label>
                                    <select name="auction" id="auction" required class="form-control">
                                        <option value="">Select Auction</option>
                                        @foreach ($auctions as $auction)
                                            <option value="{{ $auction->name }}" @selected(old('auction') == $auction->name)>{{ $auction->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="engine">Engine No.</label>
                                    <input type="text" name="engine" id="engine" value="{{ old('engine') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="chessis">Chassis No.</label>
                                    <input type="text" name="chassis" id="chessis" required value="{{ old('chassis') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="maker">Maker</label>
                                    <input type="text" name="maker" id="maker" value="{{ old('maker') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="model">Model</label>
                                    <input type="text" name="model" id="model" value="{{ old('model') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="year">Year</label>
                                    <input type="text" name="year" id="year" value="{{ old('year') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="price">Price</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="price" id="price" oninput="updateChanges()" value="{{ old('price') ?? 0 }}" class="form-control">
                                        <input type="number" name="ptax" id="ptax" readonly value="{{ old('ptax') ?? 0 }}" class="form-control input-group-text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="transport_charges">Transport Charges</label>
                                    <input type="number" name="transport_charges" id="transport_charges" oninput="updateChanges()" value="{{ old('transport_charges') ?? 0 }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="total">Total</label>
                                    <input type="number" name="total" value="{{ old('total') ?? 0 }}" readonly id="total" class="form-control">
                                </div>
                            </div>                        
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="conversion_rate">Conversion Rate</label>
                                    <input type="number" name="conversion_rate" id="conversion_rate" min="0" oninput="convertToDirham()" step="any" value="{{ $rate }}" required class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="net_dirham">Net Dirham</label>
                                    <input type="number" name="net_dirham" id="net_dirham" readonly value="0" required class="form-control">
                                </div>
                            </div>                     
                                                 
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="ddate">Document Received Date</label>
                                    <input type="date" name="ddate" id="ddate" value="{{ old('ddate') ? date('Y-m-d' , strtotime(old('ddate'))) : '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="adate">Arrival Date</label>
                                    <input type="date" name="adate" id="adate" value="{{ old('adate') ? date('Y-m-d' , strtotime(old('adate'))) : '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="number_plate">Number Plate</label>
                                    <input type="text" name="number_plate" id="number_plate" value="{{ old('number_plate') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="nvalidity">Number Plate Validity</label>
                                    <input type="date" name="nvalidity" id="nvalidity" value="{{ old('nvalidity') ? date('Y-m-d' , strtotime(old('nvalidity'))) : '' }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group mt-2">
                                    <label for="notes">Notes</label>
                                    <textarea name="notes" id="notes" class="form-control" cols="30" rows="5">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-primary w-100">Create Purchase</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    </div>
    <!--end row-->
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/libs/selectize/selectize.min.css') }}">
    <style>
        .no-padding {
            padding: 5px 5px !important;
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-js')
    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script>
        function updateChanges() {
            var price = parseFloat($('#price').val());
            var ptax = parseFloat($('#ptax').val());
            var transport_charges = parseFloat($('#transport_charges').val());

            var pTaxValue = price * 10 / 100;

            var amount = (price + pTaxValue + transport_charges);

            $("#ptax").val(pTaxValue.toFixed(2));
            $("#total").val(amount.toFixed(2));
            convertToDirham();

        }

        $(document).ready(function () {
    $('input, select, textarea').on('keypress', function (e) {
        // Check if the Enter key is pressed
        if (e.which === 13) {
            e.preventDefault(); // Prevent the default Enter key behavior

            // Find all focusable elements in the form, excluding readonly fields
            const focusable = $(this)
                .closest('form')
                .find('input:not([readonly]), select:not([readonly]), textarea:not([readonly]), button')
                .filter(':visible');

            // Determine the current element's index
            const index = focusable.index(this);

            // Move to the next focusable element
            if (index > -1 && index < focusable.length - 1) {
                focusable.eq(index + 1).focus();
            }
        }
    });
});


function convertToDirham() {
           var total = $('#total').val();
           var conversion_rate = $('#conversion_rate').val();
           var net_dirham = parseFloat(total) * parseFloat(conversion_rate);
           $('#net_dirham').val(net_dirham.toFixed(0));
       }

    </script>
@endsection
