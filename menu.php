<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
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
    <div class="menu-container">
        <h2>Menu</h2>
        <ul>
            <li><a href="cadastro_produtos.php">Cadastrar Produto</a></li>
            <li><a href="cadastro_estabelecimento.php">Cadastrar Estabelecimento</a></li>
            <li><a href="cadastro_preco.php">Cadastrar Preço</a></li>
            <li><a href="listagem_produtos.php">Listagem de Produtos</a></li>
            <li><a href="listagem_estabelecimentos.php">Listagem de Estabelecimentos</a></li>
            <li><a href="listagem_precos.php">Listagem de Preços</a></li>
            <li><a href="listagem_produtosloja.php">Produtos Baratos por Loja</a></li>
        </ul>
    </div>
</body>
</html>
