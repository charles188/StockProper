<?php
include("./assets/dbConnect.php");

$fullname 		= $_POST['fullname'];
$username 		= $_POST['username'];
$email       	= $_POST['email'];
$password 		= MD5($_POST['password']); //encrypt password
$business_name  = $_POST['businessname'];
$business_type	= $_POST['businesstype'];
$business_address	= $_POST['address'];
$postcode 		= $_POST['postcode'];
$phone 		    = $_POST['phone'];
$query = "SELECT email_address, username FROM users WHERE email_address=? OR username=?";
    $stmt = $db->prepare($query);
    if($stmt){
        $stmt->bind_param('ss', $email, $username);
        $stmt->execute();
        $stmt->bind_result($email_address, $user_name);
        $stmt->fetch();
        if(!empty($email_address) || !empty($user_name)){
            $error = "This username or email is taken, please choose another one.";
            include 'error.html.php';
            exit;
        }
    }
$sql = "INSERT INTO users (fullname, username, email_address, password, business_name, business_type, business_address, postcode, phone) VALUES ('$fullname', '$username', '$email', '$password', '$business_name', '$business_type', '$business_address', '$postcode', '$phone')";

if (mysqli_query($db , $sql)) {
    header("location: signupthankyou.html");
} else {
    $error = mysqli_error($db);
    include 'error.html.php';
    exit;
}
$db -> close();

//header("location: signupthankyou.html");


?>