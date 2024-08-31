<?php

namespace App\Controllers;

use App\Models\Contact;

class ContactController 
{

    private $contactModel;

    public function __construct()
    {
        $this->contactModel = new Contact;

    }


    public function add() 
    {
        global $request;
        $invalidFname = '';
        $invalidLname = '';
        $invalidEmail = '';
        $invalidNumber = '';

        if (isset($_POST['submit'])) 
        {

            if (empty($_POST['fname'])) {
                $invalidFname = 'please enter your first name';
            }else{
                $first_name = filter_var($_POST['fname'] , FILTER_SANITIZE_SPECIAL_CHARS);
            }
            
            if (empty($_POST['lname'])) {
                $invalidLname = 'please enter your last name';
            }else{
                $last_name = filter_var($_POST['lname'] , FILTER_SANITIZE_SPECIAL_CHARS);
            }

            if (empty($_POST['email'])) {
                $invalidEmail = 'please enter your email';
                die('email field is empty');
            }elseif (filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)){
                $email = filter_var($_POST['email'] , FILTER_SANITIZE_EMAIL);
            }else{
                die('invalid email');
            }
            
            if (empty($_POST['number'])) {
                $invalidNumber = 'please enter your number';
            }else{
                if (preg_match("/^[0]{1}[9]{1}\d{9}$/", $_POST['number']) || preg_match("/^\+[9]{1}[8]{1}[9]{1}\d{9}$/", $_POST['number'])){
                    $number = filter_var($_POST['number'] , FILTER_SANITIZE_SPECIAL_CHARS);
                }else{
                    die('invalid phone number format<br>correct formats are as follows:<br>09*********<br>+989*********');
                }
                
            }




            # final check
            if (empty($invalidFname) && empty($invalidLname) && empty($invalidEmail) && empty($invalidNumber)) {
                $new_contact = [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'number' => $number
                ];

    
                $this->contactModel->create($new_contact);

                $data = [
                    'errors' => [ $invalidFname,
                                $invalidLname,
                                $invalidEmail,
                                $invalidNumber]
                ];

                redirect('');


                // view('home.index', []);
            }

        }

    }
}
