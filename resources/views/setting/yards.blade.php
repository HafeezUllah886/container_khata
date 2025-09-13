@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Yards</h3>
                    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#new">Create
                        New</button>
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
                            <th>Yard ID</th>
                            <th>Yard Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($yards as $key => $yard)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $yard->id }} </td>
                                    <td>{{ $yard->name }} </td>
                                    <td>{{ $yard->address }} </td>
                                    <td>{{ $yard->contact }} </td>
                                    <td>
                                        <span data-bs-toggle="modal" data-bs-target="#edit_{{ $yard->id }}"
                                            class="btn btn-primary">Edit</span>
                                    </td>
                                </tr>
                                <div class="modal fade" id="edit_{{ $yard->id }}" tabindex="-1"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Edit Yard</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"> </button>
                                            </div>
                                            <form action="{{ route('yards.update', $yard->id) }}"
                                                enctype="multipart/form-data" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group mt-2">
                                                        <label for="name">Yard Name</label>
                                                        <input type="text" name="name" id="name"
                                                            value="{{ $yard->name }}" required class="form-control">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="address">Address</label>
                                                        <input type="text" name="address" id="address"
                                                            value="{{ $yard->address }}" required class="form-control">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="contact">Contact</label>
                                                        <input type="text" name="contact" id="contact"
                                                            value="{{ $yard->contact }}" required class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Default Modals -->

    <div id="new" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <form action="{{ route('yards.store') }}" enctype="multipart/form-data" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Create Yard</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>

                    @csrf
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <label for="name">Yard Name</label>
                            <input type="text" name="name" id="name" required class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address"  class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="contact">Contact</label>
                            <input type="text" name="contact" id="contact"  class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
               
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
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
    <script>
        $(".selectize").selectize();
    </script>
@endsection
