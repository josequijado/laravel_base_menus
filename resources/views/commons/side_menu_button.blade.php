{{-- Botón para abrir y cerrar el menú lateral --}}
@auth
    @if ($side_menu->permissions()->count() > 0)
        <div id="sideMenuButtonWrapper">
            <div id="sideMenuButton"><span></span><span></span><span></span></div>
        </div>
    @endif
@endauth
{{-- /Botón para abrir y cerrar el menú lateral --}}
