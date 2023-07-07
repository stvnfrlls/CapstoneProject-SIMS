<?php
ob_start();
include '../assets/vendor/autoload.php';
require_once '../assets/php/server.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (!empty($_GET['Quarter']) && !empty($_GET['Grade']) && !empty($_GET['Section'])) {
    $mysqli = new mysqli('localhost', 'u395663555_admin2311', 'Eleven.11', 'u395663555_sforms_cdsp');

    $letters = range('B', 'Z');
    $capitalLetters = array_map('strtoupper', $letters);
    $colCount = 0;
    $rowCount = 3;

    $getSubject = $mysqli->query("SELECT subjectName FROM subjectperyear
                            WHERE subjectName IN 
                            (SELECT S_subject FROM workschedule 
                            WHERE SR_grade = 6
                            AND SR_section = 'Pineapple')
                            ORDER BY subjectName");
    $subj_Array = array();
    while ($subject = $getSubject->fetch_assoc()) {
        $subj_Array[] = $subject;
    }

    // Create a new spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->mergeCells('A1:' . $capitalLetters[mysqli_num_rows($getSubject) - 1] . '1');
    $sheet->setCellValue('A1', 'GRADES OF SECTION PINEAPPLE');
    $A1style = $sheet->getStyle('A1');
    $A1style->getFont()->setBold(true);
    $A1style->getFont()->setSize(20);
    $alignment = $A1style->getAlignment();
    $alignment->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set vertical alignment to center

    // Create a new spreadsheet
    $sheet->getColumnDimension('A')->setWidth(35);
    $sheet->setCellValue('A2', 'STUDENT NAME');
    $style = $sheet->getStyle('A2');
    $style->getFont()->setBold(true);
    $alignment = $style->getAlignment();
    $alignment->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set horizontal alignment to center
    $alignment->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Set vertical alignment to center

    while ($colCount != sizeof($subj_Array)) {
        $sheet->getColumnDimension($capitalLetters[$colCount])->setWidth(13);
        $sheet->setCellValue($capitalLetters[$colCount] . '2', $subj_Array[$colCount]['subjectName']);
        $style = $sheet->getStyle($capitalLetters[$colCount] . '2');
        $style->getFont()->setBold(true);
        $alignment = $style->getAlignment();
        $alignment->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set horizontal alignment to center
        $alignment->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Set vertical alignment to center
        $alignment->setWrapText(true); // Enable text wrappingr

        $colCount++;
    }

    $getClassList = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number IN 
                                (SELECT SR_number FROM classlist 
                                WHERE SR_grade = '{$_GET['Grade']}'
                                AND SR_section = '{$_GET['Section']}'
                                AND acadYear = '{$currentSchoolYear}')
                                ORDER BY SR_lname");
    while ($classList = $getClassList->fetch_assoc()) {
        if (!empty($classList['SR_mname']) || $classList['SR_mname'] != "" && empty($classList['SR_suffix']) || $classList['SR_suffix'] = "") {
            $studentName = $classList['SR_lname'] .  ", " . $classList['SR_fname'] . " " . substr($classList['SR_mname'], 0, 1) . ".";
        } else if (empty($classList['SR_mname']) || $classList['SR_mname'] = "" && !empty($classList['SR_suffix']) || $classList['SR_suffix'] != "") {
            $studentName = $classList['SR_lname'] .  ", " . $classList['SR_fname'] . " " . $classList['SR_suffix'];
        } else if (empty($classList['SR_mname']) || $classList['SR_mname'] = "" && empty($classList['SR_suffix']) || $classList['SR_suffix'] = "") {
            $studentName = $classList['SR_lname'] .  ", " . $classList['SR_fname'];
        }
        $sheet->setCellValue('A' . $rowCount, $studentName);
        $rowCount++;
    }

    $i = 0;
    while ($i != sizeof($subj_Array)) {
        $cellRow = 3;
        $getClassList = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number IN 
                                        (SELECT SR_number FROM classlist 
                                        WHERE SR_grade = '{$_GET['Grade']}'
                                        AND SR_section = '{$_GET['Section']}'
                                        AND acadYear = '{$currentSchoolYear}')
                                        ORDER BY SR_lname");
        $classList = $getClassList->fetch_assoc();
        if ($_GET['Quarter'] == 1) {
            $getGradeData = $mysqli->query("SELECT G_gradesQ1 AS grade, G_learningArea FROM grades 
                                            WHERE acadYear = '{$currentSchoolYear}' 
                                            AND SR_number = '{$classList['SR_number']}'
                                            AND G_learningArea = '{$subj_Array[$i]['subjectName']}'
                                            AND SR_gradeLevel = '{$_GET['Grade']}'
                                            AND SR_section = '{$_GET['Section']}'");
        } elseif ($_GET['Quarter'] == 2) {
            $getGradeData = $mysqli->query("SELECT G_gradesQ2 AS grade, G_learningArea FROM grades 
                                            WHERE acadYear = '{$currentSchoolYear}' 
                                            AND SR_number = '{$classList['SR_number']}'
                                            AND G_learningArea = '{$subj_Array[$i]['subjectName']}'
                                            AND SR_gradeLevel = '{$_GET['Grade']}'
                                            AND SR_section = '{$_GET['Section']}'");
        } elseif ($_GET['Quarter'] == 3) {
            $getGradeData = $mysqli->query("SELECT G_gradesQ3 AS grade, G_learningArea FROM grades 
                                            WHERE acadYear = '{$currentSchoolYear}' 
                                            AND SR_number = '{$classList['SR_number']}'
                                            AND G_learningArea = '{$subj_Array[$i]['subjectName']}'
                                            AND SR_gradeLevel = '{$_GET['Grade']}'
                                            AND SR_section = '{$_GET['Section']}'");
        } elseif ($_GET['Quarter'] == 4) {
            $getGradeData = $mysqli->query("SELECT G_gradesQ4 AS grade, G_learningArea FROM grades 
                                            WHERE acadYear = '{$currentSchoolYear}' 
                                            AND SR_number = '{$classList['SR_number']}'
                                            AND G_learningArea = '{$subj_Array[$i]['subjectName']}'
                                            AND SR_gradeLevel = '{$_GET['Grade']}'
                                            AND SR_section = '{$_GET['Section']}'");
        }
        $grade = $getGradeData->fetch_assoc();
        while ($cellRow != mysqli_num_rows($getClassList) + 3) {
            $sheet->setCellValue($capitalLetters[$i] . $cellRow, $grade['grade']);
            $cellRow++;
        }
        $i++;
    }
    // Save the spreadsheet to a file
    $writer = new Xlsx($spreadsheet);
    $filename = $_GET['Section'] . '.xlsx';
    $writer->save($filename);

    // Download the file
    ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . basename($filename) . '"');
    header('Cache-Control: max-age=0');
    readfile($filename);
}
