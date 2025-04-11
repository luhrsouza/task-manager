<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\Controller;

class TaskController extends Controller
{

    public function index()
    {
        return view('index');
    }
    public function list()
{
    $model = new TaskModel();
    $data['tasks'] = $model->findAll();
    return view('tasks/list', $data);
}

    public function create()
    {
        return view('tasks/create');
    }

    public function store()
    {
        $model = new TaskModel();
        $model->save([
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to('/tasks');
    }

    public function edit($id)
    {
        $model = new TaskModel();
        $task = $model->find($id);

        if (!$task) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Tarefa com ID $id não encontrada.");
        }

        $data['task'] = $task;
        return view('tasks/edit', $data);
    }

    public function update($id)
    {
        $model = new TaskModel();

        $model->update($id, [
            'title' =>$this->request->getPost('title'),
            'description' =>$this->request->getPost('description'),
            'status' =>$this->request->getPost('status')
        ]);

        return redirect()->to('/tasks');
    }

    public function delete($id)
    {
        $model = new TaskModel();
        $model->delete($id);
        
        return redirect()->to('/tasks');
    }

    public function show($id)
    {
        $model = new TaskModel();
        $task = $model->find($id);

        if(!$task){
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Tarefa com o ID $id não encontrada.");
        }

        return view('tasks/show', ['task' => $task]);
    }
}