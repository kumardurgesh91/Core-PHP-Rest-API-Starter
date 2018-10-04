<?php

require_once DIR_PATH . '/exceptions/QueryException.php';
require_once DIR_PATH . '/lib/DB.php';
require_once DIR_PATH . "/lib/ImageUpload.php";
require_once DIR_PATH . '/lib/Validation.php';


class Base {

    public $queryParams = array();
    public $bodyParams = array();
    public $urlParams = array();
    public $currentUser = null;
    public $response = null;
    public $db = null;
    public $auth = null;
    public $validation = null;
    public $imageUploader = null;
    
    public function __construct() {
        $conn_data = array(
            'dbname' => DB_NAME,
            'dbuser' => DB_USER,
            'dbpass' => DB_PASSWORD,
            'dbhost' => DB_SERVER
        );

        $this->db = new DB($conn_data);
        $this->imageUploader = new ImageUpload();
        $this->validation = new Validation();
        global $error;
        $this->error = $error;
        global $utils;
        $this->utils = $utils;
        global $response;
        $this->response = $response;
    }

    public function setRequestParams($queryParams, $bodyParams, $urlParams) {
        $this->queryParams = is_array($queryParams) ? $queryParams : array();
        $this->bodyParams = is_array($bodyParams) ? $bodyParams : array();
        $this->urlParams = is_array($urlParams) ? $urlParams : array();
    }

}

?>