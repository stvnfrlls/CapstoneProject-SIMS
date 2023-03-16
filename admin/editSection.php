<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['AD_number'])) {
    header('Location: ../auth/login.php');
}

$checkQuarter = $mysqli->query("SELECT quarterStatus FROM quartertable WHERE quarterStatus = 'current'");
if (mysqli_num_rows($checkQuarter) > 0) {
    echo <<<EOT
            <script>
                document.addEventListener("DOMContentLoaded", function(event) { 
                    swal.fire({
                        text: 'This feature is currently disabled because the school year has already started.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    }).then(() => {
                        window.location.href = 'dashboard.php';
                    });
                });
            </script>
        EOT;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Change Student Section</title>
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
                            <span class="menu-title" style="color: #b9b9b9;">Admin Account</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/resetPassword.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Account Recovery</span>
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
                            <span class="menu-title" style="color: #b9b9b9;">Daily Attendance</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/monthlyReports.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Monthly Attendance</span>
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
                                        <h2 class="fw-bold text-primary text-uppercase">Change Student Section</h2>
                                    </div>
                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="btn-group">
                                            <div>
                                                <button class="btn btn-secondary" style="background-color: #e4e3e3;" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <?php
                                                    if (isset($_GET['grade'])) {
                                                        if ($_GET['grade'] == 'KINDER') {
                                                            echo $_GET['grade'];
                                                        } else {
                                                            echo "Grade " . $_GET['grade'];
                                                        }
                                                    } else {
                                                        echo "Grade";
                                                    }
                                                    ?>
                                                    <i class="fa fa-caret-down"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                    <?php
                                                    $getgradelevel = $mysqli->query("SELECT DISTINCT(S_yearLevel) FROM sections");
                                                    while ($gradeLevel = $getgradelevel->fetch_assoc()) { ?>
                                                        <a class="dropdown-item" href="editSection.php?grade=<?php echo $gradeLevel['S_yearLevel'] ?>">
                                                            <?php
                                                            if ($gradeLevel['S_yearLevel'] == 'KINDER') {
                                                                echo $gradeLevel['S_yearLevel'];
                                                            } else {
                                                                echo "Grade " . $gradeLevel['S_yearLevel'];
                                                            }
                                                            ?>
                                                        </a>
                                                    <?php }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <div>
                                                <button class="btn btn-secondary" style="background-color: #e4e3e3;" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <?php
                                                    if (isset($_GET['section'])) {
                                                        echo $_GET['section'];
                                                    } else {
                                                        echo "Section";
                                                    }
                                                    ?>
                                                    <i class="fa fa-caret-down"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                    <a class="dropdown-item" href="editSection.php"></a>
                                                    <?php
                                                    if (isset($_GET['grade'])) {
                                                        $getsection = $mysqli->query("SELECT DISTINCT(S_name) FROM sections WHERE acadYear = '{$currentSchoolYear}' AND S_yearLevel = '{$_GET['grade']}' ");

                                                        while ($section = $getsection->fetch_assoc()) { ?>
                                                            <a class="dropdown-item" href="editSection.php?grade=<?php echo $_GET['grade'] ?>&section=<?php echo $section['S_name'] ?>">
                                                                <?php echo $section['S_name'] ?>
                                                            </a>
                                                    <?php }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 15px;">
                                            <div class="col-lg-12 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="hatdog" style="border-bottom: #ffffff;">No.</th>
                                                                            <th class="hatdog" style="border-bottom: #ffffff;">Student Number</th>
                                                                            <th class="hatdog" style="border-bottom: #ffffff;">Student Name</th>
                                                                            <th class="hatdog" style="border-bottom: #ffffff;">Section</th>
                                                                            <th class="hatdog" style="border-bottom: #ffffff;">Transfer to</th>
                                                                            <th class="hatdog" style="border-bottom: #ffffff;">Action</th>
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

                                                                            .hatdog {
                                                                                border: 1px solid #ffffff;
                                                                                text-align: center;
                                                                                vertical-align: middle;
                                                                                height: 30px;
                                                                                color: #000000;
                                                                            }
                                                                        </style>
                                                                        <?php
                                                                        $rowCount = 1;
                                                                        if (isset($_GET['grade']) && isset($_GET['section'])) {
                                                                            $getClasslistData = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number IN (SELECT SR_number FROM classlist 
                                                                                                                WHERE SR_grade = '{$_GET['grade']}' 
                                                                                                                AND SR_section = '{$_GET['section']}' 
                                                                                                                AND acadYear = '{$currentSchoolYear}')
                                                                                                                ORDER BY SR_lname");
                                                                            if (mysqli_num_rows($getClasslistData) > 0) {
                                                                                while ($ClasslistData = $getClasslistData->fetch_assoc()) { ?>
                                                                                    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" id="changeSectionForm">
                                                                                        <tr>
                                                                                            <td class="hatdog"><?php echo $rowCount; ?></td>
                                                                                            <td class="hatdog">
                                                                                                <?php echo $ClasslistData['SR_number'] ?>
                                                                                                <input type="hidden" name="SR_number" value="<?php echo $ClasslistData['SR_number'] ?>">
                                                                                            </td>
                                                                                            <td class="hatdog">
                                                                                                <?php
                                                                                                $getStudentInfo = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$ClasslistData['SR_number']}'");
                                                                                                $studentInfo = $getStudentInfo->fetch_assoc();
                                                                                                if (!empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] != "" && empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] = "") {
                                                                                                    echo $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . substr($studentInfo['SR_mname'], 0, 1) . ".";
                                                                                                } else if (empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] = "" && !empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] != "") {
                                                                                                    echo $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . $studentInfo['SR_suffix'];
                                                                                                } else if (empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] = "" && empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] = "") {
                                                                                                    echo $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'];
                                                                                                }
                                                                                                ?>
                                                                                            </td>
                                                                                            <td class="hatdog">
                                                                                                <?php
                                                                                                if ($ClasslistData['SR_grade'] == 'KINDER') {
                                                                                                    echo $ClasslistData['SR_grade'] . " - " . $ClasslistData['SR_section'];
                                                                                                } else {
                                                                                                    echo "Grade " . $ClasslistData['SR_grade'] . " - " . $ClasslistData['SR_section'];
                                                                                                }
                                                                                                ?>
                                                                                            </td>
                                                                                            <td class="hatdog">
                                                                                                <?php
                                                                                                $getSection = $mysqli->query("SELECT S_name FROM sections 
                                                                                                WHERE S_name != '{$_GET['section']}' 
                                                                                                AND S_yearLevel = '{$_GET['grade']}'
                                                                                                AND acadYear = '{$currentSchoolYear}'");
                                                                                                if (mysqli_num_rows($getSection) == 0) { ?>
                                                                                                    <select class="form-select" name="changeto" aria-label="Default select example" disabled>
                                                                                                        <option select>No Available Section</option>
                                                                                                    </select>
                                                                                                <?php } else {  ?>
                                                                                                    <select class="form-select" name="changeto" aria-label="Default select example" required>
                                                                                                        <option></option>
                                                                                                        <?php
                                                                                                        while ($Section = $getSection->fetch_assoc()) {
                                                                                                            echo "<option value=" . $Section['S_name'] . ">" . $Section['S_name'] .  "</option>";
                                                                                                        }
                                                                                                        ?>
                                                                                                    </select>
                                                                                                <?php }
                                                                                                ?>
                                                                                            </td>
                                                                                            <td class="hatdog">
                                                                                                <div style="text-align: center;">
                                                                                                    <?php
                                                                                                    if (mysqli_num_rows($getSection) == 0) { ?>
                                                                                                        <button type="submit" class="btn btn-secondary" disabled>Update</button>
                                                                                                    <?php } else { ?>
                                                                                                        <button type="submit" class="btn btn-primary" name="changeSection" id="changeSection">Update</button>
                                                                                                    <?php }
                                                                                                    ?>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </form>
                                                                                <?php $rowCount++;
                                                                                }
                                                                            } else { ?>
                                                                                <tr>
                                                                                    <td colspan="6">No Student Found</td>
                                                                                </tr>
                                                                            <?php }
                                                                        } else { ?>
                                                                            <tr>
                                                                                <td colspan="6">Select Grade and Section First</td>
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


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <script>
        // const changeSectionForm = document.getElementById('changeSectionForm');
        // const changeSection = document.getElementById('changeSection');
        // changeSection.addEventListener('click', function() {
        //     Swal.fire({
        //         title: 'Are you sure you want to proceed with this action?',
        //         showCancelButton: true,
        //         confirmButtonText: 'Yes',
        //         cancelButtonText: `No`,
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             Swal.fire({
        //                 title: 'Form submitted!',
        //                 icon: 'success',
        //             }).then(() => {
        //                 changeSectionForm.submit();
        //             });
        //         }
        //     })
        // })
    </script>
</body>

</html>