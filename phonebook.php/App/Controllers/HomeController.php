<?php

namespace App\Controllers;

use App\Models\Contact;

class HomeController
{
    private $contactModel;

    public function __construct()
    {
        $this->contactModel = new Contact;
    }

    public function index(): void
    {
        $where = [];

        
        if (isset($_GET['s'])) {
            $search_key = $_GET['s'];
            $where['AND'] = [
                'OR' => [
                    "first_name[~]" => $search_key,
                    "last_name[~]" => $search_key,
                    "email[~]" => $search_key,
                    "number[~]" => $search_key,
                ]
            ];
        }

        $contacts = $this->contactModel->get('*', $where);
        $total_number_of_data = $this->contactModel->record_Count([]);
        $number_of_pages = $this->contactModel->getPageSize();
        view('home.index', ['contacts' => $contacts, 'N' => $total_number_of_data, 'M' => $number_of_pages]);
    }
}

// $faker = \Faker\Factory::create();
// for ($i = 0; $i < 1000; $i++) {
//     $this->contactModel->create([
//         'first_name' => $faker->name(),
//         'last_name' => $faker->name(),
//         'email' => $faker->email(),
//         'number' => $faker->phoneNumber()
//     ]);
// }