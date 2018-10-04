<?php

require DIR_PATH . '/vendor/autoload.php';

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class Auth extends Base {
    /*     * Ï
     * 
     * @param type $id
     * @return type
     * @throws Exception
     */

    public function createToken($user, $id) {
        if (empty($id)) {
            throw new Exception('id must be required to generate token');
        }
        if (empty($user)) {
            throw new Exception('user must be required to generate token');
        }
        $token = (new Builder())
                ->setIssuer(TOKEN_ISSURE)
                ->setExpiration(time() + TOKEN_EXPIRE_AFTER)
                ->setIssuedAt(time())
                ->setAudience(TOKEN_AUDIENCE)
                ->setId(TOKEN_ID, true)
                ->set('id', $id)
                ->set('user', $user)
                ->getToken();
        return (string) $token;
    }

    /**
     * 
     * @param type $token
     * @return type
     * @throws Exception
     */
    public function getIdFromToken($token) {
        if (empty($token)) {
            throw new Exception('token must be required to extract id');
        }
        $t = (new Parser())->parse((string) $token);
        $data = new ValidationData();
        $data->setIssuer(TOKEN_ISSURE);
        $data->setAudience(TOKEN_AUDIENCE);
        $data->setId(TOKEN_ID, true);
        if ($t->validate($data) === false) {
            throw new Exception('token is not valid');
        }
        return $t->getClaim('id');
    }

    public function getUserFromToken($token) {
        if (empty($token)) {
            throw new Exception('token must be required to extract id');
        }
        $t = (new Parser())->parse((string) $token);
        $data = new ValidationData();
        $data->setIssuer(TOKEN_ISSURE);
        $data->setAudience(TOKEN_AUDIENCE);
        $data->setId(TOKEN_ID, true);
        if ($t->validate($data) === false) {
            throw new Exception('token is not valid');
        }
        return $t->getClaim('user');
    }

    /**
     * 
     * @global type $db
     * @return int
     */
    public function validateUser() {
        $token = '';
        global $response;
        global $error;
        $postInput = json_decode(file_get_contents("php://input"), true);
        /* @var $_GET type */
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
        } else if (isset($postInput['token'])) {
            $token = $postInput['token'];
        } else {
            return $response->jsonResponse($error->TOKEN_MISSING, 400);
        }
        try {
            $user = $this->getUserFromToken($token);
            if ($user === null) {
                return $response->jsonResponse($error->TOKEN_INVALID, 400);
            }
            $this->currentUser = $user;
            return true;
        } catch (Exception $e) {
            return $response->jsonResponse($error->TOKEN_EXPIRED, 400);
        }
    }

    public function login() {
        echo 'Login';
    }

    public function signUp() {

        $first_name = isset($this->bodyParams['first_name']) ? $this->bodyParams['first_name'] : '';
        $last_name = isset($this->bodyParams['last_name']) ? $this->bodyParams['last_name'] : '';
        $email = isset($this->bodyParams['email']) ? $this->bodyParams['email'] : '';
        $password = isset($this->bodyParams['password']) ? $this->bodyParams['password'] : '';

        try {
            $this->validation->email($email);
            $this->validation->firstName($first_name);
            $this->validation->lastName($last_name);
            $this->validation->password($password);

            $this->db->query('IF EXISTS (select 1 from ' . TBL_USERS . ' where email = ? ) THEN'
                    . ' SIGNAL SQLSTATE "23000" SET MYSQL_ERRNO = "1452", MESSAGE_TEXT = "EMAIL_ALREADY_EXIST";'
                    . 'ELSE insert into ' . TBL_USERS . ' (email, first_name, last_name, password, created_at, updated_at) values(?, ?, ?, ?, ?, ?);'
                    . 'END IF;', array($email, $email, $first_name, $last_name, $password, CURRENT_MILISECOND, CURRENT_MILISECOND));
            $user = $this->db->query("select * from " . TBL_USERS . " where email = ? LIMIT 1", array($email))->getFirst();
            if ($user == null) {
                return $this->response->jsonResponse($this->error->UNKNOWN_ERROR, 500);
            }

            $token = $this->createToken($user, $user->id);
            $u = $this->getUserFromToken($token);
            return $this->response->jsonResponse(array('token' => $token), 200);
        } catch (ValidationException $ex) {
            return $this->response->jsonResponse($ex->getError(), 400);
        } catch (Exception $ex) {
            return $this->response->jsonResponse($ex->getError(), 500);
        }
    }

}

?>