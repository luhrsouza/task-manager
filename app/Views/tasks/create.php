<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <div class="container">
        <h1 class="mb-4">Nova Tarefa</h1>

        <div id="alert-container"></div>

        <form id="task-form">
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="pendente">Pendente</option>
                    <option value="em andamento">Em andamento</option>
                    <option value="concluída">Concluída</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="/" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script>
        const form = document.getElementById('task-form');
        const alertContainer = document.getElementById('alert-container');

        form.addEventListener('submit', function (e) {
            e.preventDefault(); // impede o envio tradicional

            const data = {
                title: form.title.value,
                description: form.description.value,
                status: form.status.value
            };

            fetch('/api/tasks', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
            .then(res => {
                if (!res.ok) throw new Error('Erro ao salvar');
                return res.json();
            })
            .then(() => {
                showAlert('Tarefa criada com sucesso!', 'success');
                form.reset();
                setTimeout(() => window.location.href = "/tasks", 1500);
            })
            .catch(() => {
                showAlert('Erro ao criar tarefa.', 'danger');
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
