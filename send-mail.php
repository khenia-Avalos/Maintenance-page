<?php
// Cargar PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// --- Verificar reCAPTCHA ---
function verificarRecaptcha($secretKey, $response) {
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $secretKey,
        'response' => $response
    ];
    
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $resultJson = json_decode($result, true);
    
    return $resultJson['success'];
}

// Cargar variables de entorno desde .env
if (file_exists(__DIR__ . '/.env')) {
    $env = parse_ini_file(__DIR__ . '/.env');
    if ($env) {
        foreach ($env as $key => $value) {
            putenv("$key=$value");
        }
    }
}

// Siempre responder en JSON
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // --- Verificar reCAPTCHA ---
    $recaptchaSecret = '6Lekr9QsAAAAADRI9sNmkFSRHIw4IQYDhz7qPLSu'; 
    $recaptchaResponse = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';

    if (empty($recaptchaResponse)) {
        echo json_encode(["success" => false, "error" => "Please complete the CAPTCHA verification."]);
        exit;
    }

    if (!verificarRecaptcha($recaptchaSecret, $recaptchaResponse)) {
        echo json_encode(["success" => false, "error" => "CAPTCHA verification failed. Please try again."]);
        exit;
    }

    // --- Recibir y limpiar datos ---
    $name = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $phone = isset($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : '';
    $service = isset($_POST['service']) ? trim(strip_tags($_POST['service'])) : '';
    $message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';
    $request_type = isset($_POST['request_type']) ? trim(strip_tags($_POST['request_type'])) : '';
    $preferred_date = isset($_POST['preferred_date']) ? trim(strip_tags($_POST['preferred_date'])) : '';

    // --- Validar campos obligatorios ---
    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(["success" => false, "error" => "Please complete all required fields."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "error" => "The email address is not valid."]);
        exit;
    }

    // --- Determinar tipo de solicitud ---
    $request_label = 'Free Estimate Request';
    if ($request_type == 'schedule') {
        $request_label = 'Schedule a Service';
    }

    // --- Configurar SMTP de Hostinger ---
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'contact@monteromaintenance.com';
        $mail->Password   = getenv('SMTP_PASSWORD');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // --- Configuración de codificación (importante) ---
        $mail->setFrom('contact@monteromaintenance.com', 'Montero Maintenance');
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'quoted-printable';
        
        // --- DESTINATARIO ---
        $mail->addAddress('the.montero.groups@gmail.com', 'Jorge Montero');
        
        // --- REPLY-TO ---
        $mail->addReplyTo($email, $name);

        // --- Contenido del correo (HTML con UTF-8) ---
        $mail->isHTML(true);
        $mail->Subject = "New Contact Request - $service";

        // Preparar fecha si existe
        $date_html = '';
        if (!empty($preferred_date)) {
            $date_formatted = date('F j, Y', strtotime($preferred_date));
            $date_html = '
                <tr>
                    <td style="padding: 12px; background-color: #FAF0E6; border-bottom: 1px solid #E5E7EB; font-weight: bold; width: 130px;">Preferred Date:</td>
                    <td style="padding: 12px; background-color: #FAF0E6; border-bottom: 1px solid #E5E7EB;">' . htmlspecialchars($date_formatted) . '</td>
                </table>';
        }

        $mail->Body = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Montero Maintenance</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f4; padding: 30px 20px;">
        <tr>
            <td align="center">
                <table width="550" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background: #1A1A1A; padding: 30px 24px; text-align: center;">
                            <div style="width: 60px; height: 60px; background-color: #D2B48C; border-radius: 50%; display: inline-block; font-size: 28px; font-weight: bold; color: #1A1A1A; line-height: 60px; margin-bottom: 16px;">M</div>
                            <h1 style="color: #ffffff; font-size: 24px; margin: 0;">Montero Maintenance</h1>
                            <p style="color: #9CA3AF; margin: 8px 0 0;">White-glove service for discerning homeowners</p>
                        </td>
                    </tr>
                    <!-- Content -->
                    <tr>
                        <td style="padding: 30px 28px;">
                            <div style="display: inline-block; background-color: #FAF0E6; color: #D2B48C; padding: 6px 14px; border-radius: 50px; font-size: 12px; font-weight: 600; margin-bottom: 24px;">' . $request_label . '</div>
                            
                            <h2 style="color: #1A1A1A; font-size: 20px; margin: 0 0 20px;">New Client Request</h2>
                            
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #FAF0E6; border-radius: 12px; overflow: hidden;">
                                <tr>
                                    <td style="padding: 12px; background-color: #FAF0E6; border-bottom: 1px solid #ddd; font-weight: bold; width: 130px;">Name:</td>
                                    <td style="padding: 12px; background-color: #FAF0E6; border-bottom: 1px solid #ddd;">' . htmlspecialchars($name) . '</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px; background-color: #FAF0E6; border-bottom: 1px solid #ddd; font-weight: bold;">Email:</td>
                                    <td style="padding: 12px; background-color: #FAF0E6; border-bottom: 1px solid #ddd;">' . htmlspecialchars($email) . '</td>
                                </tr>' .
                                (!empty($phone) ? '
                                <tr>
                                    <td style="padding: 12px; background-color: #FAF0E6; border-bottom: 1px solid #ddd; font-weight: bold;">Phone:</td>
                                    <td style="padding: 12px; background-color: #FAF0E6; border-bottom: 1px solid #ddd;">' . htmlspecialchars($phone) . '</td>
                                </tr>' : '') . '
                                <tr>
                                    <td style="padding: 12px; background-color: #FAF0E6; border-bottom: 1px solid #ddd; font-weight: bold;">Service:</td>
                                    <td style="padding: 12px; background-color: #FAF0E6; border-bottom: 1px solid #ddd;">' . htmlspecialchars($service) . '</td>
                                </tr>' .
                                $date_html . '
                            </table>
                            
                            <div style="margin: 24px 0 12px;">
                                <strong style="color: #1A1A1A;">Message:</strong>
                            </div>
                            
                            <div style="background-color: #FAF0E6; border-radius: 12px; padding: 20px;">
                                <p style="margin: 0; color: #4B5563;">' . nl2br(htmlspecialchars($message)) . '</p>
                            </div>
                            
                            <div style="background-color: #1A1A1A; border-radius: 12px; padding: 20px; text-align: center; margin-top: 24px;">
                                <p style="color: #9CA3AF; font-size: 13px; margin: 0 0 8px;">Action Required</p>
                                <p style="color: #fff; font-size: 14px; margin: 0;">Reply using the email above' . (!empty($phone) ? ' or call ' . htmlspecialchars($phone) : '') . '</p>
                            </div>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #FAF0E6; padding: 20px; text-align: center;">
                            <p style="margin: 0; color: #6B7280; font-size: 12px;">&copy; ' . date('Y') . ' Montero Maintenance LLC</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';

        // Versión texto plano
        $mail->AltBody = "=== MONTERO MAINTENANCE ===\n\n";
        $mail->AltBody .= "Request Type: $request_label\n";
        $mail->AltBody .= "Name: $name\n";
        $mail->AltBody .= "Email: $email\n";
        if (!empty($phone)) $mail->AltBody .= "Phone: $phone\n";
        $mail->AltBody .= "Service: $service\n";
        if (!empty($preferred_date)) {
            $date_formatted = date('F j, Y', strtotime($preferred_date));
            $mail->AltBody .= "Preferred Date: $date_formatted\n";
        }
        $mail->AltBody .= "\n--- Message ---\n$message\n";

        // Enviar
        $mail->send();
        echo json_encode(["success" => true, "message" => "Your message has been sent successfully! We'll contact you within 24 hours."]);

    } catch (Exception $e) {
        echo json_encode(["success" => false, "error" => "Error sending message: " . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Method not allowed"]);
}
?>