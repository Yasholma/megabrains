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
                        Create General Test
                    </h4>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card p-3">
                                <form action="{{ route('admin.general.test.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="course_title">Course Title</label>
                                        <select name="course_title" id="course_title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" required autofocus></select>
                                        @if ($errors->has('course_title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('course_title') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="test_desc">Test Description</label>
                                        <textarea name="test_desc" id=test_desc"" cols="30" rows="5" class="form-control {{ $errors->has('test-desc') ? ' is-invalid' : '' }}"></textarea>
                                        @if ($errors->has('test_desc'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('test_desc') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="time">Test Time</label>
                                        <input type="text" id="time" name="time" class="form-control {{ $errors->has('time') ? ' is-invalid' : '' }}" placeholder="Enter time in seconds">
                                        @if ($errors->has('time'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('time') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <a href="" class="btn btn-outline-warning">Back</a>
                                        <button type="submit" class="btn btn-outline-primary float-right">Create</button>
                                    </div>
                                </form>
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
    <script>

        new Vue({
            el: '#app',
            data: {
            },
            methods: {
                loadCategories: function() {
                    axios.get(`https://megabrainsinfotech.com/admin/api/course`).then((res) => {
                        $("#course_title").html(res.data);
                    }).catch(err => console.log(err));
                },
            },
            mounted() {
                this.loadCategories();
            },

        });
    </script>
@stop