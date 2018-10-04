<?php

require_once "Rest.class.php";
require_once "../../init.php";

class RouteHandler extends Rest {

    private $apis = array();

    public function __construct() {
        parent:: __construct();
    }

    function getRegex($pattern) {
        if (preg_match('/[^-:\/_{}()a-zA-Z\d]/', $pattern))
            return false; // Invalid pattern

        $pattern = preg_replace('#\(/\)#', '/?', $pattern);

        $allowedParamChars = '[a-zA-Z0-9\_\-]+';
        $pattern = preg_replace(
                '/:(' . $allowedParamChars . ')/', '(?<$1>' . $allowedParamChars . ')', $pattern
        );

        $pattern = preg_replace(
                '/{(' . $allowedParamChars . ')}/', '(?<$1>' . $allowedParamChars . ')', $pattern
        );

        $patternAsRegex = "@^" . $pattern . "$@D";
        return $patternAsRegex;
    }

    public function post($url, $call, $isAuth = false) {
        $this->apis[] = array('method' => 'POST', 'url' => $url, 'call' => $call, 'isAuth' => $isAuth);
        return $this;
    }
    
    public function get($url, $call, $isAuth = false) {
        $this->apis[] = array('method' => 'GET', 'url' => $url, 'call' => $call, 'isAuth' => $isAuth);
        return $this;
    }
    
    public function put($url, $call, $isAuth = false) {
        $this->apis[] = array('method' => 'PUT', 'url' => $url, 'call' => $call, 'isAuth' => $isAuth);
        return $this;
    }
    
    public function patch($url, $call, $isAuth = false) {
        $this->apis[] = array('method' => 'PATCH', 'url' => $url, 'call' => $call, 'isAuth' => $isAuth);
        return $this;
    }
    
    public function delete($url, $call, $isAuth = false) {
        $this->apis[] = array('method' => 'DELETE', 'url' => $url, 'call' => $call, 'isAuth' => $isAuth);
        return $this;
    }

    public function execute() {
        $route = $_REQUEST['request'];
        $method = $this->getRequestMethod();
        
        $isRouteMatched = false;
        global $response;
        foreach ($this->apis as $request) {
            if (strtolower($method) !== strtolower($request['method'])) {
                continue;
            }
            $patternAsRegex = $this->getRegex(ltrim($request['url'], '/'));

            if (!!$patternAsRegex && preg_match($patternAsRegex, $route, $matches)) {
                include_once DIR_PATH . '/classes/Base.php';
                foreach (glob(DIR_PATH . "/classes/v1/*.php") as $filename) {
                    include_once $filename;
                }
                
                $isRouteMatched = true;
                $params = array_intersect_key($matches, array_flip(array_filter(array_keys($matches), 'is_string')));
                $currentUser = null;
                if ($request['isAuth'] === true) {
                    $auth = new Auth();
                    $auth->validateUser();
                }
                global $utils;
                $call = explode('.', $request['call']);
                if (count($call) > 1) {
                    $className = $call[0];
                    $methodName = $call[1];
                    $instance = new $className();
                    $instance->setRequestParams(
                            $this->queryParams, $this->bodyParams, $this->cleanInputs($params)
                    );
                    $instance->{$methodName}();
                } else {
                    throw new Exception("$method must be call with class name");
                }
                break;
            }
        }
        if ($isRouteMatched === false) {
            return $response->jsonResponse('Resource not available', 404);
        }
    }

}

// Router class ends
?>