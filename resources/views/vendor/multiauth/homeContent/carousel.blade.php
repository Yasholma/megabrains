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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Heading</th>
                                        <th>Sub Heading</th>
                                        <th>Button</th>
                                        <th>Featured</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <img src="{{ asset('img/laptop.jpg') }}" class="carouse-image" alt="">
                                        </td>
                                        <td>
                                            {{ __('Let us help you take your career to another level - MegaBrains') }}
                                        </td>
                                        <td>
                                            {{ __('-') }}
                                        </td>
                                        <td>
                                            {{ __('NO') }}
                                        </td>
                                        <td>
                                            {{ __('Yes') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="{{ asset('img/laptop.jpg') }}" class="carouse-image" alt="">
                                        </td>
                                        <td>
                                            {{ __('Let us help you take your career to another level - MegaBrains') }}
                                        </td>
                                        <td>
                                            {{ __('-') }}
                                        </td>
                                        <td>
                                            {{ __('NO') }}
                                        </td>
                                        <td>
                                            {{ __('Yes') }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
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


