@extends('front.layouts.app')
@section('content')
<div class="container max-w-none min-h-screen bg-gradient-to-br from-base-200 to-blue-900">
    @if(Auth::check())
        <div class="navbar bg-base-100">
            <div class="flex-1">
                {{--criar botão com form method POST--}}
                <form action="{{ route('filament.admin.auth.logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-ghost text-xl">Logout</button>
                </form>
            </div>
            <div class="flex-none">
                <a href="{{ env('APP_URL') . "/admin" }}" class="btn btn-neutral">Retornar</a>
            </div>
        </div>
    @endif
    <div class="hero">


        <div class="hero-content text-center">
            <div class="max-w-md pt-24">
                <h1 class="text-8xl font-bold text-orange-600 mt-12">SOS 'r us </h1>
                <p class="pt-3 pb-16 text-gray-300">Nossa coordenação de serviços de socorro e expediente</p>
                @if(!Auth::check())
                    <a href="{{ route('filament.admin.home') }}" class="btn btn-sm btn-outline btn-warning">Login</a>
                    <a href="{{ route('pre-cadastrar') }}" class="btn btn-sm btn-outline btn-warning ml-4">Cadastrar</a>

                @endif
            </div>
        </div>
    </div>
</div>
@endsection
