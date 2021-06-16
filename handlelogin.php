<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/dbconnect.php';
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginpass'];


    $sql = "select * from `users` where user_email ='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows == 1){
        $row = mysqli_fetch_assoc($result);
            if(password_verify($pass,$row['user_pass'])){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['useremail'] = $email; 
                echo  "loggedin" . $email;
                header("location:/forum/index.php?loginsuccess=true");
                die();
            }
            header("location:/forum/index.php?loginsuccess=false");
        }
    header("location:/forum/index.php?loginsuccess=false");

}
?>