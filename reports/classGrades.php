<?php
include '..\assets\vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$mysqli = new mysqli("localhost", "root", "", "sis_cdsp");

$getSubject = $mysqli->query("SELECT subjectName FROM subjectperyear
                            WHERE subjectName IN 
                            (SELECT S_subject FROM workschedule 
                            WHERE SR_grade = 6
                            AND SR_section = 'Pineapple')
                            ORDER BY subjectName");

// Create a new spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$letters = range('B', 'Z');
$capitalLetters = array_map('strtoupper', $letters);
$colCount = 0;
// Create a new spreadsheet
$sheet->getColumnDimension('A')->setWidth(35);
$sheet->setCellValue('A1', 'STUDENT NAME');
while ($subject = $getSubject->fetch_assoc()) {
    $sheet->getColumnDimension($capitalLetters[$colCount])->setAutoSize(true);
    $sheet->setCellValue($capitalLetters[$colCount] . '1', $subject['subjectName']);
    $colCount++;
}

// Save the spreadsheet to a file
$writer = new Xlsx($spreadsheet);
$filename = '1.xlsx';
$writer->save($filename);

// Download the file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . basename($filename) . '"');
header('Cache-Control: max-age=0');
readfile($filename);
