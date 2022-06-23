<x-master-layout>
    <div class="flex-1">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{ __('Projects') }}
</h2>
<a href="{{ route('admin.projects.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
    {{ __('Back') }}
</a>
</x-slot>

<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg md:px-6 md:py-4">
            @if(session()->has('error'))
                <div class="bg-red-100 p-4 font-bold text-red-600 mb-4">{{ session()->get('error') }}</div>
            @endif
            <form method="POST" action="{{ route('admin.projects.update', $project->id) }}">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-jet-label class="font-bold" for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $project->name }}" autofocus autocomplete="name" />
                        @error('name')
                            <span class="text-red-500 font-bold mt-1 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-jet-label class="font-bold" for="password" value="{{ __('Status') }}" />
                        <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>{{ __('Choose a status') }}</option>
                            <option value="1" {{ $project->status == 1 ? 'selected' : '' }}>{{__('Active')}}</option>
                            <option value="0" {{ $project->status == 0 ? 'selected' : '' }}>{{__('Inactive')}}</option>
                        </select>
                        @error('status')
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
