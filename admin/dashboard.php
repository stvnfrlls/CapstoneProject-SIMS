<?php
require_once("../assets/php/server.php");

if (empty($_SESSION['AD_number'])) {
    header('Location: ../auth/login.php');
} else {
    $quarterArray = array();
    $quarterStatus = $mysqli->query('SELECT quarterTag, quarterStatus FROM quartertable');
    while ($quarterData = $quarterStatus->fetch_assoc()) {
        $quarterArray[] = $quarterData;
    }
    $getAcadYear = $mysqli->query("SELECT * FROM acad_year");
    $acadYear_Data = $getAcadYear->fetch_assoc();
    $_SESSION['academicYear'] = $acadYear_Data['currentYear'] . " - " . $acadYear_Data['endYear'];

    if (isset($_POST['acadyear'])) {
        $currentDate = new DateTime();
        $currentMonth = $currentDate->format('m');
        $startYear = "";
        $endYear = "";

        if ($currentMonth >= 9 && $currentMonth <= 12) {
            // September to December
            $startYear = $currentDate->format('Y');
            $endYear = $currentDate->format('Y') + 1;
        } else {
            // January to August
            $startYear = $currentDate->format('Y') - 1;
            $endYear = $currentDate->format('Y');
        }

        if ($getAcadYear->num_rows <= 0) {
            //insert portion
            $createAcadYear = $mysqli->query("INSERT INTO acad_year(currentYear, endYear) VALUES ('{$startYear}', '{$endYear}')");
            $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
            header("Refresh:0");
        } elseif ($getAcadYear->num_rows == 1) {
            //update portion
            $startYear = $acadYear_Data['endYear'];
            $endYear = (int) $startYear + 1;

            $updateAcadYear = $mysqli->query("UPDATE acad_year SET currentYear = '{$startYear}', endYear = '{$endYear}'");
            $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
            header("Refresh:0");
        }
    }
    if (isset($_POST['Open'])) {
        $enableForms = $mysqli->query('UPDATE quartertable SET quarterStatus = "enabled" WHERE quarterTag = "FORMS"');
        $enableCurrentQuarter = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "enabled" WHERE quarterStatus = "current"');
        header("Refresh:0");
    }

    if (isset($_POST['Close'])) {
        $disableForms = $mysqli->query('UPDATE quartertable SET quarterStatus = "disabled" WHERE quarterTag = "FORMS"');
        $disableCurrentQuarter = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled" WHERE quarterStatus = "current"');
        header("Refresh:0");
    }

    if (isset($_POST['enableFirst'])) {
        $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
        $enableFirst = $mysqli->query('UPDATE quartertable SET quarterStatus = "current" WHERE quarterTag = "1"');
        header("Refresh:0");
    }
    if (isset($_POST['enableSecond'])) {
        $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
        $enableSecond = $mysqli->query('UPDATE quartertable SET quarterStatus = "current" WHERE quarterTag = "2"');
        header("Refresh:0");
    }
    if (isset($_POST['enableThird'])) {
        $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
        $enableThird = $mysqli->query('UPDATE quartertable SET quarterStatus = "current" WHERE quarterTag = "3"');
        header("Refresh:0");
    }
    if (isset($_POST['enableFourth'])) {
        $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
        $enableFourth = $mysqli->query('UPDATE quartertable SET quarterStatus = "current" WHERE quarterTag = "4"');
        header("Refresh:0");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Administrator - Dashboard</title>
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
                                <div class="d-sm-flex border-bottom">
                                    <div class="section-title position-relative">
                                        <h2 class="dashboard">Hi, Camile!</h2>
                                    </div>
                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <div class="col-12 grid-margin">
                                                <form id="form-id" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                                                    <?php
                                                    echo '<button type="submit" name="acadyear" class="btn btn-primary m-2">Acad Year: ' . $_SESSION['academicYear'] . '</button>';

                                                    if ($quarterArray[0]['quarterStatus'] == 'enabled') {
                                                        echo '<button type="submit" name="Close" class="btn btn-primary m-2">Close Encoding of Grades</button>';
                                                    } else {
                                                        echo '<button type="submit" name="Open" class="btn btn-secondary m-2">Open</button>';
                                                    }

                                                    if ($quarterArray[1]['quarterTag'] == 1 && $quarterArray[1]['quarterStatus'] == 'current') {
                                                        echo '<button class="btn btn-primary m-2">1st Quarter (CURRENT)</button>';
                                                    } else {
                                                        echo '<button type="submit" name="enableFirst" class="btn btn-secondary m-2">Enable 1st Quarter</button>';
                                                    }

                                                    if ($quarterArray[2]['quarterTag'] == 2 && $quarterArray[2]['quarterStatus'] == 'current') {
                                                        echo '<button class="btn btn-primary m-2">2nd Quarter (CURRENT)</button>';
                                                    } else {
                                                        echo '<button type="submit" name="enableSecond" class="btn btn-secondary m-2">Enable 2nd Quarter</button>';
                                                    }

                                                    if ($quarterArray[3]['quarterTag'] == 3 && $quarterArray[3]['quarterStatus'] == 'current') {
                                                        echo '<button class="btn btn-primary m-2">3rd Quarter (CURRENT)</button>';
                                                    } else {
                                                        echo '<button type="submit" name="enableThird" class="btn btn-secondary m-2">Enable 3rd Quarter</button>';
                                                    }

                                                    if ($quarterArray[4]['quarterTag'] == 4 && $quarterArray[4]['quarterStatus'] == 'current') {
                                                        echo '<button class="btn btn-primary m-2">4th Quarter (CURRENT)</button>';
                                                    } else {
                                                        echo '<button type="submit" name="enableFourth" class="btn btn-secondary m-2">Enable 4th Quarter</button>';
                                                    }
                                                    ?>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-5 grid-margin" style="padding-bottom:20px;">
                                                <div class="card" style="background-image: url('../assets/img/banner_2.png'); background-size:cover; ">
                                                    <div class="card-body">
                                                        <div class="row">

                                                            <div class="col-12" style="align-self: center; text-align:center;">

                                                                <p style="margin-bottom: 8px;">2019-00188-SP-0</p>
                                                                <p style="margin-bottom: 8px;">Grade 1 - Chrysanthemum</p>
                                                                <h3 style="font-size:22px;">Welcome to Colegio De San Pedro</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-3 grid-margin" style="padding-bottom:20px;">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <img src="../assets/img/profile.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 100px;">
                                                            </div>
                                                            <div class="col-8">
                                                                <h3 style="margin-left: auto;">Students</h3>
                                                                <div class="d-flex flex-shrink-0">
                                                                    <h1 class="display-1 mb-n2" data-toggle="counter-up" style="font-size:30px; color:#c02628; margin-left: auto;">25</h1>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-3 grid-margin" style="padding-bottom:20px;">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <img src="../assets/img/profile.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 100px;">
                                                            </div>
                                                            <div class="col-8" style="align-self: center;">
                                                                <h3>Teachers</h3>
                                                                <div class="d-flex flex-shrink-0 align-items-center justify-content-center">
                                                                    <h1 class="display-1 mb-n2" data-toggle="counter-up" style="font-size:30px; color:#c02628;">25</h1>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h4 class="card-title">Address</h4>
                                            <div class="row">
                                                <div class="col-lg-12 d-flex flex-column">
                                                    <div class="row flex-grow">
                                                        <div class="col-sm-12 col-lg-8 grid-margin">
                                                            <div class="">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <style>
                                                                                .tablestyle {
                                                                                    border: 1px solid #ffffff;
                                                                                    text-align: center;
                                                                                    vertical-align: middle;
                                                                                    height: 30px;
                                                                                    color: #000000;
                                                                                }
                                                                            </style>
                                                                            <tr>
                                                                                <th class="tablestyle">No.</th>
                                                                                <th class="tablestyle">Student Number</th>
                                                                                <th class="tablestyle">Grades and Section</th>
                                                                                <th class="tablestyle">Student Name</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                            <tr>
                                                                                <td class="tablestyle">1</td>
                                                                                <td class="tablestyle">2019-00188-SP-0</td>
                                                                                <td class="tablestyle">Grade 1 Chrysanthemum</td>
                                                                                <td class="tablestyle">Camille Anne G. Sabile</a></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="tablestyle">1</td>
                                                                                <td class="tablestyle">2019-00188-SP-0</td>
                                                                                <td class="tablestyle">Grade 1 Chrysanthemum</td>
                                                                                <td class="tablestyle">Camille Anne G. Sabile</a></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="tablestyle">1</td>
                                                                                <td class="tablestyle">2019-00188-SP-0</td>
                                                                                <td class="tablestyle">Grade 1 Chrysanthemum</td>
                                                                                <td class="tablestyle">Camille Anne G. Sabile</a></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="tablestyle">1</td>
                                                                                <td class="tablestyle">2019-00188-SP-0</td>
                                                                                <td class="tablestyle">Grade 1 Chrysanthemum</td>
                                                                                <td class="tablestyle">Camille Anne G. Sabile</a></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="tablestyle">1</td>
                                                                                <td class="tablestyle">2019-00188-SP-0</td>
                                                                                <td class="tablestyle">Grade 1 Chrysanthemum</td>
                                                                                <td class="tablestyle">Camille Anne G. Sabile</a></td>
                                                                            </tr>

                                                                        </tbody>
                                                                    </table>

                                                                </div>
                                                                <section class="popular-courses-area courses-page">
                                                                    <div style="text-align: center;">
                                                                        <a href="#" class="primary-btn text-uppercase" style="width: auto;">View More Announcements</a>
                                                                    </div>
                                                                </section>
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

</body>


<script>
    const form = document.getElementById('form-id');

    form.addEventListener('submit', (event) => {
        if (confirm('Are you sure you want to do this action?') == true) {
            form.submit();
            return true;
        } else {
            event.preventDefault();
            return false;
        }
    });
</script>

</html>