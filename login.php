<?php
session_start();
if (isset($_POST["login"])) {

    echo "you clicked a button";

    include "connection.php";

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = '$email'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {

            echo "Correct email";

            $db_password = $row["password"];

            if (password_verify($password, $db_password)) {
                echo "Password matches.";

                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["first_name"] = $row["first_name"];
                $_SESSION["last_name"] = $row["last_name"];
                $_SESSION["user_type"] = $row["user_type"];
            } else {
                echo "incorrect password";
            }
        }
    } else {
        echo "Incorrect email";
    }
}



include "header.php";  ?>

<h1>Login</h1>






<form action="login.php" method="post">

    <p>Email</p>
    <p><input type="text" name="email"></p>

    <p>Password</p>
    <p><input type="text" name="password"></p>

    <p><input type="submit" name="login"></p>


</form>







<?php include "footer.php";  ?>