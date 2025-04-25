<?php
class ParentRole extends StudIPPlugin implements SystemPlugin
{
    public function __construct()
    {
        parent::__construct();
        
        // Elternrolle bei Aktivierung anlegen
        if ($this->isActivated()) {
            $this->createParentRole();
        }

        // Admin-Navigation hinzufügen
        if ($GLOBALS['perm']->have_perm('root')) {
            $nav = new Navigation(
                'Elternverwaltung',
                PluginEngine::getURL($this, [], 'admin/config/parentrole')
            );
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
        $dispatcher = new Trails_Dispatcher(
            $this->getPluginPath(),
            rtrim(PluginEngine::getLink($this, [], null), '/'),
            'parentrole' // WICHTIG: Eindeutiger Basis-Pfad
        );
        $dispatcher->dispatch($unconsumed_path);
    }

    // Rechteüberprüfung in Kursen
    public function courseAccessHook($course_id, $user_id)
    {
        $user = User::find($user_id);
        if ($user->perms === 'parent') {
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