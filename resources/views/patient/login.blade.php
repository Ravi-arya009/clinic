<!DOCTYPE html>
<html lang="en">
@include('partials.header');
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href={{ asset('plugins/intltelinput/css/intlTelInput.css') }}>

<body class="account-page">

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        @include('partials.navbar');

        <!-- Page Content -->
        <div class="content top-space">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-8 offset-md-2">

                        <!-- Login Tab Content -->
                        <div class="account-content">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-7 col-lg-6 login-left">
                                    <img src={{ asset('img/login-banner.png') }} class="img-fluid" alt="Doccure Login">
                                </div>
                                <div class="col-md-12 col-lg-6 login-right">
                                    <div class="login-header">
                                        <h3>Login <span>Doccure</span></h3>
                                    </div>
                                    <form action="{{ route('patient.login') }}" method="POST">
                                        @csrf
                                        <div class="mb-3 form-focus phone_field">
                                            <input type="text" class="form-control floating" id="phone" name="phone" required>
                                            <label class="focus-label">Phone Number</label>
                                        </div>
                                        <div class="mb-3 form-focus password-container">
                                            <input type="password" class="form-control floating" id="password" name="password" required>
                                            <label class="focus-label">Password</label>
                                        </div>
                                        <div class="text-end">
                                            <a class="forgot-link" href="forgot-password.html">Forgot Password ?</a>
                                            <a class="forgot-link float-start otp-password-link otp-login-btn" href="javascript:void(0);">Login With OTP</a>
                                            <a class="forgot-link float-start otp-password-link password-login-btn d-none" href="javascript:void(0);">Login With Password</a>
                                        </div>
                                        <button class="btn btn-primary w-100 btn-lg login-btn form-submit-btn" type="submit">Login</button>
                                        <button class="btn btn-primary w-100 btn-lg login-btn ajax-submit-otp-btn d-none" type="button">Send OTP</button>
                                        @if ($errors->any())
                                            <div class="login-or">
                                                <span class="or-line"></span>
                                            </div>
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if (session('success'))
                                            <div class="login-or">
                                                <span class="or-line"></span>
                                            </div>
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        <div class="text-center dont-have">Don’t have an account? <a href="{{ route('patient.register') }}">Register</a></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Login Tab Content -->

                    </div>
                </div>

            </div>

        </div>
        <!-- /Page Content -->

        <!-- Footer -->
        <footer class="footer footer-one">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="footer-widget footer-about">
                                <div class="footer-logo">
                                    <a href="index.html"><img src={{ asset('img/logo.png') }} alt="logo"></a>
                                </div>
                                <div class="footer-about-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="footer-widget footer-menu">
                                        <h2 class="footer-title">For Patients</h2>
                                        <ul>
                                            <li><a href="search.html">Search for Doctors</a></li>
                                            <li><a href="login.html">Login</a></li>
                                            <li><a href="register.html">Register</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4">
                                    <div class="footer-widget footer-menu">
                                        <h2 class="footer-title">For Doctors</h2>
                                        <ul>
                                            <li><a href="appointments.html">Appointments</a></li>
                                            <li><a href="chat.html">Chat</a></li>
                                            <li><a href="login.html">Login</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4">
                                    <div class="footer-widget footer-contact">
                                        <h2 class="footer-title">Contact Us</h2>
                                        <div class="footer-contact-info">
                                            <div class="footer-address">
                                                <p><i class="feather-map-pin"></i> 3556 Beech Street, USA</p>
                                            </div>
                                            <div class="footer-address">
                                                <p><i class="feather-phone-call"></i> +1 315 369 5943</p>
                                            </div>
                                            <div class="footer-address mb-0">
                                                <p><i class="feather-mail"></i> doccure@example.com</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-7">
                            <div class="footer-widget">
                                <h2 class="footer-title">Join Our Newsletter</h2>
                                <div class="subscribe-form">
                                    <form action="#">
                                        <input type="email" class="form-control" placeholder="Enter Email">
                                        <button type="submit" class="btn">Submit</button>
                                    </form>
                                </div>
                                <div class="social-icon">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><i class="fab fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><i class="fab fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <!-- Copyright -->
                    <div class="copyright">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="copyright-text">
                                    <p class="mb-0"> Copyright © 2024 <a href="https://themeforest.net/user/dreamstechnologies/portfolio" target="_blank">Dreamstechnologies.</a> All Rights Reserved</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">

                                <!-- Copyright Menu -->
                                <div class="copyright-menu">
                                    <ul class="policy-menu">
                                        <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                        <li><a href="terms-condition.html">Terms and Conditions</a></li>
                                    </ul>
                                </div>
                                <!-- /Copyright Menu -->

                            </div>
                        </div>
                    </div>
                    <!-- /Copyright -->
                </div>
            </div>
        </footer>
        <!-- /Footer -->

    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src={{ asset('js/jquery-3.7.1.min.js') }}></script>

    <!-- Bootstrap Core JS -->
    <script src={{ asset('js/bootstrap.bundle.min.js') }}></script>

    <script src={{ asset('plugins/intltelinput/js/intlTelInput.js') }}></script>

    <!-- Custom JS -->
    <script src={{ asset('js/script.js') }}></script>

    <script>
        $(function() {
            $('.digit-group').find('input').each(function() {
                $(this).attr('maxlength', 1);
                $(this).on('keyup', function(e) {
                    var parent = $($(this).parent());

                    if (e.keyCode === 8 || e.keyCode === 37) {
                        var prev = parent.find('input#' + $(this).data('previous'));

                        if (prev.length) {
                            $(prev).select();
                        }
                    } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                        var next = parent.find('input#' + $(this).data('next'));

                        if (next.length) {
                            $(next).select();
                        } else {
                            if (parent.data('autosubmit')) {
                                parent.submit();
                            }
                        }
                    }
                });
            });
            $('.digit-group input').on('keyup', function() {
                var self = $(this);
                if (self.val() != '') {
                    self.addClass('active');
                } else {
                    self.removeClass('active');
                }
            });

            $(".otp-password-link").on('click', function() {
                $(".password-container").slideToggle(300);
                $(".otp-login-btn").toggleClass("d-none");
                $(".password-login-btn").toggleClass("d-none");
                $(".form-submit-btn").toggleClass("d-none");
                $(".ajax-submit-otp-btn").toggleClass("d-none");

                $(".ajax-submit-otp-btn").on('click', function() {
                    $(".is-invalid").removeClass('is-invalid');
                    $(".invalid-feedback").remove();
                    $(".error-message-container").remove();
                    var phoneField = $("#phone");
                    var phone = phoneField.val();
                    const phoneRegex = /^(\+91|91)?\d{10}$/;
                    if (phone == '' || phone == null || !phoneRegex.test(phone)) {
                        $("#phone").addClass('is-invalid');
                        phoneField.tooltip({
                            title: 'Please enter a valid phone number.',
                            placement: 'right',
                            trigger: 'manual'
                        }).tooltip('show');
                    } else {
                        $.ajax({
                            url: "{{ route('patient.PhoneNumberCheck') }}",
                            type: "GET",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                phone: phone
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.status == 0) {
                                    $(".phone_field").after('<div class="text-danger error-message-container">' + response.message + '</div>');
                                }
                                if (response.status == 1) {
                                    console.log("show modal");
                                    $("#exampleModalCenter").modal('show');
                                    $("#otp_phone_number").text(phone);

                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr, status, error);
                            }
                        });
                    }
                });
            });

            $('#otp_form').submit(function(e) {
                let submitButton = $(this).find('button[type="submit"]');
                submitButton.attr('disabled', true);

                $(".is-invalid").removeClass('is-invalid');
                $(".invalid-feedback").remove();
                $(".otp-error").remove();
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('otpVerify') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status == 0) {
                            $(".forms-block").addClass('is-invalid');
                            $(".otp-digit").addClass('is-invalid');
                            $(".otp-box").after('<div class="text-danger otp-error"><span class="float-end">' + response.message + '</span></div>');
                            submitButton.attr('disabled', false);

                        }

                        if (response.status == 1) {
                            window.location.href = response.redirectRoute;

                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr, status, error);
                        submitButton.attr('disabled', false);

                    }
                });
            });
        });
    </script>

