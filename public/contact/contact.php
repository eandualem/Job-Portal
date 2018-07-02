<?php
require '../../assets/sql/db.php';
require '../../assets/html/header.php';
require 'contact.html';
require '../../assets/html/footer.php';

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        $emailTo="jobportal@gmail.com";
        $subject = $_POST['subject'];
        $content = $_POST['content'];
        $header = "From: ".$_POST['email'];
        if(mail($emailTo, $subject,$content, $header)){
               $_SESSION['message']='Your message has successfully sent.</div>';
        } else {
            $_SESSION['message']='There were error(s) in your form';
        }
  }

?>