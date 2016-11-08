# dropzone
Integration between dropzone and laravel5

##Install
composer require jakjr/dropzone

config/app.php

    'providers' => [
        ...
        Jakjr\Dropzone\DropzoneServiceProvider::class,
    ]
    
    'aliases' => [
        ...
        'Dropzone'  => Jakjr\Dropzone\DropzoneFacade::class,
    ]

php artisan vendor:publish --provider="Jakjr\Dropzone\DropzoneServiceProvider"

##Use

### Views (load component):
    @section('css')
        <link rel="stylesheet" href='/vendor/dropzone/css/dropzone.min.css'>
    @endsection

    @section('js')
        <script src="/vendor/dropzone/js/dropzone.min.js"></script>
        <script>
            $('.dropzone').lightDropzone({!! Dropzone::getConfig() !!});
        </script>
    @endsection
    
### Views (create element)
    <div class="form-group">
        <label class="col-md-3 control-label">Attachments:</label>
        <div class="col-md-9">
            <div class="dropzone"></div>
        </div>
    </div>

    
### Controllers:

    public function store(Request $request)
    {
        ...
        //Use the methods from Laravel
        $request->file('file.0')->move ....
        ...
    }
