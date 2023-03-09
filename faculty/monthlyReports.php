<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
    header('Location: ../auth/login.php');
} else {
    $gradeList = "SELECT DISTINCT S_yearLevel FROM sections WHERE acadYear = '{$currentSchoolYear}'";
    $rungradeList = $mysqli->query($gradeList);

    if (isset($_GET['Grade'])) {
        $sectionList = "SELECT DISTINCT(S_name) FROM sections WHERE S_yearLevel = '{$_GET['Grade']}' AND acadYear = '{$currentSchoolYear}'";
        $runsectionList = $mysqli->query($sectionList);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Monthly Attendance</title>
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
    <link href="../assets/css/admin/style.css" rel="stylesheet">
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
                                <div class="d-sm-flex align-items-center justify-content-between">
                                    <div class="section-title text-center position-relative pb-3 mb-3 mx-auto">
                                        <h2 class="fw-bold text-primary text-uppercase">Monthly Attendance</h2>
                                    </div>
                                </div>
                                <div class="container-xl px-4 mt-4" style="padding-bottom:0px">
                                    <nav class="nav">
                                        <a class="nav-link" href="dailyReports.php">Daily</a>
                                        <a class="nav-link active ms-0" href="monthlyReports.php" style="color: #c02628;">Monthly</a>
                                        <a class="nav-link" href="attendance.php">Attendance Report</a>
                                    </nav>
                                    <div class="border-bottom"></div>
                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <div class="col-12 grid-margin">
                                                <form class="form-sample">
                                                    <div class="btn-group">
                                                        <div>
                                                            <button class="btn btn-secondary" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color: #e4e3e3;">
                                                                <?php if (isset($_GET['month'])) {
                                                                    echo $_GET['month'];
                                                                } else {
                                                                    echo "Month";
                                                                }
                                                                ?>
                                                                <i class="fa fa-caret-down"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                                <a class="dropdown-item" href="monthlyReports.php?month=January">January</a>
                                                                <a class="dropdown-item" href="monthlyReports.php?month=February">February</a>
                                                                <a class="dropdown-item" href="monthlyReports.php?month=March">March</a>
                                                                <a class="dropdown-item" href="monthlyReports.php?month=April">April</a>
                                                                <a class="dropdown-item" href="monthlyReports.php?month=May">May</a>
                                                                <a class="dropdown-item" href="monthlyReports.php?month=June">June</a>
                                                                <a class="dropdown-item" href="monthlyReports.php?month=July">July</a>
                                                                <a class="dropdown-item" href="monthlyReports.php?month=August">August</a>
                                                                <a class="dropdown-item" href="monthlyReports.php?month=September">September</a>
                                                                <a class="dropdown-item" href="monthlyReports.php?month=October">October</a>
                                                                <a class="dropdown-item" href="monthlyReports.php?month=November">November</a>
                                                                <a class="dropdown-item" href="monthlyReports.php?month=December">December</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    if (isset($_GET['month'])) { ?>
                                                        <div class="btn-group">
                                                            <div>
                                                                <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color: #e4e3e3;">
                                                                    <?php
                                                                    if (isset($_GET['Grade'])) {
                                                                        if ($_GET['Grade'] == "KINDER") {
                                                                            echo  $_GET['Grade'];
                                                                        } else {
                                                                            echo  "Grade " . $_GET['Grade'];
                                                                        }
                                                                    } else {
                                                                        echo "Grade ";
                                                                    }
                                                                    ?>
                                                                    <i class="fa fa-caret-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                    <?php
                                                                    while ($gradeData = $rungradeList->fetch_assoc()) { ?>
                                                                        <a class="dropdown-item" href="monthlyReports.php?month=<?php echo $_GET['month'] ?>&Grade=<?php echo $gradeData['S_yearLevel'] ?>">
                                                                            <?php
                                                                            echo "Grade " . $gradeData['S_yearLevel'];
                                                                            ?>
                                                                        </a>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php }
                                                    ?>
                                                    <div class="btn-group">
                                                        <?php
                                                        if (isset($_GET['Grade'])) { ?>
                                                            <div>
                                                                <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color: #e4e3e3;">
                                                                    <?php if (isset($_GET['Section'])) {
                                                                        echo $_GET['Section'];
                                                                    } else {
                                                                        echo "Section";
                                                                    }
                                                                    ?>
                                                                    <i class="fa fa-caret-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                    <?php
                                                                    while ($sectionData = $runsectionList->fetch_assoc()) { ?>
                                                                        <a class="dropdown-item" href="monthlyReports.php?month=<?php echo $_GET['month'] ?>&Grade=<?php echo $_GET['Grade'] . "&Section=" . $sectionData['S_name']; ?>">
                                                                            <?php
                                                                            echo $sectionData['S_name'];
                                                                            ?>
                                                                        </a>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <?php
                                                    if (isset($_GET['month']) && isset($_GET['Grade']) && isset($_GET['Section'])) { ?>
                                                        <div class="btn-group" style="float: right;">
                                                            <a href="../reports/MonthlyAttendancebyClass.php?month=<?php echo $_GET['month'] ?>&Grade=<?php echo $_GET['Grade'] ?>&Section=<?php echo $_GET['Section'] ?>" style="background-color: #e4e3e3; margin-right: 0px;" class="btn btn-secondary">Print <i class="fa fa-print" style="font-size: 12px; align-self:center;"></i></a>
                                                        </div>
                                                    <?php }
                                                    ?>
                                                </form>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-12 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12 grid-margind">
                                                        <div class="">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Student Name</th>
                                                                            <th>No. of School Days</th>
                                                                            <th>No. of Days Present</th>
                                                                            <th>No. of Days Absent</th>
                                                                            <th>No. of Days Tardy</th>
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
                                                                        $dateNow = date("Y-m-d");
                                                                        if (isset($_GET['month']) && isset($_GET['Grade']) && isset($_GET['Section'])) {
                                                                            $getMonthlyAttendanceData = $mysqli->query("SELECT DISTINCT SR_lname, SR_fname, SR_mname, SR_suffix, attendance.SR_number 
                                                                            FROM attendance 
                                                                            LEFT JOIN studentrecord ON attendance.SR_number = studentrecord.SR_number 
                                                                            WHERE acadYear = '{$currentSchoolYear}' 
                                                                            AND SR_section = '{$_GET['Section']}' 
                                                                            AND SR_grade = '{$_GET['Grade']}'
                                                                            AND MONTHNAME(A_date) = '{$_GET['month']}'");
                                                                            if (mysqli_num_rows($getMonthlyAttendanceData) > 0) {
                                                                                while ($AttendanceData = $getMonthlyAttendanceData->fetch_assoc()) { ?>
                                                                                    <tr>
                                                                                        <td class="tabledata"><?php echo $AttendanceData['SR_lname'] .  ", " . $AttendanceData['SR_fname'] . " " . substr($AttendanceData['SR_mname'], 0, 1) . ". " . $AttendanceData['SR_suffix']; ?></td>
                                                                                        <td class="tabledata">
                                                                                            <?php
                                                                                            $month = date_parse($_GET['month'])['month'];
                                                                                            $year = date("Y");

                                                                                            $first_day = new DateTime("$year-$month-01");
                                                                                            $num_days = $first_day->format('t');
                                                                                            $count_weekdays = 0;
                                                                                            for ($day = 1; $day <= $num_days; $day++) {
                                                                                                $date = new DateTime("$year-$month-$day");
                                                                                                if ($date->format('N') <= 5) {
                                                                                                    $count_weekdays++;
                                                                                                }
                                                                                            }
                                                                                            echo $count_weekdays;
                                                                                            ?>
                                                                                        </td>
                                                                                        <td class="tabledata">
                                                                                            <?php
                                                                                            $PRESENT = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$AttendanceData['SR_number']}' AND MONTHNAME(A_date) = '{$_GET['month']}' AND acadYear = '{$currentSchoolYear}'");
                                                                                            $PRESENTvalue = $PRESENT->fetch_assoc();

                                                                                            echo $PRESENTvalue['COUNT(A_time_IN)'];
                                                                                            ?>
                                                                                        </td>
                                                                                        <td class="tabledata">
                                                                                            <?php
                                                                                            $ABSENT = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$AttendanceData['SR_number']}' AND MONTHNAME(A_date) = '{$_GET['month']}' AND acadYear = '{$currentSchoolYear}' AND A_status = 'ABSENT'");
                                                                                            $ABSENTvalue = $ABSENT->fetch_assoc();

                                                                                            echo $ABSENTvalue['COUNT(A_time_IN)'];
                                                                                            ?>
                                                                                        </td>
                                                                                        <td class="tabledata">
                                                                                            <?php
                                                                                            $TARDY = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$AttendanceData['SR_number']}' AND MONTHNAME(A_date) = '{$_GET['month']}' AND acadYear = '{$currentSchoolYear}' AND A_status = 'TARDY'");
                                                                                            $TARDYvalue = $TARDY->fetch_assoc();

                                                                                            echo $TARDYvalue['COUNT(A_time_IN)'];
                                                                                            ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php }
                                                                            } else { ?>
                                                                                <tr>
                                                                                    <td colspan="6" class="tabledata">NO ATTENDANCE TODAY <?php echo $dateNow ?></td>
                                                                                </tr>
                                                                            <?php }
                                                                        } else { ?>
                                                                            <tr>
                                                                                <td colspan="6" class="tabledata">Select grade level and section first</td>
                                                                            </tr>
                                                                        <?php }
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
</body>

</html>