<?php
class ParentRole extends StudIPPlugin implements SystemPlugin
{
    public function __construct()
    {
        parent::__construct();

        // Rolle "Eltern" bei Aktivierung anlegen
        if ($this->isActivated()) {
            $this->createParentRole();
        }

        // Admin-Oberfläche hinzufügen
        if ($GLOBALS['perm']->have_perm('root')) {
            $nav = new Navigation('Elternverwaltung', PluginEngine::getURL($this, [], 'admin'));
            Navigation::addItem('/admin/config/parentrole', $nav);
        }
    }

    private function createParentRole()
    {
        $role = new Role();
        $role->rolename = 'parent';
        $role->system = false;
        $role->copyable = false;
        $role->writable = false;
        $role->description = 'Eltern mit Leserechten für Kinderkurse';

        if (!$role->store()) {
            throw new Exception("Elternrolle konnte nicht angelegt werden");
        }
    }

    public function perform($unconsumed_path)
    {
        $dispatcher = new Trails_Dispatcher($this->getPluginPath());
        $dispatcher->dispatch($unconsumed_path);
    }

    // Rechteüberprüfung in Kursen
    public function courseAccessHook($course_id, $user_id)
    {
        $user = User::find($user_id);
        if ($user->perms === 'parent') {
            // Nur Leserechte
            return ['read' => true, 'write' => false];
        }
    }

    // Unsichtbarkeit in Teilnehmerlisten
    public function participantsListHook($course_id, $users)
    {
        return array_filter($users, function ($u) {
            return $u['perms'] !== 'parent';
        });
    }
}