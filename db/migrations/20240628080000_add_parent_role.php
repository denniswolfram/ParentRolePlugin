<?php
class AddParentRole extends Migration {
    public function up() {
        DBManager::get()->exec("
            INSERT INTO roles (rolename, system, copyable, writable, description)
            VALUES ('parent', 0, 0, 0, 'Elternrolle mit Leserechten')
        ");
    }
}