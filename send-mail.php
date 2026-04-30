<?php
// Configurar que la respuesta siempre sea JSON
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- Recoger y limpiar los datos ---
    $request_type = isset($_POST['request_type']) ? strip_tags(trim($_POST['request_type'])) : '';
    $name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $phone = isset($_POST['phone']) ? strip_tags(trim($_POST['phone'])) : '';
    $service = isset($_POST['service']) ? strip_tags(trim($_POST['service'])) : '';
    $preferred_date = isset($_POST['preferred_date']) ? strip_tags(trim($_POST['preferred_date'])) : '';
    $quote_code = isset($_POST['quote_code']) ? strip_tags(trim($_POST['quote_code'])) : '';
    $message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

    // --- Validar campos obligatorios ---
    if (empty($name) || empty($email) || empty($service) || empty($message)) {
        http_response_code(400);
        echo json_encode(["success" => false, "error" => "Por favor completa todos los campos obligatorios."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["success" => false, "error" => "El correo electrónico no es válido."]);
        exit;
    }

    // --- Configurar el destinatario (tu correo profesional) ---
    $to = "info@monteromaintenance.com";
    
    // --- Asunto según el tipo de solicitud ---
    switch ($request_type) {
        case 'budget':
            $subject = "Nueva solicitud de presupuesto - $service";
            break;
        case 'schedule':
            $subject = "Reserva de servicio - $service";
            break;
        case 'emergency':
            $subject = "EMERGENCIA - Contactar inmediatamente";
            break;
        default:
            $subject = "Nuevo mensaje de contacto - $service";
    }

    // --- Construir el cuerpo del mensaje ---
    $email_content = "";
    $email_content .= "=== NUEVO MENSAJE DESDE MONTERO MAINTENANCE ===\n\n";
    $email_content .= "Tipo de solicitud: " . ucfirst($request_type) . "\n";
    $email_content .= "Nombre: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Teléfono: $phone\n";
    $email_content .= "Servicio: $service\n";
    
    if (!empty($preferred_date)) {
        $email_content .= "Fecha preferida: $preferred_date\n";
    }
    if (!empty($quote_code)) {
        $email_content .= "Código de presupuesto: $quote_code\n";
    }
    
    $email_content .= "\n--- Mensaje ---\n";
    $email_content .= "$message\n";
    $email_content .= "\n--- Fin del mensaje ---\n";

    // --- Configurar cabeceras del email ---
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // --- Enviar el correo ---
    if (mail($to, $subject, $email_content, $headers)) {
        http_response_code(200);
        echo json_encode(["success" => true, "message" => "✅ Mensaje enviado correctamente. Te contactaremos pronto."]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "error" => "❌ No se pudo enviar el mensaje. Por favor intenta de nuevo más tarde."]);
    }
} else {
    http_response_code(403);
    echo json_encode(["success" => false, "error" => "Método no permitido."]);
}
?>