<!DOCTYPE html5>
<html lang="pt-BR">
    <head>

        <style>

            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                padding: 20px;
                background-color: #f4f4f4;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                background: white;
                margin-top: 20px;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }

            th {
                background-color: #0078D7;
                color: white;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            a {
                color: #0078D7;
                text-decoration: none;
            }

            a:hover {
                text-decoration: underline;
            }

        </style>
    </head>
    <body>

    <h2>Jogos Mais Vendidos da Steam</h2>
    <table>
        <tr>
            <th>#</th>
            <th>Título</th>
            <th>Preço</th>
            <th>Link</th>
            <th>Avaliação</th>
        </tr>
        <?php foreach ($jogos as $jogo): ?>
            <tr>
                <td><?php echo htmlspecialchars($jogo['posicao']); ?></td>
                <td><?php echo htmlspecialchars($jogo['titulo']); ?></td>
                <td><?php echo htmlspecialchars($jogo['preco']); ?></td>
                <td><a href="<?php echo htmlspecialchars($jogo['link']); ?>" target="_blank">Ver na Steam</a></td>
                <td><?php echo htmlspecialchars($jogo['avaliacao']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    </body>
</html>