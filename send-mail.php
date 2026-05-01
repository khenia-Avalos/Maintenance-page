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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- Recibir y limpiar datos ---
    $name = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $phone = isset($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : '';
    $service = isset($_POST['service']) ? trim(strip_tags($_POST['service'])) : '';
    $message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';
    $request_type = isset($_POST['request_type']) ? trim(strip_tags($_POST['request_type'])) : '';

    // --- Validar campos obligatorios ---
    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(["success" => false, "error" => "Por favor completa los campos obligatorios."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "error" => "El correo electrónico no es válido."]);
        exit;
    }

    // --- Configurar SMTP de Hostinger ---
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP (autenticación con tu dominio)
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'contact@monteromaintenance.com';
        $mail->Password   = getenv('SMTP_PASSWORD');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // --- REMITENTE: Usa la dirección autenticada (la de tu dominio) ---
        $mail->setFrom('contact@monteromaintenance.com', 'Montero Maintenance');
        
        // --- DESTINATARIO: Tu Gmail personal ---
        $mail->addAddress('the.montero.groups@gmail.com', 'Jorge Montero');
        
        // --- REPLY-TO: La dirección del cliente (para responderle directamente) ---
        $mail->addReplyTo($email, $name);

        // --- Contenido del correo ---
        $mail->isHTML(false);
        $subject = "Nuevo mensaje de contacto - $service";
        $mail->Subject = $subject;
        $mail->Body    = "=== NUEVO MENSAJE DESDE MONTERO MAINTENANCE ===\n\n";
        $mail->Body   .= "Tipo: " . ($request_type == 'budget' ? 'Presupuesto' : 'Consulta') . "\n";
        $mail->Body   .= "Nombre: $name\n";
        $mail->Body   .= "Email: $email\n";
        $mail->Body   .= "Teléfono: $phone\n";
        $mail->Body   .= "Servicio: $service\n";
        $mail->Body   .= "\n--- Mensaje ---\n$message\n";

        // Enviar
        $mail->send();
        echo json_encode(["success" => true, "message" => "✅ Mensaje enviado correctamente. Te contactaremos pronto."]);

    } catch (Exception $e) {
        echo json_encode(["success" => false, "error" => "Error al enviar: " . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Método no permitido"]);
}
?>