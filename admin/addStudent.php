<?php
require_once("../assets/php/server.php");
$get_userID = ("SELECT COUNT(SR_ID) FROM studentrecord");
$result = $mysqli->query($get_userID);
$count = $result->fetch_assoc();
$studentCounter = $count["COUNT(SR_ID)"] + 1;
$format_StudentCounter = sprintf("%05d", $studentCounter);
$year = date("Y");
$studentNumber = $year . "-" . $format_StudentCounter . "-SP";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/form-style.css" rel="stylesheet">

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border position-relative text-primary" style="width: 6rem; height: 6rem;" role="status"></div>
        <img class="position-absolute top-50 start-50 translate-middle" src="../assets/img/icons/icon-1.png" alt="Icon">
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
        <img class="m-3" src="../assets/img/logo.png" style="height: 50px; width:50px;" alt="Icon">
        <div class="d-flex align-items-center justify-content-center text-center">
            <a href="../index.php" class="navbar-brand ms-4 ms-lg-0 text-center">
                <h1 class="cdsp">Colegio De San Pedro</h1>
                <h1 class="cdsp1" alt="Icon">Student Information and Monitoring System</h1>
            </a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">

        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0 ">
                <a href="index.php" class="nav-item nav-link active" style="color: white">Home</a>
                <a href="about.html" class="nav-item nav-link" style="color: white">About Us</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link dropdown-toggle" data-bs-toggle="dropdown" style="color: white">Academics</a>
                    <div class="dropdown-menu bg-dark border-0 m-0">
                        <a href="auth/login.php" class="dropdown-item" style="color: white">Student Information System</a>
                        <a href="" class="dropdown-item" style="color: white">Kindergarten</a>
                        <a href="" class="dropdown-item" style="color: white">Pre-Elementary</a>
                        <a href="" class="dropdown-item" style="color: white">Elementary</a>
                        <a href="" class="dropdown-item" style="color: white">Highschool</a>
                        <a href="" class="dropdown-item" style="color: white">Senior Highschool</a>
                        <a href="" class="dropdown-item" style="color: white">College</a>
                    </div>
                </div>
                <a href="service.html" class="nav-item nav-link" style="color: white">Admissions</a>
                <a href="contact.html" class="nav-item nav-link" style="color: white">Scholarship and Discounts</a>
                <a href="contact.html" class="nav-item nav-link" style="color: white">Contact Us</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <form class="container m-6">
        <main>
            <div class="py-5 text-center">
                <h2>Student Registration</h2>
            </div>
            <div class="row g-3">
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Student Information</h4>
                    <div class="card p-3">
                        <div class="row g-3 mb-3">
                            <div class="col-4 form-group">
                                <label for="firstName" class="form-label">First name</label>
                                <input type="text" class="form-control fullwidth " id="firstName" required>
                            </div>

                            <div class="col-3 form-group">
                                <label for="firstName" class="form-label">Middle name</label>
                                <input type="text" class="form-control fullwidth" id="firstName" required>
                            </div>

                            <div class="col-4 form-group">
                                <label for="lastName" class="form-label">Last name</label>
                                <input type="text" class="form-control fullwidth" id="lastName">
                            </div>
                            <div class="col-1 form-group">
                                <label for="lastName" class="form-label">Suffix</label>
                                <input type="text" class="form-control fullwidth" id="lastName">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-1 form-group">
                                <label for="firstName" class="form-label">Age</label>
                                <input type="number" class="form-control fullwidth " id="firstName" required>
                            </div>

                            <div class="col-3 form-group">
                                <label for="firstName" class="form-label">Birthday</label>
                                <input type="date" class="form-control fullwidth" id="firstName" required>
                            </div>

                            <div class="col-4 form-group">
                                <label for="lastName" class="form-label">Gender</label>
                                <select class="form-select form-control" id="lastName" required>
                                    <option value=""></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="NA">Prefer not to say</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-8 form-group">
                                <label for="firstName" class="form-label">Address</label>
                                <input type="number" class="form-control fullwidth " id="firstName" required>
                            </div>
                            <div class="col-4 form-group">
                                <label for="firstName" class="form-label">City</label>
                                <input type="number" class="form-control fullwidth " id="firstName" required>
                            </div>
                            <div class="col-4 form-group">
                                <label for="firstName" class="form-label">State</label>
                                <input type="number" class="form-control fullwidth " id="firstName" required>
                            </div>
                            <div class="col-4 form-group">
                                <label for="firstName" class="form-label">Postal Code</label>
                                <input type="number" class="form-control fullwidth " id="firstName" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6 form-group">
                                <label for="firstName" class="form-label">Guardian Name</label>
                                <input type="number" class="form-control fullwidth " id="firstName" required>
                            </div>
                            <div class="col-6 form-group">
                                <label for="firstName" class="form-label">Contact Number</label>
                                <input type="number" class="form-control fullwidth " id="firstName" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="mb-3">Class Information</h4>
                    <div class="card p-3">
                        <div class="row g-3 mb-3">

                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6 form-group">
                                <label for="SR_number" class="form-label">Student Number</label>
                                <input type="text" class="form-control fullwidth" name="SR_number" id="SR_number" value="<?php echo $studentNumber ?>" readonly>
                            </div>
                            <div class="col-6 form-group">
                                <label for="lastName" class="form-label">Year Level</label>
                                <select class="form-select form-control fullwidth" id="lastName" required>
                                    <option value=""></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="NA">Prefer not to say</option>
                                </select>
                            </div>
                            <div class="col-6 form-group">
                                <label for="lastName" class="form-label">Section</label>
                                <select class="form-select form-control fullwidth" id="lastName" required>
                                    <option value=""></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="NA">Prefer not to say</option>
                                </select>
                            </div>
                            <div class="col-6 form-group">
                                <label for="lastName" class="form-label">Schedule</label>
                                <select class="form-select form-control fullwidth" id="lastName" required>
                                    <option value=""></option>
                                    <option value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-3 justify-content-center">
                <button class="w-50 btn btn-primary btn-lg mb-5" type="submit">Register Student</button>
            </div>
        </main>
    </form>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-body footer mt-5 pt-5 px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-light mb-4">Address</h3>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>Phase 1A, Pacita Complex 1, San Pedro City, Laguna 4023</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary me-3"></i>+63 919 065 6576</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>di ko alam email</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-body me-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-body me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-body me-1" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-body me-0" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-light mb-4">Quick Links</h3>
                    <a class="btn btn-link" href="">Home</a>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Academics</a>
                    <a class="btn btn-link" href="">Admission</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-light mb-4">Useful Links</h3>
                    <a class="btn btn-link" href="">DepEd</a>
                    <a class="btn btn-link" href="">Pag Asa</a>
                    <a class="btn btn-link" href="">City of San Pedro</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-light mb-4">Newsletter</h3>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="#">Colegio De San Pedro</a>, All Right Reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/lib/wow/wow.min.js"></script>
    <script src="../assets/lib/easing/easing.min.js"></script>
    <script src="../assets/lib/waypoints/waypoints.min.js"></script>
    <script src="../assets/lib/counterup/counterup.min.js"></script>
    <script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="../assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>

</body>

</html>