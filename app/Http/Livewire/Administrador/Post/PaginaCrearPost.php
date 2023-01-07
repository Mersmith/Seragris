<?php

namespace App\Http\Livewire\Administrador\Post;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\CategoriaBlog;
use App\Models\Tag;
use App\Models\Post;

class PaginaCrearPost extends Component
{
    use WithFileUploads;

    public $categorias, $tags;
    public $imagen;
    public $categoria_id = "",  $tag_id = "";
    public
        $nombre = null,
        $slug = null,
        $descripcion = null,
        $cuerpo = null,
        $estado = 2,
        $tag = [];

    protected $rules = [
        'categoria_id' => 'required',
        'nombre' => 'required',
        'slug' => 'required|unique:posts',
        'descripcion' => 'required',
        'cuerpo' => 'required',
        'estado' => 'required',
        'imagen' => 'required|image',
        'tag' => 'required',
    ];

    protected $validationAttributes = [
        'categoria_id' => 'categoria del post',
        'nombre' => 'nombre del post',
        'slug' => 'slug del post',
        'descripcion' => 'descripción del post',
        'cuerpo' => 'cuerpo del post',
        'estado' => 'estado del post',
        'imagen' => 'imagen del post',
        'tag' => 'tags del post',
    ];

    protected $messages = [
        'categoria_id.required' => 'La :attribute es requerido.',
        'nombre.required' => 'El :attribute es requerido.',
        'slug.required' => 'El :attribute es requerido.',
        'descripcion.required' => 'La :attribute es requerido.',
        'cuerpo.required' => 'La :attribute es requerido.',
        'estado.required' => 'El :attribute es requerido.',
        'imagen.required' => 'La :attribute es requerido.',
        'tag.required' => 'Los :attribute son requerido.',
    ];

    public function mount()
    {
        $this->categorias = CategoriaBlog::all();
        $this->tags = Tag::all();
    }

    public function updatedNombre($value)
    {
        $this->slug = Str::slug($value);
    }

    public function crearPost()
    {       
        $this->validate($this->rules);

        $post = new Post();

        $post->nombre = $this->nombre;
        $post->slug = $this->slug;
        $post->descripcion = $this->descripcion;
        $post->cuerpo = $this->cuerpo;
        $post->estado  = $this->estado;
        $post->categoria_blog_id  = $this->categoria_id;

        $post->save();
        
        $post->tags()->attach($this->tag);

        $imagenSubir = $this->imagen->store('blog');

        $post->imagen()->create([
            'imagen_ruta' => $imagenSubir
        ]);

        $re_extractImages = '/src=["\']([^ ^"^\']*)["\']/ims';
        preg_match_all($re_extractImages, $this->cuerpo, $matches);
        $imagenesCkeditors = $matches[1];

        foreach ($imagenesCkeditors as  $imgckeditor) {
            $urlImagenCkeditor = 'ckeditor/' . pathinfo($imgckeditor, PATHINFO_BASENAME);

            $post->ckeditors()->create([
                'imagen_ruta' => $urlImagenCkeditor
            ]);
        }

        $this->emit('mensajeCreado', "El post fué creado.");

        return redirect()->route('administrador.post.editar', $post);
    }

    public function render()
    {
        return view('livewire.administrador.post.pagina-crear-post')->layout('layouts.administrador.administrador');
    }
}
