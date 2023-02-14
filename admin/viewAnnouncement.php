<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['AD_number'])) {
    header('Location: ../auth/login.php');
} else {
    $anouncementData = $mysqli->query("SELECT * FROM announcement WHERE ANC_ID = '{$_GET['postID']}'");
    $announcement = $anouncementData->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Announcement</title>
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
    <link href="../assets/css/educ/main.css" rel="stylesheet">

</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
        <img class="m-3" src="../assets/img/logo.png" style="height: 50px; width:50px;" alt="Icon">
        <div class="d-flex align-items-center justify-content-center text-center">
            <a href="../index.php" class="navbar-brand ms-4 ms-lg-0 text-center">
                <h1 class="cdsp">Colegio De San Pedro</h1>
                <h1 class="cdsp1" alt="Icon">Student Information and Monitoring System</h1>
            </a>
        </div>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </nav>
    <!-- Navbar End -->

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
                        <a class="nav-link" href="../admin/createAdmin.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Create Admin</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/addStudent.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Add Student</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/announcement.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Announcements</span>
                        </a>
                    </li>
                    <!-- line 2 -->
                    <li class="nav-item nav-category" style="padding-top: 10px; color:#b9b9b9;">Student</li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/student.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Student Records</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/editgrades.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Grades</span>
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
                            <span class="menu-title" style="color: #b9b9b9;">Add Faculty</span>
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
                            <span class="menu-title" style="color: #b9b9b9;">Assign Advisory</span>
                        </a>
                    </li>
                    <!-- line 4 -->
                    <li class="nav-item nav-category" style="padding-top: 10px; color:#b9b9b9;">Learning Areas</li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/editlearningareas.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Scheduling</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/modifyCurriculum.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Curriculum</span>
                        </a>
                    </li>
                    <!-- line 5 -->
                    <li class="nav-item nav-category" style="padding-top: 10px; color:#b9b9b9;">Reports</li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/dailyReports.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Daily Reports</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/monthlyReports.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Monthly Reports</span>
                        </a>
                    </li>
                    <!-- line 5 -->
                    <li class="nav-item nav-category" style="padding-top: 10px;"></li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
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
                                        <h2 class="fw-bold text-primary text-uppercase">Announcement</h2>
                                    </div>
                                </div>

                                <form style="text-align: right; margin-top: 50px; margin-right: 20px;">
                                    <button type="submit" style="color: #ffffff;" class="btn btn-primary me-2">Edit</button>
                                    <button type="submit" style="color: #ffffff;" class="btn btn-primary me-2">Delete</button>
                                </form>

                                <section class="course-details-area">
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
                                                            <span class="or"><?php echo $announcement['header'] ?></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="justify-content-between d-flex" href="#">
                                                            <p>Posted By</p>
                                                            <span><?php echo $announcement['author'] ?></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="justify-content-between d-flex" href="#">
                                                            <p>Date and Time</p>
                                                            <span><?php echo $announcement['date'] ?></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section class="popular-courses-area section-gap courses-page">
                                    <div class="container">
                                        <div class="row d-flex justify-content-center">
                                            <div class="menu-content pb-70 col-lg-8">
                                                <div class="title text-center">
                                                    <h1 class="mb-10">Other Announcements</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php
                                            $countotherAnnouncementData = $mysqli->query("SELECT COUNT(*) FROM announcement WHERE ANC_ID != '{$_GET['postID']}'");
                                            $countotherAnnouncement = $countotherAnnouncementData->fetch_assoc();
                                            if ($countotherAnnouncement > 0) {
                                                $otherAnnouncementData = $mysqli->query("SELECT * FROM announcement WHERE ANC_ID != '{$_GET['postID']}'");
                                                while ($otherAnnouncement = $otherAnnouncementData->fetch_assoc()) { ?>
                                                    <div class="single-popular-carusel col-lg-3 col-md-6">
                                                        <div class="details">
                                                            <a href="#">
                                                                <h4>
                                                                    <?php echo $otherAnnouncement['header'] ?>
                                                                </h4>
                                                            </a>
                                                            <div class="d-flex mb-3">
                                                                <small class="me-3"><i class="far fa-user text-primary me-2"></i><?php echo $otherAnnouncement['author'] ?></small>
                                                                <small><i class="far fa-calendar-alt text-primary me-2"></i><?php echo $otherAnnouncement['date'] ?></small>
                                                            </div>
                                                            <p>
                                                                <?php echo $otherAnnouncement['msg'] ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <div class="title text-center">
                                                    <h1 class="mb-10">NO Announcement</h1>
                                                </div>
                                            <?php }
                                            ?>
                                            <a href="#" class="primary-btn text-uppercase mx-auto" style="width: auto;">View More Announcement</a>
                                        </div>
                                    </div>
                                </section>

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
    <script src="../assets/js/admin/file-upload.js"></script>

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