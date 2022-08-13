<?php

namespace Alexandra\App\Models;

class Contact extends Model
{
    protected $table = 'alexandra_contact_book';

    protected $sanitizationRules = [
        'name' => 'sanitize_text_field',
        'email' => 'sanitize_email',
        'phone' => 'sanitize_text_field',
        'message' => 'sanitize_textarea_field',
    ];

    protected $schema = [
        // The Worst Code Ever || refactor this code with a better approach by creating a seeder
        'name'    => 'varchar(255) NOT NULL',
        'phone'   => 'varchar(25) NOT NULL',
        'email'   => 'varchar(255) NULL',
        'message' => 'text NULL',
    ];


}
