<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
    header('Location: ../auth/login.php');
} else {
    $NOTtimedIN = array();
    $NOTtimedOUT = array();
    $timedOUT = array();
    if (isset($_SESSION['F_number'])) {
        $getSectionLabel = $mysqli->query("SELECT S_name FROM sections WHERE S_adviser = '{$_SESSION['F_number']}'");
        $SectionLabel = $getSectionLabel->fetch_assoc();

        $today = date('Y-m-d');

        $getNOTtimedIN = $mysqli->query("SELECT SR_lname, SR_fname, SR_number FROM studentrecord 
                                        WHERE SR_number 
                                        NOT IN (SELECT SR_number FROM attendance WHERE A_date = CURDATE())
                                        AND SR_grade = 6");
        while ($studentNumber_NOTtimedIN = $getNOTtimedIN->fetch_assoc()) {
            $NOTtimedIN[] = $studentNumber_NOTtimedIN;
        }

        $getNOTtimedOUT = $mysqli->query("SELECT SR_lname, SR_fname, SR_number FROM studentrecord 
                                        WHERE SR_number 
                                        IN (SELECT SR_number FROM attendance WHERE A_time_OUT IS NULL AND A_status IS NOT NULL AND A_date = CURDATE())
                                        AND SR_grade = 6");
        while ($studentNumber_NOTtimedOUT = $getNOTtimedOUT->fetch_assoc()) {
            $NOTtimedOUT[] = $studentNumber_NOTtimedOUT;
        }

        $gettimedOUT = $mysqli->query("SELECT SR_lname, SR_fname, SR_number FROM studentrecord 
                                        WHERE SR_number 
                                        IN (SELECT SR_number FROM attendance WHERE A_time_OUT IS NOT NULL AND A_status IS NOT NULL AND A_date = CURDATE())
                                        AND SR_grade = 6");
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

                                                .camera-options {
                                                    display: flex;
                                                    justify-content: center;
                                                    align-items: center;
                                                }

                                                #camera-select {

                                                    width: 300px;
                                                    /* Set the width to 200 pixels */
                                                }

                                                .form-div {
                                                    display: flex;
                                                    justify-content: center;
                                                    align-items: center;
                                                    width: 400px;
                                                    margin: 0 auto;
                                                }
                                            </style>

                                            <div class="camera-container" id="camera">
                                                <div class="row">
                                                    <video id="preview"></video>
                                                </div>
                                            </div>
                                            <div class="camera-options m-2">
                                                <div class="row">
                                                    <select class="form-select" id="camera-select"></select>
                                                </div>
                                            </div>

                                            <div class="form-div">
                                                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" id="qr_form" class="form-horizontal">
                                                    <input type="number" class="form-control mb-2" name="student" id="input1" placeholder="LRN" required>
                                                    <input type="submit" class="btn btn-primary" name="present" style="display: block;margin: 0 auto;">
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

            // Start the scanner
            scanner.start(backCamera);

            // Populate the select tag with camera options
            let cameraSelect = document.getElementById('camera-select');
            cameras.forEach((camera) => {
                let option = document.createElement('option');
                option.value = camera.id;
                option.text = camera.name;
                cameraSelect.appendChild(option);
            });

            // Add an event listener to the select tag to switch cameras
            cameraSelect.addEventListener('change', (event) => {
                let selectedCameraId = event.target.value;
                let selectedCamera = cameras.find((camera) => camera.id === selectedCameraId);
                if (selectedCamera) {
                    scanner.start(selectedCamera);
                } else {
                    Swal.fire('Selected camera not found');
                }
            });
        } else {
            Swal.fire('No Cameras');
        }
    }).catch((err) => {
        console.error(err);
    });

    scanner.addListener('scan', function(content) {
        let input = content;

        document.getElementById('input1').value = input;
        const NOTtimedINDATA = NOTtimedIN.find(content => content.SR_number === input);
        const NOTtimedOUTDATA = NOTtimedOUT.find(content => content.SR_number === input);
        const timedOUTDATA = timedOUT.find(content => content.SR_number === input);
        if (NOTtimedINDATA) {
            Swal.fire({
                title: `Student (${NOTtimedINDATA.SR_lname}, ${NOTtimedINDATA.SR_fname}) will be marked as present?`,
                confirmButtonText: 'Proceed',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Timed in!', '', 'success').then((result) => {
                        document.getElementById('qr_form').submit();
                    })
                }
            });
        } else if (NOTtimedOUTDATA) {
            Swal.fire({
                title: `Student (${NOTtimedOUTDATA.SR_lname}, ${NOTtimedOUTDATA.SR_fname}) ready to go home?`,
                confirmButtonText: 'Proceed',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Timed Out!', '', 'success').then((result) => {
                        document.getElementById('qr_form').submit();
                    })
                }
            })
        } else if (timedOUTDATA) {
            Swal.fire({
                title: `Student (${timedOUTDATA.SR_lname}, ${timedOUTDATA .SR_fname}) has already timed out.`,
                confirmButtonText: 'Proceed',
            }).then((result) => {
                document.getElementById('input1').value = "";
            });

        } else if (!timedOUTDATA) {
            Swal.fire({
                title: 'Invalid QR Code',
                confirmButtonText: 'OK',
            }).then((result) => {
                document.getElementById('input1').value = "";
            });
        }
    });
</script>

<!-- Template Javascript -->
<script src="../assets/js/main.js"></script>

<script src="../assets/js/admin/vendor.bundle.base.js"></script>
<script src="../assets/js/admin/off-canvas.js"></script>

</html>