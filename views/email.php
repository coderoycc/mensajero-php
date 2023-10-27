<?php
// ===============================
// ENVIO DE CORREO CON PHP MAILER
// ===============================
// Se importan la libreria de php mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
echo "vacio";
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// se crea una instancia, con TRUE se habilitan las excepciones
$mail = new PHPMailer(true);

try {
    // Configuraciones de servidor
    $mail->SMTPDebug = 0;                      // Con 0 se deshabilita la depuracion del envio
    $mail->isSMTP();                                            // Se enviara el correo utilizando SMTP
    
    $mail->Host       = 'webmail.factura.webinventario.com';                     // Se configura el servidor SMTP del cual se enviara el correo
    $mail->SMTPAuth   = true;                                   // Se habilita la autentificacion SMTP    
    $mail->Username   = 'web@factura.webinventario.com';                     //nombre de usuario SMTP (correo de donde se enviara)
    $mail->Password   = 'WEBinv20023---';                               //password SMTP (password de la cuenta)
    $mail->SMTPSecure = 'none';            //habilitar la encriptacion implicita TLS
    $mail->Port       = 2525;                                    // puerto TCP para la conexion (usar el 587 si tu tienes configurado `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`)

    $mail->setFrom('web@factura.webinventario.com', 'webii');    //correo de donde se envira el correo
    $mail->addAddress('rcchambi4@gmail.com', '');    //correo a donde se enviara el correo, el nombre es sopcional
                                                                    //tambien se puede enviar a otros correos a la vez
    //Attachments - para los archivos adjuntos
    $mail->addAttachment('maquina.pdf');
   
    //Para el contenido del correo
    $mail->isHTML(true);                                  //configurar el formato del correo para HTML
    $mail->Subject = 'Tercera de correo';
    $mail->Body    = 'Espero te encuentres bien!!';

    $mail->send();
    echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo "El mensaje no puede ser enviado. Error Mailer: {$mail->ErrorInfo}";
}

?>