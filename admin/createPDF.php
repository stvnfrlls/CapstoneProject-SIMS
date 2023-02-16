<?php
require '../assets/fpdf/fpdf.php';

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
        $this->Cell(70, 0, '', 0, );
        $this->Cell(45, 5, 'COLEGIO DE SAN PEDRO, INC.', 0, 1, 'C');

        $this->SetFont('Arial', '', 7);
        $this->Cell(70, 0, '', 0, );
        $this->Cell(45, 3, 'Phase 1A, Pacita Complex I, San Pedro City, Laguna', 0, 2, 'C');

        $this->SetFont('Arial', 'B', 7);
        $this->Cell(45, 3, 'PROGRESS REPORT CARD', 0, 2, 'C');

        $this->SetFont('Arial', '', 7);
        $this->Cell(45, 3, 'School Year: ####-####', 0, 2, 'C');
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

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(12, 10, 'Name:');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(90, 8, 'Student Name', 'B', '', 'C');
$pdf->Cell(3, 10, '', 0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(9, 10, 'Age:');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 8, 'AGE', 'B', '', 'C');
$pdf->Cell(3, 10, '', 0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(15, 10, 'Gender:');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(43, 8, '######', 'B', '', 'C');
$pdf->Cell(3, 10, '', 0, 1);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(24, 10, 'Grade/Section:');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 8, 'Grade/Section', 'B', '', 'C');
$pdf->Cell(3, 10, '', 0);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(14, 10, 'Adviser:');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(70, 8, 'ADVISER', 'B', '', 'C');

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(10, 10, 'LRN:');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(39, 8, '#####-#####-#####', 'B', '', 'C');

