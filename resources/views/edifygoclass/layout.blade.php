<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="{{ asset('edifygo_assets') }}/image/favicon.png" type="image/gif">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('edifygo_assets') }}/css/bootstrap.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('edifygo_assets') }}/css/animate.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('edifygo_assets') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('edifygo_assets') }}/css/owl.theme.default.min.css">
    <!-- Font Awsome CSS -->
    <link rel="stylesheet" href="{{ asset('edifygo_assets') }}/css/font-awesome.min.css">
    <!-- Lightbox galary CSS -->
    <link rel="stylesheet" href="{{ asset('edifygo_assets') }}/css/lightgallery.min.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="{{ asset('edifygo_assets') }}/css/custom.css">
    <!-- Datatables CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/datatables/datatables.min.css">
    <!-- Jquery Confirm Box CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/library/jquery-confirm/jquery-confirm.min.css">
    <!-- daterangepicker CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets') }}/library/bootstrap-4-master/build/css/tempusdominus-bootstrap-4.min.css" />
    <!-- ion.rangeSlider CSS-->
    <link rel="stylesheet" href="{{ asset('edifygo_assets') }}/css/ion.rangeSlider.min.css">

    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap"
        rel="stylesheet">
    <style type="text/css">
        body {
            font-family: 'Muli', sans-serif;
        }
    </style>
    <title>OKTAT - The Admission App</title>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-158382309-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-158382309-1');
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, 3, 1, i) {
                [1] = w[1] IT(; W[1].push({
                        'gtm.start': new Date().getTime(),
                        event: 'gtm.js'
                    });
                    var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = 1 != 'dataLayer' ? '&l=' + 1 :
                        ''; j.async = true; j.src 'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode
                    .insertBefore(j, 1);
                })(window, document, 'script', 'dataLayer', 'GTM-W39ZD46');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '2440445669604958');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=2440445669604958&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->
    <script type="text/javascript">
        _linkedin_partner_id = "976251";
        window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
        window._linkedin_data_partner_ids.push(_linkedin_partner_id);
    </script>
    <script type="text/javascript">
        (function() {
            var s = document.getElementsByTagName("script")[0];
            var b = document.createElement("script");
            b.type = "text/javascript";
            b.async = true;
            b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
            s.parentNode.insertBefore(b, s);
        })();
    </script>
    <noscript>
        <img height="1" width="1" style="display:none;" alt=""
            src="https://px.ads.linkedin.com/collect/?pid=976251&fmt=gif" />
    </noscript>

</head>

<body id="cl_search">

    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W392D46" height="0" width="0"
            style="display:none;visibility:hidden;"></iframe>
    </noscript> <!-- End Google Tag Manager (noscript) -->


    <!-- main loader -->
    <div class="loading">
        <div class="load-circle">
        </div>
    </div>


    <header>
        <!-- <div class="advertisement-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>50% Off + Extra 20% Off (7th - 14th November)</strong> On Memberships & Session Packs</p>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="top-heder">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="top-header-inner">
                            <ul class="nav">
                                @if (!session('class_login_session') && !session('student_login_session'))
                                    <li>
                                        <a target="_blank"
                                            href="https://play.google.com/store/apps/details?id=com.techhive.oktat"><img
                                                src="{{ asset('edifygo_assets') }}/image/playstore.png"></a>
                                    </li>
                                    <li>
                                        <a href="/class/login" class="btn btn-classreg sp">Class Sign-In</a>
                                        <a href="/student/login" class="btn btn-classreg">Student Sign-In</a>
                                    </li>
                                    <!-- <li>
                                        <a href="/class/registration" class="btn btn-classreg">Class Registration</a>
                                    </li> -->
                                @else
                                    @if (session('class_login_session'))
                                        <li class="dropdown">
                                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                                                role="button" aria-haspopup="true" aria-expanded="false"><i
                                                    class="fa fa-user"></i> MY ACCOUNT</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="/create_course">Create Course</a>
                                                <a class="dropdown-item"
                                                    href="{{ url('listcourse/' . session('class_login_session_id') . '') }}">View
                                                    Course</a>
                                                <a class="dropdown-item" href="/editcourse">List Course</a>
                                                <a class="dropdown-item" href="/view_profile">View Profile</a>
                                                <a class="dropdown-item" href="/add">Advertise With Oktat</a>
                                                <a class="dropdown-item" href="/change_password">Change Password</a>
                                                <!-- <a class="dropdown-item" href="/faq">List FAQ</a> -->
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="/class_logout">Logout</a>
                                            </div>
                                        </li>
                                    @elseif(session('student_login_session'))
                                        <li class="dropdown">
                                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                                                role="button" aria-haspopup="true" aria-expanded="false"><i
                                                    class="fa fa-user"></i> MY ACCOUNT</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="/student/profile">View Profile</a>
                                                <a class="dropdown-item" href="/student/enrolllist">View Enroll
                                                    Courses</a>
                                                <a class="dropdown-item" href="/student/change_password">Change
                                                    Password</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="/student/logout">Logout</a>
                                            </div>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand" href="/">
                        <img src="{{ asset('edifygo_assets') }}/image/logo.png">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                    @if (!session()->exists('class_login_session'))
                        <ul class="list-unstyled mb-0 city-dropdown">
                            <li>
                                <select class="form-control" id="city_id1" name="city_id1"
                                    onchange="change_session(this)">
                                    <option value="">Select City</option>
                                    @if (!empty(session('all_city_session')))
                                        @foreach (session('all_city_session') as $key => $value)
                                            <option {{ session('city_id') == $value->id ? 'selected=selected' : '' }}
                                                value="{{ $value->id }}">{{ $value->city_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </li>
                        </ul>
                        <ul class="list-unstyled mb-0 institute-dropdown ">
                            <li >
                                <select class="form-control" id="city_id1" name="city_id1"
                                    onchange="change_session(this)">
                                    <option value="">Select Institute</option>
                                    @if (!empty(session('all_city_session')))
                                        @foreach (session('all_city_session') as $key => $value)
                                            <option {{ session('city_id') == $value->id ? 'selected=selected' : '' }}
                                                value="{{ $value->id }}">{{ $value->city_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </li>
                        </ul>
                    @endif



                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/about">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/faq">FAQ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contact">Contact Us</a>
                            </li>
                        </ul>
                        <!-- <ul class="social-media">
                            <li>
                                <a href="https://www.facebook.com/oktatapp/" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/oktatapp/" target="_blank">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                        </ul> -->
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('edifygo_assets') }}/js/jquery.min.js"></script>


    <!-- Popper JS -->
    <script src="{{ asset('edifygo_assets') }}/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('edifygo_assets') }}/js/bootstrap.min.js"></script>

    <!-- Jquery validation -->
    <script src="{{ asset('assets') }}/library/jquery-validate/dist/jquery.validate.js"></script>
    <script src="{{ asset('assets') }}/library/jquery-validate/dist/additional-methods.min.js"></script>
    <script src="{{ asset('assets') }}/library/jquery-validate/dist/additional-methods.js"></script>
    <!-- For date picker -->
    <script src="{{ asset('assets') }}/js/moment.min.js"></script>

    <!-- daterangepicker JS-->
    <script type="text/javascript"
        src="{{ asset('assets') }}/library/bootstrap-4-master/build/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('edifygo_assets') }}/js/owl.carousel.min.js"></script>
    <!-- Wow JS -->
    <script src="{{ asset('edifygo_assets') }}/js/wow.min.js"></script>
    <!-- Lightbox galary JS -->
    <script src="{{ asset('edifygo_assets') }}/js/picturefill.min.js"></script>
    <script src="{{ asset('edifygo_assets') }}/js/lightgallery.min.js"></script>
    <script src="{{ asset('edifygo_assets') }}/js/lg-video.min.js"></script>
    <script src="{{ asset('edifygo_assets') }}/js/jquery.mousewheel.min.js"></script>

    <!-- Datatables JS -->
    <script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/datatables/datatables.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('edifygo_assets') }}/js/custom.js"></script>
    <script src="{{ asset('assets') }}/js/custom.js"></script>
    <!-- Jquery Confirm Box JS -->
    <script src="{{ asset('assets') }}/library/jquery-confirm/jquery-confirm.min.js"></script>

    <!-- ion.rangeSlider JS-->
    <script src="{{ asset('edifygo_assets') }}/js/ion.rangeSlider.min.js"></script>

    <script type="text/javascript">
        function openTermsMdl() {
            $('#class-termsModal').modal('show');
        }

        function openPolicyMdl() {
            $('#class-privacyModal').modal('show');
        }

        function openStudTermsMdl() {
            $('#stud-termsModal').modal('show');
        }

        function openStudRefundMdl() {
            $('#stud-refundModal').modal('show');
        }

        $(document).ready(function() {
            // cl_search
            $('#cl_search').removeClass('for-search');
            var current_url = '{{ Route::current()->getName() }}';
            var search_url = "search_classes";

            if (current_url == search_url) {
                $('#cl_search').addClass('for-search');
            }

            $("input[name='loginas']").change(function() {
                var loginas = $("input[name='loginas']:checked").val();
                // console.log(loginas);
                if (loginas == 1) {
                    $('#signup').attr('href', '/student/registration');
                    $('#valid_login').attr('action', '/student/check_login')
                } else {
                    $('#signup').attr('href', '/class/registration');
                    $('#valid_login').attr('action', '/class/check_login')
                }
            });


            $('#valid_login').validate({
                rules: {
                    username: {
                        required: true,
                        space: true,
                        minlength: 1,
                        maxlength: 50,
                    },
                    password: {
                        required: true,
                        space: true,
                        minlength: 8,
                        maxlength: 10
                    }
                },
                messages: {

                },
                submitHandler: function(form) {
                    form.submit();
                    $('#btn_submit').attr('disabled', 'disabled');
                }

            });

            //Initialize Select2 Elements
            // $('.select2').select2()

            // $('#tbl_mcat1').DataTable();

            $('.sorting-data').DataTable({
                "columnDefs": [{
                    "targets": 'no-sort',
                    "orderable": false,
                }]
            });

            /*$('#tbl_pattr').dataTable({
              "aLengthMenu": [[5], [5]],
              "iDisplayLength": 5,
              "columnDefs":[{
                "targets":'no-sort',
                "orderable":false,
              }]
            });

            $('.invoice').dataTable({
              dom: 't',
              ordering: false,
              paging: false,

              keys: true, //enable KeyTable extension
            });*/

        });

        function change_session(argument) {
            if (argument.value != "") {
                var city_id = argument.value;
                $.ajax({
                    url: '{{ route('edifygo_class.change_session') }}',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        city_id: city_id
                    },
                    success: function(data) {
                        window.location.reload();
                    }
                });
            } else {
                var city_id = 1;
                $.ajax({
                    url: '{{ route('edifygo_class.change_session') }}',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        city_id: city_id
                    },
                    success: function(data) {
                        window.location.reload();
                    }
                });
            }
        }
    </script>
    @yield('contents')
    <div class="col-md-12">
        <div class="error-msg-box">
            @if (session('success-msg'))
                <div class="alert alert-success close-alert" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{ session('success-msg') }}
                </div>
            @endif

            @if (session('error-msg'))
                <div class="alert alert-danger close-alert" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{ session('error-msg') }}
                </div>
            @endif
        </div>
    </div>

    <footer class="main-footer">
        <div class="top-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-12">
                        <div class="footer-logo ">
                            <div>
                                <img src="{{ asset('edifygo_assets') }}/image/logo.png" class="flogo d-flex align-items-center justify-content-center">
                                </div>
                            <div class="pt-3">
