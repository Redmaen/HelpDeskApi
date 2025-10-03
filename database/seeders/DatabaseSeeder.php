<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(ClientGSeeder::class);
        $this->call(PlanSeeder::class);
        $this->call(SoftwareSeeder::class);
        $this->call(RegisterHardwareSeeder::class);
        $this->call(HardwareSeeder::class);
        $this->call(AccountRegisterSeeder::class);
        $this->call(MachineSeeder::class);
        $this->call(AccountWorkerSeeder::class);
        $this->call(SoftwareMachineSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(NaturalPersonSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(ContactRefSeeder::class);
        $this->call(TicketSeeder::class);
        $this->call(RolePermissionSeeder::class);
    }
}
