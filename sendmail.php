<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    
    $to = "sandhip2022@gmail.com";
    $subject = "Contact Us Form Submission";
    $headers = "From: $email";
    
    $mailBody = "Name: $name\nEmail: $email\nMessage:\n$message";
    
    if (mail($to, $subject, $mailBody, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Oops! Something went wrong.";
    }
}
?>
