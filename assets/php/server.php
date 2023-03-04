<?php
session_start();
include('database.php');
include('mail.php');
global $currentSchoolYear;
$errors = array();
$year = date('Y');
$month = date('m');

$getSchoolYearInfo = $mysqli->query("SELECT * FROM acad_year");
$SchoolYearData = $getSchoolYearInfo->fetch_assoc();
$currentSchoolYear = $SchoolYearData['currentYear'] . "-" . $SchoolYearData['endYear'];

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
if (isset($_POST['verifyEmail'])) {
    $email = $_POST['usersEmail'];

    if (empty($email)) {
        $errors['NoInputs'] = "Please enter your login credentials.";
    } else {
        $authAccount = $mysqli->query("SELECT * FROM userdetails WHERE SR_email = '{$email}'");

        if (mysqli_num_rows($authAccount) == 1) {
            $verifyData = $authAccount->fetch_assoc();

            $check_existingOTP = $mysqli->query("SELECT OTP FROM userdetails WHERE SR_email = '{$email}'");
            $otpData = $check_existingOTP->fetch_assoc();

            if ($otpData['OTP'] == "" || empty($otpData['OTP'])) {
                $otp = generateOTP();
                $createOTP = $mysqli->query("UPDATE userdetails SET OTP = '{$otp}' WHERE SR_email = '{$verifyData['SR_email']}'");
                $_SESSION['verifyEmailData'] = $verifyData['SR_email'];

                $mail->addAddress($verifyData['SR_email']);
                $mail->Subject = 'Password Change Request';

                $mail->Body = '<p>We have received a request to change the password for your email account. 
                            Your one-time password (OTP) code is: <strong>' . $otp . '</strong>.</p>
                            <p>If you did not initiate this request, please ignore this email. 
                            However, we recommend that you change your password as soon as possible to ensure the security of your account. 
                            <br>
                            If you have any questions or concerns, please contact our customer support team. </p>
                            <br>
                            <br>
                            <p>Thank you for using CDSP SIS.</p>
                            <br>
                            <strong>Best regards, </strong><br>
                            <strong>CDSP Admin Office</strong>
                            <br>';
                if ($mail->send()) {
                    header('Location: ../auth/otp.php');
                }
            } else {
                $errors['LoginError'] = "Check your email for the OTP Code.";
            }
        } else {
            $errors['LoginError'] = "Account does not exist!";
        }
    }
}
if (isset($_POST['submitOTP'])) {
    $verifyOTP = $mysqli->query("SELECT OTP FROM userdetails WHERE SR_email = '{$_SESSION['verifyEmailData']}' AND OTP = '{$_POST['OTPCode']}'");

    if (mysqli_num_rows($verifyOTP) == 1) {
        header('Location: ../auth/reset.php');
    } else {
        $errors['LoginError'] = "Incorrect OTP Code.";
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
            $updatePassword = "UPDATE userdetails SET SR_password = '$confirmPassword' WHERE SR_email = '{$_SESSION['verifyEmailData']}'";
            $ResultupdatePassword = $mysqli->query($updatePassword);

            if ($ResultupdatePassword) {
                $mail->addAddress($_SESSION['verifyEmailData']);
                $mail->Subject = 'Password Change Confirmation';

                $mail->Body = '<p>This email is to confirm that your password for your account on CDSP SIS has been successfully changed. 
                                We strongly advise you to keep your new password in a safe place and not share it with anyone.</p>
                                <br>
                                <p>If you did not initiate this password change, please contact the Admin Office immediately. </p>
                                <br>
                                <p>Thank you for using CDSP SIS.</p>
                                <br>
                                <strong>Best regards, </strong><br>
                                <strong>CDSP Admin Office</strong>
                                <br>';
                if ($mail->send()) {
                    $removeOTP = $mysqli->query("UPDATE userdetails SET OTP = NULL WHERE SR_email = '{$verifyData['SR_email']}'");
                    header('Location: login.php');
                }
            }
        }
    }
}
//END

