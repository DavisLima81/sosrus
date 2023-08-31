<x-filament-panels::page>

    @if(auth()->user()->hasRole('super_admin'))
        super-admin
    <livewire:seletor-mes />
    @elseif(auth()->user()->hasRole('filament_user'))
        user
    @else
        guest
    @endif

    {{--se existir $do_ano_mes_id e $ano exibir calendario --}}
    <livewire:caledario />


</x-filament-panels::page>
