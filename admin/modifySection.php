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
    <title>Edit Section</title>
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
                                        <h2 class="fw-bold text-primary text-uppercase">Edit Section</h2>
                                    </div>
                                </div>

                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row" style="margin-top: 15px;">
                                            <div class="col-lg-12 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12 grid-margin">
                                                        <div class="">
                                                            <div style="text-align: center; margin-bottom: 15px;">
                                                                <div class="btn-group">
                                                                    <div>
                                                                        <button class="btn btn-secondary" style="background-color: #e4e3e3;" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                            <?php
                                                                            if (isset($_GET['Grade']) && $_GET['Grade'] == 'KINDER') {
                                                                                echo $_GET['Grade'];
                                                                            }

                                                                            if (isset($_GET['Grade']) && $_GET['Grade'] != 'KINDER') {
                                                                                echo "Grade " . $_GET['Grade'];
                                                                            }
                                                                            if (!isset($_GET['Grade'])) {
                                                                                echo "Grade";
                                                                            }
                                                                            ?>
                                                                            <i class="fa fa-caret-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                                            <?php
                                                                            $getGradeLevelList = $mysqli->query("SELECT gradeLevel FROM grade_level ORDER BY gradeID");
                                                                            while ($gradeLevel = $getGradeLevelList->fetch_assoc()) { ?>
                                                                                <a class="dropdown-item" href="modifySection.php?Grade=<?php echo $gradeLevel['gradeLevel'] ?>">
                                                                                    <?php
                                                                                    if ($gradeLevel['gradeLevel'] == 'KINDER') {
                                                                                        echo $gradeLevel['gradeLevel'];
                                                                                    } else {
                                                                                        echo "Grade " . $gradeLevel['gradeLevel'];
                                                                                    }
                                                                                    ?>
                                                                                </a>
                                                                            <?php }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="table-responsive">
                                                                <table class="table" style="width:50%; margin-left:auto; margin-right:auto;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>No.</th>
                                                                            <th>Section</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        if (isset($_GET['Grade'])) {
                                                                            $getSectionData = $mysqli->query("SELECT DISTINCT S_name FROM sections WHERE acadYear = '{$currentSchoolYear}' AND S_yearLevel = '{$_GET['Grade']}'");
                                                                            $rowCount = 1;
                                                                            while ($sectionData = $getSectionData->fetch_assoc()) { ?>
                                                                                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" id="modifySectionForm">
                                                                                    <tr>
                                                                                        <td><?php echo $rowCount ?></td>
                                                                                        <td>
                                                                                            <input type="hidden" class="form-control" name="currentName" value="<?php echo $sectionData['S_name'] ?>">
                                                                                            <input type="text" class="form-control" name="sectionName" value="<?php echo $sectionData['S_name'] ?>">
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="submit" style="color: #ffffff;" class="btn btn-primary" value="Change Name" id="updateSection" name="updateSection">
                                                                                            <input type="submit" class="btn btn-secondary" value="DELETE" id="deleteSection" name="deleteSection">
                                                                                        </td>
                                                                                    </tr>
                                                                                </form>
                                                                            <?php $rowCount++;
                                                                            } ?>
                                                                            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" id="addSectionForm">
                                                                                <tr>
                                                                                    <td>ADD</td>
                                                                                    <td><input type="text" class="form-control" name="sectionName"></td>
                                                                                    <td><input type="submit" style="color: #ffffff;" class="btn btn-primary" value="ADD" name="addSection" id="addSection"></td>
                                                                                </tr>
                                                                            </form>
                                                                        <?php } else { ?>
                                                                            <tr>
                                                                                <td colspan="4">Select a Grade level first</td>
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

    <!-- <script>
        const addSectionForm = document.getElementById('addSectionForm');
        const modifySectionForm = document.getElementById('modifySectionForm');

        const addSection = document.getElementById('addSection');
        const updateSection = document.getElementById('updateSection');
        const deleteSection = document.getElementById('deleteSection');
        addSection.addEventListener('click', function(event) {
            Swal.fire({
                title: 'Are you sure you want to add this section?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: `No`,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Section added successfully!',
                        icon: 'success',
                    }).then(() => {
                        addSectionForm.submit();
                    });
                }
            })
        })

        updateSection.addEventListener('click', function(event) {
            Swal.fire({
                title: 'Are you sure you want to update this section?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: `No`,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Section updated successfully!',
                        icon: 'success',
                    }).then(() => {
                        modifySectionForm.submit();
                    });
                }
            })
        })

        deleteSection.addEventListener('click', function(event) {
            Swal.fire({
                title: 'Are you sure you want to delete this section?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: `No`,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Section deleted successfully!',
                        icon: 'success',
                    }).then(() => {
                        modifySectionForm.submit();
                    });
                }
            })
        })
    </script> -->
</body>

</html>