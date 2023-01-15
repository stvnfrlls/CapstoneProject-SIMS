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

    if (empty($email) && empty($password)) {
        $errors['NoInputs'] = "Please enter your login credentials.";
    } else {
        $authAccount = $mysqli->query("SELECT * FROM userdetails WHERE SR_email = '$email'");

        if ($authAccount->num_rows > 0) {
            $getauthAccount = $authAccount->fetch_assoc();
            $UD_username = $getauthAccount['SR_email'];
            $UD_password = $getauthAccount['SR_password'];
            $UD_role = $getauthAccount['role'];

            $userDetails = $mysqli->query("SELECT SR_number, SR_fname, SR_lname FROM studentrecord WHERE SR_email = '$UD_username'");

            if ($userDetails->num_rows > 0) {
                $getuserDetails = $userDetails->fetch_assoc();
                $SR_fname = $getuserDetails['SR_fname'];
                $SR_lname = $getuserDetails['SR_lname'];

                $_SESSION['SR_name'] = $SR_lname . ', ' . $SR_fname;
                $_SESSION['SR_number'] = $getuserDetails['SR_number'];
            }

            if ($password != $UD_password) {
                $errors['PasswordError'] = "Incorrect Password!";
            } else {
                if ($UD_role == "student") {
                    $FindSR_Number = $mysqli->query("SELECT SR_number FROM studentrecord WHERE SR_email = '{$UD_username}'");
                    $getSR_Number = $FindSR_Number->fetch_assoc();

                    $_SESSION['SR_number'] = $getSR_Number['SR_number'];
                    header('Location: ../student/dashboard.php');
                } elseif ($UD_role == "faculty") {
                    $FindF_number = $mysqli->query("SELECT F_number FROM faculty WHERE F_email = '{$UD_username}'");
                    $getF_number = $FindF_number->fetch_assoc();

                    $_SESSION['F_number'] = $getF_number['F_number'];
                    header('Location: ../faculty/dashboard.php');
                }
            }
        } else {
            $FindAD_number = $mysqli->query("SELECT AD_number FROM admin_accounts WHERE AD_email = '{$email}' AND AD_password = '{$password}'");
            $getAD_number = $FindAD_number->fetch_assoc();

            if (empty($getAD_number['AD_number'])) {
                $errors['LoginError'] = "Account does not exist!";
            } else {
                $_SESSION['AD_number'] = $getAD_number['AD_number'];
                header('Location: ../admin/dashboard.php');
            }
        }
    }
}
if (isset($_POST['verifyIDNumber'])) {
    $IDNumber = $_POST['IDNumber'];

    if (empty($IDNumber)) {
        $errors['NoInputs'] = "Please enter your Identification Number.";
    } else {
        if (strpos($IDNumber, "S")) {
            $check_studentNumber = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '$IDNumber'");
            if ($check_studentNumber->num_rows == 1) {
                $data = $check_studentNumber->fetch_assoc();
                if (!empty($data['SR_email'])) {
                    $errors['NoData'] = "Account already linked to an Email. Contact the admin for changing of Email Address";
                } else if (empty($data['SR_email'])) {
                    $sr_num = $data['SR_number'];
                    $_SESSION['IDNum'] = $sr_num;
                    header('Location: signup.php');
                }
            }
        } else if (strpos($IDNumber, "F")) {
            $check_facultyNumber = $mysqli->query("SELECT * FROM faculty WHERE F_number = '$IDNumber'");
            if ($check_facultyNumber->num_rows == 1) {
                $data = $check_facultyNumber->fetch_assoc();
                if (!empty($data['F_email'])) {
                    $errors['NoData'] = "Account already linked to an Email. Contact the admin for changing of Email Address";
                } else if (empty($data['F_email'])) {
                    $F_num = $data['F_number'];
                    $_SESSION['IDNum'] = $F_num;
                    header('Location: signup.php');
                }
            }
        } else {
            $errors['NoData'] = "Account does not exist. Double check your Identification Number.";
        }
    }
}
if (isset($_POST['register-button'])) {
    $email = $mysqli->real_escape_string($_POST['usersEmail']);
    $password  = $mysqli->real_escape_string($_POST['usersPwd']);

    $check_email = $mysqli->query("SELECT * FROM userdetails WHERE SR_email = '$email'");

    if ($check_email->num_rows == 0) {
        $IDNum = $_SESSION['IDNum'];

        if (strpos($IDNum, "S")) {
            $role = "student";
        } else if (strpos($IDNum, "F")) {
            $role = "faculty";
        }

        $AddUserDetails = $mysqli->query("INSERT INTO userdetails (SR_email, SR_password, role) VALUES ('$email', '$password', '$role')");

        if ($role == "student") {
            $signup = "UPDATE studentrecord SET SR_email = '$email' WHERE SR_number = '$IDNum'";
        } else if ($role == "faculty") {
            $signup = "UPDATE faculty SET F_email = '$email' WHERE F_number = '$IDNum'";
        }
        $runsignup = $mysqli->query($signup);

        if ($runsignup) {
            header('Location: login.php');
        }
    } else {
        $errors['email'] = "Email already in use.";
    }
}
if (isset($_POST['verifyEmail'])) {
    $email = $_POST['usersEmail'];

    if (empty($email)) {
        $errors['NoInputs'] = "Please enter your login credentials.";
    } else {
        $authAccount = "SELECT * FROM userdetails WHERE SR_email = '$email'";
        $resultauthAccount = $mysqli->query($authAccount);

        if ($resultauthAccount->num_rows > 0) {
            $getResultauthAccount = $resultauthAccount->fetch_assoc();

            $studentrecord = "SELECT SR_email FROM studentrecord WHERE SR_email = '$email'";
            $resultstudentrecord = $mysqli->query($studentrecord);
            $verifyData = $resultstudentrecord->fetch_assoc();

            if ($resultstudentrecord->num_rows == 1) {
                $_SESSION['verifyEmailData'] = $verifyData['SR_email'];
                header('Location: ../auth/reset.php');
            }
        } else {
            $errors['LoginError'] = "Account does not exist!";
        }
    }
}
if (isset($_POST['updatePassword'])) {
    $newPasssword = $_POST['newPasssword'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($newPasssword) && empty($confirmPassword)) {
        $errors['NoInputs'] = "Please enter your new password.";
    } elseif (strcmp($newPasssword, $confirmPassword)) {
        $errors['NoMatch'] = "Password does not match.";
    } else {
        $checkOldPassword = "SELECT SR_password FROM userdetails WHERE SR_email = '{$_SESSION['verifyEmail']}'";
        $runcheckOldPassword = $mysqli->query($checkOldPassword);
        $datacOldPassword = $runcheckOldPassword->fetch_assoc();

        if (strcmp($datacOldPassword['SR_password'], $confirmPassword) == 0) {
            $errors['samePassword'] = "Password is the same with the old password.";
        } else {
            $updatePassword = "UPDATE userdetails SET SR_password = '$confirmPassword'
                          WHERE SR_email = '{$_SESSION['verifyEmailData']}'";
            $ResultupdatePassword = $mysqli->query($updatePassword);

            if ($ResultupdatePassword) {
                header('Location: login.php');
                unset($_SESSION['verifyEmailData']);
            }
        }
    }
}
//END