$pdf->Ln(15);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(70, 20, 'Learning Areas', 1, 0, 'C');
$pdf->Cell(60, 10, 'Periodic Rating', 1, 2, 'C');
$pdf->Cell(15, 10, '1st', 1, 0, 'C');
$pdf->Cell(15, 10, '2nd', 1, 0, 'C');
$pdf->Cell(15, 10, '3rd', 1, 0, 'C');
$pdf->Cell(15, 10, '4th', 1, 0, 'C');
$pdf->SetXY(140, 68); //baguhin pag may header na
$pdf->Cell(30, 20, 'Final Rating', 1, 0, 'C');
$pdf->Cell(30, 20, 'Remarks', 1, 1, 'C');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(70, 10, 'Subject Name', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(30, 10, '##', 1, 0, 'C');
$pdf->Cell(30, 10, 'Passed', 1, 1, 'C');

$pdf->Cell(70, 10, 'Subject Name', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(30, 10, '##', 1, 0, 'C');
$pdf->Cell(30, 10, 'Passed', 1, 1, 'C');

$pdf->Cell(70, 10, 'Subject Name', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(30, 10, '##', 1, 0, 'C');
$pdf->Cell(30, 10, 'Passed', 1, 1, 'C');

$pdf->Cell(70, 10, 'Subject Name', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(30, 10, '##', 1, 0, 'C');
$pdf->Cell(30, 10, 'Passed', 1, 1, 'C');

$pdf->Cell(70, 10, 'Subject Name', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(30, 10, '##', 1, 0, 'C');
$pdf->Cell(30, 10, 'Passed', 1, 1, 'C');

$pdf->Cell(70, 10, 'Subject Name', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(30, 10, '##', 1, 0, 'C');
$pdf->Cell(30, 10, 'Passed', 1, 1, 'C');

$pdf->Cell(70, 10, 'Learning Modality', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(15, 10, '##', 1, 0, 'C');
$pdf->Cell(60, 10, '', 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(130, 10, 'GENERAL AVERAGE', 1, 0, 'C');
$pdf->Cell(30, 10, '##', 1, 0, 'C');
$pdf->Cell(30, 10, 'PASSED', 1, 1, 'C');

$pdf->Ln(5);

$pdf->Cell(70, 10, 'MODE OF LEARNING', 0, 1);
$pdf->Cell(55, 10, 'Marking', 1, 0, 'C');
$pdf->Cell(45, 10, 'OL', 1, 0, 'C');
$pdf->Cell(45, 10, 'ML', 1, 0, 'C');
$pdf->Cell(45, 10, 'BL', 1, 1, 'C');
$pdf->Cell(55, 10, 'Description', 1, 0, 'C');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(45, 10, 'Online Learning', 1, 0, 'C');
$pdf->Cell(45, 10, 'Modular Learning', 1, 0, 'C');
$pdf->Cell(45, 10, 'Blended Learning', 1, 1, 'C');

$pdf->Ln(100);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(190, 10, 'Character Building', 0, 1, 'C');
$pdf->Cell(55, 20, 'Core Values', 1, 0, 'C');
$pdf->Cell(70, 20, 'Behavior Statement', 1, 0, 'C');
$pdf->Cell(60, 10, 'Periodic Rating', 1, 2, 'C');
$pdf->Cell(15, 10, '1st', 1, 0, 'C');
$pdf->Cell(15, 10, '2nd', 1, 0, 'C');
$pdf->Cell(15, 10, '3rd', 1, 0, 'C');
$pdf->Cell(15, 10, '4th', 1, 1, 'C');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(5, 20, '1', 1, 0, 'C');
$pdf->Cell(50, 20, 'Maka-Diyos', 1, 0, 'C');
$pdf->Cell(70, 20, '##', 1, 0, 'C');
$pdf->Cell(15, 20, '##', 1, 0, 'C');
$pdf->Cell(15, 20, '##', 1, 0, 'C');
$pdf->Cell(15, 20, '##', 1, 0, 'C');
$pdf->Cell(15, 20, '##', 1, 1, 'C');

$pdf->Cell(5, 20, '2', 1, 0, 'C');
$pdf->Cell(50, 20, 'Maka-Tao', 1, 0, 'C');
$pdf->Cell(70, 20, '##', 1, 0, 'C');
$pdf->Cell(15, 20, '##', 1, 0, 'C');
$pdf->Cell(15, 20, '##', 1, 0, 'C');
$pdf->Cell(15, 20, '##', 1, 0, 'C');
$pdf->Cell(15, 20, '##', 1, 1, 'C');

$pdf->Cell(5, 20, '3', 1, 0, 'C');
$pdf->Cell(50, 20, 'Makalikasan', 1, 0, 'C');
$pdf->Cell(70, 20, '##', 1, 0, 'C');
$pdf->Cell(15, 20, '##', 1, 0, 'C');
$pdf->Cell(15, 20, '##', 1, 0, 'C');
$pdf->Cell(15, 20, '##', 1, 0, 'C');
$pdf->Cell(15, 20, '##', 1, 1, 'C');

$pdf->Cell(5, 20, '4', 1, 0, 'C');
$pdf->Cell(50, 20, 'Makabansa', 1, 0, 'C');
$pdf->Cell(70, 20, '##', 1, 0, 'C');
$pdf->Cell(15, 20, '##', 1, 0, 'C');
$pdf->Cell(15, 20, '##', 1, 0, 'C');
$pdf->Cell(15, 20, '##', 1, 0, 'C');
$pdf->Cell(15, 20, '##', 1, 1, 'C');

$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(65, 10, 'Marking', 1, 0, 'C');
$pdf->Cell(30, 10, 'AO', 1, 0, 'C');
$pdf->Cell(30, 10, 'SO', 1, 0, 'C');
$pdf->Cell(30, 10, 'RO', 1, 0, 'C');
$pdf->Cell(30, 10, 'NO', 1, 1, 'C');
$pdf->Cell(65, 20, 'NON-NUMERICAL RATING', 1, 0, 'C');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 10, 'Always', 'L,T,R', 2, 'C');
$pdf->Cell(30, 10, 'Observed', 'L,B,R', 0, 'C');

$pdf->SetXY(105, 168);
$pdf->Cell(30, 10, 'Sometimes', 'L,T,R', 2, 'C');
$pdf->Cell(30, 10, 'Observed', 'L,B,R', 0, 'C');

$pdf->SetXY(135, 168);
$pdf->Cell(30, 10, 'Rarely', 'L,T,R', 2, 'C');
$pdf->Cell(30, 10, 'Observed', 'L,B,R', 0, 'C');

$pdf->SetXY(165, 168);
$pdf->Cell(30, 10, 'Not', 'L,T,R', 2, 'C');
$pdf->Cell(30, 10, 'Observed', 'L,B,R', 1, 'C');

$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(190, 10, 'Attendance Record', 0, 1);
$pdf->Cell(65, 5, '', 1, 0, 'C');

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(10, 5, 'SEP', 1, 0, 'C');
$pdf->Cell(10, 5, 'OCT', 1, 0, 'C');
$pdf->Cell(10, 5, 'NOV', 1, 0, 'C');
$pdf->Cell(10, 5, 'DEC', 1, 0, 'C');
$pdf->Cell(10, 5, 'JAN', 1, 0, 'C');
$pdf->Cell(10, 5, 'FEB', 1, 0, 'C');
$pdf->Cell(10, 5, 'MAR', 1, 0, 'C');
$pdf->Cell(10, 5, 'APR', 1, 0, 'C');
$pdf->Cell(10, 5, 'MAY', 1, 0, 'C');
$pdf->Cell(10, 5, 'JUN', 1, 0, 'C');
$pdf->Cell(20, 5, 'TOTAL', 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(65, 5, 'No. of School Days', 1, 0, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(20, 5, '##', 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(65, 5, 'No. of Days Present', 1, 0, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(20, 5, '##', 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(65, 5, 'No. of Days Absent', 1, 0, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(10, 5, '##', 1, 0, 'C');
$pdf->Cell(20, 5, '##', 1, 1, 'C');

$pdf->Output();
