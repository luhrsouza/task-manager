<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Detalhe da tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container">
        <h1 class="mb-4"><?= esc($task['title'])?></h1>

        <p><strong>Status: </strong> <?= esc($task['status']) ?></p>
        <p><strong>Descrição: </strong> <?= esc($task['description']) ?: '<em>Sem descrição</em>' ?></p>
        <p><strong>Criada em: </strong> <?= esc($task['created_at']) ?></p>

        <a href="/tasks" class="btn btn-secondary mt-3">← Voltar para Lista</a>
    </div>
</body>
</html>