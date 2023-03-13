<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
    header('Location: ../auth/login.php');
} else {
    if (isset($_SESSION['F_number'])) {
        $getSectionLabel = $mysqli->query("SELECT S_name FROM sections WHERE S_adviser = '{$_SESSION['F_number']}'");
        $SectionLabel = $getSectionLabel->fetch_assoc();

        $NOTtimedIN = array();
        $getNOTtimedIN = $mysqli->query("SELECT studentrecord.SR_number FROM studentrecord LEFT JOIN attendance ON studentrecord.SR_number = attendance.SR_number WHERE attendance.A_time_IN IS NULL");
        while ($studentNumber_NOTtimedIN = $getNOTtimedIN->fetch_assoc()) {
            $NOTtimedIN[] = $studentNumber_NOTtimedIN;
        }

        $NOTtimedOUT = array();
        $getNOTtimedOUT = $mysqli->query("SELECT studentrecord.SR_number FROM studentrecord LEFT JOIN attendance ON studentrecord.SR_number = attendance.SR_number WHERE attendance.A_time_OUT IS NULL");
        while ($studentNumber_NOTtimedOUT = $getNOTtimedOUT->fetch_assoc()) {
            $NOTtimedOUT[] = $studentNumber_NOTtimedOUT;
        }

        $timedOUT = array();
        $gettimedOUT = $mysqli->query("SELECT studentrecord.SR_number FROM studentrecord LEFT JOIN attendance ON studentrecord.SR_number = attendance.SR_number WHERE attendance.A_time_OUT IS NULL");
        while ($studentNumber_timedOUT = $gettimedOUT->fetch_assoc()) {
            $timedOUT[] = $studentNumber_timedOUT;
        }

        $NOTtimedIN_js = json_encode($NOTtimedIN);
        $NOTtimedOUT_js = json_encode($NOTtimedOUT);
        $timedOUT_js = json_encode($timedOUT);

        echo "<script>var NOTtimedIN = " . $NOTtimedIN_js . ";</script>";
        echo "<script>var NOTtimedOUT = " . $NOTtimedOUT_js . ";</script>";
        echo "<script>var timedOUT = " . $timedOUT_js . ";</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty - Attendance</title>

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

    <!-- Sweet Alert Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    </link>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/qr.css" rel="stylesheet">
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
                                        <h2 class="fw-bold text-primary text-uppercase">QR Scanner</h2>
                                    </div>
                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <style>
                                                .camera-container {
                                                    width: 100vw;
                                                    height: 80vh;
                                                    display: flex;
                                                    justify-content: center;
                                                    align-items: center;
                                                }

                                                #camera {
                                                    width: 100%;
                                                    height: 100%;
                                                    object-fit: contain;
                                                }
                                            </style>

                                            <div class="camera-container" id="camera">
                                                <video id="preview"></video>
                                            </div>

                                            <form style="text-align: center;">
                                                <style>
                                                    @media (max-width: 414px) {
                                                        .custom {
                                                            width: 100%
                                                        }
                                                    }

                                                    @media (max-width: 768px) {
                                                        .custom {
                                                            width: 100%;
                                                        }
                                                    }

                                                    @media (max-width: 1024px) {
                                                        .custom {
                                                            width: 100%;

                                                        }
                                                    }
                                                </style>
                                            </form>
                                            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" id="qr_form" class="form-horizontal">
                                                <input type="hidden" name="student" id="input1">
                                                <input type="hidden" name="fetcher" id="input2">
                                            </form>
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
            </div>
        </div>
    </div>

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

</body>

<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script>
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        mirror: false,
        facingMode: {
            exact: 'environment'
        } // Use the back camera
    });
    Instascan.Camera.getCameras().then((cameras) => {
        if (cameras.length > 0) {
            // Look for a camera with the specified facing mode
            let backCamera = cameras.find((camera) => camera.name.indexOf('back') !== -1);

            if (!backCamera) {
                // If there's no back camera, use the first available camera
                backCamera = cameras[0];
            }

            scanner.start(backCamera);
        } else {
            Swal.fire('No Cameras');
        }
    }).catch((err) => {
        console.error(err);
    });

    scanner.addListener('scan', function(content) {
        let input = content;

        document.getElementById('input1').value = input;
        if (NOTtimedIN.some(content => content.SR_number === input)) {
            Swal.fire({
                title: 'Mark this student as present?',
                confirmButtonText: 'Proceed',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Timed in!', '', 'success').then((result) => {
                        document.getElementById('qr_form').submit();
                    })
                }
            });
        } else if (NOTtimedOUT.some(content => content.SR_number === input)) {
            Swal.fire({
                title: 'Student ready to go home?',
                confirmButtonText: 'Proceed',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('qr_form').submit();
                }
            })
        } else if (!NOTtimedIN.some(content => content.SR_number === input) && !timedOUT.some(content => content.SR_number === input)) {
            Swal.fire({
                title: 'The student has left for home',
                confirmButtonText: 'Proceed',
            });
        } else {
            Swal.fire({
                title: 'Invalid QR Code',
                confirmButtonText: 'OK',
            });
        }
    });
</script>

<!-- Template Javascript -->
<script src="../assets/js/main.js"></script>

<script src="../assets/js/admin/vendor.bundle.base.js"></script>
<script src="../assets/js/admin/off-canvas.js"></script>

</html>