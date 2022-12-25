<footer class="contenedor_pie_pagina">
    <div class="contenedor_pie_contacto">
        <div class="contenedor_titulo">
            <h2>Contactate</h2>
            <h2>con nosotros</h2>
        </div>
        <div class="contenedor_contacto">
            <form action="" method="POST">
                @csrf
                @if (Session::has('email-contacto-correcto'))
                    <span style="color: white;">{{Session::get('email-contacto-correcto')}}</span>
                @endif
                <div>
                    <input type="text" name="nombre" placeholder=" Nombre" required>
                    @error('nombre')
                        <span>{{ $message }}</span>
                    @enderror

                </div>
                <div class="contenedor_inputs_dos">
                    <input type="email" name="email" placeholder=" Correo electrónico" required>
                    @error('email')
                        <span>{{ $message }}</span>
                    @enderror
                    <input type="tel" name="celular" placeholder="Celular" required>
                    @error('celular')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <textarea rows="8" name="mensaje" placeholder="Escribe aquí"></textarea>
                    @error('mensaje')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <button type="submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="contenedor_pie_informacion">
        <div class="contenedor_logo_telefono">
            <div class="contenedor_logo">
                <img src="http://127.0.0.1:8000/imagenes/empresa/logo.png" alt="logo htdent">
            </div>
            <div class="contenedor_numero_telefono">
                <i class="fa-solid fa-phone-volume"></i>
                <p>(+51) 476-2236</p>
            </div>
        </div>
        <div class="contenedor_informacion">
            <p>
                Es una empresa peruana dedicada a la venta de equipos RX portátil, Sensores RVG, Implantes, Mascarillas
                de la marca Pointnix, Vatech, Posdion, Kuwotech, Megagen, Air Qeen, Remedi.
            </p>
            <br>
            <p> Con el respaldo de las empresas H & T Med Dent, Digident.</p>
        </div>
        <div class="contenedor_mapa">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.022108599416!2d-76.9963534851842!3d-12.110638946389338!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c7e943e03771%3A0x5ecbb546309b30b5!2sC.%20Pablo%20Usandizaga%20683%2C%20Lima%2015037!5e0!3m2!1ses!2spe!4v1665780748976!5m2!1ses!2spe"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">

            </iframe>
        </div>
        <div class="contenedor_direccion">
            <p> Calle Pablo Usandizaga 683, San Borja, Lima, Perú </p>
        </div>
        <div class="contenedor_redes_sociales">
            <a href="https://www.facebook.com/htmed.dent" class="fa-brands fa-facebook"></a>
            <a href="https://www.instagram.com/htmeddent/" class="fa-brands fa-instagram"> </a>
            <a href="https://www.tiktok.com/@httv_oficial" class=" fa-brands fa-tiktok"> </a>
            <a href="https://www.youtube.com/channel/UC0hDbqQceq3Taouih7vOL9g" class=" fa-brands fa-youtube"> </a>
        </div>
    </div>
    <div class="contenedor_pie_derechos">
        <small> Todos los Derechos Reservados - &copy;2022 <strong> HT Dent </strong></small>
    </div>
</footer>
