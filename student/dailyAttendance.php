<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['SR_number'])) {
    header('Location: ../auth/login.php');
} else {
    $getStudentInformation = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$_SESSION['SR_number']}'");
    $student = $getStudentInformation->fetch_assoc();
    $getSectionInformation = $mysqli->query("SELECT * FROM sections WHERE S_name = '{$student['SR_section']}' AND acadYear = '{$currentSchoolYear}'");
    $section = $getSectionInformation->fetch_assoc();

    if (!empty($section['S_adviser'])) {
        $getfacultyInformation = $mysqli->query("SELECT * FROM faculty WHERE F_number = '{$section['S_adviser']}'");
        $faculty = $getfacultyInformation->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Daily Attendance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link href="../assets/css/dashboard-user.css" rel="stylesheet">
    <link href="../assets/css/admin/style.css" rel="stylesheet">

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
                <a href="../about.php" class="nav-item nav-link" style="color: white; font-size: 14px;">About Us</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link" data-bs-toggle="dropdown" style="color: white; font-size: 14px;">Menu <i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-menu bg-dark border-0 m-0">
                        <a href="../student/dashboard.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Dashboard</a>
                        <a href="../student/profile.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Profile</a>
                        <a href="../student/grades.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Report Card</a>
                        <a href="../student/dailyAttendance.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Attendance</a>
                        <a href="../student/reminders.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Reminders</a>
                        <a href="../student/announcement.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">School Announcements</a>
                        <a href="../auth/logout.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Logout</a>
                    </div>
                </div>
                <a href="../faculty.php" class="nav-item nav-link" style="color: white; font-size: 14px;">Faculty Directory</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <div class="container-fluid">
        <div class="">
            <div class="">
                <div class="row">
                    <div class="col-sm-12 col-lg-10 m-auto">
                        <div class="home-tab" style="margin-top: 0px !important;">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <div class="section-title text-center position-relative pb-3 mb-3 mx-auto">
                                    <h2 class="fw-bold text-primary text-uppercase" style="padding-top: 40px;">Daily Attendance</h2>
                                </div>
                            </div>
                            <div class="container-xl px-4 mt-4" style="padding-bottom:0px">
                                <nav class="nav">
                                    <a class="nav-link active ms-0" href="dailyAttendance.php" style="color: #c02628;">Daily</a>
                                    <a class="nav-link" href="monthlyAttendance.php">Monthly</a>
                                </nav>
                                <div class="border-bottom"></div>
                            </div>
                            <div class="tab-content tab-content-basic">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">

                                    <div class="row">
                                        <div class="col-12 grid-margin">
                                            <div class="col-12 grid-margin">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="col-sm-12 col-form-label">Name</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" value="<?php echo  $student['SR_lname'] .  ", " . $student['SR_fname'] . " " . substr($student['SR_mname'], 0, 1) . ". " . $student['SR_suffix'];  ?>" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="col-sm-12 col-form-label">Grade and Section</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" value="<?php echo "Grade " . $student['SR_grade'] . " - " . $student['SR_section'] ?>" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="col-sm-12 col-form-label">School Year</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" value="<?php echo "S.Y. " . $currentSchoolYear ?>" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="col-sm-12 col-form-label">Adviser</label>
                                                        <div class="col-sm-12">
                                                            <?php
                                                            if (!empty($section['S_adviser'])) { ?>
                                                                <input type="text" class="form-control" value="<?php echo $faculty['F_lname'] .  ", " . $faculty['F_fname'] . " " . substr($faculty['F_mname'], 0, 1) . ". " . $faculty['F_suffix']; ?>" readonly />
                                                            <?php } else { ?>
                                                                <input type="text" class="form-control" value="Teacher not yet Assigned" readonly />
                                                            <?php }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="btn-group">
                                        <div>
                                            <button class="btn btn-secondary" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color: #e4e3e3;">
                                                <?php
                                                if (isset($_GET['month'])) {
                                                    echo $_GET['month'];
                                                } else {
                                                    echo "Month";
                                                }
                                                ?>
                                                <i class="fa fa-caret-down"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                <a class="dropdown-item" href="dailyAttendance.php">All</a>
                                                <a class="dropdown-item" href="dailyAttendance.php?month=January">January</a>
                                                <a class="dropdown-item" href="dailyAttendance.php?month=February">February</a>
                                                <a class="dropdown-item" href="dailyAttendance.php?month=March">March</a>
                                                <a class="dropdown-item" href="dailyAttendance.php?month=April">April</a>
                                                <a class="dropdown-item" href="dailyAttendance.php?month=May">May</a>
                                                <a class="dropdown-item" href="dailyAttendance.php?month=June">June</a>
                                                <a class="dropdown-item" href="dailyAttendance.php?month=July">July</a>
                                                <a class="dropdown-item" href="dailyAttendance.php?month=August">August</a>
                                                <a class="dropdown-item" href="dailyAttendance.php?month=September">September</a>
                                                <a class="dropdown-item" href="dailyAttendance.php?month=October">October</a>
                                                <a class="dropdown-item" href="dailyAttendance.php?month=November">November</a>
                                                <a class="dropdown-item" href="dailyAttendance.php?month=December">December</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-group" style="margin: auto;">
                                        <?php
                                        if (isset($_GET['month'])) {
                                            echo '<a href="../reports/PDFAttendance.php?month=' . $_GET['month'] . '&ID=' . $_SESSION['SR_number'] . '" class="btn btn-light" style="border-color: #e4e3e3; background-color:#e4e3e3;">Download <i class="fa fa-download" style="font-size: 12px;"></i></a>';
                                        } else {
                                            echo '<a href="../reports/PDFAttendance.php?ID=' . $_SESSION['SR_number'] . '" class="btn btn-light" style="border-color: #e4e3e3; background-color:#e4e3e3;">Download <i class="fa fa-download" style="font-size: 12px;"></i></a>';
                                        }
                                        ?>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-12 d-flex flex-column">
                                            <div class="row flex-grow">
                                                <div class="col-12 grid-margin">
                                                    <div class="card">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No.</th>
                                                                        <th>Date</th>
                                                                        <th>Time In</th>
                                                                        <th>Time Out</th>
                                                                        <th>Remarks</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <style>
                                                                        input[type='number'] {
                                                                            width: 50px;
                                                                        }

                                                                        /* Chrome, Safari, Edge, Opera */
                                                                        input::-webkit-outer-spin-button,
                                                                        input::-webkit-inner-spin-button {
                                                                            -webkit-appearance: none;
                                                                            margin: 0;
                                                                        }

                                                                        .tabledata {
                                                                            border: 1px solid #ffffff;
                                                                            text-align: center;
                                                                            vertical-align: middle;
                                                                            height: 30px;
                                                                            color: #000000;
                                                                        }
                                                                    </style>
                                                                    <?php
                                                                    $rowCount = 1;
                                                                    if (isset($_GET['month'])) {
                                                                        $getAttendanceInformation = $mysqli->query("SELECT * FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = '{$_GET['month']}' AND acadYear = '{$currentSchoolYear}'");
                                                                    } else {
                                                                        $getAttendanceInformation = $mysqli->query("SELECT * FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND acadYear = '{$currentSchoolYear}' ORDER BY A_date DESC");
                                                                    }
                                                                    $attendanceCount = $getAttendanceInformation->num_rows;
                                                                    if ($attendanceCount == 0) { ?>
                                                                        <tr>
                                                                            <td class="tabledata" colspan="10">No recorded attendance</td>
                                                                        </tr>
                                                                        <?php
                                                                    } else {
                                                                        while ($attendance = $getAttendanceInformation->fetch_assoc()) { ?>
                                                                            <tr>
                                                                                <td class="tabledata"><?php echo $rowCount; ?></td>
                                                                                <td class="tabledata">
                                                                                    <?php echo date('(D) m-d-Y', strtotime($attendance['A_date'])) ?>
                                                                                </td>
                                                                                <td class="tabledata">
                                                                                    <?php
                                                                                    if (isset($attendance['A_time_IN']) || $attendance['A_time_IN'] != '') {
                                                                                        echo date('h:i A', strtotime($attendance['A_time_IN']));
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                                <td class="tabledata">
                                                                                    <?php
                                                                                    if (isset($attendance['A_time_OUT']) || $attendance['A_time_OUT'] != '') {
                                                                                        echo date('h:i A', strtotime($attendance['A_time_OUT']));
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                                <td class="tabledata"><?php echo $attendance['A_status']; ?></td>
                                                                            </tr>
                                                                    <?php $rowCount++;
                                                                        }
                                                                    }
                                                                    ?>
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
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
    </div>

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
    <script src="../assets/js/main.js"></script>

</body>

</html>