<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class HrisSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        /*
        |--------------------------------------------------------------------------
        | Departments
        |--------------------------------------------------------------------------
        */
        DB::table('departments')->insert([
            [
                'name' => 'Human Resource',
                'description' => 'Human Resource Department',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Information Technology',
                'description' => 'IT Department',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Finance',
                'description' => 'Finance Department',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Marketing',
                'description' => 'Marketing Department',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */
        DB::table('roles')->insert([
            [
                'title' => 'HR Manager',
                'description' => 'Manage HR operations',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Backend Developer',
                'description' => 'Develop backend systems',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Frontend Developer',
                'description' => 'Develop frontend applications',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Finance Staff',
                'description' => 'Handle financial operations',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Employees
        |--------------------------------------------------------------------------
        */
        for ($i = 1; $i <= 10; $i++) {

            DB::table('employees')->insert([
                'fullname' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'birth_date' => Carbon::now()
                    ->subYears(rand(20, 35))
                    ->format('Y-m-d'),

                'hire_date' => Carbon::now()
                    ->subYears(rand(1, 5))
                    ->format('Y-m-d'),

                'department_id' => DB::table('departments')
                    ->inRandomOrder()
                    ->value('id'),

                'role_id' => DB::table('roles')
                    ->inRandomOrder()
                    ->value('id'),

                'status' => $faker->randomElement([
                    'active',
                    'inactive',
                    'resigned'
                ]),

                'salary' => rand(4000000, 12000000),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Tasks
        |--------------------------------------------------------------------------
        */
        for ($i = 1; $i <= 10; $i++) {

            DB::table('tasks')->insert([
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph,

                'assigned_to' => DB::table('employees')
                    ->inRandomOrder()
                    ->value('id'),

                'due_date' => Carbon::now()
                    ->addDays(rand(1, 30))
                    ->format('Y-m-d'),

                'status' => $faker->randomElement([
                    'Pending',
                    'In Progress',
                    'Done'
                ]),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Payroll
        |--------------------------------------------------------------------------
        */
        for ($i = 1; $i <= 10; $i++) {

            $salary = rand(4000000, 12000000);
            $bonus = rand(100000, 1000000);
            $deduction = rand(50000, 500000);

            DB::table('payroll')->insert([
                'employee_id' => DB::table('employees')
                    ->inRandomOrder()
                    ->value('id'),

                'salary' => $salary,
                'bonuses' => $bonus,
                'deductions' => $deduction,
                'net_salary' => ($salary + $bonus) - $deduction,

                'pay_date' => Carbon::now()
                    ->subDays(rand(1, 30))
                    ->format('Y-m-d'),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Leave Requests
        |--------------------------------------------------------------------------
        */
        for ($i = 1; $i <= 20; $i++) {

            $startDate = Carbon::now()
                ->addDays(rand(1, 10));

            DB::table('leave_requests')->insert([
                'employee_id' => DB::table('employees')
                    ->inRandomOrder()
                    ->value('id'),

                'leave_type' => $faker->randomElement([
                    'annual_leave',
                    'sick_leave',
                    'maternity_leave'
                ]),

                'start_date' => $startDate->format('Y-m-d'),

                'end_date' => $startDate
                    ->copy()
                    ->addDays(rand(1, 5))
                    ->format('Y-m-d'),

                'status' => $faker->randomElement([
                    'pending',
                    'approved',
                    'rejected'
                ]),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Presences
        |--------------------------------------------------------------------------
        */
        for ($i = 1; $i <= 100; $i++) {

            $date = Carbon::now()
                ->subDays(rand(1, 30));

            $checkIn = Carbon::parse(
                $date->format('Y-m-d') . ' 08:00:00'
            )->addMinutes(rand(0, 45));

            $checkOut = Carbon::parse(
                $date->format('Y-m-d') . ' 17:00:00'
            )->addMinutes(rand(0, 30));

            DB::table('presences')->insert([
                'employee_id' => DB::table('employees')
                    ->inRandomOrder()
                    ->value('id'),

                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'date' => $date->format('Y-m-d'),

                'status' => $faker->randomElement([
                    'present',
                    'late',
                    'absent',
                    'leave'
                ]),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
