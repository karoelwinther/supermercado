<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_correto = "admin"; 
    $senha_correta = "admin";

    $login = $_POST["login"];
    $senha = $_POST["senha"];

    if ($login == $login_correto && $senha == $senha_correta) {
        session_start();
        $_SESSION["loggedin"] = true;
        header("location: menu.php");
        exit;
    } else {
        $mensagem_erro = "Login ou senha incorretos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="formulario.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .menu-container {
            width: 300px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            display: block;
            padding: 10px 20px;
            background-color: #333; 
            color: #fff; 
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if(isset($mensagem_erro)) { ?>
            <div class="erro"><?php echo $mensagem_erro; ?></div>
        <?php } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" required>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
