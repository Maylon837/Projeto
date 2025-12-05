<?php
require '../vendor/autoload.php';
include("conexao.php"); 

$mensagem = "";
$token_valido = false;
$user_id = null;
$token = null;

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    $sql_token = "SELECT user_id FROM password_resets WHERE token = ? AND expires_at > NOW()";
    if ($stmt_token = $conn->prepare($sql_token)) {
        $stmt_token->bind_param("s", $token);
        $stmt_token->execute();
        $resultado = $stmt_token->get_result();

        if ($resultado->num_rows === 1) {
            $registro = $resultado->fetch_assoc();
            $user_id = $registro['user_id'];
            $token_valido = true; 
        } else {
            $mensagem = "<div class='bloco-mensagem erro'>Token de recuperação inválido ou expirado. Tente novamente.</div>";
        }
        $stmt_token->close();
    } else {
        $mensagem = "<div class='bloco-mensagem erro'>Erro de preparação SQL na busca do token: " . $conn->error . "</div>";
    }

} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nova_senha'], $_POST['confirmar_senha'], $_POST['token_escondido'], $_POST['user_id_escondido'])) {
    
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $token_usado = $_POST['token_escondido'];
    $user_id = $_POST['user_id_escondido'];

    if (empty($nova_senha) || empty($confirmar_senha)) {
        $mensagem = "<div class='bloco-mensagem erro'>Por favor, preencha a nova senha e a confirmação.</div>";
    } elseif ($nova_senha !== $confirmar_senha) {
        $mensagem = "<div class='bloco-mensagem erro'>A nova senha e a confirmação não coincidem.</div>";
    } elseif (strlen($nova_senha) < 6) { 
        $mensagem = "<div class='bloco-mensagem erro'>A senha deve ter pelo menos 6 caracteres.</div>";
    } else {
        $hash_senha = password_hash($nova_senha, PASSWORD_DEFAULT);

        $sql_update_senha = "UPDATE cadastros SET senha = ? WHERE id = ?";
        if ($stmt_update = $conn->prepare($sql_update_senha)) {
            $stmt_update->bind_param("si", $hash_senha, $user_id);

            if ($stmt_update->execute()) {
                $sql_delete_token = "DELETE FROM password_resets WHERE token = ?";
                if ($stmt_delete = $conn->prepare($sql_delete_token)) {
                    $stmt_delete->bind_param("s", $token_usado);
                    $stmt_delete->execute();
                    $stmt_delete->close();
                }
                
                $mensagem = "<div class='bloco-mensagem sucesso'>Senha atualizada com sucesso! Você pode <a href='login.php'>fazer login</a> agora.</div>";
                $token_valido = false; 

            } else {
                $mensagem = "<div class='bloco-mensagem erro'>Erro ao atualizar senha: " . $stmt_update->error . "</div>";
            }
            $stmt_update->close();
        } else {
            $mensagem = "<div class='bloco-mensagem erro'>Erro de preparação SQL na atualização: " . $conn->error . "</div>";
        }
    }
} else {
    $mensagem = "<div class='bloco-mensagem erro'>Acesso negado. Por favor, use o link enviado para o seu e-mail.</div>";
}

if (isset($conn)) {
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha</title>
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
        .bloco-principal input[type="password"] {
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
        <h2>Redefinir Senha</h2>
        <?php echo $mensagem; ?>

        <?php if ($token_valido): // Mostra o formulário apenas se o token for válido ?>
            <form action="redefinir_senha.php" method="POST">
                <input type="hidden" name="token_escondido" value="<?php echo htmlspecialchars($token); ?>">
                <input type="hidden" name="user_id_escondido" value="<?php echo htmlspecialchars($user_id); ?>">

                <label for="nova_senha">Nova Senha:</label>
                <input type="password" name="nova_senha" id="nova_senha" required placeholder="Digite a nova senha">

                <label for="confirmar_senha">Confirmar Nova Senha:</label>
                <input type="password" name="confirmar_senha" id="confirmar_senha" required placeholder="Confirme a nova senha">

                <input type="submit" value="Atualizar Senha">
            </form>
        <?php endif; ?>
        
        <?php if (!$token_valido && strpos($mensagem, 'sucesso') === false):?>
            <p><a href="esqueci_senha.php">Tentar novamente?</a></p>
        <?php endif; ?>
    </div>
</body>
</html>