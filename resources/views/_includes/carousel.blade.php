<!--Carousel Wrapper-->
<div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
        <!--Indicators-->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-2" data-slide-to="1"></li>
            <li data-target="#carousel-example-2" data-slide-to="2"></li>
        </ol>
        <!--/.Indicators-->
        <!--Slides-->
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
            <div class="view">
                <img class="d-block w-100" src="{{ asset('img/carousel/slide1.jpg') }}"
                alt="First slide">
                <div class="mask rgba-black-light"></div>
            </div>
            <div class="carousel-caption">
                <div class="contain">
                    
                </div>
            </div>
            </div>
            <div class="carousel-item">
            <!--Mask color-->
            <div class="view">
                <img class="d-block w-100" src="{{ asset('img/carousel/slide2.jpg') }}"
                alt="Second slide">
                <div class="mask rgba-black-strong"></div>
            </div>
            <div class="carousel-caption">
                <div class="contain">
                    <h3 class="display-4">Let us help you take your career to another level - MegaBrains</h3>
                    @if (!Auth::guard('student')->user())
                        <a href="{{ route('student.register') }}" class="btn btn-info mt-3">Join Now</a>
                    @endif
                </div>
            </div>
            </div>
            <div class="carousel-item">
            <!--Mask color-->
            <div class="view">
                <img class="d-block w-100" src="{{ asset('img/carousel/slide1.jpg') }}"
                alt="Third slide">
                <div class="mask rgba-black-slight"></div>
            </div>
            <div class="carousel-caption">
                <div class="contain">
                    <!--<h3 class="display-1">Slight mask</h3>-->
                    <!--<p>Third text</p>-->
                </div>
            </div>
            </div>
        </div>
        <!--/.Slides-->
        <!--Controls-->
        <a class="carousel-control-prev d-none" href="#carousel-example-2" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next d-none" href="#carousel-example-2" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <!--/.Controls-->
    </div>
    <!--/.Carousel Wrapper-->