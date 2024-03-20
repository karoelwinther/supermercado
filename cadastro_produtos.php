<?php
require_once "conexao.php";
$nome = $marca = $numeral = $tipo_unidade = "";
$nome_err = $marca_err = $tamanho_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["nome"]))) {
        $nome_err = "Por favor, insira o nome do produto.";
    } else {
        $nome = trim($_POST["nome"]);
    }

    if (empty(trim($_POST["marca"]))) {
        $marca_err = "Por favor, insira a marca do produto.";
    } else {
        $marca = trim($_POST["marca"]);
    }

    if (empty(trim($_POST["numeral"])) || empty(trim($_POST["tipo_unidade"]))) {
        $tamanho_err = "Por favor, insira o tamanho/quantidade do produto.";
    } else {
        $numeral = trim($_POST["numeral"]);
        $tipo_unidade = trim($_POST["tipo_unidade"]);
    }

    if (empty($nome_err) && empty($marca_err) && empty($tamanho_err)) {
        $sql = "INSERT INTO produtos (nome, marca, tamanho) VALUES (?, ?, ?)";
        
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("sss", $param_nome, $param_marca, $param_tamanho);
            
            $param_nome = $nome;
            $param_marca = $marca;
            $param_tamanho = $numeral . " " . $tipo_unidade;

            if ($stmt->execute()) {
    
                header("location: listagem_produtos.php");
                exit();
            } else {
                echo "Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            $stmt->close();
        }
    }

    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="formulario.css">
</head>
<body>
    <div class="form-container">
        <h2>Cadastro de Produto</h2>
        <form action="#" method="post">
            <div class="form-group">
                <label for="nome">Nome do Produto:</label>
                <input type="text" id="nome" name="nome">
            </div>
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca">
            </div>
            <div class="form-group">
    <label for="tamanho">Tamanho/Quantidade:</label>
    <input type="text" id="numeral" name="numeral" placeholder="Digite o tamanho/quantidade">
    <select id="tipo_unidade" name="tipo_unidade">
        <option value="gramas">Gramas</option>
        <option value="quilos">Quilos</option>
        <option value="miligramas">Miligramas</option>
        <option value="unidades">Unidades</option>
        <option value="litros">Litros</option>
    </select>
</div>
            <div class="form-group">
                <button type="submit">Cadastrar Produto</button>
            </div>
        </form>
        <div class="form-group">
            <a href="menu.php" class="btn-voltar">Voltar ao Menu</a>
        </div>
    </div>
</body>
</html>
