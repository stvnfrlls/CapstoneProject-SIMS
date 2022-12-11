<?php
session_start();
include('database.php');
$errors = array();
$success = array();
date_default_timezone_set('Asia/Hong_Kong'); //remove mo to kapag nilagay mo na sa hosting sites
$year = date('Y');
$month = date('m');

//Login and Register Process
if (isset($_POST['login-button'])) {
    $email = $_POST['usersEmail'];
    $password = $_POST['usersPwd'];

    $authAccount = "SELECT * FROM userdetails WHERE username = '$email'";
    $resultauthAccount = $mysqli->query($authAccount);

    if ($resultauthAccount) {
        if ($resultauthAccount->num_rows >= 0) {
            $getResultauthAccount = $resultauthAccount->fetch_assoc();
            $UD_username = $getResultauthAccount['username'];
            $UD_password = $getResultauthAccount['password'];
            $UD_role = $getResultauthAccount['role'];

            $userDetails = "SELECT SR_number, SR_fname, SR_lname FROM studentrecord WHERE SR_email = '$UD_username'";
            $resultuserDetails = $mysqli->query($userDetails);

            if ($resultuserDetails->num_rows >= 0) {
                $getResultuserDetails = $resultuserDetails->fetch_assoc();
                $SR_fname = $getResultuserDetails['SR_fname'];
                $SR_lname = $getResultuserDetails['SR_lname'];

                $_SESSION['SR_name'] = $SR_lname . ', ' . $SR_fname;
                $_SESSION['SR_number'] = $getResultuserDetails['SR_number'];
            }

            if ($password != $UD_password) {
                echo "error incorrect password";
            } else {
                if ($UD_role == "student") {
                    header('Location: ../student/dashboard.php');
                } elseif ($UD_role == "admin") {
                    header('Location: ../admin/dashboard.php');
                } elseif ($UD_role == "faculty") {
                    header('Location: ../faculty/dashboard.php');
                }
            }
        } else {
            echo "error" . $mysqli->error;
        }
    }
}
if (isset($_POST['verifyStudentNumber'])) {
    $studentNumber = $_POST['studentNumber'];

    $check_studentNumber = "SELECT * FROM studentrecord WHERE SR_number = '$studentNumber'";
    $result = $mysqli->query($check_studentNumber);

    if ($result) {
        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            $sr_num = $data['SR_number'];
            $_SESSION['student_num'] = $sr_num;
            header('Location: signup.php');
        } else {
            echo "error" . $mysqli->error;
        }
    }
}
if (isset($_POST['register-button'])) {
    $email = $mysqli->real_escape_string($_POST['usersEmail']);
    $password  = $mysqli->real_escape_string($_POST['usersPwd']);

    $check_email = "SELECT * FROM userdetails WHERE username = '$email'";
    $result = $mysqli->query($check_email);

    if ($result->num_rows === 0) {
        $studentNumber = $_SESSION['student_num'];
        $signup = "UPDATE student (user_name, password) VALUES('$email', '$password') WHERE SR_number = '$studentNum'";
        $result = $mysqli->query($signup);

        if ($result) {
            if ($result->affected_rows >= 0) {
                header('Location: auth/login.php');
            } else {
                $errors['unknown'] = "Error inputting Data";
            }
        } else {
            $errors['unknown'] = "Error inputting Data";
        }
    } else {
        $errors['email'] = "Email already in use." . $email;
        echo "error" . $mysqli->error;
    }
}
//END

