<?php
namespace ParentRole;

class AdminController extends \StudipController
{
    public function index_action()
    {
        // Beispiel: Eltern-Kind-Beziehungen laden
        $this->relations = $this->loadParentChildRelations();

        // Kein Layout verwenden
        $this->set_layout(null);

        // Template rendern
        $this->render_template('parent_settings.php');
    }

    private function loadParentChildRelations()
    {
        return \DBManager::get()->fetchAll("
            SELECT parent_id, student_id, verified 
            FROM parent_student_relations
        ");
    }
}