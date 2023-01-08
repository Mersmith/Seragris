<div x-data="{
    url: '{{ route('shortlink.redirigir', $shortlink->slug) }}',
    copied: false,
    copyToClipBoard() {
        var copyText = document.createElement('input');
        copyText.setAttribute('type', 'text');
        copyText.setAttribute('value', this.url);
        document.body.appendChild(copyText);
        copyText.select();

        document.execCommand('copy');
        //Eliminamos el input
        document.body.removeChild(copyText);
        //Mostramos un mensaje de que se copio el texto
        this.copied = true;

        setTimeout(() => {
            this.copied = false;
        }, 2000);
    }
}">
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <span>{{ $shortlink->created_at->format('d M Y') }}</span>
    <h1>{{ $shortlink->titulo }} </h1>
    <p>{{ $shortlink->url }} </p>
    <p>Visitas: {{ $shortlink->visits->count() }} </p>
    <br>
    <hr>
    <br>
    <p>{{ route('shortlink.redirigir', $shortlink->slug) }}</p>
    <button x-on:click="copyToClipBoard()">
        <span class="ml-2" x-text="copied ? '¡Copiado!' : 'Copiar'"></span> </button>

    <br>
    <hr>
    <br>
    <p>VER</p>
    <a href="{{ route('shortlink.redirigir', $shortlink->slug) }}" target="_blank">

        Redirigir</a>

  

</div>
