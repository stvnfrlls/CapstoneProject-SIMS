<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Student - Announcements</title>
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
    <link href="../assets/css/admin/style.css" rel="stylesheet">
    <link href="../assets/css/educ/main.css" rel="stylesheet">

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border position-relative text-primary" style="width: 6rem; height: 6rem;" role="status"></div>
        <img class="position-absolute top-50 start-50 translate-middle" src="../assets/img/icons/icon-1.png" alt="Icon">
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
        <img class="m-3" src="../assets/img/logo.png" style="height: 50px; width:50px;" alt="Icon">
        <div class="d-flex align-items-center justify-content-center text-center">
            <a href="../index.php" class="navbar-brand ms-4 ms-lg-0 text-center">
                <h1 class="cdsp">Colegio De San Pedro</h1>
                <h1 class="cdsp1" alt="Icon">Student Information and Monitoring System</h1>
            </a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">

        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0 ">
                <a href="../index.php" class="nav-item nav-link active" style="color: white; font-size: 14px;">Home</a>
                <a href="about.html" class="nav-item nav-link" style="color: white; font-size: 14px;">About Us</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link dropdown-toggle" data-bs-toggle="dropdown" style="color: white; font-size: 14px;">Academics</a>
                    <div class="dropdown-menu bg-dark border-0 m-0">
                        <a href="auth/login.php" class="dropdown-item" style="color: white; font-size: 14px;">Student Information System</a>
                        <a href="" class="dropdown-item" style="color: white; font-size: 14px;">Kindergarten</a>
                        <a href="" class="dropdown-item" style="color: white; font-size: 14px;">Pre-Elementary</a>
                        <a href="" class="dropdown-item" style="color: white; font-size: 14px;">Elementary</a>
                        <a href="" class="dropdown-item" style="color: white; font-size: 14px;">Highschool</a>
                        <a href="" class="dropdown-item" style="color: white; font-size: 14px;">Senior Highschool</a>
                        <a href="" class="dropdown-item" style="color: white; font-size: 14px;">College</a>
                    </div>
                </div>
                <a href="service.html" class="nav-item nav-link" style="color: white; font-size: 14px;">Admissions</a>
                <a href="contact.html" class="nav-item nav-link" style="color: white; font-size: 14px;">Scholarship and Discounts</a>
                <a href="contact.html" class="nav-item nav-link" style="color: white; font-size: 14px;">Contact Us</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <section class="course-details-area pt-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 left-contents">
                    <div class="jq-tab-wrapper" id="horizontalTab" style="padding-top: 0px;">
                        <div class="jq-tab-menu">
                            <div class="jq-tab-title active" data-tab="1">Description</div>
                            <div class="jq-tab-title" data-tab="2">Eligibility</div>
                            <div class="jq-tab-title" data-tab="3">Course Outline</div>
                            <div class="jq-tab-title" data-tab="4">Comments</div>
                            <div class="jq-tab-title" data-tab="5">Reviews</div>
                        </div>
                        <div class="jq-tab-content-wrapper">
                            <div class="jq-tab-content active" data-tab="1">
                                When you enter into any new area of science, you almost always find yourself with a baffling new language of technical terms to learn before you can converse with the experts. This is certainly true in astronomy both in terms of terms that refer to the cosmos and terms that describe the tools of the trade, the most prevalent being the telescope.
                                <br>
                                <br>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.
                            </div>
                            <div class="jq-tab-content" data-tab="2">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.
                                <br>
                                <br>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum.
                            </div>
                            <div class="jq-tab-content" data-tab="3">
                                <ul class="course-list">
                                    <li class="justify-content-between d-flex">
                                        <p>Introduction Lesson</p>
                                        <a class="primary-btn text-uppercase" href="#">View Details</a>
                                    </li>
                                    <li class="justify-content-between d-flex">
                                        <p>Basics of HTML</p>
                                        <a class="primary-btn text-uppercase" href="#">View Details</a>
                                    </li>
                                    <li class="justify-content-between d-flex">
                                        <p>Getting Know about HTML</p>
                                        <a class="primary-btn text-uppercase" href="#">View Details</a>
                                    </li>
                                    <li class="justify-content-between d-flex">
                                        <p>Tags and Attributes</p>
                                        <a class="primary-btn text-uppercase" href="#">View Details</a>
                                    </li>
                                    <li class="justify-content-between d-flex">
                                        <p>Basics of CSS</p>
                                        <a class="primary-btn text-uppercase" href="#">View Details</a>
                                    </li>
                                    <li class="justify-content-between d-flex">
                                        <p>Getting Familiar with CSS</p>
                                        <a class="primary-btn text-uppercase" href="#">View Details</a>
                                    </li>
                                    <li class="justify-content-between d-flex">
                                        <p>Introduction to Bootstrap</p>
                                        <a class="primary-btn text-uppercase" href="#">View Details</a>
                                    </li>
                                    <li class="justify-content-between d-flex">
                                        <p>Responsive Design</p>
                                        <a class="primary-btn text-uppercase" href="#">View Details</a>
                                    </li>
                                    <li class="justify-content-between d-flex">
                                        <p>Canvas in HTML 5</p>
                                        <a class="primary-btn text-uppercase" href="#">View Details</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="jq-tab-content comment-wrap" data-tab="4">
                                <div class="comments-area">
                                    <h4>05 Comments</h4>
                                    <div class="comment-list">
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <img src="img/blog/c1.jpg" alt="">
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="#">Emilly Blunt</a></h5>
                                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                                    <p class="comment">
                                                        Never say goodbye till the end comes!
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-list left-padding">
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <img src="img/blog/c2.jpg" alt="">
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="#">Elsie Cunningham</a></h5>
                                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                                    <p class="comment">
                                                        Never say goodbye till the end comes!
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-list">
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <img src="img/blog/c4.jpg" alt="">
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="#">Maria Luna</a></h5>
                                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                                    <p class="comment">
                                                        Never say goodbye till the end comes!
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-form">
                                    <h4>Leave a Comment</h4>
                                    <form>
                                        <div class="form-group form-inline">
                                            <div class="form-group col-lg-6 col-md-12 name">
                                                <input type="text" class="form-control" id="name" placeholder="Enter Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'">
                                            </div>
                                            <div class="form-group col-lg-6 col-md-12 email">
                                                <input type="email" class="form-control" id="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="subject" placeholder="Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Subject'">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                                        </div>
                                        <a href="#" class="mt-40 text-uppercase genric-btn primary text-center">Post Comment</a>
                                    </form>
                                </div>
                            </div>
                            <div class="jq-tab-content" data-tab="5">
                                <div class="review-top row pt-40">
                                    <div class="col-lg-3">
                                        <div class="avg-review">
                                            Average <br>
                                            <span>5.0</span> <br>
                                            (3 Ratings)
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <h4 class="mb-20">Provide Your Rating</h4>
                                        <div class="d-flex flex-row reviews">
                                            <span>Quality</span>
                                            <div class="star">
                                                <i class="fa fa-star checked"></i>
                                                <i class="fa fa-star checked"></i>
                                                <i class="fa fa-star checked"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <span>Outstanding</span>
                                        </div>
                                        <div class="d-flex flex-row reviews">
                                            <span>Puncuality</span>
                                            <div class="star">
                                                <i class="fa fa-star checked"></i>
                                                <i class="fa fa-star checked"></i>
                                                <i class="fa fa-star checked"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <span>Outstanding</span>
                                        </div>
                                        <div class="d-flex flex-row reviews">
                                            <span>Quality</span>
                                            <div class="star">
                                                <i class="fa fa-star checked"></i>
                                                <i class="fa fa-star checked"></i>
                                                <i class="fa fa-star checked"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <span>Outstanding</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="feedeback">
                                    <h4 class="pb-20">Your Feedback</h4>
                                    <textarea name="feedback" class="form-control" cols="10" rows="10"></textarea>
                                    <a href="#" class="mt-20 primary-btn text-right text-uppercase">Submit</a>
                                </div>
                                <div class="comments-area mb-30">
                                    <div class="comment-list">
                                        <div class="single-comment single-reviews justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <img src="img/blog/c1.jpg" alt="">
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="#">Emilly Blunt</a>
                                                        <div class="star">
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        </div>
                                                    </h5>
                                                    <p class="comment">
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ut sed, dolorum asperiores perspiciatis provident, odit maxime doloremque aliquam.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-list">
                                        <div class="single-comment single-reviews justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <img src="img/blog/c2.jpg" alt="">
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="#">Elsie Cunningham</a>
                                                        <div class="star">
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        </div>
                                                    </h5>
                                                    <p class="comment">
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ut sed, dolorum asperiores perspiciatis provident, odit maxime doloremque aliquam.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-list">
                                        <div class="single-comment single-reviews justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <img src="img/blog/c3.jpg" alt="">
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="#">Maria Luna</a>
                                                        <div class="star">
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        </div>
                                                    </h5>
                                                    <p class="comment">
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ut sed, dolorum asperiores perspiciatis provident, odit maxime doloremque aliquam.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-list">
                                        <div class="single-comment single-reviews justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <img src="img/blog/c4.jpg" alt="">
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="#">Maria Luna</a>
                                                        <div class="star">
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        </div>
                                                    </h5>
                                                    <p class="comment">
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ut sed, dolorum asperiores perspiciatis provident, odit maxime doloremque aliquam.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 right-contents">
                    <ul>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Title</p>
                                <span class="or">Quest for Excellence 2023</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Posted By</p>
                                <span>Hazel Grace Cantuba</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Date and Time</p>
                                <span>January 4, 2023 - 7:00 AM</span>
                            </a>
                        </li>
                    </ul>
                    <a href="#" class="primary-btn text-uppercase mx-auto" style="background: #c02628;">Enroll the course</a>
                </div>
            </div>
        </div>
    </section>

    <section class="popular-courses-area section-gap courses-page">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Announcements</h1>
                        <p>more announcements</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="single-popular-carusel col-lg-3 col-md-6">
                    <div class="details">
                        <a href="#">
                            <h4>
                                No Classes
                            </h4>
                        </a>
                        <div class="d-flex mb-3">
                            <small class="me-3"><i class="far fa-user text-primary me-2"></i>Hazel Grace Cantuba</small>
                            <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                        </div>
                        <p>
                            When television was young, there was a hugely popular show based on the still popular fictional characte
                        </p>
                    </div>
                </div>
                <div class="single-popular-carusel col-lg-3 col-md-6">
                    <div class="details">
                        <a href="#">
                            <h4>
                                Teacher's Day
                            </h4>
                        </a>
                        <div class="d-flex mb-3">
                            <small class="me-3"><i class="far fa-user text-primary me-2"></i>Hazel Grace Cantuba</small>
                            <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                        </div>
                        <p>
                            When television was young, there was a hugely popular show based on the still popular fictional characte
                        </p>
                    </div>
                </div>
                <div class="single-popular-carusel col-lg-3 col-md-6">
                    <div class="details">
                        <a href="#">
                            <h4>
                                Christmas Party
                            </h4>
                        </a>
                        <div class="d-flex mb-3">
                            <small class="me-3"><i class="far fa-user text-primary me-2"></i>Hazel Grace Cantuba</small>
                            <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                        </div>
                        <p>
                            When television was young, there was a hugely popular show based on the still popular fictional characte
                        </p>
                    </div>
                </div>
                <div class="single-popular-carusel col-lg-3 col-md-6">
                    <div class="details">
                        <a href="#">
                            <h4>
                                Meeting with Parents
                            </h4>
                        </a>
                        <div class="d-flex mb-3">
                            <small class="me-3"><i class="far fa-user text-primary me-2"></i>Hazel Grace Cantuba</small>
                            <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                        </div>
                        <p>
                            When television was young, there was a hugely popular show based on the still popular fictional characte
                        </p>
                    </div>
                </div>
                <a href="#" class="primary-btn text-uppercase mx-auto" style="width: auto;">Load More Courses</a>
            </div>
        </div>
    </section>

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
                        <a class="btn btn-square btn-outline-body me-1" href="" style="border-radius: 5px;"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-body me-1" href="" style="border-radius: 5px;"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-body me-1" href="" style="border-radius: 5px;"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-body me-0" href="" style="border-radius: 5px;"><i class="fab fa-linkedin-in"></i></a>
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
    <script src="../assets/../assets/js/main.js"></script>

    <!-- Javascript -->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <script src="../assets/js/educ/vendor/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/educ/vendor/bootstrap.min.js"></script>
    <script src="../assets/js/educ/easing.min.js"></script>
    <script src="../assets/js/educ/hoverIntent.js"></script>
    <script src="../assets/js/educ/superfish.min.js"></script>
    <script src="../assets/js/educ/jquery.ajaxchimp.min.js"></script>
    <script src="../assets/js/educ/jquery.magnific-popup.min.js"></script>
    <script src="../assets/js/educ/jquery.tabs.min.js"></script>
    <script src="../assets/js/educ/jquery.nice-select.min.js"></script>
    <script src="../assets/js/educ/owl.carousel.min.js"></script>
    <script src="../assets/js/educ/mail-script.js"></script>
    <script src="../assets/js/educ/main.js"></script>

</body>

</html>