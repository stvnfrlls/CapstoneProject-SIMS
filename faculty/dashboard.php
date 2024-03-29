<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
    header('Location: ../auth/login.php');
} else {
    $facultyData = $mysqli->query("SELECT * FROM faculty WHERE F_number = '{$_SESSION['F_number']}'");
    $getFacultyData = $facultyData->fetch_assoc();

    $facultySchedule = $mysqli->query("SELECT * FROM workschedule WHERE F_number = '{$_SESSION['F_number']}' AND acadYear = '{$currentSchoolYear}' ORDER BY WS_start_time ASC");
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
    <link href="../assets/css/admin/style.css" rel="stylesheet">
    <link href="../assets/css/dashboard-user.css" rel="stylesheet">
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
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <style>
                                                h3 {
                                                    font-family: "Lato", "san serif";
                                                }
                                            </style>
                                            <div class="col-sm-12 col-lg-4 grid-margin">
                                                <div class="row">
                                                    <div class="col-12 grid-margin">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <?php
                                                                    $profile_path = "../assets/img/profile/" . $getFacultyData['F_profile_img'];
                                                                    if (empty($getFacultyData['F_profile_img']) || !file_exists($profile_path)) { ?>
                                                                        <img src="../assets/img/profile.png" alt="avatar" class="rounded-circle img-fluid" style="width: 100px;">
                                                                    <?php } else { ?>
                                                                        <img src="../assets/img/profile/<?php echo $getFacultyData['F_profile_img'] ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 100px; height: 60px;">
                                                                    <?php }
                                                                    ?>
                                                                    <div class="col-8" style="align-self: center;">
                                                                        <h3 style="text-align: left;"><?php echo $getFacultyData['F_lname'] . ", " . $getFacultyData['F_fname'] . " " . substr($getFacultyData['F_mname'], 0, 1) . ". " . $getFacultyData['F_suffix'] . "" ?></h3>
                                                                        <p style="margin-bottom: 8px;"><?php echo $getFacultyData['F_number'] ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 grid-margin">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <p class="mb-4" style="text-align: center; color:#c02628;">Schedule For Today</p>
                                                                <?php
                                                                if (mysqli_num_rows($facultySchedule) > 0) {
                                                                    while ($getFacultySchedule = $facultySchedule->fetch_assoc()) { ?>
                                                                        <p class="mb-1" style="font-size: 13px; padding-top:15px;">
                                                                            <?php echo "Grade " . $getFacultySchedule['SR_grade'] . "-" . $getFacultySchedule['SR_section'] . " (" . $getFacultySchedule['S_subject'] . ")" ?>
                                                                        </p>
                                                                        <div class="progress rounded" style="height: 25px;">
                                                                            <p style="font-size: .77rem; margin: 5px 0px 0px 7px">
                                                                                <?php
                                                                                $start = date('h:i A', strtotime($getFacultySchedule['WS_start_time']));
                                                                                $end = date('h:i A', strtotime(timeRoundUp($getFacultySchedule['WS_end_time'])));
                                                                                echo $start . " - " . $end;
                                                                                ?>
                                                                            </p>
                                                                        </div>
                                                                    <?php
                                                                    }
                                                                } else { ?>
                                                                    <div class="progress rounded" style="height: 25px;">
                                                                        <p class="text-center" style="font-size: .77rem; margin: 5px 0px 0px 7px">
                                                                            NO ASSIGNED SCHEDULE YET
                                                                        </p>
                                                                    </div>
                                                                <?php }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-8 grid-margin">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">

                                                                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                                                        <h3 class="mb-0" style="text-align:left;">My Class Advisory</h3>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center">
                                                                            <h1 class="display-1 mb-n2" data-toggle="counter-up" style="font-size:40px; color:#c02628;">
                                                                                <?php
                                                                                $countStudent = $mysqli->query("SELECT COUNT(SR_number) AS numStudent FROM classlist WHERE F_number = '{$_SESSION['F_number']}' AND acadYear = '{$currentSchoolYear}' ");
                                                                                $getNumStudent = $countStudent->fetch_assoc();

                                                                                echo $getNumStudent['numStudent'];
                                                                                ?>
                                                                            </h1>
                                                                        </div>
                                                                        <h3 class="d-flex flex-shrink-0 align-items-center justify-content-center" style="font-size: 20px; padding-top: 10px; text-align:center;">No. of Students</h3>

                                                                    </div>
                                                                    <div class="col-6" style="align-self: center;">
                                                                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center">
                                                                            <h1 class="display-1 mb-n2" data-toggle="counter-up" style="font-size:40px; color:#c02628;">
                                                                                <?php
                                                                                $currentDate = date("Y-m-d");
                                                                                $getAttendanceCountToday = $mysqli->query("SELECT COUNT(SR_number) FROM attendance WHERE A_date = '{$currentDate}' AND SR_number IN (SELECT SR_number FROM classlist WHERE F_number = '{$_SESSION['F_number']}' AND acadYear = '{$currentSchoolYear}' )");
                                                                                $AttendanceCountToday = $getAttendanceCountToday->fetch_assoc();

                                                                                echo $AttendanceCountToday['COUNT(SR_number)'];
                                                                                ?>
                                                                            </h1>
                                                                        </div>
                                                                        <h3 class="d-flex flex-shrink-0 align-items-center justify-content-center" style="font-size: 20px; padding-top: 10px; text-align:center;">Attendance Taken Today</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding: 20px 0px 0px 15px;">
                                                        <div class="col-lg-6 col-sm-12 grid-margin" style="padding-right: 0px;">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                                                            <h3 class="mb-0" style="text-align:left;">Reminders posted by you</h3>
                                                                        </div>
                                                                        <?php
                                                                        $getPostedReminders = $mysqli->query("SELECT * FROM reminders WHERE author = '{$_SESSION['F_number']}'AND acadYear = '{$currentSchoolYear}'  ORDER BY date_posted DESC LIMIT 5");
                                                                        if (mysqli_num_rows($getPostedReminders) > 0) {
                                                                            while ($remindersData = $getPostedReminders->fetch_assoc()) { ?>
                                                                                <div class="col-12" style="padding-bottom: 15px;">
                                                                                    <div class="single-post bg-light">
                                                                                        <div class="col-lg-12  col-md-12 meta-details">
                                                                                            <div class="user-details row" style="padding: 10px 0px 0px 10px;">
                                                                                                <p class="user-name col-lg-6 col-md-6">
                                                                                                    <span class="far fa-user" style="color: #c02628;"></span>
                                                                                                    <?php
                                                                                                    if (!empty($getFacultyData['F_mname']) || $getFacultyData['F_mname'] != "" && empty($getFacultyData['F_suffix']) || $getFacultyData['F_suffix'] = "") {
                                                                                                        echo $getFacultyData['F_lname'] .  ", " . $getFacultyData['F_fname'] . " " . substr($getFacultyData['F_mname'], 0, 1) . ".";
                                                                                                    } else if (empty($getFacultyData['F_mname']) || $getFacultyData['F_mname'] = "" && !empty($getFacultyData['F_suffix']) || $getFacultyData['F_suffix'] != "") {
                                                                                                        echo $getFacultyData['F_lname'] .  ", " . $getFacultyData['F_fname'] . " " . $getFacultyData['F_suffix'];
                                                                                                    } else if (empty($getFacultyData['F_mname']) || $getFacultyData['F_mname'] = "" && empty($getFacultyData['F_suffix']) || $getFacultyData['F_suffix'] = "") {
                                                                                                        echo $getFacultyData['F_lname'] .  ", " . $getFacultyData['F_fname'];
                                                                                                    }
                                                                                                    ?>
                                                                                                </p>
                                                                                                <p class="user-name col-lg-6 col-md-6">
                                                                                                    <span class="fa fa-calendar" style="color: #c02628;"></span>
                                                                                                    <?php echo $remindersData['date_posted'] ?>
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12 col-sm-12" style="padding: 0px 10px 10px 10px;">
                                                                                            <a class="posts-title" href="viewReminders.php?ID=<?php echo $remindersData['reminderID'] ?>" style="text-align: left;">
                                                                                                <h6>Subject: <?php echo $remindersData['subject'] ?></h6>
                                                                                            </a>
                                                                                            <p class="excert text-truncate">
                                                                                                <?php echo $remindersData['msg'] ?>
                                                                                            </p>
                                                                                            <a href="viewReminders.php?ID=<?php echo $remindersData['reminderID'] ?>" class="primary-btn">View More</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?php
                                                                            } ?>
                                                                            <div style="text-align: center;">
                                                                                <a href="../faculty/reminders.php" class="btn btn-primary text-uppercase" style="width: auto; color:#fff;">View More Reminders</a>
                                                                            </div>
                                                                        <?php
                                                                        } else { ?>
                                                                            <div class="col-12" style="padding-bottom: 15px;">
                                                                                <div class="single-post bg-light">
                                                                                    <div class="col-lg-12 col-sm-12" style="padding: 0px 10px 10px 10px;">
                                                                                        <div style="text-align: center;">
                                                                                            <img src="../assets/img/mailbox.png" style="width: 100px; height: 80px;" style="text-align:center;">
                                                                                            <p style="text-align: justify;">There are currently no reminders posted. If you wish to create one, please go to the <span><a href="../faculty/reminders.php">reminders</a></span> page. Thank you.</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12 grid-margin" style="padding-right: 0px;">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                                                        <h3 class="mb-0" style="text-align:left;">School Announcements</h3>
                                                                    </div>
                                                                    <?php
                                                                    $getAnnouncementData = $mysqli->query("SELECT * FROM announcement WHERE acadYear = '{$currentSchoolYear}' ORDER BY date_posted DESC LIMIT 3");
                                                                    if (mysqli_num_rows($getAnnouncementData) > 0) {
                                                                        while ($announcement = $getAnnouncementData->fetch_assoc()) { ?>
                                                                            <div class="col-lg-12 wow " style="padding-bottom: 5px;">
                                                                                <div class="blog-item bg-light rounded overflow-hidden">
                                                                                    <div class="p-4">
                                                                                        <div class="d-flex mb-3">
                                                                                            <small class="me-3"><i class="far fa-user text-primary me-2"></i>
                                                                                                <?php
                                                                                                $getAuthorInfo = $mysqli->query("SELECT * FROM admin_accounts WHERE AD_number = '{$announcement['author']}'");
                                                                                                $AuthorInfo = $getAuthorInfo->fetch_assoc();
                                                                                                echo $AuthorInfo['AD_name']
                                                                                                ?>
                                                                                            </small>
                                                                                            <small><i class="far fa-calendar-alt text-primary me-2"></i><?php echo $announcement['date']; ?></small>
                                                                                        </div>
                                                                                        <h4 class="mb-3" style="text-align: left;"><?php echo $announcement['header']; ?></h4>
                                                                                        <p class="text-truncate"><?php echo $announcement['msg']; ?></p>
                                                                                        <a class="text-uppercase" href="viewAnnouncement.php?ID=<?php echo $announcement['ANC_ID']; ?>">Read More <i class="bi bi-arrow-right"></i></a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <section class="popular-courses-area courses-page">
                                                                            <div style="text-align: center;">
                                                                                <a href="../faculty/announcement.php" class="btn btn-primary text-uppercase" style="width: auto; color:#fff;">View More Announcements</a>
                                                                            </div>
                                                                        </section>
                                                                    <?php } else { ?>
                                                                        <div class="col-lg-12 wow " style="padding-bottom: 5px;">
                                                                            <div class="blog-item bg-light rounded overflow-hidden">
                                                                                <div class="p-4 text-center">
                                                                                    <img src="../assets/img/announcement.png" style="width: 90px; height: 60px;" style="text-align:center;">
                                                                                    <p style="text-align: justify;">At the moment, there are no announcements posted. They will appear here if there are any. Thank you.</p>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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



    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/admin/vendor.bundle.base.js"></script>
    <script src="../assets/js/admin/off-canvas.js"></script>
    <script src="../assets/js/admin/file-upload.js"></script>

</body>

</html>