//Faculty Process
if (isset($_POST['present'])) {
    $qrCode = $_POST['qrcode_input'];
    $time = date("Y-m-d H:i:s");

    if (str_contains($qrCode, 'SRVC')) {
        $verify_fetcher = "SELECT SRVC_number, SRVC_fullname, SR_number  FROM fetchers WHERE SRVC_number = '$qrCode'";
        $resultverify_fetcher = $mysqli->query($verify_fetcher);
        $dataresultverify_fetcher = $resultverify_fetcher->fetch_assoc();
        $SR_number = $dataresultverify_fetcher['SR_number'];
        $SRVC_fullname = $dataresultverify_fetcher['SRVC_fullname'];

        if (!empty($SR_number)) {
            $check_attendance = ("SELECT * FROM attendance WHERE SR_number = '$SR_number'");
            $resultcheck_attendance = $mysqli->query($check_attendance);
            if ($resultcheck_attendance->num_rows >= 0) {
                $dataresultcheck_attendance = $resultcheck_attendance->fetch_assoc();
                $timeIN = $dataresultcheck_attendance['A_time_in'];
                $timeOUT = $dataresultcheck_attendance['A_time_out'];

                if ($timeIN == null) {
                    $insertAttendance = ("INSERT INTO attendance (SR_number, A_time_in, A_fetcher) VALUES ('$SR_number', '$time', '$SRVC_fullname')");
                    $resultinsertAttendance = $mysqli->query($insertAttendance);

                    if ($resultinsertAttendance->num_rows >= 0) {
                        header('Location: ../faculty/scanQR.php');
                        echo "Success " . $SR_number . " " . $time;
                    } else {
                        echo $mysqli->error;
                    }
                } elseif ($timeIN != null && $timeOUT == null) {
                    $insertTimeout = ("UPDATE attendance SET A_time_out = '$time' WHERE SR_number = '$SR_number'");
                    $resultinsertTimeout = $mysqli->query($insertTimeout);

                    if ($resultinsertTimeout) {
                        header('Location: ../faculty/scanQR.php');
                        echo "Success " . $SR_number . " " . $time;
                    } else {
                        echo $mysqli->error;
                    }
                } elseif ($timeIN != null && $timeOUT != null) {
                    echo "Student already checked out";
                }
            }
        } else {
            echo "STUDENT DOES NOT EXIST";
        }
    } elseif (str_contains($qrCode, 'SP')) {
        $verify_student = "SELECT SR_number FROM studentrecord WHERE SR_number = '$qrCode'";
        $resultverify_student = $mysqli->query($verify_student);
        $dataresultverify_student = $resultverify_student->fetch_assoc();
        $SR_number = $dataresultverify_student['SR_number'];

        if (!empty($SR_number)) {
            $check_attendance = ("SELECT * FROM attendance WHERE SR_number = '$SR_number'");
            $resultcheck_attendance = $mysqli->query($check_attendance);

            if ($resultcheck_attendance->num_rows >= 0) {
                $dataresultcheck_attendance = $resultcheck_attendance->fetch_assoc();
                $timeIN = $dataresultcheck_attendance['A_time_in'];
                $timeOUT = $dataresultcheck_attendance['A_time_out'];

                if ($timeIN == null) {
                    $insertAttendance = ("INSERT INTO attendance (SR_number, A_time_in) VALUES ('$SR_number', '$time')");
                    $resultinsertAttendance = $mysqli->query($insertAttendance);

                    if ($resultinsertAttendance->num_rows >= 0) {
                        header('Location: ../faculty/scanQR.php');
                        echo "Success " . $SR_number . " " . $time;
                    } else {
                        echo $mysqli->error;
                    }
                } elseif ($timeIN != null && $timeOUT == null) {
                    $insertTimeout = ("UPDATE attendance SET A_time_out = '$time' WHERE SR_number = '$SR_number'");
                    $resultinsertTimeout = $mysqli->query($insertTimeout);

                    if ($resultinsertTimeout) {
                        header('Location: ../faculty/scanQR.php');
                        echo "Success " . $SR_number . " " . $time;
                    } else {
                        echo $mysqli->error;
                    }
                } elseif ($timeIN != null && $timeOUT != null) {
                    echo "Student already checked out";
                }
            }
        } else {
            echo "STUDENT DOES NOT EXIST";
        }
    } else {
        echo "INVALID QR CODE";
    }
}
if (isset($_POST['encode'])) {
    $SR_number = $mysqli->real_escape_string($_POST['SR_number']);
    $Subject = $mysqli->real_escape_string($_POST['Subject']);
    $G_Grade = $mysqli->real_escape_string($_POST['Grade']);
    $Quarter = $mysqli->real_escape_string($_POST['Quarter']);

    $getQuarter = "SELECT * FROM grades WHERE G_quarter = '$Quarter' AND SR_number = '$SR_number'";
    $resultgetQuarter = $mysqli->query($getQuarter);
    $dataresultgetQuarter = $resultgetQuarter->fetch_assoc();
    $G_grading = $dataresultverify_fetcher['G_grading'];

    if ($resultgetQuarter->num_rows == 0) {
        $insertGrade = "INSERT INTO grades(SR_number, SR_section, G_quarter, G_learningArea, G_grade) 
                        VALUES ('$SR_number', '$SR_section', '$Quarter', '$Subject', '$G_grade')";
        $resultinsertGrade = $mysqli->query($insertGrade);
        if ($resultinsertGrade) {
            header('Location: ../faculty/grades.php');
        } else {
            echo "error" . $mysqli->error;
        }
    } elseif ($resultgetQuarter->num_rows == 1) {
        $insertGrade = "UPDATE grades 
                        SET SR_section = '$SR_section', G_quarter = '$Quarter', G_learningArea = '$Subject', G_grade = '$G_grade',
                        WHERE SR_number = '$SR_number'";
        $resultinsertGrade = $mysqli->query($insertGrade);
        if ($result) {
            header('Location: ../faculty/grades.php');
        } else {
            echo "error" . $mysqli->error;
        }
    }
}
if (isset($_POST['updateProfile'])) {
    $F_fname = $mysqli->real_escape_string($_POST['F_fname']);
    $F_mname    = $mysqli->real_escape_string($_POST['F_mname']);
    $F_lname = $mysqli->real_escape_string($_POST['F_lname']);
    $F_suffix = $mysqli->real_escape_string($_POST['F_suffix']);

    $F_age    = $mysqli->real_escape_string($_POST['F_age']);
    $F_birthday = $mysqli->real_escape_string($_POST['F_birthday']);
    $F_gender = $mysqli->real_escape_string($_POST['F_gender']);

    $F_address    = $mysqli->real_escape_string($_POST['F_address']);
    $F_city    = $mysqli->real_escape_string($_POST['F_city']);
    $F_postal    = $mysqli->real_escape_string($_POST['F_postal']);

    $F_number = $mysqli->real_escape_string($_POST['F_number']);

    $updateFaculty = "UPDATE faculty 
                      SET 
                        F_fname = '$F_fname', 
                        F_mname = '$F_mname',
                        F_lname = '$F_lname',
                        F_suffix = '$F_suffix',
                        F_age = '$F_age',
                        F_birthday = '$F_birthday',
                        F_gender = '$F_gender',
                        F_address = '$F_address',
                        F_city = '$F_city',
                        F_postal = '$F_postal',
                        F_guardian = '$F_guardian',
                        F_contact = '$F_contact',
                      WHERE F_number = '$F_number'";
    $resultupdateFaculty = $mysqli->query($updateFaculty);

    if ($resultupdateFaculty) {
        header('Location: ../admin/addFaculty.php');
    } else {
        echo "error" . $mysqli->error;
    }
}
if (isset($_POST['addReminders'])) {
    $author = $mysqli->real_escape_string($_POST['author']);
    $header = $mysqli->real_escape_string($_POST['header']);
    $MSG = $mysqli->real_escape_string($_POST['MSG']);
    $ANC_type = "REMINDERS";
    $date = $mysqli->real_escape_string($_POST['date']);

    $addReminders = "INSERT INTO announcement(author, header, body, ANC_type, datePosted)
                     VALUE ('$author', '$header', '$MSG','$ANC_type', '$date')";
    $resultaddReminders = $mysqli->query($addReminders);

    if ($resultaddReminders) {
        header('Location: ../faculty/reminders.php');
    } else {
        echo "error" . $mysqli->error;
    }
}
if (isset($_POST['addAssignments'])) {
    $TeacherName = $mysqli->real_escape_string($_POST['TeacherName']);
    $header = $mysqli->real_escape_string($_POST['header']);
    $MSG = $mysqli->real_escape_string($_POST['MSG']);
    $ANC_type = "ASSIGNMENT";
    $dateposted = $mysqli->real_escape_string($_POST['dateposted']);
    $duedate = $mysqli->real_escape_string($_POST['duedate']);

    $addAssignment = "INSERT INTO announcement(author, header, body, ANC_type, datePosted, dueDate)
                     VALUE ('$TeacherName', '$header', '$MSG','$ANC_type', '$dateposted', '$duedate')";
    $resultaddAssignment = $mysqli->query($addAssignment);

    if ($resultaddAssignment) {
        header('Location: ../faculty/assignments.php');
    } else {
        echo "error" . $mysqli->error;
    }
}
if (isset($_POST['editReminders'])) {
    $ANC_ID = $mysqli->real_escape_string($_POST['ANC_ID']);
    $header = $mysqli->real_escape_string($_POST['header']);
    $MSG = $mysqli->real_escape_string($_POST['MSG']);

    $updateReminder = "UPDATE announcement 
                       SET header = '$header', body = '$MSG',
                       WHERE ANC_ID = '$ANC_ID'";
    $resultupdateReminder = $mysqli->query($updateReminder);

    if ($resultupdateReminder) {
        header('Location: ../faculty/reminders.php');
    } else {
        echo "error" . $mysqli->error;
    }
}
if (isset($_POST['editAssigments'])) {
    $ANC_ID = $mysqli->real_escape_string($_POST['ANC_ID']);
    $header = $mysqli->real_escape_string($_POST['header']);
    $MSG = $mysqli->real_escape_string($_POST['MSG']);
    $dateposted = $mysqli->real_escape_string($_POST['dateposted']);
    $duedate = $mysqli->real_escape_string($_POST['duedate']);

    $updateAssignment = "UPDATE reminders 
                         SET header = '$header', body = '$MSG', datePosted = '$dateposted', dueDate = '$duedate',
                         WHERE ANC_ID = '$ANC_ID'";
    $resultupdateAssignment = $mysqli->query($updateAssignment);

    if ($resultupdateAssignment) {
        header('Location: ../faculty/assignments.php');
    } else {
        echo "error" . $mysqli->error;
    }
}
//End

