<?php

namespace App\Http\Livewire\Administrador\Slider;

use App\Models\Imagen;
use App\Models\Slider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PaginaSliderAdministrador extends Component
{
        use WithFileUploads;

    public $sliders, $slider, $editarImagen;

    protected $listeners = ['eliminarSlider'];

    public $crearFormulario = [
        'link' => null,
        'estado' => null,
        'imagen_ruta' => null,
    ];

    public $editarFormulario = [
        'abierto' => false,
        'link' => null,
        'estado' => null,
        'imagen_ruta' => null,
        'posicion' => null,
    ];

    protected $rules = [
        'crearFormulario.estado' => 'required',
        'crearFormulario.imagen_ruta' => 'required|image|max:1024',
    ];

    public function mount()
    {
        $this->traerSlider();
    }

    public function traerSlider()
    {
        $this->sliders = Slider::orderBy('posicion', 'asc')->get();
    }

    public function crearSlider()
    {
        $this->validate();

        $imagen = $this->crearFormulario['imagen_ruta']->store('sliders');

        $slider = Slider::create([
            'link' => $this->crearFormulario['link'],
            'estado' => $this->crearFormulario['estado'],
            'posicion' => $this->sliders->count() + 1
        ]);

        $slider->imagenes()->create([
            'imagen_ruta' => $imagen
        ]);

        $this->traerSlider();

        $this->emit('mensajeCreado', "Slider agregado.");
        $this->reset('crearFormulario');
    }

    public function editarSlider(Slider $slider)
    {
        //Reinicia el valor de la variable
        $this->reset(['editarImagen']);
        //Borrar los errores de las claves
        //$this->resetValidation();

        $this->slider = $slider;

        $this->editarFormulario['abierto'] = true;
        $this->editarFormulario['link'] = $slider->link;
        $this->editarFormulario['estado'] = $slider->estado;
        $this->editarFormulario['posicion'] = $slider->posicion;
        $this->editarFormulario['imagen_ruta'] = $slider->imagenes->first()->imagen_ruta;
    }

    public function actualizarSlider()
    {
        if ($this->editarFormulario['link']) {
            $rules['editarFormulario.link'] = 'required';
        }

        $rules = [
            'editarFormulario.estado' => 'required',
        ];

        if ($this->editarImagen) {
            $rules['editarImagen'] = 'required|image|max:1024';
        }

        $this->validate($rules);

        if ($this->editarImagen) {
            Storage::delete([$this->slider->imagenes->first()->imagen_ruta]);

            $imagenBusqueda = Imagen::find($this->slider->imagenes->first()->id);
            $imagenBusqueda->delete();

            $imagenNueva = $this->editarImagen->store('sliders');

            $this->slider->imagenes()->create([
                'imagen_ruta' => $imagenNueva
            ]);
        }

        $this->slider->update([
            'link' => $this->editarFormulario['link'],
            'estado' => $this->editarFormulario['estado']
        ]);

        $this->reset(['editarFormulario', 'editarImagen']);

        $this->traerSlider();

        $this->emit('mensajeActualizado', "El Slider ha sido actualizado.");
    }

    public function eliminarSlider(Slider $sliderSelect)
    {
        Storage::delete([$sliderSelect->imagenes->first()->imagen_ruta]);

        $imagenBusqueda = Imagen::find($sliderSelect->imagenes->first()->id);
        $imagenBusqueda->delete();

        $sliderSelect->delete();
        $this->traerSlider();
    }


    public function render()
    {
        return view('livewire.administrador.slider.pagina-slider-administrador')->layout('layouts.administrador.administrador');
    }
}
