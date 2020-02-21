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
                        Dashboard
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <span></span>Transactions
                                <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Course Purchase Record</h4>
                                <table class="table table-striped table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Image</th>
                                            <th>Transaction ID</th>
                                            <th>Student Name</th>
                                            <th>Course Name</th>
                                            <th>Amount Paid (₦)</th>
                                            <th>Time Paid (GMT +0)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transactions as $trans)
                                            <tr>
                                                <td class="py-1">
                                                    <img src="{{ asset('img/students/avatars/' . $trans->student->profile->picture) }}" alt="image"/>
                                                </td>
                                                <td><a href="{{ route('admin.transaction.show', $trans->id) }}" class="alert-link">{{ $trans->transaction_id }}</a></td>
                                                <td>{{ $trans->student->name }}</td>
                                                <td>{{ $trans->course->title }}</td>
                                                <td>{{ "₦" . number_format($trans->amount / 100) }}</td>
                                                <td>{{ $trans->paid_at->toDayDateTimeString() }}</td>
                                            </tr>
                                        @endforeach
                                        {{ $transactions->links() }}
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