//Student Process
if (isset($_POST['editStudentProfile'])) {
    $SR_fname = $_POST['SR_fname'];
    $SR_mname = $_POST['SR_mname'];
    $SR_lname = $_POST['SR_lname'];
    $SR_suffix = $_POST['SR_suffix'];
    $SR_age = $_POST['SR_age'];
    $SR_gender = $_POST['SR_gender'];
    $SR_birthday = $_POST['SR_birthday'];
    $SR_birthplace = $_POST['SR_birthplace'];
    $SR_religion = $_POST['SR_religion'];
    $SR_citizenship = $_POST['SR_citizenship'];
    $SR_address = $_POST['SR_address'];
    $SR_barangay = $_POST['SR_barangay'];
    $SR_city = $_POST['SR_city'];
    $SR_state = $_POST['SR_state'];
    $SR_postal = $_POST['SR_postal'];
    $SR_email = $_POST['SR_email'];

    $updateStudentInfo = $mysqli->query("UPDATE studentrecord 
                                        SET 
                                        SR_fname = '{$SR_fname}', 
                                        SR_mname = '{$SR_mname}', 
                                        SR_lname = '{$SR_lname}', 
                                        SR_suffix = '{$SR_suffix}', 
                                        SR_gender = '{$SR_gender}', 
                                        SR_age = '{$SR_age}', 
                                        SR_birthday = '{$SR_birthday}', 
                                        SR_birthplace = '{$SR_birthplace}', 
                                        SR_religion = '{$SR_religion}', 
                                        SR_citizenship = '{$SR_citizenship}', 
                                        SR_address = '{$SR_address}', 
                                        SR_barangay = '{$SR_barangay}', 
                                        SR_city = '{$SR_city}', 
                                        SR_state = '{$SR_state}', 
                                        SR_postal = '{$SR_postal}', 
                                        SR_email = '{$SR_email}' 
                                        WHERE SR_number = '{$_POST['SR_number']}'");

    $G_lname = $_POST['G_lname'];
    $G_fname = $_POST['G_fname'];
    $G_mname = $_POST['G_mname'];
    $G_suffix = $_POST['G_suffix'];
    $G_address = $_POST['G_address'];
    $G_barangay = $_POST['G_barangay'];
    $G_city = $_POST['G_city'];
    $G_state = $_POST['G_state'];
    $G_postal = $_POST['G_postal'];
    $G_email = $_POST['G_email'];
    $G_relationshipStudent = $_POST['G_relationshipStudent'];
    $G_telephone = $_POST['G_telephone'];
    $G_contact = $_POST['G_contact'];

    $updateGuardianInfo = $mysqli->query("UPDATE guardian 
                                        SET 
                                        G_lname= '{$G_lname}', 
                                        G_fname = '{$G_fname}', 
                                        G_mname = '{$G_mname}', 
                                        G_suffix = '{$G_suffix}', 
                                        G_address = '{$G_address}', 
                                        G_barangay = '{$G_barangay}', 
                                        G_city = '{$G_city}', 
                                        G_state = '{$G_state}', 
                                        G_postal = '{$G_postal}', 
                                        G_email = '{$G_email}', 
                                        G_relationshipStudent = '{$G_relationshipStudent}', 
                                        G_telephone = '{$G_telephone}', 
                                        G_contact = '{$G_contact}' 
                                        WHERE G_guardianOfStudent = '{$_POST['SR_number']}'");
}

//Faculty Process
if (isset($_POST['student']) || isset($_POST['fetcher'])) {

    $date = date("Y-m-d");
    $time = date("H:i A");

    $studentID = $_POST['student'];
    $fetcherID = $_POST['fetcher'];

    if (empty($fetcherID)) {
        $fetcherID = $studentID;
    } else {
        $fetcherID = $fetcherID;
    }

    $checkAttendance = $mysqli->query("SELECT * FROM attendance WHERE SR_number = '{$studentID}' AND A_date = '{$date}'");
    $attendanceData = $checkAttendance->fetch_assoc();

    $sendtoGuardianData = $mysqli->query("SELECT G_email FROM guardian WHERE G_guardianOfStudent 
                                        IN 
                                        (SELECT SR_number FROM classlist WHERE SR_number = '{$studentID}' AND acadYear = '{$currentSchoolYear}')");
    $sendtoGuardian = $sendtoGuardianData->fetch_assoc();
    if ($checkAttendance->num_rows == 0) {
        $timeIN = $mysqli->query("INSERT INTO attendance (SR_number, A_date, A_time_IN, A_fetcher_IN) VALUES ('{$studentID}', '{$date}', '{$time}', '{$fetcherID}')");
        $mail->addAddress($sendtoGuardian['G_email']);
        $mail->Subject = 'Attendance: Time In';

        $mail->Body = '<h1>Student Timed In</h1>
                       <br>
                       <p>ATTENDANCE DETAILS</p><br>
                       <b>Time: </b>' . $time . '<br>
                       <b>Date: </b>' . $date . '<br>';
        $mail->send();
    } else if (empty($attendanceData['A_time_OUT']) || empty($attendanceData['A_fetcher_OUT'])) {
        $timeOUT = $mysqli->query("UPDATE attendance SET A_time_OUT = '{$time}', A_fetcher_OUT = '{$fetcherID}' WHERE SR_number = '{$studentID}'");
        $mail->addAddress($sendtoGuardian['G_email']);
        $mail->Subject = 'Attendance: Time Out';

        $mail->Body = '<h1>Student Timed Out</h1>
                       <br>
                       <p>Attendance Detail</p><br>
                       <b>Fetched by: </b>' . $time . '<br>
                       <b>Date: </b>' . $date . '<br>
                       <b>Fetched By: </b>' . $fetcherID . '<br>';
        $mail->send();
    }
}
if (isset($_POST['encodeGrade'])) {
    $ids = $_POST['row'];
    $forms_SR_number = $_POST['SR_number'];
    $forms_Grade = $_POST['Grade'];
    $forms_Section = $_POST['Section'];
    $forms_Subject = $_POST['Subject'];

    $forms_G_gradesQ1 = $_POST['G_gradesQ1'];
    $forms_G_gradesQ2 = $_POST['G_gradesQ2'];
    $forms_G_gradesQ3 = $_POST['G_gradesQ3'];
    $forms_G_gradesQ4 = $_POST['G_gradesQ4'];
    $forms_FinalGrade = $_POST['FinalGrade'];

    if (isset($_POST['G_gradesQ1'])) {
        foreach ($ids as $i => $id) {
            $SR_number = $forms_SR_number[$i];
            $Grade = $forms_Grade[$i];
            $Section = $forms_Section[$i];
            $Subject = $forms_Subject[$i];

            $G_gradesQ1 = $forms_G_gradesQ1[$i];

            $mysqli->query("INSERT INTO grades(SR_number, acadYear, SR_gradeLevel, SR_section, G_learningArea, G_gradesQ1)
                            VALUES ('{$SR_number}', '{$currentSchoolYear}', '{$Grade}', '{$Section}', '{$Subject}', '{$G_gradesQ1}')");
        }
    } elseif (isset($_POST['G_gradesQ2']) || isset($_POST['G_gradesQ3']) || isset($_POST['G_gradesQ4'])) {
        foreach ($ids as $i => $id) {
            $SR_number = $forms_SR_number[$i];
            $Grade = $forms_Grade[$i];
            $Section = $forms_Section[$i];
            $Subject = $forms_Subject[$i];

            $G_gradesQ2 = $forms_G_gradesQ2[$i];
            $G_gradesQ3 = $forms_G_gradesQ3[$i];
            $G_gradesQ4 = $forms_G_gradesQ4[$i];
            $FinalGrade = $forms_FinalGrade[$i];

            $mysqli->query("UPDATE grades SET G_gradesQ2 = '{$G_gradesQ1}', G_gradesQ3 = '{$G_gradesQ1}', G_gradesQ4 = '{$G_gradesQ1}', G_finalgrade = '{$FinalGrade}'
                            WHERE SR_number = '{$SR_number}' AND acadYear = '{$currentSchoolYear}'");
        }
    }
}
if (isset($_POST['saveBehavior'])) {
    $ids = $_POST['row'];
    $forms_SR_number = $_GET['viewStudent'];
    $forms_CV_Area = $_POST['CV_Area'];

    $forms_CV_valueQ1 = $_POST['CV_valueQ1'];
    $forms_CV_valueQ2 = $_POST['CV_valueQ2'];
    $forms_CV_valueQ3 = $_POST['CV_valueQ3'];
    $forms_CV_valueQ4 = $_POST['CV_valueQ4'];

    foreach ($ids as $i => $id) {
        $SR_number = $forms_SR_number;
        $CV_Area = $forms_CV_Area[$i];
        $CV_valueQ1 = $forms_CV_valueQ1[$i];
        $CV_valueQ2 = $forms_CV_valueQ2[$i];
        $CV_valueQ3 = $forms_CV_valueQ3[$i];
        $CV_valueQ4 = $forms_CV_valueQ4[$i];

        $check_existing_behaviorData = $mysqli->query("SELECT * FROM behavior WHERE SR_number = '{$SR_number}'");
        if ($check_existing_behaviorData->num_rows > 0) {
            $updateBehavior = $mysqli->query("UPDATE behavior SET CV_valueQ1 = '$CV_valueQ1', CV_valueQ2 = '$CV_valueQ2', CV_valueQ3 = '$CV_valueQ3', CV_valueQ4 = '$CV_valueQ4' 
                                                WHERE SR_number = '$SR_number' AND CV_Area = '$CV_Area'");
        } else if ($check_existing_behaviorData->num_rows == 0) {
            $updateBehavior = $mysqli->query("INSERT INTO behavior 
                                            (SR_number, CV_Area, CV_valueQ1, CV_valueQ2, CV_valueQ3, CV_valueQ4) 
                                            VALUES 
                                            ('$SR_number', '$CV_Area', '$CV_valueQ1', '$CV_valueQ2', '$CV_valueQ3', '$CV_valueQ4')");
        } else {
            echo "error";
        }
    }
}
if (isset($_POST['updateProfile'])) {
    $F_department = $mysqli->real_escape_string($_POST['F_department']);
    $F_fname = $mysqli->real_escape_string($_POST['F_fname']);
    $F_mname    = $mysqli->real_escape_string($_POST['F_mname']);
    $F_lname = $mysqli->real_escape_string($_POST['F_lname']);
    $F_suffix = $mysqli->real_escape_string($_POST['F_suffix']);

    $F_age    = $mysqli->real_escape_string($_POST['F_age']);
    $F_birthday = $mysqli->real_escape_string($_POST['F_birthday']);
    $F_gender = $mysqli->real_escape_string($_POST['F_gender']);

    $F_religion = $mysqli->real_escape_string($_POST['F_religion']);
    $F_citizenship = $mysqli->real_escape_string($_POST['F_citizenship']);

    $F_address    = $mysqli->real_escape_string($_POST['F_address']);
    $F_barangay    = $mysqli->real_escape_string($_POST['F_barangay']);
    $F_city    = $mysqli->real_escape_string($_POST['F_city']);
    $F_postal    = $mysqli->real_escape_string($_POST['F_postal']);

    $F_contactNumber    = $mysqli->real_escape_string($_POST['F_contact']);

    $updateFaculty = "UPDATE faculty 
                      SET 
                        F_department = '$F_department',
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
                        F_postal = '$F_postal',
                        F_contactNumber = '$F_contactNumber'
                      WHERE F_number = '{$_SESSION['F_number']}'";
    $resultupdateFaculty = $mysqli->query($updateFaculty);
}
if (isset($_POST['addReminders'])) {
    $author = $mysqli->real_escape_string($_POST['author']);
    $subject = $mysqli->real_escape_string($_POST['subject']);
    $forsection = $mysqli->real_escape_string($_POST['forsection']);
    $MSG = $mysqli->real_escape_string($_POST['MSG']);
    $date = $mysqli->real_escape_string($_POST['date']);
    $dateposted = date("Y/m/d");

    $addReminders = $mysqli->query("INSERT INTO reminders(header, date_posted, author, subject, forsection, msg, deadline) VALUE ('$dateposted', '$author','$subject', '$forsection','$MSG', '$date')");

    if ($addReminders) {
        $sendtoGuardianData = $mysqli->query("SELECT G_email FROM guardian WHERE G_guardianOfStudent 
                                            IN 
                                            (SELECT SR_number FROM classlist WHERE SR_section = '{$forsection}' AND acadYear = '{$currentSchoolYear}')");
        while ($sendtoGuardian = $sendtoGuardianData->fetch_assoc()) {
            $mail->addAddress($sendtoGuardian['G_email']);
            $mail->Subject = $subject;

            $mail->Body = '<h1>School Annoucement</h1><br>
                               <p>' . $message . '</p><br>';
            $mail->send();
        }
        $sendtoStudentData = $mysqli->query("SELECT SR_email FROM studentrecord WHERE SR_number 
                                            IN 
                                            (SELECT SR_number FROM classlist WHERE SR_section = '{$forsection}' AND acadYear = '{$currentSchoolYear}')");
        while ($sendtoStudent = $sendtoStudentData->fetch_assoc()) {
            $mail->addAddress($sendtoStudent['SR_email']);
            $mail->Subject = $subject;

            $mail->Body = '<h1>School Annoucement</h1><br>
                               <p>' . $message . '</p><br>';
            $mail->send();
        }
        header('Location: ../faculty/reminders.php');
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
if (isset($_POST['attendanceReport']) && isset($_SESSION['F_number'])) {
    $F_number = $_SESSION['F_number'];
    $subjectName = $_GET['subject'];
    $SR_number = $_POST['SR_number'];
    $SR_grade = $_GET['SR_grade'];
    $SR_section = $_GET['SR_section'];
    $RP_reportDate = $_POST['RP_reportDate'];
    $RP_reportTime = $_POST['RP_reportTime'];
    $RP_attendanceReport = $_POST['RP_attendanceReport'];

    $reportAttendanceIssue = $mysqli->query("INSERT INTO attendance_student_report(F_number, subjectName, SR_number, SR_grade, SR_section, RP_reportDate, RP_reportTime, RP_attendanceReport)
                                            VALUES('{$F_number}', '{$subjectName}', '{$SR_number}', '{$SR_grade}', '{$SR_section}', '{$RP_reportDate}', '{$RP_reportTime}', '{$RP_attendanceReport}')");
}
//End

//Admin Process
if (isset($_POST['regStudent'])) {
    $SR_LRN = $mysqli->real_escape_string($_POST['LRN']);

    $SR_profile_img = $_FILES['image']['tmp_name'];

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

    $checkSR_email = $mysqli->query("SELECT SR_email FROM studentrecord WHERE SR_email = '{$S_email}'");
    if (mysqli_num_rows($checkSR_email) == 0) {
        if (isset($_POST['Fetcher'])) {
            $SR_servicetype = "WITHFETCHER";
        }
        if (!isset($_POST['Fetcher']) && !isset($_POST['NoFetcher'])) {
            $SR_servicetype = "NOFETCHER";
        }
        if (isset($_POST['NoFetcher'])) {
            $SR_servicetype = "NOFETCHER";
        }

        $regStudent = "INSERT INTO studentrecord(
                        SR_profile_img, SR_number, SR_fname, SR_mname, SR_lname, SR_suffix, 
                        SR_gender, SR_age, SR_birthday, SR_birthplace, SR_religion, 
                        SR_citizenship, SR_grade, SR_section, SR_servicetype, SR_address, 
                        SR_barangay, SR_city, SR_state, SR_postal, SR_email)
                        VALUES(
                        '$SR_profile_img', '$SR_LRN', '$S_lname', '$S_fname', '$S_mname', '$S_suffix',
                        '$S_age', '$S_birthday', '$S_birthplace', '$S_gender', '$S_religion',
                        '$S_citizenship', '$S_grade', '$S_section', '$SR_servicetype', '$S_address', 
                        '$S_barangay', '$S_city', '$S_state', '$S_postal', '$S_email')";
        $RunregStudent = $mysqli->query($regStudent);
        $regGuardian = "INSERT INTO guardian(
                        G_guardianOfStudent,
                        G_lname, G_fname, G_mname, G_suffix,
                        G_address, G_barangay, G_city, G_state, G_postal, 
                        G_email, G_relationshipStudent, G_telephone, G_contact)
                        VALUES(
                        '$SR_LRN',
                        '$G_lname', '$G_fname', '$G_mname', '$G_suffix',
                        '$G_address', '$G_barangay', '$G_city', '$G_state', '$G_postal',
                        '$G_email', '$G_relationshipStudent', '$G_telephone', '$G_contact')";
        $RunregGuardian = $mysqli->query($regGuardian);

        $addtoClasslist = $mysqli->query("INSERT INTO classlist(acadYear, SR_number, SR_grade, SR_section)
        VALUES('{$currentSchoolYear}', '{$SR_LRN}', '{$S_grade}', '{$S_section}')");

        unset($_SESSION['fromAddStudent']);
        if ($RunregGuardian) {
            $GenPass = generatePassword();
            $createStudentLoginCredentials = $mysqli->query("INSERT INTO userdetails(SR_email, SR_password, role) VALUES ('$S_email', '$GenPass', 'student')");

            $mail->addAddress($S_email);
            $mail->Subject = 'STUDENT REGISTRATION';

            $mail->Body = '<h1>Registration Complete</h1>
                           <br>
                           <p>Your login credentials is:</p><br>
                           <b>Email: </b>' . $S_email . '<br>
                           <b>Password: </b>' . $GenPass . '<br>
                           <br>
                           <strong>IT IS RECOMMENDED TO RESET YOUR PASSWORD</strong><br>
                           <a href="siscdsp.online/auth/login.php">Login now</a>';
            $mail->send();
            $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
            $AdminName = $getAdminName->fetch_assoc();
            $AD_action = "REGISTERED STUDENT - " . $SR_LRN;
            $currentDate = date("Y-m-d");
            $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
            VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
        }
    } else {
        echo "ERROR";
    }
}
if (isset($_POST['createFetcher'])) {
    $FTH_name = $_POST['FTH_name'];
    $FTH_contactNo = $_POST['FTH_contact'];
    $FTH_email = $_POST['FTH_email'];

    $getLastFTH = $mysqli->query("SELECT G_ID FROM fetcher_data ORDER BY G_ID LIMIT 1");
    $FTHData = $getLastFTH->fetch_assoc();
    if ($FTHData['G_ID'] = 0) {
        $FTHData['G_ID'] = $FTHData['G_ID'] + 1;
    }
    $Plus1 = $FTHData['G_ID'] + 1;
    $padding_length = 5;
    $padding_character = '0';
    $formatted_number = str_pad($Plus1, $padding_length, $padding_character, STR_PAD_LEFT);

    $FTH_number = date("Y") . "-" . $formatted_number . "-FTH";

    if (isset($_POST['FTH_linkedTo'])) {
        $FTH_linkedTo = $_POST['FTH_linkedTo'];
        $checkFetcherLimit = $mysqli->query("SELECT COUNT(FTH_number) FROM fetcher_data WHERE FTH_linkedTo = '{$FTH_linkedTo}'");
        $countFetcher = $checkFetcherLimit->fetch_assoc();
        if ($countFetcher['COUNT(FTH_number)'] < 4) {
            $addFetcher = $mysqli->query("INSERT INTO fetcher_data (FTH_number, FTH_name, FTH_contactNo, FTH_email) 
                                VALUES ('{$FTH_number}', '{$FTH_name}', '{$FTH_contactNo}', '{$FTH_email}')");
        }
    } else {
        $addFetcher = $mysqli->query("INSERT INTO fetcher_data (FTH_number, FTH_name, FTH_contactNo, FTH_email) 
                            VALUES ('{$FTH_number}', '{$FTH_name}', '{$FTH_contactNo}', '{$FTH_email}')");
    }
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "REGISTERED FETCHER - " . $FTH_number;
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}

//OPTIONAL
if (isset($_POST['updateInfoFetcher']) && isset($_POST['FTH_linkedTo'])) {
    $FTH_name = $_POST['FTH_name'];
    $FTH_contact = $_POST['FTH_contact'];
    $FTH_email = $_POST['FTH_email'];
    $FTH_linkedTo = $_POST['FTH_linkedTo'];
    $FTH_number = $_POST['FTH_number'];

    $updateFetcher = $mysqli->query("UPDATE fetcher_data SET FTH_name = '{$FTH_name}', FTH_contactNo = '{$FTH_contactNo}', FTH_email = '{$FTH_email}') WHERE FTH_number = '{$FTH_number}'");
}
if (isset($_POST['deleteFetcher']) && isset($_POST['FTH_number'])) {
    $FTH_number = $_POST['FTH_number'];

    $deleteFetcher = $mysqli->query("DELETE FROM fetcher_data WHERE FTH_number = '{$FTH_number}'");
}
if (isset($_POST['linkFetcher']) && isset($_POST['FTH_linkedTo'])) {
    $FTH_name = $_POST['FTH_name'];
    $FTH_contact = $_POST['FTH_contact'];
    $FTH_email = $_POST['FTH_email'];
    $FTH_linkedTo = $_POST['FTH_linkedTo'];
    $FTH_number = $_POST['FTH_number'];

    $checkFetcherLimit = $mysqli->query("SELECT COUNT(FTH_number) FROM fetcher_data WHERE FTH_linkedTo = '{$FTH_linkedTo}'");
    $countFetcher = $checkFetcherLimit->fetch_assoc();
    if ($countFetcher['COUNT(FTH_number)'] < 4) {
        $linkFetcher = $mysqli->query("INSERT INTO fetcher_data (FTH_number, FTH_name, FTH_contactNo, FTH_email, FTH_linkedTo) 
                                VALUES ('{$FTH_number}', '{$FTH_name}', '{$FTH_contactNo}', '{$FTH_email}', '{$FTH_linkedTo}')");
    }
}
if (isset($_POST['unlinkFetcher']) && isset($_POST['FTH_linkedTo'])) {
    $FTH_linkedTo = $_POST['FTH_linkedTo'];
    $FTH_number = $_POST['FTH_number'];

    $unlinkFetcher = $mysqli->query("DELETE FROM fetcher_list WHERE FTH_number = '{$FTH_number}' WHERE FTH_linkedTo = '{$FTH_linkedTo}'");
}
//OPTIONAL

if (isset($_POST['updateInformation']) && !empty($_SESSION['AD_number'])) {
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
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "UPDATED INFORMATION - " . $S_number;
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['regFaculty']) && !empty($_SESSION['AD_number'])) {
    $F_profile_img = $_FILES['image']['name'];
    $F_status = "TEACHING";
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
    $F_city = $mysqli->real_escape_string($_POST['F_city']); //need ayusin
    $F_state = $mysqli->real_escape_string($_POST['F_state']);
    $F_postal = $mysqli->real_escape_string($_POST['F_postal']);
    $F_contactNumber = $mysqli->real_escape_string($_POST['F_contactNumber']);
    $F_email = $mysqli->real_escape_string($_POST['F_email']);

    $getFacultyID = $mysqli->query("SELECT F_ID FROM faculty ORDER BY F_ID DESC LIMIT 1");
    $FacultyID = $getFacultyID->fetch_assoc();

    if (mysqli_num_rows($getFacultyID) > 0) {
        $formatted_FacultyID = sprintf("%05d", ($FacultyID["F_ID"] + 1));
        $F_number = $year . "-" . $formatted_FacultyID . "-F";

        $regFaculty = "INSERT INTO faculty(
                        F_profile_img, F_number, F_status, F_lname, F_fname, F_mname, F_suffix, 
                        F_age, F_birthday, F_gender, F_religion, F_citizenship, 
                        F_address, F_barangay, F_city, F_state, F_postal, F_contactNumber, F_email)
                       VALUES(
                        '{$F_profile_img}', '{$F_number}', '{$F_status}', '{$F_lname}', '{$F_fname}', '{$F_mname}', '{$F_suffix}', 
                        '{$F_age}', '{$F_birthday}', '{$F_gender}', '{$F_religion}', '{$F_citizenship}', 
                        '{$F_address}', '{$F_barangay}', '{$F_city}', '{$F_state}', '{$F_postal}', '{$F_contactNumber}', '{$F_email}')";
        $resultregFaculty = $mysqli->query($regFaculty);
        unset($_SESSION['fromAddFaculty']);
        if ($resultregFaculty) {
            $GenPass = generatePassword();
            $createStudentLoginCredentials = $mysqli->query("INSERT INTO userdetails(SR_email, SR_password, role)
                                                             VALUES ('$F_email', '$GenPass', 'faculty')");
            $Fullname = $F_lname . ", " . $F_fname . " " . $F_mname . " " . $F_suffix;

            $mail->addAddress($F_email);
            $mail->Subject = 'FACULTY REGISTRATION';

            $mail->Body = '<h1>Registration Complete</h1>
                           <br>
                           <p>Your login credentials is:</p><br>
                           <b>Email: </b>' . $F_email . '<br>
                           <b>Password: </b>' . $GenPass . '<br>
                           <br>
                           <strong>IT IS RECOMMENDED TO RESET YOUR PASSWORD</strong><br>
                           <a href="siscdsp.online/auth/login.php">Login now</a>';

            $mail->send();
        }
        $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
        $AdminName = $getAdminName->fetch_assoc();
        $AD_action = "REGISTERED TEACHER - " . $F_number;
        $currentDate = date("Y-m-d");
        $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
        VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
    }
}
if (isset($_POST['editFaculty']) && !empty($_SESSION['AD_number'])) {
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
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "EDIT TEACHER INFORMATION - " . $F_number;
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['UpdateGrade']) && !empty($_SESSION['AD_number'])) {
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
    }
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "CHANGES WITH GRADES";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['releaseGrades']) && !empty($_SESSION['AD_number'])) {
    $grade =  $_GET['Grade'];
    $section = $_GET['Section'];

    $getUnreleasedGrades = $mysqli->query("SELECT * FROM grades WHERE SR_gradeLevel = '{$grade}' AND SR_section = '{$section}' AND acadYear = '{$currentSchoolYear}'");
    while ($Grades = $getUnreleasedGrades->fetch_assoc()) {
        $checkIfexisting = $mysqli->query("SELECT * FROM student_grades WHERE SR_gradeLevel = '{$grade}' AND SR_section = '{$section}' AND acadYear = '{$currentSchoolYear}'");
        if (mysqli_num_rows($checkIfexisting) > 0) {
            $updateIfexistingUnreleasedGrades = $mysqli->query("UPDATE student_grades 
                                                            SET G_gradesQ1 = '{$Grades['G_gradesQ1']}', 
                                                                G_gradesQ2 = '{$Grades['G_gradesQ2']}', 
                                                                G_gradesQ3 = '{$Grades['G_gradesQ3']}', 
                                                                G_gradesQ4 = '{$Grades['G_gradesQ4']}', 
                                                                G_finalgrade = '{$Grades['G_finalgrade']}'
                                                            WHERE
                                                            SR_number = '{$Grades['SR_number']}' AND
                                                            acadYear = '{$Grades['acadYear']}' AND
                                                            SR_gradeLevel = '{$Grades['SR_gradeLevel']}' AND 
                                                            SR_section = '{$Grades['SR_section']}' AND
                                                            G_learningArea = '{$Grades['G_learningArea']}'");
        } else {
            $insertUnreleasedGrades = $mysqli->query("INSERT INTO student_grades(SR_number, acadYear, SR_gradeLevel, SR_section, G_learningArea, G_gradesQ1, G_gradesQ2, G_gradesQ3, G_gradesQ4, G_finalgrade)
                                                      VALUES('{$Grades['SR_number']}', '{$Grades['acadYear']}', '{$Grades['SR_gradeLevel']}', '{$Grades['SR_section']}', '{$Grades['G_learningArea']}', 
                                                             '{$Grades['G_gradesQ1']}', '{$Grades['G_gradesQ2']}', '{$Grades['G_gradesQ3']}', '{$Grades['G_gradesQ4']}', '{$Grades['G_finalgrade']}')");
        }
    }
}
if (isset($_POST['addSubject']) && !empty($_SESSION['AD_number'])) {
    $subjectName = $mysqli->real_escape_string($_POST['sbjName']);
    $minYearLevel = $mysqli->real_escape_string($_POST['minYearLevel']);
    $maxYearLevel = $mysqli->real_escape_string($_POST['maxYearLevel']);

    $addSubject = $mysqli->query("INSERT INTO subjectperyear(subjectName, minYearLevel, maxYearLevel) VALUES('{$subjectName}','{$minYearLevel}','{$maxYearLevel}')");
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "ADDED SUBJECT -" . $subjectName . " WITH MIN LEVEL " . $minYearLevel . " AND " . $maxYearLevel;
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['updateCurr']) && !empty($_SESSION['AD_number'])) {
    $subjectName = $_POST['sbjName'];
    $minYearLevel = $_POST['minYearLevel'];
    $maxYearLevel = $_POST['maxYearLevel'];

    $updateSubject = $mysqli->query("UPDATE subjectperyear SET minYearLevel = '$minYearLevel', maxYearLevel = '$maxYearLevel' WHERE subjectName = '$subjectName'");
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "UPDATED SUBJECT -" . $subjectName . " WITH MIN LEVEL " . $minYearLevel . " AND MAX LEVEL" . $maxYearLevel;
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['deleteCurr']) && !empty($_SESSION['AD_number'])) {
    $subjectName = $mysqli->real_escape_string($_POST['sbjName']);
    $minYearLevel = $mysqli->real_escape_string($_POST['minYearLevel']);
    $maxYearLevel = $mysqli->real_escape_string($_POST['maxYearLevel']);

    $deleteSubject = $mysqli->query("DELETE from subjectperyear WHERE minYearLevel = '{$minYearLevel}' AND maxYearLevel = '{$maxYearLevel}' AND subjectName = '{$subjectName}'");
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "DELETED SUBJECT -" . $subjectName . " WITH MIN LEVEL " . $minYearLevel . " AND MAX LEVEL" . $maxYearLevel;
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['addAdmin']) && !empty($_SESSION['AD_number'])) {
    $adminName = $mysqli->real_escape_string($_POST['adminName']);
    $adminEmail = $mysqli->real_escape_string($_POST['adminEmail']);
    $adminPassword    = $mysqli->real_escape_string($_POST['adminPassword']);
    $confirmPassword = $mysqli->real_escape_string($_POST['confirmPassword']);

    if (empty($adminPassword) && empty($confirmPassword)) {
        $errors['NoInputs'] = "Please enter your new password.";
    } elseif (strcmp($adminPassword, $confirmPassword)) {
        $errors['NoMatch'] = "Password does not match.";
    } else {
        $checkAdminEmail = $mysqli->query("SELECT * FROM admin_accounts WHERE AD_email = '{$adminEmail}'");
        if ($checkAdminEmail->num_rows == 1) {
            $errors['existing'] = "Email Already exist.";
        } else {
            $adData = date('Y');
            $randNum = rand(1000, 9999);
            $AD_number = $adData . "-" . $randNum;
            $addAdminAccount = $mysqli->query("INSERT INTO admin_accounts (AD_number, AD_name, AD_email, AD_password) VALUES ('$AD_number', '$adminName', '$adminEmail', '$confirmPassword')");
        }
    }
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "ADDED ADMIN ACCOUNT " . $adminName;
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['setSchedule']) && !empty($_SESSION['AD_number'])) {
    $assignedFaculty = $_POST['assignedFaculty'];
    $subjectname = $_POST['subjectname'];
    $input_start = $_POST['WS_start_time'];
    $input_end = timeMinusOneMinute($_POST['WS_end_time']);

    $time_intervals  = array();

    $checkTeacherSchedule = $mysqli->query("SELECT WS_start_time, WS_end_time FROM workschedule WHERE F_number = '{$assignedFaculty}'");
    while ($TeacherSchedule = $checkTeacherSchedule->fetch_assoc()) {
        $time_intervals[] = $TeacherSchedule;
    }

    $overlapping_interval = null;
    foreach ($time_intervals as $interval) {
        $interval_start = strtotime($interval['WS_start_time']);
        $interval_end = strtotime($interval['WS_end_time']);
        $input_start_time = strtotime($input_start);
        $input_end_time = strtotime($input_end);
        if (($input_start_time >= $interval_start && $input_start_time <= $interval_end) || ($input_end_time >= $interval_start && $input_end_time <= $interval_end)) {
            $overlapping_interval = $interval;
            break;
        }
    }
    if ($overlapping_interval) {
        $errors['nocontent'] = "The input time overlaps with the following interval: Start Time: " . $overlapping_interval['WS_start_time'] . ", End Time: " . timePlusOneMinute($overlapping_interval['WS_end_time']) . ".";
    } else {
        $AddSchedule = $mysqli->query("INSERT INTO workschedule(acadYear, F_number, S_subject, SR_grade, SR_section, WS_start_time, WS_end_time) VALUES('{$currentSchoolYear}', '{$assignedFaculty}', '{$subjectname}', '{$_GET['GradeLevel']}', '{$_GET['SectionName']}', '{$input_start}', '{$input_end}')");
    }
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "ADDED SCHEDULE FOR " . $assignedFaculty . "FOR SECTION" . $_GET['SectionName'];
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['updateSchedule']) && !empty($_SESSION['AD_number'])) {
    $assignedFaculty = $_POST['assignedFaculty'];
    $subjectname = $_POST['subjectname'];
    $input_start = $_POST['WS_start_time'];
    $input_end = $_POST['WS_end_time'];

    $time_intervals  = array();

    $checkTeacherSchedule = $mysqli->query("SELECT WS_start_time, WS_end_time FROM workschedule WHERE F_number = '{$assignedFaculty}'");
    while ($TeacherSchedule = $checkTeacherSchedule->fetch_assoc()) {
        $time_intervals[] = $TeacherSchedule;
    }

    $overlapping_interval = null;
    foreach ($time_intervals as $interval) {
        $interval_start = strtotime($interval['WS_start_time']);
        $interval_end = strtotime($interval['WS_end_time']);
        $input_start_time = strtotime($input_start);
        $input_end_time = strtotime($input_end);
        if (($input_start_time >= $interval_start && $input_start_time <= $interval_end) || ($input_end_time >= $interval_start && $input_end_time <= $interval_end)) {
            $overlapping_interval = $interval;
            break;
        }
    }
    if ($overlapping_interval) {
        $errors['nocontent'] = "The input time overlaps with the following interval: Start Time: " . $overlapping_interval['WS_start_time'] . ", End Time: " . $overlapping_interval['WS_end_time'] . ".";
    } else {
        $UpdateSchedule = $mysqli->query("UPDATE workschedule SET F_number = '{$assignedFaculty}', WS_start_time = '{$input_start}', WS_end_time = '{$input_end}' 
                                    WHERE S_subject = '{$subjectname}' AND SR_grade = '{$_GET['GradeLevel']}' AND SR_section = '{$_GET['SectionName']}' AND acadYear = '{$currentSchoolYear}'");
    }
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "UPDATED SCHEDULE OF " . $assignedFaculty . "FOR SECTION" . $_GET['SectionName'];
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['deleteSchedule']) && !empty($_SESSION['AD_number'])) {
    $assignedFaculty = $_POST['assignedFaculty'];
    $subjectname = $_POST['subjectname'];
    $input_start = $_POST['WS_start_time'];
    $input_end = $_POST['WS_end_time'];

    $deleteSchedule = $mysqli->query("DELETE FROM workschedule WHERE acadYear = '{$currentSchoolYear}' AND F_number = '{$assignedFaculty}' AND S_subject = '{$subjectname}' AND SR_grade = '{$_GET['GradeLevel']}' AND SR_section = '{$_GET['SectionName']}' AND WS_start_time = '{$input_start}' AND WS_end_time = '{$input_end}'");
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "DELETED SCHEDULE OF " . $assignedFaculty . "FOR SECTION" . $_GET['SectionName'];
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['postAnnouncement']) && !empty($_SESSION['AD_number'])) {
    $author = $_POST['author'];
    $date = $_POST['date'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $CreateAnnouncement = $mysqli->query("INSERT INTO announcement(header, author, date, msg) VALUE('{$subject}', '{$author}', '{$date}', '{$message}')");

    if ($CreateAnnouncement) {
        $sendtoGuardianData = $mysqli->query("SELECT G_email FROM guardian WHERE G_guardianOfStudent 
                                        IN 
                                        (SELECT SR_number FROM classlist WHERE acadYear = '{$currentSchoolYear}')");
        while ($sendtoGuardian = $sendtoGuardianData->fetch_assoc()) {
            $mail->addAddress($sendtoGuardian['G_email']);
            $mail->Subject = $subject;

            $mail->Body = '<h1>School Annoucement</h1><br>
                           <p>' . $message . '</p><br>';
            $mail->send();
        }
        $sendtoStudentData = $mysqli->query("SELECT SR_email FROM studentrecord WHERE SR_number 
                                            IN 
                                            (SELECT SR_number FROM classlist WHERE acadYear = '{$currentSchoolYear}')");
        while ($sendtoStudent = $sendtoStudentData->fetch_assoc()) {
            $mail->addAddress($sendtoStudent['SR_email']);
            $mail->Subject = $subject;

            $mail->Body = '<h1>School Annoucement</h1><br>
                            <p>' . $message . '</p><br>';
            $mail->send();
        }
    }
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "POSTED ANNOUNCEMENT";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['assignAdvisor']) && !empty($_SESSION['AD_number'])) {
    $section = $_POST['section'];
    $advisor = $_POST['advisor'];

    $assignSectionsAdvisor = $mysqli->query("UPDATE sections SET S_adviser = '{$advisor}' WHERE S_name = '{$section}' AND acadYear = '{$currentSchoolYear}'");
    $assignClassListAdvisor = $mysqli->query("UPDATE classlist SET F_number = '{$advisor}' WHERE SR_section = '{$section}' AND acadYear = '{$currentSchoolYear}'");
    $AD_action = "ASSIGNED ADVISOR FOR SECTION " . $section;
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['moveUpStatus']) && !empty($_SESSION['AD_number'])) {
    $FormsSR_number = $_POST['SR_number'];
    $FormsGrade = $_POST['Grade'];
    $FormsSection = $_POST['Section'];
    $FormsstudentStatus = $_POST['studentStatus'];
    $FormsmoveUpTo = $_POST['moveUpTo'];

    foreach ($ids as $i => $id) {
        $SR_number = $FormsSR_number[$i];
        $Grade = $FormsGrade[$i];
        $Section = $FormsSection[$i];
        $studentStatus = $FormsstudentStatus[$i];
        $moveUpTo = $FormsmoveUpTo[$i];

        //update student record => grade amd section
        $updateCurrentGradeSection = $mysqli->query("UPDATE studentrecord SET SR_grade = '$Grade', SR_section = '$Section' WHERE SR_number = '$SR_number'");

        //insert into classlist
        $insertIntoClassList = $mysqli->query("INSERT INTO classlist (acadYear, SR_number, SR_grade, SR_section) VALUES ('$currentSchoolYear', '$SR_number', '$Grade', '$Section')");
    }
    $assignClassListAdvisor = $mysqli->query("UPDATE classlist SET F_number = '{$advisor}' WHERE SR_section = '{$section}' AND acadYear = '{$currentSchoolYear}'");
    $AD_action = "UPDATED STUDENT GRADE LEVEL";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['changeto']) && !empty($_SESSION['AD_number'])) {
    $SR_number = $_POST['SR_number'];
    $changeto = $_POST['changeto'];

    $movetoSection = $mysqli->query("UPDATE classlist SET SR_section = '{$changeto}' 
    WHERE acadYear = '{$currentSchoolYear}' AND SR_number = '{$SR_number}'");
    $updateRecords = $mysqli->query("UPDATE studentrecord SET SR_section = '{$changeto}' 
    WHERE SR_number = '{$SR_number}'");
    $AD_action = "CHANGED SECTION OF STUDENT: " . $SR_number;
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['addSection']) && !empty($_SESSION['AD_number'])) {
    $sectionName = $_POST['sectionName'];

    $addSectionName = $mysqli->query("INSERT INTO sections (acadYear, S_yearLevel, S_name) VALUES ('{$currentSchoolYear}', '{$_GET['Grade']}', '{$sectionName}')");
    $AD_action = "ADDED SECTION " . $sectionName;
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['updateSection']) && !empty($_SESSION['AD_number'])) {
    $currentName = $_POST['currentName'];
    $sectionName = $_POST['sectionName'];

    $updateSectionName = $mysqli->query("UPDATE sections SET S_name = '{$sectionName}' WHERE acadYear = '{$currentSchoolYear}' AND S_name = '{$currentName}'");
    $AD_action = "UPDATED SECTION NAME OF " . $currentName . " TO " . $sectionName;
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['deleteSection']) && !empty($_SESSION['AD_number'])) {
    $currentName = $_POST['currentName'];

    $checkSectionInClasslist = $mysqli->query("SELECT * FROM classlist WHERE acadYear = '{$currentSchoolYear}' AND SR_section = '{$currentName}'");
    if (mysqli_num_rows($checkSectionInClasslist) == 0) {
        $deleteSectionName = $mysqli->query("DELETE FROM sections WHERE S_name = '{$currentName}' AND acadYear = '{$currentSchoolYear}'");
    }
    $AD_action = "DELETED SECTION " . $currentName;
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
//End

// Admin Buttons
if (isset($_POST['acadyear']) && !empty($_SESSION['AD_number'])) {
    $currentDate = new DateTime();
    $currentMonth = $currentDate->format('m');
    $startYear = "";
    $endYear = "";

    if ($currentMonth >= 9 && $currentMonth <= 12) {
        // September to December
        $startYear = $currentDate->format('Y');
        $endYear = $currentDate->format('Y') + 1;
    } else {
        // January to August
        $startYear = $currentDate->format('Y') - 1;
        $endYear = $currentDate->format('Y');
    }

    if ($getAcadYear->num_rows <= 0) {
        //insert portion
        $createAcadYear = $mysqli->query("INSERT INTO acad_year(currentYear, endYear) VALUES ('{$startYear}', '{$endYear}')");
        $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
        header("Refresh:0");
    } elseif ($getAcadYear->num_rows == 1) {
        //update portion
        $startYear = $acadYear_Data['endYear'];
        $endYear = (int) $startYear + 1;

        $updateAcadYear = $mysqli->query("UPDATE acad_year SET currentYear = '{$startYear}', endYear = '{$endYear}'");
        $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
        header("Refresh:0");
    }
    $AD_action = "CHANGED ACADEMIC YEAR";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['Open']) && !empty($_SESSION['AD_number'])) {
    $enableForms = $mysqli->query('UPDATE quartertable SET quarterStatus = "enabled" WHERE quarterTag = "FORMS"');
    $enableCurrentQuarter = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "enabled" WHERE quarterStatus = "current"');
    header("Refresh:0");
    $AD_action = "OPENED ENCODING OF GRADES";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['Close']) && !empty($_SESSION['AD_number'])) {
    $disableForms = $mysqli->query('UPDATE quartertable SET quarterStatus = "disabled" WHERE quarterTag = "FORMS"');
    $disableCurrentQuarter = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled" WHERE quarterStatus = "current"');
    header("Refresh:0");
    $AD_action = "CLOSED ENCODING OF GRADES";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['enableFirst']) && !empty($_SESSION['AD_number'])) {
    $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
    $enableFirst = $mysqli->query('UPDATE quartertable SET quarterStatus = "current" WHERE quarterTag = "1"');
    header("Refresh:0");
    $AD_action = "OPENED ENCODING OF GRADES FOR FIRST QUARTER";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['enableSecond']) && !empty($_SESSION['AD_number'])) {
    $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
    $enableSecond = $mysqli->query('UPDATE quartertable SET quarterStatus = "current" WHERE quarterTag = "2"');
    header("Refresh:0");
    $AD_action = "OPENED ENCODING OF GRADES FOR SECOND QUARTER";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['enableThird']) && !empty($_SESSION['AD_number'])) {
    $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
    $enableThird = $mysqli->query('UPDATE quartertable SET quarterStatus = "current" WHERE quarterTag = "3"');
    header("Refresh:0");
    $AD_action = "OPENED ENCODING OF GRADES FOR THIRD QUARTER";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['enableFourth']) && !empty($_SESSION['AD_number'])) {
    $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
    $enableFourth = $mysqli->query('UPDATE quartertable SET quarterStatus = "current" WHERE quarterTag = "4"');
    header("Refresh:0");
    $AD_action = "OPENED ENCODING OF GRADES FOR FOURTH QUARTER";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
//

//functions
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function generatePassword()
{
    // characters to choose from
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    // password length
    $passwordLength = 8;
    // initialize the password as an empty string
    $password = "";
    // loop until the desired length is reached
    for ($i = 0; $i < $passwordLength; $i++) {
        // pick a random character from the set of characters
        $password .= $chars[rand(0, strlen($chars) - 1)];
    }
    // check if the password contains at least one uppercase letter, one number, and one special character
    if (!preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password) || !preg_match("/[!@#\$%\^&\*\(\)_\-=\+;:\,\.\?]/", $password)) {
        // if not, generate a new password
        $password = generatePassword();
    }
    // return the generated password
    return $password;
}
function generateOTP()
{
    $otp = "";
    for ($i = 0; $i < 6; $i++) {
        $otp .= mt_rand(0, 9);
    }
    return $otp;
}

