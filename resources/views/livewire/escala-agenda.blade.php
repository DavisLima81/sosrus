<div>

    {{--@if($mes_nome != null && $mes_nome != 'MES_MOUNT_SELETOR')--}}
    <div>
        <div class="grid h-10 flex-grow bg-gray-600 place-items-top justify-center">
            {{--<span class="py-1" wire:model.live="mes"><strong> {{ mb_strtoupper($mes_nome)}} - {{ $ano }} </strong></span>--}}
        </div>
        <hr class="my-1 border-gray-600">
        {{-- region CABEÇALHO COM OS NOMES DE DIAS DA SEMANA --}}
        <div class="grid grid-cols-7 gap-1 py-1">
            <div class="grid h-10 flex-grow bg-gray-600 place-items-top justify-center">
                <span class="py-1"><strong>SEG</strong></span>
            </div>
            <div class="grid h-10 flex-grow bg-gray-600 place-items-top justify-center">
                <span class="py-1"><strong>TER</strong></span>
            </div>
            <div class="grid h-10 flex-grow bg-gray-600 place-items-top justify-center">
                <span class="py-1"><strong>QUA</strong></span>
            </div>
            <div class="grid h-10 flex-grow bg-gray-600 place-items-top justify-center">
                <span class="py-1"><strong>QUI</strong></span>
            </div>
            <div class="grid h-10 flex-grow bg-gray-600 place-items-top justify-center">
                <span class="py-1"><strong>SEX</strong></span>
            </div>
            <div class="grid h-10 flex-grow bg-gray-400 place-items-top justify-center">
                <span class="py-1 text-primary-600"><strong>SAB</strong></span>
            </div>
            <div class="grid h-10 flex-grow bg-gray-400 place-items-top justify-center">
                <span class="py-1 text-primary-600"><strong>DOM</strong></span>
            </div>
        </div>
        {{-- endregion CABEÇALHO COM OS NOMES DE DIAS DA SEMANA --}}
        {{-- region DIAS DO MÊS SEMANA --}}
        <div class="grid grid-cols-7 gap-1">
            {{--@foreach($cell as $key => $value)--}}
            <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 border-gray-600 px-2">
                <p class="justify-self-center"><strong>
                        {{--@if(is_string($value) | is_int($value))
                            {{ $value }}
                        @elseif(is_array($value))
                            {{ ($value[0])[0] }}
                        @endif--}}
                    </strong></p>
                <hr class="my-1 border-gray-600">
                {{--@if(is_array($value))
                    <div class="bg-gray-900 p-2 rounded">
                        <small class="justify-self-center text-center text-amber-600">
                            {{ ($value[0])[1] }}
                        </small>
                    </div>
                @endif--}}
            </div>
            {{--@endforeach--}}
        </div>
        {{-- endregion DIAS DO MÊS SEMANA --}}
    </div>
    {{--@endif()--}}

</div>