//Admin Process
if (isset($_POST['regStudent'])) {
    $S_fname = $mysqli->real_escape_string($_POST['S_fname']);
    $S_mname    = $mysqli->real_escape_string($_POST['S_mname']);
    $S_lname = $mysqli->real_escape_string($_POST['S_lname']);
    $S_suffix = $mysqli->real_escape_string($_POST['S_suffix']);

    $S_age    = $mysqli->real_escape_string($_POST['S_age']);
    $S_birthday = $mysqli->real_escape_string($_POST['S_birthday']);
    $S_gender = $mysqli->real_escape_string($_POST['S_gender']);

    $S_address    = $mysqli->real_escape_string($_POST['S_address']);
    $S_barangay    = $mysqli->real_escape_string($_POST['S_barangay']);
    $S_city    = $mysqli->real_escape_string($_POST['S_city']);
    $S_state    = $mysqli->real_escape_string($_POST['S_state']);
    $S_postal    = $mysqli->real_escape_string($_POST['S_postal']);

    $S_guardian = $mysqli->real_escape_string($_POST['S_guardian']);
    $S_contact    = $mysqli->real_escape_string($_POST['S_contact']);

    $S_grade = $mysqli->real_escape_string($_POST['S_gradelevel']);
    $S_section    = $mysqli->real_escape_string($_POST['S_section']);
    $S_schedule    = $mysqli->real_escape_string($_POST['S_schedule']);

    $Lastrow = 'SELECT SR_year FROM studentrecord ORDER BY SR_ID DESC LIMIT 1';
    $resultLastrow = $mysqli->query($Lastrow);
    $getLastrow = $resultLastrow->fetch_assoc();

    if (empty($getLastrow["SR_year"])) {
        $StudentCount = "SELECT COUNT(SR_number) FROM studentrecord";
        $resultStudentCount = $mysqli->query($StudentCount);
        $getStudentCount = $resultStudentCount->fetch_assoc();

        $format_StudentCounter = sprintf("%05d", ($getStudentCount["COUNT(SR_number)"] + 1));
    } else if ($getLastrow["SR_year"] == $year) {
        $StudentCount = "SELECT COUNT(SR_number) FROM studentrecord";
        $resultStudentCount = $mysqli->query($StudentCount);
        $getStudentCount = $resultStudentCount->fetch_assoc();

        $format_StudentCounter = sprintf("%05d", ($getStudentCount["COUNT(SR_number)"] + 1));
    } else {
        $StudentCount = "SELECT COUNT(SR_year) FROM studentrecord WHERE SR_year == '$year'";
        $resultStudentCount = $mysqli->query($StudentCount);
        $getStudentCount = $resultStudentCount->fetch_assoc();

        $format_StudentCounter = sprintf("%05d", ($getStudentCount["COUNT(SR_year)"] + 1));
    }

    $SR_number = $year . "-" . $format_StudentCounter . "-SP";

    $regStudent = "INSERT INTO studentrecord(SR_number, SR_year, SR_fname, SR_mname, SR_lname, SR_gender, 
                    SR_age, SR_birthday, SR_grade, SR_section, SR_address, SR_barangay, SR_city, SR_state, SR_guardian, SR_contact)
                    VALUES('$SR_number', '$year', '$S_fname', '$S_mname', '$S_lname', '$S_gender', 
                     '$S_age', '$S_birthday', '$S_grade', '$S_section',  '$SR_address', '$SR_barangay', '$SR_city', '$SR_state', 
                     '$S_guardian', '$S_contact'
                    )";
    $result = $mysqli->query($regStudent);

    if ($result) {
        header('Location: ../admin/student.php');
    } else {
        echo "error" . $mysqli->error;
    }
}

