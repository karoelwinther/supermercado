<?php
require_once "conexao.php";

$sql_produtos = "SELECT id, nome FROM produtos";
$resultado_produtos = $mysqli->query($sql_produtos);

$sql_estabelecimentos = "SELECT id, nome_fantasia FROM estabelecimentos";
$resultado_estabelecimentos = $mysqli->query($sql_estabelecimentos);

$id_produto = $id_estabelecimento = $preco = "";
$id_produto_err = $id_estabelecimento_err = $preco_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["id_produto"])) {
        $id_produto_err = "Por favor, selecione um produto.";
    } else {
        $id_produto = $_POST["id_produto"];
    }

    if (empty($_POST["id_estabelecimento"])) {
        $id_estabelecimento_err = "Por favor, selecione um estabelecimento.";
    } else {
        $id_estabelecimento = $_POST["id_estabelecimento"];
    }

    if (empty(trim($_POST["preco"]))) {
        $preco_err = "Por favor, insira o preço do produto no estabelecimento.";
    } else {
        $preco = trim($_POST["preco"]);
    }

    if (empty($id_produto_err) && empty($id_estabelecimento_err) && empty($preco_err)) {

        $sql_verificar_preco = "SELECT id FROM precos WHERE id_produto = ? AND id_estabelecimento = ?";
        if ($stmt = $mysqli->prepare($sql_verificar_preco)) {
            $stmt->bind_param("ii", $id_produto, $id_estabelecimento);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $preco_err = "Já existe um preço cadastrado para este produto neste estabelecimento.";
            }
            $stmt->close();
        }

        if (empty($preco_err)) {
            $sql_inserir_preco = "INSERT INTO precos (id_produto, id_estabelecimento, preco) VALUES (?, ?, ?)";
            if ($stmt = $mysqli->prepare($sql_inserir_preco)) {
                $stmt->bind_param("idd", $id_produto, $id_estabelecimento, $preco);
                if ($stmt->execute()) {
                    header("location: listagem_precos.php");
                    exit();
                } else {
                    echo "Algo deu errado. Por favor, tente novamente mais tarde.";
                }
                $stmt->close();
            }
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
    <title>Cadastro de Preço</title>
    <link rel="stylesheet" href="formulario.css">
</head>
<body>
    <div class="form-container">
        <h2>Cadastro de Preço</h2>
        <form action="#" method="post">
            <div class="form-group">
                <label for="id_produto">Produto:</label>
                <select id="id_produto" name="id_produto">
                    <option value="">Selecione um produto</option>
                    <?php
                    if ($resultado_produtos->num_rows > 0) {
                        while ($row = $resultado_produtos->fetch_assoc()) {
                            echo "<option value='" . $row["id"] . "'>" . $row["nome"] . "</option>";
                        }
                    }
                    ?>
                </select>
                <span class="invalid-feedback"><?php echo $id_produto_err; ?></span>
            </div>
            <div class="form-group">
                <label for="id_estabelecimento">Estabelecimento:</label>
                <select id="id_estabelecimento" name="id_estabelecimento">
                    <option value="">Selecione um estabelecimento</option>
                    <?php
                    if ($resultado_estabelecimentos->num_rows > 0) {
                        while ($row = $resultado_estabelecimentos->fetch_assoc()) {
                            echo "<option value='" . $row["id"] . "'>" . $row["nome_fantasia"] . "</option>";
                        }
                    }
                    ?>
                </select>
                <span class="invalid-feedback"><?php echo $id_estabelecimento_err; ?></span>
            </div>
            <div class="form-group">
                <label for="preco">Preço:</label>
                <input type="text" id="preco" name="preco">
                <span class="invalid-feedback"><?php echo $preco_err; ?></span>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar Preço</button>
            </div>
        </form>
        <div class="form-group">
            <a href="menu.php" class="btn-voltar">Voltar ao Menu</a>
        </div>
    </div>
</body>
</html>