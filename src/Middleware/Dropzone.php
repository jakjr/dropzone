<?php

namespace Jakjr\Dropzone\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\FileBag;

class Dropzone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->has('dropzone')) {

            $dropzoneFiles = $request->get('dropzone');

            foreach ($dropzoneFiles as $inputElementName=>$fileNames) {
                $this->setBag($request, $inputElementName, $fileNames);
            }

            $request->request->remove('dropzone');
        }

        return $next($request);
    }

    private function setBag($request, $inputElementName, $fileNames)
    {
        $dropzone = app('dropzone');

        foreach ($fileNames as $fileName) {

            $path = $dropzone->baseDir . $fileName;
                
            $uploaded = new UploadedFile(
                $path,
                $fileName,
                filetype($path),
                0,
                true
            );
            
            $uploadedFiles[] = $uploaded;
        }

        $request->files->set($inputElementName, $uploadedFiles);
    }
}