function timeRoundUp($data)
{
    // Create a DateTime object for the input time
    $data = new DateTime($data);

    // Get the minute of the input time
    $minute = (int) $data->format("i");

    // Round up the minute to the nearest quarter hour
    if ($minute > 0 && $minute <= 15) {
        $minute = 15;
    } elseif ($minute > 15 && $minute <= 30) {
        $minute = 30;
    } elseif ($minute > 30 && $minute <= 45) {
        $minute = 45;
    } else {
        $data->add(new DateInterval('PT1H'));
        $minute = 0;
    }

    // Set the rounded minute to the DateTime object
    $data->setTime((int) $data->format("H"), $minute);

    // Output the rounded time
    return $data->format("H:i");
}
function timePlusOneMinute($data) //sa endtime lang to ilalagay
{
    $convertedTime = strtotime($data);
    $timeMinusOneMinute = $convertedTime + 60;
    $data = date("H:i", $timeMinusOneMinute);

    return $data;
}
function timeMinusOneMinute($data) //sa endtime lang to ilalagay
{
    $convertedTime = strtotime($data);
    $timeMinusOneMinute = $convertedTime - 60;
    $data = date("H:i", $timeMinusOneMinute);

    return $data;
}

function countWeekdaysInMonth($year, $month)
{
    $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year); // get the number of days in the month
    $weekdays = 0; // initialize the weekday count

    // loop through each day in the month
    for ($day = 1; $day <= $numDays; $day++) {
        $timestamp = strtotime("$year-$month-$day"); // get the UNIX timestamp for the current day
        $dayOfWeek = date('N', $timestamp); // get the day of the week as a number (1 = Monday, 7 = Sunday)

        // check if the current day is a weekday (i.e., not a Saturday or Sunday)
        if ($dayOfWeek <= 5) {
            $weekdays++; // increment the weekday count
        }
    }

    return $weekdays;
}
//end functions
