<?php
require_once("../assets/php/server.php");

if (isset($_GET['ID'])) {
    header("Content-Type: text/csv");

    // filename for download
    $filename = "Attendance Record - " . $_GET['ID'] . ".csv";

    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Content-Type: application/vnd.ms-excel");

    function cleanData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }

    $attendanceArray = array();
    $getAttendanceInformation = $mysqli->query("SELECT 
                                            SR_number AS 'Student Number', 
                                            A_date AS 'Date', 
                                            A_time_IN AS 'Timed In',
                                            A_time_OUT AS 'Timed Out', 
                                            FROM attendance WHERE SR_number = '{$_GET['ID']}'");

    while ($attendanceData = $getAttendanceInformation->fetch_assoc()) {
        $attendanceArray[] = $attendanceData;
    }

    $out = fopen("php://output", 'w');
    $flag = FALSE;
    foreach ($attendanceArray as $row) {
        array_walk($row, __NAMESPACE__ . '\cleanData');
        if (!$flag) {
            // display field/column names as first row
            fputcsv($out, array_keys($row), ',', '"');
            $flag = TRUE;
        }
        fputcsv($out, array_values($row), ',', '"');
    }
    fclose($out);
}
