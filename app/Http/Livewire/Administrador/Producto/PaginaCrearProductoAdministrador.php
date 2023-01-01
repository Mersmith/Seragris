<?php

namespace App\Http\Livewire\Administrador\Producto;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Subcategoria;
use App\Models\Producto;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PaginaCrearProductoAdministrador extends Component
{
    use WithFileUploads;

    public $categorias, $subcategorias = [], $marcas = [];
    public $imagen, $ficha_tecnica, $hoja_seguridad;
    public $categoria_id = "",  $subcategoria_id = "", $marca_id = "";
    public $nombre = null,
        $slug = null,
        $precio = 1,
        $precio_real = 1,
        $descripcion = null,
        $informacion = null,
        $controla = null,
        $cultivos = null,
        $ingredientes = null,
        $estado = 1;

    protected $rules = [
        'categoria_id' => 'required',
        'subcategoria_id' => 'required',
        'marca_id' => 'required',
        'nombre' => 'required',
        'slug' => 'required|unique:productos',
        'precio' => 'required',
        'precio_real' => 'required',
        'descripcion' => 'required',
        'informacion' => 'required',
        'estado' => 'required',
        'imagen' => 'required|image',
    ];

    protected $validationAttributes = [
        'categoria_id' => 'categoria del producto',
        'subcategoria_id' => 'subcategoria del producto',
        'marca_id' => 'marca del producto',
        'nombre' => 'nombre del producto',
        'slug' => 'slug del producto',
        'precio' => 'precio de oferta del producto',
        'precio_real' => 'precio real del producto',
        'descripcion' => 'descripcion del producto',
        'informacion' => 'informacion del producto',
        'estado' => 'estado del producto',
        'imagen' => 'imagen del producto',
    ];

    protected $messages = [
        'categoria_id.required' => 'La :attribute es requerido.',
        'subcategoria_id.required' => 'La :attribute es requerido.',
        'marca_id.required' => 'La :attribute es requerido.',
        'nombre.required' => 'El :attribute es requerido.',
        'slug.required' => 'El :attribute es requerido.',
        'precio.required' => 'El :attribute es requerido.',
        'precio_real.required' => 'El :attribute es requerido.',
        'descripcion.required' => 'La :attribute es requerido.',
        'informacion.required' => 'La :attribute es requerido.',
        'estado.required' => 'El :attribute es requerido.',
        'imagen.required' => 'La :attribute es requerido.',
    ];

    public function mount()
    {
        $this->categorias = Categoria::all();
    }

    public function updatedCategoriaId($value)
    {
        $this->subcategorias = Subcategoria::where('categoria_id', $value)->get();

        $this->marcas = Marca::whereHas('categorias', function (Builder $query) use ($value) {
            $query->where('categoria_id', $value);
        })->get();

        $this->reset(['subcategoria_id', 'marca_id']);
    }

    public function updatedNombre($value)
    {
        $this->slug = Str::slug($value);
        $this->sku = trim(mb_strtoupper(mb_substr($value, 0, 2)) . "-" . "S" . rand(1, 500) . strtoupper(mb_substr($value, -2)));
    }

    public function updatedPrecioReal($value)
    {
        $this->precio = $value;
    }

    //Propiedad computada
    public function getSubcategoriaProperty()
    {
        return Subcategoria::find($this->subcategoria_id);
    }

    public function crearProducto()
    {
        $rules = $this->rules;

        $this->validate($rules);

        $producto = new Producto();

        $producto->subcategoria_id  = $this->subcategoria_id;
        $producto->marca_id  = $this->marca_id;
        $producto->nombre = $this->nombre;
        $producto->slug = $this->slug;
        $producto->precio = $this->precio;
        $producto->precio_real = $this->precio_real;
        $producto->descripcion = $this->descripcion;
        $producto->controla = $this->controla;
        $producto->cultivos = $this->cultivos;
        $producto->ingredientes = $this->ingredientes;

        $producto->informacion = $this->informacion;
        $producto->estado  = $this->estado;

        $producto->save();

        $imagenSubir = $this->imagen->store('productos');

        $producto->imagenes()->create([
            'imagen_ruta' => $imagenSubir
        ]);

        $this->emit('mensajeCreado', "El producto fué creado.");

        return redirect()->route('administrador.producto.editar', $producto);
    }

    public function render()
    {
        return view('livewire.administrador.producto.pagina-crear-producto-administrador')->layout('layouts.administrador.administrador');
    }
}
