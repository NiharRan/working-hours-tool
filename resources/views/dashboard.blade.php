<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                        <x-jet-application-logo class="block h-12 w-auto" />
                    </div>

                    <div class="mt-8 text-2xl">
                        {{ __('Uudenmaan Rala Palvelut Oy Working hours tool') }}
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mt-4 text-gray-500">
                            @if(session()->has('success'))
                                <div class="bg-green-100 p-4 font-bold text-green-600 mb-4">{{ session()->get('success') }}</div>
                            @endif
                            @if(session()->has('error'))
                                <div class="bg-red-100 p-4 font-bold text-red-600 mb-4">{{ session()->get('error') }}</div>
                            @endif
                            <table class="border border-collapse w-full">
                                <tr>
                                    <th class="border text-left px-2 py-1">{{ __('User') }}</th>
                                    <td class="border px-2 py-1">
                                        <p class="text-left">{{ __('Name') }}: <span class="font-bold pl-1">{{ auth()->user()->name }}</span></p>
                                        <p class="text-left">{{ __('Username') }}: <span class="font-bold pl-1">{{ auth()->user()->username }}</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border text-left px-2 py-1">{{ __('Status') }}</th>
                                    <td class="border px-2 py-1">
                                        <span class="font-bold px-2 py-1 {{ isset($running) ? 'text-green-500 bg-green-100' : 'text-red-500 bg-red-100' }}">
                                            {{ isset($running) ? __('Working') : __('Not working') }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border text-left px-2 py-1">{{ __('Active project') }}</th>
                                    <td class="border px-2 py-1">
                                    @if(isset($running))
                                        {{ $running->project->name }}
                                            <form action="{{ route('activities.update', $running->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <x-jet-button>
                                                    {{ __('Stop working for the day') }}
                                                </x-jet-button>
                                            </form>
                                    @else
                                        <span class="text-yellow-500 bg-yellow-50">{{ __('No project started yet') }}</span>
                                    @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="mt-6 text-gray-500">
                            @error('error')
                                <span class="text-red-500 font-bold mt-1 text-sm">{{ $message }}</span>
                            @enderror
                            <form action="{{ route('activities.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <div>
                                    <select name="project_id" class="border border-gray-200 w-full rounded-md">
                                        <option value="">{{ __('Choose  a project') }}</option>
                                        @foreach($projects as $item)
                                            @php
                                                $selected = '';
                                                if (isset($running)) {
                                                    $selected = $item->id == $running->project->id ? 'selected' : '';
                                                }
                                            @endphp
                                            <option value="{{ $item->id }}" {{ $selected }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('project_id')
                                    <span class="text-red-500 font-bold mt-1 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <x-jet-button>
                                        {{ __('Start work on the project') }}
                                    </x-jet-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
