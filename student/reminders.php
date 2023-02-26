<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['SR_number'])) {
    header('Location: ../auth/login.php');
} else {
    $getstudentInfo = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$_SESSION['SR_number']}'");
    $studentInfo = $getstudentInfo->fetch_assoc();
    $getSectionInfo = $mysqli->query("SELECT * FROM sections WHERE S_name = '{$studentInfo['SR_section']}' AND acadYear = '{$currentSchoolYear}'");
    $SectionInfo = $getSectionInfo->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Student - Reminders</title>
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
    <link href="../assets/css/educ/main.css" rel="stylesheet">
    <link href="../assets/css/admin/style.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
        <img class="m-3" href="../index.php" src="../assets/img/logo.png" style="height: 50px; width:400px;" alt="Icon">
    </nav>
    <!-- Navbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">

        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <style>
                @media (max-width: 991.98px) {
                    .navbar-nav {
                        margin-left: 0px !important;
                    }

                    .navbar .navbar-nav .nav-link {
                        margin-left: 0px !important;
                    }
                }
            </style>
            <div class="navbar-nav m-auto p-4 p-lg-0 ">
                <a href="../index.php" class="nav-item nav-link active" style="color: white; font-size: 14px;">Home</a>
                <a href="" class="nav-item nav-link" style="color: white; font-size: 14px;">About Us</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link" data-bs-toggle="dropdown" style="color: white; font-size: 14px;">Dashboard <i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-menu bg-dark border-0 m-0">
                        <a href="../student/profile.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Profile</a>
                        <a href="../student/grades.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Grades</a>
                        <a href="../student/dailyAttendance.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Attendance</a>
                        <a href="../student/reminders.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Reminders</a>
                        <a href="../student/announcement.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">School Announcements</a>
                    </div>
                </div>
                <a href="" class="nav-item nav-link" style="color: white; font-size: 14px;">Contact Us</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
        <h5 class="fw-bold text-primary text-uppercase" style="font-size: 30px; margin-top: 50px;">Reminders</h5>
    </div>
    <section class="post-content-area">
        <div class="container">
            <div class="row col-lg-10">
                <div class="col-lg-10 posts-list" style="margin-left: auto;">
                    <?php
                    $getReminderData = $mysqli->query("SELECT * FROM reminders WHERE forsection = '{$studentInfo['SR_section']}' AND acadYear = '{$currentSchoolYear}'");
                    if ($getReminderData->num_rows > 0) {
                        while ($reminders = $getReminderData->fetch_assoc()) { ?>
                            <div class="single-post row">
                                <div class="col-lg-3  col-md-3 meta-details">
                                    <div class="user-details row">
                                        <?php
                                        $getAuthorInfo = $mysqli->query("SELECT * FROM faculty WHERE F_number = '{$reminders['author']}'");
                                        $AuthorInfo = $getAuthorInfo->fetch_assoc();
                                        ?>
                                        <p class="user-name col-lg-12 col-md-12 col-6"><span class="far fa-user" style="color: #c02628;"></span>
                                            <?php echo $AuthorInfo['F_lname'] .  ", " . $AuthorInfo['F_fname'] . " " . substr($AuthorInfo['F_mname'], 0, 1) . ". " . $AuthorInfo['F_suffix']; ?>
                                        </p>
                                        <p class="date col-lg-12 col-md-12 col-6"><span class="fa fa-calendar" style="color: #c02628;"></span>
                                            <?php
                                            $storedDate = strtotime($reminders['date_posted']);
                                            echo date("D M/d/Y", $storedDate);
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-lg-12 col-md-9 ">
                                                <p>Subject: <?php echo $reminders['subject'] ?></p>
                                                <p class="excert">
                                                    <?php
                                                    if (empty($reminders['msg'])) {
                                                        echo "No description";
                                                    } else {
                                                        echo $reminders['msg'];
                                                    }
                                                    ?>
                                                </p>
                                                <a href="viewreminders.php?ID=<?php echo $reminders['reminderID'] ?>" class="btn btn-primary me-2">View More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <div class="">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <p class="excert">
                                                No Annoucement yet!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>

                </div>
            </div>
        </div>
    </section>

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
    <script src="../assets/../assets/js/main.js"></script>

    <!-- Javascript -->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/eduwell/isotope.min.js"></script>
    <script src="../assets/js/eduwell/owl-carousel.js"></script>
    <script src="../assets/js/eduwell/lightbox.js"></script>
    <script src="../assets/js/eduwell/tabs.js"></script>
    <script src="../assets/js/eduwell/video.js"></script>
    <script src="../assets/js/eduwell/slick-slider.js"></script>
    <script src="../assets/js/eduwell/custom.js"></script>
    <script src="../assets/js/startup/main.js"></script>

</body>

</html>