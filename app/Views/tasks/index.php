<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Minhas Tarefas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body class="bg-light p-4">
        <a href="/tasks/create" class="btn btn-primary mb-3">+ Nova Tarefa</a>

        <?php if(empty($tasks)): ?>
            <div class="alert alert-warning">Nenhuma tarefa cadastrada!</div>
        <?php else: ?>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Status</th>
                        <th>Criada em</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?= esc($task['id']) ?></td>
                            <td><?= esc($task['title']) ?></td>
                            <td><?= esc($task['status']) ?></td>
                            <td><?= esc($task['created_at']) ?></td>
                            <td><a href="/tasks/edit/<?= $task['id'] ?>" class="btn btn-sm btn-warning">Editar</a></td>
                            <td><a href="/tasks/delete/<?= $task['id'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir essa tarefa?')">
                                Excluir
                            </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
            </div>
    </body>
</html>