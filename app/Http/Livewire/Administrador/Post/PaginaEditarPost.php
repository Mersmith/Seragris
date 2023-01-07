<?php

namespace App\Http\Livewire\Administrador\Post;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\CategoriaBlog;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use App\Models\Imagen;

class PaginaEditarPost extends Component
{
    use WithFileUploads;

    protected $listeners = ['editarPost', 'eliminarPost'];

    public $post, $categorias, $tags;
    public $editar_imagen;
    public $slug, $tag = [];

    protected $rules = [
        'post.categoria_blog_id' => 'required',
        'post.nombre' => 'required',
        'slug' => 'required|unique:posts,slug',
        'post.descripcion' => 'required',
        'post.cuerpo' => 'required',
        'tag' => 'required',

    ];

    protected $validationAttributes = [
        'post.categoria_blog_id' => 'categoria del post',
        'post.nombre' => 'nombre del post',
        'slug' => 'slug del post',
        'post.descripcion' => 'descripción del post',
        'post.cuerpo' => 'cuerpo del post',
        'imagen' => 'imagen del post',
        'tag' => 'tag del post',
    ];

    protected $messages = [
        'post.categoria_blog_id.required' => 'La :attribute es requerido.',
        'post.nombre.required' => 'El :attribute es requerido.',
        'slug.required' => 'El :attribute es requerido.',
        'post.descripcion.required' => 'La :attribute es requerido.',
        'post.cuerpo.required' => 'La :attribute es requerido.',
        'imagen.required' => 'La :attribute es requerido.',
        'tag.required' => 'El :attribute es requerido.',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;

        $this->categorias = CategoriaBlog::all();
        $this->tags = Tag::all();

        $this->slug = $this->post->slug;
        $this->tag = $post->tags->pluck('id');
    }

    public function updatedPostNombre($value)
    {
        $this->slug = Str::slug($value);
    }

    public function editarPost()
    {
        $rules = $this->rules;
        $rules['slug'] = 'required|unique:posts,slug,' . $this->post->id;

        if ($this->editar_imagen) {
            $rules['editar_imagen'] = 'required|image';
        }

        $this->validate($rules);

        $this->post->slug = $this->slug;

        $this->post->update();

        $this->post->tags()->sync($this->tag);


        if ($this->editar_imagen) {
            Storage::delete([$this->post->imagen->imagen_ruta]);

            $imagenBusqueda = Imagen::find($this->post->imagen->id);
            $imagenBusqueda->delete();

            $imagenNueva = $this->editar_imagen->store('blog');

            $this->post->imagen()->create([
                'imagen_ruta' => $imagenNueva
            ]);
        }

        $imagenes_antiguas = $this->post->ckeditors->pluck('imagen_ruta')->toArray();

        $re_extractImages = '/src=["\']([^ ^"^\']*)["\']/ims';
        preg_match_all($re_extractImages, $this->post->cuerpo, $matches);
        $imagenesCkeditors_nuevas = $matches[1];

        foreach ($imagenesCkeditors_nuevas as  $imgckeditor) {
            $urlImagenCkeditor = 'ckeditor/' . pathinfo($imgckeditor, PATHINFO_BASENAME);

            $clave = array_search($urlImagenCkeditor, $imagenes_antiguas);

            if ($clave === false) {
                $this->post->ckeditors()->create([
                    'imagen_ruta' => $urlImagenCkeditor
                ]);
            } else {
                unset($imagenes_antiguas[$clave]);
            }
        }
        foreach ($imagenes_antiguas as  $imagen_antigua) {
            Storage::delete($imagen_antigua);
            $this->post->ckeditors()->where('imagen_ruta', $imagen_antigua)->delete();
        }

        $this->emit('mensajeActualizado', "El post ha sido actualizado.");
    }

    public function render()
    {
        return view('livewire.administrador.post.pagina-editar-post')->layout('layouts.administrador.administrador');
    }
}
