<?php

namespace Alexandra\App\Module;

use Alexandra\App\Abstracts\ModuleManager;

class ContactBook extends ModuleManager
{
    public function register()
    {
        // [x] - :TODO Create an activator method to register database tables and other things
        // [x] - :TODO Insert sample data into the contact book
        // [ ] - :TODO Create a deactivator method to unregister database tables and other things
        // [ ] - :TODO Create a menu page to manage the contact book
        // [ ] - :TODO Create a shortcode to display the contact book
    }


    public function activate()
    {
        global $wpdb;

        $tableName = $wpdb->prefix . 'alexandra_contact_book';

        $charsetCollate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $tableName (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            phone varchar(25) NOT NULL,
            email varchar(255) NULL,
            message text NULL,
            UNIQUE KEY id (id)
        ) $charsetCollate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        dbDelta($sql);
        $this->initialData();
    }

    public function deactivate()
    {
        global $wpdb;

        $tableName = $wpdb->prefix . 'alexandra_contact_book';

        $sql = "DROP TABLE IF EXISTS $tableName;";
        $wpdb->query($sql);
    }

    public function initialData()
    {
        if ($this->exist('john@exaple.com')) {
            return;
        }

        global $wpdb;

        $tableName = $wpdb->prefix . 'alexandra_contact_book';

        $wpdb->insert($tableName, [
            'name'    => 'John Doe',
            'phone'   => '123-456-7890',
            'email'   => 'john@exaple.com',
            'message' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.'
        ]);
    }

    public function exist($email)
    {
        global $wpdb;

        $tableName = $wpdb->prefix . 'alexandra_contact_book';
        $sql = "SELECT * FROM {$tableName} WHERE email = '$email'";
        $result = $wpdb->get_results($sql);
        return count($result) > 0;
    }

    public function uninstall()
    {
        // TODO: Implement uninstall() method.
    }
}
