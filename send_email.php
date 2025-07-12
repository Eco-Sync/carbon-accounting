<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"] ?? ''));
    $email = filter_var(trim($_POST["email"] ?? ''), FILTER_VALIDATE_EMAIL);
    $message = strip_tags(trim($_POST["message"] ?? ''));

    if (empty($name) || !$email || empty($message)) {
        echo "Please fill in all fields correctly.";
        exit;
    }

    $to = "andrew.yarkw@gmail.com";  // Your email address
    $subject = "New message from website contact form";

    $email_body = "You have received a new message from your website contact form.\n\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n\n";
    $email_body .= "Message:\n$message\n";

    $headers = "From: no-reply@yoursite.com\r\n";  // Change to your domain email
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $subject, $email_body, $headers)) {
        header("Location: thankyou.html");
        exit;
    } else {
        echo "Oops! Something went wrong, please try again.";
    }
} else {
    echo "Invalid request.";
}
?>
