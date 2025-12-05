<?php
require '../vendor/autoload.php'; 
include("conexao.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$smtp_host = "smtp.gmail.com"; 
$smtp_port = 587;
$smtp_username = "megapierre7@gmail.com"; 
$smtp_password = "ilphnrzfxjmpvbxm";
$sender_email = $smtp_username; 

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = trim($_POST['email']);
    
    $sql_user = "SELECT id FROM cadastros WHERE email = ?";
    if ($stmt_user = $conn->prepare($sql_user)) {
        $stmt_user->bind_param("s", $email);
        $stmt_user->execute();
        $resultado = $stmt_user->get_result();
        $usuario = $resultado->fetch_assoc();
        $stmt_user->close();

        if ($usuario) {
            $user_id = $usuario['id'];
            
            $token = bin2hex(random_bytes(32)); 
            $expires_at = date('Y-m-d H:i:s', time() + (30 * 60)); 

            $conn->query("DELETE FROM password_resets WHERE user_id = {$user_id}");

            $sql_insert = "INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)";
            if ($stmt_insert = $conn->prepare($sql_insert)) {
                $stmt_insert->bind_param("iss", $user_id, $token, $expires_at);
                $stmt_insert->execute();
                $stmt_insert->close();
            }

            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host       = $smtp_host;
                $mail->SMTPAuth   = true;
                $mail->Username   = $smtp_username;
                $mail->Password   = $smtp_password;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
                $mail->Port       = $smtp_port;
                $mail->CharSet = 'UTF-8'; 

                $mail->setFrom($sender_email, 'Recuperação de Senha');
                $mail->addAddress($email);

                $reset_link = "http://localhost/Projeto/PHP/redefinir_senha.php?token=" . $token; 
                
                $mail->isHTML(true);
                $mail->Subject = 'Link de Recuperacao de Senha';
                $mail->Body    = "Clique neste link para redefinir sua senha: <a href='{$reset_link}'>{$reset_link}</a>. O link expira em 30 minutos.";
                $mail->AltBody = "Use este link: {$reset_link}"; 

                $mail->send();
                $mensagem = "<div class='bloco-mensagem sucesso'>Um link de recuperação foi enviado para o seu e-mail.</div>";
            
            } catch (Exception $e) {
                $mensagem = "<div class='bloco-mensagem erro'>Erro ao enviar e-mail. Mailer Error: {$mail->ErrorInfo}</div>";
            }

        } else {
            $mensagem = "<div class='bloco-mensagem sucesso'>Se o e-mail estiver registrado, você receberá um link de recuperação.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="css/config.css">
    <link rel="stylesheet" href="css/cabecalho.css">
    <style>
        .bloco-principal {
            width: 90%;
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            box-shadow: 2px 2px 5px rgb(158, 158, 158), -2px -2px 5px rgb(158, 158, 158);
            border: 1px solid #9c9c9c;
            border-radius: 10px;
            text-align: center;
        }

        .bloco-principal input[type="email"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }


        .bloco-principal input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="bloco-principal">
        <h1>Esqueci a Senha</h1>
        
        <?php echo $mensagem;?>

        <form action="esqueci_senha.php" method="POST">
            <p>Digite seu e-mail de cadastro para receber o link de recuperação:</p>
            <input type="email" name="email" required placeholder="Seu e-mail de cadastro">
            <input type="submit" value="Enviar Link de Recuperação">
        </form>
        <p class="estilo"><a href="../PHP/login.php">Voltar para o Login</a></p>
    </div>
</body>
</html>