<?php require_once("../assets/php/server.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Faculty - Class List</title>
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

    <div class="container">
        <div class="header_wrap">
            <div class="num_rows">

                <div class="form-group">
                    <select class="form-control" name="state" id="maxRows">
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="70">70</option>
                        <option value="100">100</option>
                        <option value="5000">Show All</option>
                    </select>
                </div>
            </div>
            <div class="tb_search">
                <input class="search" type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search...." class="form-control">
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <?php
                    $getStudent = ("SELECT * FROM studentrecord WHERE SR_grade = 1");
                    $res = $mysqli->query($getStudent);
                    if ($res->num_rows >= 0) {
                        $counter = 0;
                        while ($data = $res->fetch_assoc()) { ?>
                            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="GET">
                                <div class="list-group w-auto">
                                    <div class="list-group-item list-group-item-action d-flex gap-3 py-3">
                                        <?php $counter++;
                                        echo $counter; ?>
                                        <div class="d-flex gap-2 w-100 justify-content-between">
                                            <div>
                                                <h6 class="mb-0"><input type="submit" name="ST_number" value="<?php echo $data['SR_number']; ?>"></h6>
                                                <p class="mb-0 opacity-75"><?php echo $data['SR_lname']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    <?php
                        }
                    }
                    ?>
                </div>
                <div class="col m-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-class" id="table-id">
                            <thead>
                                <tr>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Assignment</th>
                                    <th scope="col">Quiz</th>
                                    <th scope="col">Performances</th>
                                    <th scope="col">Examinations</th>
                                    <th scope="col">Final Grade</th>
                                    <th scope="col">Edit</th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="GET">
                                    <tr>
                                        <?php
                                        if (isset($_GET['ST_number'])) {
                                            $ST_number = $_GET['ST_number'];

                                            $getStudentGrades = "SELECT * FROM grades WHERE SR_number = '$ST_number'";
                                            $result = $mysqli->query($getStudentGrades);

                                            if ($result->num_rows >= 0) {
                                                while ($data = $result->fetch_assoc()) { ?>
                                                    <th scope="row"><?php echo $data['G_grading'] ?></th>
                                                    <td><input type="text" value="<?php echo $data['G_english'] ?>" size="1"></td>
                                                    <td><input type="text" value="<?php echo $data['G_math'] ?>" size="1"></td>
                                                    <td><input type="text" value="<?php echo $data['G_science'] ?>" size="1"></td>
                                                    <td><input type="text" value="<?php echo $data['G_physicaled'] ?>" size="1"></td>
                                                    <td><input type="text" value="<?php echo $data['G_finalgrade'] ?>" size="1"></td>
                                                    <td><a class="btn btn-success btn-sm btn-icon-text mr-3" href="">Edit<i class="typcn typcn-edit btn-icon-append"></i></a></td>

                                            <?php
                                                }
                                            }
                                        } else { ?>
                                            <th class="text-center" colspan="7">No data</th>
                                        <?php
                                        }
                                        ?>

                                    </tr>
                                    <tr>
                                        <td colspan="7"><input type="submit" value="submit"></td>
                                    </tr>
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div> <!-- End of Container -->

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

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

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
    <script>
        getPagination('#table-id');
        $('#maxRows').trigger('change');

        function getPagination(table) {

            $('#maxRows').on('change', function() {
                $('.pagination').html(''); // reset pagination div
                var trnum = 0; // reset tr counter 
                var maxRows = parseInt($(this).val()); // get Max Rows from select option

                var totalRows = $(table + ' tbody tr').length; // numbers of rows 
                $(table + ' tr:gt(0)').each(function() { // each TR in  table and not the header
                    trnum++; // Start Counter 
                    if (trnum > maxRows) { // if tr number gt maxRows

                        $(this).hide(); // fade it out 
                    }
                    if (trnum <= maxRows) {
                        $(this).show();
                    } // else fade in Important in case if it ..
                }); //  was fade out to fade it in 
                if (totalRows > maxRows) { // if tr total rows gt max rows option
                    var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..  
                    //	numbers of pages 
                    for (var i = 1; i <= pagenum;) { // for each page append pagination li 
                        $('.pagination').append('<li data-page="' + i + '">\
								      <span>' + i++ + '<span class="sr-only">(current)</span></span>\
								    </li>').show();
                    } // end for i 


                } // end if row count > max rows
                $('.pagination li:first-child').addClass('active'); // add active class to the first li 


                //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT
                showig_rows_count(maxRows, 1, totalRows);
                //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT

                $('.pagination li').on('click', function(e) { // on click each page
                    e.preventDefault();
                    var pageNum = $(this).attr('data-page'); // get it's number
                    var trIndex = 0; // reset tr counter
                    $('.pagination li').removeClass('active'); // remove active class from all li 
                    $(this).addClass('active'); // add active class to the clicked 


                    //SHOWING ROWS NUMBER OUT OF TOTAL
                    showig_rows_count(maxRows, pageNum, totalRows);
                    //SHOWING ROWS NUMBER OUT OF TOTAL



                    $(table + ' tr:gt(0)').each(function() { // each tr in table not the header
                        trIndex++; // tr index counter 
                        // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
                        if (trIndex > (maxRows * pageNum) || trIndex <= ((maxRows * pageNum) - maxRows)) {
                            $(this).hide();
                        } else {
                            $(this).show();
                        } //else fade in 
                    }); // end of for each tr in table
                }); // end of on click pagination list
            });
            // end of on select change 

            // END OF PAGINATION 

        }




        // SI SETTING
        $(function() {
            // Just to append id number for each row  
            default_index();

        });

        //ROWS SHOWING FUNCTION
        function showig_rows_count(maxRows, pageNum, totalRows) {
            //Default rows showing
            var end_index = maxRows * pageNum;
            var start_index = ((maxRows * pageNum) - maxRows) + parseFloat(1);
            var string = 'Showing ' + start_index + ' to ' + end_index + ' of ' + totalRows + ' entries';
            $('.rows_count').html(string);
        }

        // CREATING INDEX
        function default_index() {
            $('table tr:eq(0)').prepend('<th style="border-color: #e4e3e3;"> ID </th>')

            var id = 0;

            $('table tr:gt(0)').each(function() {
                id++
                $(this).prepend('<td>' + id + '</td>');
            });
        }

        // All Table search script
        function FilterkeyWord_all_table() {

            // Count td if you want to search on all table instead of specific column

            var count = $('.table').children('tbody').children('tr:first-child').children('td').length;

            // Declare variables
            var input, filter, table, tr, td, i;
            input = document.getElementById("search_input_all");
            var input_value = document.getElementById("search_input_all").value;
            filter = input.value.toLowerCase();
            if (input_value != '') {
                table = document.getElementById("table-id");
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, and hide those who don't match the search query
                for (i = 1; i < tr.length; i++) {

                    var flag = 0;

                    for (j = 0; j < count; j++) {
                        td = tr[i].getElementsByTagName("td")[j];
                        if (td) {

                            var td_text = td.innerHTML;
                            if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
                                //var td_text = td.innerHTML;  
                                //td.innerHTML = 'shaban';
                                flag = 1;
                            } else {
                                //DO NOTHING
                            }
                        }
                    }
                    if (flag == 1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            } else {
                //RESET TABLE
                $('#maxRows').trigger('change');
            }
        }
    </script>

</body>

</html>