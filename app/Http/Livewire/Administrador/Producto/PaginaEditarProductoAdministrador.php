<?php

namespace App\Http\Livewire\Administrador\Producto;

use App\Models\Categoria;
use App\Models\Ficha;
use App\Models\Hoja;
use App\Models\Imagen;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Subcategoria;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class PaginaEditarProductoAdministrador extends Component
{
    use WithFileUploads;

    protected $listeners = ['editarProducto', 'eliminarProducto'];

    public $producto, $categorias, $subcategorias, $marcas;
    public $editar_imagen, $editar_ficha_tecnica, $editar_hoja_seguridad;
    public $imagen, $ficha_tecnica, $hoja_seguridad;
    public $categoria_id;
    public  $slug,
        $controla,
        $cultivos,
        $ingredientes;

    public $ficha, $hoja;

    protected $rules = [
        'categoria_id' => 'required',
        'producto.subcategoria_id' => 'required',
        'producto.marca_id' => 'required',
        'producto.nombre' => 'required',
        'slug' => 'required|unique:productos,slug',
        'producto.precio' => 'required',
        'producto.precio_real' => 'required',
        'producto.descripcion' => 'required',
        'producto.informacion' => 'required',
        //'imagen' => 'required|image',
    ];

    protected $validationAttributes = [
        'categoria_id' => 'categoria del producto',
        'producto.subcategoria_id' => 'subcategoria del producto',
        'producto.marca_id' => 'marca del producto',
        'producto.nombre' => 'nombre del producto',
        'slug' => 'slug del producto',
        'producto.precio' => 'precio de oferta del producto',
        'producto.precio_real' => 'precio real del producto',
        'producto.descripcion' => 'descripcion del producto',
        'producto.informacion' => 'informacion del producto',
        'imagen' => 'imagen del producto',
    ];

    protected $messages = [
        'categoria_id.required' => 'La :attribute es requerido.',
        'producto.subcategoria_id.required' => 'La :attribute es requerido.',
        'producto.marca_id.required' => 'La :attribute es requerido.',
        'producto.nombre.required' => 'El :attribute es requerido.',
        'slug.required' => 'El :attribute es requerido.',
        'producto.precio.required' => 'El :attribute es requerido.',
        'producto.precio_real.required' => 'El :attribute es requerido.',
        'producto.descripcion.required' => 'La :attribute es requerido.',
        'producto.informacion.required' => 'La :attribute es requerido.',
        'imagen.required' => 'La :attribute es requerido.',
    ];

    public function mount(Producto $producto)
    {
        $this->producto = $producto;

        $this->categorias = Categoria::all();

        $this->categoria_id = $producto->subcategoria->categoria->id;

        $this->subcategorias = Subcategoria::where('categoria_id', $this->categoria_id)->get();

        $this->slug = $this->producto->slug;
        $this->controla = $this->producto->controla;
        $this->cultivos = $this->producto->cultivos;
        $this->ingredientes = $this->producto->ingredientes;

        $this->marcas = Marca::whereHas('categorias', function (Builder $query) {
            $query->where('categoria_id', $this->categoria_id);
        })->get();
    }

    public function updatedCategoriaId($value)
    {
        $this->subcategorias = Subcategoria::where('categoria_id', $value)->get();

        $this->marcas = Marca::whereHas('categorias', function (Builder $query) use ($value) {
            $query->where('categoria_id', $value);
        })->get();

        $this->producto->subcategoria_id  = "";
        $this->producto->marca_id  = "";
    }

    public function updatedProductoNombre($value)
    {
        $this->slug = Str::slug($value);
    }

    public function getSubcategoriaProperty()
    {
        return Subcategoria::find($this->producto->subcategoria_id);
    }

    public function eliminarFicha()
    {
        if ($this->producto->fichas->count()) {
            $fichas = $this->producto->fichas;
            foreach ($fichas as $fichaItem) {
                Storage::delete($fichaItem->ficha_ruta);
                $fichaItem->delete();
            }
            $this->reset(['ficha']);

            $this->producto = $this->producto->fresh();

            $this->emit('mensajeEliminado', "Ficha Eliminado");
        }
    }

    public function eliminarHoja()
    {
        if ($this->producto->hojas->count()) {
            $hojas = $this->producto->hojas;
            foreach ($hojas as $hojaItem) {
                Storage::delete($hojaItem->hoja_ruta);
                $hojaItem->delete();
            }
            $this->reset(['hoja']);

            $this->producto = $this->producto->fresh();

            $this->emit('mensajeEliminado', "Hoja Eliminado");
        }
    }

    public function editarProducto()
    {
        $rules = $this->rules;
        $rules['slug'] = 'required|unique:productos,slug,' . $this->producto->id;

        if ($this->editar_imagen) {
            $rules['editar_imagen'] = 'required|image';
        }

        if ($this->ficha) {
            $rules['ficha'] = 'required|file|mimes:pdf';
        }

        if ($this->hoja) {
            $rules['hoja'] = 'required|file|mimes:pdf';
        }

        $this->validate($rules);

        $this->producto->slug = $this->slug;
        $this->producto->controla = $this->controla;
        $this->producto->cultivos = $this->cultivos;
        $this->producto->ingredientes = $this->ingredientes;

        $this->producto->update();


        if ($this->editar_imagen) {
            Storage::delete([$this->producto->imagenes->first()->imagen_ruta]);

            $imagenBusqueda = Imagen::find($this->producto->imagenes->first()->id);
            $imagenBusqueda->delete();

            $imagenNueva = $this->editar_imagen->store('productos');

            $this->producto->imagenes()->create([
                'imagen_ruta' => $imagenNueva
            ]);
        }

        if ($this->ficha) {
            if ($this->producto->fichas->count()) {
                Storage::delete([$this->producto->fichas->first()->ficha_ruta]);

                $fichaBusqueda = Ficha::find($this->producto->fichas->first()->id);
                $fichaBusqueda->delete();
            }

            $fichaNueva = $this->ficha->store('fichas');

            $this->producto->fichas()->create([
                'ficha_ruta' => $fichaNueva
            ]);
        }

        if ($this->hoja) {
            if ($this->producto->hojas->count()) {
                Storage::delete([$this->producto->hojas->first()->hoja_ruta]);

                $hojaBusqueda = Hoja::find($this->producto->hojas->first()->id);
                $hojaBusqueda->delete();
            }

            $hojaNueva = $this->hoja->store('hojas');

            $this->producto->hojas()->create([
                'hoja_ruta' => $hojaNueva
            ]);
        }

        $this->emit('mensajeActualizado', "El producto ha sido actualizado.");
    }

    public function eliminarProducto()
    {
        $imagenes = $this->producto->imagenes;

        foreach ($imagenes as $imagen) {
            Storage::delete($imagen->imagen_ruta);
            $imagen->delete();
        }

        if ($this->producto->fichas->count()) {
            $fichas = $this->producto->fichas;
            foreach ($fichas as $fichaItem) {
                Storage::delete($fichaItem->ficha_ruta);
                $fichaItem->delete();
            }
        }

        if ($this->producto->hojas->count()) {
            $hojas = $this->producto->hojas;
            foreach ($hojas as $hojaItem) {
                Storage::delete($hojaItem->hoja_ruta);
                $hojaItem->delete();
            }
        }

        $this->producto->delete();

        return redirect()->route('administrador.producto.index');
    }

    public function render()
    {
        return view('livewire.administrador.producto.pagina-editar-producto-administrador')->layout('layouts.administrador.administrador');
    }
}