</body>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Phone OTP Verification</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="">
                        <div class="account-content">
                            <div class="account-info">
                                <div class="login-title">
                                    <p class="mb-0">OTP sent to mobile number <strong id="otp_phone_number">******9575</strong>
                                        <button class="btn mx-0 px-0" type="button" data-bs-dismiss="modal" data-bs-original-title="" title=""><i class="fa-solid fa-pencil"></i></button>
                                    </p>
                                </div>
                                <form method="post" id="otp_form" class="digit-group login-form-control" data-group-name="digits" data-autosubmit="false" autocomplete="off">
                                    <div class="otp-box">
                                        <div class="forms-block">
                                            <input class="otp-digit" type="text" id="digit-1" name="digit-1" data-next="digit-2" maxlength="1">
                                            <input class="otp-digit"type="text" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" maxlength="1">
                                            <input class="otp-digit"type="text" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" maxlength="1">
                                            <input class="otp-digit"type="text" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" maxlength="1">
                                        </div>
                                    </div>
                                    <div class="forms-block">
                                        <div class="otp-info">
                                            <div class="otp-code">
                                                <p>Didn't receive OTP code?</p>
                                                <p><i class="feather-clock"></i> 00:25 secs</p>
                                                <a href="javascript:void(0);">Resend Code</a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="otp_submit_button" class="btn btn-primary" type="submit" data-bs-original-title="" title="">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

</html>
