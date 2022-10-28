<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>

<body>
    <h1>Grades</h1>
    <a href="../index.php">Home</a>
    <div class="container">
        <div class="row">
            <div class="col m-3">
                <div class="card p-3">
                    <h1>STUDENT NAME: </h1>
                    <h3>STUDENT NUMBER: </h3>
                </div>
                <div class="">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>