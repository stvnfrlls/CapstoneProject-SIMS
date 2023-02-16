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

        $NOTtimedIN_js = json_encode($NOTtimedIN);
        $NOTtimedOUT_js = json_encode($NOTtimedOUT);

        echo "<script>var NOTtimedIN = " . $NOTtimedIN_js . ";</script>";
        echo "<script>var NOTtimedOUT = " . $NOTtimedOUT_js . ";</script>";
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
    <link href="../assets/css/admin/style.css" rel="stylesheet">
    <link href="../assets/css/admin/materialdesignicons.min.css" rel="stylesheet">
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

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item" style="text-align:center; font-size: 20px; color: #b9b9b9; margin-top:20px;">FACULTY</li>
                    <!-- line 1 -->
                    <li class="nav-item nav-category">Profile</li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
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
                        <a class="nav-link" href="../faculty/reminders.php">
                            <i class=""></i>
                            <span class="menu-title">Reminders</span>
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

                                            <!-- modal para sa timein and out -->
                                            <div id="myModal1" class="modal">
                                                <style>
                                                    @media (max-width: 414px) {
                                                        .modal-content {
                                                            width: 90% !important;
                                                        }
                                                    }

                                                    @media (max-width: 768px) {
                                                        .modal-content {
                                                            width: 90% !important;
                                                        }
                                                    }

                                                    @media (max-width: 1024px) {
                                                        .modal-content {
                                                            width: 70% !important;
                                                        }
                                                    }

                                                    .modal-content {
                                                        width: 30%;
                                                    }

                                                    .close1 {
                                                        color: black;
                                                        float: right;
                                                        font-size: 20px;
                                                        font-weight: normal;
                                                    }
                                                </style>
                                                <!-- Modal content -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h2 style="font-family: 'Lato','san-serif'; text-align:center;">Successful!</h2>
                                                        <span class="close1"><i class="fa fa-times"></i></span>
                                                    </div>
                                                    <div class="modal-body" style="text-align: center;">
                                                        <img src="https://cdn.onlinewebfonts.com/svg/img_2555.png" alt="cookies-img" height="90" width="400" />
                                                        <p id="modal1Ptag"></p>
                                                        <div class="row d-flex justify-content-center mb-3">
                                                            <div class="col text-center form-group form">
                                                                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" id="qr_form" class="form-horizontal">
                                                                    <input type="hidden" name="student" id="input1">
                                                                    <input type="hidden" name="fetcher" id="input2">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- modal para sa pang verify ng fetcher -->

                                            <div id="myModal2" class="modal" style="display: none;">
                                                <style>
                                                    @media (max-width: 414px) {
                                                        .modal-content {
                                                            width: 90% !important;
                                                        }
                                                    }

                                                    @media (max-width: 768px) {
                                                        .modal-content {
                                                            width: 90% !important;
                                                        }
                                                    }

                                                    @media (max-width: 1024px) {
                                                        .modal-content {
                                                            width: 70% !important;
                                                        }
                                                    }

                                                    .modal-content {
                                                        width: 30%;
                                                    }


                                                    .close2 {
                                                        color: black;
                                                        float: right;
                                                        font-size: 20px;
                                                        font-weight: normal;
                                                    }
                                                </style>
                                                <!-- Modal content -->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h2 style="font-family: 'Lato','san-serif'; text-align:center;">Alert!</h2>
                                                        <span class="close2"><i class="fa fa-times"></i></span>
                                                    </div>
                                                    <div class="modal-body" style="text-align: center;">
                                                        <img src="https://cdn.onlinewebfonts.com/svg/img_2555.png" alt="cookies-img" height="90" width="400" />
                                                        <p id="modal2Ptag"></p>
                                                        <div class="row d-flex justify-content-center mb-3">
                                                            <div class="col text-center form-group form">
                                                                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" id="qr_form" class="form-horizontal">
                                                                    <input type="hidden" name="student" id="input1">
                                                                    <input type="hidden" name="fetcher" id="input2">
                                                                    <div class="row">
                                                                        <p>Is there a fetcher?</p>
                                                                        <div class="col-12">
                                                                            <input type="checkbox" id="withFetcher">
                                                                            <label for="a">Yes</label>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <input type="checkbox" id="noFetcher" onclick="showreasons()">
                                                                            <label for="a">No</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row" id="reason" style="display: none;">
                                                                        <p>If no, choose your reason.</p>
                                                                        <div class="col-12">
                                                                            <input type="checkbox" id="reason1" value="fetcher is sick">
                                                                            <label for="a">The fetcher is sick.</label>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <input type="checkbox" id="reason2" value="busy">
                                                                            <label for="a">The fetcher runs some errand.</label>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <input type="checkbox" id="reason3" name="a" value="">
                                                                            <label for="a">Others (Please specify)</label>
                                                                            <input type="text" name="student" class="form-control" id="reason3Text" required disabled><br>
                                                                        </div>
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
    function showreasons() {
        var checkBox = document.getElementById("noFetcher");
        var reason = document.getElementById("reason");

        if (checkBox.checked == true) {
            reason.style.display = "block";
        } else {
            reason.style.display = "none";
        }
    }
