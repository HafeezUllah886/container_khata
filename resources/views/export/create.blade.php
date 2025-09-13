@extends('layout.popups')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h3> Create Export </h3>
                                </div>
                                <div class="col-6 d-flex flex-row-reverse"><button onclick="window.close()"
                                        class="btn btn-danger">Close</button></div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="card-body">
                    <form action="{{ route('export.store') }}" method="post">
                        @csrf
                       <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="product">Cars</label>
                                        <select name="product" class="selectize" id="product">
                                            <option value="0"></option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->model }} -
                                                    {{ $product->chassis }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <th width="">Chassis</th>
                                            <th class="text-start">Model</th>
                                            <th width="" class="text-center">Price</th>
                                            <th class="text-center">Remarks</th>
                                            <th></th>
                                        </thead>
                                        <tbody id="products_list"></tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2" class="text-end">Total</th>
                                                <th class="text-end" id="totalPrice">0.00</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="part">Parts</label>
                                        <select name="part" class="selectize2" id="part">
                                            <option value="0"></option>
                                            @foreach ($parts as $part)
                                                <option value="{{ $part->name }}">{{ $part->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <th width="">Part</th>
                                            <th width="" class="text-center">Qty</th>
                                            <th></th>
                                        </thead>
                                        <tbody id="parts_list"></tbody>
                                    </table>
                                </div>
                               
                            </div>
                           
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="row">
                                    <div class="col-6">
                                        <h5> Engines </h5>
                                    </div>
                                    <div class="col-6 d-flex flex-row-reverse"><button type="button" onclick="addEngine()"
                                            class="btn btn-primary">Add</button></div>
                                </div>
                                <div class="col-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <th>Series</th>
                                            <th class="text-center">Model</th>
                                            <th class="text-center">Price</th>
                                            <th></th>
                                        </thead>
                                        <tbody id="engines_list"></tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-end">Total:</td>
                                                <td id="engineTotalPrice" class="text-center">0.00</td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="row">
                                    <div class="col-6">
                                        <h5> Misc </h5>
                                    </div>
                                    <div class="col-6 d-flex flex-row-reverse"><button type="button" onclick="addMisc()"
                                            class="btn btn-primary">Add</button></div>
                                </div>
                                <div class="col-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <th>Description</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Price</th>
                                            <th></th>
                                        </thead>
                                        <tbody id="misc_list"></tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-end">Total:</td>
                                                <td id="miscTotalPrice" class="text-center">0.00</td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="inv_no">Inv #</label>
                                <input type="text" class="form-control" name="inv_no" value="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="c_no">C/No</label>
                                <input type="text" class="form-control" name="c_no" value="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="weight">Weight</label>
                                <input type="number" class="form-control" name="weight" value="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" required name="date" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group mt-2">
                                <label for="consignee">Consignee</label>
                                <select name="consignee" required class="selectize1" id="consignee">
                                    <option value=""></option>
                                    @foreach ($consignees as $consignee)
                                        <option value="{{ $consignee->id }}">{{ $consignee->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group mt-2">
                                <label for="info_party">Info Party</label>
                                <select name="info_party" required class="selectize1" id="info_party">
                                    <option value=""></option>
                                    @foreach ($consignees as $consignee)
                                        <option value="{{ $consignee->id }}">{{ $consignee->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary w-100">Create Export</button>
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
        $(".selectize").selectize({
            onChange: function(value) {
                if (!value.length) return;
                if (value != 0) {
                    getSingleProduct(value);
                    this.clear();
                    this.focus();
                }

            },
        });

        var existingProducts = [];

        function getSingleProduct(id) {
            $.ajax({
                url: "{{ url('export/getproduct/') }}/" + id,
                method: "GET",
                success: function(product) {
                    let found = $.grep(existingProducts, function(element) {
                        return element === product.id;
                    });
                    if (found.length > 0) {

                    } else {
                        var id = product.id;
                        var html = '<tr id="row_' + id + '">';
                        html += '<td class="no-padding text-start">' + product.chassis + '</td>';
                        html += '<td class="no-padding text-start">' + product.model + '</td>';
                        html +=
                            '<td class="no-padding"><input type="number" name="car_price[]" oninput="updateTotal()" required step="any" value="'+product.total+'" min="0" class="form-control text-center" id="price_' +
                            id + '"></td>';
                        html += `<td class="no-padding">
                           <select name="car_remarks[]" class="form-control text-center" id="remarks_${id}">
                            <option value="Complete">Complete</option>
                            <option value="Roof Cut">Roof Cut</option>
                           </select>
                        </td>`;
                        html += '<td> <span class="btn btn-sm btn-danger" onclick="deleteRow(' + id +
                            ')">X</span> </td>';
                        html += '<input type="hidden" name="car_id[]" value="' + id + '">';
                        html += '</tr>';
                        $("#products_list").prepend(html);
                        updateTotal();
                        existingProducts.push(id);
                    }
                }
            });
        }

        function updateTotal() {

            var totalPrice = 0;
            $("input[id^='price_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                totalPrice += parseFloat(inputValue);
            });

            $("#totalPrice").html(totalPrice.toFixed(2));

        }

        function deleteRow(id) {
            existingProducts = $.grep(existingProducts, function(value) {
                return value !== id;
            });
            $('#row_' + id).remove();
            updateTotal();
        }

        $(".selectize2").selectize({
            onChange: function(value) {
                if (!value.length) return;
                if (value != 0) {
                    addPart(value);
                    this.clear();
                    this.focus();
                }

            },
        });

        var existingParts = [];

        function addPart(value) {
            let found = $.grep(existingParts, function(element) {
                return element === value;
            });
            if (found.length > 0) {

            } else {
                var rowId = Math.floor(Math.random() * 100000) + 1;
                var html = '<tr id="row_' + rowId + '">';
                html += '<td class="no-padding text-start">' + value + '</td>';
                html += '<td class="no-padding"><input type="number" name="part_qty[]" required step="any" value="1" min="0" class="form-control text-center" id="qty_' +
                    rowId + '"></td>';
                html += '<td class="no-padding"> <span class="btn btn-sm btn-danger" onclick="deletePart(' + rowId +
                    ')">X</span> </td>';
                html += '<input type="hidden" name="part_name[]" value="' + value + '">';
                html += '</tr>';
                $("#parts_list").prepend(html);
                existingParts.push(value);
            }
        }

        function deletePart(id) {
            var partName = $('#row_' + id + ' input[name="part_name[]"]').val();
            existingParts = $.grep(existingParts, function(value) {
                return value !== partName;
            });
            $('#row_' + id).remove();
        }


        function addEngine() {
            var rowId = 'row_' + Date.now();
            var html = '<tr id="' + rowId + '">';
            html += '<td class="no-padding text-start"><input type="text" class="form-control" name="engine_series[]" value=""></td>';
            html += '<td class="no-padding"><input type="text" class="form-control" name="engine_model[]" value=""></td>';
            html += '<td class="no-padding"><input type="number" class="form-control" name="engine_price[]" id="engine_price_' + rowId + '" oninput="updateEngineTotal(' + rowId +')" value="0"></td>';
            html += '<td class="no-padding"> <span class="btn btn-sm btn-danger" onclick="deleteRowEngine(\'' + rowId + '\')">X</span> </td>';
            html += '</tr>';
            $("#engines_list").append(html);
        }
        
        function deleteRowEngine(rowId) {
            $('#' + rowId).remove();
        }

        function updateEngineTotal(rowId) {
            var totalEnginePrice = 0;
            $("input[id^='engine_price_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                totalEnginePrice += parseFloat(inputValue);
            });
            $("#engineTotalPrice").html(totalEnginePrice.toFixed(2));
        }

        function addMisc() {
            var rowId = 'row_' + Date.now();
            var html = '<tr id="' + rowId + '">';
            html += '<td class="no-padding text-start"><input type="text" class="form-control" name="misc_description[]" value=""></td>';
            html += '<td class="no-padding"><input type="text" class="form-control" name="misc_qty[]" id="misc_qty_' + rowId + '" oninput="updateMiscTotal(' + rowId +')" value=""></td>';
            html += '<td class="no-padding"><input type="number" class="form-control" name="misc_price[]" id="misc_price_' + rowId + '" oninput="updateMiscTotal(' + rowId +')" value=""></td>';
            html += '<td class="no-padding"> <span class="btn btn-sm btn-danger" onclick="deleteRowMisc(\'' + rowId + '\')">X</span> </td>';
            html += '</tr>';
            $("#misc_list").append(html);
        }
        
        function deleteRowMisc(rowId) {
            $('#' + rowId).remove();
        }

        function updateMiscTotal(rowId) {
            var totalMiscPrice = 0;
            $("input[id^='misc_price_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                totalMiscPrice += parseFloat(inputValue);
            });
            $("#miscTotalPrice").html(totalMiscPrice.toFixed(2));
        }

        $(".selectize1").selectize();
    </script>
@endsection
