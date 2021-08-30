<?php

include("assets/dbConnect.php"); //Establishing connection with our database
session_start();

if(empty($_POST["username"]) || empty($_POST["password"])) 
{
    $GLOBALS['loginError'] = 'Both fields are required.';
}

//else echo $OK

    $username = $_POST['username'];
    $password = MD5($_POST['password']);
    $usertype = $_POST['usertype'];
    //$sql = "SELECT * FROM users WHERE username LIKE '$email' AND password LIKE '$password' ";
    //$sql="SELECT userid FROM users WHERE email='$email' and password='$password'";

    //$result = $conn->query($sql);
   // $result=mysqli_query($db,$sql);
if(isset($usertype) && $usertype=="Regular User"){
    $query = "SELECT userid, fullname, username, email_address, business_name, business_type, business_address, postcode, 
    phone, date(created_at) as date FROM users WHERE email_address=? OR username=? AND password=? LIMIT 1";
    $stmt = $db->prepare($query);
    if($stmt){
        $stmt->bind_param('sss', $username, $username, $password);
        $stmt->execute();
        $stmt->bind_result($userid, $fullname, $username, $email, $bus_name, $bus_type, $bus_address, $postcode, $phone, $date );
        $stmt->fetch();
        $_SESSION['email'] = $email;
        $_SESSION['userid'] = $userid;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['username'] = $username;
        $_SESSION['bus_name'] = $bus_name;
        $_SESSION['bus_type'] = $bus_type;
        $_SESSION['bus_address'] = $bus_address;
        $_SESSION['postcode'] = $postcode;
        $_SESSION['phone'] = $phone;
        $_SESSION['date'] = $date;
        //check if user is found
        if(empty($userid) && empty($username)){
            $error  = "Incorrect username or password";
            include 'error.html.php';
            exit;
        }
        //goto user dashboard
        header('Location: user');
    }
    else
    {
        $error  = "Email / Password is Invalid ". mysqli_error($db);
        include 'error.html.php';
        exit;
    }
}else if($usertype == "Admin"){
    $query = "SELECT adminid, fullname, username, date(created_at) as date
     FROM admin WHERE username=? AND password=? LIMIT 1";
    $stmt = $db->prepare($query);
    if($stmt){
        $stmt->bind_param('ss',  $username, $password);
        $stmt->execute();
        $stmt->bind_result($adminid, $fullname, $username, $date);
        $stmt->fetch();
        $_SESSION['adminid'] = $adminid;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['username'] = $username;
        $_SESSION['date'] = $date;

        //check if user is found
        if(!isset($adminid) && !isset($username)){
            $error  = "User not found";
            include 'error.html.php';
            exit;
        }
        //goto admin dashboard
        header('Location: admin');
        
    }
    else
    {
        $error  = "Email / Password is Invalid ". mysqli_error($db);
        include 'error.html.php';
        exit;
    }

}
    $db -> close();

?>