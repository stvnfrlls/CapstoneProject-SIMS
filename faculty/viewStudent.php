<?php
require_once("../assets/php/server.php");
include('../assets/phpqrcode/qrlib.php');

if (empty($_SESSION['F_number'])) {
    header('Location: ../auth/login.php');
} else {
    if ($_GET['ID']) {
        $studentLink = array();
        $verifySR_number = "SELECT * FROM studentrecord 
                        INNER JOIN guardian
                        ON studentrecord.SR_number = guardian.G_guardianOfStudent
                        WHERE studentrecord.SR_number = '{$_GET['ID']}'";
        $runverifySR_number = $mysqli->query($verifySR_number);
        $getRecord =  $runverifySR_number->fetch_assoc();

        $getSectionInfo = "SELECT * FROM sections WHERE S_adviser = '{$_SESSION['F_number']}'";
        $rungetSectionInfo = $mysqli->query($getSectionInfo);
        $SectionData = $rungetSectionInfo->fetch_assoc();

        $getSectionClassList = "SELECT * FROM studentrecord WHERE SR_section = '{$SectionData['S_name']}'";
        $rungetSectionClassList = $mysqli->query($getSectionClassList);
        while ($ClassListData = $rungetSectionClassList->fetch_assoc()) {
            $studentLink[] = $ClassListData['SR_number'];
        }

        $getStudentNumber = $mysqli->query("SELECT SR_number FROM studentrecord WHERE SR_section = '{$getRecord['SR_section']}' AND SR_number != '{$_GET['ID']}'");

        if ($getRecord['SR_number'] == $_GET['ID']) {
            $tempDir = '../assets/temp/';
            if (!file_exists($tempDir)) {
                mkdir($tempDir);
            }
            $qrcode_data = $getRecord['SR_number'];
            QRcode::png($qrcode_data,  $tempDir . '' . $qrcode_data . '.png', QR_ECLEVEL_L);
        }
    } else {
        header('Location: classlist.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Faculty - Report Card</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/admin/style.css" rel="stylesheet">

</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
        <img class="m-3" href="../index.php" src="../assets/img/logo.png" style="height: 50px; width:400px;" alt="Icon">
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="fa fa-bars"></span>
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
                            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
                                <div class="home-tab">
                                    <div class="d-sm-flex align-items-center justify-content-between">
                                        <div class="section-title text-center position-relative pb-3 mb-3 mx-auto">
                                            <h2 class="fw-bold text-primary text-uppercase">STUDENT PROFILE</h2>
                                        </div>
                                    </div>
                                    <div class="container-xl px-4 mt-4" style="padding-bottom:0px">
                                        <nav class="nav">
                                            <a class="nav-link active ms-0" href="../admin/viewStudent.php" target="__blank" style="color: #c02628;">Profile</a>
                                            <a class="nav-link" href="../faculty/viewCard.php" target="__blank">Grades</a>
                                        </nav>
                                        <div class="border-bottom"></div>
                                    </div>
                                    <div style="text-align:right; margin-top: 15px;">
                                        <div class="col-12">
                                            <?php
                                            $value = $_GET['ID'];
                                            $index = array_search($value, $studentLink);
                                            $previous = null;
                                            $next = null;

                                            if ($index !== false) {
                                                if ($index > 0) {
                                                    $previous = $studentLink[$index - 1];
                                                }
                                                if ($index < count($studentLink) - 1) {
                                                    $next = $studentLink[$index + 1];
                                                }
                                            }
                                            ?>
                                            <a href="viewstudent.php?ID=<?php echo $previous ?>" class="btn btn-primary"><i class="fa fa-angle-double-left"></i>Previous </a>
                                            <a href="viewstudent.php?ID=<?php echo $next ?>" class="btn btn-primary">Next <i class="fa fa-angle-double-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="tab-content tab-content-basic">
                                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                            <div class="row">
                                                <div class="col-lg-3 col-sm-12 grid-margin">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Profile</h4>
                                                            <form class="form-sample">
                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-md-6 col-sm-6 col-lg-12" style="text-align: center; margin-bottom: 20px; margin-top: 10px;">
                                                                        <img src="../assets/img/profile.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-12 grid-margin">
                                                    <div class="card" style="height: 280px;" text-align: center;>
                                                        <div class="card-body">
                                                            <h4 class="card-title">QR Code</h4>
                                                            <form class="form-sample">
                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-md-6 col-sm-6 col-lg-12" style="text-align: center; margin-top: 10px;">
                                                                        <img src="<?php echo "../assets/temp/" . $getRecord['SR_number'] . ".png"; ?>" alt="avatar" class="img-fluid" style="width: 150px;">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 grid-margin">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Class Information</h4>
                                                            <div class="row" style="padding-bottom: 15px;">
                                                                <div class="col-md-6">
                                                                    <label class="col-sm-12 col-form-label">Grade Level</label>
                                                                    <div class="col-sm-12">
                                                                        <select class="form-select form-control" required disabled>
                                                                            <option selected><?php echo $getRecord['SR_grade'] ?></option>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label label class="col-sm-12 col-form-label">Section</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="<?php echo $getRecord['SR_section'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="padding-bottom: 15px;">
                                                                <div class="col-md-6">
                                                                    <label label class="col-sm-12 col-form-label">Schedule</label>
                                                                    <div class="col-sm-12">
                                                                        <select class="form-select form-control" required readonly>
                                                                            <option value="NA">Monday - Friday</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label label class="col-sm-12 col-form-label" style="color:white;"> .</label>
                                                                    <div class="col-sm-12">
                                                                        <select class="form-select form-control" required readonly>
                                                                            <option value="AM">7:00AM-2:00PM</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 grid-margin">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Personal Information</h4>
                                                            <!-- next row -->
                                                            <div class="row" style="padding-bottom: 15px;">
                                                                <div class="col-md-4">
                                                                    <label class="col-sm-12 col-form-label">Last Name</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="<?php echo $getRecord['SR_lname'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-sm-12 col-form-label">First Name</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="<?php echo $getRecord['SR_fname'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="col-sm-12 col-form-label">Middle Name</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="<?php echo $getRecord['SR_mname'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <label class="col-sm-12 col-form-label">Suffix</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="<?php echo $getRecord['SR_suffix'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="padding-bottom: 15px;">
                                                                <div class="col-md-1">
                                                                    <label label class="col-sm-12 col-form-label">Age</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="<?php echo $getRecord['SR_age'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label label class="col-sm-12 col-form-label">Birthdate</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="date" class="form-control fullwidth" id="firstName" value="<?php echo $getRecord['SR_birthday'] ?>" required readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label label class="col-sm-12 col-form-label">Birthplace</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="<?php echo $getRecord['SR_birthplace'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label label class="col-sm-12 col-form-label">Gender</label>
                                                                    <div class="col-sm-12">
                                                                        <select class="form-select form-control" required readonly>
                                                                            <option selected><?php echo $getRecord['SR_gender'] ?></option>
                                                                            <option value="Male">Male</option>
                                                                            <option value="Female">Female</option>
                                                                            <option value="NA">Prefer not to say</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="padding-bottom: 15px;">
                                                                <div class="col-md-4">
                                                                    <label class="col-sm-12 col-form-label">Religion</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="<?php echo $getRecord['SR_religion'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="col-sm-12 col-form-label">Citizenship</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="<?php echo $getRecord['SR_citizenship'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="padding-bottom: 15px;">
                                                                <h4 class="card-title">Address</h4>
                                                                <div class="col-md-6">
                                                                    <label label class="col-sm-12 col-form-label">Address</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="<?php echo $getRecord['SR_address'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label label class="col-sm-12 col-form-label">Barangay</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="<?php echo $getRecord['SR_barangay'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label label class="col-sm-12 col-form-label">City</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="<?php echo $getRecord['SR_city'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="padding-bottom: 15px;">
                                                                <div class="col-md-4">
                                                                    <label label class="col-sm-12 col-form-label">State</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="<?php echo $getRecord['SR_state'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label label class="col-sm-12 col-form-label">Postal Code</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="<?php echo $getRecord['SR_postal'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label label class="col-sm-12 col-form-label">Email Address</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="<?php echo $getRecord['SR_email'] ?>" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- next row -->
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 grid-margin">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Contact Person</h4>
                                                        <div class="row" style="padding-bottom: 15px;">
                                                            <div class="col-md-4">
                                                                <label class="col-sm-12 col-form-label">Last Name</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_lname" value="<?php echo $getRecord['G_lname'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="col-sm-12 col-form-label">First Name</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_fname" value="<?php echo $getRecord['G_fname'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="col-sm-12 col-form-label">Middle Name</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_mname" value="<?php echo $getRecord['G_mname'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="col-sm-12 col-form-label">Suffix</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_suffix" value="<?php echo $getRecord['G_suffix'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="padding-bottom: 15px;">
                                                            <div class="col-md-6">
                                                                <label label class="col-sm-12 col-form-label">Address</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_address" value="<?php echo $getRecord['G_address'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label label class="col-sm-12 col-form-label">Barangay</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_barangay" value="<?php echo $getRecord['G_barangay'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label label class="col-sm-12 col-form-label">City</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_city" value="<?php echo $getRecord['G_city'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="padding-bottom: 15px;">
                                                            <div class="col-md-4">
                                                                <label label class="col-sm-12 col-form-label">State</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_state" value="<?php echo $getRecord['G_state'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label label class="col-sm-12 col-form-label">Postal Code</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_postal" value="<?php echo $getRecord['G_postal'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label label class="col-sm-12 col-form-label">Email Address</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_email" value="<?php echo $getRecord['G_email'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="padding-bottom: 15px;">
                                                            <div class="col-md-4">
                                                                <label label class="col-sm-12 col-form-label">Relationship to Student</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_relationshipStudent" value="<?php echo $getRecord['G_relationshipStudent'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label label class="col-sm-12 col-form-label">Telephone Number</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_telephone" value="<?php echo $getRecord['G_telephone'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label label class="col-sm-12 col-form-label">Contact Number</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control" name="G_contact" value="<?php echo $getRecord['G_contact'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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

</body>

</html>