<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    ini_set("SMTP", "aspmx.l.google.com");
    ini_set("sendmail_from", "faroukbenabed@gmail.com");
    // Retrieve form fields
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validate inputs (you can add more robust validation if needed)
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        // Email parameters
        $to = 'faroukbenabed@gmail.com';
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        // Email subject and message
        $email_subject = "New Contact Form Submission: $subject";
        $email_body = "<strong>Name:</strong> $name<br>";
        $email_body .= "<strong>Email:</strong> $email<br>";
        $email_body .= "<strong>Message:</strong><br>" . nl2br($message);
        
        // Send the email
        if (mail($to, $email_subject, $email_body, $headers)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to send email, please try agian later.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'All fields are required.']);
    }
}
