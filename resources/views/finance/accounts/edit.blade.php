@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Edit Account</h3>
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
                    <form action="{{ route('account.update', $account->id) }}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="type" value="{{$account->type}}">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title">Account Title</label>
                                    <input type="text" name="title" id="title" value="{{ $account->title }}"
                                        class="form-control">
                                </div>
                            </div>
                            @if($account->type != 'Bank')
                            <div class="col-6 mt-2" >
                                <div class="form-group">
                                    <label for="tel">Tel #</label>
                                    <input type="text" name="tel" id="tel" value="{{ $account->tel }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-6 mt-2" >
                                <div class="form-group">
                                    <label for="email">Email #</label>
                                    <input type="email" name="email" id="email" value="{{ $account->email }}"
                                        class="form-control">
                                </div>
                            </div>
                            @endif
                           
                           
                           @if($account->type == 'Consignee')
                           <div class="col-6 mt-2" >
                            <div class="form-group">
                                <label for="address_one">Address Line One</label>
                                <input type="text" name="address_one" id="address_one" value="{{ $account->address_one }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-6 mt-2" >
                            <div class="form-group">
                                <label for="address_two">Address Line Two</label>
                                <input type="text" name="address_two" id="address_two" value="{{ $account->address_two }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-6 mt-2" >
                            <div class="form-group">
                                <label for="license">License #</label>
                                <input type="text" name="license" id="license" value="{{ $account->license }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-6 mt-2" >
                            <div class="form-group">
                                <label for="po_box">PO Box</label>
                                <input type="text" name="po_box" id="po_box" value="{{ $account->po_box }}"
                                    class="form-control">
                            </div>
                        </div>
                           @endif
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-secondary w-100">Update</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Default Modals -->


@endsection
