<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
    header('Location: ../auth/login.php');
} else {
    if (isset($_GET['postID'])) {
        $getAnnouncementData = $mysqli->query("SELECT * FROM announcement WHERE ANC_ID = '{$_GET['postID']}'");
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
    <title>Faculty - Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../assets/img/favicon.png" rel="icon">

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
    <link href="../assets/css/admin/style.css" rel="stylesheet">
    <link href="../assets/css/educ/main.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    <nav class="fixed-top align-items-top">
        <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
            <img class="m-3" href="../index.php" src="../assets/img/logo.png" style="height: 50px; width:300px;" alt="Icon">
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                <span class="fa fa-bars"></span>
            </button>
        </nav>
    </nav>
    <!-- Navbar End -->

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item" style="text-align:center; font-size: 20px; color: #b9b9b9; margin-top:20px;">FACULTY</li>
                    <!-- line 1 -->
                    <li class="nav-item nav-category">Profile</li>
                    <li class="nav-item">
                        <a class="nav-link" href="../faculty/dashboard.php">
                            <i class=""></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../faculty/viewProfile.php">
                            <i class=""></i>
                            <span class="menu-title">View Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../faculty/reminders.php">
                            <i class=""></i>
                            <span class="menu-title">Reminders</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../faculty/announcement.php">
                            <i class=""></i>
                            <span class="menu-title">School Announcements</span>
                        </a>
                    </li>
                    <!-- line 2 -->
                    <li class="nav-item nav-category">Menu</li>
                    <li class="nav-item">
                        <a class="nav-link" href="../faculty/scanQR.php">
                            <i class=""></i>
                            <span class="menu-title">Scan QR</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../faculty/advisoryPage.php">
                            <i class=""></i>
                            <span class="menu-title">Advisory Class</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../faculty/classList.php">
                            <i class=""></i>
                            <span class="menu-title">Class List</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../faculty/encodegrades.php">
                            <i class=""></i>
                            <span class="menu-title">Encode Grades</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../faculty/studentStatus.php">
                            <i class=""></i>
                            <span class="menu-title">Student Status</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../faculty/dailyReports.php">
                            <i class=""></i>
                            <span class="menu-title">Attendance Report</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../auth/logout.php">
                            <i class=""></i>
                            <span class="menu-title">Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <div class="section-title text-center position-relative pb-3 mb-3 mx-auto">
                                        <h2 class="fw-bold text-primary text-uppercase">School Announcements</h2>
                                    </div>
                                </div>

                                <section class="course-details-area" style="margin-top: 50px">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-8 left-contents">
                                                <div class="jq-tab-wrapper" id="horizontalTab" style="padding-top: 0px;">
                                                    <div class="jq-tab-menu">
                                                        <div class="jq-tab-title active" data-tab="1">About</div>

                                                    </div>
                                                    <div class="jq-tab-content-wrapper">
                                                        <div class="jq-tab-content active" data-tab="1">
                                                            <?php echo $announcement['msg'] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 right-contents">
                                                <ul>
                                                    <li>
                                                        <a class="justify-content-between d-flex" href="#">
                                                            <p>Title</p>
                                                            <span class="or" style="text-align: right;"><?php echo $announcement['header'] ?></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="justify-content-between d-flex" href="#">
                                                            <p>Posted By</p>
                                                            <span>
                                                                <?php
                                                                $getAuthorName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$announcement['author']}'");
                                                                $AuthorName = $getAuthorName->fetch_assoc();

                                                                echo $AuthorName['AD_name'];
                                                                ?>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="justify-content-between d-flex" href="#">
                                                            <p>Date of the Event</p>
                                                            <span><?php echo $announcement['date'] ?></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>

                    <section class="popular-courses-area section-gap courses-page">
                        <div class="container">
                            <div class="row d-flex justify-content-center">
                                <div class="menu-content">
                                    <div class="title text-center">
                                        <div class="section-title text-center position-relative pb-3 mb-3 mx-auto">
                                            <h2 class="fw-bold text-primary text-uppercase">More School Announcements</h2>
                                        </div>
                                        <?php
                                        $getOtherAnnouncementData = $mysqli->query("SELECT * FROM announcement WHERE ANC_ID != '{$_GET['postID']}'");
                                        if (mysqli_num_rows($getOtherAnnouncementData) > 0) {
                                            echo '<p></p>';
                                        } else {
                                            echo '<p>No more announcements</p>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php
                                if (mysqli_num_rows($getOtherAnnouncementData) > 0) {
                                    while ($OtherAnnouncement = $getOtherAnnouncementData->fetch_assoc()) { ?>
                                        <div class="single-popular-carusel col-lg-3 col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="details">
                                                        <a href="viewAnnouncement.php?ID=<?php echo $OtherAnnouncement['ANC_ID'] ?>">
                                                            <h4><?php echo $OtherAnnouncement['header'] ?></h4>
                                                        </a>
                                                        <div class="d-flex mb-3">
                                                            <small class="me-3"><i class="far fa-user text-primary me-2"></i><?php echo $OtherAnnouncement['author'] ?></small>
                                                            <small><i class="far fa-calendar-alt text-primary me-2"></i><?php echo $OtherAnnouncement['date'] ?></small>
                                                        </div>
                                                        <p class="text-truncate"><?php echo $OtherAnnouncement['msg'] ?></p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                <?php }
                                }
                                ?>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->


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

    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/admin/vendor.bundle.base.js"></script>
    <script src="../assets/js/admin/off-canvas.js"></script>
    <script src="../assets/js/admin/file-upload.js"></script>

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