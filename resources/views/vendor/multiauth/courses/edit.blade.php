@extends('multiauth::layouts.app')
@section('content')

    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
    @include('multiauth::includes.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="card">
                            <div class="card-header bg-gradient-info text-white">Edit Course <a href="{{ route('admin.courses.index') }}"
                                                                                                  class="btn btn-sm btn-outline-warning float-right">Back</a></div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.courses.update', $course->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title"><h4>Course Title</h4></label>
                                                <input type="text" class="form-control form-control-md {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $course->title }}" id="title" placeholder="Course Title" required autofocus >
                                                @if ($errors->has('title'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title"><h4>Select Category</h4></label>
                                                <select name="category" id="category" class="form-control form-control-md" required autofocus>
                                                    <option value="{{ $course->category->id }}">{{ $course->category->name }}</option>
                                                </select>
                                                @if ($errors->has('category'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('category') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sub_title"><h4>Sub-Title</h4></label>
                                                <input type="text" class="form-control form-control-md {{ $errors->has('sub_title') ? ' is-invalid' : '' }}" name="sub_title" value="{{ $course->sub_title }}" id="title" placeholder="Course Sub-Title" required autofocus >
                                                @if ($errors->has('sub_title'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('sub_title') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><h4>File upload</h4></label>
                                                <input type="file" name="image" class="file-upload-default">
                                                <div class="input-group col-xs-12">
                                                    <input type="text" value="{{ $course->imagePath }}" class="form-control file-upload-info {{ $errors->has('image') ? ' is-invalid' : '' }}" disabled placeholder="Upload Image">
                                                    <span class="input-group-append">
                                                      <button class="file-upload-browse btn btn-sm btn-gradient-info" type="button">Upload</button>
                                                    </span>
                                                    @if ($errors->has('image'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('image') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="description"><h4>Course Description</h4></label>
                                                <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" id="description" name="description" rows="4">{{ $course->description }}</textarea>
                                                @if ($errors->has('description'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Cover Image Preview</label>
                                            <img src="{{ asset('courses/cover_images') . DIRECTORY_SEPARATOR . $course->imagePath }}" id="img_prev" alt="" width="200" height="200" class="rounded">
                                        </div>
                                    </div>

                                    <div class="form-group offer">
                                        <label class="col-form-label offer-head"><h4>Course Offer</h4></label>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-check offer-item">
                                                    <label class="form-check-label">
                                                        <input type="radio" @click="loadOfferDesc" {{ $course->offer == 1 ? 'checked' : '' }} class="form-check-input" name="offer" id="membershipRadios1" value="1">
                                                        Free
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-sm-3 mr-auto">
                                                <div class="form-check offer-item">
                                                    <label class="form-check-label">
                                                        <input type="radio" @click="loadOfferDesc" class="form-check-input" name="offer" id="membershipRadios2" value="2" {{ $course->offer == 2 ? 'checked' : '' }}>
                                                        Premium
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-9 mt-2">
                                                <h5>Offer Description</h5>
                                                <input type="number" id="price" placeholder="Enter price for course" value="{{ $course->price }}" name="price" class="form-control form-control-sm mt-2" v-if="priceStatus">
                                                <p class="mt-2">@{{ offerDesc }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3 float-right">
                                        <button type="submit" class="btn btn-md btn-gradient-info font-weight-small auth-form-btn">
                                            {{ __('Update Course') }}
                                        </button>
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
        tinymce.init({
            selector: '#description',
            plugins: "lists",
            toolbar: "numlist | bullist | styleselect "
        });
    </script>
    <script>

        new Vue({
            el: '#app',
            data: {
                'offerDesc': '',
                'priceStatus': false
            },
            methods: {
                //    Load Offer Description
                loadOfferDesc: function() {
                    this.offerDesc = '';
                    let offer = $("input[name=offer]:checked").val();
                    if (parseInt(offer) === 2) {
                        this.offerDesc = "This will be a premium course.";
                        this.priceStatus = true;
                    } else {
                        this.offerDesc = "This course will be provided for free.";
                        this.priceStatus = false;
                    }
                },

                loadCategories: function() {
                    axios.get('https://megabrainsinfotech.com/admin/api/category').then((res) => {
                        $("#category").append(res.data);
                    }).catch(err => console.log(err));
                },
            },
            mounted() {
                this.loadOfferDesc();
                this.loadCategories();
            },

        });
    </script>

    <script>
        (function($) {
            'use strict';
            $(function() {
                $('.file-upload-browse').on('click', function() {
                    var file = $(this).parent().parent().parent().find('.file-upload-default');
                    file.trigger('click');
                });
                $('.file-upload-default').on('change', function() {
                    $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
                });
            });
        })(jQuery);

        // Image Preview Handler
        function  readUrl(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $("#img_prev").attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".file-upload-default").change(function () {
            readUrl(this)
        })
    </script>

@endsection

