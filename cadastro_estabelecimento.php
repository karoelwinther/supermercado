<?php
// Inclui o arquivo de conexão com o banco de dados
require_once "conexao.php";

// Define variáveis e inicializa com valores vazios
$nome_fantasia = $endereco = $cidade = $num_lojas = "";
$nome_fantasia_err = $endereco_err = $cidade_err = $num_lojas_err = "";

// Processa os dados do formulário quando o formulário é submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação do nome fantasia
    if (empty(trim($_POST["nome_fantasia"]))) {
        $nome_fantasia_err = "Por favor, insira o nome fantasia do estabelecimento.";
    } else {
        $nome_fantasia = trim($_POST["nome_fantasia"]);
    }

    // Validação do endereço
    if (empty(trim($_POST["endereco"]))) {
        $endereco_err = "Por favor, insira o endereço do estabelecimento.";
    } else {
        $endereco = trim($_POST["endereco"]);
    }

    // Validação da cidade
    if (empty(trim($_POST["cidade"]))) {
        $cidade_err = "Por favor, insira a cidade do estabelecimento.";
    } else {
        $cidade = trim($_POST["cidade"]);
    }

    // Validação do número de lojas
    if (empty(trim($_POST["num_lojas"]))) {
        $num_lojas_err = "Por favor, insira o número de lojas do estabelecimento.";
    } else {
        $num_lojas = trim($_POST["num_lojas"]);
    }

    // Verifica se não há erros de entrada antes de inserir no banco de dados
    if (empty($nome_fantasia_err) && empty($endereco_err) && empty($cidade_err) && empty($num_lojas_err)) {
        // Prepara a instrução INSERT
        $sql = "INSERT INTO estabelecimentos (nome_fantasia, endereco, cidade, numero_lojas) VALUES (?, ?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Vincula as variáveis à instrução preparada como parâmetros
            $stmt->bind_param("sssi", $param_nome_fantasia, $param_endereco, $param_cidade, $param_num_lojas);

            // Define os parâmetros
            $param_nome_fantasia = $nome_fantasia;
            $param_endereco = $endereco;
            $param_cidade = $cidade;
            $param_num_lojas = $num_lojas;

            // Executa a instrução preparada
            if ($stmt->execute()) {
                // Redireciona para a página de listagem de estabelecimentos
                header("location: listagem_estabelecimentos.php");
                exit();
            } else {
                echo "Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fecha a instrução
            $stmt->close();
        }
    }

    // Fecha a conexão
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Estabelecimento</title>
    <link rel="stylesheet" href="formulario.css">
</head>
<body>
<div class="form-container">
    <h2>Cadastro de Estabelecimento</h2>
    <form action="#" method="post">
        <div class="form-group">
            <label for="nome_fantasia">Nome Fantasia:</label>
            <input type="text" id="nome_fantasia" name="nome_fantasia">
        </div>
        <div class="form-group">
            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco">
        </div>
        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade">
        </div>
        <div class="form-group">
            <label for="num_lojas">Número de Lojas:</label>
            <input type="number" id="num_lojas" name="num_lojas">
        </div>
        <div class="form-group">
            <button type="submit">Cadastrar Estabelecimento</button>
        </div>
    </form>
    <div class="form-group">
        <a href="menu.php" class="btn-voltar">Voltar ao Menu</a>
    </div>
</div>
</body>
</html>