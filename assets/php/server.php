<head>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="../css/sweetAlert.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
</head>

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

        if (mysqli_num_rows($authAccount) == 1) {
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
            $FindAD_number = $mysqli->query("SELECT * FROM admin_accounts WHERE AD_email = '{$email}'");
            $getAD_number = $FindAD_number->fetch_assoc();
            if ($email != $getAD_number['AD_password']) {
                $errors['LoginError'] = "Incorrect Password!";
            }
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
    $currentEmail = $_POST['currentEmail'];
    $SR_email = $_POST['SR_email'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if (isset($_FILES['image']['name'])) {
        $SR_profile_img = $_FILES['image']['name'];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "../assets/img/profile/" . $SR_profile_img;

        $checkUserData = $mysqli->query("SELECT * FROM userdetails WHERE SR_email = '{$currentEmail}'");
        $checkExisting = $checkUserData->fetch_assoc();

        if ($currentPassword != $checkExisting['SR_password']) {
            showSweetAlert('Incorrect Password', 'error');
        } else {
            if ($newPasssword != $confirmPassword) {
                showSweetAlert('Password does not match', 'error');
            } else {
                $mysqli->query("UPDATE userdetails 
                            SET 
                            SR_profile_img = '{$SR_profile_img}',
                            SR_email = '{$SR_email}',
                            SR_password = '{$confirmPassword}',
                            WHERE SR_email = '{$currentEmail}'");
                $mysqli->query("UPDATE studentrecord 
                            SET 
                            SR_profile_img = '{$SR_profile_img}',
                            SR_email = '{$SR_email}',
                            WHERE SR_number = '{$_POST['SR_number']}'");
                move_uploaded_file($tempname, $folder);
                showSweetAlert('Successfully updated your information', 'success');
            }
        }
    } else {
        $currentEmail = $_POST['currentEmail'];
        $SR_email = $_POST['SR_email'];
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        $checkUserData = $mysqli->query("SELECT * FROM userdetails WHERE SR_email = '{$currentEmail}'");
        $checkExisting = $checkUserData->fetch_assoc();

        if ($currentPassword != $checkExisting['SR_password']) {
            showSweetAlert('Incorrect Password', 'error');
        }
        if ($newPassword != $confirmPassword) {
            showSweetAlert('Password does not match', 'error');
        } else {
            $updateUserDetails = $mysqli->query("UPDATE userdetails 
                                                SET 
                                                SR_email = '{$SR_email}',
                                                SR_password = '{$confirmPassword}'
                                                WHERE userID = '{$checkExisting['userID']}'");
            $updateStudentRecord = $mysqli->query("UPDATE studentrecord 
                                                SET 
                                                SR_email = '{$SR_email}'
                                                WHERE SR_number = '{$currentEmail}'");
            showSweetAlert('Successfully updated your information', 'success');
        }
    }
}

//Faculty Process
if (isset($_POST['student']) || isset($_POST['fetcher'])) {

    $date = date("Y-m-d");
    $time = date("H:i A");

    $studentID = $_POST['student'];

    if (isset($_POST['fetcher'])) {
        $fetcherID = $_POST['fetcher'];
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
    } else if (empty($attendanceData['A_time_OUT']) && empty($attendanceData['A_fetcher_OUT'])) {
        $checkServiceType = $mysqli->query("SELECT SR_servicetype FROM studentrecord WHERE SR_number = '{$studentID}'");
        $ServiceType = $checkServiceType->fetch_assoc();
        if ($ServiceType['SR_servicetype'] == 'WITHFETCHER') {
        } elseif ($ServiceType['SR_servicetype'] == 'NOFETCHER') {
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
}
if (isset($_POST['encodeGrade'])) {
    $ids = $_POST['row'];
    $forms_SR_number = $_POST['SR_number'];
    $forms_Grade = $_POST['Grade'];
    $forms_Section = $_POST['Section'];
    $forms_Subject = $_POST['Subject'];

    if (isset($_POST['G_gradesQ1'])) {
        $forms_G_gradesQ1 = $_POST['G_gradesQ1'];
        foreach ($ids as $i => $id) {
            $SR_number = $forms_SR_number[$i];
            $Grade = $forms_Grade[$i];
            $Section = $forms_Section[$i];
            $Subject = $forms_Subject[$i];

            $G_gradesQ1 = $forms_G_gradesQ1[$i];

            $checkIfGraded = $mysqli->query("SELECT * FROM grades WHERE SR_number = '{$SR_number}' AND acadYear = '{$currentSchoolYear}' AND G_learningArea = '{$Subject}'");
            if (mysqli_num_rows($checkIfGraded) > 0) {
                $mysqli->query("UPDATE grades SET G_gradesQ1 = '{$G_gradesQ1}' WHERE SR_number = '{$SR_number}' AND SR_section = '{$Section}' AND acadYear = '{$currentSchoolYear}' AND G_learningArea = '{$Subject}'");
            } else {
                $mysqli->query("INSERT INTO grades(SR_number, acadYear, SR_gradeLevel, SR_section, G_learningArea, G_gradesQ1)
                                VALUES ('{$SR_number}', '{$currentSchoolYear}', '{$Grade}', '{$Section}', '{$Subject}', '{$G_gradesQ1}')");
            }
        }
    }
    if (isset($_POST['G_gradesQ2'])) {
        $forms_G_gradesQ2 = $_POST['G_gradesQ2'];
        foreach ($ids as $i => $id) {
            $SR_number = $forms_SR_number[$i];
            $Grade = $forms_Grade[$i];
            $Section = $forms_Section[$i];
            $Subject = $forms_Subject[$i];

            $G_gradesQ2 = $forms_G_gradesQ2[$i];

            $mysqli->query("UPDATE grades SET G_gradesQ2 = '{$G_gradesQ2}' WHERE SR_number = '{$SR_number}' AND SR_section = '{$Section}' AND acadYear = '{$currentSchoolYear}'");
        }
    }
    if (isset($_POST['G_gradesQ3'])) {
        $forms_G_gradesQ3 = $_POST['G_gradesQ3'];
        foreach ($ids as $i => $id) {
            $SR_number = $forms_SR_number[$i];
            $Grade = $forms_Grade[$i];
            $Section = $forms_Section[$i];
            $Subject = $forms_Subject[$i];

            $G_gradesQ3 = $forms_G_gradesQ3[$i];

            $mysqli->query("UPDATE grades SET G_gradesQ3 = '{$G_gradesQ3}' WHERE SR_number = '{$SR_number}' AND SR_section = '{$Section}' AND acadYear = '{$currentSchoolYear}'");
        }
    }
    if (isset($_POST['G_gradesQ4'])) {
        $forms_G_gradesQ4 = $_POST['G_gradesQ4'];
        foreach ($ids as $i => $id) {
            $SR_number = $forms_SR_number[$i];
            $Grade = $forms_Grade[$i];
            $Section = $forms_Section[$i];
            $Subject = $forms_Subject[$i];

            $G_gradesQ4 = $forms_G_gradesQ4[$i];

            $mysqli->query("UPDATE grades SET G_gradesQ4 = '{$G_gradesQ4}' WHERE SR_number = '{$SR_number}' AND SR_section = '{$Section}' AND acadYear = '{$currentSchoolYear}'");
        }
    }
    if (isset($_POST['FinalGrade'])) {
        $forms_FinalGrade = $_POST['FinalGrade'];
        foreach ($ids as $i => $id) {
            $SR_number = $forms_SR_number[$i];
            $Grade = $forms_Grade[$i];
            $Section = $forms_Section[$i];
            $Subject = $forms_Subject[$i];

            $G_finalgrade = $forms_FinalGrade[$i];

            $mysqli->query("UPDATE grades SET G_finalgrade = '{$G_finalgrade}' WHERE SR_number = '{$SR_number}' AND SR_section = '{$Section}' AND acadYear = '{$currentSchoolYear}'");
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
    if (isset($_FILES['image'])) {
        $currentEmail = $_POST['currentEmail'];
        $F_email = $_POST['F_email'];
        $F_number = $_POST['F_number'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        $F_profile_img = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        $folder = "../assets/img/profile/" . $F_profile_img;

        move_uploaded_file($tempname, $folder);
        if ($confirmPassword != $newPassword) {
            showSweetAlert('Password does not match', 'error');
        } else {
            $mysqli->query("UPDATE userdetails 
                        SET 
                        SR_email = '{$F_email}',
                        SR_password = '{$confirmPassword}'
                        WHERE SR_email = '{$currentEmail}'");
            $mysqli->query("UPDATE faculty 
                        SET 
                        F_profile_img = '{$F_profile_img}',
                        F_email = '{$F_email}'
                        WHERE F_number = '{$F_number}'");
            showSweetAlert('Successfully updated your information', 'success');
        }
    } else {
        $currentEmail = $_POST['currentEmail'];
        $F_email = $_POST['F_email'];
        $F_number = $_POST['F_number'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];
        if ($newPassword != $confirmPassword) {
            showSweetAlert('Password does not match', 'error');
        } else {
            $updateUserDetails = $mysqli->query("UPDATE userdetails 
                                                SET 
                                                SR_email = '{$F_email}',
                                                SR_password = '{$confirmPassword}'
                                                WHERE SR_email = '{$currentEmail}'");
            $updateStudentRecord = $mysqli->query("UPDATE faculty 
                                                SET 
                                                F_email = '{$F_email}'
                                                WHERE F_email = '{$currentEmail}'");
            showSweetAlert('Successfully updated your information', 'success');
        }
    }
}
if (isset($_POST['addReminders'])) {
    $author = $mysqli->real_escape_string($_POST['author']);
    $subject = $mysqli->real_escape_string($_POST['subject']);
    $forsection = $mysqli->real_escape_string($_POST['forsection']);
    $MSG = $mysqli->real_escape_string($_POST['MSG']);
    $date = $_POST['date'];
    $dateposted = date("Y/m/d");

    if (!empty($subject) && !empty($forsection) && !empty($MSG) && !empty($date)) {
        $addReminders = $mysqli->query("INSERT INTO reminders(acadYear, date_posted, author, subject, forsection, msg, deadline) VALUE ('{$currentSchoolYear}', '{$dateposted}', '{$author}','{$subject}', '{$forsection}', '{$MSG}', '{$date}')");

        if ($addReminders) {
            $sendtoGuardianData = $mysqli->query("SELECT G_email FROM guardian WHERE G_guardianOfStudent 
                                            IN 
                                            (SELECT SR_number FROM classlist WHERE SR_section = '{$forsection}' AND acadYear = '{$currentSchoolYear}')");
            $sendtoStudentData = $mysqli->query("SELECT SR_email FROM studentrecord WHERE SR_number 
                                            IN 
                                            (SELECT SR_number FROM classlist WHERE SR_section = '{$forsection}' AND acadYear = '{$currentSchoolYear}')");
            if (mysqli_num_rows($sendtoGuardianData) > 0 && mysqli_num_rows($sendtoStudentData) > 0) {
                while ($sendtoGuardian = $sendtoGuardianData->fetch_assoc()) {
                    $mail->addAddress($sendtoGuardian['G_email']);
                    $mail->Subject = $subject;

                    $mail->Body = '<h1>Reminder</h1><br>
                               <p>' . $MSG . '</p><br>';
                    $mail->send();
                }
                while ($sendtoStudent = $sendtoStudentData->fetch_assoc()) {
                    $mail->addAddress($sendtoStudent['SR_email']);
                    $mail->Subject = $subject;

                    $mail->Body = '<h1>Reminder</h1><br>
                               <p>' . $MSG . '</p><br>';
                    $mail->send();
                }
            } else {
                showSweetAlert('No receiver.', 'error');
            }
        }
    } else {
        showSweetAlert('Input is required.', 'error');
    }
}
if (isset($_POST['updateReminder'])) {
    $remindersID = $mysqli->real_escape_string($_GET['ID']);
    $author = $mysqli->real_escape_string($_POST['author']);
    $date = $_POST['date'];
    $forsection = $mysqli->real_escape_string($_POST['forsection']);
    $subject = $mysqli->real_escape_string($_POST['subject']);
    $MSG = $mysqli->real_escape_string($_POST['MSG']);

    $updateReminder = "UPDATE reminders 
                       SET
                       subject = '{$subject}', 
                       forsection = '{$forsection}', 
                       msg = '{$MSG}', 
                       deadline = '{$date}'
                       WHERE reminderID = '{$remindersID}'";
    $resultupdateReminder = $mysqli->query($updateReminder);

    if ($resultupdateReminder) {
        echo <<<EOT
            <script>
                document.addEventListener("DOMContentLoaded", function(event) { 
                    swal.fire({
                        text: 'Reminders successfully updated.',
                        icon: 'success',
                        confirmButtonText: 'OK',
                    }).then(() => {
                        window.location.href = '../faculty/reminders.php';
                    });
                });
            </script>
        EOT;
    } else {
        showSweetAlert('Failed to update reminder.', 'error');
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

    $SR_profile_img = $_FILES['image']['name'];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "../assets/img/profile/" . $SR_profile_img;

    $S_lname = $mysqli->real_escape_string($_POST['S_lname']);
    $S_fname = $mysqli->real_escape_string($_POST['S_fname']);
    $S_mname    = $mysqli->real_escape_string($_POST['S_mname']);
    $S_suffix = $mysqli->real_escape_string($_POST['S_suffix']);

    $S_age    = $mysqli->real_escape_string($_POST['S_age']);
    $S_birthday = $_POST['S_birthday'];
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
                        '$SR_profile_img', '$SR_LRN', '$S_fname', '$S_mname', '$S_lname','$S_suffix',
                        '$S_gender', '$S_age', '$S_birthday', '$S_birthplace', '$S_religion',
                        '$S_citizenship', '$S_grade', '$S_section', '$SR_servicetype', '$S_address', 
                        '$S_barangay', '$S_city', '$S_state', '$S_postal', '$S_email')";
        $RunregStudent = $mysqli->query($regStudent);
        move_uploaded_file($tempname, $folder);
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
        if ($RunregStudent && $RunregGuardian) {
            showSweetAlert('Student successfully registered.', 'success');
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

            if ($RunregStudent && $RunregGuardian && $SR_servicetype == "WITHFETCHER") {
                header('Location: linkFetcher.php?ID=' . $SR_LRN);
            }
        }
    } else {
        showSweetAlert('Email already exist.', 'error');
    }
}
if (isset($_POST['createFetcher'])) {
    $FTH_name = $_POST['FTH_name'];
    $FTH_contactNo = $_POST['FTH_contact'];
    $FTH_email = $_POST['FTH_email'];

    $getLastFTH = $mysqli->query("SELECT COUNT(G_ID) FROM fetcher_data");
    $FTHData = $getLastFTH->fetch_assoc();
    $Plus1 = $FTHData['COUNT(G_ID)'] + 1;
    $padding_length = 5;
    $padding_character = '0';
    $formatted_number = str_pad($Plus1, $padding_length, $padding_character, STR_PAD_LEFT);

    $FTH_number = date("Y") . "-" . $formatted_number . "-FTH";

    $addFetcher = $mysqli->query("INSERT INTO fetcher_data (FTH_number, FTH_name, FTH_contactNo, FTH_email) 
                            VALUES ('{$FTH_number}', '{$FTH_name}', '{$FTH_contactNo}', '{$FTH_email}')");
    if ($addFetcher) {
        echo <<<EOT
            <script>
                document.addEventListener("DOMContentLoaded", function(event) { 
                    swal.fire({
                        text: 'Fetcher successfully registered.',
                        icon: 'success',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed){
                            swal.fire({
                                text: 'Do you want to add another fetcher?',
                                icon: 'info',
                                confirmButtonText: 'Yes',
                                denyButtonText: 'No',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'linkFetcher.php?ID='.{$_GET['ID']}.';
                                } else if (result.isDenied) {
                                    window.location.href = 'addStudent.php;
                                }
                            });
                        }
                    });
                });
            </script>
        EOT;
    }
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "REGISTERED FETCHER - " . $FTH_number;
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['linktoStudent'])) {
    $FTH_linkedTo = $mysqli->real_escape_string($_GET['ID']);
    $FTH_option1 = $_POST['FTH_option1'];
    $FTH_option2 = $_POST['FTH_option2'];
    $FTH_option3 = $_POST['FTH_option3'];

    $checkFetcherLimit = $mysqli->query("SELECT COUNT(FTH_number) FROM fetcher_list WHERE FTH_linkedTo = '{$FTH_linkedTo}'");
    $countFetcher = $checkFetcherLimit->fetch_assoc();
    if ($countFetcher['COUNT(FTH_number)'] < 4) {
        if (isset($FTH_option1)) {
            $addFetcher = $mysqli->query("INSERT INTO fetcher_list (FTH_number, FTH_linkedTo) VALUES ('{$FTH_option1}', '{$FTH_linkedTo}')");
            if ($addFetcher) {
                showSweetAlert('Fetcher successfully linked.', 'success');
            }
        }
        if (isset($FTH_option2)) {
            $addFetcher = $mysqli->query("INSERT INTO fetcher_list (FTH_number, FTH_linkedTo) VALUES ('{$FTH_option2}', '{$FTH_linkedTo}')");
            if ($addFetcher) {
                showSweetAlert('Fetcher successfully linked.', 'success');
            }
        }
        if (isset($FTH_option3)) {
            $addFetcher = $mysqli->query("INSERT INTO fetcher_list (FTH_number, FTH_linkedTo) VALUES ('{$FTH_option3}', '{$FTH_linkedTo}')");
            if ($addFetcher) {
                showSweetAlert('Fetcher successfully linked.', 'success');
            }
        }
    } else {
        showSweetAlert('Student reached the maximum amount of fetcher.', 'error');
    }
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "LINKED FETCHER TO STUDENT - " . $FTH_linkedTo;
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['updateInformation']) && !empty($_SESSION['AD_number'])) {
    $S_lname = $mysqli->real_escape_string($_POST['SR_lname']);
    $S_fname = $mysqli->real_escape_string($_POST['SR_fname']);
    $S_mname    = $mysqli->real_escape_string($_POST['SR_mname']);
    $S_suffix = $mysqli->real_escape_string($_POST['SR_suffix']);

    $S_age    = $mysqli->real_escape_string($_POST['SR_age']);
    $S_birthday = $_POST['SR_birthday'];
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

    if (isset($_FILES['image']['name'])) {
        $SR_profile_img = $_FILES['image']['name'];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "../assets/img/profile/" . $SR_profile_img;

        $updateStudent = "UPDATE studentrecord 
                      SET 
                        SR_profile_img = '$SR_profile_img',
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
    } else {
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
            showSweetAlert('Student information successfully updated.', 'success');
            header('Location: ../admin/student.php');
        } else {
            showSweetAlert('Failed to update information.', 'error');
        }
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
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "../assets/img/profile/" . $F_profile_img;

    $F_status = "active";
    $F_lname = $mysqli->real_escape_string($_POST['F_lname']);
    $F_fname = $mysqli->real_escape_string($_POST['F_fname']);
    $F_mname = $mysqli->real_escape_string($_POST['F_mname']);
    $F_suffix = $mysqli->real_escape_string($_POST['F_suffix']);
    $F_age = $mysqli->real_escape_string($_POST['F_age']);
    $F_birthday = $_POST['F_birthday'];
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

    $checkEmail = $mysqli->query("SELECT F_email FROM faculty WHERE F_email = '{$F_email}'");
    if (mysqli_num_rows($checkEmail) == 0) {
        $getFacultyID = $mysqli->query("SELECT F_ID FROM faculty ORDER BY F_ID DESC LIMIT 1");
        $FacultyID = $getFacultyID->fetch_assoc();

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

        move_uploaded_file($tempname, $folder);
        unset($_SESSION['fromAddFaculty']);
        if ($resultregFaculty) {
            showSweetAlert('Teacher successfully registered.', 'success');
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
        } else {
            showSweetAlert('Failed to register teacher.', 'error');
        }
        $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
        $AdminName = $getAdminName->fetch_assoc();
        $AD_action = "REGISTERED TEACHER - " . $F_number;
        $currentDate = date("Y-m-d");
        $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
        VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
    } else {
        showSweetAlert('Email already exist.', 'error');
    }
}
if (isset($_POST['editFaculty']) && !empty($_SESSION['AD_number'])) {
    $F_number = $_POST['F_number'];

    $F_lname = $mysqli->real_escape_string($_POST['F_lname']);
    $F_fname = $mysqli->real_escape_string($_POST['F_fname']);
    $F_mname = $mysqli->real_escape_string($_POST['F_mname']);
    $F_suffix = $mysqli->real_escape_string($_POST['F_suffix']);

    $F_age = $mysqli->real_escape_string($_POST['F_age']);
    $F_birthday = $_POST['F_birthday'];
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

    if (isset($_FILES['image']['name'])) {
        $F_profile_img = $_FILES['image']['name'];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "../assets/img/profile/" . $F_profile_img;

        $updateFaculty = "UPDATE faculty 
                        SET 
                            F_profile_img = '{$F_profile_img}',
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
        move_uploaded_file($tempname, $folder);
        if ($resultupdateFaculty) {
            showSweetAlert('Updated faculty information successfully.', 'success');
            header('Location: ../admin/faculty.php');
        } else {
            showSweetAlert('Failed to update faculty information.', 'error');
        }
    } else {
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
            showSweetAlert('Updated faculty information successfully.', 'success');
            header('Location: ../admin/faculty.php');
        } else {
            showSweetAlert('Failed to update faculty information.', 'error');
        }
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
        showSweetAlert('Grades successfully updated.', 'success');
        $url_components = parse_url($current_url);
        parse_str($url_components['query'], $params);
        $param1 = $params['Grade'];
        $param2 = $params['Section'];
        $param3 = $params['LearningArea'];

        $url = "../admin/editgrades.php";
        header("Location: " . $url . "?Grade=" . $param1 . "&Section=" . $param2 . "&LearningArea=" . $param3);
    } else {
        showSweetAlert('Failed to update grades.', 'error');
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
            // showSweetAlert('Grades successfully updated.', 'success');
        } else if (mysqli_num_rows($checkIfexisting) == 0) {
            $insertUnreleasedGrades = $mysqli->query("INSERT INTO student_grades(SR_number, acadYear, SR_gradeLevel, SR_section, G_learningArea, G_gradesQ1, G_gradesQ2, G_gradesQ3, G_gradesQ4, G_finalgrade)
                                                      VALUES('{$Grades['SR_number']}', '{$Grades['acadYear']}', '{$Grades['SR_gradeLevel']}', '{$Grades['SR_section']}', '{$Grades['G_learningArea']}', 
                                                             '{$Grades['G_gradesQ1']}', '{$Grades['G_gradesQ2']}', '{$Grades['G_gradesQ3']}', '{$Grades['G_gradesQ4']}', '{$Grades['G_finalgrade']}')");
            showSweetAlert('Grades successfully published.', 'success');
        } else {
            showSweetAlert('Failed to publish grades.', 'error');
        }
    }
}
if (isset($_POST['addCurr']) && !empty($_SESSION['AD_number'])) {
    $subjectName = $mysqli->real_escape_string($_POST['sbjName']);
    $minYearLevel = $mysqli->real_escape_string($_POST['minYearLevel']);
    $maxYearLevel = $mysqli->real_escape_string($_POST['maxYearLevel']);

    if ($subject = "" || empty($subject)) {
        showSweetAlert('No subject name inputted', 'error');
    } else {
        $checkIfsubjectExist = $mysqli->query("SELECT subjectName FROM subjectperyear WHERE subjectName LIKE '%$subjectName%'");
        if (mysqli_num_rows($checkIfsubjectExist) > 0) {
            showSweetAlert('Subject name already exist.', 'error');
        } else {
            $addSubject = $mysqli->query("INSERT INTO subjectperyear(subjectName, minYearLevel, maxYearLevel) VALUES('{$subjectName}','{$minYearLevel}','{$maxYearLevel}')");
            if ($addSubject) {
                showSweetAlert('Subject added successfully.', 'success');
            }
            $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
            $AdminName = $getAdminName->fetch_assoc();
            $AD_action = "ADDED SUBJECT -" . $subjectName . " WITH MIN LEVEL " . $minYearLevel . " AND " . $maxYearLevel;
            $currentDate = date("Y-m-d");
            $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
                                    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
        }
    }
}
if (isset($_POST['updateCurr']) && !empty($_SESSION['AD_number'])) {
    $subjectName = $_POST['sbjName'];
    $minYearLevel = $_POST['minYearLevel'];
    $maxYearLevel = $_POST['maxYearLevel'];

    $updateSubject = $mysqli->query("UPDATE subjectperyear SET minYearLevel = '$minYearLevel', maxYearLevel = '$maxYearLevel' WHERE subjectName = '$subjectName'");
    if ($updateSubject) {
        showSweetAlert('subject successfully updated.', 'success');
        $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
        $AdminName = $getAdminName->fetch_assoc();
        $AD_action = "UPDATED SUBJECT -" . $subjectName . " WITH MIN LEVEL " . $minYearLevel . " AND MAX LEVEL" . $maxYearLevel;
        $currentDate = date("Y-m-d");
        $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
                                    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
    } else {
        showSweetAlert('Failed to add subject.', 'error');
    }
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

    if ($adminPassword === $confirmPassword) {
        $checkAdminEmail = $mysqli->query("SELECT * FROM admin_accounts WHERE AD_email = '{$adminEmail}'");
        if ($checkAdminEmail->num_rows == 1) {
            showSweetAlert('Oops! Email already exist.', 'error');
        } else {
            $adData = date('Y');
            $randNum = rand(1000, 9999);
            $AD_number = $adData . "-" . $randNum;
            $addAdminAccount = $mysqli->query("INSERT INTO admin_accounts (AD_number, AD_name, AD_email, AD_password) VALUES ('$AD_number', '$adminName', '$adminEmail', '$confirmPassword')");
            showSweetAlert('Admin successfully created.', 'success');

            $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
            $AdminName = $getAdminName->fetch_assoc();
            $AD_action = "ADDED ADMIN ACCOUNT " . $adminName;
            $currentDate = date("Y-m-d");
            $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
        VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
        }
    } else {
        showSweetAlert('Password do not match.', 'error');
    }
}
if (isset($_POST['setSchedule']) && !empty($_SESSION['AD_number'])) {
    $assignedFaculty = $_POST['assignedFaculty'];
    $subjectname = $_POST['subjectname'];
    $input_start = $_POST['WS_start_time'];
    $input_end = timeMinusOneMinute($_POST['WS_end_time']);

    if ($assignedFaculty == "" || empty($assignedFaculty)) {
        showSweetAlert('Assigned Professor is empty', 'error');
    } else {
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
            showSweetAlert('Schedule successfully assigned.', 'success');
            $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
            $AdminName = $getAdminName->fetch_assoc();
            $AD_action = "ADDED SCHEDULE FOR " . $assignedFaculty . "FOR SECTION" . $_GET['SectionName'];
            $currentDate = date("Y-m-d");
            $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
                                    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
        }
    }
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
        showSweetAlert('Schedule successfully updated.', 'success');
        $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
        $AdminName = $getAdminName->fetch_assoc();
        $AD_action = "UPDATED SCHEDULE OF " . $assignedFaculty . "FOR SECTION" . $_GET['SectionName'];
        $currentDate = date("Y-m-d");
        $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
                                    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
    }
}
if (isset($_POST['deleteSchedule']) && !empty($_SESSION['AD_number'])) {
    $assignedFaculty = $_POST['assignedFaculty'];
    $WS_ID = $_POST['WS_ID'];

    $deleteSchedule = $mysqli->query("DELETE FROM workschedule WHERE acadYear = '{$currentSchoolYear}' AND WS_ID = '{$WS_ID}'");
    if ($deleteSchedule) {
        // showSweetAlert('Schedule successfully removed.', 'success');
        $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
        $AdminName = $getAdminName->fetch_assoc();
        $AD_action = "DELETED SCHEDULE OF " . $assignedFaculty . "FOR SECTION" . $_GET['SectionName'];
        $currentDate = date("Y-m-d");
        $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
        VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
    }
}
if (isset($_POST['postAnnouncement']) && !empty($_SESSION['AD_number'])) {
    $author = $_POST['author'];
    $date = $_POST['date'];
    $subject = $_POST['subject'];
    $message = $mysqli->real_escape_string($_POST['message']);

    $CreateAnnouncement = $mysqli->query("INSERT INTO announcement(acadYear, header, author, date, msg) VALUES ('{$currentSchoolYear}', '{$subject}', '{$author}', '{$date}', '{$message}')");

    if ($CreateAnnouncement) {
        $sendtoGuardianData = $mysqli->query("SELECT G_email FROM guardian WHERE G_guardianOfStudent 
                                        IN 
                                        (SELECT SR_number FROM classlist WHERE acadYear = '{$currentSchoolYear}')");
        $sendtoStudentData = $mysqli->query("SELECT SR_email FROM studentrecord WHERE SR_number 
                                        IN 
                                        (SELECT SR_number FROM classlist WHERE acadYear = '{$currentSchoolYear}')");
        if (mysqli_num_rows($sendtoGuardianData) > 0 && mysqli_num_rows($sendtoStudentData) > 0) {
            while ($sendtoGuardian = $sendtoGuardianData->fetch_assoc()) {
                $mail->addAddress($sendtoGuardian['G_email']);
                $mail->Subject = $subject;

                $mail->Body = '<h1>School Annoucement</h1><br>
                               <p>' . $message . '</p><br>';
                $mail->send();
            }
            while ($sendtoStudent = $sendtoStudentData->fetch_assoc()) {
                $mail->addAddress($sendtoStudent['SR_email']);
                $mail->Subject = $subject;

                $mail->Body = '<h1>School Annoucement</h1><br>
                                <p>' . $message . '</p><br>';
                $mail->send();
            }
        } else {
            showSweetAlert('Announcement posted but not sent to everyone.', 'info');
        }
        $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
        $AdminName = $getAdminName->fetch_assoc();
        $AD_action = "POSTED ANNOUNCEMENT";
        $currentDate = date("Y-m-d");
        $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
        VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
    }
}
if (isset($_POST['assignAdvisor']) && !empty($_SESSION['AD_number'])) {
    $section = $_POST['section'];
    $advisor = $_POST['advisor'];

    $checkIfAssigned1 = $mysqli->query("SELECT F_number FROM classlist WHERE F_number = '{$advisor}'");
    if (mysqli_num_rows($checkIfAssigned1) == 0) {
        $checkIfAssigned2 = $mysqli->query("SELECT S_adviser FROM sections WHERE S_adviser = '{$advisor}'");
        if (mysqli_num_rows($checkIfAssigned2) == 0) {
            $assignSectionsAdvisor = $mysqli->query("UPDATE sections SET S_adviser = '{$advisor}' WHERE S_name = '{$section}' AND acadYear = '{$currentSchoolYear}'");
            $assignClassListAdvisor = $mysqli->query("UPDATE classlist SET F_number = '{$advisor}' WHERE SR_section = '{$section}' AND acadYear = '{$currentSchoolYear}'");

            showSweetAlert('Successfully assigned advisory.', 'success');
            if ($assignSectionsAdvisor && $assignClassListAdvisor) {

                $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
                $AdminName = $getAdminName->fetch_assoc();
                $AD_action = "ASSIGNED ADVISOR FOR SECTION " . $section;
                $currentDate = date("Y-m-d");
                $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
                                            VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
            }
        } else {
            showSweetAlert('Teacher is already assigned', 'error');
        }
    } else {
        showSweetAlert('Teacher is already assigned', 'error');
    }
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
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
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
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "CHANGED SECTION OF STUDENT: " . $SR_number;
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['addSection']) && !empty($_SESSION['AD_number'])) {
    $sectionName = $_POST['sectionName'];

    $checkExistingSection = $mysqli->query("SELECT S_name FROM sections WHERE S_name LIKE '%$sectionName%'");
    if (mysqli_num_rows($checkExistingSection) == 0) {
        $addSectionName = $mysqli->query("INSERT INTO sections (acadYear, S_yearLevel, S_name) VALUES ('{$currentSchoolYear}', '{$_GET['Grade']}', '{$sectionName}')");
        showSweetAlert('Section successfully added', 'success');

        $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
        $AdminName = $getAdminName->fetch_assoc();
        $AD_action = "ADDED SECTION " . $sectionName;
        $currentDate = date("Y-m-d");
        $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
        VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
    } else {
        showSweetAlert('Failed to add Section', 'error');
    }
}
if (isset($_POST['updateSection']) && !empty($_SESSION['AD_number'])) {
    $currentName = $_POST['currentName'];
    $sectionName = $_POST['sectionName'];

    $findSectionInSection = $mysqli->query("SELECT * FROM sections WHERE S_name = '{$currentName}' AND acadYear = '{$currentSchoolYear}'");
    $Section = $findSectionInSection->fetch_assoc();
    if (mysqli_num_rows($findSectionInSection) > 0) {
        $updateSectionName = $mysqli->query("UPDATE sections SET S_name = '{$sectionName}' WHERE acadYear = '{$currentSchoolYear}' AND S_yearLevel = '{$Section['S_yearLevel']}'");

        $findSectionInClasslist = $mysqli->query("SELECT * FROM classlist WHERE SR_section = '{$currentName}' AND acadYear = '{$currentSchoolYear}'");
        if ($findSectionInClasslist) {
            $Classlist = $findSectionInClasslist->fetch_assoc();
            $updateClasslistName = $mysqli->query("UPDATE classlist SET SR_section = '{$sectionName}' WHERE acadYear = '{$currentSchoolYear}' AND SR_grade = '{$Classlist['SR_grade']}'");

            $findSectionInWorkSchedule = $mysqli->query("SELECT * FROM workschedule WHERE SR_section = '{$currentName}' AND acadYear = '{$currentSchoolYear}'");
            if ($findSectionInWorkSchedule) {
                $WorkSchedule = $findSectionInWorkSchedule->fetch_assoc();
                $updateWorkSchedule = $mysqli->query("UPDATE workschedule SET SR_section = '{$sectionName}' WHERE acadYear = '{$currentSchoolYear}' AND SR_grade = '{$WorkSchedule['SR_grade']}'");

                $findSectionInStudentRecords = $mysqli->query("SELECT * FROM studentrecord WHERE SR_section = '{$currentName}'");
                if ($findSectionInStudentRecords) {
                    $StudentRecord = $findSectionInStudentRecords->fetch_assoc();
                    $updateStudentRecords = $mysqli->query("UPDATE studentrecord SET SR_section = '{$sectionName}' WHERE SR_grade = '{$StudentRecord['SR_grade']}'");

                    $updateReminders = $mysqli->query("UPDATE reminders SET forsection = '{$sectionName}' WHERE acadYear = '{$currentSchoolYear}'");

                    $findSectionInGrades = $mysqli->query("SELECT * FROM grades WHERE SR_section = '{$currentName}' AND acadYear = '{$currentSchoolYear}'");
                    if ($findSectionInGrades) {
                        $Grades = $findSectionInGrades->fetch_assoc();
                        $updateGrades = $mysqli->query("UPDATE grades SET SR_section = '{$sectionName}' WHERE acadYear = '{$currentSchoolYear}' AND SR_gradeLevel = '{$Grades['SR_gradeLevel']}'");

                        $findSectionInBehavior = $mysqli->query("SELECT * FROM behavior WHERE SR_section = '{$currentName}' AND acadYear = '{$currentSchoolYear}'");
                        if ($findSectionInBehavior) {
                            $Behavior = $findSectionInBehavior->fetch_assoc();
                            $updateBehavior = $mysqli->query("UPDATE behavior SET SR_section = '{$sectionName}' WHERE acadYear = '{$currentSchoolYear}' AND SR_grade = '{$Behavior['SR_grade']}'");
                        }
                    }
                }
            }
        }
    }

    showSweetAlert('Successfully updated sectioname.', 'success');

    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
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
        showSweetAlert('Successfully deleted section', 'success');
    }
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
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
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "CHANGED ACADEMIC YEAR";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['Open']) && !empty($_SESSION['AD_number'])) {
    $enableForms = $mysqli->query('UPDATE quartertable SET quarterStatus = "enabled" WHERE quarterTag = "FORMS"');
    $enableCurrentQuarter = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "enabled" WHERE quarterStatus = "current"');
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "OPENED ENCODING OF GRADES";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");

    showSweetAlert('Encoding of grades is now open.', 'info');
}
if (isset($_POST['Close']) && !empty($_SESSION['AD_number'])) {
    $disableForms = $mysqli->query('UPDATE quartertable SET quarterStatus = "disabled" WHERE quarterTag = "FORMS"');
    $disableCurrentQuarter = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled" WHERE quarterStatus = "current"');
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "CLOSED ENCODING OF GRADES";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");

    showSweetAlert('Encoding of grades is now closed.', 'info');
}
if (isset($_POST['enableFirst']) && !empty($_SESSION['AD_number'])) {
    $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
    $enableFirst = $mysqli->query('UPDATE quartertable SET quarterStatus = "current" WHERE quarterTag = "1"');
    header("Refresh:0");
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "OPENED ENCODING OF GRADES FOR FIRST QUARTER";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['disableQ1']) && !empty($_SESSION['AD_number'])) {
    $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "OPENED ENCODING OF GRADES FOR FIRST QUARTER";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['enableSecond']) && !empty($_SESSION['AD_number'])) {
    $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
    $enableSecond = $mysqli->query('UPDATE quartertable SET quarterStatus = "current" WHERE quarterTag = "2"');
    header("Refresh:0");
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "OPENED ENCODING OF GRADES FOR SECOND QUARTER";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['disableQ2']) && !empty($_SESSION['AD_number'])) {
    $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "OPENED ENCODING OF GRADES FOR FIRST QUARTER";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['enableThird']) && !empty($_SESSION['AD_number'])) {
    $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
    $enableThird = $mysqli->query('UPDATE quartertable SET quarterStatus = "current" WHERE quarterTag = "3"');
    header("Refresh:0");
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "OPENED ENCODING OF GRADES FOR THIRD QUARTER";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['disableQ3']) && !empty($_SESSION['AD_number'])) {
    $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "OPENED ENCODING OF GRADES FOR FIRST QUARTER";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['enableFourth']) && !empty($_SESSION['AD_number'])) {
    $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
    $enableFourth = $mysqli->query('UPDATE quartertable SET quarterStatus = "current" WHERE quarterTag = "4"');
    header("Refresh:0");
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "OPENED ENCODING OF GRADES FOR FOURTH QUARTER";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
if (isset($_POST['disableQ4']) && !empty($_SESSION['AD_number'])) {
    $disableExisting = $mysqli->query('UPDATE quartertable SET quarterFormStatus = "disabled", quarterStatus = "" WHERE quarterID != 0');
    $getAdminName = $mysqli->query("SELECT AD_name FROM admin_accounts WHERE AD_number = '{$_SESSION['AD_number']}'");
    $AdminName = $getAdminName->fetch_assoc();
    $AD_action = "OPENED ENCODING OF GRADES FOR FIRST QUARTER";
    $currentDate = date("Y-m-d");
    $log_action = $mysqli->query("INSERT INTO admin_logs(acadYear, AD_number, AD_name, AD_action, logDate)
    VALUES('{$currentSchoolYear}', '{$_SESSION['AD_number']}', '{$AdminName['AD_name']}', '{$AD_action}', '{$currentDate}')");
}
//

// OPTIONAL
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
// END

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
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:.?";
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
    if (!preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password) || !preg_match("/[!@#\$%\^&\*\(\)_\-=\+;:\.\?]/", $password)) {
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

function showSweetAlert($message, $type)
{
    echo <<<EOT
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function(event) { 
        swal.fire({
            height: 1000,
            text: '$message',
            icon: '$type',
            confirmButtonText: 'OK',
        });
      });
    </script>
  EOT;
}

function countWeekdays($month, $year)
{
    // get the number of days in the given month
    $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    // initialize the weekday count to 0
    $weekdayCount = 0;

    // loop through each day in the month
    for ($day = 1; $day <= $numDays; $day++) {
        // get the day of the week for the current day
        $dayOfWeek = date("N", strtotime("$year-$month-$day"));

        // if the day of the week is Monday to Friday (1 to 5), increment the weekday count
        if ($dayOfWeek >= 1 && $dayOfWeek <= 5) {
            $weekdayCount++;
        }
    }

    return $weekdayCount;
}
//end functions

// admin dashboard chart data
$CountKinderPresentNow = $mysqli->query("SELECT COUNT(studentrecord.SR_number) FROM studentrecord 
                            LEFT JOIN attendance ON studentrecord.SR_number = attendance.SR_number
                            WHERE studentrecord.SR_grade = 'KINDER' AND attendance.A_date = CURRENT_DATE AND acadYear = '$currentSchoolYear'");
$KinderPresentNow = $CountKinderPresentNow->fetch_assoc();
$OverallCountofKinder = $mysqli->query("SELECT COUNT(SR_number) FROM classlist WHERE SR_grade = 'KINDER' AND acadYear = '$currentSchoolYear'");
$AllKinder = $OverallCountofKinder->fetch_assoc();

$CountGrade1PresentNow = $mysqli->query("SELECT COUNT(studentrecord.SR_number) FROM studentrecord 
                            LEFT JOIN attendance ON studentrecord.SR_number = attendance.SR_number
                            WHERE studentrecord.SR_grade = '1' AND attendance.A_date = CURRENT_DATE AND acadYear = '$currentSchoolYear'");
$Grade1PresentNow = $CountGrade1PresentNow->fetch_assoc();
$OverallCountofGrade1 = $mysqli->query("SELECT COUNT(SR_number) FROM classlist WHERE SR_grade = '1' AND acadYear = '$currentSchoolYear'");
$AllGrade1 = $OverallCountofGrade1->fetch_assoc();

$CountGrade2PresentNow = $mysqli->query("SELECT COUNT(studentrecord.SR_number) FROM studentrecord 
                            LEFT JOIN attendance ON studentrecord.SR_number = attendance.SR_number
                            WHERE studentrecord.SR_grade = '2' AND attendance.A_date = CURRENT_DATE AND acadYear = '$currentSchoolYear'");
$Grade2PresentNow = $CountGrade2PresentNow->fetch_assoc();
$OverallCountofGrade2 = $mysqli->query("SELECT COUNT(SR_number) FROM classlist WHERE SR_grade = '2' AND acadYear = '$currentSchoolYear'");
$AllGrade2 = $OverallCountofGrade2->fetch_assoc();

$CountGrade3PresentNow = $mysqli->query("SELECT COUNT(studentrecord.SR_number) FROM studentrecord 
                            LEFT JOIN attendance ON studentrecord.SR_number = attendance.SR_number
                            WHERE studentrecord.SR_grade = '3' AND attendance.A_date = CURRENT_DATE AND acadYear = '$currentSchoolYear'");
$Grade3PresentNow = $CountGrade3PresentNow->fetch_assoc();
$OverallCountofGrade3 = $mysqli->query("SELECT COUNT(SR_number) FROM classlist WHERE SR_grade = '3' AND acadYear = '$currentSchoolYear'");
$AllGrade3 = $OverallCountofGrade3->fetch_assoc();

$CountGrade4PresentNow = $mysqli->query("SELECT COUNT(studentrecord.SR_number) FROM studentrecord 
                            LEFT JOIN attendance ON studentrecord.SR_number = attendance.SR_number
                            WHERE studentrecord.SR_grade = '4' AND attendance.A_date = CURRENT_DATE AND acadYear = '$currentSchoolYear'");
$Grade4PresentNow = $CountGrade4PresentNow->fetch_assoc();
$OverallCountofGrade4 = $mysqli->query("SELECT COUNT(SR_number) FROM classlist WHERE SR_grade = '4' AND acadYear = '$currentSchoolYear'");
$AllGrade4 = $OverallCountofGrade4->fetch_assoc();

$CountGrade5PresentNow = $mysqli->query("SELECT COUNT(studentrecord.SR_number) FROM studentrecord 
                            LEFT JOIN attendance ON studentrecord.SR_number = attendance.SR_number
                            WHERE studentrecord.SR_grade = '5' AND attendance.A_date = CURRENT_DATE AND acadYear = '$currentSchoolYear'");
$Grade5PresentNow = $CountGrade5PresentNow->fetch_assoc();
$OverallCountofGrade5 = $mysqli->query("SELECT COUNT(SR_number) FROM classlist WHERE SR_grade = '5' AND acadYear = '$currentSchoolYear'");
$AllGrade5 = $OverallCountofGrade5->fetch_assoc();

$CountGrade6PresentNow = $mysqli->query("SELECT COUNT(studentrecord.SR_number) FROM studentrecord 
                            LEFT JOIN attendance ON studentrecord.SR_number = attendance.SR_number
                            WHERE studentrecord.SR_grade = '6' AND attendance.A_date = CURRENT_DATE AND acadYear = '$currentSchoolYear'");
$Grade6PresentNow = $CountGrade6PresentNow->fetch_assoc();
$OverallCountofGrade6 = $mysqli->query("SELECT COUNT(SR_number) FROM classlist WHERE SR_grade = '6' AND acadYear = '$currentSchoolYear'");
$AllGrade6 = $OverallCountofGrade6->fetch_assoc();

$AttendancePerGrade[] = $KinderPresentNow['COUNT(studentrecord.SR_number)'];
$AttendancePerGrade[] = $Grade1PresentNow['COUNT(studentrecord.SR_number)'];
$AttendancePerGrade[] = $Grade2PresentNow['COUNT(studentrecord.SR_number)'];
$AttendancePerGrade[] = $Grade3PresentNow['COUNT(studentrecord.SR_number)'];
$AttendancePerGrade[] = $Grade4PresentNow['COUNT(studentrecord.SR_number)'];
$AttendancePerGrade[] = $Grade5PresentNow['COUNT(studentrecord.SR_number)'];
$AttendancePerGrade[] = $Grade6PresentNow['COUNT(studentrecord.SR_number)'];

$arrayAttendancePerGrade = json_encode($AttendancePerGrade);
echo "<script>var arrayAttendance = " . $arrayAttendancePerGrade . ";</script>";
// end 