if (isset($_POST['regFaculty'])) {
    $F_department = $mysqli->real_escape_string($_POST['F_department']);

    $F_lname = $mysqli->real_escape_string($_POST['F_lname']);
    $F_fname = $mysqli->real_escape_string($_POST['F_fname']);
    $F_mname = $mysqli->real_escape_string($_POST['F_mname']);
    $F_suffix = $mysqli->real_escape_string($_POST['F_suffix']);

    $F_age = $mysqli->real_escape_string($_POST['F_age']);
    $F_birthday = $mysqli->real_escape_string($_POST['F_birthday']);
    $F_gender = $mysqli->real_escape_string($_POST['F_gender']);

    $F_address = $mysqli->real_escape_string($_POST['F_address']);
    $F_barangay = $mysqli->real_escape_string($_POST['F_barangay']);
    $F_city = $mysqli->real_escape_string($_POST['F_city']);
    $F_state = $mysqli->real_escape_string($_POST['F_state']);
    $F_postal = $mysqli->real_escape_string($_POST['F_postal']);

    $F_contact = $mysqli->real_escape_string($_POST['F_contact']);
    $F_email = $mysqli->real_escape_string($_POST['F_email']);

    $Lastrow = 'SELECT F_year FROM faculty ORDER BY F_ID DESC LIMIT 1';
    $resultLastrow = $mysqli->query($Lastrow);
    $getLastrow = $resultLastrow->fetch_assoc();

    if (empty($getLastrow["F_year"])) {
        $FacultyCount = "SELECT COUNT(F_number) FROM faculty";
        $resultFacultyCount = $mysqli->query($FacultyCount);
        $getFacultyCount = $resultFacultyCount->fetch_assoc();

        $FacultyNumber = sprintf("%05d", ($getFacultyCount["COUNT(F_number)"] + 1));
    } else if ($getLastrow["F_year"] == $year) {
        $FacultyCount = "SELECT COUNT(F_number) FROM faculty";
        $resultFacultyCount = $mysqli->query($FacultyCount);
        $getFacultyCount = $resultFacultyCount->fetch_assoc();

        $FacultyNumber = sprintf("%05d", ($getFacultyCount["COUNT(F_number)"] + 1));
    } else {
        $FacultyCount = "SELECT COUNT(F_year) FROM faculty WHERE F_year == '$year'";
        $resultFacultyCount = $mysqli->query($FacultyCount);
        $getFacultyCount = $resultFacultyCount->fetch_assoc();

        $FacultyNumber = sprintf("%05d", ($getFacultyCount["COUNT(F_year)"] + 1));
    }
    $F_number = $year . "-" . $month . "-" . $FacultyNumber . "-F";

    $regFaculty = "INSERT INTO faculty(F_number, F_year, F_lname, F_fname, F_mname, F_suffix, F_gender, 
                    F_contactNumber, F_birthday, F_address, F_barangay, F_city, F_state, F_postal, F_email, F_department)
                    VALUES('$F_number', '$year', '$F_lname', '$F_fname', '$F_mname', '$F_suffix','$F_gender', 
                    '$F_contact', '$F_birthday', '$F_address', '$F_barangay', '$F_city', '$F_state', '$F_postal', '$F_email', '$F_department')";
    $resultregFaculty = $mysqli->query($regFaculty);

    if ($resultregFaculty) {
        header('Location: ../admin/faculty.php');
    } else {
        echo "error" . $mysqli->error;
    }
}

