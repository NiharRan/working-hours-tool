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
            @if(session()->has('error'))
                <div class="bg-red-100 p-4 font-bold text-red-600 mb-4">{{ session()->get('error') }}</div>
            @endif
            <form method="POST" action="{{ route('admin.activities.update', $activity->id) }}">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <select name="user_id" class="border border-gray-200 w-full rounded-md" disabled>
                            <option value="">{{ __('Choose  a user') }}</option>
                            @foreach($users as $item)
                                @php
                                    $selected = '';
                                    if (isset($activity)) {
                                        $selected = $item->id == $activity->user_id ? 'selected' : '';
                                    }
                                @endphp
                                <option value="{{ $item->id }}" {{ $selected }}>{{ $item->name }}</option>
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
                                @php
                                    $selected = '';
                                    if (isset($activity)) {
                                        $selected = $item->id == $activity->project_id ? 'selected' : '';
                                    }
                                @endphp
                                <option value="{{ $item->id }}" {{ $selected }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('project_id')
                        <span class="text-red-500 font-bold mt-1 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 py-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input name="start_at" value="{{ $activity->start_at ?? ''  }}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Start At') }}">
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input name="end_at" value="{{ $activity->end_at ?? ''  }}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('End At') }}">
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
