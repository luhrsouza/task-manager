<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Detalhe da Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container">
        <div id="task-container">
            <p>Carregando tarefa...</p>
        </div>

        <a href="/tasks" class="btn btn-secondary mt-4">← Voltar para Lista</a>
    </div>

    <script>
        const container = document.getElementById('task-container');

        const urlParts = window.location.pathname.split('/');
        const taskId = urlParts[urlParts.length - 1];

        fetch(`/api/tasks/${taskId}`)
            .then(res => {
                if (!res.ok) throw new Error('Tarefa não encontrada');
                return res.json();
            })
            .then(task => {
                const badge = formatStatus(task.status);

                container.innerHTML = `
                    <h1 class="mb-4">${task.title}</h1>
                    <p><strong>Status:</strong> ${badge}</p>
                    <p><strong>Descrição:</strong> ${task.description || '<em>Sem descrição</em>'}</p>
                    <p><strong>Criada em:</strong> ${task.created_at || '-'}</p>
                    <p><strong>Editada em:</strong> ${task.updated_at || '-'}</p>
                `;
            })
            .catch(error => {
                container.innerHTML = `<div class="alert alert-danger">Erro: ${error.message}</div>`;
            });

        function formatStatus(status) {
            const badgeMap = {
                'pendente': 'warning text-dark',
                'em andamento': 'primary',
                'concluída': 'success'
            };
            const badgeClass = badgeMap[status] || 'secondary';
            return `<span class="badge bg-${badgeClass}">${status}</span>`;
        }
    </script>
</body>
</html>
