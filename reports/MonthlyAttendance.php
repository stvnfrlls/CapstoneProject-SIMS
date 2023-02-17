<?php
require '../assets/fpdf/fpdf.php';
require_once("../assets/php/server.php");

class PDF extends FPDF
{
    function Header()
    {
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
        $this->Cell(45, 3, 'School Year: ####-####', 0, 2, 'C');
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

$getstudentInfo = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$_SESSION['SR_number']}'");
$studentInfo = $getstudentInfo->fetch_assoc();

$Student_Fullname = $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . substr($studentInfo['SR_mname'], 0, 1) . ". " . $studentInfo['SR_suffix'];

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
$pdf->Cell(70, 10, 'Month', 1, 0, 'C');
$pdf->Cell(60, 10, 'No. of Days Present', 1, 0, 'C');
$pdf->Cell(60, 10, 'No. of Days Absent', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);

$SEP = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'September'");
$SEPvalue = $SEP->fetch_assoc();
$pdf->Cell(70, 10, 'SEPTEMBER', 1, 0, 'C');
$pdf->Cell(60, 10, $SEPvalue['COUNT(A_time_IN)'], 1, 0, 'C');

$pdf->Cell(60, 10, $SEPvalue['COUNT(A_time_IN)'], 1, 1, 'C');

$OCT = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'October'");
$OCTvalue = $OCT->fetch_assoc();
$pdf->Cell(70, 10, 'OCTOBER', 1, 0, 'C');
$pdf->Cell(60, 10, $OCTvalue['COUNT(A_time_IN)'], 1, 0, 'C');
$pdf->Cell(60, 10, $OCTvalue['COUNT(A_time_IN)'], 1, 1, 'C');

$NOV = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'November'");
$NOVvalue = $NOV->fetch_assoc();
$pdf->Cell(70, 10, 'NOVEMBER', 1, 0, 'C');
$pdf->Cell(60, 10, $NOVvalue['COUNT(A_time_IN)'], 1, 0, 'C');
$pdf->Cell(60, 10, $NOVvalue['COUNT(A_time_IN)'], 1, 1, 'C');

$DEC = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'December'");
$DECvalue = $DEC->fetch_assoc();
$pdf->Cell(70, 10, 'DECEMBER', 1, 0, 'C');
$pdf->Cell(60, 10, $DECvalue['COUNT(A_time_IN)'], 1, 0, 'C');
$pdf->Cell(60, 10, $DECvalue['COUNT(A_time_IN)'], 1, 1, 'C');

$JAN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'January'");
$JANvalue = $JAN->fetch_assoc();
$pdf->Cell(70, 10, 'JANUARY', 1, 0, 'C');
$pdf->Cell(60, 10, $JANvalue['COUNT(A_time_IN)'], 1, 0, 'C');
$pdf->Cell(60, 10, $JANvalue['COUNT(A_time_IN)'], 1, 1, 'C');

$FEB = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'February'");
$FEBvalue = $FEB->fetch_assoc();
$pdf->Cell(70, 10, 'FEBUARY', 1, 0, 'C');
$pdf->Cell(60, 10, $SEPvalue['COUNT(A_time_IN)'], 1, 0, 'C');
$pdf->Cell(60, 10, $SEPvalue['COUNT(A_time_IN)'], 1, 1, 'C');

$MAR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'March'");
$MARvalue = $MAR->fetch_assoc();
$pdf->Cell(70, 10, 'MARCH', 1, 0, 'C');
$pdf->Cell(60, 10, $MARvalue['COUNT(A_time_IN)'], 1, 0, 'C');
$pdf->Cell(60, 10, $MARvalue['COUNT(A_time_IN)'], 1, 1, 'C');

$APR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'April'");
$APRvalue = $APR->fetch_assoc();
$pdf->Cell(70, 10, 'APRIL', 1, 0, 'C');
$pdf->Cell(60, 10, $APRvalue['COUNT(A_time_IN)'], 1, 0, 'C');
$pdf->Cell(60, 10, $APRvalue['COUNT(A_time_IN)'], 1, 1, 'C');

$MAY = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'May'");
$MAYvalue = $MAY->fetch_assoc();
$pdf->Cell(70, 10, 'MAY', 1, 0, 'C');
$pdf->Cell(60, 10, $MAYvalue['COUNT(A_time_IN)'], 1, 0, 'C');
$pdf->Cell(60, 10, $MAYvalue['COUNT(A_time_IN)'], 1, 1, 'C');

$JUN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_SESSION['SR_number']}' AND MONTHNAME(A_date) = 'June'");
$JUNvalue = $JUN->fetch_assoc();
$pdf->Cell(70, 10, 'JUNE', 1, 0, 'C');
$pdf->Cell(60, 10, $JUNvalue['COUNT(A_time_IN)'], 1, 0, 'C');
$pdf->Cell(60, 10, $JUNvalue['COUNT(A_time_IN)'], 1, 1, 'C');

$pdf->Output();
