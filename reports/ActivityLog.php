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

if (isset($_GET['start_date']) && isset($_GET['end_date'])) {

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
    // Set the column widths
    $column_widths = array(40, 40, 110);

    // Output the table header
    $pdf->Cell($column_widths[0], 10, 'Name', 1, 0, 'C');
    $pdf->Cell($column_widths[1], 10, 'Date', 1, 0, 'C');
    $pdf->Cell($column_widths[2], 10, 'Action', 1, 1, 'C');

    // Query the database
    $LoggedData = $mysqli->query("SELECT * FROM admin_logs WHERE logDate BETWEEN '{$_GET['start_date']}' AND '{$_GET['end_date']}'");

    // Output the table data
    while ($Log = $LoggedData->fetch_assoc()) {
        $pdf->SetFont('Arial', '', 10);

        // Output the name column
        $pdf->Cell($column_widths[0], 10, $Log['AD_name'], 1, 0, 'C');

        // Output the date column
        $pdf->Cell($column_widths[1], 10, date('m-d-Y h:i A', strtotime($Log['logDate'])), 1, 0, 'C');

        // Output the action column
        $pdf->MultiCell($column_widths[2], 10, $Log['AD_action'], 1, 'C');
    }

    ob_end_clean();
    $pdf->Output('I', "Activity Log - " . $_GET['start_date'] . " - " . $_GET['end_date'] . '.pdf');
}
