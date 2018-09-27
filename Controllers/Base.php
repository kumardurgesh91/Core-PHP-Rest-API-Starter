<?php

require DIR_PATH . '/Exceptions/QueryException.php';
require DIR_PATH . '/lib/DB.php';
require DIR_PATH . "/lib/ImageUpload.php";
require DIR_PATH . '/lib/Validation.php';
require DIR_PATH . "/lib/ErrorMessage.php";

class Base {

    public $queryParams = array();
    public $bodyParams = array();
    public $urlParams = array();
    public $currentUser = null;
    public $response = null;
    public $db = null;
    public $error = null;
    public $auth = null;

    public function __construct() {
        $conn_data = array(
            'dbname' => DB_NAME,
            'dbuser' => DB_USER,
            'dbpass' => DB_PASSWORD,
            'dbhost' => DB_SERVER
        );

        $this->db = new DB($conn_data);
        $imageUploader = new ImageUpload();
        $validation = new Validation();
        $this->error = new ErrorMessage();
        global $utils;
        $this->utils = $utils;
    }

    public function setRequestParams($queryParams, $bodyParams, $urlParams) {
        $this->queryParams = is_array($queryParams) ? $queryParams : array();
        $this->bodyParams = is_array($bodyParams) ? $bodyParams : array();
        $this->urlParams = is_array($urlParams) ? $urlParams : array();
    }

}

?>