<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
    header('Location: ../auth/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Faculty - Reminders</title>
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
    <link href="../assets/css/admin/style.css" rel="stylesheet">
    <link href="../assets/css/educ/main.css" rel="stylesheet">
    <link href="../assets/css/admin/materialdesignicons.min.css" rel="stylesheet">
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
                                        <h2 class="fw-bold text-primary text-uppercase">Reminders</h2>
                                    </div>
                                </div>
                                <div style="text-align: right; margin-top: 30px; margin-right: 20px;">
                                    <a href="createReminder.php" type="submit" style="color: #ffffff;" class="btn btn-primary me-2">Create <i class="fa fa-plus" style="font-size: 10px;"></i></a>
                                </div>
                                <section class="post-content-area" style="background-color: #f4f5f7;">
                                    <div class="container">
                                        <div class="row col-lg-12">
                                            <div class="col-lg-9 posts-list" style="margin: auto; padding-top: 50px;">
                                                <?php
                                                $getreminders = $mysqli->query("SELECT * FROM reminders WHERE author = '{$_SESSION['F_number']}' AND acadYear = '{$currentSchoolYear}'");
                                                if (mysqli_num_rows($getreminders) > 0) {
                                                    while ($reminder = $getreminders->fetch_assoc()) { ?>
                                                        <div class="single-post row">
                                                            <div class="col-lg-3  col-md-3 meta-details">
                                                                <div class="user-details row">
                                                                    <?php
                                                                    $getAuthorName = $mysqli->query("SELECT * FROM faculty WHERE F_number = '{$reminder['author']}'");
                                                                    $authorName = $getAuthorName->fetch_assoc();
                                                                    ?>
                                                                    <p class="user-name col-lg-12 col-md-12"><span class="far fa-user" style="color: #c02628;"> </span><a href="#"> <?php echo $authorName['F_lname'] .  ", " . $authorName['F_fname'] . " " . substr($authorName['F_mname'], 0, 1) ?></a> </p>
                                                                    <p class="date col-lg-12 col-md-12"><span class="fa fa-calendar" style="color: #c02628;"> </span><a> <?php echo $reminder['date_posted'] ?></a> </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="col-lg-12 col-md-9 ">
                                                                            <p>Subject: <?php echo $reminder['subject'] ?></p>
                                                                            <p class="excert text-truncate"><?php echo $reminder['msg'] ?></p>
                                                                            <a href="viewReminders.php?ID=<?php echo $reminder['reminderID'] ?>" class="btn btn-primary">View More</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                } else { ?>
                                                    <div class="single-post">
                                                        <div class="col-6" style="margin:auto">

                                                            <div style="text-align: center;">
                                                                <img src="../assets/img/mailbox.png" style="width: 100px; height: 80px;" style="text-align:center;">
                                                                <p>There are currently no reminders posted. If you wish to create one, click the <span><a href="../faculty/createReminder.php">create</a></span> button at the upper right side. Thank you.</p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                <?php }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <!-- content-wrapper ends -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->

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



        <!-- Template Javascript -->
        <script src="../assets/js/main.js"></script>

        <script src="../assets/js/admin/vendor.bundle.base.js"></script>
        <script src="../assets/js/admin/off-canvas.js"></script>
        <script src="../assets/js/admin/file-upload.js"></script>

</body>

</html>