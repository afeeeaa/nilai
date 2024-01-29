<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Ubah Profil') }}
        </h2>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form
        method="post"
        action="{{ route('profile.update') }}"
        class="mt-6 space-y-6"
    >
        @csrf
        @method('patch')

        <div class="space-y-2">
            <x-form.label
                for="name"
                :value="__('Nama')"
            />

            <x-form.input
                id="name"
                name="name"
                type="text"
                class="block w-full"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />

            <x-form.error :messages="$errors->get('name')" />
        </div>

        <div class="space-y-2">
            <x-form.label
                for="username"
                :value="__('Nama Pengguna')"
            />

            <x-form.input
                id="username"
                name="username"
                type="text"
                class="block w-full"
                :value="old('username', $user->username)"
                required
                autocomplete="username"
            />
            <x-form.error :messages="$errors->get('username')" />
            <br>
        <div class="flex items-center gap-4">
            <x-button>
                {{ __('Simpan') }}
            </x-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    class="text-sm text-gray-600 dark:text-gray-400"
                >
                    {{ __('Berhasil disimpan') }}
                </p>
            @endif
        </div>
    </form>
</section>
