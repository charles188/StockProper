<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>StockProper</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="assets/css/landy-iconfont.css">
    <!-- Google fonts - Open Sans-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800">
    <!-- owl carousel-->
    <link rel="stylesheet" href="assets/vendor/owl.carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="assets/vendor/owl.carousel/assets/owl.theme.default.css">
    <!-- stylesheet-->
    <link rel="stylesheet" href="assets/css/style.css" id="theme-stylesheet">
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">

  </head>
  <body>
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg fixed-top"><a class="logo" href=".">
        <img src="assets/images/stockproperv.png" alt="stockproper" height="70">
      </a>
        <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><span></span><span></span><span></span></button>
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto align-items-start align-items-lg-center">
            <li class="nav-item"><a href="pricing.html" class="nav-link link-scroll">Pricing</a></li>
            <li class="nav-item"><a href="about.html" class="nav-link link-scroll">About</a></li>
            <li class="nav-item"><a href="contact.html" class="nav-link link-scroll active">Help Center</a></li>
            <li class="nav-item"><a href="contact.html" class="nav-link">Book a Demo</a></li>
          </ul>
          <div class="CTA"><a href="#" data-toggle="modal" data-target="#exampleModallogin" class="btn btn-outline-primary" style="margin-left: 20px;">Login</a></div>
          <div class="navbar-text">   
            <!-- Button trigger modal--><a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary navbar-btn btn-shadow btn-gradient">Register</a>
          </div>
        </div>
      </nav>
    </header>

    <!-- Sign up Modal-->
    <div id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">Sign Up</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <form id="signupform" method="post" action="signup.php">
              <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" name="fullname" placeholder="Full Name" id="fullname" required>
              </div>
              <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" name="username" placeholder="User Name" id="username" required>
              </div>
              <div class="form-group">
                <label for="email">Email Address</label>
                <input type="text" name="email" placeholder="Email Address" id="email" required>
              </div>
              <div class="form-group">
                <label for="email">Password</label>
                <input type="password" name="password" placeholder="Password" id="password" required>
              </div>
              <div class="form-group">
                <label for="fullname">Business Name</label>
                <input type="text" name="businessname" placeholder="Business Name" id="businessname" required>
              </div>
              <div class="form-group">
                <label for="fullname">Type of Business</label>
                <input type="text" name="businesstype" placeholder="Type of Business" id="businesstype" required>
              </div>
              <div class="form-group">
                <label for="username">Business Address</label>
                <input type="text" name="address" placeholder="Business Address" id="address" required>
              </div>
              <div class="form-group">
                <label for="email">Post Code</label>
                <input type="text" name="postcode" placeholder="Post Code" id="postcode" required>
              </div>
              <div class="form-group">
                <label for="email">Phone</label>
                <input type="text" name="phone" placeholder="Phone" id="phone" required>
              </div>
               <!-- Checkbox -->
              <div class="form-check d-flex justify-content-center mb-4" >
                  <input 
                     class="form-check-input me-2"
                     type="checkbox"
                     value=""
                     id="form2Example3"
                     unchecked
                     required
                  />
                  <label class="form-check-label" for="form2Example3">
                    <br> I Agree to the Terms and Conditions
                  </label>
                </div>
              <div class="form-group">
                <button type="submit" class="submit btn btn-primary btn-shadow btn-gradient">Signup</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

     <!-- Sign In Modal-->
     <div id="exampleModallogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">Sign In</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <form id="signupform" method="post" action="login.php">
              <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" name="username" placeholder="User Name" id="username">
              </div>
              <div class="form-group">
                <label for="email">Password</label>
                <input type="password" name="password" placeholder="Password" id="password">
              </div>
              <div class="form-group">
                <label class="form-label" for="form3Example3">User Type</label>
                <select class="custom-select form-control" id="inputGroupSelect01 form3Example2" name="usertype" required>
                    <option value="Regular User"selected>Regular User</option>
                    <option value="Admin">Admin</option>
                  </select>
                  <a href="password-reset/">reset password</a>
              </div>
              <div class="form-group">
                <button type="submit" class="submit btn btn-primary btn-shadow btn-gradient">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <section id="hero" class="hero hero-home bg-black">
      <div class="container">
        <div class="row d-flex">
          <div class="col-lg-6">
            <div class="contact-box ml-3">
                <div class="alert alert-danger">
                <h4 class="font-weight-light mt-2"><?php echo $error. ', please try again.'; ?>
                </div>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2"><img src="assets/images/contact.jpg" alt="..." class="img-fluid"></div>
        </div>
      </div>
    </section>
   

    <div id="scrollTop">
      <div class="d-flex align-items-center justify-content-end"><i class="fa fa-long-arrow-up"></i>To Top</div>
    </div>
    <footer class="main-footer bg-gray">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6"><a href="#" class="brand">StockProper</a>
            <ul class="contact-info list-unstyled">
              <li><a href="mailto:sales@landy.com">info@stockproper.com</a></li>
              <li><a href="tel:07776795096">+44 777 679 5096</a></li>
            </ul>
            <ul class="social-icons list-inline">
              <li class="list-inline-item"><a href="#" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
              <li class="list-inline-item"><a href="#" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
              <li class="list-inline-item"><a href="#" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>
              <li class="list-inline-item"><a href="#" target="_blank" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6">
            <h5>Let Us Help You</h5>
            <ul class="links list-unstyled">
              <li> <a href="contact.html">Help Center</a></li>
              <li> <a href="contact.html">Book a Demo</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6">
            <h5>More Info</h5>
            <ul class="links list-unstyled">
              <li> <a href="about.html">About</a></li>
              <li> <a href="pricing.html">Pricing</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6">
            <h5>Terms</h5>
            <ul class="links list-unstyled">
              <li> <a href="privacy.html">Privacy Policy</a></li>
              <li> <a href="terms.html">Terms and Conditions</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="copyrights">
        <div class="container">
          <div class="row">
            <div class="col-md-7">
              <p>&copy; 2021 Charles Odum. All rights reserved.      </p>
            </div>
            <div class="col-md-5 text-right">
              <p> <a href="#" class="external">CMM513</a>  </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Javascript files-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"> </script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="assets/js/front.js"></script>
    
    <!---->
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>
  </body>
</html>