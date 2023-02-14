<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
    header('Location: ../auth/login.php');
} else {
    $attendance_array = array();
    $getStudentRecord = $mysqli->query('SELECT * FROM studentrecord');

    $get_present_student = $mysqli->query("SELECT * FROM attendance");

    while ($present_student = $get_present_student->fetch_assoc()) {
        $attendance_array[] = $present_student;
    }
    $attendance_rowCount = 0;
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

    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>

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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/qr.css" rel="stylesheet">

</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
        <img class="m-3" href="../index.php" src="../assets/img/logo.png" style="height: 50px; width:400px;" alt="Icon">
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </nav>
    <!-- Navbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0 ">
                <a href="dashboard.php" class="nav-item nav-link" style="color: white; font-size: 14px;">Home</a>
                <a href="scanQR.php" class="nav-item nav-link" style="color: red; font-size: 14px;">Scan QR</a>
                <a href="classList.php" class="nav-item nav-link" style="color: white; font-size: 14px;">Grades</a>
                <a href="reminders.php" class="nav-item nav-link" style="color: white; font-size: 14px;">Reminders/Assignments</a>
                <a href="editProfile.php" class="nav-item nav-link" style="color: white; font-size: 14px;">Profile</a>
                <a href="../auth/logout.php" class="nav-item nav-link" style="color: white; font-size: 14px;">Logout</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
    <div class="container">
        <div class="row p-3">
            <div class="text-center mb-3">
                <video id="preview" class="video" height="300" width="300" style="object-fit: fill;"></video>
            </div>
            <div class="row d-flex justify-content-center mb-3">
                <div class="col text-center form-group form">
                    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" id="qr_form" class="form-horizontal">
                        <label for="qrcode_input" class="form-label">QR CODE</label>
                        <input type="text" name="student" id="input1" required><br>

                        <label for="qrcode_input" class="form-label" id="labelinput2">Fetcher Code (optional)</label>
                        <input type="text" name="fetcher" id="input2" required>
                    </form>
                </div>
            </div>
            <div class="row d-flex justify-content-center px-5">
                <div class="col text-center mb-3 table">
                    <table class="table table-striped table-class" id="table-id">
                        <tr>
                            <th style="text-align: center;">Student Number</th>
                            <th style="text-align: center;">Time In</th>
                            <th style="text-align: center;">Time Out</th>
                        </tr>
                        <?php
                        if (count($attendance_array) > 0) {
                            while ($attendance_rowCount != count($attendance_array)) { ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $attendance_array[$attendance_rowCount]['SR_number'] ?></td>
                                    <?php
                                    if ($attendance_array[$attendance_rowCount]['A_time_IN']) {
                                        echo '<td style="text-align: center;">' . $attendance_array[$attendance_rowCount]['A_time_IN'] . " - " . $attendance_array[$attendance_rowCount]['A_fetcher_IN'] . '</td>';
                                    }
                                    if ($attendance_array[$attendance_rowCount]['A_time_OUT']) {
                                        echo '<td style="text-align: center;">' . $attendance_array[$attendance_rowCount]['A_time_OUT'] . " - " . $attendance_array[$attendance_rowCount]['A_fetcher_OUT'] . '</td>';
                                    }
                                    ?>
                                </tr>
                            <?php
                                $attendance_rowCount++;
                            }
                            ?>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-body footer mt-5 pt-5 px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-light mb-4">Address</h3>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>Phase 1A, Pacita Complex 1, San Pedro City, Laguna 4023</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary me-3"></i>+63 919 065 6576</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>di ko alam email</p>
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


</body>
<script>
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
    });
    Instascan.Camera.getCameras().then((cameras) => {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            alert('No Cameras');
        }
    }).catch((err) => {
        console.error(err);
    });

    var studentID = document.getElementById('input1').value;
    var fetcherID = document.getElementById('input2').value;
    scanner.addListener('scan', function(c) {
        let input = c;

        if (input.includes("S")) {
            document.getElementById('input1').value = input;
            document.getElementById("qr_form").submit();
        } else {
            document.getElementById('input2').value = input;
        }
    })

    scanner.addListener('scan', function(d) {
        let input2 = d;

        if (input.includes("FTC")) {
            document.getElementById('input2').value = input2;
            document.getElementById("qr_form").submit();
        } else {
            document.getElementById('input1').value = input2;
        }
    })
</script>
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/lib/wow/wow.min.js"></script>
<script src="../assets/lib/easing/easing.min.js"></script>
<script src="../assets/lib/waypoints/waypoints.min.js"></script>
<script src="../assets/lib/counterup/counterup.min.js"></script>
<script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="../assets/lib/tempusdominus/js/moment.min.js"></script>
<script src="../assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="../assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="../assets/js/main.js"></script>

<!-- Javascript -->
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../assets/js/eduwell/isotope.min.js"></script>
<script src="../assets/js/eduwell/owl-carousel.js"></script>
<script src="../assets/js/eduwell/lightbox.js"></script>
<script src="../assets/js/eduwell/tabs.js"></script>
<script src="../assets/js/eduwell/video.js"></script>
<script src="../assets/js/eduwell/slick-slider.js"></script>
<script src="../assets/js/eduwell/custom.js"></script>
<script src="../assets/js/startup/main.js"></script>

</html>