<h6 class="text-white text-center">Social Media</h6>
                                <ul class="f-social-media text-sm-center">
                                    <li><a target="_blank" href="https://www.facebook.com/oktatapp/"><i
                                                class="fa fa-facebook"></i></a></li>
                                    <li><a target="_blank" href="https://www.instagram.com/oktatapp/"><i
                                                class="fa fa fa-instagram"></i></a></li>
                                    <li><a target="_blank" href="https://www.linkedin.com/company/oktatapp/"><i
                                                class="fa fa-linkedin"></i></a></li>
                                    <!-- <li><a target="_blank" href="#"><i class="fa fa-twitter"></i></a></li> -->
                                    <li><a target="_blank"
                                            href="https://www.youtube.com/channel/UCII5eSgkIJ5CFd8vTQDRN2A"><i
                                                class="fa fa-youtube"></i></a></li>
                                    <li><a target="_blank"
                                            href="https://mail.google.com/mail/?view=cm&body=oktat.edu@gmail.com"><i
                                                class="fa fa-envelope"></i></a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-6">
                        <div>
                            <ul class="list-unstyled">
                                <li class="fs-6 pb-2"><b>Terms & Condition</b></li>
                                <li><a href="/class/registration">List on Oktat</a></li>
                                <li><a href="#">We are hiring</a></li>
                                <li><a href="#">Terms of use</a></li>
                                <li><a href="/privacy">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-6">
                        <ul class="list-unstyled">
                            <li class="fs-6 pb-2"><b>Offers</b></li>
                            <li><a href="/privacy">Privacy Policy</a></li>
                            <li><a href="/refund">Refunds & Cancellation</a></li>
                            <li><a href="#">Offer terms</a></li>
                            <li><a target="_blank" href="/student-terms">Terms & Condition</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-sm-12 ">
                        <div class="footer-info">

                            <h5><i class="fa fa-map-marker "></i></h5><span class="">
                                424 , Tulsi Arcade Nr Sudama Chowk Mota Varachha Surat GJ 394101
                            </span>
                        </div>
                        <div class="footer-info pt-2">
                            <h5><i class="fa fa-phone"></i>
                            </h5><span>
                                <p><a href="tel:+91 72111 13006">+91 72111 13006</a></p>
                                <p><a href="tel:+91 72111 13007">+91 72111 13007</a></p>
                            </span>
                        </div>

                        <div class="footer-info pt-2">
                            <h5><i class="fa fa-envelope"></i></h5><span>
                                <p><a href="mailto:info@oktat.in">info@oktat.in</a></p>
                                <p><a href="mailto:support@oktat.in">support@oktat.in</a></p>
                            </span>
                        </div>


                    </div>
                </div>
                <div class="row pt-5 d-flex align-items-center justify-content-center">
                    <div class="col-lg-6">

                            <div class="footer-playstore text-sm-center">

                                <a target="_blank"
                                    href="https://play.google.com/store/apps/details?id=com.techhive.oktat"><img
                                        src="{{ asset('edifygo_assets') }}/image/playstore.png"></a>
                            </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="text-center">
                            <p class="copyright">© 2019 Oktat Education Service Pvt. Ltd.</p>
                        </div>
                    </div>


                </div>
            </div>

        </div>

    </footer>





    <!-- Modal -->
    <div class="modal fade" id="class-termsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Class Terms and Conditions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>This agreement is entered on 24 August 2019 between:</p>
                            <ol>
                                <li>OKTAT EDUCATION SERVICE PRIVATE LIMITED, A Company incorporated under the Companies
                                    Act, 2013 having its Registered Office at 424 , Tulsi Arcade, Nr Sudama Chowk, Mota
                                    Varachha, Surat Gj 394101 represented by its authorized Signatory Directors
                                    hereinafter referred to as <b>“The COMPANY”/ “The Owner” , </b> (which expression
                                    shall unless excluded by or repugnant to the subject or context thereof shall and
                                    mean include its successors in interest and assigns)of the <b>ONE PART;</b> </li>
                                And
                                <li>______________________________________________ (Name of classes) of
                                    _____________________ (Address)represented by _________________________________
                                    (Name and designation of person signing) hereinafter referred to as “The Service
                                    Provider”/ “The Registered Tuition Class” (The RTC) ,(which expression shall unless
                                    excluded by or repugnant to the subject or context thereof shall and mean include
                                    its successors in interest and assigns)of the SECOND PART;</li>
                            </ol>
                            <h5 class="static-title">CONTENTS</h5>
                            <ol>
                                <li>Section 1: Introduction</li>
                                <li>Section 2: Definitions</li>
                                <li>Section 3: Becoming a Service provider / Registered Tuition Classes </li>
                                <li>Section 4: Responsibilities of Service provider / Registered Tuition Classes </li>
                                <li>Section 5: Terms of payment</li>
                                <li>Section 6: General</li>
                                <li>Section 7: Owner’s obligation</li>
                                <li>Section 8: Use of the Website</li>
                                <li>Section 9: Representations</li>
                                <li>Section 10: Indemnification</li>
                                <li>Section 11: Disclaimer</li>
                                <li>Section 12: Limitation of Liability</li>
                                <li>Section 13: Tax Matters</li>
                                <li>Section 14: Force Majeure</li>
                                <li>Section 15: Password Security</li>
                                <li>Section 16: Illegality</li>
                                <li>Section 17: Notice</li>
                                <li>Section 18: Dispute Resolution and governing law</li>
                            </ol>

                            <h5 class="static-title">Section 1: Introduction</h5>
                            <p>The First party is the Owner of the website named <a
                                    href="https://www.oktat.in/">www.oktat.in</a>. This agreement is a set of rules to
                                be followed by both the parties to maintain the ethics and working environment for both
                                the parties. These are the Code, Rules, and Standards which define the rights,
                                Obligations, duties, responsibilities and liabilities of both the parties.</p>

                            <p>It is important to note that a well governed business can grow more with the application
                                of ethical business practices and rules. </p>

                            <p>Objectives:</p>
                            <ol type="a">
                                <li>It will help the RTC to maintain the business ethically.</li>
                                <li>Direct the RTC to grow and create a good image in market.</li>
                                <li>Make aware of their Rights and Responsibilities.</li>
                                <li>Make aware of the Dos and Don’ts of the RTC.</li>
                                <li>--- Reserved ----</li>
                                <li>--- Reserved ----</li>
                            </ol>

                            <p>The terms and conditions of this relationship between both the parties are set forth in
                                following documents which are referred to “Relationship Documents:</p>
                            <ol>
                                <li>The Online Application Form</li>
                                <li>The offline KYC Approval</li>
                                <li>This agreement</li>
                                <li>Any other document</li>
                                <li>--- Reserved ----</li>
                            </ol>

                            <p>With the passage of time, each rules and standards need to be re-evaluated and that is
                                why these Relationship Documents are revised, modified or changed to cope-up with the
                                changing environment. In case of any change, the Owner will notify all such amendments
                                to the RTC by publication on its website <a
                                    href="https://www.oktat.in/">www.oktat.in</a> .</p>

                            <h5 class="static-title">Section 2: Definitions</h5>
                            <p>Where ever in this document or document referred above require any explanation, the
                                following words and phrases shall mean what is given below:</p>

                            <ol type="A">
                                <li>
                                    <h6>“Oktat” OR “The Owner” or “The Company” or “The First Party”:</h6>
                                    <p>It means Oktat Education Service Pvt. Ltd. a company registered under the
                                        Companies Act, 2013 having its registered office at 424 , Tulsi Arcade, Nr
                                        Sudama Chowk, Mota Varachha, Surat Gj 394101.</p>
                                </li>
                                <li>
                                    <h6>“The Registered Tuition Class” or “The RTC” or “The Client” or “The second
                                        part””:</h6>
                                    <p>It means any authorized person who agrees online / offline to avail the services
                                        of the Company. </p>
                                </li>
                                <li>
                                    <h6>“The Website” or URL :</h6>
                                    <p>The website refers to <a href="https://www.oktat.in/">www.oktat.in</a> or such
                                        other web portal, the owner deems fit to market or maintain on the world wide
                                        web including any mobile phone application.</p>
                                </li>
                                <li>
                                    <h6>“Students” or “The service receivers” or “The Users”:</h6>
                                    <p>It refers to the person who is searching the database or registering online /
                                        offline to use the services. </p>
                                </li>

                                <li>
                                    <h6>“Services”:</h6>
                                    <p>The service refers to the following services provided by the Owner:</p>
                                    <ul>
                                        <li></li>
                                        <li>Providing search engine for those who are searching for tuition classes or
                                            any education institute.</li>
                                        <li>Displaying online database of the RTC based on the user ratings, reviews,
                                            area, subject, batch time, batch size, fees, payment terms or any other
                                            parameter as the Owner deems fit.</li>
                                        <li>Providing payment gateway or intermediary between The Student and The RTC.
                                        </li>
                                        <li>Providing online platform to the RTC to market / advertise them.</li>
                                        <li>Providing study materials in the form of PDF file or online videos or in any
                                            other format or mode to the students.</li>
                                        <li>Reflecting online the user ratings and reviews, etc.</li>
                                        <li>Providing details of inquiries and generating leads.</li>
                                        <li>
                                            <Reserved>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <h6>“Business Year”:</h6>
                                    <p>It means a period beginning from April 1 and ending on March 31 of the following
                                        calendar year.</p>
                                </li>
                                <li>
                                    <h6>“Cross enquiry” / “offline admission”:</h6>
                                    <p>It means that the RTC diverting the leads / enquiries to other person, or other
                                        tuition class or his own other tuition class / brand name which is not
                                        registered with the Owner or granting admission offline i.e. sidelining the
                                        owner’s financial interest / charges.</p>
                                </li>
                                <li>
                                    <h6>“Market”:</h6>
                                    <p>It means the territory of a City in which the RTC is providing their service. In
                                        case of web based coaching centers, the market shall stand to India</p>
                                </li>
                                <li>
                                    <h6>“Membership Period” or “Listing period”:</h6>
                                    <p>It refers to any period mentioned in the offers. </p>
                                </li>
                                <li>
                                    <h6>“Membership Fees” or “Listing Fees” or “Advertisement Fees” or “Fees for Leads”
                                        or “ Service Charges” or “Handling charges”:</h6>
                                    <p>It refers to any kind of fees by whatever named called to avail the services as
                                        per the annexure. It shall mean the margin per transaction charged by the
                                        Company to the RTC at the rates agreed to between the parties, upon availing the
                                        services.</p>
                                </li>
                                <li>
                                    <h6>“ID Number”:</h6>
                                    <p>It is a unique online or offline relationship / registration number of all the
                                        RTC and the Users.</p>
                                </li>
                                <li>
                                    <h6>“Enrollment”:</h6>
                                    <p>An enrollment refers to admission confirmation by the User and the RTC. </p>
                                </li>
                                <li>
                                    <h6>“Trial period”:</h6>
                                    <p>Depending upon the offer and approved by the RTC, the users may avail benefit of
                                        admission without any payment to RTC. </p>
                                </li>
                                <li>
                                    <h6>“Tuition Fees”:</h6>
                                    <p>It refers to the fees prescribed on the website as approved by the RTC for the
                                        specified batches and subjects.</p>
                                </li>
                                <li>
                                    <h6>“Key Class information”:</h6>
                                    <p>It refers to the information based on which the users may take decision of
                                        enrollment, for eg,</p>
                                    <ol>
                                        <li>Fees,</li>
                                        <li>Batch time,</li>
                                        <li>course Period</li>
                                        <li>Seat availability</li>
                                        <li>Batch Size</li>
                                        <li>Expertise of the teaching faculty over the subject</li>
                                        <li>Contact details</li>
                                        <li>Place of tuition</li>
                                        <li>Exam pattern</li>
                                        <li>Communication with parents</li>
                                        <li>Mode of transports available</li>
                                        <li>Legal registrations, license, awards and accreditation obtained like local
                                            tuition class association registration, Fire safety NOC, ISO certificate
                                            etc. </li>
                                        <li>Others like photos, videos etc.</li>
                                    </ol>
                                </li>
                                <li>
                                    <h6>“E-commerce engine” </h6>
                                    <p>It shall mean and include the back end comprising a set of seamlessly integrated
                                        applications that manage the operations and various business work flows,
                                        including Catalogue Management; tuition class key information and price updates;
                                    </p>
                                </li>
                                <li>
                                    <h6>“On line promotions” </h6>
                                    <p>It shall mean promotions relating to show casing the RTC and their key
                                        information on the home page and store page of the Site;</p>
                                </li>
                                <li>
                                    <p>--- Reserved ----</p>
                                </li>
                                <li>
                                    <p>--- Reserved ----</p>
                                </li>
                            </ol>

                            <h5 class="static-title">Section 3: Becoming a RTC</h5>
                            <p>Fill, sign and deliver an online or offline Application Form along with the necessary
                                documents and supporting details.</p>

                            <ol type="A">
                                <li>
                                    <h6>Application cum registration:</h6>
                                    <p>An applicant to become a RTC must</p>
                                    <ol>
                                        <li>The RTC will be assigned a User id and password.</li>
                                        <li>Fill up, sign and file an online and/or offline Application for
                                            authorization to display and market their tuition class on the Website.</li>
                                        <li>Read and agreed to the terms available on Website.</li>
                                        <li>Update and keep updating key RTC information on the website.</li>

                                    </ol>
                                </li>
                                <li>
                                    <h6>Eligibility:</h6>
                                    <p>Without limiting The Owner’s rights, the following are requirements for becoming
                                        the RTC:</p>
                                    <ol type="i">
                                        <li>The Owner of RTC must be at least 18 years of age</li>
                                        <li>The teaching staff of RTC must be educated enough to manage tuition classes.
                                        </li>
                                        <li>The classes must have enough place to accommodate the batch size.</li>
                                        <li>The RTC must not be unable to manage his business due to mental or legal
                                            reasons;</li>
                                        <li>The RTC must not have been suspended from his current profession or business
                                            by any professional association, society, or institution;</li>
                                        <li>The RTC must not be involved in illegal / criminal activities.</li>
                                    </ol>
                                </li>
                                <li>
                                    <h6>Acceptance or Rejection or amending Application or delisting:</h6>
                                    <p>The owner reserves the right to accept or reject or amend any application or
                                        information uploaded or entered by RTC without having to give any explanation
                                        whatsoever. The owner has absolute right to delist any RTC.</p>
                                </li>
                                <li>
                                    <h6>Date of Authorization</h6>
                                    <p>An application shall be considered accepted when the Owner enters and approve
                                        online / offline the personal details in any manner whatsoever whether by issue
                                        of an ID number. The contact details and email id shall be updated once verified
                                        by the Owner. </p>
                                </li>
                                <li>
                                    <h6>Prohibited Practices:</h6>
                                    <p>The RTC, in the development of their business, will not demand from the Users:
                                    </p>
                                    <ol type="i">
                                        <li>To Pay any joining fee</li>
                                        <li>To pay admission fee</li>
                                        <li>To pay any charges apart from those mentioned on the website.</li>
                                        <li>To enroll offline.</li>
                                        <li>To cross enquiry</li>
                                        <li>To allow more discounts to offline or walk-in enquiries.</li>
                                        <li>
                                            <Reserved>
                                        </li>
                                    </ol>
                                </li>
                                <li>
                                    <h6>Membership / listing Period:</h6>
                                    <p>The RTC may choose the duration of service at the charges communicated online /
                                        offline. The owner has right to change the charges and listing period after
                                        prior communication of the RTC.</p>
                                </li>
                                <li>
                                    <h6>Renewal:</h6>
                                    <p>In order to remain a RTC, he/ she will have to update online the key class
                                        information on monthly basis. The RTC shall renew the offer or service after
                                        completion of the service / listing period.</p>
                                </li>
                                <li>
                                    <h6>Delisting by-default:</h6>
                                    <p>If a RTC does not:</p>
                                    <ul>
                                        <li>Update the key information on the website for 3 consecutive months / batch
                                        </li>
                                        <li>Pay/ clear dues within the 15 days of admission.</li>
                                        <li>Non-availability of seats for 6 consecutive months.</li>
                                        <li>Want to continue the listing and voluntarily delist themselves after
                                            approved by the owner. </li>
                                    </ul>
                                </li>
                                <li>
                                    <h6>Accuracy of data:</h6>
                                    <p>The RTC is responsible for the data accuracy and the details available on the
                                        website. </p>
                                </li>
                                <li>
                                    <h6>Image and videos ethics:</h6>
                                    <p>The image displayed on the website must not contain any contact details or email
                                        id.</p>
                                </li>
                                <li>
                                    <p>---- Reserved -----</p>
                                </li>
                                <li>
                                    <p>---- Reserved -----</p>
                                </li>
                                <li>
                                    <p>---- Reserved -----</p>
                                </li>
                            </ol>

                            <h5 class="static-title">Section: 4 Responsibilities of RTC</h5>
                            <ol type="A">
                                <li>
                                    <h6>Cross Group Selling:</h6>
                                    <p>RTC shall not cross sell the lead. RTC shall inform the owner regarding each
                                        admissions and enrollments through the website. The RTC will also inform the
                                        owner regarding offline enrollments of students who enquired through website and
                                        owner.</p>
                                </li>
                                <li>
                                    <h6>Equal Tuition Fees / competitive fees:</h6>
                                    <p>The RTC shall always quote the best, lower or equal fees on portal than to
                                        offline enquiries. The fees must be inclusive of all taxes. The RTC shall never
                                        quote tuition fees lower than mentioned on the website. If you have actually
                                        lowered the fees, than update the portal immediately. </p>
                                </li>
                                <li>
                                    <h6>Availability:</h6>
                                    <p>The Company shall not be responsible for claims made by the users for inaccurate
                                        seat availability details that are displayed on the website due to any
                                        negligence / default on the part of the RTC to provide updated and accurate seat
                                        availability information. The Merchant shall be required to retain adequate
                                        seats listed on the website for successful fulfillment of enquiries /
                                        enrollment. The merchant is required to send updated seat availability list on
                                        the website at least once a month.</p>
                                </li>
                                <li>
                                    <h6>The RTC cannot:</h6>
                                    <ol type="i">
                                        <li>Make exaggerated claims or guaranteed claims with regard to service and
                                            achievements.</li>
                                        <li>In any way whatsoever, represent any key content incorrectly with regard to
                                            fees, quality, standards, grades, contents, style of teaching, exam pattern
                                            or model, place , batch size, achievers or seat availability.</li>
                                        <li>Update or change the key class information once the admission is confirmed.
                                        </li>
                                        <li>Allow more discounts to offline enquiries or displaying lower fees without
                                            prior intimation to the owner. </li>
                                        <li>---- Reserved -----</li>
                                    </ol>
                                </li>
                                <li>
                                    <h6>Discounts:</h6>
                                    <p>The owner has complete right over discount in service charges to to be collected
                                        from the users. In case of bulk enrolments by the users, the RTC may be
                                        requested to provide discounts in the tuition fees. The Company will collect
                                        service charge on the Discounted Price.</p>
                                </li>
                                <li>
                                    <h6>Confirmations and updates:</h6>
                                    <p>The confirmation for enquiries, admission or enrollment has to be responded
                                        online by the RTC and to the tele-caller duly appointed by the owner.</p>
                                </li>
                                <li>
                                    <h6>User Refunds:</h6>
                                    <p>The user refunds shall be paid by the RTC on pro-rata basis. The service charges
                                        collected by the owner shall not be refunded in any case. Neither the User nor
                                        the RTC can claim refund from the Owner. The RTC is required to indemnify the
                                        Company for any claim, legal actions, suit, etc. which will be filed or which
                                        originated because of any failure by the RTC.</p>
                                </li>
                                <li>
                                    <h6>Compliance with Applicable Laws, Regulations and Codes:</h6>
                                    <p>The RTC shall comply with all laws, regulations and codes that apply to the
                                        operation of their business and the Company does not ensure or make
                                        representations with respect to the quality or extent of effort or expense
                                        required to comply with such laws, regulations and/or codes.</p>
                                </li>

                                <li>
                                    <h6>Deceptive or Unlawful Practices:</h6>
                                    <p>No RTC shall engage in any deceptive or unlawful practice. A deceptive or
                                        unlawful trade practice is one, which has been defined as such by any central,
                                        state, or local law or regulation. </p>
                                </li>
                                <li>
                                    <h6>Professionalism:</h6>
                                    <p>The RTC shall at all times conduct himself or herself in a courteous and
                                        considerate manner and shall not differentiate the enquiries or enrollment on
                                        the basis of online enquiries, offline enquiries, walk in enquiries, race, sex,
                                        religion or caste. </p>
                                </li>
                                <li>
                                    <h6>Independent Business Entity:</h6>
                                    <p>The Company and the RTC is independent and nothing in this agreement refers to
                                        employer or employee relation between the parties. The RTC shall not refer the
                                        company as “agents,” “managers,” or “representatives”, nor shall they use such
                                        terminology or descriptive phrases on their stationery or other printed
                                        material. </p>
                                </li>
                                <li>
                                    <h6>Privacy and Confidentiality: </h6>
                                    <p>All RTC are required to abide by full privacy with regard to the contact details,
                                        other personal data of the Users and enquiries. The RTC shall indemnify the
                                        company for legal compliance or any legal action due to breach of privacy by RTC
                                        or any person who is authorized to access the Website. </p>
                                </li>
                                <li>
                                    <p>--- Reserved----</p>
                                </li>
                            </ol>

                            <h5 class="static-title">Section 5: Terms of payment</h5>
                            <ol type="A">
                                <li>
                                    <p>The Company shall collect the service charges at the rate prescribed in the
                                        annexure on each enquiries and enrollments made through the owner and the
                                        website. </p>
                                </li>
                                <li>
                                    <p>The subscription of the RTC will be valid till the end of the business year.</p>
                                </li>
                                <li>
                                    <p>The owner shall, at any time, revise the rate of service charge by intimating the
                                        RTC in writing or through mail or by any other mode or by sending notification
                                        on the Site seven days in advance. It shall be the RTC’s responsibility to
                                        review the emails / notifications of the Company from time to time. The RTC’s
                                        continued use of the Site after such modifications/ amendments/ revisions of the
                                        Service Charge shall be deemed as acceptance of such modifications/ amendments/
                                        revisions.</p>
                                </li>
                                <li>
                                    <p>The Company shall make payment to the RTC within 7 days of payments received from
                                        students after deducting the prescribed Service charge or accumulated charges.
                                        The aforesaid Service Charge shall be exclusive of taxes which is subject to
                                        offers for the time being in force.</p>
                                </li>
                                <li>
                                    <p>The RTC acknowledges that the Company shall, at all times, have the right and
                                        option to deduct/adjust any payments due to or from the RTC in one transaction
                                        against any payments due to or from the RTC in other transactions.</p>
                                </li>
                                <li>
                                    <p>The RTC must accept the payments through RTC only for any admission or enquiries
                                        or enrollments.</p>
                                </li>
                                <li>
                                    <p>The RTC shall provided bank details required for online transfer directly or
                                        issueing a cheque.</p>
                                </li>
                                <li>
                                    <p>… reserved….</p>
                                </li>
                                <li>
                                    <p>…. Reserved……</p>
                                </li>
                            </ol>

                            <h5 class="static-title">Section 6 : General</h5>
                            <ol type="A">
                                <li>
                                    <h6>Display of name:</h6>
                                    <p>The names on the website are displayed in alphabetical order which is depending
                                        upon the preferences and filters / parameters selected by the Users. Currently,
                                        no biasness or priority is given for order of display of names. But the Owner
                                        has full right over preferential display of names.</p>
                                </li>
                                <li>
                                    <h6>Advertisement:</h6>
                                    <p>The advertisement in the form of banners, flash news, updates, offer or in any
                                        manner does not guarantee fixed numbers enquiries or enrollments. The charges
                                        for advertisement are non-refundable.</p>
                                </li>
                                <li>
                                    <h6>Enquiries:</h6>
                                    <p>The details of enquiry for the specific RTC is available on their log in portal.
                                        The owner has right to share the category-wise enquiries with any other RTC or
                                        any other person.</p>
                                </li>
                                <li>
                                    <h6>Discount:</h6>
                                    <p>The discount in handling charges to Users are in the scope of the Owner and the
                                        RTC has no right over it. The decision of the owner shall be final.</p>
                                </li>
                                <li>
                                    <p>… reserved…</p>
                                </li>
                                <li>
                                    <p>… reserved…</p>
                                </li>
                            </ol>

                            <h5 class="static-title">Section 7 : Owner’s obligation</h5>
                            <ol type="A">
                                <li>
                                    <h6>Site and Pages:</h6>
                                    <p>Company agrees to:</p>
                                    <ol type="i">
                                        <li>Develop, implement and maintain the site in substantial conformance with
                                            specifications;</li>
                                        <li>II. Author, develop and display pages to market the Products in substantial
                                            conformance with the specifications.</li>
                                    </ol>
                                </li>
                                <li>
                                    <h6>Back up and Security Measures:</h6>
                                    <p>Company shall be solely responsible for all expenses, costs and fees of the
                                        creation, revision, display, hosting and transmission of the Pages, back-up and
                                        mirror servers and contingency and disaster recovery planning, services and
                                        equipment. In addition, Company shall undertake commercially reasonable security
                                        measures to prevent unauthorized use and ensure the security, confidentiality
                                        and integrity of the Products on and within the Site, including, without
                                        limitation:</p>
                                    <ul>
                                        <li>Password access and firewall protection;</li>
                                        <li>maintenance of independent archival and backup copies of the Pages; and</li>
                                        <li>Protection from any network attack or other malicious harmful or disabling
                                            data, work, code or program.</li>
                                    </ul>
                                </li>
                                <li>
                                    <p>Reserved…..</p>
                                </li>
                            </ol>

                            <h5 class="static-title">Section 8: Use of the Website</h5>
                            <ol type="A">
                                <li>
                                    <p>The RTC hereby agrees and understands that the company and the Site merely
                                        provide hosting services to its registered users and persons browsing/visiting
                                        the Website. All items advertised / listed and the contents therein are
                                        advertised and listed by registered users and are third party user generated
                                        contents. The company neither originates nor initiates the transmission nor
                                        selects the sender and receiver of the transmission nor selects nor modifies the
                                        information contained in the transmission. The company has no control over the
                                        third party user generated contents.</p>
                                </li>
                                <li>
                                    <p>The RTC agree, undertake and confirm that your use of the Website shall be
                                        strictly governed by the following binding principles:</p>
                                    <p>The RTC hall not host, display, upload, modify, publish, transmit, update or
                                        share any information which:</p>
                                    <ul>
                                        <li>belongs to another person and over which it has no right;</li>
                                        <li>is grossly harmful, harassing, blasphemous, defamatory, bigotry, obscene,
                                            pornographic, paedophilic, libellous, invasive of another’s privacy,
                                            hateful, or racially, ethnically objectionable, disparaging, relating to or
                                            encouraging money laundering or gambling, or otherwise unlawful in any
                                            manner whatever, or unlawfully threatening or harassing, including but not
                                            limited to ‘indecent representation of women’ within the meaning of the
                                            Indecent Representation of Women (Prohibition) Act, 1986;</li>
                                        <li>is false, inaccurate or misleading in any way;</li>
                                        <li>is patently offensive to the online community, such as sexually explicit
                                            content or content that promotes obscenity, pedophilia, racism, bigotry,
                                            hatred, or physical harm of any kind against any group or individual;</li>
                                        <li>harasses or advocates harassment of another person;</li>
                                        <li>involves the transmission of ‘junk mail’, ‘chain letters’, unsolicited mass
                                            mailing, or ‘spamming’;</li>
                                        <li>promotes illegal activity or conduct that is abusive, threatening, obscene,
                                            defamatory, or libelous;</li>
                                        <li>infringes upon or violates any third party's rights [including but not
                                            limited to intellectual property rights, rights of privacy (including
                                            without limitation unauthorized disclosure of a person's name, email
                                            address, physical address, or phone number) or rights of publicity];</li>
                                        <li>promotes an illegal or unauthorized copy of another person's copyrighted
                                            work such as providing pirated computer programs or links, information to
                                            circumvent manufacturer-installed copy-protect devices, or pirated music or
                                            links to pirated music files;</li>
                                        <li>contains restricted or password-only access pages, hidden pages or images
                                            (those not linked to or from another accessible page);</li>
                                        <li>provides material that exploits people in a sexual, violent or otherwise
                                            inappropriate manner or solicits personal information from anyone;</li>
                                        <li>provides instructional information about illegal activities such as making
                                            or buying illegal weapons, violating someone's privacy, providing or
                                            creating computer viruses;</li>
                                        <li>contains unauthorized videos, photographs or images of another person
                                            (whether a minor or an adult);</li>
                                        <li>tries to gain unauthorized access or exceeds the scope of authorized access
                                            to the Website, profiles, blogs, communities, account information,
                                            bulletins, friend requests, or other areas of the Website, or solicits
                                            passwords or personal identifying information for commercial or unlawful
                                            purposes from other users on the Website;</li>
                                        <li>engages in commercial activities and/or sales such as contests, sweepstakes,
                                            barter, advertising, pyramid schemes, or the buying or selling of ‘virtual’
                                            items related to the Website without our prior written consent.</li>
                                        <li>solicits gambling or engages in any gambling activity which we, at our sole
                                            discretion, believe is or could be construed as being illegal;</li>
                                        <li>interferes with another’s use and enjoyment of the Website;</li>
                                        <li>refers to any website/URL which, at our sole discretion, contains material
                                            that is inappropriate for the Website or any other website and content that
                                            is prohibited or violates the letter;</li>
                                        <li>harms minors in any way;</li>
                                        <li>infringes any patent, trademark, copyright, proprietary rights,
                                            third-party’s trade secrets, rights of publicity, or privacy, is fraudulent,
                                            or involves the sale of counterfeit or stolen items;</li>
                                        <li>violates any law for the time being in force;</li>
                                        <li>deceives or misleads the addressee/ users about the origin of messages or
                                            communicates any information which is grossly offensive or menacing in
                                            nature;</li>
                                        <li>impersonates another person;</li>
                                        <li>contains software viruses or any other computer codes, files, or programs
                                            designed to interrupt, destroy, or limit the functionality of any computer
                                            resource; or contains any trojan horses, worms, time bombs, cancelbots,
                                            easter eggs, or other computer programming routines that may damage,
                                            detrimentally interfere with, diminish value of, surreptitiously intercept,
                                            or expropriate any system, data, or personal information;</li>
                                        <li>threatens the unity, integrity, defense, security or sovereignty of India,
                                            friendly relations with foreign states, or public order or causes incitement
                                            to the commission of any offence or prevents investigation of any offence or
                                            is insulting any other nation;</li>
                                        <li>shall, directly or indirectly, offer or attempt to offer trade or attempt to
                                            trade in any item which is prohibited or restricted in any manner under the
                                            provisions of any applicable law, rule, regulation or guideline for the time
                                            being in force;</li>
                                        <li>shall create liability for us or cause us to lose (in whole or part) the
                                            services of our Internet Service Provider (“ISPs”) or other suppliers.</li>
                                    </ul>
                                </li>
                                <li>The RTC shall not use any ‘deep-link’, ‘page-scrape’, ‘robot’, ‘spider’, automatic
                                    device, program, algorithm, methodology, or any similar or equivalent manual process
                                    to access, acquire, copy, monitor any portion of the Site or content or in any way
                                    reproduce, or circumvent the navigational structure, presentation of the Site, or
                                    any content to obtain or attempt to obtain any material, documents, or information
                                    through any means not purposely made available through the Site. We reserve our
                                    right to bar any such activities.</li>
                                <li>The RTC shall not attempt to gain unauthorized access to any portion or feature of
                                    the Website, other systems, networks connected to the site, server, computer,
                                    network, or the services offered on or through the site by hacking, password
                                    ‘mining’, or any other illegitimate means.</li>
                                <li>The RTC may not forge headers or otherwise manipulate identifiers in order to
                                    disguise the origin of any message, transmittal send to us on or through the
                                    Website, or any service offered on or through the site. The RTC may not pretend that
                                    it represents someone else or impersonate any other individual or entity.</li>
                                <li>… reserved..</li>
                                <li>… reserved..</li>
                            </ol>


                            <h5 class="static-title">Section 9: Representations</h5>
                            <ol type="A">
                                <li>
                                    <p>RTC hereby represent and warrant to us that:</p>
                                    <ol type="a">
                                        <li>if RTC is a business entity, it is duly organized, validly existing and in
                                            good standing under the Laws of the territory in which its business is
                                            registered and are a resident of India for income tax purposes every
                                            financial year;</li>
                                        <li>RTC has all requisite right, power and authority to enter into this
                                            Agreement and perform its obligations and grant the rights, licences and
                                            authorizations hereunder; and</li>
                                        <li>RTC and all of its subcontractors, agents and suppliers will comply with all
                                            applicable Laws in performance of obligations and exercise of rights under
                                            this Agreement.</li>
                                    </ol>
                                </li>
                                <li>… reserved..</li>
                            </ol>

                            <h5 class="static-title">Section 10: Indemnification</h5>
                            <ol type="A">
                                <li>
                                    <p>The RTC release us from, and agree to indemnify, defend and hold harmless us (and
                                        our officers, directors, employees, agents and Affiliates) against, any claim,
                                        loss, damage, settlement, cost, taxes, expense or other liability (including,
                                        without limitation, attorneys' fees) (each, a "Claim") arising from or related
                                        to: </p>
                                    <ol type="a">
                                        <li>RTC’s actual or alleged breach of any obligations in this Agreement;</li>
                                        <li>any Tuition places owned or operated by RTC, its service (including the
                                            offer, claims, fulfilment, refund, adjustment, or others thereof), RTC’s
                                            study Materials, any actual or alleged infringement of any Intellectual
                                            Property Rights by any of the foregoing, and any personal injury, death or
                                            property damage related thereto; or</li>
                                        <li>merchant’s taxes. The RTC will use counsel reasonably satisfactory to us to
                                            defend each indemnified Claim. If at any time we determine in our sole
                                            discretion that any indemnified Claim might adversely affect us, we may take
                                            exclusive control of the defence at our expense. The RTC may not consent to
                                            the entry of any judgment or enter into any settlement of a Claim without
                                            our prior written consent, which may not be unreasonably withheld.</li>
                                    </ol>
                                </li>
                                <li>… reserved..</li>
                            </ol>

                            <h5 class="static-title">Section 11: Disclaimer</h5>
                            <ol type="A">
                                <li>
                                    <p>The services, including all content, software, functions, materials and
                                        information available or provided in connection with the services, are provided
                                        "as-is." as a user of the services, RTC access the website, the services or tool
                                        provided by the company to help merchant avail the services at its own risk. We
                                        waive and disclaim: </p>
                                    <ol type="i">
                                        <li>any representations, warranties, declarations or guarantees regarding this
                                            agreement, the services or the transactions contemplated hereby, including
                                            any implied warranties, declarations or guarantees of merchantability,
                                            fitness for a particular purpose or non-infringement; </li>
                                        <li>implied warranties arising out of course of dealing, course of performance
                                            or usage of trade; and </li>
                                        <li>any obligation, liability, right, claim or remedy in tort, whether or not
                                            arising from our negligence. We do not warrant that the functions contained
                                            in the website or the services will meet your requirements or be available,
                                            timely, secure, uninterrupted or error free, and we will not be liable for
                                            any service interruptions, including, but not limited to system failures or
                                            other interruptions that may affect the receipt, processing, acceptance,
                                            completion or settlement of any transactions. Some jurisdictions' laws do
                                            not allow exclusion of an implied warranty. In which case the foregoing
                                            disclaimer may not apply to you, and we disclaim to the maximum extent
                                            permitted under applicable law all warranties of any kind, whether express,
                                            implied or statutory, including without limitation warranties of
                                            merchantability, satisfactory quality, fitness for a particular purpose,
                                            title, non- infringement or quiet enjoyment.</li>
                                    </ol>
                                </li>
                                <li>… reserved..</li>
                            </ol>

                            <h5 class="static-title">Section 12: Limitation of Liability</h5>
                            <ol type="A">
                                <li>
                                    <p>The company will not be liable (whether in contract, warranty, tort, delict
                                        (including negligence, service liability, any type of civil responsibility or
                                        other theory or otherwise) to RTC or any other person for cost of cover,
                                        recovery or recoupment of any investment made by RTC or its affiliates in
                                        connection with this agreement, or for any loss of profit, revenue, business, or
                                        data or punitive or consequential damages arising out of or relating to this
                                        agreement, even if the company has been advised of the possibility of such costs
                                        or damages. Further, except in case of gross negligence or willful misconduct,
                                        our aggregate liability arising out of or in connection with this agreement or
                                        the transactions contemplated hereby will not exceed at any time the total
                                        amounts during the prior [*] month period paid by RTC to the owner in connection
                                        with the particular service and the website giving rise to the claim.</p>
                                </li>
                                <li>… reserved..</li>
                            </ol>

                            <h5 class="static-title">Section 13: Tax Matters</h5>
                            <ol type="A">
                                <li>
                                    <p>As between the parties, RTC will be responsible for the collection and payment of
                                        any and all of its Taxes together with the filing of all relevant returns under
                                        any taxation law, and issuing GST invoices/credit memos where required. The
                                        Company is not responsible for collecting, remitting or reporting any GST or
                                        other taxes arising from such sale/ admission/ enrollments/ enquiries. The RTC
                                        is solely responsible for preparing, making and filing any tax audit report and
                                        statutory reports and other filings and responding to any tax or financial
                                        audits.</p>
                                </li>
                                <li>
                                    <p>If for any reason, any income tax or any withholding tax is determined to be
                                        deducted and deposited on any payments or remittances to RTC, the company will
                                        have the right to deduct and deposit any such applicable taxes with the
                                        appropriate regulatory authority. No claim in respect of the taxes deposited
                                        would be made by merchant against the company.</p>
                                </li>
                                <li>… reserved..</li>
                            </ol>


                            <h5 class="static-title">Section 14: Force Majeure</h5>
                            <ol type="A">
                                <li>
                                    <p>A Party is not liable for failure to perform, or delay in performing, an
                                        obligation (except an obligation to pay money) if each of the following
                                        conditions is satisfied:</p>
                                    <ol type="i">
                                        <li>the failure or delay arose from a cause beyond the reasonable control of
                                            that Party. A cause beyond the reasonable control of a Party includes an act
                                            of God, war, riot, insurrection, civil commotion, lightning, storm, flood,
                                            fire, earthquake, epidemic, pandemic, terrorism, embargo, unavoidable
                                            accident, or anything done or not done by or to a Person, government or
                                            other competent authority, except the Party relying on force majeure;</li>
                                        <li>the Party took all reasonable precautions against that cause and did its
                                            best to mitigate its consequences; and</li>
                                        <li>the Party gave the other Party notice of the cause as soon as practicable
                                            after becoming aware of it.</li>
                                    </ol>
                                </li>
                                <li>… reserved..</li>
                            </ol>

                            <h5 class="static-title">Section 15: Password Security</h5>
                            <ol type="A">
                                <li>
                                    <p>Any passwords the company provides to RTC may be used only during the Term to
                                        access RTC’s Account, (or other tools the Company provides) to use the Service,
                                        electronically accept RTC’s transactions, and review RTC’s completed
                                        transactions. Multiple User facility shall be provided to RTC and RTC is solely
                                        responsible for maintaining the security of passwords. RTC may not disclose
                                        password to any third party (other than third parties authorized by RTC to use
                                        its Account in accordance with this Agreement) and are solely responsible for
                                        any use of or action taken under RTC’s password. If RTC’s passwords are
                                        compromised, merchant must immediately change its password.</p>
                                </li>
                                <li>… reserved..</li>
                            </ol>

                            <h5 class="static-title">Section 16: Illegality</h5>
                            <ol type="A">
                                <li>
                                    <p>If any provision or term of this Agreement or any part thereof shall become or be
                                        held or declared illegal, invalid or unenforceable for any reason whatsoever,
                                        including without limitation by reason of the provisions of any legislation or
                                        other provisions having the force of law or by reason of any decision of any
                                        court or other body or authority having jurisdiction over the Parties or this
                                        Agreement, such terms or provisions shall be divisible from this Agreement and
                                        shall be deemed to be deleted from this Agreement, provided always that if any
                                        such deletion substantially affects or alters the commercial basis of this
                                        Agreement, the Parties shall negotiate in good faith to amend and modify such
                                        provisions and terms of this Agreement as may be necessary or desirable in the
                                        circumstances.</p>
                                </li>
                                <li>… reserved..</li>
                            </ol>

                            <h5 class="static-title">Section 17: Notice</h5>
                            <ol type="A">
                                <li>
                                    <p>Each notice or communication required or permitted under this Agreement shall be
                                        in writing and shall be delivered personally, sent by facsimile transmission or
                                        sent by certified, registered or express mail, postage prepaid to the following
                                        addresses or facsimile numbers:</p>
                                    <p>RTC :</p>
                                    <ul>
                                        <li>Attention : [*]</li>
                                        <li>Facsimile : [*]</li>
                                        <li>Address : [*]</li>
                                    </ul>

                                    <p>Company :</p>
                                    <ul>
                                        <li>Attention : [*]</li>
                                        <li>Facsimile : [*]</li>
                                        <li>Address : [*]</li>
                                    </ul>

                                    <p>or to such other address or facsimile number as the Parties may designate by
                                        written notice. Any such notice or communication shall be deemed duly given, in
                                        the case of personal delivery and courier service, upon delivery and receipt of
                                        written acknowledgement thereof, in the case of registered mail, [*] days after
                                        posting and in the case of facsimile transmission, upon transmission and receipt
                                        of a satisfactory transmission transcript, provided that if such day is not a
                                        Business Day or such time not a normal business hour then delivery shall be
                                        deemed to have occurred on the following Business Day.</p>
                                </li>
                            </ol>

                            <h5 class="static-title">Section 18: Dispute Resolution and governing law</h5>
                            <ol type="A">
                                <li>
                                    <p>(A) Any Dispute shall be referred to and finally resolved by arbitration in
                                        accordance with the fast track arbitration (to the extent applicable) under the
                                        rules of arbitration as per the Arbitration & Conciliation Act in India then in
                                        effect (“Rules”) failing which, in accordance with the Rules.</p>
                                    <ol type="i">
                                        <li>The number of arbitrators shall be three (3). One (1) arbitrator shall be
                                            nominated by each Party. The third (3rd) arbitrator, who shall act as an
                                            umpire, shall be nominated by the two (2) arbitrators appointed (“Umpire”).
                                        </li>
                                        <li>The seat or legal place of arbitration shall be Surat, (Gujarat) and any
                                            award shall be treated as an award made at the seat of the arbitration. The
                                            language to be used in the arbitral proceedings shall be English.</li>
                                    </ol>
                                </li>
                                <li>
                                    <p>By agreeing to arbitration under the Rules in accordance with this Clause 36, the
                                        Parties undertake to abide by and carry out any award promptly and any award
                                        shall be final and binding on the Parties. The Parties waive irrevocably their
                                        right to any form of appeal, review or recourse to any state court or other
                                        judicial authority, insofar as such waiver may be validly made.</p>
                                </li>
                                <li>
                                    <p>This Agreement is governed by, and construed in accordance with the laws of
                                        India.</p>
                                </li>
                                <li>
                                    <p>Each of the Parties irrevocably agrees that the courts of Surat shall have
                                        exclusive jurisdiction to hear and determine any suit, action or proceeding and
                                        to settle any disputes which may arise out of or in connection with this
                                        Agreement (including any question regarding its existence, validity or
                                        termination) and, for such purposes, irrevocably submits to the exclusive
                                        jurisdiction of such courts.</p>
                                </li>
                            </ol>

                            <p><b>IN WITNESS WHEREOF,</b> the Parties have executed this Agreement of the date written
                                above.</p>

                            <p><b>BY "The RTC "[*]</b></p>
                            <p>Through its authorised signatory</p>
                            <p>___________________________________</p>
                            <p>Name :</p>
                            <p>Designation :</p>

                            <p><b>BY "The Company "[*]</b></p>
                            <p>Through its authorised signatory</p>
                            <p>___________________________________</p>
                            <p>Name :</p>
                            <p>Designation :</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Class Privacy Policy Modal -->

    <!-- Modal -->
    <div class="modal fade" id="class-privacyModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Privacy Policy</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p>We give importance your trust. In order to respect that trust, oktat loyal to ethical
                                standards in gathering, using, and securing any information you ( seller / tuition
                                owner, User /student ) confer.</p>
                            <p>Oktat Education Service Private Limited (operating under the brandname Oktat ) is a
                                leading edtech company, incorporated in India, to providing easy way of access in
                                education.</p>

                            <p>This privacy policy governs your use of the application Oktat – The Admission Services
                                Mobile App’ (“Application”), <a href="https://www.oktat.in/"
                                    class="text-blue">www.oktat.in</a> (“Website”) and the other associated
                                applications, websites and services managed by the Company.</p>

                            <p>Please read this privacy policy cautiously prior using the Application, Website, or our
                                services , along with the Terms of Use confer on the Application and the Website. Your
                                use of the Website, Application, or services in connection with the Application, Website
                                , Services , or registrations with us through any modes including ( SD cards, Phones or
                                other storage/transmitting device ) shall indicate your assent of this Policy and your
                                agreement to be legally confined by the same.</p>

                            <p>If you do not consent with the terms of this privacy Policy, do not use the Website,
                                Application or benefit any of our Services.</p>


                            <h5 class="static-title">User Provided Information / Data</h5>
                            <p>The Application/Website/Services receive the information you provide when you download
                                and register for the Application or Services or website. When you register with us, you
                                generally provide (a) your name, email address, location, mobile number, password and
                                The academic interest of your content/course ; (b) transaction-related information, such
                                as when you pay the fees , respond to any offers, or download or use applications from
                                us; (c) information you provide us when you contact us for help; (d) information you
                                check-in into our system when using the Application/Services/websites, such as while
                                asking doubts, partaking in discussions and getting joining. The aforesaid information
                                collected from the users could be classified as “private Information”, “Sensitive
                                private Information” and “Allied Information”. Private Information, Sensitive private
                                Information and Allied Information (each as personally defined under this Information
                                Technology (Rational safeguard practices and procedures and sensitive private data or
                                information) Rules, 2011 (the “Data Protection Rules”)) shall collectively be referred
                                to as “Information” in this Policy.</p>

                            <p>We can use the Information to contact you , messaging you, or email you from time to
                                time, to confer you with the Services, important information, required notices and
                                marketing promotions. We will ask you when we need more information that individually
                                discern you (personal information) or let us to contact you ( seller / tuition owner 9).
                            </p>

                            <p>We will not discriminate between who is using the resource to enter the Application,
                                Website or Services or , so as long as the log in/access identity match with yours. In
                                order to make the best use of the Application/Website/Services and authorise your
                                Information to be captured accurately on the Application/Website/Services, it is
                                necessary that you have logged in using your own identity.</p>

                            <p>We will, at all times, confer the option to you to not confer the private Information or
                                Sensitive private Information, which we want from you. Ahead, you shall, at any time as
                                long as using the Application/Services/websites also have an option to withdraw your
                                agreement given sooner to us to use such private Information or Sensitive private
                                Information. Such withdrawal of the agreement is required to be sent in writing to us at
                                the contact details confer in this Policy below. In such situations, however, the oktat
                                fully reserves the right not to assent ahead usage of the Application or confer any
                                Services/websites made under it to you.</p>

                            <h5 class="static-title">Information Collected</h5>
                            <p>Thereto , the Application/websites/Services can put together some information personally
                                / automatically , but not limited to, the type of mobile tool you use, your mobile tools
                                unique device ID, the IP address of your mobile tool, your mobile operating system, the
                                type of mobile Internet browsers you use, and other information about the way you use
                                the Application/websites/Services. As is true of most Mobile applications, we also put
                                together other affiliated information as per the permissions that you confer.</p>

                            <h5 class="static-title">Use / Disclosure of your private information</h5>
                            <p>Oktat reserves the right to disclose private Information if required to do so by law or
                                if oktat believes that it is necessary to do so to secure and defend the rights. We use
                                the collected Information to analyse trends, to conduct research, to administer the
                                Application/Services and websites, to learn about each user’s ckntent/courses selection
                                patterns and movements around the Application/Services and websites and to gather
                                demographic information and usage behaviour about our user base as a whole. Holistic and
                                individual, anonymity and non-anonymity data may periodically be transmitted to external
                                service providers to help us improve the Application, websites and our Services. We will
                                share your information with third parties only in the ways that are described below in
                                this Policy.</p>

                            <p>We can use the individual personal data and behavior patterns combined with personal
                                information to provide you with personalized service, and better your finding / joining
                                objectives. Third parties offer some services which we can use to personalize the data
                                and information ,to run insights and help us improve your experience or reach out to you
                                with more value added applications, websites, information and services. However, these
                                third party companies do not have any independent right to share this information.
                                Unless We do not sell, trade or rent your Information to any third party unless, we have
                                been expressly authorized by you either in writing or electronically to do so. We may at
                                times to provide comprehensive statics about our students/User , traffic patterns, and
                                related site information to respectable third parties, however this information when
                                disclosed will be in an holistic form and does not contain any of your Personally
                                Identifiable Information.</p>

                            <p>Oktat will occasionally send email notices or contact you to communicate about our
                                Services, and benefits, as they are considered an essential part of the Services you
                                have chosen.</p>

                            <h5 class="static-title">We may Revealing Information </h5>
                            <p>as essential by law, such as to obey with a Judicial custody, or similar legal process;
                            </p>

                            <p>to implement/enforce applicable Terms of Use, including investigation of potential
                                infringement thereof;</p>

                            <p>when we trust in good faith that divulgation is necessary to protect our rights, protect
                                your safety or the safety of others, finding out fraud, address security or technical
                                issues or respond to a government request;</p>

                            <p>with our trusted services providers who work on our behalf, do not have an independent
                                use of the information we reveal to them, and have agreed to loyal to the rules set
                                forth in this Policy;</p>

                            <p>to secure against impending loss to the rights, property or safety of the
                                Application/Website/ oktat or its users or the public as required or permitted by law;
                            </p>

                            <p>with third party service providers in order to personalize the
                                Application/Website/Services for a better user experience and to perform behavioural
                                analysis;</p>

                            <p>Any portion of the Information containing private data relating to minors confer by you
                                shall be deemed to be given with the agreement of the minor’s legal guardian. Such
                                agreement is deemed to be conferred by your registration with us.</p>


                            <h5 class="static-title">Approach to your private information</h5>

                            <p>We will confer you with the means to ensure that your Personal Information is accurate
                                and current. If you have filled out a user profile, we will confer an obvious way for
                                you to access and change your profile from our Application/Services/Website. We adopt
                                reasonable security measures to protect your password from being unveil to anyone.</p>

                            <h5 class="static-title">Cookies</h5>

                            <p>We send cookies (small letter string of characters) to your computer, which has unique
                                identifier for your browser. Cookies are used to track your choice, help you login
                                faster, and users are aggerageted to determine trends. This data is used to improve our
                                offerings, such as providing more content to most users in more interest areas.</p>

                            <p>Most browsers are initially install to admit cookies, but you can reset your browser to
                                deny all cookies are sent. Some of our features and services may not function properly
                                if your cookies are unabled. </p>

                            <h5 class="static-title">Links</h5>

                            <p>We can present links in a format that enables us to keep track of whether these links
                                have been followed. We use this information to improve our customized content. By
                                clicking on links you may can visits sites outside our domain. We are not responsible
                                for the privacy practices of other web sites. We encourage our users to be aware that
                                when they leave our site to read the confidentiality statements of each and every web
                                site that collects personally identifiable information. This Privacy Policy applies
                                exclusively to information collected entirely by our Website.</p>

                            <h5 class="static-title">Warning</h5>

                            <p>We may warning you by email or phone (through sms/call) to inform you about new service
                                offerings or other information which we feel might be useful for you.</p>

                            <h5 class="static-title">Security</h5>

                            <p>We are careful about keeping the confidentiality of your Information. We provide
                                physical, electronic, and procedural security to protect Information we process and
                                preserve. Like example, we limit access to this Information to authorized employees only
                                who need to know that information in order to operate, develop or improve our
                                Application/Services/Website. Please be cautious that, although we try to provide
                                reasonable security for information we process and preserve, no security system can
                                prevent all potential security breaches.</p>

                            <h5 class="static-title">How Long Do We keep User Data?</h5>

                            <p>Currently, we plan to keep user data at least two years after activation of an account
                                and afterward. We can change this practice according to legal and professional business
                                requirements. Like example, we may extend the retention period for certain data if
                                needed to comply with enactment or unconstrained codes of conduct. Unless or else
                                Forbidden , we may reduce the retention period for some types of data if the need to
                                free up storage space.</p>

                            <h5 class="static-title">Log Information</h5>
                            <p>When you access our Website, our servers on its own / automatically record information
                                that your browser sends whenever you go to / visit a website. These server logs may
                                comprise information such as your web request, internet protocol address, browser type,
                                browser language, the date and time of your request and one or more cookies that may
                                specifically discern your browser.</p>

                            <h5 class="static-title">User Communications</h5>
                            <p>When you send an email or other communication to us, we may keep those communications in
                                order to process your inquiries, respond to your requests and improve our Services.</p>

                            <h5 class="static-title">User's Rights</h5>
                            <p>Users have a right to definite any errors in such User’s private Information available
                                with Oktat. A User may request Oktat in writing that Oktat inhibit to use such User’s
                                private Information. Oktat may stop providing Services to such a User, if so required
                            </p>

                            <h5 class="static-title">User Agreement</h5>
                            <p>We trust that, every user of our Application/Services/Website must be in a position to
                                provide an informed agreement before to providing any Information in need for the use of
                                the Application/Services/Website. By registering with us , you are clearly agreeing to
                                our collection, processing, revealing and handling of your information as stated earlier
                                in this Policy now and as correct by us. Processing, your information in any way,
                                including, but not limited to, collecting, storing, deleting, using, combining, sharing,
                                transferring and revealing information, all of which activities will take place in
                                India. If you inhabit outside India your information will be transferred, processed and
                                stored in accordance with the applicable data protection laws of India.</p>

                            <h5 class="static-title">Users Assize</h5>

                            <p>When you use certain features on our website like the post or share your personal
                                information such as comments, files, photos, will be available to all users, and will be
                                in the public domain. All such sharing of information is done at your own risk. Please
                                keep in mind that if you reveal personal information in your profile or when posting on
                                our forums this information may become publicly available.</p>

                            <h5 class="static-title">Changes to this Privacy policy</h5>

                            <p>As the Oktat develops , our privacy policy will need to develop as well to cover new
                                situations. You are advised to review this Policy regularly for any changes, as
                                continued use is deemed approval of all changes.</p>

                            <h5 class="static-title">Contact Information</h5>
                            <p>Oktat Complaint Officer shall undertake all reasonable efforts to address your Complaint
                                at the earliest possible opportunity. You may contact it at:</p>

                            <p><b>Address :</b> 424 , Tulsi Arcade , Nr Sudama Chowk , Mota Varachha, Surat
                                394101,Gujarat , India</p>

                            <p><b>Email Us at :</b> support@oktat.in , in case of any queries.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Terms and Conditions Modal -->

    <!-- Modal -->
    <div class="modal fade" id="stud-termsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student Terms And Conditions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p>These Terms & Conditions or (“Terms”) of use (a) terms of use ( ToU )along with the (
                                privacy policy) to use of our website <a href="https://www.oktat.in/"
                                    class="text-blue">www.oktat.in</a> (“Website”), our applications (“Application”) or
                                services in connection with the Application/, Website/ (“Services”) or (b) any modes of
                                registrations or usage of services , including through SD cards, mobile or other
                                storage/transmitting device ( defines hereinafter) are between OKTAT EDUCATION SERVICE
                                PRIVATE LIMITED (“Company/Owner/We/Us/Our”) and its users (User/You/student).</p>

                            <p>if you have any questions regarding the terms , you may Contact Us at 7211113006 / 07 or
                                email at info@oktat.in</p>

                            <h5 class="static-title">Technicality of Terms</h5>
                            <p>These Terms install an electronic record in pursuance with the provisions of the
                                Information Technology Act, 2000 and the Information Technology (Intermediaries
                                guidelines) Rules, 2011 made under it, as rectified from time to time.</p>

                            <h5 class="static-title">Read Carefully</h5>
                            <p>Terms of use and the privacy policy of the Oktat (“Privacy Policy”) with respect to
                                registration with us, the use of the Application, Website or Services discreetly or with
                                Caution before using the Application, Website or Services. In the incident or event of
                                any difference between the Terms and any other moralites with respect to the Application
                                or Website or Services or, the provisions of the Terms and conditions shall
                                predominate.Your use/access/browsing of the Application or Website or Services or
                                registration (with or without payment/with or without subscription) through any means
                                shall to inform us your assent of the Terms and Your agreement to be legally confined by
                                the same way. If You do not consent with the Terms of use or the Privacy Policy, please
                                do not use the Application or Website or benefit the Services. Any entry/access to our
                                Services/Application/website through registrations/subscription/contribution is non
                                transferable.</p>

                            <p>Barring as described below, all information, content, course ,PDF file, Video URL,
                                trademarks, services marks, trade names, and trade secrecy Inclusive but not limited to
                                the software, text, images, graphics, video, script and audio, contained in the
                                Application, Website and Services are possessory property of the Oktat (“possessory
                                Information”). No possessory Information may be copied, downloaded, reproduced,
                                modified, republished, uploaded, posted, transmitted or distributed in any way without
                                obtaining before written assent from the Oktat and nothing on this Application or
                                Website or Services shall be deemed to confer a license of or any other right, interest
                                or title to or in any of the intelligential property rights concerned to the Oktat , to
                                the User. ️You may personal the medium on which information/content/course resides, but
                                Oktat shall at all times inhibit full and complete title to the
                                information/content/course and all intelligential property rights inserted by the Oktat
                                on such medium. few contents on the Website may pertain to third parties. Such contents
                                have been reproduced after taking prior consent from said party and all rights relating
                                to such course /content will remain with such third party. Further, you identify and
                                accept that the proprietorship of all trademarks, copyright, logos, service marks and
                                other intelligential property owned by any third party shall continue a statement with
                                such party and You are not permitted to use the same without the agreement of the
                                respective third party.</p>

                            <h5 class="static-title">Restriction of activities while to take advantage of our services
                            </h5>
                            <p>Your use of our Website, Application and Services is exclusively for Your personal and
                                non-commercial use. Any use of the Application, Website or Services or their
                                content/course other than for personal purposes is forbidden.Your personal and
                                non-commercial use of this Application, Website, or our Services will be subjected to
                                the following restrictions or Users Will not endeavor or engage in any activity that
                                may; </p>

                            <ol type="a">
                                <li>User can not decompile, reverse engineer, or disassemble the contents or extract the
                                    source codes of the Application/ Website and/or Service convert , copy, dispense,
                                    transmit, display, perform, reproduce, publish, license, create derivative works
                                    from, transfer, or sell out any information or software acquired from the
                                    Application/Website and/Services or remove any copyright, trademark registration, or
                                    other possessory notices from the contents of the Application/Website/Services.</li>
                                <li>User can not
                                    <ol type="i">
                                        <li>use this Application/ Website/Services for commercial objective of any kind,
                                            or</li>
                                        <li>advertise or sell the Application / Services / domain names or otherwise
                                            (whether or not for profit), or postulate others ( Inclusive , without
                                            limitation, avarice for contributions or donations) or use any Users forum
                                            for commercial purposes of any kind, or </li>
                                        <li>use the Application /Website/ and Services in any way that is illegal, or
                                            disadvantage the Oktat or any other Users or persons or authority as laid
                                            down by the Oktat. </li>
                                    </ol>
                                </li>
                                <li>constructing receivable any content that is Deceptive ,illegal ,detrimental,
                                    minatory, outrageous, Tyrannical ,disgraceful, Offensive, libelous, boorish, bawdy,
                                    child-pornographic, voluptuous, lascivious, unholy, invasive of another’s privacy,
                                    hateful, or racially, phyletic , ethnically or otherwise calamitous ,Stalking,
                                    threatening and/or harassing another and/or provoke other to commit violence;
                                    Transmitting material that stimulate anyone to commit a delinquent offence, that
                                    results in civil liability or otherwise infringement any contingent laws,
                                    regulations or code of practice; Intervene with any other User's use or happiness of
                                    the Application/Website/Services. </li>
                                <li>constructing , transmitting or collecting electronic copies of product/ content
                                    /course protected by copyright without the assent of the owner, by doing any act
                                    that amounts to the breach of intellectual property or making available any course
                                    that violate any intellectual property rights or other possessory rights of anyone
                                    else; Make available any content/course that You do not have a right to make
                                    available under any law or contractual or Believable relationship, unless You own or
                                    control the rights thereto or have received all necessary consents for such use of
                                    the content; hypocrisy of any Users or entity, or falsely state or otherwise
                                    misrepresent Your relevance with a User or entity Post, transmit or make available
                                    any content / course that contains viruses, trojan horses, worms,ascarides, spyware,
                                    time bombs, cancelbots, or other computer programming routines, code, files or such
                                    other programs that may scathe the Application/services, interests or rights of
                                    other users or limit the functionality of any computer software, hardware or
                                    telecommunications, or that may harvest or produce or to collect any data or
                                    personal information about other Users without their permission. </li>
                                <li>use the Application/Website/Services/ in any manner that could lesion,Incapable ,
                                    overburden or impair any of the Application’s/Website’s servers or the networks
                                    connected to any of the servers on which the Application/Website is hosted;
                                    Intentionally or unintentionally interfere with or breakdown the services or
                                    infringement any applicable laws related to the access to or use of the
                                    Application/Website/Services , infringement any needfulness, procedures, policies or
                                    regulations of networks connected to the Application/Website/Services, or engage in
                                    any activity prohibited by these Terms, Breakdown or interfere with the security of,
                                    or otherwise cause harm to, theApplication/ Website/ Services/ content/course,
                                    systems resources, or gain unpossessed access to user accounts, passwords, servers
                                    or networks connected to or accessible through the Application/Website/Services or
                                    any allied or linked sites.</li>
                                <li>intervene️ with, or prohibit any user from using and enjoying access to the
                                    Application/Website/Services, or other alliaed sites, or join or attached in
                                    disruptive attacks such as renege of service attack on the
                                    Application/Website/Services; utilize deep-links, page-scrape, robot, spider or
                                    other automatic device, program, algorithm or methodology, or any equal manual
                                    process, to increase traffic to the Application/Website/Services to reach, obtain,
                                    copy or monitor any portion of the Application/Website/Services or in any way to
                                    generate or deter the navigational structure or presentation of the Application, any
                                    articles ,to receive or attempt to receive any articles ,documents or information
                                    through any means not specifically made available through the Application/website
                                    /services;</li>
                            </ol>

                            <h5 class="static-title">Oktat Shall Play Following Role And Rights</h5>
                            <p>By submitting content on or through the Services (your “material ”), you give us a
                                worldwide, non-exclusive, royalty-free license (with the right to sublicense) to use,
                                copy, reproduce, regenerate, process,develop, adapt, convert, retouch, publish,
                                manifest, transmit, display and distribute Such as material in any and all media or
                                distribution methods (now known or later developed) and to allies your Material with
                                you, except as described below. You agree that others may use Your material in the same
                                way as any other material available through the Services. Other users of the Services
                                may fork, tweak and repurpose your material in accordance with these Terms. If you
                                delete your user account your Material and name may remain available through the
                                Services.</p>

                            <p>Neither the Oktat nor any other parties provide any warranty or guarantee as to the
                                accuracy, precision,timely, performance,completeness or suitability of the information
                                and materials found or offered on Application/Website/Services for any particular
                                purpose. You agree/accept that such information and Material may contain inaccuracies or
                                errors and we expressly exclude liability for any inaccuracies or errors to the fullest
                                extent/limit permitted by law. Oktat also reserves the right and discretion to make any
                                changes/corrections or withdraw/add contents at any time without notice. In particular,
                                but without limiting anything here, the Oktat anegate/disclaims any amenableness for any
                                errors and accuracy of the information that may be contained in the
                                Application/websites/services. In the preparation of the
                                Application/Website/Services/and contents therein, every effort has been made to offer
                                the most current, correct, and clearly expressed information possible. Nevertheless,
                                inadvertent errors may occur. Our Website provides Users with access to compiled/to
                                combines educational service information and related sources Such information is
                                provided that We assume no liability for the accuracy or completeness or use or non
                                obsolescence/Desuetude of such information. We shall not be liable to update or ensure
                                continuity of such information contained on the Website. We would not be responsible for
                                any errors, which might appear in such information, which is compiled from third party
                                sources or for any unavailability of such information. From time to time the Website may
                                also include links to other websites.These links are provided for your convenience to
                                provide further information.They do not signify that we support the websites. We have no
                                responsibility for the content of the linked websites.You may not create a link to the
                                Website from another website or document without the Company’s prior written agreement.
                                Any response/feedback from User is most welcome to make the Application and contents
                                thereof error free and user friendly.</p>

                            <p>The content of the Application/Services/websites are developed on the concepts covered in
                                the structured course of study of the syllabus prescribed for students of various
                                courses. The usage of the Application/Services/websites is not endorsed/supported as a
                                substitution to the curriculum / courses based education provided by the educational
                                institutions.The basic definitions and formulae of the subject matter would remain the
                                same. The Oktat agree/accept, there are various means of Services structured Course
                                pedagogy and inclusion of methods in the Application/Services/websites does not signify
                                endorsement of any particular method nor exclusion signify disapproval. Subscription to
                                the Application or usage of our Services/Website does not in any manner guarantee
                                admission to any educational / academic institutions or passing of any exams or
                                achievement of any specified percentage of marks in any examinations.</p>

                            <p>The Oktat reserves the right at its only/sole discretion to remove, review, edit or
                                delete any content. Similarly, We will not be responsible or liable for any content
                                uploaded by Users directly on the Website, irrespective of whether We have certified any
                                answer uploaded by the User. We would not be amenable to verify whether such a content
                                placed by any User contain infringing materials or not. Some parts of the Services are
                                interactive, and we encourage contributions by Users, which may or may not be subject to
                                editorial control prior to being posted. The Oktat accepts no responsibility or
                                liability for any material / content communicated by third or other parties in this way.
                                Certain course in the Application/Services/Website/ (in particular relating to
                                assistance in preparations for administrative services) may contain opinions and views.
                                The Oktat can not be amenable for such opinions or any claims resulting from them.
                                Further, the oktat makes no warranties or representations whatsoever regarding the
                                quality, content, completeness, or adequacy of such information and data.</p>

                            <p>By registering yourself , you agree to make your contact details available to Our
                                employees, associates and partners so that you may be contacted for education
                                information and promotions through mobile, SMS, email etc.The User expressly grants/give
                                such permission to contact him/her through telephone, SMS, e-mail and holds the oktat
                                atone/indemnified against any liabilities including financial penalties, damages,
                                expenses in case the User’s mobile number is registered with Do not Call (DNC)
                                database.The oktat may, based on any form of access to the application or Services or
                                Website or registrations through any source whatsoever, contact the User through sms,
                                email and call, to give information about its education as well as notifications on
                                various important updates and/or to seek permission for demonstration of its
                                Course/content. While the oktat may, based on the User’s confirmation, facilitate the
                                demonstration of its content at the location sought by the User, the User acknowledges
                                that he/she has not been induced by any statements or representations of any person with
                                respect to the quality or conditions of the course / content and that User has relied
                                exclusively on the investigations, examinations and inspections as the User has chosen
                                to make and that the oktat has afforded the User the opportunity for full and complete
                                investigations, examinations and inspections.</p>

                            <p>the oktat shall have the right to monitor and download and usage of the contents thereof
                                by the buyer/student, to analyze such use and discuss the same with the user/student to
                                enable effective and efficient usage of the Services. The User expressly permits the
                                oktat to clear the doubts of the student using the application/service by answering the
                                questions placed before it, providing study plans, informing of the progress, providing
                                feedback, communicating with the student and mentoring the student through telephone or
                                e-mail on express consent of the legal guardian/parent of the student / user or through
                                any other forum. Access to certain constituent of the Services including doubt
                                clearance, mentoring services etc may be subject to separate terms, conditions and fair
                                usage policy. The oktat reserves the right to determine the criteria for provision of
                                various constituent of Services to the different categories of Users based on its
                                policies. Hence, subscription to the Application/service or registrations do not
                                automatically entitle the User to any and all constituent of Services provided by the
                                oktat and the oktat shall be entitled to exercise its discretion while providing access
                                to and determining continuity of certain constituent of Services. We reserve the right
                                to extend, cancel, discontinue, prematurely withdraw or modify any of Our Services at
                                Our discretion.</p>

                            <p>The oktat's websites and / or Services, including the Application and content, are
                                consistent only with certain devices/phones/instruments/hardware < . The oktat shall not
                                    be obligated to provide workable services for any instruments that are not
                                    recognized by the oktat or those instruments that may be purchased from any third
                                    party which are not consistent with the oktat’s Services. The oktat reserves the
                                    right to upgrade the table/ type of consistent devices as required from time to
                                    time.</p>

                                    <p>Users have to specify the address to which the payment has to be made at the time
                                        of access/joining in tution. Payment collector arrive directly to the address as
                                        specified at the time of joining/access in tuition class and You cannot, under
                                        any circumstances whatsoever, change the address after the joining/access is
                                        processed. In case of any change in the address, You need to specify the same to
                                        us in writing well in advance to the collecting date. Any inconsistencies in
                                        name or address will result in non-collecting of the Payment fees of tuition
                                        Class. In order to enter/access the Services and to advantages the use of the
                                        Application You shall be required to register yourself with the
                                        Application/Services/websites, and maintain an account with the
                                        Application/Services/websites.</p>

                                    <p>*You will be required to furnish certain information and details, including Your
                                        name, mobile number, e-mail address, residential address, grade/class of the
                                        student, school name, payment information (credit/debit card details) if
                                        required, and any other information deemed necessary by the Application. With
                                        respect to the provision of information,The following can be addressed. :-</p>

                                    <p>You agree that Your Capability / ability to use Your account is dependent upon
                                        external factors such as internet service providers and internet network
                                        availability and the oktat cannot guarantee accessibility to the Application at
                                        all times. In addition to the disclaimer mentioned in the conditions / Terms,
                                        the oktat shall not be liable to You for any damages arising from Your inability
                                        to log into Your account and access the services of the Application at any
                                        time.You are responsible for maintaining the secrecy of the account information
                                        and for all activities that occur under Your account. You agree to </p>

                                    <ol type="a">
                                        <li>ascertain / ensure that You successfully log out from Your account at the
                                            end of each session; and </li>
                                        <li>immediately notify the oktat of any unauthorized use of Your account. If
                                            there is reason to believe that there is likely to be a infringement of
                                            security or misuse of Your account, we may request You to change the
                                            password or we may suspend Your account without any liability to the oktat,
                                            for such period of time as we understand / deem appropriate in the
                                            circumstances. We shall not be liable for any loss or damage arising from
                                            Your failure to comply with this provision.It is Your only/sole
                                            responsibility to ensure that the account information provided by You is
                                            accurate, complete and latest.</li>
                                    </ol>

                                    <p>Users who are “able/competent/capable” of contracting within the meaning of the
                                        Indian Contract Act, 1872 shall be Suitable/eligible to register for the
                                        Application and all Our Services. Persons who are minors, un-discharged
                                        insolvents etc. are not eligible to register for Our Services. As a minor if You
                                        wish to use Our Services, such use shall be made available to You by Your legal
                                        guardian / trustee / parents, who has agreed to these Terms. In the event a
                                        minor utilizes the Application/Website/Services, it is assumed that he/she has
                                        obtained the agreement / consent of the legal guardian/ trustee / parents and
                                        such use is made available by the legal guardian / trustee / parents. The oktat
                                        will not be responsible for any consequence that arises as a result of misuse of
                                        any kind of Our Application or Services that may occur by virtue of any person
                                        including a minor registering for the Services provided. By using the Services
                                        You warrant that all the data provided by You is accurate and complete and that
                                        student using the Application has obtained the consent of parent/trustee legal
                                        guardian (in case of minors). The oktat reserves the right to finish Your
                                        subscription and / or refuse to provide You with access to the Services if it is
                                        discovered that You are under the age of 18 (eighteen) years and the consent /
                                        agree to use the Services is not made by Your parent/trustee legal guardian or
                                        any information provided by You is inaccurate. You agree that the oktat does not
                                        have the responsibility to ensure that You conform to the Aforementioned
                                        eligibility criteria. It shall be Your sole responsibility to ensure that You
                                        meet the required qualification. Any persons under the age of 18 (eighteen)
                                        should seek the consent of their parents/trustee legal guardians before
                                        providing any Information about themselves or their parents and other family
                                        members on the Application.</p>


                                    <h5 class="static-title">Roles & Obligation /bondage Of Oktat & Buyer/student In
                                        Order To Avail The Services</h5>
                                    <p>The Course and services: Subject to other provisions of this consent, student may
                                        join the tution owner may listing/register tuition classes sell services through
                                        the Website. For such join of student in tuition class and services, in addition
                                        to other applicable terms of the Agreement/consent, Tuition owner/ seller
                                        specifically agree to the roles and obligations of the student set out under
                                        Section of Terms. For marketing, sale and/or promotion of course and services
                                        through the Website, in addition to other applicable terms of the Agreement, [
                                        Seller/ Tuition owner will be required to enter into a separate written
                                        agreement with oktat ]. Any joining into Tuition class / course and services
                                        through the Website will constitute a contract of joining between the student of
                                        such related course and services and the Seller/tution owner and services shall
                                        be delivered by such Seller/tution owner to such student directly. oktat
                                        can/shall not be responsible for, learning process, Material,
                                        syllabus/course/tuition class, convenience, quality education, suitability and
                                        aptness of any service join or accessed using the Website. course/tuition class
                                        or Content in relation to Services; seller/ tution owner may create and/or
                                        display tuition class/course (including information regarding the offerings of
                                        syllabus, course, pictures,Fees, review, ratings and feedbacks) on the Website.
                                        By displaying any tuition class/course or Content on the Website, unless agreed
                                        to and provided for to the contrary, seller/ Tuition owner/student /user grants
                                        oktat a right to use such tuition class /course or content in any manner. User/
                                        student shall paying tuition class /course and services from Sellers/ tuition
                                        owner through the Website at the fees/price provided therein. User acknowledge
                                        that such paying of tuition class /course and services is being made directly
                                        from the Seller/tution owner through the Website and oktat is only providing a
                                        platform for the users /student and Sellers/tution owner to interact online with
                                        respect to such sale/offer/discount through the Website.</p>

                                    <p>Users acknowledge that Services only include providing an online platform for
                                        displaying, Booking,marketing, buying, Joining and promoting education related
                                        Tution class/course for providing Learning Services like tuition class/course,
                                        Any sale transaction made between a users/students and a Seller/tuition owner
                                        shall constitute an agreement of sale between such User Student and
                                        Seller/tuition owner. and oktat shall have no liability with respect to quality,
                                        appropriateness, merchantability, authenticity and accuracy of the services sold
                                        or provided through the Website. In the event of Your infringement of these
                                        Terms, You agree that the oktat will be irreparably harmed and may not have an
                                        adequate remedy in money or damages.The oktat therefore, shall be entitled in
                                        such event to obtain an injunction against such a infringement from any court of
                                        competent jurisdiction... The oktat’s right to obtain such relief shall not
                                        limit its right to obtain other treatment or remedies. The oktat, oktat’s
                                        officers, directors, employees, affiliates and agents and any other service
                                        provider responsible for providing Services in connection with this Agreement
                                        will not be liable for any acts or omissions, including of a third or other
                                        party, and including those vendors participating in oktat's offerings made to
                                        Users, or for any unauthorized interception of data or breaches of this
                                        Agreement attributable in part to the acts or omissions of third or other
                                        parties, or for damages associated with oktat, or equipment that it does not
                                        furnish, or for damages that result from the operation systems, equipment,
                                        facilities or services provided by third parties that are interconnected with
                                        oktat. </p>

                                    <h5 class="static-title">Limitation Of Liability & Indemnification</h5>
                                    <p>You agree to defend, indemnify and hold harmless the oktat, its officers,
                                        directors, employees and agents, from and against any and all claims, damages,
                                        obligations, losses, liabilities, costs or debt, and expenses (including but not
                                        limited to attorney’s fees) arising from:</p>

                                    <ol type="a">
                                        <li>Your use of and access of the Application/Website/Services;</li>
                                        <li>Your violation of any term of these Terms or any other policy of the oktat
                                            and under applicable law ; </li>
                                        <li>Your violation of any third party right, including without limitation, any
                                            copyright, property, or privacy right; or </li>
                                        <li>any claim that Your use of the Application/Website/Services has caused
                                            damage to a third party. This defense and indemnification obligation will
                                            survive these Terms. In no event shall the oktat , its officers, directors,
                                            employees, partners or agents be liable to You or any third party for any
                                            special, incidental, indirect, consequential or punitive damages whatsoever,
                                            including those resulting from loss of use, data or profits or any other
                                            claim arising out, of or in connection with, Your use of, or access to, the
                                            Applicaton.</li>
                                    </ol>

                                    <p>Any breach/violation by Users of the terms of this Clause may result in immediate
                                        suspension or termination of Your Accounts apart from any legal treatment/remedy
                                        that the oktat can avail. In such instances, the oktat may also disclose Your
                                        Account Information if required by any Governmental or legal authority. You
                                        understand that the breach/violation of these Terms could also result in civil
                                        or delinquent or criminal liability under applicable laws. Each User is
                                        responsible for any breach of its obligations under the Agreement and/or for the
                                        consequences of any such breach. The Terms shall be governed by and construed in
                                        accordance with the laws of India, without regard to conflict of law principles.
                                        Further, the Terms shall be subject to the sole /exclusive jurisdiction of the
                                        competent courts located in Surat ( Gujarat ) and You therefore concur to and
                                        accept the jurisdiction of such courts. The oktat has the right to change
                                        modify, convert, retouch, suspend, or discontinue and/or eliminate any aspects,
                                        features or functionality of the Application or the Services as it
                                        understand/deems fit at any time without notice. Further, the oktat has the
                                        right to rectify these Terms from time to time without prior notice to you. The
                                        oktat makes no commitment, express or implied, to maintain or continue any
                                        aspect of the Application. You agree that the oktat shall not be liable to You
                                        or any third party for any modification, revisal , adjournment, suspension
                                        ,Termination or discontinuance of the Application/Services. All prices are
                                        subject to change without notice.</p>


                                    <h5 class="static-title">Conclusion Of Oktat</h5>
                                    <p>User is obligate/bound by the consent/Agreement from the time such User commences
                                        using the Services till the time such User ceases to use Services.
                                        Notwithstanding anything else contained herein, all the rights and obligations
                                        of Users under this Agreement, which either expressly or by their nature survive
                                        the Conclusion of this Agreement, shall not be extinguished by conclusion of
                                        this Agreement.User may conclusion this Agreement by ceasing access to Services
                                        in any manner, including disabling access to Registered Services. oktat may
                                        conclusion this Agreement with respect to any User by suspending or permanently
                                        barring access to Services. Oktat reserves the right to conclusion Users’ access
                                        to Services or any part of Services, at any time if: </p>

                                    <ol type="a">
                                        <li>such User, knowingly or unknowingly, causes direct or indirect breach, as
                                            ascertained by oktat, of these Terms or Privacy Policy or any part of the
                                            Agreement;</li>
                                        <li>such User does not pay the requisite cost of using such part of Services
                                            which is not provided by oktat free of cost and is paid in nature; </li>
                                        <li>a third party (if any) with whom oktat offers Services has conclusions its
                                            relationship with oktat or ceased to offer the related services to oktat or
                                            to such User; </li>
                                        <li>provision of Services or any part of Services is no longer commercially
                                            viable or possible for oktat ; </li>
                                        <li>oktat believes that such User is a repeat infringer of the terms of this
                                            Agreement; or oktat is required to conclusion this Agreement by applicable
                                            law, government order or order of a court with requisite jurisdiction.</li>
                                        <li>Upon conclusion of this Agreement with respect to a User, all the legal
                                            rights, obligations and liabilities that such User and oktat have benefited
                                            from, been subject to (or which have accrued over time whilst the Agreement
                                            has been in force) or which are expressed to continue indefinitely, shall be
                                            unaffected by this cessation, and shall continue to apply to such rights,
                                            obligations and liabilities indefinitely.</li>
                                    </ol>

                                    <div class="main-title mt-5">
                                        <h2>Common Provisions</h2>
                                    </div>

                                    <h5 class="static-title">Notice To Users</h5>
                                    <p>All notices served by the oktat shall be provided via email to Your account or as
                                        a general notification on the Application. Any notice to be provided to the
                                        oktat should be sent to support@oktat.com</p>

                                    <h5 class="static-title">Whole Consent</h5>
                                    <p>The Terms of use , along with the Privacy Policy, and any other instructions made
                                        applicable to the Application from time to time, constitute the whole consent or
                                        agreement between the oktat and You with respect to Your access to or use of the
                                        Application, Website and the Services thereof.</p>

                                    <h5 class="static-title">Entrust Mentioned</h5>
                                    <p>Users cannot entrust or otherwise transfer Your devour or obligations under the
                                        Terms, or any right granted hereunder to any third party. The oktat’s rights
                                        under the Terms are freely transferable by the oktat to any third parties
                                        without the requirement of seeking Your consent.</p>

                                    <h5 class="static-title">Seriousness or Severability</h5>
                                    <p>If for any reason, any rule / court of competent jurisdiction, or any part of it
                                        gets any provision of unrecoverable, then that provision will be extended to the
                                        maximum extent so that the intentions of the parties can be reflected by these
                                        provision. Those provisions and the remaining conditions will continue in full
                                        force and effect.</p>

                                    <h5 class="static-title">Renunciation</h5>
                                    <p>Any failure by the oktat to apply or enforce or exercise any provision of the
                                        Terms of use , or any related right, shall not build / constitute a renunciation
                                        by the oktat of that provision or right.</p>

                                    <h5 class="static-title">Propinquity or Relation</h5>
                                    <p>You agree / acknowledge that Your partaking / participation on the Application,
                                        does not make You an employee or agency or partnership or joint venture or
                                        franchise of the oktat.</p>

                                    <p>The oktat provides these Terms of Use so that You are informed / aware of the
                                        terms that apply to your use of the Website/Application and Services. You
                                        acknowledge / agree that, the oktat has given You a proper opportunity to
                                        scrutiny these Terms of use and that You have consentient/ agreed to them.</p>

                                    <h5 class="static-title">DISCLAIMER</h5>
                                    <p>THIS WEBSITE, THE APPLICATION AND THE SERVICES ARE PROVIDED ON BASIS WITH ALL
                                        FAULTS AND WITHOUT ANY WARRANTY OF ANY KIND. THE OKTAT HEREBY DISCLAIMS / NEGATE
                                        ALL WARRANTIES AND CONDITIONS WITH REGARD TO THE WEBSITE, APPLICATION AND THE
                                        SERVICES, INCLUDING WITHOUT LIMITATION, ALL IMPLIED WARRANTIES AND CONDITIONS OF
                                        COMMERCIALISM , MERCHANTABILITY, COURSE FOR A PARTICULAR PURPOSE, TITLE,
                                        ACCURACY, TIMELINESS. PERFORMANCE, COMPLETENESS, SUITABILITY AND
                                        NON-INFRINGEMENT. ADDITIONALLY, THE OKTAT SHALL NOT BE RESPONSIBLE / LIABLE FOR
                                        ANY DAMAGES ARISING OUT OF OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS
                                        WEBSITE, OR THE APPLICATION OR THE SERVICES OR FROM DOWNLOADING ANY CONTENT OR
                                        WATCHING VIDEO. YOUR USE OF ANY INFORMATION OR MATERIALS OR COURSE ON THIS
                                        WEBSITE/APPLICATION/SERVICES IS ENTIRELY AT YOUR OWN RISK, FOR WHICH WE SHALL
                                        NOT BE RESPONSIBLE / LIABLE. IT SHALL BE YOUR OWN RESPONSIBILITY TO ENSURE THAT
                                        SERVICES PROVIDED BY US MEET YOUR SPECIFIC REQUIREMENTS.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Refund Modal -->

    <!-- Modal -->
    <div class="modal fade" id="stud-refundModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Refund And Cancellation Policy</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="main-title">
                                <h2>Terms for Refunds</h2>
                            </div>

                            <ul class="static-list">
                                <li>In case of transaction made to Paying Fees of Tuition Class/course through Oktat ,
                                    then refund will be provided if Oktat or its affiliate Tuition owner/ seller is
                                    unable to fulfil the service Register for and User / students can Request a refund
                                    amount within 2 days of joining.</li>

                                <li>In case of transaction made to Paying Fees of Tuition Class/course through oktat, if
                                    any circumstance User/student has been failed to attend the Tuition class, then User
                                    / students can Request a refund amount within 2 days of joining. </li>

                                <li>In case of Cancellation of Tuition classes /course by or through the User/student ,
                                    then that User / students can Request a refund amount within 2 days of joining.
                                </li>

                                <li>If Oktat or its affiliate service Provider Tuition owner/ seller cancels the paying
                                    fees of joining into tuition class /course within the 2 days , Then that
                                    users/student can get refund amount / Fees within a week. </li>

                                <li>All refund amounts shall be credited in the User’s bank account within a week in
                                    accordance with the terms that may be stipulated by the bank which has issued the
                                    credit / debit card.</li>

                                <li>If the Joining of Tuition class /course and its offer/discount is only for new Users
                                    / student of and , if an existing User/student Paying the Tuition class /courses
                                    fees then the Joining of Tuition class/course shall not be valid and oktat will
                                    refund the amount after deducting 2 % of the transaction value. </li>

                                <li>If the Joining of Tuition class/course and its offer/discount is only for users /
                                    females/college student/ School students and is paying by a user/student who is not
                                    eligible -then the paying of Joining into Tuition class /course will not be valid
                                    and oktat will refund the amount after deducting 2 % of the transaction value.</li>

                                <li>oktat's decision on refunds shall be at their sole discretion and shall be final and
                                    binding.</li>

                                <li>oktat reserves the right to modify the terms for refunds at any given time without
                                    prior notice to any User</li>

                                <li>No Refund will be provided any of the User/Student after the 2 days of joining.
                                </li>
                                <li>Refund Request will be deemed only at oktat's Email ID with User/Student Registered
                                    Email ID and oktat's Contact Number to User / Student Registered Contact Number.
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                            <div class="main-title">
                                <h2>Terms for Cancellations</h2>
                            </div>

                            <ul class="static-list">
                                <li>oktat is not responsible for cancellation of ( Trial class and booking of inquiry )
                                    in Tuition Class /course by its affiliate seller/ Tuition owner.</li>

                                <li>If oktat's affiliate service provider seller/Tuition owner cancel The paying fees of
                                    Joining into tuition Class /course Within the 2 days of joining then - users/student
                                    shall/can reschedule the Joining into tuition Class/course or request a refund
                                    amount.</li>

                                <li>If oktat's affiliate Service provider seller/ Tuition owner Cancel the Tuition
                                    class/course after the 2 days of joining to any User / students or cancel within any
                                    of the course duration day then the affiliate Service provider seller/ Tuition Owner
                                    is solely responsible for giving back a Some amount / fees of course duration to
                                    student / user. in such case The oktat is not responsible.</li>

                                <li>If any user/student Ceases / Leave the Tuition classes/course then, after the 2 days
                                    of joining - No refund or reschedule is applicable.</li>

                                <li>User/student cannot do more than three cancellations for Joining of tuition /course
                                    on oktat.</li>

                                <li>User/ student can Request a cancellation of Joining into tuition class /course
                                    within the 2 days of Joining and request a refund amount.</li>

                                <li>oktat's decision on cancellations shall be at their sole discretion and shall be
                                    final and binding.</li>

                                <li>oktat reserves the right to modify the terms for cancellation at any given time
                                    without prior notice to any User/student/seller/ Tuitionowner.</li>

                                <li>Cancellation Request will be deemed only at oktat's Email ID with User/Student
                                    Registered Email ID and oktat's Contact Number to User / Student Registered Contact
                                    Number.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
