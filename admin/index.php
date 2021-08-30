<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );
session_start();

// user login check
if (!isset($_SESSION['username'])) {
    header("Location: ../"); 
    exit();
}
// logout
if(isset($_GET['logout'])){
    session_unset();
    header('Location: ../');
    exit();
}
// Delete user
if(isset($_POST['action']) && $_POST['action'] == 'Delete'){
    include '../assets/dbConnect.php';
    $sql = "DELETE FROM users WHERE userid=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $_POST['id']);
    if($stmt->execute()){
        $_SESSION['message'] = "User Succesfully Deleted";
        include 'message.html.php';
        exit;
    }else{
        $_SESSION['message'] = "Error Occured ". $db->error;
        include 'message.html.php';
        exit;
    }
    $stmt->close();
    exit;
}

// Approve password
if(isset($_POST['action']) && $_POST['action'] == 'Approve'){
  include '../assets/dbConnect.php';
  $userid = $_POST['userid'];
  $resetid = $_POST['resetid'];
  $password = $_POST['userpassword'];
  $fullname = $_POST['fullname'];
  $sql = "UPDATE users SET password=? WHERE userid=?";
  $stmt = $db->prepare($sql);
  $stmt->bind_param('si', $password, $userid);
  if($stmt->execute()){
    include '../assets/dbConnect.php';
    $sql = "UPDATE password_reset SET approved=1 WHERE resetid=?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $resetid);
    if($stmt->execute()){
      $_SESSION['message'] = "Password change request approved for ". $fullname;
      include 'message.html.php';
      exit;
    }
  }else{
      $_SESSION['message'] = "Error Occured ". $db->error;
      include 'message.html.php';
      exit;
  }
  $stmt->close();
  exit;
}

// show password reset
if(isset($_GET['password-approval'])){
   //load default
try{
  include '../assets/dbConnect.php';
  
  $query = "SELECT password_reset.userid as userid, resetid, password_reset.password as password, fullname, email_address, business_name, 
   date(password_reset.created_at) as date, time(password_reset.created_at) as time FROM 
   users INNER JOIN password_reset ON users.userid = password_reset.userid WHERE password_reset.approved = 0 ORDER BY password_reset.created_at DESC";
  $result = $db->query($query);
  if($result){
    //$result = $stmt->get_result();
    $users = $result->fetch_all(MYSQLI_ASSOC);
    include 'password-approval.html.php';
    exit;
  }else{
    $_SESSION['message'] = 'Error occured '. $db->error;
    include 'message.html.php';
  }
}catch(Exception $ex){
  $_SESSION['message'] = 'Error occured '. $ex;
  include 'message.html.php';
}   

}

// show users
if(isset($_GET['users'])) {
    //load default
try{
    include '../assets/dbConnect.php';
    
    $query = "SELECT userid, fullname, email_address, business_name, business_type,
    business_address, phone, date(created_at) as date, time(created_at) as time FROM users ORDER BY created_at DESC";
    $result = $db->query($query);
    if($result){
      //$result = $stmt->get_result();
      $users = $result->fetch_all(MYSQLI_ASSOC);
      include 'users.html.php';
      exit;
    }else{
      $_SESSION['message'] = 'Error occured '. $db->error;
      include 'message.html.php';
    }
  }catch(Exception $ex){
    $_SESSION['message'] = 'Error occured '. $ex;
    include 'message.html.php';
  }   
}

include 'profile.html.php';
?>