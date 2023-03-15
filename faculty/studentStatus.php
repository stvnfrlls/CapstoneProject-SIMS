<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
    header('Location: ../auth/login.php');
} else {
    $getSectionInfo = $mysqli->query("SELECT * FROM sections WHERE S_adviser = '{$_SESSION['F_number']}'");
    $SectionInfo = $getSectionInfo->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Student Status</title>
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

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="../assets/css/sweetAlert.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/form-style.css" rel="stylesheet">
    <link href="../assets/css/admin/style.css" rel="stylesheet">

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
                                        <h2 class="fw-bold text-primary text-uppercase">Student Status</h2>
                                    </div>
                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <form action="<?php $_SERVER["PHP_SELF"] ?>" id="StudentStatusForm" method="post">
                                            <div style="text-align: right;">
                                                <button type="button" id="setStudentStatus" class="btn btn-primary">Save</button>
                                                <input type="hidden" name="moveUpStatus" value="su">
                                            </div>
                                            <div class="row" style="margin-top: 15px;">
                                                <div class="col-lg-12 d-flex flex-column">
                                                    <div class="row flex-grow">
                                                        <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                                            <div class="card card-rounded">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <style>
                                                                                .tablestyle {
                                                                                    border: 1px solid #ffffff;
                                                                                    text-align: center;
                                                                                    vertical-align: middle;
                                                                                    height: 30px;
                                                                                    color: #000000;
                                                                                }
                                                                            </style>
                                                                            <tr>
                                                                                <th class="tablestyle">No.</th>
                                                                                <th class="tablestyle">Student Name</th>
                                                                                <th class="tablestyle">Grade and Section<br>(current)</th>
                                                                                <th class="tablestyle">Remarks</th>
                                                                                <th class="tablestyle">Action</th>
                                                                                <th class="tablestyle">Move up to</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $rowCount = 1;
                                                                            if (mysqli_num_rows($getSectionInfo) > 0) {
                                                                                $getSchoolYearInfo = $mysqli->query("SELECT * FROM acad_year");
                                                                                $schoolyear = $getSchoolYearInfo->fetch_assoc();
                                                                                $nextSchoolYear = $schoolyear['endYear'] . "-" . $schoolyear['endYear'] + 1;
                                                                                $ListofStudents = $mysqli->query("SELECT * FROM classlist 
                                                                                                                WHERE SR_section = '{$SectionInfo['S_name']}' 
                                                                                                                AND acadYear = '{$currentSchoolYear}' 
                                                                                                                AND SR_number NOT IN 
                                                                                                                (SELECT SR_number FROM classlist WHERE acadYear = '{$nextSchoolYear}')");
                                                                                if (mysqli_num_rows($ListofStudents) > 0) {
                                                                                    while ($data = $ListofStudents->fetch_assoc()) { ?>
                                                                                        <tr>
                                                                                            <td class="tablestyle">
                                                                                                <?php echo $rowCount ?>
                                                                                                <input type="hidden" name="ids[]" value="<?php echo $rowCount ?>">
                                                                                            </td>
                                                                                            <td class="tablestyle">
                                                                                                <?php
                                                                                                $getStudentInfo = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$data['SR_number']}'");
                                                                                                $studentInfo = $getStudentInfo->fetch_assoc();

                                                                                                if (!empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] != "" && empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] = "") {
                                                                                                    echo $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . substr($studentInfo['SR_mname'], 0, 1) . ".";
                                                                                                } else if (empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] = "" && !empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] != "") {
                                                                                                    echo $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . $studentInfo['SR_suffix'];
                                                                                                } else if (empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] = "" && empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] = "") {
                                                                                                    echo $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'];
                                                                                                }
                                                                                                ?>
                                                                                                <input type="hidden" name="SR_number[]" value="<?php echo $studentInfo['SR_number'] ?>">
                                                                                            </td>
                                                                                            <td class="tablestyle">
                                                                                                <?php
                                                                                                if ($data['SR_grade'] == 'KINDER') {
                                                                                                    echo $data['SR_grade'] . " - " . $data['SR_section'];
                                                                                                } else {
                                                                                                    echo "Grade " . $data['SR_grade'] . " - " . $data['SR_section'];
                                                                                                }
                                                                                                ?>
                                                                                                <input type="hidden" name="Grade[]" value="<?php echo $data['SR_grade'] ?>">
                                                                                                <input type="hidden" name="Section[]" value="<?php echo $data['SR_section'] ?>">
                                                                                            </td>
                                                                                            <td class="tablestyle">
                                                                                                <?php
                                                                                                $GradeStatus = $mysqli->query("SELECT ROUND(AVG(G_finalgrade)) AS finalgrade FROM grades WHERE SR_number = '{$data['SR_number']}' AND acadYear = '{$currentSchoolYear}'");
                                                                                                $getAvgGrade = $GradeStatus->fetch_assoc();

                                                                                                if ($getAvgGrade['finalgrade'] >= 75) {
                                                                                                    echo "PASSED";
                                                                                                } elseif ($getAvgGrade['finalgrade'] == 0) {
                                                                                                    echo "No Grades yet";
                                                                                                } else {
                                                                                                    echo "FAILED";
                                                                                                }
                                                                                                ?>
                                                                                            </td>
                                                                                            <td class="tablestyle">
                                                                                                <?php
                                                                                                if ($getAvgGrade['finalgrade'] >= 75) { ?>
                                                                                                    <select class="form-select" name="studentStatus[]" id="studentStatus" aria-label="Default select example" required>
                                                                                                        <option></option>
                                                                                                        <?php
                                                                                                        if ($data['SR_grade'] == 6) {
                                                                                                            echo '<option value="GRADUATE">Graduate</option>';
                                                                                                        } else {
                                                                                                            echo '<option value="MOVEUP">Moving Up</option>';
                                                                                                            echo '<option value="TRANSFER">Transferring</option>';
                                                                                                        }
                                                                                                        ?>
                                                                                                    </select>
                                                                                                <?php
                                                                                                } else { ?>
                                                                                                    <select class="form-select" name="studentStatus[]" aria-label="Default select example">
                                                                                                        <option value="REPEAT">Retain</option>
                                                                                                        <option value="DROP">Drop</option>
                                                                                                    </select>
                                                                                                <?php }
                                                                                                ?>
                                                                                            </td>
                                                                                            <td class="tablestyle">
                                                                                                <?php
                                                                                                if ($getAvgGrade['finalgrade'] >= 75) { ?>
                                                                                                    <select class="form-select" name="moveUpTo[]" id="moveUpTo" aria-label="Default select example" required>
                                                                                                        <option selected></option>
                                                                                                        <?php
                                                                                                        if ($data['SR_grade'] == "KINDER") {
                                                                                                            $data['SR_grade'] = 0;
                                                                                                        }
                                                                                                        $next = $data['SR_grade'] + 1;
                                                                                                        $sections = $mysqli->query("SELECT sectionID, S_name, S_yearLevel FROM sections WHERE S_yearLevel = '{$next}' AND acadYear = '{$currentSchoolYear}'");

                                                                                                        if ($data['SR_grade'] == 6) {
                                                                                                            echo '<option value="GRADUATE">Graduation</option>';
                                                                                                        } else {
                                                                                                            while ($listSections = $sections->fetch_assoc()) {
                                                                                                                if ($data['SR_grade'] == "KINDER") {
                                                                                                                    echo '<option value="' . $listSections['sectionID'] . '">' . $listSections['S_yearLevel'] . ' - ' . $listSections['S_name'] . '</option>';
                                                                                                                } else {
                                                                                                                    echo '<option value="' . $listSections['sectionID'] . '">Grade ' . $listSections['S_yearLevel'] . ' - ' . $listSections['S_name'] . '</option>';
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                        ?>
                                                                                                    </select>
                                                                                                <?php
                                                                                                } else { ?>
                                                                                                    <select class="form-select" name="moveUpTo[]" id="moveUpTo" aria-label="Default select example" required>
                                                                                                        <?php
                                                                                                        if ($data['SR_grade'] == "KINDER") {
                                                                                                            $data['SR_grade'] = 0;
                                                                                                        }
                                                                                                        $sections = $mysqli->query("SELECT sectionID, S_name, S_yearLevel FROM sections WHERE S_yearLevel = '{$data['SR_grade']}' AND acadYear = '{$currentSchoolYear}'");
                                                                                                        $listSections = $sections->fetch_assoc();
                                                                                                        if ($data['SR_grade'] == "KINDER") {
                                                                                                            echo '<option value="' . $listSections['sectionID'] . '">' . $listSections['S_yearLevel'] . ' - ' . $listSections['S_name'] . '</option>';
                                                                                                        } else {
                                                                                                            echo '<option value="' . $listSections['sectionID'] . '">Grade ' . $listSections['S_yearLevel'] . ' - ' . $listSections['S_name'] . '</option>';
                                                                                                        }
                                                                                                        ?>
                                                                                                    </select>
                                                                                                <?php }
                                                                                                ?>
                                                                                            </td>

                                                                                        </tr>
                                                                                    <?php $rowCount++;
                                                                                    }
                                                                                } else { ?>
                                                                                    <tr>
                                                                                        <td colspan="10">No Data.</td>
                                                                                    </tr>
                                                                                <?php }
                                                                            } else { ?>
                                                                                <tr>
                                                                                    <td colspan="10">No assigned section</td>
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
                                        </form>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <script>
        const studentStatus = document.getElementById('studentStatus');
        const moveUpTo = document.getElementById('moveUpTo');
        const StudentStatusForm = document.getElementById('StudentStatusForm');
        const setStudentStatus = document.getElementById('setStudentStatus');
        setStudentStatus.addEventListener('click', function() {
            if (studentStatus.value != "" && moveUpTo.value != "") {
                Swal.fire({
                    title: 'Are you sure you want save your changes?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: `No`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        StudentStatusForm.submit();
                        Swal.fire({
                            title: 'Successfully changed!',
                            icon: 'success',
                        })

                    }
                })
            } else {
                Swal.fire({
                    title: 'Required fields are empty!',
                    confirmButtonText: 'OK',
                    icon: 'error'
                })
            }
        })
    </script>
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