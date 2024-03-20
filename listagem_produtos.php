<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Produtos</title>
    <link rel="stylesheet" href="formulario.css"> <!-- Inclui o arquivo de estilo CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .table-container {
            margin: 20px auto;
            width: 80%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .btn-voltar {
            display: block;
            width: 120px;
            margin: 20px auto;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-voltar:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Listagem de Produtos</h1>
    </header>
    <div class="table-container">
        <?php
        // Inclui o arquivo de conexão com o banco de dados
        require_once "conexao.php";

        // Define uma consulta SQL para obter todos os produtos
        $sql = "SELECT id, nome, marca, tamanho FROM produtos";
        $resultado = $mysqli->query($sql);

        // Verifica se há produtos cadastrados
        if ($resultado) {
            if ($resultado->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>ID</th><th>Nome</th><th>Marca</th><th>Tamanho/Quantidade</th></tr>";
                while ($row = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>" . $row["marca"] . "</td>";
                    echo "<td>" . $row["tamanho"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";

                echo "<br>";
                echo '<a href="menu.php" class="btn-voltar">Voltar ao Menu</a>';

            } else {
                echo "<p>Nenhum produto cadastrado.</p>";
            }
        } else {
            echo "Erro ao executar a consulta: " . $mysqli->error;
        }

        // Fecha a conexão
        $mysqli->close();
        ?>
    <a href="cadastro_produtos.php" class="btn-cadastro">Cadastrar Novo Produto</a>

    </div>
</body>
</html>
