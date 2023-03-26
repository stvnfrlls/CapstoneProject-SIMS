<?php
ob_start();
require '../assets/fpdf/fpdf.php';
require_once("../assets/php/server.php");

if (isset($_GET['start_date']) && isset($_GET['end_date'])) {

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

            $this->Cell(45, 3, 'School Year: ' . $acadYear_Data['currentYear'] . " - " . $acadYear_Data['endYear'], 0, 2, 'C');
            // Line break
            $this->Ln(5);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(190, 10, 'Logged Details', 0, 0, 'C');
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
    $pdf->Cell(40, 10, 'Account Name', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Date Time', 1, 0, 'C');
    $pdf->Cell(110, 10, 'Action', 1, 1, 'C');

    $LoggedData = $mysqli->query("SELECT * FROM admin_logs WHERE logDate BETWEEN '{$_GET['start_date']}' AND '{$_GET['end_date']}'");
    while ($Log = $LoggedData->fetch_assoc()) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(40, 10, $Log['AD_name'], 1, 0, 'C');
        $pdf->Cell(40, 10, date('m-d-Y H:i A', strtotime($Log['logDate'])), 1, 0, 'C');
        $pdf->Cell(110, 10, $Log['AD_action'], 1, 1, 'C');
    }

    ob_end_clean();
    $pdf->Output('I', "Activity Log - " . $_GET['start_date'] . " - " . $_GET['end_date'] . '.pdf');
}
