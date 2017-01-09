<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Util_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function resizeImage($file, $width, $height) {
        require __DIR__ . '/../third_party/ImageManipulator.php';
        if ($file['error'] > 0) {
            echo 'Error: ' . $file['error'] . '<br />';
        } else {
            $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
            $fileExtension = strrchr($file['name'], '.');
            if (in_array($fileExtension, $validExtensions)) {
                $newNamePrefix = time() . '_';
                $manipulator = new ImageManipulator($file['tmp_name']);
                $aux = $manipulator->resample($width, $height);
                $path = 'assets/avatar/' . $this->getDir($fileExtension);
                $manipulator->save($path);
                $aux = file_get_contents($path);
                print_r($path);
                die;
                return $path;
            }
        }
    }

    function getDir($fileExtension) {
        $step_1 = $this->generateRandomString(6);
        $step_2 = $this->generateRandomString(9);
        $step_3 = implode("/", str_split(substr($step_2, 0, 9), 3));
        $dirname = $step_3 . "/" . $step_2 . $fileExtension;
        return $dirname;
    }

}
