<?php
/**
 * Created by PhpStorm.
 * User: vel-vet
 * Date: 25.12.18
 * Time: 20:46
 */

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $uploadDir;

    public function __construct(string $uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    public function upload(UploadedFile $file)
    {
        $originalName =$this->hashName($file->getClientOriginalName());
        try{
            $file->move($this->uploadDir,$originalName);
        }catch(FileException $exception){
            return $exception->getMessage();
        }
        return $originalName;
    }

    private function hashName(string $originalName)
    {
        return \md5(\uniqid($originalName));
    }
}