<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $name = strip_tags(trim($_POST["name"] ?? ''));
    $email = filter_var(trim($_POST["email"] ?? ''), FILTER_VALIDATE_EMAIL);
    $message = strip_tags(trim($_POST["message"] ?? ''));

    if (empty($name) || !$email || empty($message)) {
        echo "Please fill in all fields correctly.";
        exit;
    }

    // Recipient email
    $to = "andrew.yarkw@gmail.com";

    // Email subject
    $subject = "New message from website contact form";

    // Email body including inputs
    $email_body = "You have received a new message from your website contact form.\n\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n\n";
    $email_body .= "Message:\n$message\n";

    // Email headers
    $headers = "From: no-reply@yoursite.com\r\n"; // Change domain as needed
    $headers .= "Reply-To: $email\r\n";

    // Send email and redirect to thank-you page
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
