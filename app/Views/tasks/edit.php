<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <div class="container">
        <h1 class="mb-4">Editar Tarefa</h1>

        <form action="/tasks/update/<?= $task['id']?>" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= esc($task['title']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control" id="description" name="description" rows="4"><?= esc($task['description']) ?></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Descrição</label>
                <select class="form-select" id="status" name="status">
                    <option value="pendente" <?= $task['status'] === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                    <option value="em andamento" <?= $task['status'] === 'em andamento' ? 'selected' : '' ?>>Em andamento</option>
                    <option value="concluída" <?= $task['status'] === 'concluída' ? 'selected' : '' ?>>Concluída</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="/tasks" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>