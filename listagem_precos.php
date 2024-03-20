<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Preços</title>
    <link rel="stylesheet" href="formulario.css">
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

        .btn-cadastro {
            display: block;
            width: 200px;
            margin: 20px auto;
            text-align: center;
            background-color: #008CBA;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-cadastro:hover {
            background-color: #006080;
        }
    </style>
</head>
<body>
    <header>
        <h1>Listagem de Preços</h1>
    </header>
    <div class="container">
        <?php
        require_once "conexao.php";

        $sql_precos = "SELECT p.id, pr.nome AS produto, pr.marca, e.nome_fantasia AS estabelecimento, p.preco
                       FROM precos p
                       INNER JOIN produtos pr ON p.id_produto = pr.id
                       INNER JOIN estabelecimentos e ON p.id_estabelecimento = e.id";
        
        $resultado_precos = $mysqli->query($sql_precos);

        if ($resultado_precos) {
            if ($resultado_precos->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>ID</th><th>Produto</th><th>Marca</th><th>Estabelecimento</th><th>Preço</th></tr>";
                while ($row = $resultado_precos->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["produto"] . "</td>";
                    echo "<td>" . $row["marca"] . "</td>";
                    echo "<td>" . $row["estabelecimento"] . "</td>";
                    echo "<td>R$ " . number_format($row["preco"], 2, ',', '.') . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Não há preços cadastrados.";
            }
        } else {
            echo "Erro ao executar a consulta: " . $mysqli->error;
        }

        $mysqli->close();
        ?>
        <div class="form-group">
            <a href="menu.php" class="btn-voltar">Voltar ao Menu</a>
        </div>
        <a href="cadastro_preco.php" class="btn-cadastro">Cadastrar Novo Preço</a>
    
    </div>
</body>
</html>
