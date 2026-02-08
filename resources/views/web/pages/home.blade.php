@extends('web.layouts.app')

@section('content')
    <style>
        .marginMain {
            margin-left: 270px;
        }
    </style>
    <!-- Full converted content from profile-bootstrap-master/index.html -->
    <div id="page-top">

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <span class="d-block d-lg-none  mx-0 px-0"><img src="{{ asset('web/img/logo-white.png') }}" alt=""
                        class="img-fluid"></span>
                <span class="d-none d-lg-block">
                    <img class="img-fluid img-profile rounded-circle mx-auto mb-2 " src="{{ asset('web/img/main.jpg') }}"
                        alt="">
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#experience">Experience</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#portfolio">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#skills">Skills</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#awards">Awards</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid p-0" style="padding-top: 70px;">

            <!-- ABOUT -->
            <section class="resume-section p-3 p-lg-5 d-flex d-column marginMain" id="about">
                <div class="my-auto">
                    <img src="{{ asset('web/img/logo-s.png') }}" class="img-fluid mb-3" alt="">
                    <h1 class="mb-0">{{ trns('kariem') }}
                        <span class="text-primary">{{ trns('ibrahiem') }}</span>
                    </h1>
                    <div class="subheading mb-5">{{ trns('THE NEXT BIG IDEA IS WAITING FOR ITS NEXT BIG CHANGER WITH ') }}
                        <a href="#">{{ trns('THEMSBIT') }}</a>
                    </div>
                    <p class="mb-5" style="max-width: 500px;">
                        {{ trns('I am experienced in Laravel frameworks to provide a  high level systems with perfect performance. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.') }}
                    </p>
                    <ul class="list-inline list-social-icons mb-0">
                        <li class="list-inline-item">
                            <a href="https://www.facebook.com/kemo.ibrahem.98/" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"> </i>
                                </span>
                            </a>
                        </li>
                        {{-- <li class="list-inline-item">
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li> --}}
                        <li class="list-inline-item">
                            <a href="https://www.linkedin.com/in/kariem-ibrahiem-903a0b2a7/" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://github.com/kariemibrahiem" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </section>

            <!-- EXPERIENCE -->
            <section class="resume-section p-3 p-lg-5 marginMain" id="experience">
                <div class="row my-auto">
                    <div class="col-12">
                        <h2 class="text-center">{{ trns('Experience') }}</h2>
                        <div class="mb-5 heading-border"></div>
                    </div>
                    <div class="resume-item col-md-6 col-sm-12 ">
                        <div class="card mx-0 p-4 mb-5"
                            style="border-color: #17a2b8; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.21);">
                            <div class=" resume-content mr-auto">
                                <h4 class="mb-3"><i class="fa fa-globe mr-3 text-info"></i>
                                    {{ trns('junior Back-end laravel developer') }}</h4>
                                <p>
                                    {{ trns('As a Back-end Developer at Phelera Company, my first professional role, I was responsible for developing and maintaining dashboards and web applications using the Laravel framework. I collaborated closely with senior developers, gained hands-on experience with best practices, resolved bugs, implemented new features, and consistently delivered assigned tasks within project deadlines.') }}
                                </p>


                            </div>
                            <div class="resume-date text-md-right">
                                <span class="text-primary">{{ trns('Sep 2024 - march 2025') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="resume-item col-md-6 col-sm-12">
                        <div class="card mx-0 p-4 mb-5"
                            style="border-color: #ffc107; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.21);">
                            <div class="resume-content mr-auto">
                                <h4 class="mb-3"><i class="fa fa-laptop mr-3 text-warning"></i>
                                    {{ trns(' Back-end laravel developer') }}</h4>
                                <p>
                                    {{ trns('As a mid-level back-end Laravel developer, I am responsible for designing, developing, and maintaining scalable systems, dashboards, and web applications, building and maintaining RESTful APIs, integrating and consuming internal and external APIs, implementing authentication and authorization systems, optimizing application performance, and ensuring clean and secure code architecture, collaborating with cross-functional teams, working with Odoo on the front-end side to customize views, templates, and user interfaces, handling data synchronization between Odoo and Laravel systems, designing, maintaining, and optimizing databases, writing efficient queries and migrations, managing server setup and deployment, configuring environments, uploading and maintaining projects on servers, monitoring system performance, and ensuring application stability and reliability.') }}
                                </p>


                            </div>
                            <div class="resume-date text-md-right">
                                <span class="text-primary">nov 2025 - present </span>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <!-- PORTFOLIO -->
            <section class="resume-section p-3 p-lg-5 d-flex marginMain flex-column marginMain" id="portfolio">
                <div class="row my-auto">
                    <div class="col-12">
                        <h2 class="  text-center">Portfolio</h2>
                        <div class="mb-5 heading-border"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="port-head-cont">
                            <button class="btn btn-general btn-green filter-b" data-filter="all">All</button>
                            <button class="btn btn-general btn-green filter-b" data-filter="consulting">Web
                                Design</button>
                            <button class="btn btn-general btn-green filter-b" data-filter="finance">Mobile Apps</button>
                            <button class="btn btn-general btn-green filter-b" data-filter="marketing">Graphics
                                Design</button>
                        </div>
                    </div>
                </div>
                <div class="row my-auto">
                    <div class="col-sm-4 portfolio-item filter consulting">
                        <a class="portfolio-link" href="https://demo.edarat365.com/admin/login" target="_blank">
                            <div class="caption-port">
                                <div class="caption-port-content" style="font-size: 13px;">
                                    {{ trns(' edarat is full realstate management system for pixel mart saudi company full designed and build with laravel .') }}
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ asset('web/img/projects/edarat.png') }}" alt="">
                        </a>
                    </div>
                    <div class="col-sm-4 portfolio-item filter finance">
                        <a class="portfolio-link" href="https://trvlgate.com/en" target="_blank">
                            <div class="caption-port">
                                <div class="caption-port-content" style="font-size: 13px;">
                                    {{ trns('travel  is a travel agency website that provides a wide range of travel services, including  hotel reservations, and tour packages, offering users a convenient platform to all services and book their travel arrangements.') }}
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ asset('web/img/projects/travel.png') }}" alt="">
                        </a>
                    </div>
                    <div class="col-sm-4 portfolio-item filter marketing">
                        <a class="portfolio-link" href="https://mawhebtac.com" target="_blank">
                            <div class="caption-port">
                                <div class="caption-port-content" style="font-size: 13px;">
                                    {{ trns('Mawhebtac is a comprehensive talent acquisition and management platform designed to streamline the recruitment process for businesses. It offers a range of features including talent posting, candidate sourcing, applicant tracking, and analytics to help companies efficiently find and manage top talent.') }}
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ asset('web/img/projects/mawhebtac.png') }}" alt="">
                        </a>
                    </div>
                    <div class="col-sm-4 portfolio-item filter consulting">
                        <a class="portfolio-link" href="https://elmazon.com" target="_blank">
                            <div class="caption-port">
                                <div class="caption-port-content" style="font-size: 13px;">
                                    {{ trns('Elmazon is full LMS system connect teacher with all student and manege the learning process.') }}
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ asset('web/img/projects/elmazon.png') }}" alt="">
                        </a>
                    </div>
                    <div class="col-sm-4 portfolio-item filter consulting">
                        <a class="portfolio-link" href="https://crm.clinizone.net/" target="_blank">
                            <div class="caption-port">
                                <div class="caption-port-content" style="font-size: 13px;">
                                    {{ trns('Clinizone CRM is a customer relationship management system designed specifically for healthcare providers, offering features such as patient management, appointment scheduling, and communication tools to enhance patient care and streamline administrative tasks.') }}
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ asset('web/img/projects/clinizone.png') }}" alt="">
                        </a>
                    </div>

                    <div class="col-sm-4 portfolio-item filter finance">
                        <a class="portfolio-link" href="https://atabe.com" target="_blank">
                            <div class="caption-port">
                                <div class="caption-port-content" style="font-size: 13px;">
                                    {{ trns('Atabe is a platform to provide direct relation between lawyers and customers and handle all court cases steps and processes.') }}
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ asset('web/img/projects/atabe.png') }}" alt="">
                        </a>
                    </div>
                    <div class="col-sm-4 portfolio-item filter marketing">
                        <a class="portfolio-link" href="https://hubsparepart.com" target="_blank">
                            <div class="caption-port">
                                <div class="caption-port-content" style="font-size: 13px;">
                                    {{ trns('Hub Spare Part is an e-commerce platform that specializes in providing a wide range of spare parts for various industries, offering customers a convenient and reliable online shopping experience for their spare part needs.') }}
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ asset('web/img/projects/hubsparepart.png') }}"
                                alt="">
                        </a>
                    </div>
                    <div class="col-sm-4 portfolio-item filter marketing">
                        <a class="portfolio-link" href="https://zakat.topbusiness.io/admin" target="_blank">
                            <div class="caption-port">
                                <div class="caption-port-content" style="font-size: 13px;">
                                    {{ trns('Zakat is a comprehensive zakat management system designed to facilitate the calculation, collection, and distribution of zakat funds in accordance with Islamic principles, providing users with a convenient platform to fulfill their zakat obligations and contribute to charitable causes.') }}
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ asset('web/img/projects/zakar.png') }}" alt="">
                        </a>
                    </div>
                    <div class="col-sm-4 portfolio-item filter finance">
                        <a class="portfolio-link" href="https://esoiegypt.cloud/" target="_blank">
                            <div class="caption-port">
                                <div class="caption-port-content" style="font-size: 13px;">
                                    {{ trns('ESOIEgypt is a comprehensive educational platform  build on Rocket LMS system that provides a wide range of online courses, resources, and tools to support students and educators in Egypt, fostering accessible and quality education for all.') }}
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ asset('web/img/projects/esoi.png') }}" alt="">
                        </a>
                    </div>
                </div>
            </section>

            <!-- SKILLS -->
            <section class=" d-flex flex-column marginMain" id="skills">
                <div class="p-lg-5 p-3 skill-cover">
                    <h3 class="text-center text-white">Coding Skills</h3>
                    <div class="row text-center my-auto ">
                        <div class="col-md-3 col-sm-6">
                            <div class="skill-item">
                                <img src="{{ asset('web/img/skills/php.png') }}" alt=""
                                    style="width: 80px; height: 80px;">
                                <p>php</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="skill-item">
                                <img src="{{ asset('web/img/skills/laravel.png') }}" alt=""
                                    style="width: 80px; height: 80px;">
                                <p>laravel</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="skill-item">
                                <img src="{{ asset('web/img/skills/sql.png') }}" alt=""
                                    style="width: 80px; height: 80px;">
                                <p>sql</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="skill-item">
                                <img src="{{ asset('web/img/skills/javascript.png') }}" alt=""
                                    style="width: 80px; height: 80px;">
                                <p>javascript</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="skill-item">
                                <i class="fa fa-html5 fa-5x"></i>
                                <p>HTML5</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="skill-item">
                                <i class="fa fa-css3 fa-5x"></i>
                                <p>CSS3</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="skill-item">
                                <i class="fa fa-code fa-5x"></i>
                                <p>JQuery</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="skill-item">
                                <img src="{{ asset('web/img/skills/bootstrap.png') }}" alt=""
                                    style="width: 80px; height: 80px;">
                                <p>bootstrap</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- AWARDS -->
            <section class="resume-section p-3 p-lg-5 marginMain d-flex flex-column" id="awards">
                <div class="row my-auto">
                    <div class="col-12">
                        <h2 class="  text-center">Techs</h2>
                        <div class="mb-5 heading-border"></div>
                    </div>
                    <div class="main-award" id="award-box">
                        <div class="award">
                            <div class="award-icon"></div>
                            <div class="award-content">
                                <h5 class="title">github</h5>

                            </div>
                        </div>
                        <div class="award">
                            <div class="award-icon"></div>
                            <div class="award-content">
                                <h5 class="title">payment</h5>
                                <p class="description">
                                    pyement with many payment gateways like hyperpay, tap, paymob, and more. and can handle
                                    good with any payment process and handle all the steps of it with good performance and
                                    security.
                                </p>
                            </div>
                        </div>
                        <div class="award">
                            <div class="award-icon"></div>
                            <div class="award-content">
                                <h5 class="title">CI/CD</h5>

                            </div>
                        </div>
                        <div class="award">
                            <div class="award-icon"></div>
                            <div class="award-content">
                                <h5 class="title">testing</h5>
                            </div>
                        </div>
                        <div class="award">
                            <div class="award-icon"></div>
                            <div class="award-content">
                                <h5 class="title">HMVC</h5>

                            </div>
                        </div>
                        <div class="award">
                            <div class="award-icon"></div>
                            <div class="award-content">
                                <h5 class="title">React</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CONTACT -->
            <section class="resume-section p-3 p-lg-5  marginMain d-flex flex-column">
                <div class="row my-auto" id="contact">
                    <div class="col-md-8">
                        <div class="contact-cont">
                            <h3>CONTACT Us</h3>
                            <div class="heading-border-light"></div>
                            <p></p>
                        </div>
                        <div class="row con-form">
                            <div class="col-md-12">
                                <input type="text" name="full-name" placeholder="Full Name" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="email" placeholder="Email Id" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="subject" placeholder="Subject" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <textarea name="" id=""></textarea>
                            </div>
                            <div class="col-md-12 sub-but"><button class="btn btn-general btn-white"
                                    role="button">Send</button></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mt-5">
                        <div class="contact-cont2">
                            <div class="contact-phone contact-side-desc contact-box-desc">
                                <h3><i class="fa fa-phone cl-atlantis fa-2x"></i> Phone</h3>
                                <p>+2001282119707</p>
                            </div>
                            <div class="contact-mail contact-side-desc contact-box-desc">
                                <h3><i class="fa fa-envelope-o cl-atlantis fa-2x"></i> Email</h3>
                                <address class="address-details-f">
                                    Email: <a href="mailto:info@themsbit.com"
                                        class="">kariemibrahiem110@gmail.com</a>
                                </address>
                                <ul class="list-inline social-icon-f top-data">
                                    <li><a href="https://www.facebook.com/kemo.ibrahem.98/" target="_empty"><i
                                                class="fa top-social fa-facebook"
                                                style="color: #4267b2; border-color:#4267b2;"></i></a></li>
                                    <li><a href="mailto:kariemibrahiem110@gmail.com" target="_empty"><i
                                                class="fa top-social fa-google-plus"
                                                style="color: #e24343; border-color:#e24343;"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class=" d-flex  marginMain flex-column" id="maps">
                <div id="map">
                    <div class="map-responsive">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d6030.418742494061!2d31.0126!3d30.5549!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2seg!4v1471908546569"
                            width="600" height="450" frameborder="0" style="border:0" allowfullscreen>
                        </iframe>

                    </div>
                </div>
            </section>

        </div>

        <!-- PORTFOLIO MODALS -->
        <!-- modal markup copied from template -->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal">
                        <div class="lr">
                            <div class="rl"></div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="modal-body">
                                <div class="title-bar">
                                    <div class="col-md-12">
                                        <h2 class="text-center">Our Project</h2>
                                        <div class="heading-border"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <img class="img-fluid img-centered"
                                            src="{{ asset('web/img/portfolio/p-1.jpg') }}" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <p>Our new Project every processes had become fragmented; meaning quality and
                                            service were inconsistent.</p>
                                        <ul class="list-inline item-details">
                                            <li>Client:
                                                <strong>
                                                    <a href="#">Techs Soft</a>
                                                </strong>
                                            </li>
                                            <li>Date:
                                                <strong>
                                                    <a href="#">April 2018</a>
                                                </strong>
                                            </li>
                                            <li>Service:
                                                <strong>
                                                    <a href="#">Web Development</a>
                                                </strong>
                                            </li>
                                        </ul>
                                        <button class="btn btn-general btn-white" type="button" data-dismiss="modal">
                                            <i class="fa fa-times"></i> Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional modals (2..9) omitted for brevity but can be added similarly if needed -->

        <!-- Global javascript -->
        <script src="{{ asset('web/js/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('web/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('web/js/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('web/js/counter/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('web/js/counter/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('web/js/custom.js') }}"></script>
        <script>
            $(document).ready(function() {

                $(".filter-b").click(function() {
                    var value = $(this).attr('data-filter');
                    if (value == "all") {
                        $('.filter').show('1000');
                    } else {
                        $(".filter").not('.' + value).hide('3000');
                        $('.filter').filter('.' + value).show('3000');
                    }
                });

                if ($(".filter-b").removeClass("active")) {
                    $(this).removeClass("active");
                }
                $(this).addClass("active");
            });

            // SKILLS
            $(function() {
                $('.counter').counterUp({
                    delay: 10,
                    time: 2000
                });

            });
        </script>

    </div>
@endsection
