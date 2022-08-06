<?php

namespace Alexandra\Base;

class Model
{
    protected $columns = [];
    protected $table = '';
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

}
