<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['AD_number'])) {
    header('Location: ../auth/login.php');
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

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="../assets/css/sweetAlert.css" rel="stylesheet">

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
                            <span class="menu-title" style="color: #b9b9b9;">Create Admin</span>
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
                                        <h2 class="fw-bold text-primary text-uppercase">Student Status</h2>
                                    </div>
                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="btn-group" style="float: right;">
                                        <div>
                                            <button type="button" id="updateStatus" class="btn btn-primary">Update</button>
                                            <button type="button" style="margin-right: 0px;" class="btn btn-light">Back</button>
                                        </div>
                                    </div>
                                    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" id="updateStatusForm">
                                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                            <div class="btn-group">
                                                <div>
                                                    <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color: #e4e3e3;">
                                                        <?php
                                                        if (isset($_GET['GradeLevel'])) {
                                                            if ($_GET['GradeLevel'] == 'KINDER') {
                                                                echo $_GET['GradeLevel'];
                                                            } else {
                                                                echo "Grade " . $_GET['GradeLevel'];
                                                            }
                                                        } else {
                                                            echo "Grade";
                                                        }
                                                        ?>
                                                        <i class='fa fa-caret-down'></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <a class="dropdown-item" href="movingUp.php?GradeLevel">ALL</a>
                                                        <?php
                                                        $gradelevelList = $mysqli->query("SELECT DISTINCT(S_yearLevel) FROM sections WHERE acadYear = '{$currentSchoolYear}'");
                                                        while ($gradelevel = $gradelevelList->fetch_assoc()) { ?>
                                                            <a class="dropdown-item" href="movingUp.php?GradeLevel=<?php echo $gradelevel['S_yearLevel'] ?>">
                                                                <?php
                                                                if ($gradelevel['S_yearLevel'] == 'KINDER') {
                                                                    echo $gradelevel['S_yearLevel'];
                                                                } else {
                                                                    echo "Grade " . $gradelevel['S_yearLevel'];
                                                                }
                                                                ?>
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if (isset($_GET['GradeLevel'])) { ?>
                                                <div class="btn-group">
                                                    <div>
                                                        <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color: #e4e3e3;">
                                                            <?php if (isset($_GET['section'])) {
                                                                echo $_GET['section'];
                                                            } else {
                                                                echo "Section";
                                                            }
                                                            ?>
                                                            <i class='fa fa-caret-down'></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <?php
                                                            $sectionList = $mysqli->query("SELECT DISTINCT(S_name) FROM sections WHERE S_yearLevel = '{$_GET['GradeLevel']}' AND acadYear = '{$currentSchoolYear}'");
                                                            while ($section = $sectionList->fetch_assoc()) { ?>
                                                                <a class="dropdown-item" href="movingUp.php?GradeLevel=<?php echo $_GET['GradeLevel'] ?>&section=<?php echo $section['S_name'] ?>">
                                                                    <?php echo $section['S_name']; ?>
                                                                </a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                            ?>
                                            <div class="row" style="margin-top: 15px;;">
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
                                                                            if (!empty($_GET['GradeLevel']) && empty($_GET['section'])) {
                                                                                $ListofStudents = "SELECT * FROM classlist WHERE SR_grade = '{$_GET['GradeLevel']}' AND acadYear = '{$currentSchoolYear}' ORDER BY SR_number";
                                                                            } else if (!empty($_GET['GradeLevel']) && !empty($_GET['section'])) {
                                                                                $ListofStudents = "SELECT * FROM classlist WHERE SR_grade = '{$_GET['GradeLevel']}' AND SR_section = '{$_GET['section']}' AND acadYear = '{$currentSchoolYear}' ORDER BY SR_number";
                                                                            } else {
                                                                                $ListofStudents = "SELECT * FROM classlist WHERE acadYear = '{$currentSchoolYear}'";
                                                                            }

                                                                            $resultListofStudents = $mysqli->query($ListofStudents);
                                                                            $rowCount = 1;

                                                                            $numrows = mysqli_num_rows($resultListofStudents);
                                                                            if ($numrows >= 1) {
                                                                                while ($data = $resultListofStudents->fetch_assoc()) { ?>
                                                                                    <tr>
                                                                                        <td class="tablestyle"><?php echo $rowCount ?></td>
                                                                                        <td class="tablestyle">
                                                                                            <?php
                                                                                            $getStudentInfo = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$data['SR_number']}'");
                                                                                            $studentInfo = $getStudentInfo->fetch_assoc();

                                                                                            echo $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . substr($studentInfo['SR_mname'], 0, 1) . ". " . $studentInfo['SR_suffix']
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
                                                                                                <select class="form-select" name="studentStatus[]" aria-label="Default select example">
                                                                                                    <option value=""></option>
                                                                                                    <option value="Dropped">Dropped</option>
                                                                                                    <option value="MovingUp">Moving Up</option>
                                                                                                    <option value="Transferring">Transferring</option>
                                                                                                </select>
                                                                                            <?php
                                                                                            } else { ?>
                                                                                                <select class="form-select" name="studentStatus" aria-label="Default select example" disabled>
                                                                                                    <option selected>Unavailable</option>
                                                                                                </select>
                                                                                            <?php }
                                                                                            ?>
                                                                                        </td>
                                                                                        <td class="tablestyle">
                                                                                            <?php
                                                                                            if ($getAvgGrade['finalgrade'] >= 75) { ?>
                                                                                                <select class="form-select" name="moveUpTo[]" aria-label="Default select example">
                                                                                                    <option value=""></option>
                                                                                                    <?php
                                                                                                    if ($data['SR_grade'] == "KINDER") {
                                                                                                        $data['SR_grade'] = 0;
                                                                                                    }
                                                                                                    $next = $data['SR_grade'] + 1;
                                                                                                    $sections = $mysqli->query("SELECT S_name, S_yearLevel FROM sections WHERE S_yearLevel = '{$next}'");

                                                                                                    if ($data['SR_grade'] == 6) {
                                                                                                        echo '<option value="">Graduation</option>';
                                                                                                    } else {
                                                                                                        while ($listSections = $sections->fetch_assoc()) {
                                                                                                            if ($listSections['S_yearLevel'] == 'KINDER') {
                                                                                                                echo '<option value="">Grade ' . $listSections['S_yearLevel'] . " - " . $listSections['S_name'] . '</option>';
                                                                                                            } else {
                                                                                                                echo '<option value="">Grade ' . $listSections['S_yearLevel'] . " - " . $listSections['S_name'] . '</option>';
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                    ?>
                                                                                                </select>
                                                                                            <?php
                                                                                            } else { ?>
                                                                                                <select class="form-select" aria-label="Default select example" disabled>
                                                                                                    <option selected>Unavailable</option>
                                                                                                </select>
                                                                                            <?php }
                                                                                            ?>
                                                                                        </td>

                                                                                    </tr>
                                                                                <?php $rowCount++;
                                                                                }
                                                                            } else if ($numrows == 0) { ?>
                                                                                <tr>
                                                                                    <td colspan="10">No Data.</td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
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
        const updateStatusForm = document.getElementById('updateStatusForm');
        const updateStatus = document.getElementById('updateStatus');
        updateStatus.addEventListener('click', function() {
            Swal.fire({
                title: 'Are you sure you want to save your changes?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: `No`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Successfully changed!',
                        icon: 'success',
                    }).then(() => {
                        updateStatusForm.submit();
                    });
                }
            })

        })
    </script>
</body>

</html>