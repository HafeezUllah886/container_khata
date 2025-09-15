@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <form action="{{ route('dashboard') }}" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <input type="date" name="from" onchange="this.form.submit()" value="{{ $from }}"
                            class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="to" onchange="this.form.submit()" value="{{ $to }}"
                            class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addAmountModal"
                            class="btn btn-primary w-100">Add Amount</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#receiveUaeModal"
                            class="btn btn-success w-100">Receive UAE</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('print', ['from' => $from, 'to' => $to]) }}" class="btn btn-info w-100">Print</a>
                    </div>
                </div>
            </form>
            <div class="card crm-widget mt-3">
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Credit</th>
                            <th>Debit</th>
                            <th>Balance</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Previous Balance</td>
                                <td></td>
                                <td></td>
                                <td>{{ number_format($pre_balance) }}</td>
                                <td></td>
                            </tr>
                            @php
                                $balance = $pre_balance;
                            @endphp
                            @foreach ($transactions as $transaction)
                                @php
                                    $balance += $transaction->cr;
                                    $balance -= $transaction->db;
                                    $transaction->date = date('d M Y', strtotime($transaction->date));

                                    if ($transaction->cr > 0) {
                                        $notes = "Container # " . $transaction->container . " : " . $transaction->notes;
                                    }
                                    if ($transaction->db > 0) {
                                        $notes = "Received UAE " . number_format($transaction->uae) . " Rate " . number_format($transaction->rate, 2) . " : " . $transaction->notes;
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->date }}</td>
                                    <td>{{ $notes }}</td>
                                    <td>{{ number_format($transaction->cr) }}</td>
                                    <td>{{ number_format($transaction->db) }}</td>
                                    <td>{{ number_format($balance) }}</td>
                                    <td>

                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#editModal_{{ $transaction->id }}"
                                            class="btn btn-primary btn-sm"><i class="ri-edit-line"></i></button> -

                                        <a href="{{ route('delete-transaction', [$transaction->id, $from, $to]) }}"
                                            class="btn btn-danger btn-sm"><i class="ri-delete-bin-line"></i></a>
                                    </td>
                                </tr>
                                @if ($transaction->cr > 0)
                                <div id="editModal_{{ $transaction->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                                    aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Edit Container Amount</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"> </button>
                                            </div>
                                            <form action="{{ route('edit-amount', $transaction->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group mt-2">
                                                        <label for="container">Container #</label>
                                                        <input type="text" name="containerID" id="container" value="{{ $transaction->container }}" required
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="amount">Amount</label>
                                                        <input type="number" name="amount" required id="amount" value="{{ $transaction->cr }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="date">Date</label>
                                                        <input type="date" name="date" required id="date"
                                                            value="{{ date('Y-m-d', strtotime($transaction->date)) }}" class="form-control">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="notes">Notes</label>
                                                        <textarea name="notes" id="notes" cols="30" class="form-control" rows="5">{{ $transaction->notes }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                @endif
                                @if ($transaction->db > 0)
                                <div id="editModal_{{ $transaction->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                                    aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Edit Receive UAE</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"> </button>
                                            </div>
                                            <form action="{{ route('edit-receive-uae', $transaction->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group mt-2">
                                                        <label for="uae">UAE</label>
                                                        <input type="number" name="uae" required id="uae1" oninput="updateAmount1()" value="{{ $transaction->uae }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="rate">Rate</label>
                                                        <input type="number" name="rate" value="{{ $transaction->rate }}" oninput="updateAmount1()" required
                                                            id="rate1" class="form-control">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="amount_pkr">Amount</label>
                                                        <input type="number" name="amount_pkr" readonly id="amount_pkr1" value="{{ $transaction->db }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="date">Date</label>
                                                        <input type="date" name="date" required id="date"
                                                            value="{{ date('Y-m-d', strtotime($transaction->date)) }}" class="form-control">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="notes">Notes</label>
                                                        <textarea name="notes" id="notes" cols="30" class="form-control" rows="5">{{ $transaction->notes }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="addAmountModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Add Container Amount</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form action="{{ route('add-amount') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <label for="container">Container #</label>
                            <input type="text" name="containerID" id="container" required class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" required id="amount" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="date">Date</label>
                            <input type="date" name="date" required id="date" value="{{ date('Y-m-d') }}"
                                class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="notes">Notes</label>
                            <textarea name="notes" id="notes" cols="30" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="receiveUaeModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Receive UAE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form action="{{ route('receive-uae') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <label for="uae">UAE</label>
                            <input type="number" name="uae" oninput="updateAmount()" required id="uae" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="rate">Rate</label>
                            <input type="number" name="rate" value="1" oninput="updateAmount()" required id="rate"
                                class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="amount_pkr">Amount</label>
                            <input type="number" name="amount_pkr" readonly id="amount_pkr" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="date">Date</label>
                            <input type="date" name="date" required id="date" value="{{ date('Y-m-d') }}"
                                class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="notes">Notes</label>
                            <textarea name="notes" id="notes" cols="30" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('page-css')
@endsection
@section('page-js')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script>
        $(document).ready(function() {
            function updateAmount() {
                var uae = $('#uae').val();
                var rate = $('#rate').val();
                var amount = uae * rate;
                $('#amount_pkr').val(amount);
            }
           
       
            function updateAmount1() {
                var uae = $('#uae1').val();
                var rate = $('#rate1').val();
                var amount = uae * rate;
                $('#amount_pkr1').val(amount);
            }
            
        });
    </script>
@endsection
