<!-- Footer Area Start -->
    <footer class="footer-area section-padding-60-0" style="font-family: Quicksand, sans-serif;">
        <div class="container">
            <div class="row justify-content-between">

                <!-- Single Footer Widget -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single-footer-widget mb-80">
                        <h4 class="pt-3 text-center">RESOURCES</h4>
                        <ul class="mb-0" style="font-size: 1.04em;">
                            <li><a href="{{ route('index') }}"><i class="fa fa-home"></i> Home</a></li>
                            <li><a href=""><i class="fa fa-chevron-circle-right"></i> Blog</a></li>
                            <li><a href="{{ route('testimonies') }}"><i class="fa fa-chevron-circle-right"></i> Student Stories</a></li>
                            <li><a href="{{ route('aboutUs') }}"><i class="fa fa-chevron-circle-right"></i> About Us</a></li>
                            <li><a href=""><i class="fa fa-chevron-circle-right"></i> FAQs</a></li>
                        </ul>

                        <!-- Social Links Section -->
                        <div class="social-info">
                            <a href="" class="facebook"><i class="fa fa-facebook text-white pt-2 mt-1"></i></a>
                            <a href="" class="twitter"><i class="fa fa-twitter text-white pt-2 mt-1"></i></a>
                            <a href="" class="instagram"><i class="fa fa-linkedin text-white pt-2 mt-1"></i></a>
                            <a href="" class="facebook"><i class="fa fa-github text-white pt-2 mt-1"></i></a>
                            <a href="" class="twitter"><i class="fa fa-linkedin text-white pt-2 mt-1"></i></a>
                        </div>


                        <!-- Newsletter Section -->
                        <h5 class="mt-3">Subscribe to our newsletter</h5>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="user@gmail.com">
                                <button type="submit" class="btn btn-sm btn-outline-primary mt-1 float-right">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="single-footer-widget mb-80">
                        <h4 class="pt-3 text-center">COMPANY</h4>
                        <ul class="mb-0" style="font-size: 1.04em;">
                            <li><a href=""><i class="fa fa-chevron-circle-right"></i> Jobs</a></li>
                            <li><a href=""><i class="fa fa-chevron-circle-right"></i> Terms &amp; Privacy</a></li>
                            <li><a href="{{ route('contact') }}"><i class="fa fa-chevron-circle-right"></i> Contact Us</a></li>
                            <li><a href=""><i class="fa fa-chevron-circle-right"></i> Awards &amp; Recognitions</a></li>
                        </ul>

                        <div class="mt-3">
                            <h5>Our Location</h5>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1962.8825686401767!2d11.177161275754104!3d10.280498298155786!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x10ffd065ddb3f327%3A0xb7f91a6fd199b2fe!2sMega%20Brains%20Infotech!5e0!3m2!1sen!2sng!4v1569684524199!5m2!1sen!2sng" width="350" height="250" frameborder="2" style="border:0;" allowfullscreen=""></iframe>
                        </div>

                    </div>
                </div>

                <!-- Single Footer Widget -->
                <div class="col-12 col-md-4 col-xl-3">
                    <div class="single-footer-widget mb-80">
                        <h4 class="pt-3 text-center">PARTNERS</h4>
                        <ul class="mb-0" style="font-size: 1.04em;">
                            <li><a href=""><i class="fa fa-chevron-circle-right"></i> Partner With Us.</a></li>
                            <li><a href=""><i class="fa fa-chevron-circle-right"></i> Tutor With Us.</a></li>
                        </ul>

                        <!-- Newsletter Section -->
                        <h5 class="mt-3">Contact Us</h5>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="user@gmail.com">
                            </div>
                            <div class="form-group">
                                <textarea name="message" placeholder="Your message here..." id="message" rows="3" class="form-control font-control-sm"></textarea>
                                <div class="row">
                                    <div class="col-md-6 ml-auto">
                                        <button type="submit" class="btn btn-block btn-sm btn-outline-success mt-1 float-right">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

            <hr>
            <div class="row">
            {{--        Copyright Section     --}}
                <div class="mx-auto">
                    <p class="text-center lead">&copy; {{ Date('Y') }} MegaBrains Infotech Institute.</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->