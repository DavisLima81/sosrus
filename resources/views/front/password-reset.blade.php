@extends('front.layouts.app')
@section('content')
    <div class="container max-w-none grid grid-cols-12 gap-2 pt-12 rounded-top min-h-screen bg-gradient-to-br from-base-200 to-blue-900">
        <div class="col-span-2"></div>
        <div class="hero min-h-screen col-span-8 bg-base-200 p-0 m-0">
            <div class="hero-content flex-col lg:flex-row-reverse">
                <div class="text-center lg:text-left">
                    <h1 class="text-5xl font-bold text-orange-700 content-start">Recuperar senha!</h1>
                    <div class="divider"></div>
                    <p class="pb-8 text-gray-200">Por favor forneça os dados solicitados e um email de recuperação será enviado.</p>
                    <span class="text-gray-200 py-4 pr-2">Tudo bem com o cadastro?</span>
                    <a href="{{route('filament.admin.home')}}" class="btn btn-sm btn-neutral">Fazer login</a>
                    @if(\Session::has('status'))
                        <br>
                        <span class="text-red-500 text-xs italic">{{ \Session::get('status') }}</span>
                    @endif
                    <div class="divider"></div>
                    <p class="pb-8 text-gray-200">Ops! Algo inesperado ocorreu?</p>
                    <span class="text-gray-200 py-4">Contacte o administrador. Clicando</span>
                    <a href="{{route('falar-administrador')}}" class="btn btn-xs btn-neutral px-4">aqui</a>
                    <div class="divider"></div>
                    <a href="{{ route('welcome') }}" class="btn btn-sm btn-neutral px-4">Retornar</a>
                </div>
                <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                    <form class="card-body" action="{{route('senha-recuperada')}}" method="POST">
                        @method('POST')
                        @csrf
                        <div class="form-control">
                            <input type="text" name="token" id="token" value="{{$token}}" hidden>
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Email</span>
                            </label>
                            <input type="email" name="email" id="email" placeholder="Informe email" class="input input-bordered" required
                            value="{{$email}}"/>
                            @if($errors->has('email'))
                                <span class="text-red-500 text-xs italic">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Nova senha</span>
                            </label>
                            <input type="password" name="password" id="password" placeholder="Informe nova senha"
                                   class="input input-bordered" required/>
                            @if($errors->has('password'))
                                <span class="text-red-500 text-xs italic">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Confirme senha</span>
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirme a senha"
                                   class="input input-bordered" required/>
                            @if($errors->has('password_confirmation'))
                                <span class="text-red-500 text-xs italic">{{ $errors->first('password_confirmation') }}</span>
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
