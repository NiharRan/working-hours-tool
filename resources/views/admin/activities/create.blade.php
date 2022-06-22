<x-master-layout>
    <div class="flex-1">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{ __('Activities') }}
</h2>
<a href="{{ route('admin.activities.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
    {{ __('Back') }}
</a>
</x-slot>

<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg md:px-6 md:py-4">
            <form action="{{ route('activities.store') }}" method="post">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <select name="user_id" class="border border-gray-200 w-full rounded-md">
                            <option value="">{{ __('Choose  a user') }}</option>
                            @foreach($users as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <span class="text-red-500 font-bold mt-1 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <select name="project_id" class="border border-gray-200 w-full rounded-md">
                            <option value="">{{ __('Choose  a project') }}</option>
                            @foreach($projects as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('project_id')
                        <span class="text-red-500 font-bold mt-1 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mt-4 text-right">
                    <x-jet-button>
                        {{ __('Start work on the project') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</x-master-layout>