</script>
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
    // Get the modal
    var modal1 = document.getElementById("myModal1");

    // Get the <span> element that closes the modal
    var span1 = document.getElementsByClassName("close1")[0];

    // When the user clicks on <span> (x), close the modal
    span1.onclick = function() {
        modal1.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal1) {
            modal1.style.display = "none";
        }
    }
    // Get the modal
    var modal2 = document.getElementById("myModal2");

    // Get the <span> element that closes the modal
    var span2 = document.getElementsByClassName("close2")[0];

    // When the user clicks on <span> (x), close the modal
    span2.onclick = function() {
        modal2.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal2) {
            modal2.style.display = "none";
        }
    }
    var studentID = document.getElementById('input1').value;
    var fetcherID = document.getElementById('input2').value;

    scanner.addListener('scan', function(c) {
        let input = c;

        if (input.includes("SP")) {
            document.getElementById('input1').value = input;

            if (NOTtimedIN.some(e => e.SR_number === input)) {
                document.getElementById('modal1Ptag').innerHTML = "marked as present.";
                modal1.style.display = "block";
                setTimeout(() => {
                    document.getElementById("qr_form").submit();
                }, 3000);
            } else if (NOTtimedOUT.some(e => e.SR_number === input)) {
                modal2.style.display = "block";

                if (document.getElementById('withFetcher').checked) {
                    modal2.style.display = "none";
                    document.getElementById('modal1Ptag').innerHTML = "Scan Fetcher QR Code";
                    modal1.style.display = "block";
                    setTimeout(() => {
                        modal1.style.display = "none";
                    }, 3000);;
                    scanner.addListener('scan', function(d) {
                        let input2 = d;

                        document.getElementById('input2').value = input2;
                        document.getElementById('modal1Ptag').innerHTML = "ready to go home.";
                        modal1.style.display = "block";
                        setTimeout(() => {
                            document.getElementById("qr_form").submit();
                        }, 3000);;
                    })
                } else if (document.getElementById('noFetcher').checked) {
                    if (document.getElementById('reason1').checked) {
                        modal2.style.display = "none";
                        document.getElementById('modal1Ptag').innerHTML = "ready to go home.";
                        modal1.style.display = "block";
                        setTimeout(() => {
                            document.getElementById("qr_form").submit();
                        }, 3000);
                    } else if (document.getElementById('reason2').checked) {
                        modal2.style.display = "none";
                        modal1.style.display = "block";
                        setTimeout(() => {
                            document.getElementById("qr_form").submit();
                        }, 3000);
                        document.getElementById('modal1Ptag').innerHTML = "ready to go home.";
                    } else if (document.getElementById('reason3').checked) {
                        modal2.style.display = "none";
                        document.getElementById('modal1Ptag').innerHTML = "ready to go home.";
                        modal1.style.display = "block";
                        setTimeout(() => {
                            document.getElementById("qr_form").submit();
                        }, 3000);
                    }
                }
            } else if (!NOTtimedOUT.some(e => e.SR_number === input)) {
                document.getElementById('modal1Ptag').innerHTML = "student is already out.";
                modal1.style.display = "block";
                setTimeout(() => {
                    modal1.style.display = "none";
                }, 3000);
            }
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