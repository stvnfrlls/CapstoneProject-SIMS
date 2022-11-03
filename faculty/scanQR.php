<?php require_once("../assets/php/server.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty - Attendance</title>

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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/qr.css" rel="stylesheet">

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border position-relative text-primary" style="width: 6rem; height: 6rem;" role="status"></div>
        <img class="position-absolute top-50 start-50 translate-middle" src="../assets/img/icons/icon-1.png" alt="Icon">
    </div>
    <!-- Spinner End -->





    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.html" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="cdsp"><img class="me-3" src="../assets/img/logo.png" style="height: 50px; width:50px;" alt="Icon">Colegio De San Pedro</h1>
            <h1 class="cdsp1" alt="Icon">Student Information and Monitoring System</h1>
        </a>

    </nav>
    <!-- Navbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">

        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0 ">
                <a href="index.php" class="nav-item nav-link active" style="color: white">Home</a>
                <a href="about.html" class="nav-item nav-link" style="color: white">About Us</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link dropdown-toggle" data-bs-toggle="dropdown" style="color: white">Academics</a>
                    <div class="dropdown-menu bg-dark border-0 m-0">
                        <a href="auth/login.php" class="dropdown-item" style="color: white">Student Information System</a>
                        <a href="" class="dropdown-item" style="color: white">Kindergarten</a>
                        <a href="" class="dropdown-item" style="color: white">Pre-Elementary</a>
                        <a href="" class="dropdown-item" style="color: white">Elementary</a>
                        <a href="" class="dropdown-item" style="color: white">Highschool</a>
                        <a href="" class="dropdown-item" style="color: white">Senior Highschool</a>
                        <a href="" class="dropdown-item" style="color: white">College</a>
                    </div>
                </div>
                <a href="service.html" class="nav-item nav-link" style="color: white">Admissions</a>
                <a href="contact.html" class="nav-item nav-link" style="color: white">Scholarship and Discounts</a>
                <a href="contact.html" class="nav-item nav-link" style="color: white">Contact Us</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <h1>Scan QR Code</h1>
    <a href="../index.php">Home</a>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <video class="camera" id="preview"></video>
            </div>
            <div class="col-md-12">
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" class="form-horizontal">
                    <label class="texttt">Scan QR Code</label><br>
                    <input type="text" name="qrcode_input" id="qrcode_input" class="qrText" required><br>
                    <input class="submittt" type="submit" value="present" name="present" id="present">
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-class" id="table-id">
                    <?php
                    $get_present_student = "SELECT * FROM attendance";
                    $result = $mysqli->query($get_present_student);

                    if ($result->num_rows > 0) { ?>
                        <tr>
                            <th style="text-align: center;">Student Number</th>
                            <th style="text-align: center;">Time In</th>
                            <th style="text-align: center;">Time Out</th>
                        </tr>
                        <?php
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $row['SR_number'] ?></td>
                                <td style="text-align: center;"><?php echo $row['A_time_in'] ?></td>
                                <td style="text-align: center;"><?php echo $row['A_time_out'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    <?php
                    } else { ?>
                        <tr style="border: 1px solid black;">
                            <th style="border: 1px solid black;text-align: center;">Student Number</th>
                            <th style="border: 1px solid black;text-align: center;">Time In</th>
                            <th style="border: 1px solid black;text-align: center;">Time Out</th>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td colspan="3" style="text-align: center;">NO DATA</td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        Instascan.Camera.getCameras().then((cameras) => {
            if (cameras.length > 0) {
                if (cameras[2]) {
                    scanner.start(cameras[2]);
                } else if (cameras[1]) {
                    scanner.start(cameras[1]);
                } else {
                    scanner.start(cameras[0]);
                }
            } else {
                alert('No Cameras');
            }
        }).catch((err) => {
            console.error(err);
        });

        scanner.addListener('scan', function(c) {
            document.getElementById('qrcode_input').value = c;

        })
    </script>

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
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        <br> Distributed By: <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
</body>

</html>