if (isset($_POST['editStudent'])) {
    $S_fname = $mysqli->real_escape_string($_POST['S_fname']);
    $S_mname    = $mysqli->real_escape_string($_POST['S_mname']);
    $S_lname = $mysqli->real_escape_string($_POST['S_lname']);
    $S_suffix = $mysqli->real_escape_string($_POST['S_suffix']);

    $S_age    = $mysqli->real_escape_string($_POST['S_age']);
    $S_birthday = $mysqli->real_escape_string($_POST['S_birthday']);
    $S_gender = $mysqli->real_escape_string($_POST['S_gender']);

    $S_address    = $mysqli->real_escape_string($_POST['S_address']);
    $S_city    = $mysqli->real_escape_string($_POST['S_city']);
    $S_state    = $mysqli->real_escape_string($_POST['S_state']);
    $S_postal    = $mysqli->real_escape_string($_POST['S_postal']);

    $S_guardian = $mysqli->real_escape_string($_POST['S_guardian']);
    $S_contact    = $mysqli->real_escape_string($_POST['S_contact']);

    $S_grade = $mysqli->real_escape_string($_POST['S_grade']);
    $S_section    = $mysqli->real_escape_string($_POST['S_section']);
    $S_schedule    = $mysqli->real_escape_string($_POST['S_schedule']);

    $S_number = $mysqli->real_escape_string($_POST['S_number']);

    $updateStudent = "UPDATE studentrecord 
                      SET 
                        SR_fname = '$S_fname', 
                        SR_mname = '$S_mname',
                        SR_lname = '$S_lname',
                        SR_suffix = '$S_suffix',
                        SR_age = '$S_age',
                        SR_birthday = '$S_birthday',
                        SR_gender = '$S_gender',
                        SR_address = '$S_address',
                        S_barangay = '$S_barangay',
                        SR_city = '$S_city',
                        SR_state = '$S_state',
                        SR_postal = '$S_postal',
                        SR_guardian = '$S_guardian',
                        SR_contact = '$S_contact',
                        SR_grade = '$S_grade',
                        SR_section = '$S_section',
                        SR_schedule = '$S_schedule',
                      WHERE SR_number = '$S_number'";
    $resultupdateStudent = $mysqli->query($updateStudent);

    if ($resultupdateStudent) {
        header('Location: ../admin/addStudent.php');
    } else {
        echo "error" . $mysqli->error;
    }
}
if (isset($_POST['editFaculty'])) {
    $F_department = $mysqli->real_escape_string($_POST['department']);

    $F_lname = $mysqli->real_escape_string($_POST['lname']);
    $F_fname = $mysqli->real_escape_string($_POST['fname']);
    $F_mname = $mysqli->real_escape_string($_POST['mname']);
    $F_suffix = $mysqli->real_escape_string($_POST['suffix']);

    $F_age = $mysqli->real_escape_string($_POST['age']);
    $F_birthday = $mysqli->real_escape_string($_POST['birthday']);
    $F_gender = $mysqli->real_escape_string($_POST['gender']);

    $F_address = $mysqli->real_escape_string($_POST['address']);
    $F_barangay = $mysqli->real_escape_string($_POST['barangay']);
    $F_city = $mysqli->real_escape_string($_POST['city']);
    $F_state = $mysqli->real_escape_string($_POST['state']);
    $F_postal = $mysqli->real_escape_string($_POST['postal']);

    $F_contact = $mysqli->real_escape_string($_POST['contact']);
    $F_email = $mysqli->real_escape_string($_POST['email']);

    $updateFaculty = "UPDATE faculty 
                      SET 
                        F_fname = '$F_fname', 
                        F_mname = '$F_mname',
                        F_lname = '$F_lname',
                        F_suffix = '$F_suffix',
                        F_age = '$F_age',
                        F_birthday = '$F_birthday',
                        F_gender = '$F_gender',
                        F_address = '$F_address',
                        F_barangay = '$F_barangay',
                        F_city = '$F_city',
                        F_state = '$F_state',
                        F_postal = '$F_postal',
                        F_guardian = '$F_guardian',
                        F_contact = '$F_contact',
                        F_email = '$F_email',
                      WHERE F_number = '$F_number'";
    $resultupdateFaculty = $mysqli->query($updateFaculty);

    if ($resultupdateFaculty) {
        header('Location: ../admin/faculty.php');
    } else {
        echo "error" . $mysqli->error;
    }
}

if (isset($_POST['UpdateGrade'])) {
    $SR_number = $mysqli->real_escape_string($_POST['SR_number']);
    $G_english = $mysqli->real_escape_string($_POST['G_english']);
    $G_math = $mysqli->real_escape_string($_POST['G_math']);
    $G_science = $mysqli->real_escape_string($_POST['G_science']);
    $G_history = $mysqli->real_escape_string($_POST['G_history']);
    $G_filipino = $mysqli->real_escape_string($_POST['G_filipino']);

    $updateGrade = "UPDATE faculty 
                    SET 
                        G_english = '$G_english',
                        G_math = '$G_math',
                        G_science = '$G_science',
                        G_history = '$G_history',
                        G_filipino = '$G_filipino',
                    WHERE SR_number = '$SR_number'";
    $resultupdateGrade = $mysqli->query($updateGrade);

    if ($resultupdateGrade) {
        header('Location: ../admin/grades.php');
    } else {
        echo "error" . $mysqli->error;
    }
}
if (isset($_POST['addSchedule'])) {
    # code...
}
if (isset($_POST['updateSchedule'])) {
    # code...
}
if (isset($_POST['addAccount'])) {
    # code...
}
if (isset($_POST['editRoles'])) {
    # code...
}
//End
