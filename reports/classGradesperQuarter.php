<?php
ob_start();
require '../assets/fpdf/fpdf.php';
require_once("../assets/php/server.php");

class PDF extends FPDF
{
    function Header()
    {
        $mysqli = new mysqli("localhost", "root", "", "sis_cdsp");
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
$pdf->setAutoPageBreak(true, 0);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190, 15, 'ENCODED GRADES FOR ' . strtoupper($_GET['subject']), '', 1, 'C');


$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(70, 20, 'Student Name', 1, 0, 'C');
$pdf->Cell(60, 10, 'Periodic Rating', 1, 2, 'C');
$pdf->Cell(15, 10, '1st', 1, 0, 'C');
$pdf->Cell(15, 10, '2nd', 1, 0, 'C');
$pdf->Cell(15, 10, '3rd', 1, 0, 'C');
$pdf->Cell(15, 10, '4th', 1, 0, 'C');
$pdf->SetXY(140, 58);
$pdf->Cell(30, 20, 'Final Rating', 1, 0, 'C');
$pdf->Cell(30, 20, 'Remarks', 1, 1, 'C');

$pdf->SetFont('Arial', '', 9);
$getGradesPerSubject = $mysqli->query("SELECT * FROM studentrecord 
                                    LEFT JOIN grades 
                                    ON studentrecord.SR_number = grades.SR_number 
                                    WHERE grades.SR_gradeLevel = '{$_GET['grade']}' 
                                    AND grades.SR_section = '{$_GET['section']}' 
                                    AND grades.G_learningArea = '{$_GET['subject']}' 
                                    ORDER BY studentrecord.SR_lname;");
if (mysqli_num_rows($getGradesPerSubject) > 0) {
    while ($GradesPerSubject = $getGradesPerSubject->fetch_assoc()) {
        $getstudentInfo = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$GradesPerSubject['SR_number']}'");
        $studentInfo = $getstudentInfo->fetch_assoc();

        if (!empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] != "" && empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] = "") {
            $Student_Fullname = $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . substr($studentInfo['SR_mname'], 0, 1) . ".";
        } else if (empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] = "" && !empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] != "") {
            $Student_Fullname = $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . $studentInfo['SR_suffix'];
        } else if (empty($studentInfo['SR_mname']) || $studentInfo['SR_mname'] = "" && empty($studentInfo['SR_suffix']) || $studentInfo['SR_suffix'] = "") {
            $Student_Fullname = $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'];
        }

        $pdf->Cell(70, 10, $Student_Fullname, 1, 0, 'C');
        $pdf->Cell(15, 10, $GradesPerSubject['G_gradesQ1'], 1, 0, 'C');
        $pdf->Cell(15, 10, $GradesPerSubject['G_gradesQ2'], 1, 0, 'C');
        $pdf->Cell(15, 10, $GradesPerSubject['G_gradesQ3'], 1, 0, 'C');
        $pdf->Cell(15, 10, $GradesPerSubject['G_gradesQ4'], 1, 0, 'C');
        $pdf->Cell(30, 10, $GradesPerSubject['G_finalgrade'], 1, 0, 'C');
        if ($GradesPerSubject['G_finalgrade'] < 75) {
            $finalgradeRemarks = "FAILED";
        } else {
            $finalgradeRemarks = "PASSED";
        }
        $pdf->Cell(30, 10, $finalgradeRemarks, 1, 1, 'C');
    }
}


ob_end_clean();
// $pdf->Output();
$pdf->Output();
