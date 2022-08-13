<?php

namespace Alexandra\Base;

class BaseModel
{
    // List all columns in the table here
    protected $columns = [];

    // List of database schema
    protected $schema = [];

    // set the table name here
    protected $table = '';

    // set the primary key here
    protected $primaryKey = 'id';

    protected $DB = null;

    protected $dbTable = null;

    public function __construct()
    {
        global $wpdb;

        $this->DB = $wpdb;

        $this->dbTable = $this->DB->prefix . $this->table;
    }

    public function all()
    {
        $results = $this->DB->get_results("SELECT * FROM {$this->dbTable}");
        return $results;
    }

    public function where($condition)
    {
        $results = $this->DB->get_results("SELECT * FROM {$this->dbTable} WHERE {$condition}");
        return $results;
    }

    public function find($id)
    {
        $results = $this->DB->get_row("SELECT * FROM {$this->dbTable} WHERE {$this->primaryKey} = {$id}");
        return $results;
    }

    public function create($data)
    {
        $this->DB->insert($this->dbTable, $data);
        return $this->DB->last_result;
    }

    public function update($id, $data)
    {
        $this->DB->update($this->dbTable, $data, array($this->primaryKey => $id));
        return $this->DB->last_result;
    }

    public function delete($id)
    {
        $this->DB->delete($this->dbTable, array($this->primaryKey => $id));
        return $this->DB->last_result;
    }

    /**
     * create the table if it doesn't exist
     * @return void
     */
    public function createTable()
    {
        if ($this->isTableExist()) {
            return;
        }
        // create column from associative array
        $columns = [];

        foreach ($this->schema as $key => $value) {
            $columns[] = "{$key} {$value}";
        }
        // create sql query
        $sql = "CREATE TABLE {$this->dbTable} (
            {$this->primaryKey} mediumint(9) NOT NULL AUTO_INCREMENT,
            " . implode(', ', $columns) . ",
            UNIQUE KEY id ({$this->primaryKey})
        ) {$this->DB->get_charset_collate()};";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }

    /**
     * Check if table exist in database and drop it if it does
     * @return void
     */
    public function dropTable()
    {
        if (!$this->isTableExist()) {
            return;
        }

        $sql = "DROP TABLE IF EXISTS {$this->dbTable};";
        $this->DB->query($sql);
    }

    /**
     * Check if table exist in the database
     * @return bool
     */
    public function isTableExist()
    {
        $sql = "SHOW TABLES LIKE '{$this->dbTable}';";
        $result = $this->DB->get_results($sql);
        return count($result) > 0;
    }

    /**
     * Check if data exist in the table
     * @param string $key
     * @param $value
     * @return bool
     */

    public function exist($key = 'id', $value)
    {
        $sql = "SELECT * FROM {$this->dbTable} WHERE {$key} = {$value};";
        $result = $this->DB->get_results($sql);
        return count($result) > 0;
    }

}
