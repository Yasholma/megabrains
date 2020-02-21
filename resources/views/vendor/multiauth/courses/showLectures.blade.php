@extends('multiauth::layouts.app')

@section('content')
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
    @include('multiauth::includes.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h4 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-home"></i>
                    </span>
                        {{ __('Course Title') }}: {{ $course->title }}
                    </h4>
                    <a href="{{ route('admin.courses.showMoreLectures', $course->id) }}" class="btn btn-sm btn-info"><i class="mdi mdi-chevron-double-left"></i> Back</a>
                </div>
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="row p-3">
                                <div class="col-md-4 border-right border-primary">
                                    <h1 class="display-5 text-center text-uppercase">
                                        Sections
                                    </h1>
                                    <hr>

                                    {{--            Section Accordion         --}}
                                    @foreach($course->sections as $section)
                                        <div class="accordion mb-3" id="sections">
                                            <div class="card">
                                                <button class="btn btn-sm btn-outline-primary display-5" type="button" data-toggle="collapse" data-target="#section{{ $section->id }}" aria-expanded="true" aria-controls="collapseOne">
                                                    {{ $section->title }}
                                                </button>

                                                <div id="section{{ $section->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#sections">
                                                    <div class="content">
                                                        <ul>
                                                            @foreach($section->lectures as $lecture)
                                                                @if ($lecture->video_link != null)
                                                                    <li>
                                                                        <a style="cursor: pointer;" onclick="setVideo('{!! asset('/courses/videos/' . $course->tutor_id . '/' . $course->title .'/'. strtolower($lecture->section->title) .'/'. $lecture->video_link) !!}', '{!! $section->title !!}', '{!! $lecture->title !!}', '{!! $lecture->notes !!}');">{{ $lecture->title }}</a>
                                                                    </li>
                                                                @else
                                                                    <li>
                                                                        <a style="cursor: pointer; background: #0b0b0b; display: block; padding: 5px; color: #f0f0f0; border-radius:5px;" onclick="setNoteView({{ json_encode($lecture->notes) }})">{{ $lecture->title }}</a>
                                                                    </li>
                                                                @endif
                                                                <hr>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>

                                                @admin('super')
                                                @else
                                                    <div>
                                                        <a href="{{ route('admin.courses.showMoreLectures', $section->id) }}" class="btn btn-xs btn-outline-success float-right mt-2">Add to section</a>
                                                    </div>
                                                @endadmin

                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                                <div class="col-md-8">
                                    <h1 class="display-5" id="videoTitle">Section::VideoTitle</h1>
                                    <video id="videoPrev" style="margin-top: -7px !important;" src="" poster="{{ asset('courses/cover_images') . DIRECTORY_SEPARATOR . $course->imagePath }}" width="600" height="400" class="mb-5" controls></video>
                                    <div class="card pt-0 p-2">
                                        <h1 class="display-5" id="videoTitle">Notes</h1>
                                        <div class="card-body pt-0 pt-2" id="notes">

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

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/purify.min.js') }}"></script>
    <script>

        function setNoteView(notes) {
            var note = DOMPurify.sanitize(notes);
            let noteDiv = jQuery('#notes');
            let vidPrev = jQuery('#videoPrev');

            vidPrev.hide();

            if (notes !== '') {
                noteDiv.html(note);
            }


        }

        function setVideo(link, section, title, notes) {
            // Video Link
            let vidPrev = jQuery('#videoPrev');
            vidPrev.show();

            let noteDiv = jQuery('#notes');

            if (notes !== '') {
                noteDiv.html(notes);
            }


            vidPrev.get(0).pause();
            vidPrev.attr('src', link);
            vidPrev.get(0).load();
            // vidPrev.get(0).play();

            $("#videoTitle").text('Now Playing: ' + section + '::' + title);
        }

    </script>
@endsection
