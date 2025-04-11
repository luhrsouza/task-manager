<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\TaskModel;

class TaskApi extends ResourceController
{
    protected $modelName = TaskModel::class;
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $task = $this->model->find($id);
        return $task ? $this->respond($task) : $this->failNotFound("Tarefa $id não encontrada.");
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated($data);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (!$this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond(['message' => "Tarefa $id atualizada com sucesso."]);
    }

    public function delete($id = null)
    {
        if (!$this->model->delete($id)) {
            return $this->failNotFound("Tarefa $id não encontrada.");
        }

        return $this->respondDeleted(['message' => "Tarefa $id deletada com sucesso."]);
    }
}