<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Common extends Model{
    
    public static $securityQuestionOne = [
        '01' => 'What was your childhood nickname?',
        '02' => 'What is the name of your favorite childhood friend?',
        '03' => 'In what city does your nearest sibling live?'
    ];

    public static $securityQuestionTwo = [
        '01' => 'In what city or town was your first job?',
        '02' => 'What was the last name of your third grade teacher?',
        '03' => 'In what city or town did your mother and father meet?'
    ];

    public static $gender = [
        'F' => 'Female',
        'M' => 'Male'
    ];

    public static $role = [
        '01' => 'Doctor',
        '02' => 'Nurse'
    ];

    public static $cancer = [
        '01' => 'Leukemia',
        '02' => 'Lymphoma',
        '03' => 'Brain Cancer'
    ];

    public static $relation = [
        '01' => 'Parents',
        '02' => 'Guardians'
    ];

    public static $state = [
        '01' => 'Perlis',
        '02' => 'Kedah',
        '03' => 'Perak',
        '04' => 'Kelantan',
        '05' => 'Terengganu',
        '06' => 'Pahang',
        '07' => 'Penang',
        '08' => 'Selangor',
        '09' => 'Melaka',
        '10' => 'Negeri Sembilan',
        '11' => 'Johor',
        '12' => 'Sarawak',
        '13' => 'Sabah',
    ];

    public static $age = [
        '07' => '7',
        '08' => '8',
        '09' => '9',
        '10' => '10',
        '11' => '11', 
    ];
}