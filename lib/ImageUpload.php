<?php

require DIR_PATH . '/Exceptions/ImageException.php';

class ImageUpload {
    public $max_imag_size = 50000000;
    public $allow_formate = array('jpg', 'jpeg', 'png');
    
    /**
     * 
     * @global type $utils
     * @param type $data
     * @return type
     * @throws type
     * @throws ImageException
     */
    public function saveBase64Image($data, $invi_master_did) {
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        list(,$image_type) = explode(':', $type);
        list(, $image_type) = explode('/', $image_type);
        $data = base64_decode($data);
        if($this->max_imag_size < strlen($data)) {
            throw new ImageException('IMAGE_SIZE_ERROR');
        } else if(!in_array(strtolower($image_type), $this->allow_formate)) {
            throw new ImageException('INVALID_IMAGE_TYPE');
        }
        $date = date('Y-m-d');
        $time = str_replace(":", "-", date('H:i:s'));
        $image_name = $invi_master_did. '-' . $date . '-' .$time. '.' . $image_type;
        $path = IMAGE_PATH . '/'. $image_name;
        
        try {
            file_put_contents($path, $data);
        } catch (Exception $ex) {
            throw new ImageException('UNKNOWN_IMAGE_ERROR');
        }
        return array('image_name'=>$image_name);
    }
}
