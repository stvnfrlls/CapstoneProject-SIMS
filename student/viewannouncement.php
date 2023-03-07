<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['SR_number'])) {
    header('Location: ../auth/login.php');
} else {
    if (isset($_GET['ID'])) {
        $getAnnouncementData = $mysqli->query("SELECT * FROM announcement WHERE ANC_ID = '{$_GET['ID']}'");
        $announcement = $getAnnouncementData->fetch_assoc();
    } else {
        header('Location: announcement.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Student - School Announcements</title>
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
    <link href="../assets/css/admin/style.css" rel="stylesheet">
    <link href="../assets/css/educ/main.css" rel="stylesheet">

</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
        <img class="m-3" href="../index.php" src="../assets/img/logo.png" style="height: 50px; width:300px;" alt="Icon">
    </nav>
    <!-- Navbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">

        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars" style="color:white;"></span>
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
                    <a href="#" class="nav-item nav-link" data-bs-toggle="dropdown" style="color: white; font-size: 14px;">Menu <i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-menu bg-dark border-0 m-0">
                        <a href="../student/dashboard.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Dashboard</a>
                        <a href="../student/profile.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Profile</a>
                        <a href="../student/grades.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Grades</a>
                        <a href="../student/dailyAttendance.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Attendance</a>
                        <a href="../student/reminders.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Reminders</a>
                        <a href="../student/announcement.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">School Announcements</a>
                        <a href="../auth/logout.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Logout</a>
                    </div>
                </div>
                <a href="" class="nav-item nav-link" style="color: white; font-size: 14px;">Faculty Directory</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <section class="course-details-area pt-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 left-contents">
                    <div class="jq-tab-wrapper" id="horizontalTab" style="padding-top: 0px;">
                        <div class="jq-tab-menu">
                            <div class="jq-tab-title active" data-tab="1">Description</div>

                        </div>
                        <div class="jq-tab-content-wrapper">
                            <div class="jq-tab-content active" data-tab="1">
                                <?php
                                if (empty($announcement['msg'])) {
                                    echo $announcement['header'];
                                } else {
                                    echo $announcement['msg'];
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 right-contents">
                    <ul>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Title</p>
                                <span class="or"><?php echo $announcement['header']; ?></span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Posted By</p>
                                <span>
                                    <?php
                                    $getAuthorName = $mysqli->query("SELECT * FROM admin_accounts WHERE AD_number = '{$announcement['author']}'");
                                    $authorName = $getAuthorName->fetch_assoc();

                                    echo $authorName['AD_name'];
                                    ?>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Date and Time</p>
                                <span><?php echo $announcement['date'] ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="popular-courses-area section-gap courses-page">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">School Announcements</h1>
                        <p>more announcements</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                $getOtherAnnouncementData = $mysqli->query("SELECT * FROM announcement WHERE ANC_ID != '{$_GET['ID']}'");
                while ($OtherAnnouncement = $getOtherAnnouncementData->fetch_assoc()) { ?>
                    <div class="single-popular-carusel col-lg-3 col-md-6">
                        <div class="details">
                            <a href="viewannouncement.php?ID=<?php echo $OtherAnnouncement['ANC_ID'] ?>">
                                <h4><?php echo $OtherAnnouncement['header'] ?></h4>
                            </a>
                            <div class="d-flex mb-3">
                                <small class="me-3"><i class="far fa-user text-primary me-2"></i><?php echo $OtherAnnouncement['author'] ?></small>
                                <small><i class="far fa-calendar-alt text-primary me-2"></i><?php echo $OtherAnnouncement['date'] ?></small>
                            </div>
                            <p><?php echo $OtherAnnouncement['msg'] ?></p>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </section>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-body footer wow fadeIn" data-wow-delay="0.1s">
        <div class="container-fluid copyright" style="padding: 15px 0px 15px 0px;">
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


    <script src="../assets/js/educ/vendor/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/educ/vendor/bootstrap.min.js"></script>
    <script src="../assets/js/educ/easing.min.js"></script>
    <script src="../assets/js/educ/hoverIntent.js"></script>
    <script src="../assets/js/educ/superfish.min.js"></script>
    <script src="../assets/js/educ/jquery.ajaxchimp.min.js"></script>
    <script src="../assets/js/educ/jquery.magnific-popup.min.js"></script>
    <script src="../assets/js/educ/jquery.tabs.min.js"></script>
    <script src="../assets/js/educ/jquery.nice-select.min.js"></script>
    <script src="../assets/js/educ/owl.carousel.min.js"></script>
    <script src="../assets/js/educ/mail-script.js"></script>
    <script src="../assets/js/educ/main.js"></script>

</body>

</html>