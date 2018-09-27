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
        $data->setIssuer(TOKEN_ISSURE)
                ->setAudience(TOKEN_AUDIENCE)
                ->setId(TOKEN_ID, true);
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
        $data->setIssuer(TOKEN_ISSURE)
                ->setAudience(TOKEN_AUDIENCE)
                ->setId(TOKEN_ID, true);
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

}

?>