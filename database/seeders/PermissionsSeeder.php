<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $createQuizzes = Permission::create(['name' => 'create quizzes']);
        $editQuizzes = Permission::create(['name' => 'edit quizzes']);
        $deleteQuizzes = Permission::create(['name' => 'delete quizzes']);
        $publishQuizzes = Permission::create(['name' => 'publish quizzes']);
        $unpublishQuizzes = Permission::create(['name' => 'unpublish quizzes']);
        $passQuizzes = Permission::create(['name' => 'pass quizzes']);

        // create roles and assign existing permissions
        $teacher = Role::create(['name' => 'teacher']);
        $teacher->givePermissionTo([
            $createQuizzes,
            $editQuizzes,
            $deleteQuizzes,
            $publishQuizzes,
            $unpublishQuizzes,
        ]);

        $student = Role::create(['name' => 'student']);
        $student->givePermissionTo($passQuizzes);

        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Teacher 01',
        ]);
        $user->assignRole($teacher);

        $user = \App\Models\User::factory()->create([
            'email' => 'teacher@example.com',
        ]);
        $user->assignRole($teacher);

        $user = \App\Models\User::factory()->create([
            'email' => 'student01@example.com',
        ]);
        $user->assignRole($student);

        $user = \App\Models\User::factory()->create([
            'email' => 'student02@example.com',
        ]);
        $user->assignRole($student);
    }
}
