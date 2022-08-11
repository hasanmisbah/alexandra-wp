<?php

namespace Alexandra\App\Models;

class Contact extends Model
{
    protected $table = 'alexandra_contact_book';

    protected $columns = [
        // The Worst Code Ever || refactor this code with a better approach by creating a seeder
        'name'    => 'varchar(255) NOT NULL',
        'phone'   => 'varchar(25) NOT NULL',
        'email'   => 'varchar(255) NULL',
        'message' => 'text NULL',
    ];


}
