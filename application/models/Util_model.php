<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Util_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789ABCDEFGHJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function resizeImage($file, $width, $height)
    {
        require __DIR__.'/../third_party/ImageManipulator.php';

        if ($file['error'] > 0) {
            echo 'Error: '.$file['error'].'<br />';
        } else {
            $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
            $fileExtension = strrchr($file['name'], '.');
            if (in_array($fileExtension, $validExtensions)) {
                $newNamePrefix = time().'_';
                $manipulator = new ImageManipulator($file['tmp_name']);
                $aux = $manipulator->resample($width, $height);
                $path = __DIR__.'/../../images_temp/'.$file['name'];
                $manipulator->save($path);
                $aux = addslashes(file_get_contents($path));
                unlink($path);
                print_r($aux);die;
                return $aux;
            } else {
                echo 'Imagem não encontrada';
            }
        }
    }
}
