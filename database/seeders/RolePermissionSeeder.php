<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = ['ClientG', 'Software','Plan','RegisterHardware','AccountRegister','Company','NaturalPerson','Branch','Machine','SoftwareMachine',
                'AccountWorker','Area','Hardware','ContactRef','Ticket'];
        $terms = ['view','create','edit','delete'];
        $extra = ['view alvert'];

        $permissions = $this->generatePermissions($models, $terms,$extra);
        //$permissions = [''];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $client = Role::firstOrCreate(['name' => 'client']);
        $inSituSupport = Role::firstOrCreate(['name' => 'InSituSupport']);
        $tiSupport = Role::firstOrCreate(['name' => 'TiSupport']);
        $admin = Role::firstOrCreate(['name' => 'admin']);

        // CLIENTE
        $modelsClient = ['ClientG', 'Software','Plan','RegisterHardware','AccountRegister','Company','NaturalPerson','Branch','Machine','SoftwareMachine',
                'AccountWorker','Area','Hardware','ContactRef','Ticket'];
        $termsClient = ['view'];
        $permissionsClient = $this->generatePermissions($modelsClient, $termsClient);
        //$permissionsClient = ['edit Software'];
        $client->syncPermissions($permissionsClient);

        // TECNICO
        $modelsInSituSupport = ['ClientG', 'Software','Plan','RegisterHardware','AccountRegister','Company','NaturalPerson','Branch','Machine','SoftwareMachine',
                'AccountWorker','Area','Hardware','ContactRef','Ticket'];
        $termsInSituSupport = ['view','create'];
        $permInSituSupportExtra = ['edit Software'];
        $permissionsInSituSupport = $this->generatePermissions($modelsInSituSupport, $termsInSituSupport, $permInSituSupportExtra);
        //unset($permissionsInSituSupport[array_search('delete ClientG', $permissionsInSituSupport)]);
        $inSituSupport->syncPermissions($permissionsInSituSupport);

        // SOPORTE TI
        $modelsTiSupport = ['ClientG', 'Software','Plan','RegisterHardware','AccountRegister','Company','NaturalPerson','Branch','Machine','SoftwareMachine', 'AccountWorker','Area','Hardware','ContactRef','Ticket'];
        $termsTiSupport = ['view', 'create', 'edit'];
        $permissionsTiSupport = $this->generatePermissions($modelsTiSupport, $termsTiSupport);

        $tiSupport->syncPermissions($permissionsTiSupport);


        $admin->syncPermissions($permissions);
    }

    private function generatePermissions(array $models, array $terms, array $extra = []): array
    {
        $permissions = [];
        foreach ($models as $model) {
            foreach ($terms as $term) {
                $permissions[] = "$term $model";
            }
        }

        if (!empty($extra)) {
            $permissionswithextra = array_merge($permissions, $extra);
            return $permissionswithextra;
        }

        return $permissions;
    }
}
