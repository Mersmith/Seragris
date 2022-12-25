<header class="contenedor_navbar" x-data="sidebar" x-on:click.away="cerrarSidebar()">
    @php
        $json_menu = file_get_contents('menuFrontend.json');
        $menuPrincipal = collect(json_decode($json_menu, true));
    @endphp
    <!-- MENU CONTACTO -->
    <div class="menu-contacto">
        <div class="menu-contacto-opcion" style="border-right: 1px solid #f59f14;">
            <i class="fa-solid fa-phone-volume"></i>
            <span>617-3300</span>
        </div>
        <div class="menu-contacto-opcion">
            <i class="fa-solid fa-envelope"></i>
            <span> mersmith14@gmail.com</span>
        </div>
        <div class="menu-contacto-comprar  menu-contacto-ocultar">
            <i class="fa-solid fa-shop"></i>
            COMPRA AQUÍ
        </div>
    </div>
    <nav class="navbar">
        <!-- HAMBURGUESA -->
        <div x-on:click="abrirSidebar" class="contenedor_hamburguesa">
            <i class="fa-solid fa-bars" style="color: #666666;"></i>
        </div>
        <!-- LOGO -->
        <div class="contenedor_logo">
            <a href="{{ route('inicio') }}">
                <img src="{{ asset('imagenes/empresa/logo.png') }}" alt="" />
            </a>
        </div>
        <!-- MENU -->
        <div :class="{ 'block': abiertoSidebar, 'block': !abiertoSidebar }" class="contenedor_menu_link">
            <div class="sidebar_logo">
                <img src="{{ asset('imagenes/empresa/logo.png') }}" alt="" />
                <i x-on:click="cerrarSidebar" style="cursor: pointer; color: #666666;" class="fa-solid fa-xmark"></i>
            </div>
            <hr>
            <!-- MENU-PRINCIPAL -->
            <div class="menu_principal" x-on:click.away="seleccionado = null">
                @foreach ($menuPrincipal as $key => $menu)
                    <div x-data="subMenu1" class="elementos_menu_principal">

                        <!--Menu Nombres-->
                        <div x-on:click="seleccionar({{ $key }})" class="menu_icono">
                            @if (count($menu['subMenu1']))
                                <a class="menu_nombre">{{ $menu['nombrePrincipal'] }}</a>
                                <i class="fa-solid fa-sort-down"></i>
                            @else
                                <a class="menu_nombre" href="">{{ $menu['nombrePrincipal'] }}</a>
                            @endif
                        </div>
                        <!--SubMenu1-->
                        {{-- <div x-show="seleccionado == {{ $key }}" x-transition class="submenu_1" --}}
                        <div :style="seleccionado == {{ $key }} && { display: 'block' }" x-transition
                            class="submenu_1" x-on:click.away="seleccionadoSubMenu1 = null">
                            @if (count($menu['subMenu1']))
                                @foreach ($menu['subMenu1'] as $keySub1 => $subMenu1)
                                    <div x-data="subMenu2" class="elementos_submenu_1">

                                        <!--SubMenu1 Nombres-->
                                        <div x-on:click="seleccionarSubMenu1({{ $keySub1 }})"
                                            class="menu_icono menu_icono_submenu"
                                            :style="seleccionadoSubMenu1 == {{ $keySub1 }} && { background: '#f3f4f6' }">
                                            @if (count($subMenu1['subMenu2']))
                                                <a class="submenu_nombre">{{ $subMenu1['nombreSubMenu1'] }}</a>
                                                <i class="fa-solid fa-sort-down"></i>
                                            @else
                                                <a class="submenu_nombre"
                                                    href="">{{ $subMenu1['nombreSubMenu1'] }}</a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
                @if (Auth::user()->rol == 'administrador')
                    <div class="elementos_menu_principal">
                        <a href="{{ route('administrador.inicio') }}">
                            <i class="fa-solid fa-user"></i>
                        </a>
                    </div>
                @endif
            </div>

            <!-- <hr> -->

            <!-- FIN MENU-PRINCIPAL -->
        </div>
        <div class="contenedor_iconos">
            <div>
                <input type="text" placeholder="Buscar.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </nav>
</header>

@push('script')
    <script>
        function sidebar() {
            return {
                seleccionado: null,
                seleccionar(id) {
                    if (this.seleccionado == id) {
                        this.seleccionado = null;
                    } else {
                        this.seleccionado = id;
                    }
                },

                abiertoSidebar: false,
                toggleSidebar() {
                    this.abiertoSidebar = !this.abiertoSidebar
                },
                abrirSidebar() {
                    if (this.abiertoSidebar) {
                        this.abiertoSidebar = false;
                        document.querySelector(".contenedor_menu_link").style.left = "-100%";
                    } else {
                        this.abiertoSidebar = true;
                        document.querySelector(".contenedor_menu_link").style.left = "0";
                    }
                },
                cerrarSidebar() {
                    this.abiertoSidebar = false;
                    document.querySelector(".contenedor_menu_link").style.left = "-100%";
                }
            }
        }

        function subMenu1() {
            return {
                seleccionadoSubMenu1: null,
                seleccionarSubMenu1(id) {
                    if (this.seleccionadoSubMenu1 == id) {
                        this.seleccionadoSubMenu1 = null;
                    } else {
                        this.seleccionadoSubMenu1 = id;
                    }
                },
            }
        }

        function subMenu2() {
            return {
                seleccionadoSubMenu2: null,
                seleccionarSubMenu2(id) {
                    if (this.seleccionadoSubMenu2 == id) {
                        this.seleccionadoSubMenu2 = null;
                    } else {
                        this.seleccionadoSubMenu2 = id;
                    }
                },
            }
        }
    </script>
@endpush
