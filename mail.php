<?php


$fullname = $_POST['fullname'];
$email= $_POST['email'];
$phone= $_POST['phone'];
$message= $_POST['message'];
$to = "stockproper@gmail.com";
$subject = "Mail From Stockproper";
$txt ="Name = ". $fullname . "\r\n  Email = " . $email . "\r\n  Phone = " . $phone . "\r\n  Subject = " . $subject . "\r\n Message =" . $message;
$headers = "From: noreply@stockproper.com";
if($email!=NULL){
    mail($to,$subject,$txt,$headers);
}
//redirect to thankyou page
header("Location:thankyou.html");







?>