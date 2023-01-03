<footer class="contenedor_pie_pagina">
    <div class="contenedor_pie_contacto">
        <div class="contenedor_titulo">
            <h2>Contacta</h2>
            <h2>con nosotros</h2>
        </div>
        <div class="contenedor_contacto">
            <form action="" method="POST">
                @csrf
                @if (Session::has('email-contacto-correcto'))
                    <span style="color: white;">{{ Session::get('email-contacto-correcto') }}</span>
                @endif
                <div>
                    <input type="text" name="nombre" placeholder="Nombres" required>
                    @error('nombre')
                        <span>{{ $message }}</span>
                    @enderror

                </div>
                <div class="contenedor_inputs_dos">
                    <input type="email" name="email" placeholder="Correo electrónico" required>
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
            <div class="contenedor_numero_telefono">
                <i class="fa-solid fa-envelope"></i>
                <p> <a href="mailto:info@seragris.com"><span>info@seragris.com</span></a>
                </p>
            </div>
            <div class="contenedor_numero_telefono">
                <i class="fa-solid fa-phone-volume"></i>
                <p> <a href="tel:+51993 796 221"><span>993 796 221</span></a>
                </p>
            </div>
        </div>
        <div class="contenedor_informacion">
            <p>
                SERAGRIS es una empresa peruana dedicada a la comercialización de insumos
                agrícolas y Cultivo de arroz .
            </p>
            <br>
            <p> Nuestra razón de Ser es brindar soluciones al agricultor en las diferentes etapas
                de sus cultivos que aseguren rentabilidad y productividad, en la cual proveemos
                de servicios y productos a la medida de las necesidades del campo para lograr
                una producción inteligente y sustentable.
                En estos años hemos construido alianzas estratégicas con las principales
                marcas del mercado que nos brindan insumos de calidad, empresas que
                aseguran rentabilidad y productividad en nuestros cultivos</p>
        </div>
        <div class="contenedor_mapa">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d720815.078304992!2d-80.9492742135048!3d-3.592437273089929!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9033f3662874b48d%3A0x86a8e7d32ad3ea79!2sC.%20Hilario%20Carrasco%20422%2C%20Corrales%2024501!5e0!3m2!1ses-419!2spe!4v1672753232159!5m2!1ses-419!2spe"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="contenedor_direccion">
            <p> Jr. Hilario Carrasco 422 No Corrales, Peru </p>
        </div>
        <div class="contenedor_redes_sociales">
            <a href="https://www.facebook.com/Seragris" class="fa-brands fa-facebook" target="_blank"></a>
            <a href="https://www.instagram.com/seragrisperu/" class="fa-brands fa-instagram" target="_blank"> </a>
            <a href="https://www.tiktok.com/@seragrisperu" class=" fa-brands fa-tiktok" target="_blank"> </a>
            {{-- <a href="https://www.youtube.com/channel/UC0hDbqQceq3Taouih7vOL9g" class=" fa-brands fa-youtube" target="_blank"> </a> --}}
        </div>
    </div>
    <div class="contenedor_pie_derechos">
        <small> Todos los Derechos Reservados - &copy;2023 <strong> Seragris </strong></small>
    </div>
</footer>
