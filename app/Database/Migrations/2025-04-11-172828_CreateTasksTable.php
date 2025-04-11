<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTasksTable extends Migration
{
    public function up()
    {
        $this->db->simpleQuery("CREATE TYPE task_status AS ENUM ('pendente', 'em andamento', 'concluída')");

        $this->forge->addField([
            'id'          => ['type' => 'SERIAL', 'null' => false],
            'title'       => ['type' => 'VARCHAR', 'constraint' => 255],
            'description' => ['type' => 'TEXT', 'null' => true],
            'status'      => ['type' => 'task_status', 'null' => false, 'default' => 'pendente'],
            'created_at'  => ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at'  => ['type' => 'TIMESTAMP', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tasks');
    }

    public function down()
    {
        $this->forge->dropTable('tasks');
        $this->db->simpleQuery("DROP TYPE IF EXISTS task_status");
    }
}
