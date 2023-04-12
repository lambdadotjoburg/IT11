<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require_once __DIR__ . '/vendor/autoload.php';
    
    // Get dotenv file variables
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    
    // Specify dotenv variables required in this document
    $dotenv->required(['EMAIL_HOST', 'EMAIL_USER', 'EMAIL_PASSWORD']);
    
    $emailServer = $_ENV["EMAIL_HOST"];
    $emailUser = $_ENV["EMAIL_USER"];
    $emailPassword = $_ENV["EMAIL_PASSWORD"];
    
    // Map properties to dotenv variables
    $email_username = (string) $emailUser;
    $email_password = (string) $emailPassword;
    $email_server = (string) $emailServer;
    
    // PHPMailer Stuff happens here
    require_once __DIR__ . '/vendor/phpmailer/phpmailer/src/Exception.php';
    require_once __DIR__ . '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require_once __DIR__ . '/vendor/phpmailer/phpmailer/src/SMTP.php';
    
    // PHPMailer Class from PHPMailer Library/Package
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
               
    $mail = new PHPMailer(true);
                
    // Server settings
    $mail->SMTPDebug = true; // Enable Debug
    $mail->isSMTP(); // Send using SMTP
    
    // Set the SMTP Host Server through which to Send Emails
    $mail->Host = $emailServer;
                
    $mail->SMTPAuth = true;
                
    $mail->Username = $emailUser;
    $mail->Password = $emailPassword;
                
    // Enable SSL encryption
    $mail->SMTPSecure = "ssl";
                
    $mail->Port = 465;
                
    // From
    $from_name = (string) "do-not-reply";
    $from_email = (string) "do-not-reply@<your_domain>";
    $mail->SetFrom($from_email, $from_name);
    
    // To
    $reply_to_name = (string) "do-not-reply";
    $reply_to_email = (string) "do-not-reply@<your_domain>";
    $mail->clearReplyTos();
    $mail->addReplyTo($reply_to_email, $reply_to_name);
    
    // Headers
    $headers = 'From: ' .$from_email . '\r\n';
    $headers .= 'Reply-To: ' . $reply_to_email . '\r\n';
                            
    $recipient_email_address = "<recipient_email_address@gmail.com>";
    $mail->addAddress($recipient_email_address);
                
    $body = "This is the email message body";
    $subject = "This is the Subject/Heading";
                
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = $body;
                
    $mail->send();
    
    header("location: https://www.youtube.com/channel/UCpK5H0NTVxeI7551giHLcsQ");
    
    exit();
    
?>