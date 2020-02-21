@extends('layouts.app')
@section('title', '| Home')

    <!-- Pre Loader -->
    @include('_includes.preLoader')

@section('content')
    @include('_includes.carousel')
    <!-- Main Content Start -->
        <div class="container mt-2 pt-2">
            <!-- Courses Section Start -->
            <div class="course-headers">
                <h1 class="display-4 text-center mt-3">Our Courses</h1>
                <h3 class="text-center display-5">Learn in-demand skills on your own schedule</h3>
            </div>
            <div class="row" id="course">

                @foreach ($courses->shuffle() as $course)
                    <div class="col-md-3">
                        <div class="card course">
                            <div class="card-body">
                                <h5 class="card-title" style="margin-top: -10px;">{{ strlen($course->title) > 17 ? Str::limit($course->title, $limit = 14, $end = '...') : Str::limit($course->title, $limit = 17, $end = '...') }}</h5>
                            </div>
                            <div class="cover-image">
                                <img src="{{ asset('courses/cover_images' . DIRECTORY_SEPARATOR . $course->imagePath) }}" alt="{{ $course->imagePath }}" style="max-height: 200px;">
                            </div>
                            <div class="card-body">
                                <h6 class="card-subtitle text-muted">{{ Str::limit($course->sub_title, $limit = 70, $end = '...') }}</h6>

                                Ratings:
                                @for ($star = 1; $star <= 5; $star++)
                                   @if ($star <= $course->rating)
                                        <i class="fa fa-star text-warning"></i>
                                   @else
                                        <i class="fa fa-star-o"></i>
                                   @endif
                                @endfor
                                <hr>
                                @if (Auth::guard('student')->user())
                                    @if (\App\CourseEnroll::where(['student_id' => Auth::guard('student')->user()->id, 'course_id' => $course->id])->exists())
                                        <a href="{{ route('student.dashboard.course', $course->id) }}" class="btn btn-sm btn-outline-primary float-right">Enrolled. Continue to course</a>
                                    @else
                                        <a href="{{ route('courseDetails', $course->id) }}" class="btn btn-sm btn-outline-info float-left">Details</a>
                                        <a href="{{ route('student.enroll', $course->id) }}" class="btn btn-sm btn-outline-success float-right">Enroll Now</a>
                                    @endif
                                @else
                                    <a href="{{ route('courseDetails', $course->id) }}" class="btn btn-sm btn-outline-info float-left">Details</a>
                                    <a href="{{ route('student.enroll', $course->id) }}" class="btn btn-sm btn-outline-success float-right">Enroll Now</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="row">
                <div class="col-md-4 mx-auto mt-4 mb-4">
                    <a href="{{ route('courses.all') }}" style="border-radius: 20px;" class="btn btn-info btn-block">View Trending Courses</a>
                </div>
            </div>
            <!-- Courses End  -->

        </div>

        <!-- Section two -->
        <section class="mt-4">
            <div class="section-two">
                <div class="row">
                    <div class="col-md-8">
                        <p class="lead text-dark">
                            Find the path that’s right for you. Search for your program.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <form action="" class="form-inline mt-3 mx-auto" id="search">

                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search your program">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section Two Ends -->

        <!-- Icons Show Case Starts -->
        <section id="icon-show">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <i class="fa fa-leaf text-success mb-2"></i>
                        <h4 class="text-center">Grow</h4>
                        <p>Learn, Practice, Study, Make Friends @Megabrains</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <i class="fa fa-clock-o text-warning mb-2"></i>
                        <h4 class="text-center">Time</h4>
                        <p>Time wait for no man. Hurry now and get certified.</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <i class="fa fa-heart-o text-info mb-2"></i>
                        <h4 class="text-center">Love</h4>
                        <p>@Megabrains, Love with the trending stuffs is what we do.</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <i class="fa fa-magic text-danger mb-2"></i>
                        <h4 class="text-center">Magic</h4>
                        <p>Work with technology like magic.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Icons Show Case End -->

        <!-- Advert and Motivationals -->
        <section id="advert">
            <div class="row">
                <div class="col-md-6 pt-3" style="color: white !important;">
                    <video
                        controls
                        crossorigin
                        playsinline
                        id="player"
                        class="mt-3"
                        poster="https://picsum.photos/id/1/5616/3744"
                        autoPictureInPicture="true"
                    >
                        <!-- Video files -->
                        <source
                                src="{{ asset('videos/' . $motivation->video ) }}"
                                type="video/mp4"
                                size="576"
                        />
                        <source
                                src="{{ asset('videos/' . $motivation->video ) }}"
                                type="video/mp4"
                                size="720"
                        />
                        <source
                                src="{{ asset('videos/' . $motivation->video ) }}"
                                type="video/mp4"
                                size="1080"
                        />

                        <!-- Caption files -->
                        <track
                                kind="captions"
                                label="English"
                                srclang="en"
                                src=""
                                default
                        />

                        <!-- Fallback for browsers that don't support the <video> element -->
                        <a href="{{ asset('videos/' . $motivation->video ) }}" download
                        >Download</a>
                    </video>
                </div>
                <div class="col-md-5 ml-4 quotes">
                    <?php $icons = ["star-o", "superpowers", "handshake-o"]; $n=0; ?>
                    @foreach($motivation->quotes as $quote)
                        <div class="row">
                            <div class="col-md-2">
                                <li style="margin-top: 36px; font-size: 3em;"><i class="fa fa-{{ $icons[$n++] }} fa-lg"></i></li>
                            </div>
                            <div class="col-md-10">
                                <p style="margin-top: 40px; color:#0b0b0b;">{{ $quote->quotes }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Advert and Motivationals End -->


        <!-- Section Three -->
        <section id="section-three">
            <div class="container">
                <h1 class="display-2 info-heading">Megabrains</h1>
                <h1 class="display-4 text-center text-white">Our Mission, Philosophy and Objectives</h1>
                <div class="row">
                    <div class="col-md-4">
                        <div class="info-card">
                            <h1 class="info-card-header">Mission</h1>
                            <p class="info-card-body mission">
                                {{ Str::words($mpo->mission, 80) }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card">
                            <h1 class="info-card-header">Philosophy</h1>
                            <p class="info-card-body phy">
                                {{ Str::words($mpo->philosophy, 80) }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card">
                            <h1 class="info-card-header">Visions</h1>
                            <p class="info-card-body objectives">
                                {{ Str::words($mpo->objective, 80) }}
                            </p>
                        </div>
                    </div>
                </div>

                @if (str_word_count($mpo->mission) > 80 || str_word_count($mpo->philosophy) > 80 || str_word_count($mpo->objective) > 80)
                    <div class="row">
                        <div class="col-md-4 mx-auto mt-4 mb-4">
                            <a href="{{ route('aboutUs') }}" style="border-radius: 20px;" class="btn btn-info btn-block">View More</a>
                        </div>
                    </div>
                @endif
            </div>
        </section>
        <!-- Section Three End -->

        <!-- Section Four Starts -->
        <section id="section-four">
            <div class="container-fluid">
                <div class="row p-5">
                    <div class="col-md-6">
                        <img src="img/laptop.jpg" alt="" class="img-fluid">
                    </div>
                    <div class="col-md-5 ml-4">
                        <div class="row">
                            <div class="col-md-2">
                                <li style="margin-top: 36px; font-size: 3em;"><i class="fa fa-star fa-lg"></i></li>
                            </div>
                            <div class="col-md-10">
                                <p style="margin-top: 40px; color:#0b0b0b;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quidem officiis illo impedit? Cumque vitae ipsam repudiandae ducimus, accusamus voluptatibus...</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <li style="margin-top: 36px; font-size: 3em;"><i class="fa fa-superpowers fa-lg"></i></li>
                            </div>
                            <div class="col-md-10">
                                <p style="margin-top: 40px; color:#0b0b0b;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quidem officiis illo impedit? Cumque vitae ipsam repudiandae ducimus, accusamus voluptatibus...</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <li style="margin-top: 36px; font-size: 3em;"><i class="fa fa-handshake-o fa-lg"></i></li>
                            </div>
                            <div class="col-md-10">
                                <p style="margin-top: 40px; color:#0b0b0b;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quidem officiis illo impedit? Cumque vitae ipsam repudiandae ducimus, accusamus voluptatibus...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section Four End -->

        <!-- CountDown -->
        <section id="statistics" style="margin-top: 100px;">
            <div class="container" id="count-down">
                <h1 class="display-4 text-center mt-3">Our Statistics</h1>
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="box">
                            <div class="chart" data-percent="92">92%</div>
                            <hr>
                            <p>of our Students have found our courses to be satisfactory.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="box">
                            <div class="chart" data-percent="87">87%</div>
                            <hr>
                            <p>Said it was helpful in their career growth.</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="stat-items">
                            <i class="fa fa-briefcase text-center">
                                <h2 class="count text-center"><span>8428</span> +</h2>
                                <hr>
                                <p>Enrolled in our courses.</p>
                            </i>
                        </div><!--End of start-items-->
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="stat-items">
                            <i class="fa fa-briefcase text-center">
                                <h2 class="count text-center"><span>52</span> +</h2>
                                <hr>
                                <p>Training Courses</p>
                            </i>
                        </div><!--End of start-items-->
                    </div>
                </div>
            </div>
        </section>
        <!-- CountDown Ends -->


        <!-- Partnerships Starts -->
        <section id="partners">
            <h1 class="display-4 mb-4 text-center">Our Partners</h1>
            <div class="container">
                <div class="row text-center mt-3">
                    @foreach ($partners as $partner)
                        <div class="col-md-3">
                            <div class="circle">
                                <img src="{{ asset('img/partners/' . $partner->image) }}" class="img-responsive" alt="{{ $partner->name }}" title="{{ strtoupper($partner->name) }}">
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-md-4 mx-auto mt-5">
                        <a href="{{ route('partners.all') }}" id="partner-btn" class="btn btn-outline-primary btn-block">View All</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Partnerships End -->

        <!-- Testimonials Starts -->
        <section id="testimony">
            <div class="container">
                <div class="row mt-5">
                    @foreach ($testimonies as $testimony)
                        <div class="col-md-4">
                            <div class="testimony-card text-center">
                                @if ($testimony->student->profile)
                                    <img src="{{ asset('img/students/avatars/' . $testimony->student->profile->picture) }}" alt="Student Picture" class="testimony-card-img">
                                @else
                                    <img src="{{ asset('img/students/avatars/no_image.png') }}" alt="Student Picture" class="testimony-card-img">
                                @endif
                                
                                <div class="card-body">
                                    <h4 class="card-title">{{ $testimony->student->name }}</h4>
                                    @if ($testimony->student->profile)
                                        <p id="testimony-location"><i class="fa fa-map-marker fa-lg text-primary"></i> {{ $testimony->student->profile->address }}</p>
                                    @else
                                        <p id="testimony-location"><i class="fa fa-map-marker fa-lg text-primary"></i> N/A</p>
                                    @endif
                                    
                                    <p id="testimony-body">
                                        {{ $testimony->testimony }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-md-4 mx-auto">
                        <a id="testimony-btn" href="{{ route('testimonies') }}" class="btn btn-block btn-outline-secondary">All Testimonials</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials End -->

        <!-- Section Five -->
        <section class="mt-4">
            <div class="section-five">
                <div class="row">
                    <div class="col-md-8">
                        <p class="lead text-white">
                            Find the path that’s right for you. Search for your program.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <form class="form-inline mt-3 mx-auto" id="search">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control search-box" id="search-box" placeholder="Search your program">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section Five End -->

        <!-- Main Content End -->

    @include('_includes.footer')
@endsection

@section('scripts')
    <script>
        const searchBox = $('.search-box');
        searchBox.on('keyup', (e) => {

           if (searchBox.val().length > 3) {
               let form = $('#search');
               axios.post('', form)
                   .then(res => console.log(res))
                   .catch(err => console.log(err));

               // ajax request to get result from database
           }
        });
    </script>
@stop
    

