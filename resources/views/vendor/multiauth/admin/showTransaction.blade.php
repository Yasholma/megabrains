@extends('multiauth::layouts.app')
@section('content')

    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
    @include('multiauth::includes.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                      <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-home"></i>
                      </span>
                        Purchase Details
                    </h3>
                </div>
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body mt-0">
                                <div class="row">
                                    <div class="col-md-4 border-right">
                                        <h4 class="text-center">Course Info</h4>
                                        <div class="card bg-dark text-white p-3">
                                            <img src="{{ asset('courses/cover_images/' . $transaction->course->imagePath) }}" class="card-img-top" alt="Course Image">
                                        </div>
                                        <div class="card bg-dark mt-1 p-3">
                                            <h6 class="text-white"><span class="text-info">Title:</span> {{ $transaction->course->title }}</h6>
                                            <h6 class="text-white"><span class="text-info">Price:</span> {{ "₦" . number_format($transaction->course->price) . '.00' }}</h6>
                                            <h6 class="text-white"><span class="text-info">Instructor:</span> {{ $transaction->course->tutor->name }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-4 border-right">
                                        <h4 class="text-center">Student Info</h4>
                                        <div class="card bg-dark text-white p-3">
                                            <img src="{{ asset('img/students/avatars/' . $transaction->student->profile->picture) }}" alt="Student Picture" class="rounded rounded-circle card-img-top mb-1">
                                            <h5 class="text-white"><i class="mdi mdi-account-circle "></i> {{ $transaction->student->name }}</h5>
                                            <h6 class="text-white"><i class="mdi mdi-email "></i> {{ $transaction->student->email }}</h6>
                                            <h6 class="text-white"><i class="mdi mdi-phone "></i> {{ $transaction->student->profile->phone }}</h6>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <h4 class="text-center">Transaction Info</h4>
                                        <div class="card bg-dark text-white p-3">
                                            <h5 class="text-white"><span class="text-success">Amount Paid: </span> {{ "₦" . number_format($transaction->amount / 100) . '.00'}}</h5>
                                            <h5 class="text-white"><span class="text-success">Transaction ID: </span> {{ $transaction->transaction_id }}</h5>
                                            <h5 class="text-white"><span class="text-success">Payment Channel: </span> {{ $transaction->card }}</h5>
                                            <h6 class="text-white"><span class="text-success">Card Type: </span> {{ $transaction->card_brand }}</h6>
                                            <h6 class="text-white"><span class="text-success">Date Paid: </span> {{ $transaction->paid_at->toDayDateTimeString() }}</h6>
                                            <small class="text-white"><span class="text-success">Paystack Ref: </span> {{ $transaction->reference }}</small>
                                        </div>
                                    </div>
                                </div>

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