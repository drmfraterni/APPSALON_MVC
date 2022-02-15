<?php 

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email 
{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
        
    }

    public function enviarConfirmacion()
    {
        // crear una instancia de phpMailer
        $mail = new PHPMailer();
        /**
         * Para activar la cuenta de gmail hay que ir a Seguridad > Iniciar sesión en Google > Contraseñas de aplicaciones
         */
        // Configurar SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->Port       = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'micorreo@gmail.com.com';
        $mail->Password   = "iiiiicccccllllkkbbbkk";
        
        // Configurar el contenido de email

        $mail->setFrom('micorreo@gmail.com.com');
        $mail->addAddress('micorreo@gmail.com.com', 'David');
        //$mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Tienes un nuevo mensaje';

        // Habilitar HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UFT-8';

        // Definir el contenido
        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->email .  "</strong> Has Creado tu cuenta en App Salón, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://appsalon.test/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>";        
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;


        //Enviar el mail
        $mail->send();           

    }

    public function enviarInstrucciones() 
    {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->Port       = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'micorreo@gmail.com.com';
        $mail->Password   = "iiiiicccccllllkkbbbkk";
    
        $mail->setFrom('micorreo@gmail.com.com');
        $mail->addAddress('micorreo@gmail.com.com', 'David');
        $mail->Subject = 'Reestablece tu password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://appsalon.test/recuperar?token=" . $this->token . "'>Reestablecer Password</a>";        
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

            //Enviar el mail
        $mail->send();
    }
    
}