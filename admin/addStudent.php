<?php
require_once("../assets/php/server.php");

$_SESSION['fromAddStudent'] = "TRUE";

if (!isset($_SESSION['AD_number'])) {
    header('Location: ../auth/login.php');
} else {
    if (isset($_POST['confirm_student'])) {
        header('Location: confirmstudent.php');
    } else {
        $array_cityprovreg = array();
        $array_cityprovreg2 = array();
        $gradeArray = array();

        $cityprovreg = $mysqli->query('SELECT * FROM cityprovregion');
        $sections = $mysqli->query("SELECT * FROM sections");
        $gradeLevels = $mysqli->query("SELECT * FROM sections");

        while ($cityprovreg_data = $cityprovreg->fetch_assoc()) {
            $array_cityprovreg[] = $cityprovreg_data;
            $array_cityprovreg2[] = $cityprovreg_data;
        }
        while ($gradeLevelData = $gradeLevels->fetch_assoc()) {
            $gradeArray[] = $gradeLevelData;
        }

        $student = json_encode($array_cityprovreg);
        $guardian = json_encode($array_cityprovreg);
        $gradeLevel = json_encode($gradeArray);

        echo "<script>var cityprov = " . $student . ";</script>";
        echo "<script>var g_cityprov = " . $guardian . ";</script>";
        echo "<script>var g_Level = " . $gradeLevel . "</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Student Registration</title>
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
                            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" id="confirmStudent" enctype="multipart/form-data">
                                <div class="home-tab">
                                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                        <div class="section-title text-center position-relative pb-3 mb-3 mx-auto">
                                            <h2 class="fw-bold text-primary text-uppercase">Student Registration</h2>
                                        </div>
                                    </div>
                                    <div class="tab-content tab-content-basic">
                                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                            <div class="row">
                                                <div class="col-12 grid-margin">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row" style="padding-bottom: 15px;">
                                                                <h4 class="card-title">Personal Information</h4>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <label class="col-sm-6 col-form-label">Learners Reference Number <span style="color: red;">*</span></label>
                                                                        <div class="form-group">
                                                                            <div class="input-group col-xs-12">
                                                                                <input type="number" maxlength="12" class="form-control" id="LRN" name="LRN" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label class="col-sm-6 col-form-label">Profile Picture</label>
                                                                        <div class="form-group">
                                                                            <div class="input-group col-xs-12">
                                                                                <input type="file" class="form-control file-upload-info" name="image" placeholder="Upload Image" accept="image/*">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- next row -->
                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-md-4">
                                                                        <label class="col-sm-12 col-form-label">Last Name <span style="color: red;">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" name="S_lname" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="col-sm-12 col-form-label">First Name <span style="color: red;">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" name="S_fname" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="col-sm-12 col-form-label">Middle Name</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" name="S_mname" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label class="col-sm-12 col-form-label">Suffix</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" name="S_suffix">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-md-4">
                                                                        <label label class="col-sm-12 col-form-label">Birthdate <span style="color: red;">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <input type="date" class="form-control" name="S_birthday" id="S_birthday" required onchange="calculateAge()">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <label label class="col-sm-12 col-form-label">Age <span style="color: red;">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <input type="number" class="form-control" maxlength="2" name="S_age" id="S_age" required readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <label label class="col-sm-12 col-form-label">Birthplace <span style="color: red;">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" name="S_birthplace" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label label class="col-sm-12 col-form-label">Gender <span style="color: red;">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <select class="form-select" name="S_gender" required>
                                                                                <option selected></option>
                                                                                <option value="Male">Male</option>
                                                                                <option value="Female">Female</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-md-4">
                                                                        <label class="col-sm-12 col-form-label">Religion <span style="color: red;">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" name="S_religion" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="col-sm-12 col-form-label">Citizenship <span style="color: red;">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" name="S_citizenship" required>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <h4 class="card-title m-1">Address</h4>
                                                                    <div class="col-md-6">
                                                                        <label label class="col-sm-12 col-form-label">Address <span style="color: red;">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" name="S_address" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label label class="col-sm-12 col-form-label">Barangay <span style="color: red;">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" name="S_barangay" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label label class="col-sm-12 col-form-label">City <span style="color: red;">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <select id="city" class="form-select" name="S_city" required>
                                                                                <option selected></option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-md-4">
                                                                        <label label class="col-sm-12 col-form-label">State <span style="color: red;">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" id="state" name="S_state" required readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label label class="col-sm-12 col-form-label">Postal Code <span style="color: red;">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <input type="number" class="form-control" id="postal" name="S_postal" required readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label label class="col-sm-12 col-form-label">Email Address <span style="color: red;">*</span></label>
                                                                        <div class="col-sm-12">
                                                                            <input type="email" class="form-control" name="S_email" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- next row -->
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 grid-margin">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Contact Person</h4>
                                                        <div class="row" style="padding-bottom: 15px;">
                                                            <div class="col-md-4">
                                                                <label class="col-sm-12 col-form-label">Last Name <span style="color: red;">*</span></label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_lname" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="col-sm-12 col-form-label">First Name <span style="color: red;">*</span></label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_fname" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="col-sm-12 col-form-label">Middle Name</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_mname">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="col-sm-12 col-form-label">Suffix</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_suffix">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row" style="padding-bottom: 15px;">
                                                            <div class="col-md-6">
                                                                <label label class="col-sm-12 col-form-label">Address <span style="color: red;">*</span></label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_address" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label label class="col-sm-12 col-form-label">Barangay <span style="color: red;">*</span></label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" id="G_barangay" name="G_barangay" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label label class="col-sm-12 col-form-label">City <span style="color: red;">*</span></label>
                                                                <div class="col-sm-12">
                                                                    <select id="G_city" class="form-select" name="G_city" required>
                                                                        <option selected></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row" style="padding-bottom: 15px;">
                                                            <div class="col-md-4">
                                                                <label label class="col-sm-12 col-form-label">State <span style="color: red;">*</span></label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" id="G_state" name="G_state" required readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label label class="col-sm-12 col-form-label">Postal Code <span style="color: red;">*</span></label>
                                                                <div class="col-sm-12">
                                                                    <input type="number" id="G_postal" class="form-control" name="G_postal" required readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label label class="col-sm-12 col-form-label">Email Address <span style="color: red;">*</span></label>
                                                                <div class="col-sm-12">
                                                                    <input type="email" class="form-control" name="G_email" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row" style="padding-bottom: 15px;">
                                                            <div class="col-md-4">
                                                                <label label class="col-sm-12 col-form-label">Relationship to Student <span style="color: red;">*</span></label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_relationshipStudent" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label label class="col-sm-12 col-form-label">Telephone Number</label>
                                                                <div class="col-sm-12">
                                                                    <input type="number" class="form-control" name="G_telephone">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label label class="col-sm-12 col-form-label">Contact Number <span style="color: red;">*</span></label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_contact" id="phone" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-8 col-sm-12 grid-margin" style="margin: auto;">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <?php
                                                        $GradeSection_Array = array();
                                                        $getGradesSection = $mysqli->query("SELECT DISTINCT S_yearLevel, S_name FROM sections WHERE acadYear = '{$currentSchoolYear}'");
                                                        while ($GradeSection = $getGradesSection->fetch_assoc()) {
                                                            $GradeSection_Array[] = $GradeSection;
                                                        }
                                                        $GradeLevel_only = array();
                                                        $getGradeLevel_only = $mysqli->query("SELECT DISTINCT S_yearLevel FROM sections WHERE acadYear = '{$currentSchoolYear}'");
                                                        while ($GradeLevel_Data = $getGradeLevel_only->fetch_assoc()) {
                                                            $GradeLevel_only[] = $GradeLevel_Data;
                                                        }

                                                        $gradesection_toJS = json_encode($GradeSection_Array);
                                                        $GradeLevel_only_toJS = json_encode($GradeLevel_only);

                                                        echo "<script>var GradeLevel_only = " . $GradeLevel_only_toJS . ";</script>";
                                                        echo "<script>var gradeSection = " . $gradesection_toJS . ";</script>";
                                                        ?>
                                                        <h4 class="card-title">Class Information</h4>
                                                        <div class="row" style="padding-bottom: 15px;">
                                                            <div class="col-md-6">
                                                                <label class="col-sm-12 col-form-label">Grade Level <span style="color: red;">*</span></label>
                                                                <div class="col-sm-12">
                                                                    <select class="form-select" id="grade" name="S_gradelevel" required>
                                                                        <option selected></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label label class="col-sm-12 col-form-label">Section <span style="color: red;">*</span></label>
                                                                <div class="col-sm-12">
                                                                    <select class="form-select" id="section" name="S_section" required>
                                                                        <option selected></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: center;">
                                    <input type="hidden" name="regStudent" value="submit">
                                    <button type="button" id="regStudent" class="btn btn-primary me-2">Register</button>
                                    <button type="button" class="btn btn-light">Back</button>
                                </div>
                            </form>
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
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/admin/vendor.bundle.base.js"></script>
    <script src="../assets/js/admin/off-canvas.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            //called when key is pressed in textbox
            $("#LRN").keypress(function(e) {

                var maxlengthNumber = parseInt($('#LRN').attr('maxlength'));
                var inputValueLength = $('#LRN').val().length + 1;
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {

                    return false;
                }
                if (maxlengthNumber < inputValueLength) {
                    return false;
                }
            });
        });
        $(document).ready(function() {
            //called when key is pressed in textbox
            $("#S_age").keypress(function(e) {

                var maxlengthNumber = parseInt($('#S_age').attr('maxlength'));
                var inputValueLength = $('#S_age').val().length + 1;
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {

                    return false;
                }
                if (maxlengthNumber < inputValueLength) {
                    return false;
                }
            });
        });
    </script>
    <script>
        function calculateAge() {
            const S_birthday = document.getElementById("S_birthday").value;
            const today = new Date();
            const birthDate = new Date(S_birthday);

            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            document.getElementById("S_age").value = age;
        }
        const phoneInput = document.getElementById('phone');
        phoneInput.maxLength = 15;

        phoneInput.addEventListener('input', function(e) {
            // Get the current input value and remove all non-numeric characters
            const input = e.target.value.replace(/\D/g, '');

            // Format the input value as a phone number
            const match = input.match(/^(\d{0,4})(\d{0,3})(\d{0,4})$/);
            let formatted = '';
            if (match) {
                formatted = `(${match[1]})`;
                if (match[2]) formatted += ` ${match[2]}`;
                if (match[3]) formatted += `-${match[3]}`;
            }

            // Update the input field with the formatted value
            e.target.value = formatted;

            if (input.length >= 15) {
                e.target.value = formatted.slice(0, 15);
            }
        });

        const grade = document.getElementById('grade');
        const section = document.getElementById('section');
        for (let i = 0; i < GradeLevel_only.length; i++) {
            const option = document.createElement('option');
            option.value = GradeLevel_only[i].S_yearLevel;
            option.text = GradeLevel_only[i].S_yearLevel;
            grade.add(option);
        }

        grade.addEventListener("change", function() {
            const gradeValue = this.value;
            const filteredData = gradeSection.filter(function(item) {
                return item.S_yearLevel === gradeValue;
            });
            section.innerHTML = "";
            filteredData.forEach(function(item) {
                const option = document.createElement("option");
                option.value = item.S_name;
                option.text = item.S_name;
                section.add(option);
            });
        });
    </script>
    <script>
        const city = document.getElementById('city');
        const state = document.getElementById('state');
        const postal = document.getElementById('postal');

        for (let i = 0; i < cityprov.length; i++) {
            const option = document.createElement('option');
            option.value = cityprov[i].city;
            option.text = cityprov[i].city;
            city.add(option);
        }

        city.addEventListener("change", function() {
            const cityValue = this.value;
            const findcity = cityprov.find(function(element) {
                return element.city == cityValue;
            });
            state.value = findcity.state;
            postal.value = findcity.zip_code;
        });
    </script>
    <script>
        const g_city = document.getElementById('G_city');
        const g_state = document.getElementById('G_state');
        const g_postal = document.getElementById('G_postal');

        for (let i = 0; i < g_cityprov.length; i++) {
            const option1 = document.createElement('option');
            option1.value = g_cityprov[i].city;
            option1.text = g_cityprov[i].city;
            g_city.add(option1);
        }

        g_city.addEventListener("change", function() {
            const g_CityValue = this.value;
            const g_findCity = g_cityprov.find(function(element) {
                return element.city == g_CityValue;
            });
            g_state.value = g_findCity.state;
            g_postal.value = g_findCity.zip_code;
        });
    </script>

    <!-- Template Javascript -->
    <script>
        const confirmStudent = document.getElementById('confirmStudent');
        const regStudent = document.getElementById('regStudent');
        regStudent.addEventListener('click', function() {
            Swal.fire({
                title: 'Are you sure you want to register this student?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: `No`,
            }).then((result) => {
                if (result.isConfirmed) {
                    confirmStudent.submit();
                }
            });
        });
    </script>

    <script>
        function handleCheckboxClick(clickedCheckbox) {
            const option1Checkbox = document.getElementById('option1');
            const option2Checkbox = document.getElementById('option2');

            if (clickedCheckbox === option1Checkbox) {
                if (clickedCheckbox.checked) {
                    option2Checkbox.checked = false;
                }
            } else if (clickedCheckbox === option2Checkbox) {
                if (clickedCheckbox.checked) {
                    option1Checkbox.checked = false;
                }
            }
        }
    </script>
</body>

</html>