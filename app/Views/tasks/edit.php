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

        <div id="alert-container"></div>

        <form id="edit-form">
            <input type="hidden" id="taskId" value="<?= esc($task['id']) ?>">

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= esc($task['title']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control" id="description" name="description" rows="4"><?= esc($task['description']) ?></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
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

    <script>
        const form = document.getElementById('edit-form');
        const alertContainer = document.getElementById('alert-container');

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const taskId = document.getElementById('taskId').value;

            const data = {
                title: form.title.value,
                description: form.description.value,
                status: form.status.value
            };

            fetch(`/api/tasks/${taskId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(res => {
                if (!res.ok) throw new Error('Erro ao atualizar');
                return res.json();
            })
            .then(() => {
                showAlert('Tarefa atualizada com sucesso!', 'success');
                setTimeout(() => window.location.href = "/tasks", 1500);
            })
            .catch(() => {
                showAlert('Erro ao atualizar tarefa.', 'danger');
            });
        });

        function showAlert(message, type) {
            alertContainer.innerHTML = `
                <div class="alert alert-${type}">${message}</div>
            `;
            setTimeout(() => alertContainer.innerHTML = '', 3000);
        }
    </script>
</body>
</html>
