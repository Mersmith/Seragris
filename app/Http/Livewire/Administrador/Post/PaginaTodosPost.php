<?php

namespace App\Http\Livewire\Administrador\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PaginaTodosPost extends Component
{
    use WithPagination;
    public $buscarPost;
    protected $paginate = 10;
    protected $listeners = ['eliminarPost'];
    
    public function updatingBuscarPost()
    {
        $this->resetPage();
    }

    public function eliminarPost(Post $post)
    {
        $post->delete();
    }

    public function render()
    {
        $posts = Post::where('nombre', 'like', '%' . $this->buscarPost . '%')->paginate(10);

        return view('livewire.administrador.post.pagina-todos-post', compact('posts'))->layout('layouts.administrador.administrador');
    }
}
