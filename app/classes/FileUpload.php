<?php
/**
 * Created by PhpStorm.
 * User: waiferkolar
 * Date: 2019-01-26
 * Time: 17:28
 */

namespace App\classes;


class FileUpload
{
    protected $maxsize = 2097152;
    protected $filename = null;
    protected $acceptsType = ['png', 'jpeg', 'jpg', 'gif'];

    public function setName($file, $name = "")
    {

        if ($name === "") {
            $name = pathinfo($file->name, PATHINFO_FILENAME);
        }

        $hash = md5(microtime());
        $ext = pathinfo($file->name, PATHINFO_EXTENSION);

        $this->filename = "{$name}-{$hash}.$ext";

    }

    public function getName()
    {
        return $this->filename;
    }

    public function checkSize($file)
    {
        return $file->size < $this->maxsize;
    }

    public function isImage($file)
    {
        $ext = pathinfo($file->name, PATHINFO_EXTENSION);
        return in_array($ext, $this->acceptsType);
    }

    public function getPath($file)
    {
        echo pathinfo($file->tmp_name, PATHINFO_FILENAME);
    }

    public function move($file, $name = "")
    {
        if ($this->isImage($file)) {
            if ($this->checkSize($file)) {
                $this->setName($file, $name);
                $filepath = dirname(APP_ROOT) . "/public/assets/uploads/" . $this->getName();
                return move_uploaded_file($file->tmp_name, $filepath);
            } else {
                return "Please Upload size under " . $this->maxsize . " bytes.";
            }
        } else {
            return "Please Upload Only " . implode(',', $this->acceptsType) . ".";
        }
    }

}