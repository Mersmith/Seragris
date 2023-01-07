<x-frontend-layout>
    @section('tituloPagina', 'Blog')

    <div class="contenedor_blog_items">
        @foreach ($posts as $post)
            <!--1-->
            <article>
                <img src="{{ Storage::url($post->imagen->imagen_ruta) }}" alt="">
                <div class="blog_items_contenido">
                    <div>
                        @foreach ($post->tags as $tag)
                            <a href="">
                                {{ $tag->nombre }}
                            </a>
                        @endforeach
                    </div>
                    <h2>
                        <a href="{{ route('blog.post', $post) }}">
                            {{ $post->nombre }}
                        </a>
                    </h2>
                </div>
            </article>
        @endforeach
    </div>
</x-frontend-layout>
