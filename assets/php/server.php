<?php
session_start();
include('database.php');
include('mail.php');
$errors = array();
$year = date('Y');
$month = date('m');

function function_alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
function function_prompt($msg)
{
    echo "<script type='text/javascript'>prompt('$msg');</script>";
}
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
function timeMinusOneMinute($data) //sa endtime lang to ilalagay
{
    $convertedTime = strtotime($data);
    $timeMinusOneMinute = $convertedTime - 60;
    $data = date("H:i", $timeMinusOneMinute);

    return $data;
}
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
        $authAccount = $mysqli->query("SELECT * FROM userdetails WHERE SR_email = '$email'");

        if ($authAccount->num_rows == 1) {
            $verifyData = $authAccount->fetch_assoc();

            $check_existingOTP = $mysqli->query("SELECT OTP FROM userdetails WHERE SR_email = '{$email}'");
            $otpData = $check_existingOTP->fetch_assoc();

            if ($otpData['OTP'] == "") {
                $otp = generateOTP();
                $createOTP = $mysqli->query("UPDATE userdetails SET OTP = '$otp' WHERE SR_email = '{$verifyData['SR_email']}'");
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

                if (!$mail->send()) {
                    echo 'Mailer Error: ';
                } else {
                    echo 'The email message was sent!';
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

    if ($verifyOTP->num_rows == 1) {
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
                if (!$mail->send()) {
                    echo 'Mailer Error: ';
                } else {
                    $removeOTP = $mysqli->query("UPDATE userdetails SET OTP = null WHERE SR_email = '{$verifyData['SR_email']}'");
                    echo 'The email message was sent!';
                    header('Location: login.php');
                }
            }
        }
    }
}
//END

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

    $getemail = $mysqli->query("SELECT SR_email FROM studentrecord WHERE SR_number = '{$studentID}'");
    $emailAd = $getemail->fetch_assoc();

    if ($checkAttendance->num_rows == 0) {
        $timeIN = $mysqli->query("INSERT INTO attendance (SR_number, A_date, A_time_IN, A_fetcher_IN) VALUES ('{$studentID}', '{$date}', '{$time}', '{$fetcherID}')");
        if ($timeIN) {
            $getstudentInfo = $mysqli->query("SELECT * FROM studentrecord WHERE SR_number = '{$studentID}'");
            $mail->addAddress($emailAd['SR_email']);
            $mail->Subject = 'Attendance: Time In';

            $mail->Body = '<h1>Student Timed In</h1>
                       <br>
                       <p>ATTENDANCE DETAILS</p><br>
                       <b>Time: </b>' . $time . '<br>
                       <b>Date: </b>' . $date . '<br>';
            $mail->send();
        }
    } else if (empty($attendanceData['A_time_OUT']) || empty($attendanceData['A_fetcher_OUT'])) {

        $timeOUT = $mysqli->query("UPDATE attendance SET A_time_OUT = '{$time}', A_fetcher_OUT = '{$fetcherID}' WHERE SR_number = '{$studentID}'");
        if ($timeOUT) {
            $mail->addAddress($emailAd['SR_email']);
            $mail->Subject = 'Attendance: Time Out';

            $mail->Body = '<h1>Student Timed Out</h1>
                       <br>
                       <p>Attendance Detail</p><br>
                       <b>Fetched by: </b>' . $time . '<br>
                       <b>Date: </b>' . $date . '<br>
                       <b>Fetched By: </b>' . $fetcherID . '<br>';
            $mail->send();
        }
    } else {
        function_alert("Student already timed out");
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
    $header = $mysqli->real_escape_string($_POST['header']);
    $subject = $mysqli->real_escape_string($_POST['subject']);
    $MSG = $mysqli->real_escape_string($_POST['MSG']);
    $date = $mysqli->real_escape_string($_POST['date']);
    $dateposted = date("Y/m/d");

    $addReminders = "INSERT INTO reminders(header, date_posted, author, subject, msg, deadline)
                     VALUE ('$header', '$dateposted', '$author','$subject', '$MSG', '$date')";
    $resultaddReminders = $mysqli->query($addReminders);

    if ($resultaddReminders) {
        header('Location: ../faculty/reminders.php');
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
    $timeAdded = date("Y/m/d");

    $regStudent = "INSERT INTO studentrecord(
                    SR_number, SR_year, 
                    SR_lname, SR_fname, SR_mname, SR_suffix,
                    SR_age, SR_birthday, SR_birthplace, SR_gender,
                    SR_religion, SR_citizenship, SR_grade, SR_section,
                    SR_address, SR_barangay, SR_city, SR_state, SR_postal, 
                    SR_email, SR_added)
                    VALUES(
                    '$SR_number', '$year', 
                    '$S_lname', '$S_fname', '$S_mname', '$S_suffix',
                    '$S_age', '$S_birthday', '$S_birthplace', '$S_gender',
                    '$S_religion','$S_citizenship', '$S_grade', '$S_section',
                    '$S_address', '$S_barangay', '$S_city', '$S_state', '$S_postal',
                    '$S_email', '$timeAdded')";
    $RunregStudent = $mysqli->query($regStudent);
    $regGuardian = "INSERT INTO guardian(
                    G_guardianOfStudent,
                    G_lname, G_fname, G_mname, G_suffix,
                    G_address, G_barangay, G_city, G_state, G_postal, 
                    G_email, G_relationshipStudent, G_telephone, G_contact)
                    VALUES(
                    '$SR_number',
                    '$G_lname', '$G_fname', '$G_mname', '$G_suffix',
                    '$G_address', '$G_barangay', '$G_city', '$G_state', '$G_postal',
                    '$G_email', '$G_relationshipStudent', '$G_telephone', '$G_contact')";
    $RunregGuardian = $mysqli->query($regGuardian);

    // How to Validate Password Strength in PHP
    // Password must be at least 8 characters in length.
    // Password must include at least one upper case letter.
    // Password must include at least one number.
    // Password must include at least one special character..

    unset($_SESSION['fromAddStudent']);
    if ($RunregGuardian) {
        $GenPass = generatePassword();
        $createStudentLoginCredentials = $mysqli->query("INSERT INTO userdetails(SR_email, SR_password, role)
                                                         VALUES ('$S_email', '$GenPass', 'student')");
        $Fullname = $S_lname . ", " . $S_fname . " " . $S_mname . " " . $S_suffix;

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

        if (!$mail->send()) {
            echo 'Mailer Error: ';
        } else {
            echo 'The email message was sent!';
            header('Location: student.php');
        }
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
        $GenPass = generatePassword();
        $createStudentLoginCredentials = $mysqli->query("INSERT INTO userdetails(SR_email, SR_password, role)
                                                         VALUES ('$F_email', '$GenPass', 'faculty')");
        $Fullname = $F_lname . ", " . $F_fname . " " . $F_mname . " " . $F_suffix;

        $mail->addAddress($F_email);
        $mail->Subject = 'STUDENT REGISTRATION';

        $mail->Body = '<h1>Registration Complete</h1>
                       <br>
                       <p>Your login credentials is:</p><br>
                       <b>Email: </b>' . $F_email . '<br>
                       <b>Password: </b>' . $GenPass . '<br>
                       <br>
                       <strong>IT IS RECOMMENDED TO RESET YOUR PASSWORD</strong><br>
                       <a href="siscdsp.online/auth/login.php">Login now</a>';

        if (!$mail->send()) {
            echo 'Mailer Error: ';
        } else {
            echo 'The email message was sent!';
            header('Location: ../admin/faculty.php');
        }
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
if (isset($_POST['addSubject'])) {
    $subjectName = $mysqli->real_escape_string($_POST['sbjName']);
    $minYearLevel = $mysqli->real_escape_string($_POST['minYearLevel']);
    $maxYearLevel = $mysqli->real_escape_string($_POST['maxYearLevel']);

    $addSubject = $mysqli->query("INSERT INTO subjectperyear(subjectName, minYearLevel, maxYearLevel) VALUES('{$subjectName}','{$minYearLevel}','{$maxYearLevel}')");
}
if (isset($_POST['updateCurr'])) {
    $subjectName = $_POST['sbjName'];
    $minYearLevel = $_POST['minYearLevel'];
    $maxYearLevel = $_POST['maxYearLevel'];

    $updateSubject = $mysqli->query("UPDATE subjectperyear SET minYearLevel = '$minYearLevel', maxYearLevel = '$maxYearLevel' WHERE subjectName = '$subjectName'");
}
if (isset($_POST['deleteCurr'])) {
    $subjectName = $mysqli->real_escape_string($_POST['sbjName']);
    $minYearLevel = $mysqli->real_escape_string($_POST['minYearLevel']);
    $maxYearLevel = $mysqli->real_escape_string($_POST['maxYearLevel']);

    $deleteSubject = $mysqli->query("DELETE from subjectperyear WHERE minYearLevel = '{$minYearLevel}' AND maxYearLevel = '{$maxYearLevel}' AND subjectName = '{$subjectName}'");
}
if (isset($_POST['addAdmin'])) {
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
}
if (isset($_POST['setSchedule'])) {
    $assignedFaculty = $_POST['assignedFaculty'];
    $subjectname = $_POST['subjectname'];
    $startime = $_POST['WS_start_time'];
    $endtime = timeMinusOneMinute($_POST['WS_end_time']);

    $checkSchedule = $mysqli->query("SELECT WS_start_time, WS_end_time FROM workschedule
                    WHERE F_number = '{$assignedFaculty}' AND
                    (WS_start_time BETWEEN '{$startime}' AND '{$endtime}') OR 
                    (WS_end_time BETWEEN '{$startime}' AND '{$endtime}') OR
                    ('{$startime}' BETWEEN WS_start_time AND WS_end_time)");

    if ($checkSchedule->num_rows == 0) {
        $setSchedule = $mysqli->query("INSERT INTO workschedule (F_number, S_subject, SR_grade, SR_section, WS_start_time, WS_end_time) 
                                    VALUES ('{$assignedFaculty}', '{$subjectname}', '{$_GET['GradeLevel']}', '{$_GET['SectionName']}', '{$startime}', '{$endtime}')");
    } else {
        echo "ASSIGNING FAIL CONFLICT IN TIME";
    }
}
if (isset($_POST['updateSchedule'])) { //NOT WORKING
    $assignedFaculty = $_POST['assignedFaculty'];
    $subjectname = $_POST['subjectname'];
    $startime = $_POST['WS_start_time'];
    $endtime = timeMinusOneMinute($_POST['WS_end_time']);

    $checkSchedule = $mysqli->query("SELECT S_subject, WS_start_time, WS_end_time FROM workschedule
                    WHERE F_number = '{$assignedFaculty}' AND
                    (WS_start_time BETWEEN '{$startime}' AND '{$endtime}') OR 
                    (WS_end_time BETWEEN '{$startime}' AND '{$endtime}') OR
                    ('{$startime}' BETWEEN WS_start_time AND WS_end_time) ");
    $scheduleData = $checkSchedule->fetch_assoc();

    if ($checkSchedule->num_rows == 0) {
        $setSchedule = $mysqli->query("UPDATE workschedule SET WS_start_time = '{$startime}', WS_end_time = '{$endtime}' WHERE S_subject = '{$subjectname}' AND F_number = '{$assignedFaculty}' AND SR_grade = '{$_GET['GradeLevel']}' AND SR_section = '{$_GET['SectionName']}'");
    } elseif ($scheduleData['S_subject'] == $subjectname) {
        $setSchedule = $mysqli->query("UPDATE workschedule SET WS_start_time = '{$startime}', WS_end_time = '{$endtime}' WHERE S_subject = '{$subjectname}' AND F_number = '{$assignedFaculty}' AND SR_grade = '{$_GET['GradeLevel']}' AND SR_section = '{$_GET['SectionName']}'");
    } else {
        echo "UPDATE FAIL CONFLICT IN TIME";
    }
}
if (isset($_POST['postAnnouncement'])) {
    $author = $_POST['author'];
    $date = $_POST['date'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $CreateAnnouncement = $mysqli->query("INSERT INTO announcement(header, author, date, msg) VALUE('{$subject}', '{$author}', '{$date}', '{$message}')");
}
if (isset($_POST['assignAdvisor'])) {
    $section = $_POST['section'];
    $advisor = $_POST['advisor'];

    $assignAdvisor = $mysqli->query("UPDATE sections SET S_adviser = '{$advisor}' WHERE S_name = '{$section}'");
}


//End
