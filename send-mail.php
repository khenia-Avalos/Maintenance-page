<?php
// Cargar PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- Recibir y limpiar datos ---
    $name = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $phone = isset($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : '';
    $service = isset($_POST['service']) ? trim(strip_tags($_POST['service'])) : '';
    $message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';
    $request_type = isset($_POST['request_type']) ? trim(strip_tags($_POST['request_type'])) : '';
    $preferred_date = isset($_POST['preferred_date']) ? trim(strip_tags($_POST['preferred_date'])) : '';
    // --- Verificar reCAPTCHA ---
$recaptchaSecret = getenv('RECAPTCHA_SECRET');  
$recaptchaResponse = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';

if (empty($recaptchaResponse)) {
    echo json_encode(["success" => false, "error" => "Por favor completa el captcha 'No soy un robot'."]);
    exit;
}

if (!verificarRecaptcha($recaptchaSecret, $recaptchaResponse)) {
    echo json_encode(["success" => false, "error" => "Verificación de captcha fallida. Intenta de nuevo."]);
    exit;
}

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
    $request_label = '📋 Request a Free Estimate';
    if ($request_type == 'schedule') {
        $request_label = '📅 Schedule a Service';
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

        // --- REMITENTE ---
        $mail->setFrom('contact@monteromaintenance.com', 'Montero Maintenance');
        
        // --- DESTINATARIO ---
        $mail->addAddress('the.montero.groups@gmail.com', 'Jorge Montero');
        
        // --- REPLY-TO ---
        $mail->addReplyTo($email, $name);

        // --- Contenido del correo en HTML ---
        $mail->isHTML(true);
        $mail->Subject = "New Contact Request - $service";

        // Diseño HTML del correo
        $mail->Body = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Montero Maintenance - New Message</title>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
                    background-color: #FAF0E6;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #FFFFFF;
                    border-radius: 24px;
                    overflow: hidden;
                    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
                }
                .header {
                    background: linear-gradient(135deg, #1A1A1A 0%, #333333 100%);
                    padding: 32px 24px;
                    text-align: center;
                }
                .logo {
                    width: 60px;
                    height: 60px;
                    background-color: #D2B48C;
                    border-radius: 50%;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 28px;
                    font-weight: bold;
                    color: #1A1A1A;
                    margin-bottom: 16px;
                }
                .header h1 {
                    color: #FFFFFF;
                    font-size: 24px;
                    margin: 0;
                    font-weight: 700;
                    letter-spacing: -0.5px;
                }
                .header p {
                    color: #9CA3AF;
                    margin: 8px 0 0;
                    font-size: 14px;
                }
                .content {
                    padding: 32px 28px;
                }
                .badge {
                    display: inline-block;
                    background-color: #FAF0E6;
                    color: #D2B48C;
                    padding: 6px 14px;
                    border-radius: 50px;
                    font-size: 12px;
                    font-weight: 600;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    margin-bottom: 24px;
                }
                .info-card {
                    background-color: #FAF0E6;
                    border-radius: 20px;
                    padding: 20px;
                    margin-bottom: 24px;
                }
                .info-row {
                    display: flex;
                    margin-bottom: 16px;
                    padding-bottom: 12px;
                    border-bottom: 1px solid #E5E7EB;
                }
                .info-row:last-child {
                    border-bottom: none;
                    margin-bottom: 0;
                    padding-bottom: 0;
                }
                .info-label {
                    width: 120px;
                    font-weight: 700;
                    color: #1A1A1A;
                    font-size: 13px;
                    text-transform: uppercase;
                    letter-spacing: 0.3px;
                }
                .info-value {
                    flex: 1;
                    color: #4B5563;
                    font-size: 15px;
                    line-height: 1.5;
                }
                .message-box {
                    background-color: #FFFFFF;
                    border: 1px solid #E8E3DA;
                    border-radius: 16px;
                    padding: 20px;
                    margin-top: 8px;
                }
                .message-box p {
                    margin: 0;
                    color: #4B5563;
                    font-size: 14px;
                    line-height: 1.6;
                }
                .footer {
                    background-color: #FAF0E6;
                    padding: 24px;
                    text-align: center;
                    border-top: 1px solid #E8E3DA;
                }
                .footer p {
                    margin: 0;
                    color: #6B7280;
                    font-size: 12px;
                }
                .highlight {
                    color: #D2B48C;
                    font-weight: 600;
                }
                hr {
                    border: none;
                    height: 1px;
                    background: linear-gradient(90deg, transparent, #D2B48C, transparent);
                    margin: 24px 0;
                }
            </style>
        </head>
        <body style="margin: 0; padding: 30px 20px; background-color: #FAF0E6; font-family: Inter, -apple-system, sans-serif;">
            <div class="container">
                
                <!-- Header -->
                <div class="header">
                    <div class="logo">M</div>
                    <h1>Montero Maintenance</h1>
                    <p>White-glove service for discerning homeowners</p>
                </div>
                
                <!-- Content -->
                <div class="content">
                    <div style="text-align: center;">
                        <span class="badge">' . $request_label . '</span>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-row">
                            <div class="info-label">Client</div>
                            <div class="info-value"><strong>' . htmlspecialchars($name) . '</strong></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Email</div>
                            <div class="info-value"><a href="mailto:' . htmlspecialchars($email) . '" style="color: #D2B48C; text-decoration: none;">' . htmlspecialchars($email) . '</a></div>
                        </div>
                        ' . (!empty($phone) ? '
                        <div class="info-row">
                            <div class="info-label">Phone</div>
                            <div class="info-value">' . htmlspecialchars($phone) . '</div>
                        </div>' : '') . '
                        <div class="info-row">
                            <div class="info-label">Service</div>
                            <div class="info-value"><span style="background-color: #FAF0E6; padding: 4px 12px; border-radius: 50px; font-size: 13px;">' . htmlspecialchars($service) . '</span></div>
                        </div>
                        ' . (!empty($preferred_date) ? '
                        <div class="info-row">
                            <div class="info-label">Preferred Date</div>
                            <div class="info-value">' . date('F j, Y', strtotime($preferred_date)) . '</div>
                        </div>' : '') . '
                    </div>
                    
                    <hr>
                    
                    <div style="margin-bottom: 8px;">
                        <span style="display: inline-block; width: 4px; height: 20px; background-color: #D2B48C; border-radius: 2px; margin-right: 10px; vertical-align: middle;"></span>
                        <strong style="color: #1A1A1A; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Message Details</strong>
                    </div>
                    
                    <div class="message-box">
                        <p>' . nl2br(htmlspecialchars($message)) . '</p>
                    </div>
                    
                    <hr>
                    
                    <div style="background-color: #1A1A1A; border-radius: 16px; padding: 20px; text-align: center; margin-top: 8px;">
                        <p style="color: #9CA3AF; font-size: 13px; margin: 0 0 8px 0;">📎 Action Required</p>
                        <p style="color: #FFFFFF; font-size: 14px; margin: 0; line-height: 1.5;">Respond to this client using the email above or call <span class="highlight">' . (!empty($phone) ? htmlspecialchars($phone) : 'the provided phone number') . '</span></p>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="footer">
                    <p>© ' . date('Y') . ' Montero Maintenance LLC</p>
                    <p style="margin-top: 8px;">White-glove service for discerning homeowners</p>
                </div>
                
            </div>
        </body>
        </html>
        ';

        // Versión texto plano (fallback)
        $mail->AltBody = "=== MONTERO MAINTENANCE ===\n\n";
        $mail->AltBody .= "Type: $request_label\n";
        $mail->AltBody .= "Client: $name\n";
        $mail->AltBody .= "Email: $email\n";
        $mail->AltBody .= (!empty($phone) ? "Phone: $phone\n" : "");
        $mail->AltBody .= "Service: $service\n";
        if (!empty($preferred_date)) {
            $mail->AltBody .= "Preferred Date: " . date('F j, Y', strtotime($preferred_date)) . "\n";
        }
        $mail->AltBody .= "\n--- Message ---\n$message\n";

        // Enviar
        $mail->send();
        echo json_encode(["success" => true, "message" => "✅ Your message has been sent successfully. We will contact you soon."]);

    } catch (Exception $e) {
        echo json_encode(["success" => false, "error" => "Error sending message: " . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Method not allowed"]);
}
?>