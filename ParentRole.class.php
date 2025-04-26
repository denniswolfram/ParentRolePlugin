<?php
class ParentRole extends StudIPPlugin implements SystemPlugin, AdminNavigation
{
    public function __construct()
    {
        parent::__construct();

        // Elternrolle bei Aktivierung anlegen
        if ($this->isActivated()) {
            $this->createParentRole();
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
            'parentrole'
        );
        $dispatcher->dispatch($unconsumed_path);
    }

    // Diese Methode sorgt für den Link im Admin-Menü
    public function getAdminNavigation()
    {
        $nav = new Navigation(
            'Elternverwaltung',
            PluginEngine::getURL($this, [], 'admin')
        );
        return $nav;
    }
}