@extends('front.layouts.app')
@section('content')
    <div class="container max-w-none grid grid-cols-12 gap-2 pt-12 rounded-top min-h-screen bg-gradient-to-br from-base-200 to-blue-900">
        <div class="col-span-2"></div>
        <div class="hero min-h-screen col-span-8 p-0 m-0">
            <div class="card shrink-0 w-full max-w-lg shadow-2xl bg-base-100">
                <h2 class="p-6 text-5xl font-bold text-orange-700 content-center text-center">Entrar em contato</h2>
                <div class="divider p-2"></div>
                <p class="py-2 px-8 text-gray-200">Envie sua mensagem para que possamos ajudá-lo. Resolveremos o
                    problema e a seguir retornaremos seu contato.</p>
                <form class="card-body" action="{{route('falar-administrador')}}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">RG</span>
                        </label>
                        <input type="text" inputmode="numeric" pattern="\d*" name="rg" id="rg" placeholder="5 dígitos, somente nº"
                               value="{{old('rg')}}" class="input input-bordered number" required />
                        @if($errors->has('rg'))
                            <span class="text-red-500 text-xs italic">{{ $errors->first('rg') }}</span>
                        @endif
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Posto/graduação e nome de guerra</span>
                        </label>
                        <input type="text" name="guerra" id="guerra" placeholder="Ex. Cap BM Silva"
                               value="{{old('guerra')}}" class="input input-bordered number" required />
                        @if($errors->has('guerra'))
                            <span class="text-red-500 text-xs italic">{{ $errors->first('guerra') }}</span>
                        @endif
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" name="email" id="email" placeholder="Informe email" class="input input-bordered"
                               value="{{old('email')}}" required />
                        @if($errors->has('email'))
                            <span class="text-red-500 text-xs italic">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Mensagem</span>
                            <span class="label-text-alt">Por favor descreva o problema</span>
                        </label>
                        <textarea class="textarea textarea-warning" id="mensagem" name="mensagem" rows="10" required
                            >{{old('mensagem')}}</textarea>
                        @if($errors->has('mensagem'))
                            <span class="text-red-500 text-xs italic">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-control mt-6">
                        <button class="btn btn-outline btn-warning" type="submit">Enviar</button>
                    </div>
                    <div class="divider px-2"></div>
                    <div class="section grid-cols-2">
                        <a href="{{route('pre-cadastrar')}}" class="btn btn-sm btn-neutral px-4">Voltar</a>
                        <a href="{{route('welcome')}}" class="btn btn-sm btn-neutral px-4">Início</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-span-2"></div>
    </div>
@endsection
