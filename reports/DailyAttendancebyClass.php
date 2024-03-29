<?php
ob_start();
require '../assets/fpdf/fpdf.php';
require_once("../assets/php/server.php");

if (isset($_GET['Grade']) || isset($_GET['Section'])) {
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

    $pdf = new PDF('P', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(true, 20);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(70, 10, 'Student Name', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Date', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Timed In', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Timed Out', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Status', 1, 1, 'C');

    if (!empty($_GET['Grade']) && !empty($_GET['Section'])) {
        $dateNow = date("Y-m-d");
        $getAttendance = $mysqli->query("SELECT * FROM attendance LEFT JOIN studentrecord ON attendance.SR_number = studentrecord.SR_number 
        WHERE acadYear = '{$currentSchoolYear}' 
        AND SR_section = '{$_GET['Section']}' 
        AND SR_grade = '{$_GET['Grade']}'
        AND A_date = '{$dateNow}'");
    }


    $pdf->SetFont('Arial', '', 9);
    if (mysqli_num_rows($getAttendance) > 0) {
        while ($attendance = $getAttendance->fetch_assoc()) {
            if (!empty($attendance['SR_mname']) || $attendance['SR_mname'] != "" && empty($attendance['SR_suffix']) || $attendance['SR_suffix'] = "") {
                $studentName = $attendance['SR_lname'] .  ", " . $attendance['SR_fname'] . " " . substr($attendance['SR_mname'], 0, 1) . ".";
            } else if (empty($attendance['SR_mname']) || $attendance['SR_mname'] = "" && !empty($attendance['SR_suffix']) || $attendance['SR_suffix'] != "") {
                $studentName = $attendance['SR_lname'] .  ", " . $attendance['SR_fname'] . " " . $attendance['SR_suffix'];
            } else if (empty($attendance['SR_mname']) || $attendance['SR_mname'] = "" && empty($attendance['SR_suffix']) || $attendance['SR_suffix'] = "") {
                $studentName = $attendance['SR_lname'] .  ", " . $attendance['SR_fname'];
            }
            $pdf->Cell(70, 10, $studentName, 1, 0, 'C');
            $pdf->Cell(30, 10, date('m-d-Y', strtotime($attendance['A_date'])), 1, 0, 'C');
            $pdf->Cell(30, 10, $attendance['A_time_IN'], 1, 0, 'C');
            $pdf->Cell(30, 10, $attendance['A_time_OUT'], 1, 0, 'C');
            $pdf->Cell(30, 10, $attendance['A_status'], 1, 1, 'C');
        }
    } else {
        $pdf->Cell(190, 15, "NO DATA AVAILABLE", 1, 0, 'C');
    }

    ob_end_clean();
    $pdf->Output('I', "Daily Attendance - (" . $_GET['Grade'] . "-" . $_GET['Section'] . ")" . '.pdf');
}
