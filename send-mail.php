<?php
// Siempre responder en JSON
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- Recibir datos del formulario ---
    $name = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
    $email = isset($_POST['email']) ? trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) : '';
    $phone = isset($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : '';
    $service = isset($_POST['service']) ? trim(strip_tags($_POST['service'])) : '';
    $message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';
    $request_type = isset($_POST['request_type']) ? trim(strip_tags($_POST['request_type'])) : '';

    // --- Validar campos obligatorios ---
    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(["success" => false, "error" => "Por favor completa todos los campos obligatorios."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "error" => "El correo electrónico no es válido."]);
        exit;
    }

    // --- Configurar el correo ---
    $to = "kheniavalos@gmail.com";  // 👈 PON AQUÍ TU CORREO PERSONAL
    
    $subject = "Nuevo mensaje de contacto - $service";
    
    $body = "=== NUEVO MENSAJE DESDE MONTERO MAINTENANCE ===\n\n";
    $body .= "Tipo: " . ($request_type == 'budget' ? 'Presupuesto' : 'Consulta') . "\n";
    $body .= "Nombre: $name\n";
    $body .= "Email: $email\n";
    $body .= "Teléfono: $phone\n";
    $body .= "Servicio: $service\n";
    $body .= "\n--- Mensaje ---\n";
    $body .= "$message\n";
    
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // --- Enviar el correo ---
    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(["success" => true, "message" => "✅ Mensaje enviado correctamente. Te contactaremos pronto."]);
    } else {
        echo json_encode(["success" => false, "error" => "❌ No se pudo enviar el mensaje. Intenta de nuevo."]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Método no permitido."]);
}
?>