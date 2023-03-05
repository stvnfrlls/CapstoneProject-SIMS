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
    <title>Student - Report Card</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <div class="container-fluid">
        <div class="">
            <div class="">
                <div class="row">
                    <div class="col-sm-12 col-lg-10 m-auto">
                        <div class="home-tab">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <div class="section-title text-center position-relative pb-3 mb-3 mx-auto">
                                    <h2 class="fw-bold text-primary text-uppercase" style="padding-top: 40px;">Daily Reports</h2>
                                </div>
                            </div>
                            <div class="container-xl px-4 mt-4" style="padding-bottom:0px">
                                <nav class="nav">
                                    <a class="nav-link" href="../student/dailyAttendance.php" target="__blank">Daily</a>
                                    <a class="nav-link active ms-0" href="../student/monthlyAttendance.php" target="__blank" style="color: #c02628;">Monthly</a>
                                </nav>
                                <div class="border-bottom"></div>
                            </div>
                            <div class="tab-content tab-content-basic">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">

                                    <div class="row">
                                        <div class="col-12 grid-margin">
                                            <form class="form-sample">
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
                                            </form>
                                        </div>
                                    </div>

                                    <div class="btn-group" style="margin: auto;">
                                        <a href="../reports/MonthlyAttendance.php?ID=<?php echo $_SESSION['SR_number'] ?>" class="btn btn-light" style="border-color: #e4e3e3; background-color:#e4e3e3;">Print <i class="fa fa-print" style="font-size: 12px;"></i></a>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-12 d-flex flex-column">
                                            <div class="row flex-grow">
                                                <div class="col-12 grid-margin">
                                                    <div class="">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Month</th>
                                                                        <th>No. of School Days</th>
                                                                        <th>No. of Days Present</th>
                                                                        <th>No. of Days Absent</th>
                                                                        <th>No. of Days Late</th>
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
                                                                    <tr>
                                                                        <?php
                                                                        echo '<td class="tabledata">January</td>';

                                                                        $JAN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'January' AND acadYear = '{$currentSchoolYear}'");
                                                                        $JANvalue = $JAN->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $JANvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $LATE_JAN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'January' AND A_status = 'LATE' AND acadYear = '{$currentSchoolYear}'");
                                                                        $LATE_JANvalue = $LATE_JAN->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $LATE_JANvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $ABSENT_JAN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'January' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                                                        $ABSENT_JANvalue = $ABSENT_JAN->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $ABSENT_JANvalue['COUNT(A_time_IN)'] . '</td>';
                                                                        ?>
                                                                    </tr>

                                                                    <tr>
                                                                        <?php
                                                                        echo '<td class="tabledata">February</td>';

                                                                        $FEB = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'February' AND acadYear = '{$currentSchoolYear}'");
                                                                        $FEBvalue = $FEB->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $FEBvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $LATE_FEB = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'February' AND A_status = 'LATE' AND acadYear = '{$currentSchoolYear}'");
                                                                        $LATE_FEBvalue = $LATE_FEB->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $LATE_FEBvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $ABSENT_FEB = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'February' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                                                        $ABSENT_FEBvalue = $ABSENT_FEB->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $ABSENT_FEBvalue['COUNT(A_time_IN)'] . '</td>';
                                                                        ?>
                                                                    </tr>

                                                                    <tr>
                                                                        <?php
                                                                        echo '<td class="tabledata">March</td>';

                                                                        $MAR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'March' AND acadYear = '{$currentSchoolYear}'");
                                                                        $MARvalue = $MAR->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $MARvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $LATE_MAR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'March' AND A_status = 'LATE' AND acadYear = '{$currentSchoolYear}'");
                                                                        $LATE_MARvalue = $LATE_MAR->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $LATE_MARvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $ABSENT_MAR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'March' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                                                        $ABSENT_MARvalue = $ABSENT_MAR->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $ABSENT_MARvalue['COUNT(A_time_IN)'] . '</td>';
                                                                        ?>
                                                                    </tr>

                                                                    <tr>
                                                                        <?php
                                                                        echo '<td class="tabledata">April</td>';

                                                                        $APR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'April' AND acadYear = '{$currentSchoolYear}'");
                                                                        $APRvalue = $APR->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $APRvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $LATE_APR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'April' AND A_status = 'LATE' AND acadYear = '{$currentSchoolYear}'");
                                                                        $LATE_APRvalue = $LATE_APR->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $LATE_APRvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $ABSENT_APR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'April' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                                                        $ABSENT_APRvalue = $ABSENT_APR->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $ABSENT_APRvalue['COUNT(A_time_IN)'] . '</td>';
                                                                        ?>
                                                                    </tr>

                                                                    <tr>
                                                                        <?php
                                                                        echo '<td class="tabledata">May</td>';

                                                                        $MAY = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'May' AND acadYear = '{$currentSchoolYear}'");
                                                                        $MAYvalue = $MAY->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $MAYvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $LATE_MAY = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'May' AND A_status = 'LATE' AND acadYear = '{$currentSchoolYear}'");
                                                                        $LATE_MAYvalue = $LATE_MAY->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $LATE_JANvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $ABSENT_MAY = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'May' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                                                        $ABSENT_MAYvalue = $ABSENT_MAY->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $ABSENT_MAYvalue['COUNT(A_time_IN)'] . '</td>';
                                                                        ?>
                                                                    </tr>

                                                                    <tr>
                                                                        <?php
                                                                        echo '<td class="tabledata">June</td>';

                                                                        $JUN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'June' AND acadYear = '{$currentSchoolYear}'");
                                                                        $JUNvalue = $JUN->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $JUNvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $LATE_JUN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'June' AND A_status = 'LATE' AND acadYear = '{$currentSchoolYear}'");
                                                                        $LATE_JUNvalue = $LATE_JUN->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $LATE_JUNvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $ABSENT_JUN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'June' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                                                        $ABSENT_JUNvalue = $ABSENT_JUN->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $ABSENT_JUNvalue['COUNT(A_time_IN)'] . '</td>';
                                                                        ?>
                                                                    </tr>

                                                                    <tr>
                                                                        <?php
                                                                        echo '<td class="tabledata">July</td>';

                                                                        $JUL = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'July' AND acadYear = '{$currentSchoolYear}'");
                                                                        $JULvalue = $JUL->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $JULvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $LATE_JUL = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'July' AND A_status = 'LATE' AND acadYear = '{$currentSchoolYear}'");
                                                                        $LATE_JULvalue = $LATE_JUL->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $LATE_JULvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $ABSENT_JUL = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'July' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                                                        $ABSENT_JULvalue = $ABSENT_JUL->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $ABSENT_JULvalue['COUNT(A_time_IN)'] . '</td>';
                                                                        ?>
                                                                    </tr>

                                                                    <tr>
                                                                        <?php
                                                                        echo '<td class="tabledata">August</td>';

                                                                        $AUG = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'August' AND acadYear = '{$currentSchoolYear}'");
                                                                        $AUGvalue = $AUG->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $AUGvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $LATE_AUG = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'August' AND A_status = 'LATE' AND acadYear = '{$currentSchoolYear}'");
                                                                        $LATE_AUGvalue = $LATE_AUG->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $LATE_JANvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $ABSENT_AUG = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'August' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                                                        $ABSENT_AUGvalue = $ABSENT_AUG->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $ABSENT_AUGvalue['COUNT(A_time_IN)'] . '</td>';
                                                                        ?>
                                                                    </tr>

                                                                    <tr>
                                                                        <?php
                                                                        echo '<td class="tabledata">September</td>';

                                                                        $SEP = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'September' AND acadYear = '{$currentSchoolYear}'");
                                                                        $SEPvalue = $SEP->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $SEPvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $LATE_SEP = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'September' AND A_status = 'LATE' AND acadYear = '{$currentSchoolYear}'");
                                                                        $LATE_SEPvalue = $LATE_SEP->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $LATE_SEPvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $ABSENT_SEP = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'September' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                                                        $ABSENT_SEPvalue = $ABSENT_SEP->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $ABSENT_SEPvalue['COUNT(A_time_IN)'] . '</td>';
                                                                        ?>
                                                                    </tr>

                                                                    <tr>
                                                                        <?php
                                                                        echo '<td class="tabledata">October</td>';

                                                                        $OCT = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'October' AND acadYear = '{$currentSchoolYear}'");
                                                                        $OCTvalue = $OCT->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $OCTvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $LATE_OCT = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'October' AND A_status = 'LATE' AND acadYear = '{$currentSchoolYear}'");
                                                                        $LATE_OCTvalue = $LATE_OCT->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $LATE_OCTvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $ABSENT_OCT = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'October' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                                                        $ABSENT_OCTvalue = $ABSENT_OCT->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $ABSENT_OCTvalue['COUNT(A_time_IN)'] . '</td>';
                                                                        ?>
                                                                    </tr>

                                                                    <tr>
                                                                        <?php
                                                                        echo '<td class="tabledata">November</td>';

                                                                        $NOV = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'November' AND acadYear = '{$currentSchoolYear}'");
                                                                        $NOVvalue = $NOV->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $NOVvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $LATE_NOV = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'November' AND A_status = 'LATE' AND acadYear = '{$currentSchoolYear}'");
                                                                        $LATE_NOVvalue = $LATE_NOV->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $LATE_NOVvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $ABSENT_NOV = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'November' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                                                        $ABSENT_NOVvalue = $ABSENT_NOV->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $ABSENT_NOVvalue['COUNT(A_time_IN)'] . '</td>';
                                                                        ?>
                                                                    </tr>

                                                                    <tr>
                                                                        <?php
                                                                        echo '<td class="tabledata">December</td>';

                                                                        $DEC = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'December' AND acadYear = '{$currentSchoolYear}'");
                                                                        $DECvalue = $DEC->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $DECvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $LATE_DEC = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'December' AND A_status = 'LATE' AND acadYear = '{$currentSchoolYear}'");
                                                                        $LATE_DECvalue = $LATE_DEC->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $LATE_DECvalue['COUNT(A_time_IN)'] . '</td>';

                                                                        $ABSENT_DEC = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'December' AND A_status = 'ABSENT' AND acadYear = '{$currentSchoolYear}'");
                                                                        $ABSENT_DECvalue = $ABSENT_DEC->fetch_assoc();
                                                                        echo '<td class="tabledata">' . $ABSENT_DECvalue['COUNT(A_time_IN)'] . '</td>';
                                                                        ?>
                                                                    </tr>
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