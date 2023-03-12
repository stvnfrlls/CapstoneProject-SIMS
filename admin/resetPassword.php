<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['AD_number'])) {
    header('Location: ../auth/login.php');
} else {
    if ($_SESSION['AD_number'] != "5UP3R4DM1N") {
        echo <<<EOT
            <script>
                document.addEventListener("DOMContentLoaded", function(event) { 
                    swal.fire({
                        text: 'Your account is not allowed for this feature.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    }).then(() => {
                        window.location.href = 'dashboard.php';
                    });
                });
            </script>
        EOT;
    }

    $studentArray = array();
    $isStudent = $mysqli->query("SELECT SR_number, SR_fname, SR_mname, SR_lname, SR_email FROM studentrecord");
    while ($studentData = $isStudent->fetch_assoc()) {
        $studentArray[] = $studentData;
    }

    $facultyArray = array();
    $isFaculty = $mysqli->query("SELECT F_number, F_fname, F_mname, F_lname, F_email FROM faculty");
    while ($facultyData = $isFaculty->fetch_assoc()) {
        $facultyArray[] = $facultyData;
    }

    $student = json_encode($studentArray);
    echo "<script>var student = " . $student . ";</script>";
    $faculty = json_encode($facultyArray);
    echo "<script>var faculty = " . $faculty . ";</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Account Recovery</title>
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

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="../assets/css/sweetAlert.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->

    <link href="../assets/css/admin/style.css" rel="stylesheet">
    <link href="../assets/css/admin/style.css.map" rel="stylesheet">

</head>

<body>
    <nav class="fixed-top align-items-top">
        <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
            <img class="m-3" href="../index.php" src="../assets/img/logo.png" style="height: 50px; width:300px;" alt="Icon">
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                <span class="fa fa-bars"></span>
            </button>
        </nav>
    </nav>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item" style="text-align:center; font-size: 20px; color: #b9b9b9; margin-top:20px;">ADMIN</li>
                    <!-- line 1 -->
                    <li class="nav-item nav-category" style="color: #b9b9b9;">Menu</li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/dashboard.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/auditTrail.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Activity History</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/createAdmin.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Admin Account</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/resetPassword.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Reset Password</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/announcement.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">School Announcements</span>
                        </a>
                    </li>
                    <!-- line 2 -->
                    <li class="nav-item nav-category" style="padding-top: 10px; color:#b9b9b9;">Student Records</li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/addStudent.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Register Student</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../admin/student.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Student Information</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/editgrades.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Finalization of Grades</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/editSection.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Change Student Section</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/movingUp.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Status</span>
                        </a>
                    </li>
                    <!-- line 3 -->
                    <li class="nav-item nav-category" style="padding-top: 10px; color:#b9b9b9;">Faculty</li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/addFaculty.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Register Faculty</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/faculty.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Faculty Records</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/assignAdvisory.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Advisory Class Assignment</span>
                        </a>
                    </li>
                    <!-- line 4 -->
                    <li class="nav-item nav-category" style="padding-top: 10px; color:#b9b9b9;">Learning Areas</li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/editlearningareas.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Work Schedule Assignment</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/modifyCurriculum.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Edit Curriculum</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/modifySection.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Edit Section</span>
                        </a>
                    </li>
                    <!-- line 5 -->
                    <li class="nav-item nav-category" style="padding-top: 10px; color:#b9b9b9;">Attendance Report</li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/dailyReports.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Daily Reports</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/monthlyReports.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Monthly Reports</span>
                        </a>
                    </li>
                    <!-- line 5 -->
                    <li class="nav-item nav-category" style="padding-top: 10px;"></li>
                    <li class="nav-item">
                        <a class="nav-link" href="../auth/logout.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Logout</span>
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
                                        <h2 class="fw-bold text-primary text-uppercase">Account Recovery</h2>
                                    </div>
                                </div>
                                <div class="tab-content tab-content-basic" style="padding-bottom: 0px;">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="col-12 grid-margin">
                                            <div class="row">
                                                <div class="col-lg-8 col-sm-12 grid-margin">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" id="checkCredentialsForm">
                                                                <h4 style="text-align: center">Enter User Information</h4>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-sm-12 grid-margin">
                                                                        <div class="row" style="padding-bottom: 15px;">
                                                                            <div class="col-md-12">
                                                                                <label class="col-sm-12 col-form-label">Identification No. (LRN OR FACULTY ID)<span style="color: red;">*</span></label>
                                                                                <div class="col-sm-12">
                                                                                    <input type="text" class="form-control" name="IdNo" id="IdNo" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row" style="padding-bottom: 15px;">
                                                                            <div class="col-md-6">
                                                                                <label class="col-sm-12 col-form-label">Last Name <span style="color: red;">*</span></label>
                                                                                <div class="col-sm-12">
                                                                                    <input type="text" class="form-control" name="userLname" id="userLname" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="col-sm-12 col-form-label">First Name <span style="color: red;">*</span></label>
                                                                                <div class="col-sm-12">
                                                                                    <input type="text" class="form-control" name="userFname" id="userFname" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-sm-12 grid-margin">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <form class="form-sample" action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" id="adminForm">
                                                                <h4 style="text-align: center; padding-bottom: 11px;">Update Login Credentials</h4>
                                                                <div class="row" style="padding-bottom: 20px;">
                                                                    <div class="col-md-12">
                                                                        <label class="col-sm-12 col-form-label">Email Address</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="hidden" name="storedID" id="storedID">
                                                                            <input type="hidden" name="currentEmail" id="currentEmail">
                                                                            <input type="text" class="form-control" name="userEmail" id="userEmail" disabled required />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div style="text-align: center;">
                                                                    <button type="submit" name="resetPassword" id="resetPassword" class="btn btn-primary me-2" disabled>Generate new password</button>
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
        const IdNo = document.getElementById('IdNo');
        const userLname = document.getElementById('userLname');
        const userFname = document.getElementById('userFname');
        const checkCredentials = document.getElementById('checkCredentials');
        const userEmail = document.getElementById('userEmail');
        const resetPassword = document.getElementById('resetPassword');
        const currentEmail = document.getElementById('currentEmail');
        const storedID = document.getElementById('storedID');

        IdNo.addEventListener("change", function() {
            const IdNoValue = this.value;

            const studentInfo = student.find(function(element) {
                return element.SR_number == IdNoValue;
            });

            const facultyInfo = faculty.find(function(element) {
                return element.F_number == IdNoValue;
            });

            if (studentInfo == null) {
                if (facultyInfo == null) {
                    swal.fire({
                        text: 'No data matched',
                        icon: 'error'
                    }).then((result) => {
                        IdNo.value = '';
                    });
                } else {
                    swal.fire({
                        text: 'Information matched with Faculty data stored in the database',
                        icon: 'success'
                    }).then((result) => {
                        userLname.value = facultyInfo.F_lname;
                        userFname.value = facultyInfo.F_fname;
                        userEmail.value = facultyInfo.F_email;
                        currentEmail.value = facultyInfo.F_email;
                        storedID.value = facultyInfo.F_number;
                        if (userEmail.disabled && userEmail.value != '') {
                            userEmail.removeAttribute('disabled');
                            resetPassword.removeAttribute('disabled');
                        }
                    });
                }
            } else {
                swal.fire({
                    text: 'Information matched with Student data stored in the database',
                    icon: 'success'
                }).then((result) => {
                    userLname.value = studentInfo.SR_lname;
                    userFname.value = studentInfo.SR_fname;
                    userEmail.value = studentInfo.SR_email;
                    currentEmail.value = studentInfo.SR_email;
                    storedID.value = studentInfo.SR_number;
                    if (userEmail.disabled && userEmail.value != '') {
                        userEmail.removeAttribute('disabled');
                        resetPassword.removeAttribute('disabled');
                    }
                });
            }
        });
    </script>
</body>

</html>