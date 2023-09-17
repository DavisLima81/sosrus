<div>
    {{--<h3><strong>{{$mes}}</strong></h3>--}}
    <div class="inline-grid grid-cols-6 gap-1 form-control">
        <div>
            <label class="label">
                <span class="label-text-alt">ANO</span>
            </label>
            <select wire:model.live="ano" wire:click="" class="select select-warning">

                <label for="ano">ANO</label>
                <option value="">Ano</option>
                @if($anos && is_object($anos))
                    @foreach($anos as $ano)
                        <option wire:key="{{$ano}}">{{$ano}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="px-3">
            @if(!is_null($meses))
                <label class="label">
                    <span class="label-text-alt">MÊS</span>
                </label>
                <select wire:model.live="mes" class="select select-warning">
                    <option value="">Mês</option>
                    @if($meses && is_object($meses))
                        @foreach($meses as $mes)
                            <option wire:key="{{$mes->id}}">{{$mes->do_ano_mes_id}}</option>
                        @endforeach
                    @endif

                </select>
            @endif
        </div>
    </div>
    <br><br>
    <div>
        <button x-on:click="$wire.ano = ''; $wire.mes = '';" class="btn btn-sm btn-neutral">Refresh</button>
    </div>
    <br>

</div>


