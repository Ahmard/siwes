<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PeopleTableSeeder extends Seeder
{
    private array $defaultPeople = [
        [
            'first_name' => 'Ahmad',
            'other_names' => 'Mustapha',
            'email' => 'ahmard@siwes.test',
            'type' => 'student',
            'reg_number' => 'CST/16/COM/00538',
            'password' => 1234
        ],
        [
            'first_name' => 'Khalid',
            'other_names' => 'Haruna',
            'email' => 'kharuna@siwes.test',
            'type' => 'lecturer',
            'password' => 1234
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->defaultPeople as $person){
            $person['password'] = Hash::make($person['password']);
            Person::query()->create($person);
        }
    }
}
