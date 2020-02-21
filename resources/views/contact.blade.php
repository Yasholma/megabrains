@extends('layouts.app')
@section('title', '| Contact Us')
@section('styles')
    <style>

    </style>
@stop
@section('content')
    <div class="contact-page d-none d-md-block" style="background-image: url({{ asset('img/contact-page.jpg') }}); background-size: cover; width: 100%; height: 100vh">
    </div>
    <div class="contact-page d-sm-block d-md-none img-fluid" style="background-image: url({{ asset('img/contact-page-sm.jpg') }}); background-size: contain;  background-repeat: no-repeat; height: 100vh">
    </div>
    @include('_includes.footer')
@endsection
