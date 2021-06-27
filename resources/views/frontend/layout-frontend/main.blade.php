<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Kecamatan @yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('frontend/img/favicon.png') }}assets/" rel="icon">
  <link href="{{ asset('frontend/img/apple-touch-icon.png') }}assets/" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/venobox/venobox.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: MyBiz - v2.2.1
  * Template URL: https://bootstrapmade.com/mybiz-free-business-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    /* CSS RATING */
    .rate {
        float: left;
        height: 46px;
        padding: 0 57px;
    }
    .rate:not(:checked) > input {
        position:absolute;
        top:-9999px;
    }
    .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffc700;    
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;  
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }
  </style>
  <script>
    // JS Validation KTP dan KK
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    </script>
</head>

<body>


  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center bg-warning">
    <div class="container-fluid d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.html">My<span>Biz</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="{{ url('/') }}">Home</a></li>
            @if (Auth::check())
                @if (Auth::user()->role_user == 'Staff-Kelurahan' || Auth::user()->role_user == 'Ketua-RW' || Auth::user()->role_user == 'Ketua-RT' )
                  <li><a class="btn btn-danger text-white mr-1" href="{{ url('backend') }}" style="border-radius: 25px">Dashboard</a></li>
                @else
                    <li class="mt-1 mr-2"><h4> | Hi {{ Auth::user()->name }} | </h4></li>
                    @if (Auth::user()->rating == null)
                      <li><a class="btn btn-primary text-white mr-1" href="{{ url('backend') }}" data-toggle="modal" data-target="#rating" style="border-radius: 25px">Rating</a></li>
                    @endif
                    <li>
                      <a href="{{ url('status-permohonan') }}" class="btn btn-light mr-1" style="border-radius: 25px">Status Permohonan</a>
                    </li>
                    <li>
                        <a class="btn btn-danger text-white" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"  style="border-radius: 25px">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>        
                @endif
            @else
                <li><a href="{{ route('register') }}">Register</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
            @endif
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->


  

  <main id="main">
    @if(session('message'))
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="alert alert-{{ session('style') }} mt-2" id="alert-notification">
            <div class="row">
                <div class="col-md-11">
                    <h5>{{ session('message') }}</h5>
                </div>
                <div class="col-md-1 text-right">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>
        </div>
        </div>
      </div>
    @endif

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        @yield('content')

        <!-- Modal Permohonan KTP-->
        <div class="modal fade" id="rating" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Rating</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form action="{{ url('/rating') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <p>Berikan kami nilai tentang pelayanan ini, agar bisa menjadi lebih baik lagi .. </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                      <div class="rate ml-3 bg-light">
                        <input type="radio" id="star5" name="rates" value="10" />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rates" value="8" />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rates" value="6" />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rates" value="4" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rates" value="2" />
                        <label for="star1" title="text">1 star</label>
                      </div>
                    </div>
                    <div class="col-sm-2"></div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-block" style="border-radius: 20px">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </section><!-- End About Section -->

  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>MyBiz</h3>
              <p>
                A108 Adam Street <br>
                NY 535022, USA<br><br>
                <strong>Phone:</strong> +1 5589 55488 55<br>
                <strong>Email:</strong> info@example.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>MyBiz</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/mybiz-free-business-bootstrap-theme/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}assets/vendor/"></script>
  <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}assets/vendor/"></script>
  <script src="{{ asset('frontend/vendor/jquery.easing/jquery.easing.min.js') }}assets/vendor/"></script>
  <script src="{{ asset('frontend/vendor/php-email-form/validate.js') }}assets/vendor/"></script>
  <script src="{{ asset('frontend/vendor/jquery-sticky/jquery.sticky.js') }}assets/vendor/"></script>
  <script src="{{ asset('frontend/vendor/waypoints/jquery.waypoints.min.js') }}assets/vendor/"></script>
  <script src="{{ asset('frontend/vendor/counterup/counterup.min.js') }}assets/vendor/"></script>
  <script src="{{ asset('frontend/vendor/isotope-layout/isotope.pkgd.min.js') }}assets/vendor/"></script>
  <script src="{{ asset('frontend/vendor/venobox/venobox.min.js') }}assets/vendor/"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>