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
    <title>Advisory Concern</title>
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

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="../assets/css/sweetAlert.css" rel="stylesheet">

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
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <div class="section-title text-center position-relative pb-3 mb-3 mx-auto">
                                        <h2 class="fw-bold text-primary text-uppercase">Advisory Concerns</h2>
                                        <p>DATE: <?php echo date('D M-d-Y') ?></p>
                                    </div>
                                </div>
                                <div class="tab-content tab-content-basic" style="padding-bottom: 0px;">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="col-12 grid-margin">
                                            <div class="row">
                                                <div class="col-lg-8 col-sm-12 grid-margin">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="btn-group" style="margin-bottom: 15px;">
                                                                <div>
                                                                    <a href="advisoryAttendance.php" class="btn btn-secondary" style="background-color: #e4e3e3; margin-right: 0px;">
                                                                        Go back
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <h4 style="text-align: center">Attendance Concern</h4>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>No.</th>
                                                                            <th>Name</th>
                                                                            <th>Subject Name</th>
                                                                            <th>Date and Time</th>
                                                                            <th>Reported As</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $rowCount = 1;
                                                                        $getAdvisoryClassData = $mysqli->query("SELECT SR_number, SR_grade, SR_section FROM classlist 
                                                                                                                WHERE F_number = '{$_SESSION['F_number']}' 
                                                                                                                AND acadYear = '{$currentSchoolYear}'");
                                                                        $advisoryClass = $getAdvisoryClassData->fetch_assoc();
                                                                        $getAttendanceConcern = $mysqli->query("SELECT * FROM attendance_student_report 
                                                                                                                WHERE SR_section = '{$advisoryClass['SR_section']}' 
                                                                                                                ORDER BY RP_reportDate DESC");
                                                                        if (mysqli_num_rows($getAttendanceConcern) > 0) {
                                                                            while ($AttendanceConcern = $getAttendanceConcern->fetch_assoc()) { ?>
                                                                                <tr>
                                                                                    <td><?php echo $rowCount; ?></td>
                                                                                    <td><?php echo $AttendanceConcern['SR_number']; ?></td>
                                                                                    <td><?php echo $AttendanceConcern['subjectName']; ?></td>
                                                                                    <td><?php echo $AttendanceConcern['RP_reportDate'] . ' - ' . $AttendanceConcern['RP_reportTime']; ?></td>
                                                                                    <td><?php echo $AttendanceConcern['RP_attendanceReport']; ?></td>
                                                                                </tr>
                                                                            <?php
                                                                                $rowCount++;
                                                                            }
                                                                        } else { ?>
                                                                            <tr>
                                                                                <td colspan="5" class="text-center">Reported students yet</td>
                                                                            </tr>
                                                                        <?php }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-sm-12 grid-margin">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <form class="form-sample" action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                                                                <h4 style="text-align: center">Resolve Issue</h4>
                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-md-12">
                                                                        <label class="col-sm-12 col-form-label">Student Name</label>
                                                                        <div class="col-sm-12">
                                                                            <select class="form-select" name="SR_number" required>
                                                                                <option value="">1</option>
                                                                                <option value="">2</option>
                                                                                <option value="">3</option>
                                                                                <option value="">4</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-md-12">
                                                                        <label class="col-sm-12 col-form-label">Report Date</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="date" class="form-control" name="A_date" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-md-12">
                                                                        <label class="col-sm-12 col-form-label">Student Name</label>
                                                                        <div class="col-sm-12">
                                                                            <select class="form-select" name="A_status" required>
                                                                                <option selected></option>
                                                                                <option value="LATE">Late</option>
                                                                                <option value="ABSENT">Absent</option>
                                                                                <option value="EXCUSED">Excused</option>
                                                                                <option value="CUTTING">Skip Class</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div style="text-align: center;">
                                                                    <button type="submit" name="resolveIssue" class="btn btn-primary me-2">Resolve</button>
                                                                </div>
                                                            </form>
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

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <!-- Template Javascript -->
    <!-- <script src="../assets/login/vendor/jquery/jquery-3.2.1.min.js"></script> -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/admin/vendor.bundle.base.js"></script>
    <script src="../assets/js/admin/off-canvas.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <script>
        function sweetalert() {
            Swal.fire({
                text: 'No advisory class assigned',
                icon: 'error',
                confirmButtonText: 'OK',
            }).then((result) => {
                window.location.replace("./dashboard.php");
            })
        }
    </script>
    <?php
    $checkAdvisoryPermission = $mysqli->query("SELECT * FROM sections WHERE S_adviser = '{$_SESSION['F_number']}'");
    if (mysqli_num_rows($checkAdvisoryPermission) == 0) {
        echo '<script>sweetalert();</script>';
    }
    ?>
</body>

</html>