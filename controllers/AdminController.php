<?php
class AdminController extends StudipController
{
    public function index_action()
    {
        // Beispiel: Eltern-Kind-Beziehungen laden (hier als Platzhalter)
        $this->relations = []; // Hier solltest du deine echten Daten laden

        // Kein Layout verwenden, damit nur das Template gerendert wird
        $this->set_layout(null);

        // Template aus dem templates-Ordner deines Plugins rendern
        $this->render_template('parent_settings.php');
    }
}