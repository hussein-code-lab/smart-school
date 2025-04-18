<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء الأدوار
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $teacherRole = Role::firstOrCreate(['name' => 'teacher', 'guard_name' => 'web']);
        $studentRole = Role::firstOrCreate(['name' => 'student', 'guard_name' => 'web']);

        // إنشاء مستخدم أدمن
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('123456789')
            ]
        );

        $teacher = User::firstOrCreate(
            ['email' => 'teacher@teacher.com'],
            [
                'name' => 'Teacher',
                'password' => bcrypt('123456789')
            ]
        );

        $student = User::firstOrCreate(
            ['email' => 'student@student.com'],
            [
                'name' => 'Student',
                'password' => bcrypt('123456789')
            ]
        );

        // إسناد الدور
        if (!$admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }

        if (!$teacher->hasRole('teacher')) {
            $teacher->assignRole($teacherRole);
        }

        if (!$student->hasRole('student')) {
            $student->assignRole($studentRole);
        }
    }
}
