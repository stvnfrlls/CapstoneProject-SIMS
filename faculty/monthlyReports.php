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
                                                    <div class="row" style="padding-bottom: 15px;">
                                                        <div class="col-md-4">
                                                            <label class="col-sm-12 col-form-label">Name</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" readonly />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="col-sm-12 col-form-label">Grade and Section</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" readonly />
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
                                                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                                        <div class="card bg-primary card-rounded">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Month</th>
                                                                            <th>Total of Days Present</th>
                                                                            <th>Total of Days Late</th>
                                                                            <th>Total of Days Absent</th>
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
                                                                            <td class="tabledata">January</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="tabledata">February</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="tabledata">March</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="tabledata">April</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="tabledata">May</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="tabledata">June</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="tabledata">July</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="tabledata">August</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="tabledata">September</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="tabledata">October</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="tabledata">November</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="tabledata">December</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
                                                                            <td class="tabledata">Student 1</td>
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
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-light mb-4">Address</h3>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>Phase 1A, Pacita Complex 1, San Pedro City, Laguna 4023</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary me-3"></i>+63 919 065 6576</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>customerservice@cdsp.edu.ph</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-body me-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-body me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-body me-1" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-body me-0" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-light mb-4">Quick Links</h3>
                    <a class="btn btn-link" href="">Home</a>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Academics</a>
                    <a class="btn btn-link" href="">Admission</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-light mb-4">Useful Links</h3>
                    <a class="btn btn-link" href="">DepEd</a>
                    <a class="btn btn-link" href="">Pag Asa</a>
                    <a class="btn btn-link" href="">City of San Pedro</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-light mb-4">Newsletter</h3>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright">
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