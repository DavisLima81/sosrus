<x-filament-panels::page>

    @if(auth()->user()->hasRole('super_admin'))
        super-admin
    <livewire:seletor-mes />
    @elseif(auth()->user()->hasRole('filament_user'))
        user
    @else
        guest
    @endif

</x-filament-panels::page>
