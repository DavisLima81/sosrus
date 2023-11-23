@extends('front.layouts.app')
@section('content')
    <div class="container max-w-none grid grid-cols-12 gap-2 pt-12 rounded-top min-h-screen bg-gradient-to-br from-base-200 to-blue-900">
        <div class="col-span-2"></div>
        <div class="hero min-h-screen col-span-8 bg-base-200 p-0 m-0">
            <div class="hero-content flex-col lg:flex-row-reverse">
                <div class="text-center lg:text-left">
                    <h1 class="text-5xl font-bold text-orange-700 content-start">Cadastrar !</h1>
                    <div class="divider"></div>
                    <p class="pb-8 text-gray-200">Para seguir com o seu cadastro por favor forneça os dados solicitados.</p>
                    <span class="text-gray-200 py-4 pr-2">Já tem cadastro?</span>
                    <a href="{{route('filament.admin.home')}}" class="btn btn-sm btn-neutral">Fazer login</a>
                    <div class="divider"></div>
                    <p class="pb-8 text-gray-200">Ops! Algo inesperado ocorreu?</p>
                    <span class="text-gray-200 py-4">Contacte o administrador. Clicando</span>
                    <a href="{{route('falar-administrador')}}" class="btn btn-xs btn-neutral px-4">aqui</a>
                    <div class="divider"></div>
                    <a href="{{ route('welcome') }}" class="btn btn-sm btn-neutral px-4">Retornar</a>
                </div>
                <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                    <form class="card-body" action="{{route('valida-cadastrar')}}" method="POST">
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
                                <span class="label-text">Data de nascimento</span>
                            </label>
                            <input type="date" name="data_nascimento" id="data_nascimento" placeholder="Informe nascimento"
                                   value="{{old('nascimento')}}" class="input input-bordered" required/>
                            @if($errors->has('nascimento'))
                                <span class="text-red-500 text-xs italic">{{ $errors->first('nascimento') }}</span>
                            @endif
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Email</span>
                            </label>
                            <input type="email" name="email" id="email" placeholder="Informe email" class="input input-bordered" required />
                            @if($errors->has('email'))
                                <span class="text-red-500 text-xs italic">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Confirme email</span>
                            </label>
                            <input type="email" name="confirma_email" id="confirma_email" placeholder="Confirme email" class="input input-bordered" required />
                            @if($errors->has('confirma_email'))
                                <span class="text-red-500 text-xs italic">{{ $errors->first('confirma_email') }}</span>
                            @endif
                        </div>
                        <div class="form-control mt-6">
                            <button class="btn btn-outline btn-warning" type="submit">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-span-2"></div>
    </div>
@endsection
