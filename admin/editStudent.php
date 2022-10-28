<?php
require_once("../utils/server.php");
$getStudentRecord = "SELECT * FROM studentrecord";
$result = $mysqli->query($getStudentRecord);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
</head>

<body>
    <h1>Edit Student</h1>
    <a href="../index.php">Home</a>
    <?php
    if ($result->num_rows >= 1) {
        while ($data = $result->fetch_assoc()) { ?>
            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
                <div class="container">
                    <div class="row card p-3 m-3">
                        <div class="col m-3">
                            <div class="form group p-1">
                                <h1>STUDENT INFORMATION</h1>
                                <label for="SR_number">Student Number</label>
                                <input type="text" name="SR_number" id="SR_number" value="<?php echo $data['SR_number'] ?>" readonly>
                            </div>
                            <div class="form group p-1">
                                <label for="SR_fname">First Name</label>
                                <input type="text" name="SR_fname" id="SR_fname" value="<?php echo $data['SR_fname'] ?>">
                                <label for="SR_mname">Middle Name</label>
                                <input type="text" name="SR_mname" id="SR_mname" value="<?php echo $data['SR_mname'] ?>">
                                <label for="SR_lname">Last Name</label>
                                <input type="text" name="SR_lname" id="SR_lname" value="<?php echo $data['SR_lname'] ?>">
                            </div>
                            <div class="form group p-1">
                                <label for="SR_age">Age</label>
                                <input type="number" name="SR_age" id="SR_age" value="<?php echo $data['SR_age'] ?>" size="1"> <!-- baguhin yung size kasi ang lapad para sa age lang -->
                                <label for="SR_birthday">Birthday</label>
                                <input type="date" name="SR_birthday" id="SR_birthday" value="<?php echo $data['SR_birthday'] ?>"> <!-- error to ayusin kapag may net -->
                                <label for="SR_gender">Gender</label>
                                <input type="text" name="SR_gender" id="SR_gender" value="<?php echo $data['SR_gender'] ?>" size="3">
                            </div>
                            <div class="form group p-1">
                                <label for="SR_address">Address</label>
                                <input type="text" name="SR_address" id="SR_address" value="<?php echo $data['SR_address'] ?>">
                                <label for="SR_guardian">Guardian</label>
                                <input type="text" name="SR_guardian" id="SR_guardian" value="<?php echo $data['SR_guardian'] ?>">
                                <label for="SR_contact">Contact</label>
                                <input type="text" name="SR_contact" id="SR_contact" value="<?php echo $data['SR_contact'] ?>">
                            </div>
                        </div>
                        <div class="col m-3">
                            <div class="form group p-1">
                                <h1>SCHOOL INFORMATION</h1>
                                <label for="SR_grade">Year Level</label>
                                <input type="text" name="SR_grade" id="SR_grade" value="<?php echo $data['SR_grade'] ?>" size="5">
                                <label for="SR_section">Section</label>
                                <input type="text" name="SR_section" id="SR_section" value="<?php echo $data['SR_section'] ?>" size="25">
                            </div>
                        </div>
                        <div class="col m-3">
                            <h1>SUBJECTS ENROLLED</h1>
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Quarter</th>
                                        <th scope="col">English</th>
                                        <th scope="col">Math</th>
                                        <th scope="col">Science</th>
                                        <th scope="col">Physical Education</th>
                                        <th scope="col">Final Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="GET">
                                        <tr>
                                            <?php
                                            if (isset($_GET['ST_number'])) {
                                                $ST_number = $_GET['ST_number'];

                                                $getStudentGrades = "SELECT * FROM grades WHERE SR_number = '$ST_number'";
                                                $result = $mysqli->query($getStudentGrades);

                                                if ($result->num_rows >= 0) {
                                                    while ($data = $result->fetch_assoc()) { ?>
                                                        <th scope="row"><?php echo $data['G_grading'] ?></th>
                                                        <td><input type="text" value="<?php echo $data['G_english'] ?>" size="1"></td>
                                                        <td><input type="text" value="<?php echo $data['G_math'] ?>" size="1"></td>
                                                        <td><input type="text" value="<?php echo $data['G_science'] ?>" size="1"></td>
                                                        <td><input type="text" value="<?php echo $data['G_physicaled'] ?>" size="1"></td>
                                                        <td><input type="text" value="<?php echo $data['G_finalgrade'] ?>" size="1"></td>
                                                <?php
                                                    }
                                                }
                                            } else { ?>
                                                <th class="text-center" colspan="6">No data</th>
                                            <?php
                                            }
                                            ?>

                                        </tr>
                                    </form>
                                </tbody>
                            </table>
                        </div>
                        <input type="submit" name="updateStudent" id="updateStudent" value="Update Student">
                    </div>
                </div>

                </div>
            </form>
    <?php
        }
    }
    ?>
</body>

</html>