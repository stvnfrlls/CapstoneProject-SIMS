<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Colegio De San Pedro</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon"> <!-- delete kasi di nag e exist -->

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="..assets/css/materialdesignicons.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/admin/style.css" rel="stylesheet">
    <link href="../assets/css/educ/main.css" rel="stylesheet">
    <link href="../assets/css/dashboard-user.css" rel="stylesheet">
</head>


<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
        <img class="m-3" href="../index.php" src="assets/img/logo.png" style="height: 50px; width:300px;" alt="Icon">
    </nav>
    <!-- Navbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">

        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <style>
                @media (max-width: 991.98px) {
                    .navbar-nav {
                        margin-left: 0px !important;
                    }

                    .navbar .navbar-nav .nav-link {
                        margin-left: 0px !important;
                    }
                }
            </style>
            <div class="navbar-nav m-auto p-4 p-lg-0 ">
                <a href="index.php" class="nav-item nav-link active" style="color: white; font-size: 14px;">Home</a>
                <a href="" class="nav-item nav-link" style="color: white; font-size: 14px;">About Us</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link" data-bs-toggle="dropdown" style="color: white; font-size: 14px;">Menu <i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-menu bg-dark border-0 m-0">
                        <a href="student/profile.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Dashboard</a>
                        <a href="student/dashboard.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Profile</a>
                        <a href="student/grades.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Report Card</a>
                        <a href="student/dailyAttendance.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Attendance</a>
                        <a href="student/reminders.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Reminders</a>
                        <a href="student/announcement.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">School Announcements</a>
                        <a href="auth/login.php" class="dropdown-item" style="color: white; font-size: 14px; text-align:left;">Login</a>
                    </div>
                </div>
                <a href="" class="nav-item nav-link" style="color: white; font-size: 14px;">Faculty Directory</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-1 text-white animated slideInDown">About Us</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img">
                        <img class="img-fluid" src="assets/img/banner_2.jpg" alt="">
                        <img class="img-fluid" src="assets/img/banner_1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h4 class="section-title">About Us</h4>
                    <h1 class="display-5 mb-4">Colegio De San Pedro</h1>
                    <p>Colegio de San Pedro,Inc. was established in 1981. It was originally named Pacita Complex Learning Center, a nursery, kindergarten school. In 1986, it was renamed Colegio de San Pedro,Inc. with complete high school. In 1996, science-oriented curriculum and computer education were offered from Grade I - VI to High School and recognized it as Colegio de San Pedro Special Science High School.</p>
                    <p class="mb-4">CDSP is now fully recognized by the Department of Education (DepEd), Commission on Higher Education (CHED), and Technical Education Skills Development Autority (TESDA), and graduates of our college computer courses are now gainfully employed, both locally and overseas.</p>
                    <div class="d-flex align-items-center mb-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center border border-5 border-primary" style="width: 120px; height: 120px;">
                            <h1 class="display-1 mb-n2" data-toggle="counter-up">42</h1>
                        </div>
                        <div class="ps-4">
                            <h3>Years</h3>
                            <h3>Working</h3>
                            <h3 class="mb-0">Experience</h3>
                        </div>
                    </div>
                    <a class="btn btn-primary py-3 px-5" href="">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Feature Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h4 class="section-title">WHO WE ARE</h4>
                    <h1 class="display-5 mb-4">Our Mission and Vision</h1>
                    <p class="mb-4">At our school, we are committed to providing a high-quality education that prepares our students for success in an ever-changing world. We believe that by working together, we can create a dynamic and inclusive learning community that fosters academic achievement, personal growth, and social responsibility.</p>
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="d-flex align-items-start">
                                <img class="flex-shrink-0" src="assets/img/leadership.png" alt="Icon" width="50">
                                <div class="ms-4">
                                    <h3>Mission</h3>
                                    <p class="mb-0">Colegio de San Pedro, Inc. provides quality instruction through a relevant, industry-based and dynamic curriculum that will form students to be competent, disciplined, sincere and professionals.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-start">
                                <img class="flex-shrink-0" src="assets/img/vision.png" alt="Icon" width="50">
                                <div class="ms-4">
                                    <h3>Vision</h3>
                                    <p class="mb-0">Colegio de San Pedro, Inc. aims to be the top choice in terms of academic education that produces globally competitive individuals who will be the future leaders and innovators in the industry and society.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="feature-img">
                        <img class="img-fluid" src="assets/img/banner_2.jpg" alt="">
                        <img class="img-fluid" src="assets/img/banner_1.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->

    <!-- core values Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h4 class="section-title">Core values</h4>
            </div>
            <div class="row g-4" style="margin-bottom: 20px;">
                <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item d-flex position-relative text-center h-100">
                        <img class="bg-img" src="assets/img/banner_1.jpg" alt="">
                        <div class="service-text p-5">
                            <img class="mb-4" src="assets/img/competence.png" alt="Icon" width="100">
                            <h3 class="mb-3">Competence</h3>
                            <p class="mb-4">CDSP adheres to produce graduates with full competence in their chosen field of specialization.</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item d-flex position-relative text-center h-100">
                        <img class="bg-img" src="assets/img/banner_1.jpg" alt="">
                        <div class="service-text p-5">
                            <img class="mb-4" src="assets/img/discipline.png" alt="Icon" width="100">
                            <h3 class="mb-3">Discipline</h3>
                            <p class="mb-4">CDSP is committed to give direction and meaning to life in such a way that it enhances growth of the total person.</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item d-flex position-relative text-center h-100">
                        <img class="bg-img" src="assets/img/banner_1.jpg" alt="" >
                        <div class="service-text p-5">
                            <img class="mb-4" src="assets/img/service.png" alt="Icon" width="100">
                            <h3 class="mb-3">Service</h3>
                            <p class="mb-4">CDSP is committed to the efficient delivery of its service to various clienteles by optimum use of resources in the operation of the college.</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item d-flex position-relative text-center h-100">
                        <img class="bg-img" src="assets/img/banner_1.jpg" alt="">
                        <div class="service-text p-5">
                            <img class="mb-4" src="assets/img/process.png" alt="Icon" width="100">
                            <h3 class="mb-3">Progress</h3>
                            <p class="mb-4">CDSP promotes values of honesty and integrity, service to others, the importance of family, changes in the face of adversity, and the willingness to overcome difficulties in order to succeed and excel.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- core values End -->

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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/wow/wow.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/lib/counterup/counterup.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>
</body>


</html>