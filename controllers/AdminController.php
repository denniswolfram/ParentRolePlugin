<?php
namespace ParentRole\Controllers;

use StudipController;

class AdminController extends StudipController
{
    public function index_action()
    {
        // Eltern-Kind-Beziehungen aus der Datenbank laden
        $this->relations = $this->loadParentChildRelations();

        // Kein Layout verwenden (Template wird direkt gerendert)
        $this->set_layout(null);

        // Template aus dem Plugin-Ordner anzeigen
        $this->render_template('parent_settings.php');
    }

    private function loadParentChildRelations()
    {
        // Beispiel: Daten aus der Tabelle parent_student_relations holen
        return \DBManager::get()->fetchAll("
            SELECT parent_id, student_id, verified 
            FROM parent_student_relations
        ");
    }
}