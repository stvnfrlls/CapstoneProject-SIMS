<?php
require_once("../assets/php/server.php");

if (!isset($_SESSION['F_number'])) {
    header('Location: ../auth/login.php');
} else {
    $SR_numberArray = array();
    $SR_numberData = $mysqli->query('SELECT SR_lname FROM studentrecord');

    while ($SR_number = $SR_numberData->fetch_assoc()) {
        $SR_numberArray[] = $SR_number;
    }

    $array = array_column($SR_numberArray, 'SR_lname');
    $SR_numberJSON = json_encode($array);
    echo "<script>var sr_numbers = " . $SR_numberJSON . ";</script>";

    $gradeList = "SELECT DISTINCT S_yearLevel FROM sections WHERE acadYear = '{$currentSchoolYear}'";
    $rungradeList = $mysqli->query($gradeList);

    if (isset($_GET['Grade'])) {
        $sectionList = "SELECT DISTINCT(S_name) FROM sections WHERE S_yearLevel = '{$_GET['Grade']}' AND acadYear = '{$currentSchoolYear}'";
        $runsectionList = $mysqli->query($sectionList);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Daily Reports</title>
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
                            <div class="home-tab">
                                <div class="d-sm-flex align-items-center justify-content-between">
                                    <div class="section-title text-center position-relative pb-3 mb-3 mx-auto">
                                        <h2 class="fw-bold text-primary text-uppercase">Daily Reports</h2>
                                    </div>
                                </div>
                                <div class="container-xl px-4 mt-4" style="padding-bottom:0px">
                                    <nav class="nav">
                                        <a class="nav-link active ms-0" href="dailyReports.php" style="color: #c02628;">Daily</a>
                                        <a class="nav-link" href="monthlyReports.php" >Monthly</a>
                                    </nav>
                                    <div class="border-bottom"></div>
                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">

                                        <!--    <div class="row">
                                            <form action="" method="post">
                                                <div class="col-12 grid-margin autocomplete">
                                                    <div class="row">
                                                        <div class="col-lg-4" style="margin: auto; text-align:center;">
                                                            <label class="col-sm-12 col-form-label">Student Number</label>
                                                            <style>
                                                                /*the container must be positioned relative:*/
                                                                .autocomplete {
                                                                    position: relative;
                                                                    display: inline-block;
                                                                }

                                                                input {
                                                                    border: 1px solid transparent;
                                                                    background-color: #f1f1f1;
                                                                    padding: 10px;
                                                                    font-size: 16px;
                                                                }

                                                                input[type=text] {
                                                                    background-color: #f1f1f1;
                                                                    width: 100%;
                                                                }

                                                                input[type=submit] {
                                                                    background-color: DodgerBlue;
                                                                    color: #fff;
                                                                    cursor: pointer;
                                                                }

                                                                .autocomplete-items {
                                                                    position: absolute;
                                                                    border: 1px solid #d4d4d4;
                                                                    border-bottom: none;
                                                                    border-top: none;
                                                                    z-index: 99;
                                                                    /*position the autocomplete items to be the same width as the container:*/
                                                                    top: 100%;
                                                                    left: 0;
                                                                    right: 0;
                                                                }

                                                                .autocomplete-items div {
                                                                    padding: 10px;
                                                                    cursor: pointer;
                                                                    background-color: #fff;
                                                                    border-bottom: 1px solid #d4d4d4;
                                                                }

                                                                /*when hovering an item:*/
                                                                .autocomplete-items div:hover {
                                                                    background-color: #e9e9e9;
                                                                }

                                                                /*when navigating through the items using the arrow keys:*/
                                                                .autocomplete-active {
                                                                    background-color: DodgerBlue !important;
                                                                    color: #ffffff;
                                                                }
                                                            </style>
                                                            <div class="col-sm-12">
                                                                <input id="myInput" type="text" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="text-align: center; padding-top: 0px;">
                                                    <input type="button" style="color:#ffffff;" class="btn btn-primary me-2" name="findStudent" value="Enter">
                                                </div>
                                            </form>
                                        </div>

                                                            -->

                                        <div class="btn-group">
                                            <div>
                                                <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <?php
                                                    if (isset($_GET['Grade'])) {
                                                        if ($_GET['Grade'] == "KINDER") {
                                                            echo  $_GET['Grade'];
                                                        } else {
                                                            echo  "Grade " . $_GET['Grade'];
                                                        }
                                                    } else {
                                                        echo "Grade ";
                                                    }
                                                    ?>
                                                    <i class="fa fa-caret-down"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <?php
                                                    while ($gradeData = $rungradeList->fetch_assoc()) { ?>
                                                        <a class="dropdown-item" href="dailyReports.php?Grade=<?php echo $gradeData['S_yearLevel'] ?>">
                                                            <?php
                                                            echo "Grade " . $gradeData['S_yearLevel'];
                                                            ?>
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <?php
                                            if (isset($_GET['Grade'])) { ?>
                                                <div>
                                                    <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <?php if (isset($_GET['Section'])) {
                                                            echo $_GET['Section'];
                                                        } else {
                                                            echo "Section";
                                                        }
                                                        ?>
                                                        <i class="fa fa-caret-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <?php
                                                        while ($sectionData = $runsectionList->fetch_assoc()) { ?>
                                                            <a class="dropdown-item" href="dailyReports.php?Grade=<?php echo $_GET['Grade'] . "&Section=" . $sectionData['S_name']; ?>">
                                                                <?php
                                                                echo $sectionData['S_name'];
                                                                ?>
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="btn-group">
                                            <div>
                                                <input type="date" class="form-control" name="date" value="">
                                            </div>
                                        </div>
                                        <?php
                                        if (isset($_GET['Grade']) && isset($_GET['Section'])) { ?>
                                            <div class="btn-group" style="float: right;">
                                                <a href="../reports/DailyAttendancebyClass.php?Grade=<?php echo $_GET['Grade'] . "&Section=" . $_GET['Section']; ?>" style="background-color: #e4e3e3; margin-right: 0px;" class="btn btn-secondary">Print <i class="fa fa-print" style="font-size: 12px; align-self:center;"></i></a>
                                            </div>
                                        <?php }
                                        ?>
                                        <div class="row" style="margin-top: 15px;">
                                            <div class="col-lg-12 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12">
                                                        <div class="">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>No.</th>
                                                                            <th>Name</th>
                                                                            <th>Time In</th>
                                                                            <th>Time Out</th>
                                                                            <th>Fetched by</th>
                                                                            <th>Remarks</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <style>
                                                                            input[type='number'] {
                                                                                width: 50px;
                                                                            }

                                                                            /* Chrome, Safari, Edge, Opera */
                                                                            input::-webkit-outer-spin-button,
                                                                            input::-webkit-inner-spin-button {
                                                                                -webkit-appearance: none;
                                                                                margin: 0;
                                                                            }

                                                                            .tabledata {
                                                                                border: 1px solid #ffffff;
                                                                                text-align: center;
                                                                                vertical-align: middle;
                                                                                height: 30px;
                                                                                color: #000000;
                                                                            }
                                                                        </style>
                                                                        <?php
                                                                        $rowCount = 1;
                                                                        $dateNow = date("Y-m-d");
                                                                        if (isset($_GET['Grade']) && isset($_GET['Section'])) {
                                                                            $getDailyAttendanceData = $mysqli->query("SELECT DISTINCT SR_lname, SR_fname, SR_mname, SR_suffix, attendance.SR_number, attendance.A_time_IN, attendance.A_time_OUT, attendance.A_fetcher_OUT, attendance.A_status 
                                                                            FROM attendance 
                                                                            LEFT JOIN studentrecord ON attendance.SR_number = studentrecord.SR_number 
                                                                            WHERE acadYear = '{$currentSchoolYear}' 
                                                                            AND SR_section = '{$_GET['Section']}' 
                                                                            AND SR_grade = '{$_GET['Grade']}'
                                                                            AND A_date = '{$dateNow}'");
                                                                            if (mysqli_num_rows($getDailyAttendanceData) > 0) {
                                                                                while ($AttendanceData = $getDailyAttendanceData->fetch_assoc()) { ?>
                                                                                    <tr>
                                                                                        <td class="tabledata"><?php echo $rowCount; ?></td>
                                                                                        <td class="tabledata"><?php echo $AttendanceData['SR_lname'] .  ", " . $AttendanceData['SR_fname'] . " " . substr($AttendanceData['SR_mname'], 0, 1) . ". " . $AttendanceData['SR_suffix']; ?></td>
                                                                                        <td class="tabledata"><?php echo $AttendanceData['A_time_IN']; ?></td>
                                                                                        <td class="tabledata"><?php echo $AttendanceData['A_time_OUT']; ?></td>
                                                                                        <td class="tabledata"><?php echo $AttendanceData['A_fetcher_OUT']; ?></td>
                                                                                        <td class="tabledata"><?php echo $AttendanceData['A_status']; ?></td>
                                                                                    </tr>
                                                                                <?php $rowCount++;
                                                                                }
                                                                            } else { ?>
                                                                                <tr>
                                                                                    <td colspan="6" class="tabledata">NO ATTENDANCE TODAY <?php echo $dateNow ?></td>
                                                                                </tr>
                                                                            <?php }
                                                                        } else { ?>
                                                                            <tr>
                                                                                <td colspan="6" class="tabledata">Select grade level and section first</td>
                                                                            </tr>
                                                                        <?php }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
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
    <script>
        function autocomplete(inp, arr) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function(e) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }

        /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("myInput"), sr_numbers);
    </script>

    < !--Template Javascript-->
        <script src="../assets/js/main.js"></script>
        <script src="../assets/js/admin/vendor.bundle.base.js"></script>
        <script src="../assets/js/admin/off-canvas.js"></script>
</body>

</html>