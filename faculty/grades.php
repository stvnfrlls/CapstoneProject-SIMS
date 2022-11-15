<?php require_once("../assets/php/server.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Faculty - Grades</title>
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
    <link href="../assets/css/dashboard-user.css" rel="stylesheet">


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
        <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="dashboard.php" class="nav-item nav-link" style="color: white">Home</a>
                <a href="scanQR.php" class="nav-item nav-link" style="color: white">Scan QR</a>
                <a href="classList.php" class="nav-item nav-link" style="color: red">Grades</a>
                <a href="reminders.php" class="nav-item nav-link" style="color: white">Reminders/Assignments</a>
                <a href="editProfile.php" class="nav-item nav-link" style="color: white">Profile</a>
                <a href="../auth/logout.php" class="nav-item nav-link" style="color: white">Logout</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <div class="container py-5">
        <div class="mb-3">
            <div class="section-title text-center position-relative pb-3 mb-4">
                <h2 class="fw-bold text-primary text-uppercase">Grades</h2>
            </div>
            <nav class="pb-3">
                <ul class="nav nav-pills justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" href="#ClassPerformance" data-toggle="tab">Class Performance</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="#FinalGrade" data-toggle="tab">Final Grade</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="tab-content">
            <div class="tab-pane active" id="ClassPerformance">
                <div class="container justify-content-center">
                    <?php
                    if (empty($_SESSION['SR_number'])) { ?>
                        <div class="row mb-3">
                            <div class="col-lg-10 col-md-12">
                                <div class="m-2">
                                    <h4>Section Name: SECTION NAME</h4>
                                    <p>Number of Students: --/--</p>
                                </div>
                            </div>
                            <div class="col-2">
                                <button>BACK</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-12 card">
                                <div class="m-2 text-center">
                                    <h4>Student Number: FULLNAME</h4>
                                    <p>Name of Students: YYYY-?????-SP</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 card">
                                <div class="m-2 text-center">
                                    <h4>Student Number: FULLNAME</h4>
                                    <p>Name of Students: YYYY-?????-SP</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 card">
                                <div class="m-2 text-center">
                                    <h4>Student Number: FULLNAME</h4>
                                    <p>Name of Students: YYYY-?????-SP</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 card">
                                <div class="m-2 text-center">
                                    <h4>Student Number: FULLNAME</h4>
                                    <p>Name of Students: YYYY-?????-SP</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 card">
                                <div class="m-2 text-center">
                                    <h4>Student Number: FULLNAME</h4>
                                    <p>Name of Students: YYYY-?????-SP</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 card">
                                <div class="m-2 text-center">
                                    <h4>Student Number: FULLNAME</h4>
                                    <p>Name of Students: YYYY-?????-SP</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 card">
                                <div class="m-2 text-center">
                                    <h4>Student Number: FULLNAME</h4>
                                    <p>Name of Students: YYYY-?????-SP</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 card">
                                <div class="m-2 text-center">
                                    <h4>Student Number: FULLNAME</h4>
                                    <p>Name of Students: YYYY-?????-SP</p>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else { ?>
                        <div class="container justify-content-center">
                            <div class="container justify-content-center">
                                <div class="row mb-3">
                                    <div class="col-lg-12 col-md-12 card">
                                        <h4>Student Number: kjashdjkashdjkashdkjas</h4>
                                        <p>Students: 90-218309128</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col m-3">
                                        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                                            <h5 class="fw-bold text-primary text-uppercase">Assignments</h5>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-class">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Date Posted</th>
                                                        <th scope="col">Due Date</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Grade</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="GET">
                                                        <tr>
                                                            <td>120938210938</td>
                                                            <td>-10293-01293</td>
                                                            <td>
                                                                <select class="browser-default custom-select">
                                                                    <option selected>Open this select menu</option>
                                                                    <option value="1">One</option>
                                                                    <option value="2">Two</option>
                                                                    <option value="3">Three</option>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" size="4" required></td>
                                                            <td>
                                                                <div class="row">
                                                                    <input type="submit" placeholder="Encode Grades">
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                    </form>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col m-3">
                                        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                                            <h5 class="fw-bold text-primary text-uppercase">Quizzes</h5>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-class">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Date Posted</th>
                                                        <th scope="col">Due Date</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Grade</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="GET">
                                                        <tr>
                                                            <td>120938210938</td>
                                                            <td>-10293-01293</td>
                                                            <td>
                                                                <select class="browser-default custom-select">
                                                                    <option selected>Open this select menu</option>
                                                                    <option value="1">One</option>
                                                                    <option value="2">Two</option>
                                                                    <option value="3">Three</option>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" size="4" required></td>
                                                            <td>
                                                                <div class="row">
                                                                    <input type="submit" placeholder="Encode Grades">
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                    </form>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col m-3">
                                        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                                            <h5 class="fw-bold text-primary text-uppercase">Examinations</h5>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-class">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Date Posted</th>
                                                        <th scope="col">Due Date</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Grade</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="GET">
                                                        <tr>
                                                            <td>120938210938</td>
                                                            <td>-10293-01293</td>
                                                            <td>
                                                                <select class="browser-default custom-select">
                                                                    <option selected>Open this select menu</option>
                                                                    <option value="1">One</option>
                                                                    <option value="2">Two</option>
                                                                    <option value="3">Three</option>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" size="4" required></td>
                                                            <td>
                                                                <div class="row">
                                                                    <input type="submit" placeholder="Encode Grades">
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                    </form>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="tab-pane" id="FinalGrade">
                <div class="container justify-content-center">
                    <div class="container justify-content-center">
                        <div class="row mb-3">
                            <div class="col-lg-10 col-md-12">
                                <div class="m-2">
                                    <h4>Section Name: SECTION NAME</h4>
                                    <p>Number of Students: --/--</p>
                                </div>
                            </div>
                            <div class="col-2">
                                <button>BACK</button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12 col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-class" id="table-id">
                                        <thead>
                                            <tr>
                                                <th scope="col">Enrolled Students</th>
                                                <th scope="col">Attendance</th>
                                                <th scope="col">Class Performance</th>
                                                <th scope="col">Final Grade</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="GET">
                                                <tr>
                                                    <td>Student name or number</td>
                                                    <td>attendance grade</td>
                                                    <td>overall class Performance</td>
                                                    <td>Final Grade</td>
                                                    <td>
                                                        <div class="row">
                                                            <input type="submit" placeholder="Encode Grades">
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </form>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- End of Container -->

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
    <script>
        $('#myTab a').click(function(e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>

</body>

</html>