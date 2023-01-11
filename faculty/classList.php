<?php
require_once("../assets/php/server.php");

$current_url = $_SERVER["REQUEST_URI"];

$_SESSION['F_number'] = "2022-12-00001-F";

if (empty($_SESSION['F_number'])) {
  header('Location: ../auth/login.php');
} else if (isset($_SESSION['F_number'])) {
  $getWorkSchedule = "SELECT SR_grade, SR_section, S_subject FROM workschedule WHERE F_number = '{$_SESSION['F_number']}'";
  $rungetWorkSchedule = $mysqli->query($getWorkSchedule);
  $array_GradeSection = array();
  array_unshift($array_GradeSection, null);

  while ($dataWorkSchedule = $rungetWorkSchedule->fetch_assoc()) {
    $array_GradeSection[] = $dataWorkSchedule;
  }
} else {
  header('Location: ../auth/login.php');
}

?>

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
            <a class="nav-link" href="../faculty/viewReminders.php">
              <i class=""></i>
              <span class="menu-title">View Reminders</span>
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
                    <h2 class="fw-bold text-primary text-uppercase">Class List</h2>
                  </div>
                </div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                      <div class="col-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <div class="dropdown" style="margin-bottom: 30px;">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <?php
                                if (isset($_GET['Grade']) && isset($_GET['Section'])) {
                                  echo "Grade " . $_GET['Grade'] . " - " . $_GET['Section'];
                                } else {
                                  echo "Grade and Section";
                                }
                                ?>

                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <?php
                                $rowCount = 1;
                                $GradeSectionRowCount = sizeof($array_GradeSection);
                                while ($rowCount != $GradeSectionRowCount) { ?>
                                  <a class="dropdown-item" href="<?php echo "classList.php?Grade=" . $array_GradeSection[$rowCount]['SR_grade'] . "&Section=" . $array_GradeSection[$rowCount]['SR_section']; ?>">
                                    <?php echo "Grade " . $array_GradeSection[$rowCount]['SR_grade'] . "-" . $array_GradeSection[$rowCount]['SR_section']; ?>
                                  </a>
                                <?php $rowCount++;
                                }
                                ?>
                              </div>
                              <div class="tb_search">
                                <input class="search" type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="  Search...." class="form-control">
                              </div>
                            </div>

                            <div class="table-responsive">
                              <table class="table table-striped table-class" id="table-id">
                                <thead>
                                  <tr>
                                    <th scope="col">Student Number</th>
                                    <th scope="col">Student Name</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <form action="<?php $_SERVER["PHP_SELF"] ?>" method="GET">
                                    <?php
                                    $value = array();
                                    $rowCount = 1;
                                    $GradeSectionRowCount = sizeof($array_GradeSection);
                                    while ($rowCount != $GradeSectionRowCount) {
                                      $value[] = $array_GradeSection[$rowCount]['SR_grade'];
                                      $rowCount++;
                                    }
                                    if (!isset($_GET['Grade']) && !isset($_GET['Section'])) {
                                      $getAllClassList = "SELECT * FROM studentrecord WHERE SR_grade IN (" . implode(", ", $value) . ")";
                                      $rungetAllClassList = $mysqli->query($getAllClassList);
                                      while ($dataAllClassList = $rungetAllClassList->fetch_assoc()) { ?>
                                        <tr>
                                          <td><?php echo $dataAllClassList['SR_number'] . " - " . $dataAllClassList['SR_section'] ?></td>
                                          <td>
                                            <a href="classList.php?SR_Number=<?php echo $dataCladataAllClassListssList['SR_number'] ?>">
                                              <?php echo $dataAllClassList['SR_lname'] . ", " . $dataAllClassList['SR_fname'] . " " . substr($dataAllClassList['SR_mname'], 0, 1); ?>
                                            </a>
                                          </td>
                                        </tr>
                                      <?php }
                                    } else {
                                      $getClassList = "SELECT * FROM studentrecord WHERE SR_grade = '{$_GET['Grade']}'";
                                      $rungetClassList = $mysqli->query($getClassList);
                                      while ($dataClassList = $rungetClassList->fetch_assoc()) { ?>
                                        <tr>
                                          <td><?php echo $dataClassList['SR_number'] ?></td>
                                          <td>
                                            <!-- palitan to ng katulad nung sa advisory page kung may idadagdag na page -->
                                            <a href="classList.php?SR_Number=<?php echo $dataClassList['SR_number'] ?>">
                                              <?php echo $dataClassList['SR_lname'] . ", " . $dataClassList['SR_fname'] . " " . substr($dataClassList['SR_mname'], 0, 1); ?>
                                            </a>
                                          </td>
                                        </tr>
                                    <?php }
                                    }
                                    ?>
                                  </form>
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
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

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


  <!-- Template Javascript -->
  <script src="../assets/js/main.js"></script>

  <script src="../assets/js/admin/vendor.bundle.base.js"></script>
  <script src="../assets/js/admin/off-canvas.js"></script>
  <script src="../assets/js/admin/file-upload.js"></script>
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
      $('table tr:eq(0)').prepend('<th style="border-color: #e4e3e3;"> No. </th>')

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