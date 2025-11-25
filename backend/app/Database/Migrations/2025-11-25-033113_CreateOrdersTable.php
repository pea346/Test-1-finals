<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'order_number' => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
            'user_id' => ['type' => 'INT', 'unsigned' => true],
            'item_id' => ['type' => 'INT', 'unsigned' => true],
            'quantity' => ['type' => 'INT', 'default' => 1],
            'size' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'toppings' => ['type' => 'TEXT', 'null' => true],
            'total_price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'delivery_type' => ['type' => 'ENUM', 'constraint' => ['pickup', 'delivery'], 'default' => 'pickup'],
            'first_name' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'last_name' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['Pending', 'Approved', 'Rejected'], 'default' => 'Pending'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('item_id', 'items', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
