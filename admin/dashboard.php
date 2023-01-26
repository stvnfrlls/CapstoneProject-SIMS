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

    $currentDate = new DateTime();
    $currentMonth = $currentDate->format('m');
    $academicYear = '';

    if ($currentMonth >= 9 && $currentMonth <= 12) {
        // September to December
        $academicYear = $currentDate->format('Y') . '-' . ($currentDate->format('Y') + 1);
    } else {
        // January to August
        $academicYear = ($currentDate->format('Y') - 1) . '-' . $currentDate->format('Y');
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
    <link href="../assets/css/dashboard-user.css" rel="stylesheet">

</head>

<body>
    <a href="addFaculty.php" class="m-2">Register Faculty</a>
    <a href="addStudent.php" class="m-2">Register Student</a>
    <a href="createAdmin.php" class="m-2">Register Admin</a>
    <a href="editfaculty.php" class="m-2">Edit Faculty</a>
    <a href="editstudent.php" class="m-2">Edit Student</a>
    <a href="viewStudent.php" class="m-2">View Student</a>
    <a href="viewFaculty.php" class="m-2">View Faculty</a>
    <br>

    <form id="form-id" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
        <?php
        echo '<button type="submit" name="acadyear" class="btn btn-primary m-2">Acad Year: ' . $academicYear . '</button>';

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
    <br>
    <a href="modifyCurriculum.php" class="m-2">Modify Curriculum</a>
    <a href="editlearningareas.php" class="m-2">Edit Learning Areas</a>
    <a href="assignAdvisory.php" class="m-2">Assign Advisory Class</a>
    <a href="movingUp.php" class="m-2">Moving Up</a>
</body>


<script>
    const form = document.getElementById('form-id');

    form.addEventListener('submit', (event) => {
        if (confirm('Are you sure you want to change quarter?') == true) {
            form.submit();
            return true;
        } else {
            event.preventDefault();
            return false;
        }
    });
</script>

</html>