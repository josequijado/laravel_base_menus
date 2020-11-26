@if ($side_menu->permissions() != null)
    <div id="menu-container">
        <ul class="menu-list accordion">
            @foreach ($side_menu->permissions() as $permission)
                <li class="toggle accordion-toggle">
                    <span class="icon-plus"></span>
                    <a class="menu-link" href="#">{{ __("general/menu_lateral.$permission->rotulo") }}</a>
                </li>
                {{-- accordion-toggle --}}
                <ul class="menu-submenu accordion-content">
                    @foreach ($permission->opciones as $opcion)
                        <li>
                            <a class="head" href="{{ route($opcion->ruta) }}">
                                {{ __("general/menu_lateral.$opcion->rotulo") }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                {{-- menu-submenu accordon-content--}}
            @endforeach
        </ul>
    </div>
    {{-- menu-container --}}
@endif


