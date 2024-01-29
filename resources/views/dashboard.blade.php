<x-app-layout>
    <head>
        <title>{{ isset($webTitle) ? $webTitle . ' - ' : '' }}Dashboard</title>
    </head>

<x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
            {{ $pageTitle ?? __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        {{ __("Halo, Selamat Datang!")  }}
    </div>
</x-app-layout>
