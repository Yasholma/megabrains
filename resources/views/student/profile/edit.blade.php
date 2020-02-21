@extends('student.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header"><h3>Profile Update</h3></div>
                    <div class="card-body">
                        <form action="{{ route('profile.update', $profile->id) }}" method="post" enctype="multipart/form-data">
                            @csrf @method('patch')
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <img src="{{ asset('img/students/avatars/' . $profile->picture) }}" width="200" height="200" id="img_prev" alt="">
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <h5><label for="picture">Select Profile Picture</label></h5>
                                        <input type="file" class="form-control picture {{ $errors->has('picture') ? ' is-invalid' : '' }}" name="picture" id="picture">
                                        @if ($errors->has('picture'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('picture') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <h5><label for="name">Name</label></h5>
                                        <input type="name" value="{{ Auth::guard('student')->user()->name }}" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <h5><label for="email">Email</label></h5>
                                        <input type="email" value="{{ Auth::guard('student')->user()->email }}" class="form-control" readonly>
                                    </div>
                                    <hr>
                                    <div class="form-group mt-3">
                                        <div class="row">
                                            <div class="col-md-6 border-right">
                                                <h5 class="mb-0"><label for="gender">Gender</label></h5>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="gender" {{ $profile->gender  == 'male' ? 'checked' : '' }} class="custom-control-input {{ $errors->has('gender') ? ' is-invalid' : '' }}" id="male" value="male">
                                                    <label class="custom-control-label" for="male">Male</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="gender" {{ $profile->gender  == 'female' ? 'checked' : '' }} class="custom-control-input {{ $errors->has('gender') ? ' is-invalid' : '' }}" id="female" value="female">
                                                    <label class="custom-control-label" for="female">Female</label>
                                                    @if ($errors->has('gender'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('gender') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <h5 class="mb-0"><label for="phone">Phone Number</label></h5>
                                                <input type="tel" name="phone" id="phone" value="{{ $profile->phone }}" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}">
                                                @if ($errors->has('phone'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group mt-1">
                                        <h4 class="mb-0"><label for="country">Country</label></h4>
                                        <select name="country" id="country" class="form-control form-control-sm {{ $errors->has('country') ? ' is-invalid' : '' }}"></select>
                                        @if ($errors->has('country'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('country') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-1">
                                        <h5 class="mb-0"><label for="address">Address</label></h5>
                                        <textarea name="address" id="address" cols="30" rows="5" class="form-control form-control-sm {{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="Example: Gombe, Nigeria">{{ $profile->address }}</textarea>
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group mb-0">
                                        <a href="{{ route('student.dashboard') }}" class="btn btn-danger float-left mb-0">Cancel <i class="fa fa-close"></i></a>
                                        <button type="submit" class="btn btn-success float-right mb-0">Update <i class="fa fa-save"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            // axios.get('https://megabrainsinfotech.com/student/api/countries').then((res) => {
            //     $("#country").html(res.data);
            // }).catch(err => console.log(err));
            
            $.ajax({
                url: 'https://megabrainsinfotech.com/student/api/countries',
                method: 'GET',
                cache: false,
                success: function(data) {
                    $("#country").html(data);
                }, 
                error: function(err) {
                    console.log(err);
                    alert("Error getting countries, Server side issues.");
                }
            });
        });
    </script>
    <script>
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

        $(".picture").change(function () {
            readUrl(this)
        })
    </script>

@stop