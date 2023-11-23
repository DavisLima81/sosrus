@extends('front.layouts.app')
@section('content')
    <div class="container max-w-none grid grid-cols-12 gap-2 pt-12 rounded-top min-h-screen bg-gradient-to-br from-base-200 to-blue-900">
        <div class="col-span-2"></div>
        <div class="hero min-h-screen col-span-8 p-0 m-0">
            <div class="card shrink-0 w-full max-w-lg shadow-2xl bg-base-100">
                <h2 class="p-6 text-5xl font-bold text-orange-700 content-center text-center">Cadastro realizado</h2>
                <div class="divider p-2"></div>
                <p class="py-2 px-8 text-gray-200">Seu cadastro foi efetivado com sucesso!</p>
                <p class="py-2 px-8 text-gray-200">Um email de confirmação foi enviado contendo os dados de acesso.</p>
                <div class="card-body" action="{{route('filament.admin.home')}}">
                    <div class="divider px-2"></div>
                    <div class="section grid-cols-2">
                        <a href="{{route('welcome')}}" class="btn btn-sm btn-neutral px-4">Recomeçar</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-span-2"></div>
@endsection
