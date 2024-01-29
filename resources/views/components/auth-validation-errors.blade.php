@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">
            {{ __('Terdapat Kesalahan') }}
        </div>
    </div>
@endif
