<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pesquisa de Livros</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: monospace;
            background-image: url(https://i.pinimg.com/736x/53/03/7f/53037f24d6f59dd4e5f5167a4f954f60.jpg);
            background-size:cover ;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 720px;
            margin: 60px auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        h2 {
            font-size: 28px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 32px;
            color: #1f2937;
        }

        form {
            display: flex;
            gap: 0;
            margin-bottom: 30px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            overflow: hidden;
        }

        input[type="text"] {
            flex: 1;
            padding: 14px 16px;
            border: none;
            font-size: 16px;
            background-color: #f9fafb;
            color: #111827;
        }

        input[type="text"]:focus {
            outline: none;
            background-color: #ffffff;
        }

        button {
            padding: 0 24px;
            background-color: #fca4ce;
            color: white;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color:rgb(184, 184, 184);
        }

        ul {
            list-style: none;
            padding-left: 0;
            margin-top: 20px;
        }

        li {
            padding: 18px 20px;
            border-radius: 8px;
            margin-bottom: 12px;
            border-left: 4px solid #fca4ce;
            transition: background-color 0.3s;
        }

        li:hover {
            background-color: #f3f4f6;
        }

        strong {
            font-size: 17px;
            font-weight: 600;
            color: #1f2937;
        }

        .no-results {
            text-align: center;
            color: #6b7280;
            margin-top: 20px;
            font-size: 16px;
        }

        @media (max-width: 600px) {
            .container {
                margin: 30px 20px;
                padding: 25px;
            }

            input[type="text"] {
                font-size: 14px;
            }

            button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pesquisa de Livros</h2>

        <form method="GET" action="">
            <input type="text" name="busca" placeholder="Digite título, autor ou editora...">
            <button type="submit">Pesquisar</button>
        </form>

        <?php
        if (isset($_GET['busca']) && !empty(trim($_GET['busca']))) {
            $busca = $conn->real_escape_string($_GET['busca']);

             $sql = "SELECT * FROM livro
                    WHERE titulo LIKE '%$busca%' 
                       OR autor LIKE '%$busca%' 
                       OR editora LIKE '%$busca%'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<ul>";
                while ($livro = $result->fetch_assoc()) {
                    echo "<li><strong>{$livro['titulo']}</strong> — {$livro['autor']}";
                    if (!empty($livro['ano_publicacao'])) {
                        echo " ({$livro['ano_publicacao']})";
                    }
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p class='no-results'>Nenhum livro encontrado para \"<strong>$busca</strong>\".</p>";
            }
        }
        ?>
    </div>
</body>
</html>
