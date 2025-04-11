<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Minhas Tarefas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body class="bg-light p-4">
        <div class="d-flex justify-content-between mb-3">
        <a href="/tasks/create" class="btn btn-primary mb-3">+ Nova Tarefa</a>
        <a href="/" class="btn btn-primary mb-3">Voltar</a>
        </div>
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
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?= esc($task['id']) ?></td>
                            <td>
                                <a href="/tasks/show/<?= $task['id'] ?>" class="text-secondary fw-semibold text-decoration-underline-hover">
                                <?= esc($task['title']) ?>
                                </a>
                            </td>
                            <td>
                                <?php
                                    $status = $task['status'];
                                    $badgeClass = match ($status) {
                                    'pendente' => 'badge bg-warning text-dark',
                                    'em andamento' => 'badge bg-primary',
                                    'concluída' => 'badge bg-success',
                                    default => 'badge bg-secondary'
                                    };
                                    ?>
                                <span class="<?= $badgeClass ?>"><?= esc(ucfirst($status)) ?></span>
                            </td>
                            <td><?= esc($task['created_at']) ?></td>
                            <td>
                                <a href="/tasks/edit/<?= $task['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="/tasks/delete/<?= $task['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir essa tarefa?')">
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