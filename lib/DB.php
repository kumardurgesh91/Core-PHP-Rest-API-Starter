<?php

class DB {

    private $_pdo, $_query, $_count = 0, $_results = array(), $_lastID = NULL, $_errors = array(), $dbuser, $dbname, $dbpass, $dbhost;

    public function __construct($con_data = array()) {
        $req_keys = array('dbname', 'dbuser', 'dbpass', 'dbhost');
        foreach ($req_keys as $key) {
            if (!is_array($con_data)) {
                die('Connection data is invalid');
            } elseif (!array_key_exists($key, $con_data)) {
                die($key . 'not found in the connection data');
            }
        }
        $this->dbhost = $con_data['dbhost'];
        $this->dbname = $con_data['dbname'];
        $this->dbuser = $con_data['dbuser'];
        $this->dbpass = $con_data['dbpass'];

        try {
            $this->_pdo = new PDO('mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname . ';charset=utf8', $this->dbuser, $this->dbpass);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            $this->_errors[] = $e->getMessage();
            die('Failed connecting to database');
        }
    }

// function __construct() ends

    public function query($query, $params = array()) {
        $this->_query = null;
        $this->_results = null;
        $this->_count = 0;
        $this->_lastID = null;
        try {
            
            $this->_query = $this->_pdo->prepare($query);
            if (count($params)) {
                $i = 1;
                foreach ($params AS $param) {
                    $this->_query->bindValue($i, $param);
                    $i++;
                }
            }
            $this->_query->execute();
            $this->_results = $this->_query->fetchAll(PDO:: FETCH_OBJ);
            $this->_count = $this->_query->rowCount();
            $this->_lastID = $this->_pdo->lastInsertID();
            $this->_columnsCount = $this->_query->columnCount();
            for ($i = 0; $i < $this->_columnsCount; $i++) {
                $this->_metaData[] = $this->_query->getColumnMeta($i);
            }
        } catch (PDOException $e) {
            $this->_errors[] = $e->getMessage();
            $info = $e->errorInfo;
            throw new QueryException($info[2], $info[1]);
        }
        return $this;
    }

    private function action($action, $table, $conditions) {
        if (count($conditions) == 3) {
            $column = $conditions[0];
            $operator = $conditions[1];
            $value = $conditions[2];
            $this->query($action . ' `' . $table . '` WHERE `' . $column . '` ' . $operator . ' ?', array($value));
            return $this;
        }
    }

    public function lastInsertedId() {
        return $this->_lastID;
    }

    public function get($table, $conditions = NULL, $limit = NULL) {
        if ($conditions) {
            $this->action('SELECT * FROM', $table, $conditions);
        } else {
            $this->query('SELECT * FROM `' . $table . '`');
        }
        return $this;
    }
    
    public function getResult() {
        return $this->_results;
    }

    public function getFirst() {
        if ($this->rowCount() > 0) {
            return $this->_results[0];
        }
        return null;
    }

    public function rowCount() {
        return $this->_count;
    }

    public function transaction() {
        $this->_pdo->beginTransaction();
        return $this;
    }

    public function commit() {
        $this->_pdo->commit();
        return $this;
    }

    public function roll() {
        $this->_pdo->rollBack();
        return $this;
    }

}

?>