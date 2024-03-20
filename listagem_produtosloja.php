<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["produto"])) {
        $mysqli = new mysqli("localhost", "root", "", "supermercado");

        if ($mysqli->connect_error) {
            die("Erro de conexão com o banco de dados: " . $mysqli->connect_error);
        }

        $id_produto = $_POST["produto"];

        $sql_preco_mais_barato = "SELECT e.nome_fantasia AS nome_estabelecimento, pr.preco
                                FROM precos pr
                                INNER JOIN estabelecimentos e ON pr.id_estabelecimento = e.id
                                WHERE pr.id_produto = $id_produto
                                ORDER BY pr.preco ASC
                                LIMIT 1";

        $result_preco_mais_barato = $mysqli->query($sql_preco_mais_barato);


        if ($result_preco_mais_barato->num_rows > 0) {

            $row_preco_mais_barato = $result_preco_mais_barato->fetch_assoc();
            echo "<h2>Produto mais barato:</h2>";
            echo "<p>Estabelecimento: {$row_preco_mais_barato['nome_estabelecimento']}</p>";
            echo "<p>Preço: R$ {$row_preco_mais_barato['preco']}</p>";
        } else {
            echo "<p>Não há informações de preço cadastradas para este produto.</p>";
        }

        $sql_preco_todos_estabelecimentos = "SELECT e.nome_fantasia AS nome_estabelecimento, pr.preco
                                            FROM precos pr
                                            INNER JOIN estabelecimentos e ON pr.id_estabelecimento = e.id
                                            WHERE pr.id_produto = $id_produto
                                            ORDER BY pr.preco ASC";

        $result_preco_todos_estabelecimentos = $mysqli->query($sql_preco_todos_estabelecimentos);

        if ($result_preco_todos_estabelecimentos->num_rows > 0) {
    
            echo "<h2>Preços do produto em outros estabelecimentos:</h2>";
            echo "<ul>";
            while ($row_preco_todos_estabelecimentos = $result_preco_todos_estabelecimentos->fetch_assoc()) {
                echo "<li>Estabelecimento: {$row_preco_todos_estabelecimentos['nome_estabelecimento']} - Preço: R$ {$row_preco_todos_estabelecimentos['preco']}</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Não há informações de preço cadastradas para este produto em outros estabelecimentos.</p>";
        }

        $mysqli->close();
    } else {
        echo "<p>Por favor, selecione um produto.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local onde o Produto é Mais Barato</title>
    <link rel="stylesheet" href="formulario.css">
</head>
<body>
    <h1>Local onde o Produto é Mais Barato</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="produto">Escolha um produto:</label>
        <select name="produto" id="produto">
            <?php

            require_once "conexao.php";

            $sql_produtos = "SELECT id, nome FROM produtos";
            $resultado_produtos = $mysqli->query($sql_produtos);

            if ($resultado_produtos) {
    
                if ($resultado_produtos->num_rows > 0) {
    
                    while ($row = $resultado_produtos->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                    }
                } else {
        
                    echo "<option value='' disabled>Nenhum produto cadastrado</option>";
                }
            } else {

                echo "<option value='' disabled>Erro ao carregar produtos</option>";
            }
            $mysqli->close();
            ?>
        </select>
        <input type="submit" value="Buscar">
    </form>
    <div class="form-group">
        <a href="menu.php" class="btn-voltar">Voltar ao Menu</a>
    </div>
</body>
</html>