//Faculty Process
if (isset($_POST['present'])) {

    //echo '<script>alert("Welcome to Geeks for Geeks")</script>';
    //add this para sa confirmation or alert para sa duplicate na scan sa qr

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
if (isset($_POST['saveBehavior'])) {
    $ids = $_POST['row'];
    $forms_SR_number = $_GET['viewStudent'];
    $forms_CV_Area = $_POST['CV_Area'];
    $forms_core_value_subheading = $_POST['core_value_subheading'];

    $forms_CV_valueQ1 = $_POST['CV_valueQ1'];
    $forms_CV_valueQ2 = $_POST['CV_valueQ2'];
    $forms_CV_valueQ3 = $_POST['CV_valueQ3'];
    $forms_CV_valueQ4 = $_POST['CV_valueQ4'];

    foreach ($ids as $i => $id) {
        $SR_number = $forms_SR_number[$i];
        $CV_Area = $forms_CV_Area[$i];
        $core_value_subheading = $forms_core_value_subheading[$i];
        $CV_valueQ1 = $forms_CV_valueQ1[$i];
        $CV_valueQ2 = $forms_CV_valueQ2[$i];
        $CV_valueQ3 = $forms_CV_valueQ3[$i];
        $CV_valueQ4 = $forms_CV_valueQ4[$i];

        $check_existing_behaviorData = $mysqli->query("SELECT * FROM behavior WHERE SR_number = '{$SR_number}'");
        if ($check_existing_behaviorData->num_rows > 0) {
            $updateBehavior = $mysqli->query("UPDATE behavior 
                                            SET 
                                            CV_valueQ1 = '$CV_valueQ1',
                                            CV_valueQ2 = '$CV_valueQ2',
                                            CV_valueQ3 = '$CV_valueQ3',
                                            CV_valueQ4 = '$CV_valueQ4'
                                            WHERE SR_number = '$SR_number'");
        } else if ($check_existing_behaviorData->num_rows == 0) {
            $updateBehavior = $mysqli->query("INSERT INTO behavior 
                                            (SR_number, CV_Area, CV_valueQ1, CV_valueQ2, CV_valueQ3, CV_valueQ4) 
                                            VALUES 
                                            ('$SR_number', '$CV_Area', '$CV_valueQ1', '$CV_valueQ2', '$CV_valueQ3', '$CV_valueQ4')");
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
    $S_lname = $mysqli->real_escape_string($_POST['S_lname']);
    $S_fname = $mysqli->real_escape_string($_POST['S_fname']);
    $S_mname    = $mysqli->real_escape_string($_POST['S_mname']);
    $S_suffix = $mysqli->real_escape_string($_POST['S_suffix']);

    $S_age    = $mysqli->real_escape_string($_POST['S_age']);
    $S_birthday = $mysqli->real_escape_string($_POST['S_birthday']);
    $S_birthplace = $mysqli->real_escape_string($_POST['S_birthplace']);
    $S_gender = $mysqli->real_escape_string($_POST['S_gender']);

    $S_religion = $mysqli->real_escape_string($_POST['S_religion']);
    $S_citizenship = $mysqli->real_escape_string($_POST['S_citizenship']);

    $S_address    = $mysqli->real_escape_string($_POST['S_address']);
    $S_barangay    = $mysqli->real_escape_string($_POST['S_barangay']);
    $S_city    = $mysqli->real_escape_string($_POST['S_city']);
    $S_state    = $mysqli->real_escape_string($_POST['S_state']);
    $S_postal    = $mysqli->real_escape_string($_POST['S_postal']);

    $S_guardian    = $mysqli->real_escape_string($_POST['S_guardian']);
    $S_contact    = $mysqli->real_escape_string($_POST['S_contact']);
    $S_email    = $mysqli->real_escape_string($_POST['S_email']);

    $G_lname = $mysqli->real_escape_string($_POST['G_lname']);
    $G_fname = $mysqli->real_escape_string($_POST['G_fname']);
    $G_mname    = $mysqli->real_escape_string($_POST['G_mname']);
    $G_suffix = $mysqli->real_escape_string($_POST['G_suffix']);

    $G_address    = $mysqli->real_escape_string($_POST['G_address']);
    $G_barangay    = $mysqli->real_escape_string($_POST['G_barangay']);
    $G_city    = $mysqli->real_escape_string($_POST['G_city']);
    $G_state    = $mysqli->real_escape_string($_POST['G_state']);
    $G_postal    = $mysqli->real_escape_string($_POST['G_postal']);

    $G_email    = $mysqli->real_escape_string($_POST['G_email']);

    $G_relationshipStudent = $mysqli->real_escape_string($_POST['G_relationshipStudent']);
    $G_telephone    = $mysqli->real_escape_string($_POST['G_telephone']);
    $G_contact    = $mysqli->real_escape_string($_POST['G_contact']);

    $S_grade = $mysqli->real_escape_string($_POST['S_gradelevel']);
    $S_section    = $mysqli->real_escape_string($_POST['S_section']);

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
        $StudentCount = "SELECT COUNT(SR_year) FROM studentrecord WHERE SR_year = '$year'";
        $resultStudentCount = $mysqli->query($StudentCount);
        $getStudentCount = $resultStudentCount->fetch_assoc();

        $format_StudentCounter = sprintf("%05d", ($getStudentCount["COUNT(SR_year)"] + 1));
    }

    $SR_number = $year . "-" . $format_StudentCounter . "-SP";

    $regStudent = "INSERT INTO studentrecord(
                    SR_number, SR_year, 
                    SR_fname, SR_mname, SR_lname, SR_suffix,
                    SR_age, SR_birthday, SR_birthplace, SR_gender,
                    SR_religion, SR_citizenship, SR_grade, SR_section,
                    SR_address, SR_barangay, SR_city, SR_state, SR_postal, 
                    SR_guardian, SR_contact, SR_email)
                    VALUES(
                    '$SR_number', '$year', '$S_lname', '$S_fname', '$S_mname', '$S_suffix',
                    '$S_age', '$S_birthday', '$S_birthplace', '$S_gender',
                    '$S_religion','$S_citizenship', '$S_grade', '$S_section',
                    '$S_address', '$S_barangay', '$S_city', '$S_state', '$S_postal',
                    '$S_guardian', '$S_contact', '$S_email')";
    $RunregStudent = $mysqli->query($regStudent);
    $regGuardian = "INSERT INTO guardian_fetcher(
                    G_guardianOfStudent, 
                    G_fname, G_mname, G_lname, G_suffix,
                    G_address, G_barangay, G_city, G_state, G_postal, 
                    G_email, G_relationshipStudent, G_telephone, G_contact)
                    VALUES(
                    '$SR_number', '$G_lname', '$G_fname', '$G_mname', '$G_suffix',
                    '$G_address', '$G_barangay', '$G_city', '$G_state', '$G_postal',
                    '$G_email', '$G_relationshipStudent', '$G_telephone', '$G_contact')";
    $RunregGuardian = $mysqli->query($regGuardian);
    unset($_SESSION['fromAddStudent']);
    if ($RunregGuardian) {
        header('Location: student.php');
    } else {
        echo "error" . $mysqli->error;
    }
}
if (isset($_POST['updateInformation'])) {
    $S_lname = $mysqli->real_escape_string($_POST['SR_lname']);
    $S_fname = $mysqli->real_escape_string($_POST['SR_fname']);
    $S_mname    = $mysqli->real_escape_string($_POST['SR_mname']);
    $S_suffix = $mysqli->real_escape_string($_POST['SR_suffix']);

    $S_age    = $mysqli->real_escape_string($_POST['SR_age']);
    $S_birthday = $mysqli->real_escape_string($_POST['SR_birthday']);
    $S_birthplace = $mysqli->real_escape_string($_POST['SR_birthplace']);
    $S_gender = $mysqli->real_escape_string($_POST['SR_gender']);

    $S_religion = $mysqli->real_escape_string($_POST['SR_religion']);
    $S_citizenship = $mysqli->real_escape_string($_POST['SR_citizenship']);

    $S_address    = $mysqli->real_escape_string($_POST['SR_address']);
    $S_barangay    = $mysqli->real_escape_string($_POST['SR_barangay']);
    $S_city    = $mysqli->real_escape_string($_POST['SR_city']);
    $S_state    = $mysqli->real_escape_string($_POST['SR_state']);
    $S_postal    = $mysqli->real_escape_string($_POST['SR_postal']);

    $S_email    = $mysqli->real_escape_string($_POST['SR_email']);

    $S_grade = $mysqli->real_escape_string($_POST['SR_gradelevel']);
    $S_section    = $mysqli->real_escape_string($_POST['SR_section']);

    $S_number = $mysqli->real_escape_string($_GET['SR_Number']);

    $updateStudent = "UPDATE studentrecord 
                      SET 
                        SR_lname = '$S_lname',
                        SR_fname = '$S_fname', 
                        SR_mname = '$S_mname',
                        SR_suffix = '$S_suffix',
                        SR_age = '$S_age',
                        SR_birthday = '$S_birthday',
                        SR_birthplace = '$S_birthplace',
                        SR_gender = '$S_gender',
                        SR_religion = '$S_religion',
                        SR_citizenship = '$S_citizenship',
                        SR_address = '$S_address',
                        SR_barangay = '$S_barangay',
                        SR_city = '$S_city',
                        SR_state = '$S_state',
                        SR_postal = '$S_postal',
                        SR_contact = '$S_contact',
                        SR_email = '$S_email',
                        SR_grade = '$S_grade',
                        SR_section = '$S_section'
                      WHERE SR_number = '$S_number'";
    $resultupdateStudent = $mysqli->query($updateStudent);

    if ($resultupdateStudent) {
        header('Location: ../admin/student.php');
    } else {
        echo "error" . $mysqli->error;
    }
}

//MAY MALI DITO
if (isset($_POST['regFaculty'])) {
    $F_department = $mysqli->real_escape_string($_POST['F_department']);

    $F_lname = $mysqli->real_escape_string($_POST['F_lname']);
    $F_fname = $mysqli->real_escape_string($_POST['F_fname']);
    $F_mname = $mysqli->real_escape_string($_POST['F_mname']);
    $F_suffix = $mysqli->real_escape_string($_POST['F_suffix']);

    $F_age = $mysqli->real_escape_string($_POST['F_age']);
    $F_birthday = $mysqli->real_escape_string($_POST['F_birthday']);
    $F_gender = $mysqli->real_escape_string($_POST['F_gender']);

    $F_religion = $mysqli->real_escape_string($_POST['F_religion']);
    $F_citizenship = $mysqli->real_escape_string($_POST['F_citizenship']);

    $F_address = $mysqli->real_escape_string($_POST['F_address']);
    $F_barangay = $mysqli->real_escape_string($_POST['F_barangay']);
    $F_city = $mysqli->real_escape_string($_POST['F_city']);
    $F_state = $mysqli->real_escape_string($_POST['F_state']);
    $F_postal = $mysqli->real_escape_string($_POST['F_postal']);

    $F_contactNumber = $mysqli->real_escape_string($_POST['F_contact']);
    $F_email = $mysqli->real_escape_string($_POST['F_email']);

    //DOUBLE CHECK KUNG TAMA BA KASI MALI YUNG APG GENERATE NG STUDENT NUMBER DI NARESET BACK TO 1 YUNG NUMBER
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

    $regFaculty = "INSERT INTO faculty(
                    F_department, F_number, F_year, F_lname, F_fname, F_mname, F_suffix, 
                    F_age, F_birthday, F_gender, F_religion, F_citizenship, F_address, F_barangay, F_city, F_state, F_postal, 
                    F_contactNumber, F_email)
                   VALUES(
                    '$F_department', '$F_number', '$year', '$F_lname', '$F_fname', '$F_mname', '$F_suffix', 
                    '$F_age', '$F_birthday', '$F_gender', '$F_religion', '$F_citizenship', '$F_address', '$F_barangay', '$F_city', '$F_state', '$F_postal', 
                    '$F_contactNumber', '$F_email')";
    $resultregFaculty = $mysqli->query($regFaculty);
    unset($_SESSION['fromAddFaculty']);
    if ($resultregFaculty) {
        header('Location: ../admin/faculty.php');
    } else {
        echo "error" . $mysqli->error;
    }
}
if (isset($_POST['editFaculty'])) {
    $F_number = $_POST['F_number'];
    $F_department = $mysqli->real_escape_string($_POST['F_department']);

    $F_lname = $mysqli->real_escape_string($_POST['F_lname']);
    $F_fname = $mysqli->real_escape_string($_POST['F_fname']);
    $F_mname = $mysqli->real_escape_string($_POST['F_mname']);
    $F_suffix = $mysqli->real_escape_string($_POST['F_suffix']);

    $F_age = $mysqli->real_escape_string($_POST['F_age']);
    $F_birthday = $mysqli->real_escape_string($_POST['F_birthday']);
    $F_gender = $mysqli->real_escape_string($_POST['F_gender']);

    $F_religion = $mysqli->real_escape_string($_POST['F_religion']);
    $F_citizenship = $mysqli->real_escape_string($_POST['F_citizenship']);

    $F_address = $mysqli->real_escape_string($_POST['F_address']);
    $F_barangay = $mysqli->real_escape_string($_POST['F_barangay']);
    $F_city = $mysqli->real_escape_string($_POST['F_city']);
    $F_state = $mysqli->real_escape_string($_POST['F_state']);
    $F_postal = $mysqli->real_escape_string($_POST['F_postal']);

    $F_contactNumber = $mysqli->real_escape_string($_POST['F_contact']);
    $F_email = $mysqli->real_escape_string($_POST['F_email']);

    $updateFaculty = "UPDATE faculty 
                      SET 
                        F_fname = '$F_fname', 
                        F_mname = '$F_mname',
                        F_lname = '$F_lname',
                        F_suffix = '$F_suffix',
                        F_age = '$F_age',
                        F_birthday = '$F_birthday',
                        F_gender = '$F_gender',
                        F_religion = '$F_religion',
                        F_citizenship = '$F_citizenship',
                        F_address = '$F_address',
                        F_barangay = '$F_barangay',
                        F_city = '$F_city',
                        F_state = '$F_state',
                        F_postal = '$F_postal',
                        F_contactNumber = '$F_contactNumber',
                        F_email = '$F_email'
                      WHERE F_number = '$F_number'";
    $resultupdateFaculty = $mysqli->query($updateFaculty);

    if ($resultupdateFaculty) {
        header('Location: ../admin/faculty.php');
    } else {
        echo "error" . $mysqli->error;
    }
}

if (isset($_POST['UpdateGrade'])) {
    $current_url = $_POST['current_url'];

    $ids = $_POST['row'];
    $forms_SR_number = $_POST['SR_number'];
    $forms_SR_section = $_POST['SR_section'];
    $forms_G_learningArea = $_POST['G_learningArea'];

    $forms_G_gradesQ1 = $_POST['G_gradesQ1'];
    $forms_G_gradesQ2 = $_POST['G_gradesQ2'];
    $forms_G_gradesQ3 = $_POST['G_gradesQ3'];
    $forms_G_gradesQ4 = $_POST['G_gradesQ4'];

    foreach ($ids as $i => $id) {
        $SR_number = $forms_SR_number[$i];
        $SR_section = $forms_SR_section[$i];
        $G_learningArea = $forms_G_learningArea[$i];
        $G_gradesQ1 = $forms_G_gradesQ1[$i];
        $G_gradesQ2 = $forms_G_gradesQ2[$i];
        $G_gradesQ3 = $forms_G_gradesQ3[$i];
        $G_gradesQ4 = $forms_G_gradesQ4[$i];

        $updateGrade = "UPDATE grades 
                        SET 
                        G_gradesQ1 = '$G_gradesQ1',
                        G_gradesQ2 = '$G_gradesQ2',
                        G_gradesQ3 = '$G_gradesQ3',
                        G_gradesQ4 = '$G_gradesQ4'
                        WHERE SR_number = '$SR_number'
                        AND G_learningArea = '$G_learningArea'";
        $resultupdateGrade = $mysqli->query($updateGrade);
    }
    if ($resultupdateGrade) {
        $url_components = parse_url($current_url);
        parse_str($url_components['query'], $params);
        $param1 = $params['Grade'];
        $param2 = $params['Section'];
        $param3 = $params['LearningArea'];

        $url = "../admin/editgrades.php";
        header("Location: " . $url . "?Grade=" . $param1 . "&Section=" . $param2 . "&LearningArea=" . $param3);
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
