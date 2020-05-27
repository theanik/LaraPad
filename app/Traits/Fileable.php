<?php
namespace App\Traits;

trait Fileable{

    public function fileUpload($fileName)
    {
        info("{$fileName} has been Upload");
    }
}