@extends('multiauth::layouts.app')
@section('styles')
    <style>

    </style>
@stop
@section('content')

    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
    @include('multiauth::includes.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-8 card">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Desc</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partners as $partner)
                                    <tr>
                                        <td>{{ $partner->name }}</td>
                                        <td>
                                            <img src="{{ asset('img/partners/' . $partner->image) }}" alt="">
                                        </td>
                                        <td>{{ $partner->description }}</td>
                                        <td>{{ $partner->created_at->toFormattedDateString() }}</td>
                                        <td>
                                            <a href="{{ route('admin.editPartner', $partner->id) }}" class="btn btn-outline-info btn-xs"><i class="mdi mdi-pencil-circle"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-4">
                        <div class="card p-3">
                            @include('multiauth::message')
                            <h5 class="text-center">Add New Partnership</h5>
                            <hr>
                            <form action="{{ route('admin.partner') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5><label for="name">Partner Name</label></h5>
                                    <input type="text" class="form-control form-control-sm {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <h5><label for="image">Partner Image</label></h5>
                                    <input type="file" class="form-control form-control-sm {{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" id="image">
                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <h5><label for="description">Partner Description</label></h5>
                                    <textarea name="description" id="description" rows="3"
                                              class="form-control form-control-sm {{ $errors->has('description') ? ' is-invalid' : '' }}"></textarea>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-success btn-sm float-right">Add <i class="mdi mdi-content-save-outline"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
        @include('multiauth::includes.footer')
        <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
@endsection


