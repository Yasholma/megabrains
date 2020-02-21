@extends('layouts.app')
@section('title', '| Partnerships')
@section('content')
    <div>
        <div class="container mt-2 pt-2">
            @include('multiauth::message')
            <div class="row">
                @foreach ($partners as $partner)
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('img/partners/' . $partner->image) }}" alt="{{ $partner->name }}">
                            <div class="card-body">
                                <h4 class="card-title">{{ $partner->name }}</h4>
                                <p class="card-text">{{ $partner->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    @include('_includes.footer')
@endsection
