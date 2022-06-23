<x-master-layout>
    <div class="flex-1">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{ __('Users') }}
</h2>
<a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
    {{ __('Back') }}
</a>
</x-slot>

<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg md:px-6 md:py-4">
            @if(session()->has('error'))
                <div class="bg-red-100 p-4 font-bold text-red-600 mb-4">{{ session()->get('error') }}</div>
            @endif
            <form method="POST" action="{{ route('users.password.update', $user->id) }}">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-jet-label class="font-bold" for="name" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" value="{{ old('password') }}" autofocus autocomplete="password" />
                        @error('password')
                            <span class="text-red-500 font-bold mt-1 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-jet-label class="font-bold" for="name" value="{{ __('Confirm Password') }}" />
                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" value="" autofocus autocomplete="password_confirmation" />
                        @error('password_confirmation')
                        <span class="text-red-500 font-bold mt-1 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-jet-button class="ml-4">
                        {{ __('Update') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</x-master-layout>
