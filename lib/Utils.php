<?php

class Utils {

    public function camelCaseKeys($array, $arrayHolder = array()) {
        $camelCaseArray = !empty($arrayHolder) ? $arrayHolder : array();
        foreach ($array as $key => $val) {
            $newKey = @explode('_', $key);
            array_walk($newKey, function(&$v) {
                $v = ucwords($v);
            });
            $newKey = @implode('', $newKey);
            $newKey{0} = strtolower($newKey{0});
            if (!is_array($val)) {
                $camelCaseArray[$newKey] = $val;
            } else {
                $camelCaseArray[$newKey] = $this->camelCaseKeys($val, isset($camelCaseArray[$newKey]) ? $camelCaseArray[$newKey] : array());
            }
        }
        return $camelCaseArray;
    }

// camelCaseKeys function ends 

    public function underscoreKeys($array = array(), $arrayHolder = array()) {
        $underscoreArray = !empty($arrayHolder) ? $arrayHolder : array();
        if (empty($array)) {
            return $underscoreArray;
        }
        foreach ($array as $key => $val) {
            $newKey = preg_replace('/[A-Z]/', '_$0', $key);
            $newKey = strtolower($newKey);
            $newKey = ltrim($newKey, '_');
            if (!is_array($val)) {
                $underscoreArray[$newKey] = $val;
            } else {
                $underscoreArray[$newKey] = $this->underscoreKeys($val, isset($underscoreArray[$newKey]) ? $underscoreArray[$newKey] : array());
            }
        }

        return $underscoreArray;
    }

    public function validationResponse($data, $ex) {
        if (ENV === 'dev') {
            return $data->response->jsonResponse($ex->getError(), 400);
        } else if (ENV === 'test') {
            return $data->response->jsonResponse($ex->getError(), 400);
        } else {
            return $data->response->jsonResponse($data->error->UNKNOWN_VALIDATION_ERROR, 400);
        }
    }

}

?>