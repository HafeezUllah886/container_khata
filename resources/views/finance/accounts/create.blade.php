@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Create Account</h3>
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
                    <form action="{{ route('account.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title">Account Title</label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mt-2">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="Consignee">Consignee</option>
                                        <option value="Transporter">Transporter</option>
                                        <option value="Bank">Bank</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 mt-2" >
                                <div class="form-group consignee transporter">
                                    <label for="tel">Tel #</label>
                                    <input type="text" name="tel" id="tel" value="{{ old('tel') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-6 mt-2" >
                                <div class="form-group consignee transporter">
                                    <label for="email">Email #</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-6 mt-2 consignee" >
                                <div class="form-group">
                                    <label for="address_one">Address Line One</label>
                                    <input type="text" name="address_one" id="address_one" value="{{ old('address_one') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-6 mt-2 consignee" >
                                <div class="form-group">
                                    <label for="address_two">Address Line Two</label>
                                    <input type="text" name="address_two" id="address_two" value="{{ old('address_two') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-6 mt-2 consignee" >
                                <div class="form-group">
                                    <label for="license">License #</label>
                                    <input type="text" name="license" id="license" value="{{ old('license') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-6 mt-2 consignee" >
                                <div class="form-group">
                                    <label for="po_box">PO Box</label>
                                    <input type="text" name="po_box" id="po_box" value="{{ old('po_box') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-secondary w-100">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Default Modals -->
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/libs/selectize/selectize.min.css') }}">
@endsection
@section('page-js')
<script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script>
        $(".customer").hide();
        $(".selectize").selectize();
        $("#type").on("change",  function (){
            var type = $("#type").find(":selected").val();

            if(type === "Consignee")
            {
                $(".transporter").hide();
                $(".consignee").show();
            }
            else if(type === "Transporter")
            {
               
                $(".consignee").hide();
                $(".transporter").show();
            }
            else
            {
                $(".consignee").hide();
                $(".transporter").hide();
            }
        });
    </script>
@endsection
