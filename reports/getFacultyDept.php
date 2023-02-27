<?php
require '../assets/fpdf/fpdf.php';
require_once("../assets/php/server.php");

if (isset($_GET['department'])) {
    class PDF extends FPDF
    {
        function Header()
        {
            $mysqli = new mysqli("localhost", "u952901270_admin0326", "giTG^W3y", "u952901270_sis_cdsp");
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
            $this->Cell(190, 10, 'Classlist', 0, 0, 'C');
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
    $pdf->Cell(50, 10, 'Faculty Number', 1, 0, 'C');
    $pdf->Cell(90, 10, 'Teacher Name', 1, 0, 'C');
    $pdf->Cell(50, 10, 'Department', 1, 1, 'C');

    $FacultyDeptData = $mysqli->query("SELECT * FROM faculty WHERE F_department = '{$_GET['department']}'");
    while ($FacultyDept = $FacultyDeptData->fetch_assoc()) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, $FacultyDept['F_number'], 1, 0, 'C');
        $pdf->Cell(90, 10, $FacultyDept['F_lname'] .  ", " . $FacultyDept['F_fname'] . " " . substr($FacultyDept['F_mname'], 0, 1) . ". " . $FacultyDept['F_suffix'], 1, 0, 'C');
        $pdf->Cell(50, 10, $FacultyDept['F_department'] . " Department", 1, 1, 'C');
    }

    $pdf->Output();
}
