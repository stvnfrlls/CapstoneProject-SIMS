<?php
require '../assets/fpdf/fpdf.php';
require_once("../assets/php/server.php");

if (isset($_GET['month']) && isset($_GET['Grade']) && isset($_GET['Section'])) {
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
            $this->Cell(190, 10,  strtoupper($_GET['month']) . ' ATTENDANCE REPORT', 0, 0, 'C');
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
    $pdf->Cell(30, 10, 'School Days', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Days Present', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Days Absent', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Days Tardy', 1, 1, 'C');

    $getMonthlyAttendanceData = $mysqli->query("SELECT DISTINCT SR_lname, SR_fname, SR_mname, SR_suffix, attendance.SR_number 
                                                FROM attendance 
                                                LEFT JOIN studentrecord ON attendance.SR_number = studentrecord.SR_number 
                                                WHERE acadYear = '{$currentSchoolYear}' 
                                                AND SR_section = '{$_GET['Section']}' 
                                                AND SR_grade = '{$_GET['Grade']}'
                                                AND MONTHNAME(A_date) = '{$_GET['month']}'");

    $month = date_parse($_GET['month'])['month'];
    $year = date("Y");

    $first_day = new DateTime("$year-$month-01");
    $num_days = $first_day->format('t');
    $count_weekdays = 0;
    for ($day = 1; $day <= $num_days; $day++) {
        $date = new DateTime("$year-$month-$day");
        if ($date->format('N') <= 5) {
            $count_weekdays++;
        }
    }

    if (mysqli_num_rows($getMonthlyAttendanceData) > 0) {
        while ($AttendanceData = $getMonthlyAttendanceData->fetch_assoc()) {
            $PRESENT = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$AttendanceData['SR_number']}' AND MONTHNAME(A_date) = '{$_GET['month']}' AND acadYear = '{$currentSchoolYear}'");
            $PRESENTvalue = $PRESENT->fetch_assoc();

            $ABSENT = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$AttendanceData['SR_number']}' AND MONTHNAME(A_date) = '{$_GET['month']}' AND acadYear = '{$currentSchoolYear}' AND A_status = 'ABSENT'");
            $ABSENTvalue = $ABSENT->fetch_assoc();

            $TARDY = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$AttendanceData['SR_number']}' AND MONTHNAME(A_date) = '{$_GET['month']}' AND acadYear = '{$currentSchoolYear}' AND A_status = 'TARDY'");
            $TARDYvalue = $TARDY->fetch_assoc();
            
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(70, 10, $AttendanceData['SR_lname'] .  ", " . $AttendanceData['SR_fname'] . " " . substr($AttendanceData['SR_mname'], 0, 1) . ". " . $AttendanceData['SR_suffix'], 1, 0, 'C');
            $pdf->Cell(30, 10, $count_weekdays, 1, 0, 'C');
            $pdf->Cell(30, 10, $PRESENTvalue['COUNT(A_time_IN)'], 1, 0, 'C');
            $pdf->Cell(30, 10, $ABSENTvalue['COUNT(A_time_IN)'], 1, 0, 'C');
            $pdf->Cell(30, 10, $TARDYvalue['COUNT(A_time_IN)'], 1, 1, 'C');
        }
    } else {
        $pdf->Cell(190, 20, 'No Data', 1, 1, 'C');
    }

    $pdf->Output();
}
