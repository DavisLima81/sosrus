<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title> TESTE LIVEWIRE </title>

    {{-- Daisy UI stylesheet --}}
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.6.4/dist/full.css" rel="stylesheet" type="text/css" />
    {{-- Livewire stylesheet --}}
    @livewireStyles
</head>

<body>
<div class="my-16 mx-16 py-4 px-4">

    <div class="col-8">
        @yield('content')
    </div>

</div>



@livewireScripts
<script src="https://cdn.tailwindcss.com"></script>
</body>
