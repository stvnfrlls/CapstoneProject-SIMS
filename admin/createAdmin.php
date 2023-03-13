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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Create Administrator</title>
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
                                        <h2 class="fw-bold text-primary text-uppercase">Administrator</h2>
                                    </div>
                                </div>
                                <div class="tab-content tab-content-basic" style="padding-bottom: 0px;">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="col-12 grid-margin">
                                            <div class="row">
                                                <div class="col-lg-8 col-sm-12 grid-margin">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4 style="text-align: center">List of Administrators</h4>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center">Name</th>
                                                                            <th class="text-center">Email Address</th>
                                                                            <th class="text-center">Password</th>
                                                                            <th class="text-center">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $rowCount = 1;
                                                                        $getAdminAccountsList = $mysqli->query("SELECT * FROM admin_accounts");
                                                                        if (mysqli_num_rows($getAdminAccountsList) > 0) {
                                                                            while ($AdminAccounts = $getAdminAccountsList->fetch_assoc()) { ?>
                                                                                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" id="modifyAdmin">
                                                                                    <tr>
                                                                                        <td><?php echo $AdminAccounts['AD_name']; ?></td>
                                                                                        <td>
                                                                                            <input type="hidden" name="AD_number" value="<?php echo $AdminAccounts['AD_number'] ?>">
                                                                                            <input type="hidden" name="current_email" value="<?php echo $AdminAccounts['AD_email'] ?>">
                                                                                            <input type="email" class="form-control" name="AD_email" value="<?php echo $AdminAccounts['AD_email']; ?>" required>
                                                                                        </td>
                                                                                        <td>
                                                                                            <input type="password" class="form-control" name="AD_password" value="<?php echo $AdminAccounts['AD_password']; ?>" required>
                                                                                        </td>
                                                                                        <td style="text-align:center;">
                                                                                            <input type="hidden" id="updateTag" name="updateAdminDetails" value="updateAdminDetails" disabled>
                                                                                            <input type="hidden" id="deleteTag" name="deleteAdminDetails" value="deleteAdminDetails" disabled>
                                                                                            <?php
                                                                                            if ($AdminAccounts['AD_number'] != "5UP3R4DM1N") {
                                                                                                echo '<input type="submit" class="btn btn-primary" id="updateAdminDetails" name="updateAdminDetails" value="Update">';
                                                                                                echo '<input type="submit" class="btn btn-primary" id="deleteAdminDetails" name="deleteAdminDetails" value="Delete">';
                                                                                            } else {
                                                                                                // echo '<input type="submit" class="btn btn-primary" style="background-color:black;" id="updateAdminDetails" name="updateAdminDetails" value="Update" disabled>';
                                                                                                // echo '<input type="submit" class="btn btn-primary" style="background-color:black;" id="deleteAdminDetails" name="deleteAdminDetails" value="Delete" disabled>';
                                                                                                echo '<i class="fa fa-ban"  aria-hidden="true"> No Action</i>';
                                                                                            }
                                                                                            ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                </form>
                                                                            <?php
                                                                                $rowCount++;
                                                                            }
                                                                        } else { ?>
                                                                            <tr>
                                                                                <td colspan="3" class="text-center">No Admin account registered yet</td>
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
                                                            <form class="form-sample" action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" id="adminForm">
                                                                <h4 style="text-align: center">Create Administrator</h4>
                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-md-12">
                                                                        <label class="col-sm-12 col-form-label">Full Name</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" name="adminName" required />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-md-12">
                                                                        <label class="col-sm-12 col-form-label">Email</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="email" class="form-control" name="adminEmail" required />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-md-12">
                                                                        <label class="col-sm-12 col-form-label">Enter Password</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="password" class="form-control" name="adminPassword" id="adminPassword" required />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-md-12">
                                                                        <label class="col-sm-12 col-form-label">Confirm Password</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" required />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div style="text-align: center;">
                                                                    <!-- <input type="hidden" id="addAdminTag" name="addAdmin" value="addAdmin" disabled> -->
                                                                    <button type="submit" id="addAdmin" name="addAdmin" class="btn btn-primary me-2">Create</button>
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
        const modifyAdmin = document.getElementById('modifyAdmin');
        const updateAdminDetails = document.getElementById('updateAdminDetails');
        const deleteAdminDetails = document.getElementById('deleteAdminDetails');
        const updateTag = document.getElementById('updateTag');
        const deleteTag = document.getElementById('deleteTag');

        updateAdminDetails.addEventListener("submit", function() {
            if (updateTag.disabled) {
                updateTag.removeAttribute('disabled');
                if (!updateTag.disabled) {
                    Swal.fire({
                        title: 'Are you sure you want to proceed with this action?',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: `No`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Form submitted!',
                                icon: 'success',
                            }).then(() => {
                                modifyAdmin.submit();
                            });
                        }
                    })
                }
            }
        });

        deleteAdminDetails.addEventListener("submit", function() {
            if (deleteTag.disabled) {
                deleteTag.removeAttribute('disabled');
                if (!deleteTag.disabled) {
                    Swal.fire({
                        title: 'Are you sure you want to proceed with this action?',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: `No`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Form submitted!',
                                icon: 'success',
                            }).then(() => {
                                modifyAdmin.submit();
                            });
                        }
                    })
                }
            }
        });
    </script>
</body>

</html>