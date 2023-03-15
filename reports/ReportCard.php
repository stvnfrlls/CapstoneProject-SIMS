<?php
ob_start();
require '../assets/fpdf/fpdf.php';
require_once("../assets/php/server.php");

if (isset($_GET['ID'])) {
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

    $getstudentInfo = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$_GET['ID']}'");
    $studentInfo = $getstudentInfo->fetch_assoc();

    $Student_Fullname = $studentInfo['SR_lname'] .  ", " . $studentInfo['SR_fname'] . " " . substr($studentInfo['SR_mname'], 0, 1) . ". " . $studentInfo['SR_suffix'];

    $getSectionInfo = $mysqli->query("SELECT * FROM sections WHERE S_name = '{$studentInfo['SR_section']}'");
    $SectionInfo = $getSectionInfo->fetch_assoc();

    $getAdvisorInfo = $mysqli->query("SELECT * FROM faculty WHERE F_number = '{$SectionInfo['S_adviser']}'");
    $AdvisorInfo = $getAdvisorInfo->fetch_assoc();

    $pdf = new PDF('P', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->setAutoPageBreak(true, 0);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(12, 10, 'Name:');

    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(90, 8, $Student_Fullname, 'B', '', 'C');
    $pdf->Cell(3, 10, '', 0);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(9, 10, 'Age:');

    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(15, 8, $studentInfo['SR_age'], 'B', '', 'C');
    $pdf->Cell(3, 10, '', 0);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(15, 10, 'Gender:');

    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(43, 8, $studentInfo['SR_gender'], 'B', '', 'C');
    $pdf->Cell(3, 10, '', 0, 1);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(24, 10, 'Grade/Section:');

    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 8, $studentInfo['SR_grade'] . " - " . $studentInfo['SR_section'], 'B', '', 'C');
    $pdf->Cell(3, 10, '', 0);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(14, 10, 'Adviser:');

    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(55, 8, $AdvisorInfo['F_lname'] .  ", " . $AdvisorInfo['F_fname'] . " " . substr($AdvisorInfo['F_mname'], 0, 1) . ". " . $AdvisorInfo['F_suffix'], 'B', '', 'C');

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(10, 10, 'LRN:');

    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(35, 8, $studentInfo['SR_number'], 'B', '', 'C');

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

    $getStudentGrades = $mysqli->query("SELECT * FROM grades WHERE SR_number = '{$_GET['ID']}'");
    if (mysqli_num_rows($getStudentGrades) > 0) {
        while ($studentGrades = $getStudentGrades->fetch_assoc()) {
            $pdf->Cell(70, 10, $studentGrades['G_learningArea'], 1, 0, 'C');
            $pdf->Cell(15, 10, $studentGrades['G_gradesQ1'], 1, 0, 'C');
            $pdf->Cell(15, 10, $studentGrades['G_gradesQ2'], 1, 0, 'C');
            $pdf->Cell(15, 10, $studentGrades['G_gradesQ3'], 1, 0, 'C');
            $pdf->Cell(15, 10, $studentGrades['G_gradesQ4'], 1, 0, 'C');
            $pdf->Cell(30, 10, $studentGrades['G_finalgrade'], 1, 0, 'C');

            if ($studentGrades['G_finalgrade'] < 75) {
                $finalgradeRemarks = "FAILED";
            } else {
                $finalgradeRemarks = "PASSSED";
            }
            $pdf->Cell(30, 10, $finalgradeRemarks, 1, 1, 'C');
        }
    } else {
        if ($studentInfo['SR_grade'] == "KINDER") {
            $yearLevel = 0;
        } else {
            $yearLevel = $studentInfo['SR_grade'];
        }
        $getLearningAreas = $mysqli->query("SELECT * FROM subjectperyear WHERE minYearLevel <= '{$yearLevel}' AND maxYearLevel >= '{$yearLevel}'");
        while ($LearningAreas = $getLearningAreas->fetch_assoc()) {
            $pdf->Cell(70, 10, $LearningAreas['subjectName'], 1, 0, 'C');
            $pdf->Cell(15, 10, '', 1, 0, 'C');
            $pdf->Cell(15, 10, '', 1, 0, 'C');
            $pdf->Cell(15, 10, '', 1, 0, 'C');
            $pdf->Cell(15, 10, '', 1, 0, 'C');
            $pdf->Cell(30, 10, '', 1, 0, 'C');
            $pdf->Cell(30, 10, '', 1, 1, 'C');
        }
    }

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(130, 10, 'GENERAL AVERAGE', 1, 0, 'C');

    $getGradeAve = $mysqli->query("SELECT ROUND(AVG(G_finalgrade)) AS average FROM grades where SR_number = '{$_GET['ID']}'");
    $GradeAve = $getGradeAve->fetch_assoc();

    $pdf->Cell(30, 10, $GradeAve['average'], 1, 0, 'C');
    if ($GradeAve['average'] > 75) {
        $genAveRemarks = "PASSED";
    } else if ($GradeAve['average'] == 0 || empty($GradeAve['average'])) {
        $genAveRemarks = "";
    } else {
        $genAveRemarks = "FAILED";
    }

    $pdf->Cell(30, 10, $genAveRemarks, 1, 1, 'C');

    $pdf->Ln(500);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(190, 10, 'Character Building', 0, 1, 'C');
    $pdf->Cell(30, 20, 'Core Values', 1, 0, 'C');
    $pdf->Cell(120, 20, 'Behavior Statement', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Periodic Rating', 1, 2, 'C');
    $pdf->Cell(10, 10, '1st', 1, 0, 'C');
    $pdf->Cell(10, 10, '2nd', 1, 0, 'C');
    $pdf->Cell(10, 10, '3rd', 1, 0, 'C');
    $pdf->Cell(10, 10, '4th', 1, 1, 'C');

    $pdf->SetFont('Arial', '', 9);
    $getBehaviorData = $mysqli->query("SELECT * FROM behavior where SR_number = '{$_GET['ID']}'");
    $behavior = $getBehaviorData->fetch_assoc();

    $getBehaviorLabels = $mysqli->query("SELECT * FROM behavior_category");
    $arrayLabels = array();
    while ($behaviorLabels = $getBehaviorLabels->fetch_assoc()) {
        $arrayLabels[] = $behaviorLabels;
    }

    $pdf->Cell(30, 30, 'Maka-Diyos', 1, 0, 'C');
    $pdf->Cell(120, 15, 'Expresses one spiritual beliefs while respecting the spiritual beliefs of others.', 1, 0, 'C');
    $getMakaDiyos1 = $mysqli->query("SELECT * FROM behavior WHERE CV_Area = 'Maka-Diyos1' AND SR_number = '{$_GET['ID']}'");
    $MakaDiyos1 = $getMakaDiyos1->fetch_assoc();
    $pdf->Cell(10, 15, $MakaDiyos1['CV_valueQ1'], 1, 0, 'C');
    $pdf->Cell(10, 15, $MakaDiyos1['CV_valueQ2'], 1, 0, 'C');
    $pdf->Cell(10, 15, $MakaDiyos1['CV_valueQ3'], 1, 0, 'C');
    $pdf->Cell(10, 15, $MakaDiyos1['CV_valueQ4'], 1, 1, 'C');
    $pdf->Cell(30, 30, '', 0, 0, 'C');
    $pdf->Cell(120, 15, 'Show adherence to ethical principle by upholding truth.', 1, 0, 'C');
    $getMakaDiyos2 = $mysqli->query("SELECT * FROM behavior WHERE CV_Area = 'Maka-Diyos2' AND SR_number = '{$_GET['ID']}'");
    $MakaDiyos2 = $getMakaDiyos2->fetch_assoc();
    $pdf->Cell(10, 15, $MakaDiyos2['CV_valueQ1'], 1, 0, 'C');
    $pdf->Cell(10, 15, $MakaDiyos2['CV_valueQ2'], 1, 0, 'C');
    $pdf->Cell(10, 15, $MakaDiyos2['CV_valueQ3'], 1, 0, 'C');
    $pdf->Cell(10, 15, $MakaDiyos2['CV_valueQ4'], 1, 1, 'C');

    $pdf->Cell(30, 30, 'Maka-Tao', 1, 0, 'C');
    $pdf->Cell(120, 15, 'Is sensitive to individual, social, and cultural differences.', 1, 0, 'C');
    $getMakatao1 = $mysqli->query("SELECT * FROM behavior WHERE CV_Area = 'Makatao1' AND SR_number = '{$_GET['ID']}'");
    $Makatao1 = $getMakatao1->fetch_assoc();
    $pdf->Cell(10, 15, $Makatao1['CV_valueQ1'], 1, 0, 'C');
    $pdf->Cell(10, 15, $Makatao1['CV_valueQ2'], 1, 0, 'C');
    $pdf->Cell(10, 15, $Makatao1['CV_valueQ3'], 1, 0, 'C');
    $pdf->Cell(10, 15, $Makatao1['CV_valueQ4'], 1, 1, 'C');
    $pdf->Cell(30, 30, '', 0, 0, 'C');
    $pdf->Cell(120, 15, 'Demonstrates contributions toward solidarity.', 1, 0, 'C');
    $getMakatao2 = $mysqli->query("SELECT * FROM behavior WHERE CV_Area = 'Makatao2' AND SR_number = '{$_GET['ID']}'");
    $Makatao2 = $getMakatao2->fetch_assoc();
    $pdf->Cell(10, 15, $Makatao2['CV_valueQ1'], 1, 0, 'C');
    $pdf->Cell(10, 15, $Makatao2['CV_valueQ2'], 1, 0, 'C');
    $pdf->Cell(10, 15, $Makatao2['CV_valueQ3'], 1, 0, 'C');
    $pdf->Cell(10, 15, $Makatao2['CV_valueQ4'], 1, 1, 'C');

    $pdf->Cell(30, 30, 'Makabansa', 1, 0, 'C');
    $pdf->Cell(120, 15, 'Proud and responsible Filipino citizen.', 1, 0, 'C');
    $getMakabansa1 = $mysqli->query("SELECT * FROM behavior WHERE CV_Area = 'Makabansa1' AND SR_number = '{$_GET['ID']}'");
    $Makabansa1 = $getMakabansa1->fetch_assoc();
    $pdf->Cell(10, 15, $Makabansa1['CV_valueQ1'], 1, 0, 'C');
    $pdf->Cell(10, 15, $Makabansa1['CV_valueQ2'], 1, 0, 'C');
    $pdf->Cell(10, 15, $Makabansa1['CV_valueQ3'], 1, 0, 'C');
    $pdf->Cell(10, 15, $Makabansa1['CV_valueQ4'], 1, 1, 'C');
    $pdf->Cell(30, 30, '', 0, 0, 'C');
    $pdf->Cell(120, 15, 'Displays proper conduct in school, community, and nation.', 1, 0, 'C');
    $getMakabansa2 = $mysqli->query("SELECT * FROM behavior WHERE CV_Area = 'Makabansa2' AND SR_number = '{$_GET['ID']}'");
    $Makabansa2 = $getMakabansa2->fetch_assoc();
    $pdf->Cell(10, 15, $Makabansa2['CV_valueQ1'], 1, 0, 'C');
    $pdf->Cell(10, 15, $Makabansa2['CV_valueQ2'], 1, 0, 'C');
    $pdf->Cell(10, 15, $Makabansa2['CV_valueQ3'], 1, 0, 'C');
    $pdf->Cell(10, 15, $Makabansa2['CV_valueQ4'], 1, 1, 'C');

    $pdf->Cell(30, 15, 'Makalikasan', 1, 0, 'C');
    $pdf->Cell(120, 15, 'Environmentally conscious, and uses resources wisely.', 1, 0, 'C');
    $getMakalikasan = $mysqli->query("SELECT * FROM behavior WHERE CV_Area = 'Makalikasan' AND SR_number = '{$_GET['ID']}'");
    $Makalikasan = $getMakalikasan->fetch_assoc();
    $pdf->Cell(10, 15, $Makalikasan['CV_valueQ1'], 1, 0, 'C');
    $pdf->Cell(10, 15, $Makalikasan['CV_valueQ2'], 1, 0, 'C');
    $pdf->Cell(10, 15, $Makalikasan['CV_valueQ3'], 1, 0, 'C');
    $pdf->Cell(10, 15, $Makalikasan['CV_valueQ4'], 1, 1, 'C');

    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(70, 10, 'Marking', 1, 0, 'C');
    $pdf->Cell(30, 10, 'AO', 1, 0, 'C');
    $pdf->Cell(30, 10, 'SO', 1, 0, 'C');
    $pdf->Cell(30, 10, 'RO', 1, 0, 'C');
    $pdf->Cell(30, 10, 'NO', 1, 1, 'C');
    $pdf->Cell(70, 20, 'NON-NUMERICAL RATING', 1, 0, 'C');

    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(30, 10, 'Always', 'L,T,R', 2, 'C');
    $pdf->Cell(30, 10, 'Observed', 'L,B,R', 0, 'C');

    $pdf->SetXY(110, 193);
    $pdf->Cell(30, 10, 'Sometimes', 'L,T,R', 2, 'C');
    $pdf->Cell(30, 10, 'Observed', 'L,B,R', 0, 'C');

    $pdf->SetXY(140, 193);
    $pdf->Cell(30, 10, 'Rarely', 'L,T,R', 2, 'C');
    $pdf->Cell(30, 10, 'Observed', 'L,B,R', 0, 'C');

    $pdf->SetXY(170, 193);
    $pdf->Cell(30, 10, 'Not', 'L,T,R', 2, 'C');
    $pdf->Cell(30, 10, 'Observed', 'L,B,R', 1, 'C');

    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(190, 10, 'Attendance Record', 0, 1);
    $pdf->Cell(70, 5, '', 1, 0, 'C');

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
    $pdf->Cell(70, 5, 'No. of School Days', 1, 0, 'C');
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetFont('Arial', '', 9);

    $year = date('Y');
    $pdf->Cell(10, 5, countWeekdaysInMonth($year, 9), 1, 0, 'C');
    $pdf->Cell(10, 5, countWeekdaysInMonth($year, 10), 1, 0, 'C');
    $pdf->Cell(10, 5, countWeekdaysInMonth($year, 11), 1, 0, 'C');
    $pdf->Cell(10, 5, countWeekdaysInMonth($year, 12), 1, 0, 'C');
    $pdf->Cell(10, 5, countWeekdaysInMonth($year, 1), 1, 0, 'C');
    $pdf->Cell(10, 5, countWeekdaysInMonth($year, 2), 1, 0, 'C');
    $pdf->Cell(10, 5, countWeekdaysInMonth($year, 3), 1, 0, 'C');
    $pdf->Cell(10, 5, countWeekdaysInMonth($year, 4), 1, 0, 'C');
    $pdf->Cell(10, 5, countWeekdaysInMonth($year, 5), 1, 0, 'C');
    $pdf->Cell(10, 5, countWeekdaysInMonth($year, 6), 1, 0, 'C');
    $total = countWeekdaysInMonth($year, 9)
        + countWeekdaysInMonth($year, 10)
        + countWeekdaysInMonth($year, 11)
        + countWeekdaysInMonth($year, 12)
        + countWeekdaysInMonth($year, 1)
        + countWeekdaysInMonth($year, 2)
        + countWeekdaysInMonth($year, 3)
        + countWeekdaysInMonth($year, 4)
        + countWeekdaysInMonth($year, 5)
        + countWeekdaysInMonth($year, 6);
    $pdf->Cell(20, 5, $total, 1, 1, 'C');

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(70, 5, 'No. of Days Present', 1, 0, 'C');
    $pdf->SetFont('Arial', '', 9);

    $SEP = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'September'");
    $SEPvalue = $SEP->fetch_assoc();
    $pdf->Cell(10, 5, $SEPvalue['COUNT(A_time_IN)'], 1, 0, 'C');

    $OCT = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'October'");
    $OCTvalue = $OCT->fetch_assoc();
    $pdf->Cell(10, 5, $OCTvalue['COUNT(A_time_IN)'], 1, 0, 'C');

    $NOV = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'November'");
    $NOVvalue = $NOV->fetch_assoc();
    $pdf->Cell(10, 5, $NOVvalue['COUNT(A_time_IN)'], 1, 0, 'C');

    $DEC = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'December'");
    $DECvalue = $DEC->fetch_assoc();
    $pdf->Cell(10, 5, $DECvalue['COUNT(A_time_IN)'], 1, 0, 'C');

    $JAN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'January'");
    $JANvalue = $JAN->fetch_assoc();
    $pdf->Cell(10, 5, $JANvalue['COUNT(A_time_IN)'], 1, 0, 'C');

    $FEB = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'February'");
    $FEBvalue = $FEB->fetch_assoc();
    $pdf->Cell(10, 5, $FEBvalue['COUNT(A_time_IN)'], 1, 0, 'C');

    $MAR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'March'");
    $MARvalue = $MAR->fetch_assoc();
    $pdf->Cell(10, 5, $MARvalue['COUNT(A_time_IN)'], 1, 0, 'C');

    $APR = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'April'");
    $APRvalue = $APR->fetch_assoc();
    $pdf->Cell(10, 5, $APRvalue['COUNT(A_time_IN)'], 1, 0, 'C');

    $MAY = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'May'");
    $MAYvalue = $MAY->fetch_assoc();
    $pdf->Cell(10, 5, $MAYvalue['COUNT(A_time_IN)'], 1, 0, 'C');

    $JUN = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'June'");
    $JUNvalue = $JUN->fetch_assoc();
    $pdf->Cell(10, 5, $JUNvalue['COUNT(A_time_IN)'], 1, 0, 'C');

    $TOTAL = $mysqli->query("SELECT COUNT(A_time_IN) FROM attendance WHERE SR_number = '{$_GET['ID']}'");
    $TOTALvalue = $TOTAL->fetch_assoc();
    $pdf->Cell(20, 5, $TOTALvalue['COUNT(A_time_IN)'], 1, 1, 'C');

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(70, 5, 'No. of Days Absent', 1, 0, 'C');
    $pdf->SetFont('Arial', '', 9);
    $SEP = $mysqli->query("SELECT COUNT(A_status) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'September' AND A_status = 'LATE'");
    $SEPvalue = $SEP->fetch_assoc();
    $pdf->Cell(10, 5, $SEPvalue['COUNT(A_status)'], 1, 0, 'C');

    $OCT = $mysqli->query("SELECT COUNT(A_status) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'October' AND A_status = 'LATE'");
    $OCTvalue = $OCT->fetch_assoc();
    $pdf->Cell(10, 5, $OCTvalue['COUNT(A_status)'], 1, 0, 'C');

    $NOV = $mysqli->query("SELECT COUNT(A_status) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'November' AND A_status = 'LATE'");
    $NOVvalue = $NOV->fetch_assoc();
    $pdf->Cell(10, 5, $NOVvalue['COUNT(A_status)'], 1, 0, 'C');

    $DEC = $mysqli->query("SELECT COUNT(A_status) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'December' AND A_status = 'LATE'");
    $DECvalue = $DEC->fetch_assoc();
    $pdf->Cell(10, 5, $DECvalue['COUNT(A_status)'], 1, 0, 'C');

    $JAN = $mysqli->query("SELECT COUNT(A_status) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'January' AND A_status = 'LATE'");
    $JANvalue = $JAN->fetch_assoc();
    $pdf->Cell(10, 5, $JANvalue['COUNT(A_status)'], 1, 0, 'C');

    $FEB = $mysqli->query("SELECT COUNT(A_status) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'February' AND A_status = 'LATE'");
    $FEBvalue = $FEB->fetch_assoc();
    $pdf->Cell(10, 5, $FEBvalue['COUNT(A_status)'], 1, 0, 'C');

    $MAR = $mysqli->query("SELECT COUNT(A_status) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'March' AND A_status = 'LATE'");
    $MARvalue = $MAR->fetch_assoc();
    $pdf->Cell(10, 5, $MARvalue['COUNT(A_status)'], 1, 0, 'C');

    $APR = $mysqli->query("SELECT COUNT(A_status) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'April' AND A_status = 'LATE'");
    $APRvalue = $APR->fetch_assoc();
    $pdf->Cell(10, 5, $APRvalue['COUNT(A_status)'], 1, 0, 'C');

    $MAY = $mysqli->query("SELECT COUNT(A_status) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'May' AND A_status = 'LATE'");
    $MAYvalue = $MAY->fetch_assoc();
    $pdf->Cell(10, 5, $MAYvalue['COUNT(A_status)'], 1, 0, 'C');

    $JUN = $mysqli->query("SELECT COUNT(A_status) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND MONTHNAME(A_date) = 'June' AND A_status = 'LATE'");
    $JUNvalue = $JUN->fetch_assoc();
    $pdf->Cell(10, 5, $JUNvalue['COUNT(A_status)'], 1, 0, 'C');

    $TOTAL = $mysqli->query("SELECT COUNT(A_status) FROM attendance WHERE SR_number = '{$_GET['ID']}' AND A_status = 'LATE'");
    $TOTALvalue = $TOTAL->fetch_assoc();
    $pdf->Cell(20, 5, $TOTALvalue['COUNT(A_status)'], 1, 1, 'C');

    ob_end_clean();
    // $pdf->Output();
    $pdf->Output('I', $studentInfo['SR_lname'] . ' - ' . $studentInfo['SR_grade'] . " - " . $studentInfo['SR_section'] . '.pdf');
}
