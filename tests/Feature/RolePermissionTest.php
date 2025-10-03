<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(\Database\Seeders\RolePermissionSeeder::class);
});

/**
 * Genera permisos dinámicamente para usar en los asserts
 */
function generatePermissions(array $models, array $terms, array $extra = []): array
{
    $permissions = [];
    foreach ($models as $model) {
        foreach ($terms as $term) {
            $permissions[] = "$term $model";
        }
    }
    return array_merge($permissions, $extra);
}

it('ejecuta correctamente la asignación de permisos esperados', function () {
    $models = [
        'ClientG','Software','Plan','RegisterHardware','AccountRegister',
        'Company','NaturalPerson','Branch','Machine','SoftwareMachine',
        'AccountWorker','Area','Hardware','ContactRef','Ticket'
    ];

    // CLIENT → solo "view"
    $clientPermissions = Role::where('name', 'client')->first()->permissions->pluck('name')->toArray();
    $expectedClient = generatePermissions($models, ['view']);
    expect($clientPermissions)->toEqualCanonicalizing($expectedClient);

    // IN SITU SUPPORT → "view", "create" + extra "edit Software"
    $inSituPermissions = Role::where('name', 'InSituSupport')->first()?->permissions->pluck('name')->toArray() ?? [];
    $expectedInSitu = generatePermissions($models, ['view', 'create'], ['edit Software']);
    expect($inSituPermissions)->toEqualCanonicalizing($expectedInSitu);

    // TI SUPPORT → "view", "create", "edit"
    $tiSupportPermissions = Role::where('name', 'TiSupport')->first()->permissions->pluck('name')->toArray();
    $expectedTiSupport = generatePermissions($models, ['view','create','edit']);
    expect($tiSupportPermissions)->toEqualCanonicalizing($expectedTiSupport);

    // ADMIN → todos los permisos (view, create, edit, delete)
    $adminPermissions = Role::where('name', 'admin')->first()->permissions->pluck('name')->toArray();
    $expectedAdmin = generatePermissions($models, ['view','create','edit','delete'], ['view alvert']);
    expect($adminPermissions)->toEqualCanonicalizing($expectedAdmin);
});
