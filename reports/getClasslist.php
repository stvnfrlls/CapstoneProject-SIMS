<?php
ob_start();
require '../assets/fpdf/fpdf.php';
require_once("../assets/php/server.php");

$envFile = file_get_contents('../.env');

$envVariables = explode("\n", $envFile);
foreach ($envVariables as $envVariable) {
    $envVariable = trim($envVariable);
    if (!empty($envVariable) && strpos($envVariable, '=') !== false) {
        list($key, $value) = explode('=', $envVariable, 2);
        $_ENV[$key] = $value;
        putenv("$key=$value");
    }
}

if (isset($_GET['GradeLevel'])) {
    class PDF extends FPDF
    {
        function Header()
        {
            $mysqli = new mysqli($_ENV['DB_HOST'], getenv('DB_USER'), $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
            $getAcadYear = $mysqli->query("SELECT * FROM acad_year");
            $acadYear_Data = $getAcadYear->fetch_assoc();
            //Logo Image
            $this->Image('../assets/img/favicon.png', 50, 15, 20, 20);
            // Select Arial bold 15
            $this->SetFont('Arial', '', 7);
            $this->Cell(70);
            $this->Cell(45, 3, 'Republic of the Philippines', 0, 2, 'C');

            $this->SetFont('Arial', 'B', 8);
            $this->Cell(70, 0, '', 0, 2);
            $this->Cell(45, 5, 'DEPARTMENT OF EDUCATION', 0, 2, 'C');

            $this->SetFont('Arial', '', 7);
            $this->Cell(70, 0, '', 0, 2);
            $this->Cell(45, 3, 'Division of Laguna - Region IV - A', 0, 2, 'C');

            $this->Ln(3);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(70, 0, '', 0,);
            $this->Cell(45, 5, 'COLEGIO DE SAN PEDRO, INC.', 0, 1, 'C');

            $this->SetFont('Arial', '', 7);
            $this->Cell(70, 0, '', 0,);
            $this->Cell(45, 3, 'Phase 1A, Pacita Complex I, San Pedro City, Laguna', 0, 2, 'C');

            $this->SetFont('Arial', 'B', 7);
            $this->Cell(45, 3, 'PROGRESS REPORT CARD', 0, 2, 'C');

            $this->SetFont('Arial', '', 7);

            if (isset($_GET['SY'])) {
                $this->Cell(45, 3, 'School Year: ' . $_GET['SY'], 0, 2, 'C');
            } else {
                $this->Cell(45, 3, 'School Year: ' . $acadYear_Data['currentYear'] . " - " . $acadYear_Data['endYear'], 0, 2, 'C');
            }
            // Line break
            $this->Ln(5);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(190, 10, 'Section Classlist', 0, 0, 'C');
            $this->Ln(15);
        }
        function Footer()
        {
            // Go to 1.5 cm from bottom
            $this->SetY(-15);
            // Select Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Print centered page number
            $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
        }
    }

    $pdf = new PDF('P', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(true, 20);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(50, 10, 'Student Number', 1, 0, 'C');
    $pdf->Cell(90, 10, 'Student Name', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Grade and Section', 1, 1, 'C');
    if (isset($_GET['SY'])) {
        $ClasslistData = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number IN (SELECT SR_number FROM classlist WHERE acadYear = '{$_GET['SY']}') ORDER BY SR_lname");
    } elseif (isset($_GET['SY']) && isset($_GET['GradeLevel']) && !isset($_GET['section'])) {
        $ClasslistData = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number IN (SELECT SR_number FROM classlist WHERE SR_grade = '{$_GET['GradeLevel']}' AND acadYear = '{$_GET['SY']}') ORDER BY SR_lname");
    } elseif (isset($_GET['SY']) && isset($_GET['GradeLevel']) && isset($_GET['section'])) {
        $ClasslistData = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number IN (SELECT SR_number FROM classlist WHERE SR_grade = '{$_GET['GradeLevel']}' AND SR_section = '{$_GET['section']}' AND acadYear = '{$_GET['SY']}') ORDER BY SR_lname");
    } elseif (!isset($_GET['SY'])) {
        $ClasslistData = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number IN (SELECT SR_number FROM classlist WHERE acadYear = '{$currentSchoolYear}') ORDER BY SR_lname");
    } elseif (!isset($_GET['SY']) && isset($_GET['GradeLevel']) && !isset($_GET['section'])) {
        $ClasslistData = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number IN (SELECT SR_number FROM classlist WHERE SR_grade = '{$_GET['GradeLevel']}' AND acadYear = '{$currentSchoolYear}') ORDER BY SR_lname");
    } elseif (!isset($_GET['SY']) && isset($_GET['GradeLevel']) && isset($_GET['section'])) {
        $ClasslistData = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number IN (SELECT SR_number FROM classlist WHERE SR_grade = '{$_GET['GradeLevel']}' AND SR_section = '{$_GET['section']}' AND acadYear = '{$currentSchoolYear}') ORDER BY SR_lname");
    } else {
        $ClasslistData = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number IN (SELECT SR_number FROM classlist WHERE SR_grade = '{$_GET['GradeLevel']}' AND SR_section = '{$_GET['section']}' AND acadYear = '{$currentSchoolYear}') ORDER BY SR_lname");
    }

    while ($classlist = $ClasslistData->fetch_assoc()) {

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, $classlist['SR_number'], 1, 0, 'C');
        if (isset($_GET['SY'])) {
            $getStudentInfo = $mysqli->query("SELECT studentrecord.SR_lname, studentrecord.SR_fname, studentrecord.SR_mname, studentrecord.SR_suffix, classlist.SR_grade, classlist.SR_section FROM studentrecord JOIN classlist ON studentrecord.SR_number = classlist.SR_number WHERE classlist.acadYear = '{$_GET['SY']}' AND studentrecord.SR_number = '{$classlist['SR_number']}'");
        } else {
            $getStudentInfo = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$classlist['SR_number']}'");
        }
        $studentInfo = $getStudentInfo->fetch_assoc();
        if (!empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] != "" && empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] = "") {
            $studentName = $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . substr($studentInfo['SR_mname'], 0, 1) . ".";
        } else if (empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] = "" && !empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] != "") {
            $studentName = $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . $studentInfo['SR_suffix'];
        } else if (empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] = "" && empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] = "") {
            $studentName = $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'];
        }
        $pdf->Cell(90, 10,  mb_convert_encoding($studentName, "ISO-8859-1", "UTF-8"), 1, 0, 'C');
        if (isset($_GET['SY'])) {
            if ($studentInfo['SR_grade'] == "KINDER") {
                $pdf->Cell(50, 10, "Grade " . $studentInfo['SR_grade'] . " - " . $studentInfo['SR_section'], 1, 1, 'C');
            } else {
                $pdf->Cell(50, 10, "Grade " . $studentInfo['SR_grade'] . " - " . $studentInfo['SR_section'], 1, 1, 'C');
            }
        } else {
            if ($classlist['SR_grade'] == "KINDER") {
                $pdf->Cell(50, 10, "Grade " . $classlist['SR_grade'] . " - " . $classlist['SR_section'], 1, 1, 'C');
            } else {
                $pdf->Cell(50, 10, "Grade " . $classlist['SR_grade'] . " - " . $classlist['SR_section'], 1, 1, 'C');
            }
        }
    }

    ob_end_clean();
    if (isset($_GET['GradeLevel'])) {
        $pdf->Output('I', "Classlist - " . $_GET['GradeLevel'] . '.pdf');
    } else if (isset($_GET['section']) && isset($_GET['section'])) {
        $pdf->Output('I', "Classlist - " . $_GET['GradeLevel'] . " - " . $_GET['section'] . '.pdf');
    }
} elseif (isset($_GET['allstudent']) && isset($_SESSION['AD_number'])) {
    class PDF extends FPDF
    {
        function Header()
        {
            $mysqli = new mysqli("localhost", "u952901270_admin2311", "Eleven.11", "u952901270_sforms_cdsp");
            $getAcadYear = $mysqli->query("SELECT * FROM acad_year");
            $acadYear_Data = $getAcadYear->fetch_assoc();
            //Logo Image
            $this->Image('../assets/img/favicon.png', 50, 15, 20, 20);
            // Select Arial bold 15
            $this->SetFont('Arial', '', 7);
            $this->Cell(70);
            $this->Cell(45, 3, 'Republic of the Philippines', 0, 2, 'C');

            $this->SetFont('Arial', 'B', 8);
            $this->Cell(70, 0, '', 0, 2);
            $this->Cell(45, 5, 'DEPARTMENT OF EDUCATION', 0, 2, 'C');

            $this->SetFont('Arial', '', 7);
            $this->Cell(70, 0, '', 0, 2);
            $this->Cell(45, 3, 'Division of Laguna - Region IV - A', 0, 2, 'C');

            $this->Ln(3);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(70, 0, '', 0,);
            $this->Cell(45, 5, 'COLEGIO DE SAN PEDRO, INC.', 0, 1, 'C');

            $this->SetFont('Arial', '', 7);
            $this->Cell(70, 0, '', 0,);
            $this->Cell(45, 3, 'Phase 1A, Pacita Complex I, San Pedro City, Laguna', 0, 2, 'C');

            $this->SetFont('Arial', 'B', 7);
            $this->Cell(45, 3, 'PROGRESS REPORT CARD', 0, 2, 'C');

            $this->SetFont('Arial', '', 7);

            if (isset($_GET['SY'])) {
                $this->Cell(45, 3, 'School Year: ' . $_GET['SY'], 0, 2, 'C');
            } else {
                $this->Cell(45, 3, 'School Year: ' . $acadYear_Data['currentYear'] . " - " . $acadYear_Data['endYear'], 0, 2, 'C');
            }
            // Line break
            $this->Ln(5);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(190, 10, 'Section Classlist', 0, 0, 'C');
            $this->Ln(15);
        }
        function Footer()
        {
            // Go to 1.5 cm from bottom
            $this->SetY(-15);
            // Select Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Print centered page number
            $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
        }
    }

    $pdf = new PDF('P', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(true, 20);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(50, 10, 'Student Number', 1, 0, 'C');
    $pdf->Cell(90, 10, 'Student Name', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Grade and Section', 1, 1, 'C');

    if (isset($_GET['SY'])) {
        $ClasslistData = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number IN (SELECT SR_number FROM classlist WHERE acadYear = '{$_GET['SY']}') ORDER BY SR_grade, SR_lname");
    } else {
        $ClasslistData = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number IN (SELECT SR_number FROM classlist WHERE acadYear = '{$currentSchoolYear}') ORDER BY SR_grade, SR_lname");
    }


    while ($classlist = $ClasslistData->fetch_assoc()) {

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, $classlist['SR_number'], 1, 0, 'C');
        $getStudentInfo = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$classlist['SR_number']}'");
        $studentInfo = $getStudentInfo->fetch_assoc();
        if (!empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] != "" && empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] = "") {
            $studentName = $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . substr($studentInfo['SR_mname'], 0, 1) . ".";
        } else if (empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] = "" && !empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] != "") {
            $studentName = $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . $studentInfo['SR_suffix'];
        } else if (empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] = "" && empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] = "") {
            $studentName = $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'];
        }
        $pdf->Cell(90, 10,  mb_convert_encoding($studentName, "ISO-8859-1", "UTF-8"), 1, 0, 'C');
        $pdf->Cell(50, 10, "Grade " . $classlist['SR_grade'] . " - " . $classlist['SR_section'], 1, 1, 'C');
    }

    ob_end_clean();
    $pdf->Output('I', "Student Population - " . $currentSchoolYear . '.pdf');
}
