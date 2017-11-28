<?php

namespace Jakjr\Dropzone;

use Exception;
use File;
use Session;
use stdClass;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class Dropzone
{
    var $baseDir;
    var $config = [];
    var $request;

    public function __construct()
    {
        $this->baseDir = sys_get_temp_dir() . '/' . Session::getId() . '/';
        $this->request = app('request');
    }

    public function config($config)
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        $default = [
            'jsonUploadedFiles'=> Dropzone::getUploadedFiles()
        ];

        $config = array_merge($default, $this->config);

        return json_encode($config);
    }

    public function getUploadedFiles()
    {
        if (!File::isDirectory($this->baseDir)) {
            return '[]';
        }

        $return = new Collection();
        foreach (File::files($this->baseDir) as $path) {
            $f = new stdClass();
            $f->name = $this->getFileFullName($path);
            $f->size = File::size($path);
            $return->push($f);
        }
        return $return->toJson();
    }

    private function getFileFullName($path)
    {
        if ($ext = File::extension($path)) {
            return File::name($path) . '.' . $ext;
        }
        return File::name($path);
    }

    public function upload()
    {
        if (! $this->request->files->count()) {
            throw new Exception('none file found on request to upload');
        }

        File::makeDirectory($this->baseDir, 0755, false, true);

        $inputElementName = $this->request->files->keys()[0];

        //Arquivo com o mesmo nome já existe no diretório de transição
        if (file_exists($this->baseDir . DIRECTORY_SEPARATOR . $this->request->file($inputElementName)->getClientOriginalName())) {
            throw new Exception('Um arquivo com o mesmo nome já foi anexado à este atendimento.');
        }
        
        $this->request->file($inputElementName)->move(
            $this->baseDir,
            $this->request->file($inputElementName)->getClientOriginalName()
        );
    }

    public function delete()
    {
        return (int)File::delete($this->baseDir . $this->request->get('name'));
    }

    public function store($destination)
    {
        if (! File::copyDirectory($this->baseDir, $destination) ) {
            throw new Exception("Não foi possível persisistir o diretório {$this->baseDir} em {$destination}");
        }

        if (! File::deleteDirectory($this->baseDir) ) {
            throw new Exception("Não foi possível apagar o diretório {$this->baseDir}", 1);
        }

        return true;
    }

}
