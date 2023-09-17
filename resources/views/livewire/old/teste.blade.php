
{{-- Be like water. --}}

<div>
    {{$ano}}<br>
    {{$texto}}<br>

    <form>
        @csrf
        <label class="label">
            <span class="label-text-alt">ANO</span>
        </label>
        <select id="ano" wire:model.live="ano" class="select select-warning">

            <label for="ano">ANO</label>
            <option value="">Selecione...</option>
            @foreach($anos as $ano)
                <option wire:key="{{$ano}}">{{$ano}}</option>
            @endforeach
        </select>
        <br>
        <label class="label">
            <span class="label-text-alt">TEXTO</span>
        </label>
        <input type="text" id="texto" wire:model.live="texto"/>

        <br><br>
        <button type="submit" class="btn btn-accent">Save</button>
    </form>
</div>

