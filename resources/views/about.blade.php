@extends('layouts.app')
@section('title', '| About Us')
@section('styles')
    <style>
        .about-section {
            font-family: Roboto, sans-serif;
        }
        .about-section p {
            font-weight: 500;
            font-size: 16px;
            color: #00000a;
        }

        .executives {
            font-family: Roboto, sans-serif;
        }

        .testimony-card {
            background: #fff;
            height: 78vh;
            border-radius: 0;
            padding: 10px;
            color: #00000a;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            margin-top: 15px;
        }
        
            /* Mobile Phones */
        @media (min-width: 320px) and (max-width: 768px) {
            .core-values {
                display: none;
            }   
        }

    </style>
@stop
@section('content')
    <div>
        <div class="container mt-2 pt-2">
            <div class="row mt-1">
                <div class="col-md-8 about-section">
                    <h1>About Us</h1>
                    <p>
                        MegaBrains Infotech was born out of the desire to spread ICT and Management literacy to all and sundry. No organization can truly be successful without these two important fields.
                        Our goal is to ensure that organizations have at their disposal competent locally sourced personnel of world standard capable of piloting the affairs of their organization
                        Our team of professional tutors, driven by passion, pours out their soul with a touch of a smile to ensure you pick every information and skill necessary for on the job success.
                        Our online courses are designed to mimic and retain classroom learning experiences such that you at the comfort of your home with the same focus and commitment obtainable in traditional classroom learning.
                        Our certifications are word class in partnership with various institutions and professional bodies.

                    </p>

                    <div class="accordion mb-4" id="accordionExample">
                        <div class="card">
                            <div class="card-header bg-secondary" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Our Mission
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    {{ $mpo->mission }}
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-secondary" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-secondary collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Our Vision
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    {{ $mpo->objective }}
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-secondary" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-secondary collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Our Philosophy
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    {{ $mpo->philosophy }}
                                </div>
                            </div>
                        </div>
                        <div class="card d-lg-none">
                            <div class="card-header bg-secondary" id="headingFour">
                                <h2 class="mb-0">
                                    <button class="btn btn-secondary collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                        Our Core Values
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p>* Move fast! Fast is better than slow</p>

                                    <p>* Cost - consciousness</p>

                                    <p>* We are one team</p>

                                    <p>* Straight forward and open-minded</p>

                                    <p>* Passion for our work</p>

                                    <p>* Display urgency (2x)</p>

                                    <p>* Treat others with respect</p>

                                    <p>* Be your own customer</p>

                                    <p>* We think customer</p>

                                    <p>* Pursue growth and learning</p>

                                    <p>* Wear a smile and give a smile</p>
                                </div>
                            </div>
                        </div>
                    </div>

                {{--         Join MBrains Family           --}}
                    <h2 class="text-center">Join MegaBrains Family</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid architecto at atque commodi consectetur cupiditate dolor dolorem doloribus error facere fugit hic ipsam, maxime mollitia nesciunt odio optio quibusdam sapiente sint, soluta </p>
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <a href="#" class="btn btn-outline-secondary btn-block">Join Now !!!</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 about-section core-values">
                    <h1>Our Core Values</h1>

                    <p>* Move fast! Fast is better than slow</p>

                    <p>* Cost - consciousness</p>

                    <p>* We are one team</p>

                    <p>* Straight forward and open-minded</p>

                    <p>* Passion for our work</p>

                    <p>* Display urgency (2x)</p>

                    <p>* Treat others with respect</p>

                    <p>* Be your own customer</p>

                    <p>* We think customer</p>

                    <p>* Pursue growth and learning</p>

                    <p>* Wear a smile and give a smile</p>

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 executives">
                    <h1>Our Team Members</h1>

                    <div class="row">
                        @foreach ($instructors as $in)
                            <div class="col-md-4 col-sm-12">
                                <div class="testimony-card text-center">
                                    <img class="testimony-card-img"  src="{{ $in->profile['picture'] ? asset('admin_assets/images/faces/' . $in->profile['picture']) : asset('admin_assets/images/no_image.jpg') }}" alt="">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $in->name }}</h4>
                                        <h6 class="card-title text-muted"><i class="fa fa-envelope-o"></i> {{ $in->email }}</h6>
                                        @foreach($in->roles as $role)
                                            <span class="text-secondary text-small"><i class="fa fa-dashboard"></i> {{ ucfirst($role->name) }}</span>
                                        @endforeach

                                        <p id="testimony-body">
                                            {{ $in->profile['biography'] }}
                                        </p>

                                        <div class="footer-area social">
                                            <div class="container">
                                                <div class="row justify-content-between">

                                                    <!-- Single Footer Widget -->
                                                    <div class="col-md-12">
                                                        <div class="single-footer-widget">
                                                            <!-- Social Info -->
                                                            <div class="social-info">
                                                                <a href="{{ $in->profile['facebook'] }}" class="facebook"><i class="fa fa-facebook text-white"></i></a>
                                                                <a href="{{ $in->profile['twitter'] }}" class="twitter"><i class="fa fa-twitter text-white"></i></a>
                                                                <a href="{{ $in->profile['linkedin'] }}" class="instagram"><i class="fa fa-linkedin text-white"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mt-3">
                <div class="col-md-12 executives">
                    <h2 class="text-center text-info">Testimonies</h2>

                    <div class="row mt-3">
                        @foreach ($testimonies as $tm)
                            <div class="col-md-4 col-sm-12">

                                <div class="text-center">
                                    <div class="card-body bg-info text-white mb-2" style="border-radius: 20px;">
                                        <h4 class="card-title"><img class="rounded rounded-circle" width="50" height="50"  src="{{ $tm->student->profile ? asset('img/students/avatars/' . $tm->student->profile->picture) : asset('img/students/avatars/no_image.png') }}" alt="Student Image">
                                            {{ $tm->student->name }}</h4>
                                        <p id="testimony-body" class="text-white">
                                            {{ $tm->testimony }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4 mx-auto">
                            <a href="{{ route('testimonies') }}" class="btn btn-outline-info btn-block">All Testimonies</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>
    @include('_includes.footer')
@endsection
