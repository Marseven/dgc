@extends('layout.default')

@section('content')
    <div class="swiper-container swiper-slider swiper-secondary" data-autoplay="3500" data-height="100vh"
        data-min-height="300px">
        <div class="swiper-wrapper text-center">
            <div class="swiper-slide" data-slide-bg="images/home-03-slide-01.jpg">
                <div class="swiper-slide-caption">
                    <div class="container">
                        <div class="row section-100-vh align-items-sm-center justify-content-sm-center">
                            <div class="col-xxl-8 col-md-9" data-caption-animate="fadeInDown" data-caption-delay="200">
                                <h1 class="text-white">Quality Appliance Repair</h1>
                                <p class="h6 offset-top-30">We are the largest full-service appliance repair
                                    company in the world. We service all types and brands of home appliances. People
                                    trust us.</p>
                                <div class="group"><a class="btn btn-primary btn-form" href="#">Our
                                        services</a><a class="btn btn-dark btn-form" href="#">Get in
                                        touch</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide" data-slide-bg="images/home-02-slide-01.jpg">
                <div class="swiper-slide-caption">
                    <div class="container">
                        <div class="row section-100-vh align-items-sm-center justify-content-sm-center">
                            <div class="col-xxl-8 col-md-9" data-caption-animate="fadeInDown" data-caption-delay="200">
                                <h1 class="text-white">Professional Customer Service</h1>
                                <p class="h6 offset-top-30">Our qualified team strives for ensuring your
                                    satisfaction, while offering the highest levels of professional service at
                                    affordable and competitive rates.</p>
                                <div class="group"><a class="btn btn-primary btn-form" href="#">Our
                                        services</a><a class="btn btn-dark btn-form" href="#">Get in
                                        touch</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide" data-slide-bg="images/home-01-slide-01.jpg">
                <div class="swiper-slide-caption">
                    <div class="container">
                        <div class="row section-100-vh align-items-sm-center justify-content-sm-center">
                            <div class="col-xxl-8 col-md-9" data-caption-animate="fadeInDown" data-caption-delay="200">
                                <h1 class="text-white">Experienced Technicians</h1>
                                <p class="h6 offset-top-30">Our technicians have decades of practical, in-field
                                    experience besides factory training. This means they have the knowledge and
                                    skills needed to diagnose and repair any appliance you may have.</p>
                                <div class="group"><a class="btn btn-primary btn-form" href="#">Our
                                        services</a><a class="btn btn-dark btn-form" href="#">Get in
                                        touch</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-button-prev"><span>Prev</span></div>
        <div class="swiper-button-next"><span>Next</span></div>
        <div class="custom-way-point custom-way-point-swiper animated" data-custom-scroll-to="custom-way-point">
            Scroll down</div>
    </div>
    <section class="section-75 section-md-120 section-lg-120 section-xl-150" id="custom-way-point">
        <div class="container text-left">
            <div class="row row-15 justify-content-sm-center">
                <div class="col-md-9 col-lg-6">
                    <div class="box-info-custom" style="background-image: url(images/home-3-01-735x394.jpg );">
                        <div class="box-info-custom-inner">
                            <h5 class="box-info-custom-title"><a href="#"> Washing Machine Repair</a></h5>
                            <p>Whether your washing machine is front loading or top loading, our experts can provide
                                fast and efficient repair to get it working again.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-lg-6">
                    <div class="box-info-custom" style="background-image: url(images/home-3-02-735x394.jpg );">
                        <div class="box-info-custom-inner">
                            <h5 class="box-info-custom-title"><a href="#"> Oven Repair</a></h5>
                            <p>Be sure that you work with a team of professionals who will be able to help you every
                                step of the way with your oven repair needs.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-lg-6">
                    <div class="box-info-custom" style="background-image: url(images/home-3-03-735x394.jpg );">
                        <div class="box-info-custom-inner">
                            <h5 class="box-info-custom-title"><a href="#">Refrigerator Repair</a></h5>
                            <p>Virtually every refrigerator problem can be fixed with our company services. We can
                                fix any situation that involves refrigerators.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-lg-6">
                    <div class="box-info-custom" style="background-image: url(images/home-3-04-735x394.jpg );">
                        <div class="box-info-custom-inner">
                            <h5 class="box-info-custom-title"><a href="#">Air Conditioner Repair</a></h5>
                            <p>Regardless of whether you need to repair, replace or maintain your current AC system
                                or plan to install new air conditioning, we can help.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-sm-center offset-top-60 offset-md-top-125 offset-lg-top-150">
                <div class="col-xl-12 col-md-8 col-lg-9">
                    <div class="row row-30 align-items-xl-center justify-content-xl-between">
                        <div class="col-xl-6"><img class="img-responsive" src="images/home-3-05-735x460.jpg" alt=""
                                width="735" height="460" />
                        </div>
                        <div class="col-xl-5">
                            <h2>Let Our Professionals Work for Your Comfort!</h2>
                            <h6>Our appliance repair technicians are clean and professional and provide repair
                                services you can rely on.</h6>
                            <p>We service all major household appliances including washing machines, clothes dryers,
                                refrigerators, freezers, ice makers, ice machines, dishwashers, cooktops, ovens,
                                ranges, stoves, microwaves, vent hoods, trash compactors, and garbage disposals.
                                Some locations also provide repair service for commercial equipment, reconditioned
                                appliances, and parts.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-image-filter bg-image bg-image-fixed section-xxl"
        style="background-image: url(&quot;images/home-3-parallax-01.jpg&quot;);">
        <div class="container filter-inner-wrap">
            <div class="row justify-content-sm-center text-center">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <h2 class="text-white"><span class="small text-white">affordable repair
                            solutions</span>High-Quality and Friendly<br class="d-none d-lg-block"> Services at
                        Fair Prices
                    </h2><a class="btn btn-default btn-form btn-default-white" href="contacts.html">Contact us</a>
                </div>
            </div>
        </div>
    </section>

    <section class="section-75 section-md-100 section-lg-120 section-xl-130">
        <div class="container">
            <h2><span class="small">Testimonials</span>What clients say about our company</h2>
            <div class="row">
                <div class="col-sm-12">
                    <!-- Owl Carousel-->
                    <div class="owl-carousel" data-autoplay="true" data-items="1" data-lg-items="2" data-dots="true"
                        data-nav="false" data-stage-padding="15" data-loop="true" data-margin="30"
                        data-mouse-drag="false">
                        <blockquote class="quote-default text-left">
                            <h6>
                                <q>“ I highly recommend this company. I had a washing machine breakdown and they had
                                    it back and running within 30 minutes of service call. Thank you for such a
                                    professional work!”</q>
                            </h6>
                            <div class="offset-top-30 offset-md-top-45">
                                <div class="unit flex-row align-items-sm-center">
                                    <div class="unit-left"><img class="rounded-circle"
                                            src="images/testimonials-1-68x68.jpg" width="68" height="68"
                                            alt=""></div>
                                    <div class="unit-body">
                                        <h6>
                                            <cite>Jane Anderson</cite>
                                        </h6><span class="offset-top-10 small-xs">CEO, Firetree Co.</span>
                                    </div>
                                </div>
                            </div>
                        </blockquote>
                        <blockquote class="quote-default text-left">
                            <h6>
                                <q>“Great service! The staff was so friendly and knowledgeable. They fixed my
                                    refrigerator in a timely and professional manner. Highly recommend. Thanks for a
                                    good job, guys!”</q>
                            </h6>
                            <div class="offset-top-30 offset-md-top-45">
                                <div class="unit flex-row align-items-sm-center">
                                    <div class="unit-left"><img class="rounded-circle"
                                            src="images/testimonials-2-68x68.jpg" width="68" height="68"
                                            alt=""></div>
                                    <div class="unit-body">
                                        <h6>
                                            <cite>Jim Johnson</cite>
                                        </h6><span class="offset-top-10 small-xs">Head manager, Frober
                                            Design</span>
                                    </div>
                                </div>
                            </div>
                        </blockquote>
                        <blockquote class="quote-default text-left">
                            <h6>
                                <q>“Thank you very much for your wonderful service, your highly experienced team was
                                    just terrific! We look forward to continuing to always work with Home Service.
                                    Good luck, guys! ”</q>
                            </h6>
                            <div class="offset-top-30 offset-md-top-45">
                                <div class="unit flex-row align-items-sm-center">
                                    <div class="unit-left"><img class="rounded-circle"
                                            src="images/testimonials-3-68x68.jpg" width="68" height="68"
                                            alt=""></div>
                                    <div class="unit-body">
                                        <h6>
                                            <cite>Peter Handerson</cite>
                                        </h6><span class="offset-top-10 small-xs">Editor, SAM Publishing</span>
                                    </div>
                                </div>
                            </div>
                        </blockquote>
                        <blockquote class="quote-default text-left">
                            <h6>
                                <q>“I just wanted to let you know that your professional team came out and fixed the
                                    problem and did a great job. Thank you for the prompt service and making the
                                    repair.”</q>
                            </h6>
                            <div class="offset-top-30 offset-md-top-45">
                                <div class="unit flex-row align-items-sm-center">
                                    <div class="unit-left"><img class="rounded-circle"
                                            src="images/testimonials-4-68x68.jpg" width="68" height="68"
                                            alt=""></div>
                                    <div class="unit-body">
                                        <h6>
                                            <cite>Rita Johnson</cite>
                                        </h6><span class="offset-top-10 small-xs">Designer, Glance Studio</span>
                                    </div>
                                </div>
                            </div>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-75 section-md-120 section-lg-120 section-xl-150 bg-table">
        <div class="container">
            <h2><span class="small">Latest news</span>News & Events</h2>
            <div class="row justify-content-sm-center text-lg-left row-55">
                <div class="col-sm-10 col-md-6 col-xl-4">
                    <article class="blog-grid blog-grid-custom"><a class="blog-grid-image" href="#"><img
                                class="img-responsive" src="images/home-3-06-485x250.jpg" alt="" width="485"
                                height="250" />
                            <div class="blog-grid-title">oven repair</div>
                        </a>
                        <div class="blog-grid-content">
                            <h5><a class="text-primary" href="#">How to Repair a Gas Range</a></h5>
                            <p>If the burners on your stove don't light or the oven isn't heating, you can usually
                                solve the problem in five minutes and save the cost of a service call.</p>
                            <p class="text-darker">
                                <time datetime="2019">August 11, 2019</time>
                            </p>
                        </div>
                    </article>
                </div>
                <div class="col-sm-10 col-md-6 col-xl-4">
                    <article class="blog-grid blog-grid-custom"><a class="blog-grid-image" href="#"><img
                                class="img-responsive" src="images/home-3-07-485x250.jpg" alt="" width="485"
                                height="250" />
                            <div class="blog-grid-title">tablet repair</div>
                        </a>
                        <div class="blog-grid-content">
                            <h5><a class="text-primary" href="#">How to Repair Android Tablets</a></h5>
                            <p>Do you need a tablet repair service? It's easy to fall in love with your tablet, as
                                it offers the perfect combination of size and function. Whether you use it for work,
                                school, or play...</p>
                            <p class="text-darker">
                                <time datetime="2019">August 21, 2019</time>
                            </p>
                        </div>
                    </article>
                </div>
                <div class="col-sm-10 col-md-6 col-xl-4">
                    <article class="blog-grid blog-grid-custom"><a class="blog-grid-image" href="#"><img
                                class="img-responsive" src="images/home-3-08-485x250.jpg" alt="" width="485"
                                height="250" />
                            <div class="blog-grid-title">refrigerator Repair</div>
                        </a>
                        <div class="blog-grid-content">
                            <h5><a class="text-primary" href="#">20 Tools Every Homeowner Should Have</a>
                            </h5>
                            <p>You probably have a hammer, but that's just a start. These 20 tools and devices are
                                superstars for household projects and repairs. If you love tools or just need to
                                stock a basic...</p>
                            <p class="text-darker">
                                <time datetime="2019">September 1, 2019</time>
                            </p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="section-75 section-md-120 section-xl-150">
        <div class="container">
            <h2><span class="small">Meet The Team</span> People behind our success
            </h2>
            <div class="row row-40 justify-content-md-between">
                <div class="col-sm-6 col-lg-3"><img class="img-responsive" src="images/about-02-360x404.jpg"
                        alt="" width="360" height="404" />
                    <h6><a href="#"> Philip Hanson</a></h6><span class="small small-md">Electrician</span>
                    <p>Philip specializes in repairing electrical appliances and solving all kinds of electrical
                        issues you may encounter.</p>
                </div>
                <div class="col-sm-6 col-lg-3"><img class="img-responsive" src="images/about-03-360x404.jpg"
                        alt="" width="360" height="404" />
                    <h6><a href="#"> Adam Fowler</a></h6><span class="small small-md">Plumber</span>
                    <p>Adam is responsible for finding a solution to all kinds of pipe, plumbing and heating
                        breakages of modern buildings.</p>
                </div>
                <div class="col-sm-6 col-lg-3"><img class="img-responsive" src="images/about-04-360x404.jpg"
                        alt="" width="360" height="404" />
                    <h6><a href="#"> Phillip Miller</a></h6><span class="small small-md">Serviceman</span>
                    <p>Phillip is our expert in servicing various appliances. He has experience of previous work in
                        leading repair companies.</p>
                </div>
                <div class="col-sm-6 col-lg-3"><img class="img-responsive" src="images/about-05-360x404.jpg"
                        alt="" width="360" height="404" />
                    <h6><a href="#"> John Doe</a></h6><span class="small small-md">Technician</span>
                    <p>John has over 15 years of experience repairing home appliances. There is no job too big or
                        too small for him.</p>
                </div>
            </div>
        </div>
    </section><a class="section section-banner" href="https://www.templatemonster.com/website-templates/monstroid2.html"
        style="background-image: url(images/banner/background-03-1920x310.jpg); background-image: -webkit-image-set( url(images/banner/background-03-1920x310.jpg) 1x, url(images/banner/background-03-3840x620.jpg) 2x )"><img
            src="images/banner/foreground-03-1600x310.png"
            srcset="images/banner/foreground-03-1600x310.png 1x, images/banner/foreground-03-3200x620.png 2x"
            alt="" width="1600" height="310"></a>
@endsection
