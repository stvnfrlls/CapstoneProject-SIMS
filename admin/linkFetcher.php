<?php
require_once("../assets/php/server.php");

if (empty($_SESSION['AD_number'])) {
    header('Location: ../auth/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Create Fetcher</title>
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

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="../assets/css/sweetAlert.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/form-style.css" rel="stylesheet">
    <link href="../assets/css/admin/style.css" rel="stylesheet">
    <link href="../assets/css/admin/materialdesignicons.min.css" rel="stylesheet">

</head>

<body>
    <nav class="fixed-top align-items-top">
        <nav class="navbar navbar-expand-lg bg-primary navbar-light py-lg-0 px-lg-5">
            <img class="m-3" href="../index.php" src="../assets/img/logo.png" style="height: 50px; width:300px;" alt="Icon">
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                <span class="fa fa-bars"></span>
            </button>
        </nav>
    </nav>

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
                        <a class="nav-link" href="../admin/auditTrail.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Activity History</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/createAdmin.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Create Admin</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/announcement.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">School Announcements</span>
                        </a>
                    </li>
                    <!-- line 2 -->
                    <li class="nav-item nav-category" style="padding-top: 10px; color:#b9b9b9;">Student Records</li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/addStudent.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Register Student</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/createFetcher.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Register Fetcher</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/student.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Student Information</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/editgrades.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Encode Grades</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/editSection.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Change Student Section</span>
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
                            <span class="menu-title" style="color: #b9b9b9;">Register Faculty</span>
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
                            <span class="menu-title" style="color: #b9b9b9;">Advisory Class Assignment</span>
                        </a>
                    </li>
                    <!-- line 4 -->
                    <li class="nav-item nav-category" style="padding-top: 10px; color:#b9b9b9;">Learning Areas</li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/editlearningareas.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Work Schedule Assignment</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/modifyCurriculum.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Edit Curriculum</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/modifySection.php">
                            <i class=""></i>
                            <span class="menu-title" style="color: #b9b9b9;">Edit Section</span>
                        </a>
                    </li>
                    <!-- line 5 -->
                    <li class="nav-item nav-category" style="padding-top: 10px; color:#b9b9b9;">Attendance Report</li>
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
                        <a class="nav-link" href="../auth/logout.php">
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
                        <form class="form-sample" action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" id="fetcherForm">
                            <div class="col-sm-12">
                                <div class="home-tab">
                                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                        <div class="section-title text-center position-relative pb-3 mb-3 mx-auto">
                                            <h2 class="fw-bold text-primary text-uppercase">Link Fetcher</h2>
                                        </div>
                                    </div>
                                    <div class="tab-content tab-content-basic">
                                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                            <div class="row">
                                                <div class="col-12 grid-margin">
                                                    <div class="card" style="width:70%; margin:auto;">
                                                        <div class="card-body">

                                                            <div class="row" style="padding-bottom: 15px;">
                                                                <div class="col-12">
                                                                    <label class="form-check-label">Have you already registered your fetcher?</label>
                                                                </div>
                                                            </div>

                                                            <div class="row" style="padding-bottom: 15px;">
                                                                <div class="col-md-2">
                                                                    <div class="col-sm-12">
                                                                        <label class="form-check-label" for="option1">
                                                                            <input type="checkbox" class="form-check-input" id="option1" name="Fetcher" onclick="handleCheckboxClick(this)">
                                                                            Yes
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="col-sm-12">
                                                                        <label class="form-check-label" for="option2">
                                                                            <input type="checkbox" class="form-check-input" id="option2" name="NoFetcher" onclick="handleCheckboxClick(this)">
                                                                            No
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="additionalInputs" style="display: none;">
                                                                <?php
                                                                $FetcherData_Array = array();
                                                                $getFetcherList = $mysqli->query("SELECT * FROM fetcher_data");
                                                                while ($FetcherData = $getFetcherList->fetch_assoc()) {
                                                                    $FetcherData_Array[] = $FetcherData;
                                                                }
                                                                $i = 0;
                                                                ?>
                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-12">
                                                                        <label label class="col-sm-12 col-form-label">Fetcher Name </span></label>
                                                                        <div class="col-sm-12">
                                                                            <select id="" class="form-select" name="FTH_option1" required>
                                                                                <option selected></option>
                                                                                <?php
                                                                                $FTH_option1 = 0;
                                                                                if (sizeof($FetcherData_Array) > 0) {
                                                                                    while ($FTH_option1 != sizeof($FetcherData_Array)) { ?>
                                                                                        <option value="<?php echo $FetcherData_Array[$FTH_option1]['FTH_number'] ?>"><?php echo $FetcherData_Array[$FTH_option1]['FTH_name'] ?></option>
                                                                                    <?php $FTH_option1++;
                                                                                    }
                                                                                } else { ?>
                                                                                    <option>No available fetchers yet</option>
                                                                                <?php }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-12">
                                                                        <label label class="col-sm-12 col-form-label">Fetcher Name</span></label>
                                                                        <div class="col-sm-12">
                                                                            <select id="" class="form-select" name="FTH_option3" required>
                                                                                <option selected></option>
                                                                                <?php
                                                                                $FTH_option3 = 0;
                                                                                if (sizeof($FetcherData_Array) > 0) {
                                                                                    while ($FTH_option3 != sizeof($FetcherData_Array)) { ?>
                                                                                        <option value="<?php echo $FetcherData_Array[$FTH_option3]['FTH_number'] ?>"><?php echo $FetcherData_Array[$FTH_option3]['FTH_name'] ?></option>
                                                                                    <?php $FTH_option3++;
                                                                                    }
                                                                                } else { ?>
                                                                                    <option>No available fetchers yet</option>
                                                                                <?php }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-12">
                                                                        <label label class="col-sm-12 col-form-label">Fetcher Name</span></label>
                                                                        <div class="col-sm-12">
                                                                            <select id="" class="form-select" name="FTH_option2" required>
                                                                                <option selected></option>
                                                                                <?php
                                                                                $FTH_option2 = 0;
                                                                                if (sizeof($FetcherData_Array) > 0) {
                                                                                    while ($FTH_option2 != sizeof($FetcherData_Array)) { ?>
                                                                                        <option value="<?php echo $FetcherData_Array[$FTH_option2]['FTH_number'] ?>"><?php echo $FetcherData_Array[$FTH_option2]['FTH_name'] ?></option>
                                                                                    <?php $FTH_option2++;
                                                                                    }
                                                                                } else { ?>
                                                                                    <option>No available fetchers yet</option>
                                                                                <?php }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div style="text-align: center;">
                                                                    <button type="button" class="btn btn-primary me-2">Save</button>
                                                                </div>
                                                            </div>

                                                            <div id="no" style="display: none;">
                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-md-12">
                                                                        <label class="col-sm-12 col-form-label">Full Name</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" name="FTH_name" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-md-12">
                                                                        <label class="col-sm-12 col-form-label">Contact Number</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="tel" class="form-control" name="FTH_contact" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="padding-bottom: 15px;">
                                                                    <div class="col-md-12">
                                                                        <label class="col-sm-12 col-form-label">Email Address</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="email" class="form-control" name="FTH_email">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div style="text-align: center;">
                                                                    <button type="button" class="btn btn-primary me-2" name="createFetcher" id="createFetcher">Create</button>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>

    <script src="../assets/js/admin/vendor.bundle.base.js"></script>
    <script src="../assets/js/admin/off-canvas.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <script>
        const createFetcher = document.getElementById('createFetcher');
        const fetcherForm = document.getElementById('fetcherForm');

        createFetcher.addEventListener('click', function(event) {
            Swal.fire({
                title: 'Are you sure you want to proceed with this action?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: `No`,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Form submitted!',
                        icon: 'success',
                    }).then(() => {
                        fetcherForm.submit();
                    });
                }
            })
        })
    </script>

    <script>
        function handleCheckboxClick(clickedCheckbox) {
            const option1Checkbox = document.getElementById('option1');
            const option2Checkbox = document.getElementById('option2');
            const additionalInputs = document.getElementById('additionalInputs');
            const no = document.getElementById('no');

            if (clickedCheckbox === option1Checkbox) {
                if (clickedCheckbox.checked) {
                    additionalInputs.style.display = 'block';
                    option2Checkbox.checked = false;
                    no.style.display = 'none';
                } else {
                    additionalInputs.style.display = 'none';
                }
            } else if (clickedCheckbox === option2Checkbox) {
                if (clickedCheckbox.checked) {
                    option1Checkbox.checked = false;
                    additionalInputs.style.display = 'none';
                    no.style.display = 'block';
                } else {
                    no.style.display = 'none';
                }
            }
        }
    </script>
</body>

</html>