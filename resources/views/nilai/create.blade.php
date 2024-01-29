
<x-app-layout>
    <head>
        <title>{{ isset($webTitle) ? $webTitle . ' - ' : '' }}Tambah Data</title>
    </head>   
<body class="bg-light">
    <main class ="container">
        @if (Session::has('success'))
        <div class="pt-3">
            <div class=".alert alert-success">
             {{session::get('success')}}
        </div>
        @endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Tambah Data') }}
        </h2>
    </x-slot>


    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-xl">
            
            @if($errors->any())
    <div class="pt-3">
            <ul>
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
        <form
            method="post"
            action="{{ url('nilai') }}"
            enctype="multipart/form-data"
            class="mt-6 space-y-6"
        >

        @csrf

             <div class="space-y-2">
                 <x-form.label
                     for="no_reg"
                      :value="__('No. Registrasi')"
                  />

                <x-form.input
                    id="no_reg"
                    name="no_reg"
                    type="text"
                    class="block w-full"
                />
             </div>


             <div class="space-y-2">
                <x-form.label
                    for="email"
                    :value="__('Email')"
              />

                <x-form.input
                    id="email"
                    name="email"
                    type="email"
                    class="block w-full"
                />
             </div>

             <div class="space-y-2">
                <x-form.label
                    for="Nama"
                    :value="__('Nama')"
              />

                <x-form.input
                    id="nama"
                    name="nama"
                    type="text"
                    class="block w-full"
                />
             </div>
             
             <div class="space-y-2">
                                <x-form.label
                                    for="dokumen"
                                    :value="__('Lembar Jawab')"
                                />

                                <x-form.input
                                    id="dokumen"
                                    name="dokumen"
                                    type="file"
                                    class="block w-full border p-2"
                                    accept=".xls,.xlsx,.csv"
                                />
                            </div>

        <div class="flex items-center gap-4">
    <x-button class="bg-blue-500 text-white hover:bg-blue-500">
        {{ __('Simpan') }}
        
    </x-button>
</div>
            </div>
        </div>
</form>
</x-app-layout>