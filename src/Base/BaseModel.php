<?php

namespace Alexandra\Base;

use Alexandra\App\Traits\Sanitizable;

class BaseModel
{
    use Sanitizable;
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
        // :TODO Add validation with error messages
        global $wpdb;

        $this->DB = $wpdb;

        $this->dbTable = $this->DB->prefix . $this->table;
    }

    /**
     * @return array|object|\stdClass[]|null
     */
    public function all()
    {
        $results = $this->DB->get_results("SELECT * FROM {$this->dbTable}");
        return $results;
    }

    /**
     * @param $conditions array('column' => 'value')
     * @param $limit int|null
     * @return array|object|\stdClass[]|null
     */
    public function where($conditions, $limit = null)
    {
        $query = "SELECT * FROM {$this->dbTable} WHERE ";

        $query .= implode(' AND ', array_map(function ($key, $value) {
            return "{$key} = '{$value}'";
        }, array_keys($conditions), array_values($conditions)));

        if($limit) {
            $query .= " LIMIT {$limit} ";
        }

        $results = $this->DB->get_results($query);
        return $results;
    }

    /**
     * @param $key string
     * @param $value string
     * @return mixed|\stdClass|null
     */
    public function find($key, $value)
    {
        $results = $this->where([$key => $value], 1);

        if(empty($results)) {
            return null;
        }

        return $results[0];
    }

    /**
     * @param $data array ['column' => 'value']
     * @return mixed|\stdClass|null
     */
    public function create($data)
    {
        apply_filters('before_create_'.$this->table.'_model', $data);

        $this->DB->insert($this->dbTable, $data);
        $result = $this->find('id', $this->DB->insert_id);

        apply_filters('after_create_'.$this->table.'_model', $result);
        return $result;
    }

    /**
     * @param $id int
     * @param $data array ['column' => 'value']
     * @return mixed|\stdClass|null
     * @throws \Exception
     */
    public function update($id, $data)
    {
        $model = $this->find('id', $id);

        if(!$model) {
            throw new \Exception('Model not found');
        }

        apply_filters('before_update_'.$this->table.'_model', $data, $id);

        $this->DB->update($this->dbTable, $data, array($this->primaryKey => $id));
        $result = $this->find('id', $id);

        apply_filters('after_update_'.$this->table.'_model', $data, $id);

        return $result;
    }

    /**
     * @param $id int
     * @return mixed|\stdClass|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $model = $this->find('id', $id);

        if(!$model) {
            throw new \Exception('Model not found');
        }

        do_action('before_delete_'.$this->table.'_model', $model);

        $this->DB->delete($this->dbTable, array($this->primaryKey => $id));

        do_action('after_delete_'.$this->table.'_model', $model);

        return $model;
    }

    /**
     * create the table if it doesn't exist
     * @return void
     */
    public function createTable()
    {
        if ($this->doesTableExists()) {
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
        if (!$this->doesTableExists()) {
            return;
        }

        $sql = "DROP TABLE IF EXISTS {$this->dbTable};";
        $this->DB->query($sql);
    }

    /**
     * Check if table exist in the database
     * @return bool
     */
    public function doesTableExists()
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

    public function exist($key, $value = null)
    {
        if(!$value) {
            $key = $this->primaryKey;
            $value = $key;
        }

        $sql = "SELECT * FROM {$this->dbTable} WHERE {$key} = {$value};";
        $result = $this->DB->get_results($sql);
        return count($result) > 0;
    }

}
