<?php
require_once("../utils/server.php");
if (!$_SESSION['student_num']) {
    header('Location: studentnumber.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h1>REGISTER PAGE</h1>
    <a href="../index.php">Home</a>

    <form method="post" action="<?php $_SERVER["PHP_SELF"] ?>">
        <p><?php echo $_SESSION['student_num'] ?></p>
        <input type="text" name="usersEmail" placeholder="Email Address">
        <input type="password" name="usersPwd" placeholder="Password">
        <button type="submit" name="register-button">Register</button>
    </form>
</body>

</html>