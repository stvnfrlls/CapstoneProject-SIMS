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
    <title>Monthly Reports</title>
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
                        <a class="nav-link" href="../faculty/createReminder.php">
                            <i class=""></i>
                            <span class="menu-title">Create Reminders</span>
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
                            <span class="menu-title">Advisory</span>
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
                                        <h2 class="fw-bold text-primary text-uppercase">Monthly Reports</h2>
                                    </div>
                                </div>
                                <div class="container-xl px-4 mt-4" style="padding-bottom:0px">
                                    <nav class="nav">
                                        <a class="nav-link" href="../faculty/dailyReports.php" target="__blank">Daily</a>
                                        <a class="nav-link active ms-0" href="../faculty/monthlyReports.php" target="__blank" style="color: #c02628;">Monthly</a>
                                    </nav>
                                    <div class="border-bottom"></div>
                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">

                                        <div class="row">
                                            <form class="form-sample">
                                                <div class="col-12 grid-margin">
                                                    <div class="row">
                                                        <div class="col-lg-4" style="margin: auto; text-align:center;">
                                                            <label class="col-sm-12 col-form-label">Student Number</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="text-align: center; padding-top: 0px;">
                                                    <input type="button" style="color:#ffffff;" class="btn btn-primary me-2" name="confirm_student" value="Enter">
                                                </div>
                                            </form>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 grid-margin">
                                                <form class="form-sample">
                                                    <div class="btn-group">
                                                        <div>
                                                            <button class="btn btn-secondary" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color: #e4e3e3;">
                                                                Month<i class="fa fa-caret-down"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                                <a class="dropdown-item" href="">January</a>
                                                                <a class="dropdown-item" href="">February</a>
                                                                <a class="dropdown-item" href="">March</a>
                                                                <a class="dropdown-item" href="">April</a>
                                                                <a class="dropdown-item" href="">Maay</a>
                                                                <a class="dropdown-item" href="">June</a>
                                                                <a class="dropdown-item" href="">July</a>
                                                                <a class="dropdown-item" href="">August</a>
                                                                <a class="dropdown-item" href="">September</a>
                                                                <a class="dropdown-item" href="">Ocotber</a>
                                                                <a class="dropdown-item" href="">November</a>
                                                                <a class="dropdown-item" href="">December</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="btn-group">
                                                        <div>
                                                            <button class="btn btn-secondary" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color: #e4e3e3;">
                                                                Grade<i class="fa fa-caret-down"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                                <a class="dropdown-item" href="">Grade 1</a>
                                                                <a class="dropdown-item" href="">grade 2</a>
                                                                <a class="dropdown-item" href="">Grade 3</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="btn-group">
                                                        <div>
                                                            <button class="btn btn-secondary" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color: #e4e3e3;">
                                                                Section<i class="fa fa-caret-down"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                                <a class="dropdown-item" href="">Carnation</a>
                                                                <a class="dropdown-item" href="">Chrysanthemum</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="btn-group" style="float: right;">
                                                        <a href="" style="background-color: #e4e3e3; margin-right: 0px;" class="btn btn-secondary">Print <i class="fa fa-print" style="font-size: 12px; align-self:center;"></i></a>
                                                    </div>
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
                                                                        <tr>
                                                                            <td class="tabledata">Camille Anne G. Sabile</td>
                                                                            <td class="tabledata">20</td>
                                                                            <td class="tabledata">18</td>
                                                                            <td class="tabledata">2</td>
                                                                            <td class="tabledata">0</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="tabledata">Hazel Grace Cantuba</td>
                                                                            <td class="tabledata">20</td>
                                                                            <td class="tabledata">19</td>
                                                                            <td class="tabledata">1</td>
                                                                            <td class="tabledata">10</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="tabledata">Cleint Steven Frilles</td>
                                                                            <td class="tabledata">20</td>
                                                                            <td class="tabledata">15</td>
                                                                            <td class="tabledata">5</td>
                                                                            <td class="tabledata">5</td>
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

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->


    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>

    <script src="../assets/js/admin/vendor.bundle.base.js"></script>
    <script src="../assets/js/admin/off-canvas.js"></script>
</body>

</html>