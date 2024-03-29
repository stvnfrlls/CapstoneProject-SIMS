<?php
ob_start();
require '../assets/fpdf/fpdf.php';
require_once("../assets/php/server.php");

if (isset($_GET['ID']) || isset($_GET['month'])) {
    class PDF extends FPDF
    {
        function Header()
        {
            $mysqli = new mysqli('localhost', 'u395663555_admin2311', 'Eleven.11', 'u395663555_sforms_cdsp');
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
            $this->Cell(45, 3, 'School Year: ' . $acadYear_Data['currentYear'] . " - " . $acadYear_Data['endYear'], 0, 2, 'C');
            // Line break
            $this->Ln(5);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(190, 10, 'ATTENDANCE REPORT', 0, 0, 'C');
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

    $getstudentInfo = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$_GET['ID']}'");
    $studentInfo = $getstudentInfo->fetch_assoc();

    if (!empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] != "" && empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] = "") {
        $Student_Fullname = $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . substr($studentInfo['SR_mname'], 0, 1) . ".";
    } else if (empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] = "" && !empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] != "") {
        $Student_Fullname = $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . $studentInfo['SR_suffix'];
    } else if (empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] = "" && empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] = "") {
        $Student_Fullname = $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'];
    }

    $getSectionInfo = $mysqli->query("SELECT * FROM sections WHERE S_name = '{$studentInfo['SR_section']}'");
    $SectionInfo = $getSectionInfo->fetch_assoc();

    $getAdvisorInfo = $mysqli->query("SELECT * FROM faculty WHERE F_number = '{$SectionInfo['S_adviser']}'");
    $AdvisorInfo = $getAdvisorInfo->fetch_assoc();

    $pdf = new PDF('P', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(true, 20);

    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(30, 10, 'Student Name:', 0, 0, 'C');
    $pdf->Cell(80, 10, $Student_Fullname, 'B', 0, 'C');
    $pdf->Cell(30, 10, 'Date Requested:', 0, 0, 'C');
    $pdf->Cell(50, 10, date('F j, Y'), 'B', 1, 'C',);
    $pdf->Cell(30, 10, 'Grade - Section:', 0, 0, 'C');
    $pdf->Cell(50, 10, $studentInfo['SR_grade'] . " - " . $studentInfo['SR_section'], 'B', 0, 'C',);
    $pdf->Cell(30, 10, 'Adviser:', 0, 0, 'C');
    $pdf->Cell(80, 10, $AdvisorInfo['F_lname'] .  ", " . $AdvisorInfo['F_fname'] . " " . substr($AdvisorInfo['F_mname'], 0, 1) . ". " . $AdvisorInfo['F_suffix'], 'B', 0, 'C',);
    $pdf->Ln(15);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(60, 10, 'DATE', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Timed In', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Timed Out', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Status', 1, 1, 'C');

    if (!empty($_GET['month'])) {
        $getAttendance = $mysqli->query("SELECT * FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = '{$_GET['month']}' ORDER BY A_date");
    } else {
        $getAttendance = $mysqli->query("SELECT * FROM attendance WHERE SR_number = '{$_GET['ID']}' ORDER BY A_date");
    }


    $pdf->SetFont('Arial', '', 9);
    while ($attendance = $getAttendance->fetch_assoc()) {
        $pdf->Cell(60, 10, date("F j, Y", strtotime($attendance['A_date'])), 1, 0, 'C');
        $pdf->Cell(40, 10, $attendance['A_time_IN'], 1, 0, 'C');
        $pdf->Cell(40, 10, $attendance['A_time_OUT'], 1, 0, 'C');
        $pdf->Cell(50, 10, $attendance['A_status'], 1, 0, 'C');
    }

    ob_end_clean();
    // $pdf->Output();
    $pdf->Output('I', "ATTENDANCE REPORT - " . $studentInfo['SR_lname'] . '.pdf');
}
