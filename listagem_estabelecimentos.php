<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Estabelecimentos</title>
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
    </style>
</head>
<body>
    <header>
        <h1>Listagem de Estabelecimentos</h1>
    </header>
    <div class="container">
        <?php
        require_once "conexao.php";

        $sql = "SELECT id, nome_fantasia, endereco, cidade, numero_lojas FROM estabelecimentos";
        $resultado = $mysqli->query($sql);

        if ($resultado) {
            if ($resultado->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Nome Fantasia</th><th>Endereço</th><th>Cidade</th><th>Número de Lojas</th></tr>";
                while ($row = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nome_fantasia"] . "</td>";
                    echo "<td>" . $row["endereco"] . "</td>";
                    echo "<td>" . $row["cidade"] . "</td>";
                    echo "<td>" . $row["numero_lojas"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Nenhum estabelecimento cadastrado.</p>";
            }
            $resultado->close();
        } else {
            echo "Erro ao executar a consulta: " . $mysqli->error;
        }

        $mysqli->close();
        ?>

        <div class="form-group">
            <a href="menu.php" class="btn-voltar">Voltar ao Menu</a>
        </div>

        <div class="form-group">
            <a href="cadastro_estabelecimento.php" class="btn-cadastro">Cadastrar Novo Estabelecimento</a>
        </div>
    </div>
</body>
</html>
