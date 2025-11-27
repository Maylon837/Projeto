<?php
session_start();
include("conexao.php");

if (!isset($_SESSION['user_id'])) {
    header("location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$mensagem_status = "";

try {
    $sql_busca = "SELECT nome, sobrenome, email FROM cadastros WHERE id = ?";

    if ($stmt_busca = $conn->prepare($sql_busca)) {
        $stmt_busca->bind_param("i", $userId);
        $stmt_busca->execute();
        $resultado = $stmt_busca->get_result();
        $usuario_atual = $resultado->fetch_assoc();
        $stmt_busca->close();
    } else {
        throw new Exception("Erro de preparação SQL na busca: " . $conn->error);
    }
} catch (Exception $e) {
    $mensagem_status = "<div class='bloco-mensagem erro'>Erro ao buscar dados: " . $e->getMessage() . "</div>";
    $usuario_atual = ['nome' => '', 'sobrenome' => '', 'email' => ''];
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar_nome_sobrenome'])) {
    $novo_nome = trim($_POST['nome']);
    $novo_sobrenome = trim($_POST['sobrenome']);

    if (empty($novo_nome) || empty($novo_sobrenome)) {
        $mensagem_status = "<div class='bloco-mensagem erro'>Nome e Sobrenome não podem estar vazios.</div>";
    } else {
        $sql_update_dados = "UPDATE cadastros SET nome = ?, sobrenome = ? WHERE id = ?";

        if ($stmt_update = $conn->prepare($sql_update_dados)) {
            $stmt_update->bind_param("ssi", $novo_nome, $novo_sobrenome, $userId);

            if ($stmt_update->execute()) {
                $mensagem_status = "<div class='bloco-mensagem sucesso'>Nome e Sobrenome atualizados com sucesso!</div>";
                $usuario_atual['nome'] = $novo_nome;
                $usuario_atual['sobrenome'] = $novo_sobrenome;
            } else {
                $mensagem_status = "<div class='bloco-mensagem erro'>Erro ao atualizar dados: " . $stmt_update->error . "</div>";
            }
            $stmt_update->close();
        } else {
            $mensagem_status = "<div class='bloco-mensagem erro'>Erro de preparação SQL (Nome/Sobrenome): " . $conn->error . "</div>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar_email'])) {
    $novo_email = trim($_POST['email']);

    if (empty($novo_email) || !filter_var($novo_email, FILTER_VALIDATE_EMAIL)) {
        $mensagem_status = "<div class='bloco-mensagem erro'>Formato de email inválido ou vazio.</div>";
    } else {
        $sql_check = "SELECT id FROM cadastros WHERE email = ? AND id != ?";
        if ($stmt_check = $conn->prepare($sql_check)) {
            $stmt_check->bind_param("si", $novo_email, $userId);
            $stmt_check->execute();
            $stmt_check->store_result();

            if ($stmt_check->num_rows > 0) {
                $mensagem_status = "<div class='bloco-mensagem erro'>Este email já está sendo usado por outro usuário.</div>";
            } else {
                $sql_update_email = "UPDATE cadastros SET email = ? WHERE id = ?";

                if ($stmt_update_email = $conn->prepare($sql_update_email)) {
                    $stmt_update_email->bind_param("si", $novo_email, $userId);

                    if ($stmt_update_email->execute()) {
                        $mensagem_status = "<div class='bloco-mensagem sucesso'>Email atualizado com sucesso!</div>";
                        $usuario_atual['email'] = $novo_email;
                        $_SESSION['email'] = $novo_email;
                    } else {
                        $mensagem_status = "<div class='bloco-mensagem erro'>Erro ao atualizar email: " . $stmt_update_email->error . "</div>";
                    }
                    $stmt_update_email->close();
                }
            }
            $stmt_check->close();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar_senha'])) {
    $nova_senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    if (empty($nova_senha) || empty($confirmar_senha)) {
        $mensagem_status = "<div class='bloco-mensagem erro'>Por favor, preencha a nova senha e a confirmação.</div>";
    } elseif ($nova_senha !== $confirmar_senha) {
        $mensagem_status = "<div class='bloco-mensagem erro'>A nova senha e a confirmação não coincidem.</div>";
    } elseif (strlen($nova_senha) < 6) {
        $mensagem_status = "<div class='bloco-mensagem erro'>A senha deve ter pelo menos 6 caracteres.</div>";
    } else {
        $hash_senha = password_hash($nova_senha, PASSWORD_DEFAULT);
        $sql_update_senha = "UPDATE cadastros SET senha = ? WHERE id = ?";

        if ($stmt_update_senha = $conn->prepare($sql_update_senha)) {
            $stmt_update_senha->bind_param("si", $hash_senha, $userId);

            if ($stmt_update_senha->execute()) {
                $mensagem_status = "<div class='bloco-mensagem sucesso'>Senha atualizada com sucesso!</div>";
            } else {
                $mensagem_status = "<div class='bloco-mensagem erro'>Erro ao atualizar senha: " . $stmt_update_senha->error . "</div>";
            }
            $stmt_update_senha->close();
        } else {
            $mensagem_status = "<div class='bloco-mensagem erro'>Erro de preparação SQL (Senha): " . $conn->error . "</div>";
        }
    }
}

if (isset($conn)) {
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Configurações da Conta</title>
    <link rel="stylesheet" href="../css/config.css">
    <link rel="stylesheet" href="../css/cabecalho.css">


    <script>
        (function(w, d, e, u, f, l, n) {
            w[f] = w[f] || function() {
                    (w[f].q = w[f].q || [])
                    .push(arguments);
                }, l = d.createElement(e), l.async = 1, l.src = u,
                n = d.getElementsByTagName(e)[0], n.parentNode.insertBefore(l, n);
        })
        (window, document, 'script', 'https://assets.mailerlite.com/js/universal.js', 'ml');
        ml('account', '1936898');
    </script>


</head>

<body>

    <header class="logo">
        <a href="../PHP/index.php">
            <img src="../IMAGENS/logo-branca.png" alt="Logo CM ESG" href="#index.php">
        </a>
        <nav>
            <a href="../PHP/index.php" class="home">Home</a>
            <a href="../PHP/faleconosco.php" class="contato">Fale Conosco</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="menu-perfil">
                </div>
                </div>
            <?php else: ?>
                <a href="cadastro.php" class="btn-cadastro">Cadastro</a>
                <a href="login.php" class="btn-login">Login</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>


        <div id="bloco-configuracoes">


            <h2>⚙️Configurações da Conta</h2>

            <?php echo $mensagem_status; ?>

            <div class="newsletter" style="height: 20em;">
                <div class="ml-embedded" data-form="ekd6Mo"></div>

            </div>

            </form>
            <form action="configuracao.php" method="POST" id="form-nome">
                <input type="hidden" name="atualizar_nome_sobrenome" value="1">
                <h3><img src="../IMAGENS/icone-editar.png" alt=""> Atualizar dados</h3>

                <label for="nome"><strong>Novo Nome:</strong></label>
                <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($usuario_atual['nome']); ?>" required placeholder="Digite o novo nome">

                <label for="sobrenome"><strong>Novo Sobrenome:</strong></label>
                <input type="text" name="sobrenome" id="sobrenome" value="<?php echo htmlspecialchars($usuario_atual['sobrenome']); ?>" required placeholder="Digite o novo sobrenome">

                <input type="submit" value="Atualizar Dados" class="input-nome">
            </form>

            <form action="configuracao.php" method="POST" id="form-nome">
                <input type="hidden" name="atualizar_email" value="1">
                <h3><img src="../IMAGENS/icone-editar.png" alt=""> Atualizar Email</h3>
                <br>
                <label for="email_novo"><strong>Novo Email:</strong></label>
                <input type="email" name="email" id="nome"
                value="<?php echo htmlspecialchars($usuario_atual['email']); ?>"
                required
                placeholder="Digite o novo email">
                    <br>

                <input type="submit" value="Atualizar Email" class="input-senha">
            </form>

            <form action="configuracao.php" method="POST" id="form-senha">
                <input type="hidden" name="atualizar_senha" value="1">
                <h3><img src="../IMAGENS/icone-editar.png" alt=""> Atualizar Senha</h3>

                <label for="senha"><strong>Nova Senha:</strong></label>
                <input type="password" name="senha" id="senha" required placeholder="Digite a nova senha">

                <label for="confirmar_senha"><strong>Confirmar Senha:</strong></label>
                <input type="password" name="confirmar_senha" id="senha" required placeholder="Confirme a nova senha">

                <input type="submit" value="Atualizar Senha" class="input-senha">
            </form>
            <br>

            <div>
                <a href="logout.php" class="btn-sairConta" style="text-decoration: none; padding: 8px 20px; border-radius: 5px; font-size: 19px; background-color: #007BFF; color: white; border: 2px solid #007BFF;">Sair</a>

                <a href="excluir_conta.php" class="btn-excluirConta" style="text-decoration: none; margin-left: 10px; padding: 8px 20px; border-radius: 5px; font-size: 19px; background-color: #db4857; color: white; border: 2px solid #db4857;"
                    onclick="return confirm('Tem certeza que deseja excluir sua conta? Esta ação é irreversível!');">
                    Excluir Conta
                </a>
            </div>
        </div>

    </main>

    <footer>
        <div class="direitos"><strong>&copy; 2025 CM - Todos os direitos reservados</strong></div>
        <div class="btn-sobre-nos"><a href="sobre.php" class="btn-rodape">Sobre Nós</a></div>
    </footer>
    <script src="./JS/progressoscroll.js"></script>

</body>

</html>