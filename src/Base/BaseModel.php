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

    // sanitization rules
    protected $sanitizationRules = [];

    // set the primary key here
    protected $primaryKey = 'id';

    protected $DB = null;

    protected $dbTable = null;

    public function __construct()
    {
        // :TODO Add validation with error messages
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

    public function find($key = 'id', $value)
    {
        if(!$value) {
            $key = $this->primaryKey;
            $value = $this->$key;
        }

        $results = $this->DB->get_row("SELECT * FROM {$this->dbTable} WHERE {$key} = '{$value}'");
        return $results;
    }

    public function create($data)
    {
        $this->DB->insert($this->dbTable, $data);
        $results = $this->find($this->DB->insert_id);
        return $results;
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

    public function exist($key, $value)
    {
        if(!$value) {
            $key = $this->primaryKey;
            $value = $key;
        }

        $sql = "SELECT * FROM {$this->dbTable} WHERE {$key} = {$value};";
        $result = $this->DB->get_results($sql);
        return count($result) > 0;
    }

    /**
     * @param $key string
     * @param $value mixed
     * @return mixed
     * @throws \Exception
     */

    public function sanitizeData($key, $value)
    {
        if(empty($this->sanitizationRules)) {
            return $value;
        }

        if(!isset($this->schema[$key])) {
            throw new \Exception("{$key} is not a valid column");
        }

        if(!isset($this->sanitizationRules[$key])) {
            throw new \Exception("{$key} Sanitization rule is not defined");
        }

        return call_user_func($this->sanitizationRules[$key], $value);
    }

    /**
     * Sanitize All Data
     * @param $data array
     * @return array
     * @throws \Exception
     */
    public function sanitizeAll(array $data)
    {
        $sanitizedData = [];

        foreach ($data as $key => $value) {

            if(!$value) {
                $sanitizedData[$key] = null;
            }

            if(isset($this->schema[$key])) {
                $sanitizedData[$key] = $this->sanitizeData($key, $value);
            }
        }

        return $sanitizedData;
    }

}
