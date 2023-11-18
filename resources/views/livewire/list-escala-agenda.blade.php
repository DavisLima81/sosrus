
<form wire:submit="click" method="post" class="flex flex-col w-full border-opacity-50" autocomplete="off">
    @csrf
    <div class="grid lg:grid-cols-3 sm:grid-cols-1 gap-4 h-20 card bg-black/50 rounded-box place-items-stretch">
        <div class="form-control w-full m-2">
            <label class="label">
                <span class="label-text">Escala</span>
            </label>
            <select wire:model.live="escala" class="select select-warning" required>
                <option selected>Escolha escala</option>
                @foreach($escalas as $escala)
                    <option value="{{ $escala->id }}">{{$escala->guarnicao->sigla . ' - ' . $escala->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-control w-full m-2">
            <label class="label">
                <span class="label-text">Mês</span>
            </label>
            <select wire:model.live="do_ano_mes" class="select select-warning" required>
                <option selected>Escolha mês</option>
                @foreach($do_ano_meses as $do_ano_mes)
                    <option value="{{ $do_ano_mes->id }}">{{ $do_ano_mes->id . '- ' . $do_ano_mes->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-control w-ful m-2">
            <label class="label">
                <span class="label-text">Ano</span>
            </label>
            <select wire:model.live="ano" class="select select-warning">
                <option selected>Escolha ano</option>
                @foreach($anos as $ano)
                    <option value="{{ $ano }}">{{ $ano }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="grid lg:grid-cols-8 sm:grid-cols-1 rounded-box place-items-stretch pt-6 px-2">
        <button type="submit" class="btn btn-sm">Visualizar</button>
    </div>
    <div class="divider"></div>
</form>

