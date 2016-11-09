# dropzone
Este pacote para Laravel5 serve para persistir temporáriamente arquivos submetidos através da biblioteca DropzoneJS.

Ao realizar o upload de um arquivo, este será armazenado em uma área temporária.

Caso ocorra um reload na página, o componente irá repopular os arquivos previamente carregados, previnindo que seu usuário tenha que inserir os arquivos novamente.

Estes casos de reload de página podem ocorrer por falha na validação de algum campo após submeter o formulário, ou por qualquer outro erro no lado so servidor.

Existe a restrição de que um formulário contenha apenas um componente.  

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

Publicando os assets:

    $php artisan vendor:publish --provider="Jakjr\Dropzone\DropzoneServiceProvider"

##Uso

### routes.php:
    Route::post('dropzone', function(){
        app('dropzone')->upload();
    });
    
    Route::delete('dropzone', function(){
        app('dropzone')->delete();
    });

São os endpoints que receberão os arquivos carregados pelo DropzoneJS.

O método upload irá armazenar o arquivo em um diretrio temporário do sistema, e em um diretório com o nome do ID da sessão do usuário.

### Views (carregando os assets):
    @section('css')
        <link rel="stylesheet" href='/vendor/dropzone/css/dropzone.min.css'>
    @endsection

    @section('js')
        <script src="/vendor/dropzone/js/dropzone.min.js"></script>
        <script>
            $('.dropzone').lightDropzone({!! Dropzone::getConfig() !!});
        </script>
    @endsection
    
### Views (criando o componente)
    <div class="dropzone"
         data-url="/dropzone"
         data-param-name="files"
         data-max-files="5"
         data-max-filesize="10"
         data-accepted-files=".pdf,.doc,.docx,.dotx,.ppt,.pptx,.ps,.xls,.xlsx,image/*,video/*,audio/*,text/*"
    ></div>

Os atributos data-* são utilizados para configurar o componente DropzoneJS.

Seus nomes são auto-explicativos.

O attributo data-url deve é a URL do endpoint definido no routes.php


### Middleware

Registro o middleware do pacote:

app\Http\Kernel.php:

    protected $routeMiddleware = [
        ...
        'dropzone' => \Jakjr\Dropzone\Middleware\Dropzone::class,
    ];

Este middleware é responsável por injetar no request de um submit os arquivos previamente carregados. 

   
### Controllers:

Aplique o middleware no método do controller que utilizará o carregamento de arquivos:

    class FormController extends Controller
    {
        public function __construct()
        {
            $this->middleware('dropzone', ['only'=>['postForm']]);
        }
    ...
    }
    

Utilize o Request para obter uma instância UploadedFile dos aquivos préviamente carregados:

    public function store(Request $request)
    {
        ...
        //Use the methods from Laravel
        $request->file('files.0')->move ....
        ...
    }
    

O arquivo permanecerá disponível no componente enquanto não foi movido para seu destino permanente.
 
 
Exemplo para mover todos os arquivos:


    if (!empty($files = $request->files->get('files'))) {

        /** @var UploadedFile $file */
        foreach($files as $file) {
            $file->move(
                storage_path(),
                $file->getClientOriginalName()
            );
        }

    }
