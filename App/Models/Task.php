<?php

namespace App\Models;
use App\Core\Model;

class Task extends Model {

    protected $tableName = 'tasks';

    protected $id;
    public $username;
    public $email;
    public $description;
    public $state  = 0;
    public $is_edit = 0;

}


?>