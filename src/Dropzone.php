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

    /**
     * @todo permitir mais de um uploadfiles por página
     * @param null $prefixDir
     */
    public function __construct($prefixDir = null)
    {
        $this->baseDir = sys_get_temp_dir() . '/' . Session::getId() . '/';
    }

    public function config($config)
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        $default = [
            'url'=>'/dropzone',
            'maxFiles'=>5,
            'maxFilesize'=>10,
            'jsonUploadedFiles'=> Dropzone::getUploadedFiles(),
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

    public function upload(Request $request)
    {
        File::makeDirectory($this->baseDir, 0755, false, true);

        $request->file('file')->move($this->baseDir, $request->file('file')->getClientOriginalName());
    }

    public function delete(Request $request)
    {
        return (int)File::delete($this->baseDir . $request->get('name'));
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