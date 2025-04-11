<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <a href="/tasks/create" class="btn btn-primary">+ Nova Tarefa</a>
        <a href="/" class="btn btn-primary">Voltar</a>
    </div>

    <div id="alert-container"></div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Status</th>
                <th>Criada em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="task-table-body">
            <tr><td colspan="5" class="text-center">Carregando tarefas...</td></tr>
        </tbody>
    </table>
</div>

<script>
    const tbody = document.getElementById('task-table-body');
    const alertContainer = document.getElementById('alert-container');

    fetch('/api/tasks')
        .then(res => res.json())
        .then(tasks => {
            if (tasks.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center">Nenhuma tarefa cadastrada!</td></tr>';
                return;
            }

            tbody.innerHTML = '';

            tasks.forEach(task => {
                const tr = document.createElement('tr');

                tr.innerHTML = `
                    <td>${task.id}</td>
                    <td>
                        <a href="/tasks/show/${task.id}" class="text-secondary fw-semibold text-decoration-underline-hover">
                            ${task.title}
                        </a>
                    </td>
                    <td>${formatStatus(task.status)}</td>
                    <td>${task.created_at ?? '-'}</td>
                    <td>
                        <a href="/tasks/edit/${task.id}" class="btn btn-sm btn-warning">Editar</a>
                        <button class="btn btn-sm btn-danger ms-2" onclick="deleteTask(${task.id})">Excluir</button>
                    </td>
                `;

                tbody.appendChild(tr);
            });
        })
        .catch(error => {
            console.error(error);
            tbody.innerHTML = `<tr><td colspan="5" class="text-danger">Erro ao carregar tarefas.</td></tr>`;
        });

    function formatStatus(status) {
        const badgeMap = {
            'pendente': 'badge bg-warning text-dark',
            'em andamento': 'badge bg-primary',
            'concluída': 'badge bg-success'
        };
        const badgeClass = badgeMap[status] ?? 'badge bg-secondary';
        return `<span class="${badgeClass}">${status}</span>`;
    }

    function deleteTask(id) {
        if (!confirm('Tem certeza que deseja excluir essa tarefa?')) return;

        fetch(`/api/tasks/${id}`, {
            method: 'DELETE'
        })
        .then(res => {
            if (!res.ok) throw new Error('Erro ao excluir');
            return res.json();
        })
        .then(() => {
            showAlert('Tarefa excluída com sucesso.', 'success');
            // recarrega a lista
            setTimeout(() => location.reload(), 1000);
        })
        .catch(() => {
            showAlert('Erro ao excluir tarefa.', 'danger');
        });
    }

    function showAlert(message, type) {
        alertContainer.innerHTML = `
            <div class="alert alert-${type}">${message}</div>
        `;
        setTimeout(() => alertContainer.innerHTML = '', 3000);
    }
</script>

</body>
</html>
