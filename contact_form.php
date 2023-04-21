<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Validate form data
    $errors = array();

    // Validate name
    if (empty($name)) {
        $errors[] = "Name is required";
    }

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is invalid";
    }

    // Validate message
    if (empty($message)) {
        $errors[] = "Message is required";
    }

    // If there are no errors, send the email
    if (empty($errors)) {
        $to = "patelsourabh.5959@outlook.com"; // Replace with your email address
        $subject = "Contact Form Submission";
        $body = "Name: " . $name . "\n";
        $body .= "Email: " . $email . "\n";
        $body .= "Message: " . $message . "\n";

        // Additional headers
        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Send the email
        if (mail($to, $subject, $body, $headers)) {
            echo "Message sent successfully!";
        } else {
            echo "Failed to send message. Please try again later.";
        }
    } else {
        // Output error messages
        echo implode("<br>", $errors);
    }
}
?>
