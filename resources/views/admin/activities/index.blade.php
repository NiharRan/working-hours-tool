<x-master-layout>
    <div class="flex-1">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Activities') }}
            </h2>
            <a href="{{ route('admin.activities.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                {{ __('Create a new activity') }}
            </a>
        </x-slot>

        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <div>
                        <form action="" method="get" id="search-form">
                            <div class="grid grid-cols-2 gap-4 px-4 pt-4 pb-2">
                                <div>
                                    <select name="user_id" class="border border-gray-200 w-full rounded-md">
                                        <option value="">{{ __('Choose a user') }}</option>
                                        @foreach($users as $item)
                                            @php
                                            $selected = request()->get('user_id') == $item->id ? 'selected' : ''
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
                                                $selected = request()->get('project_id') == $item->id ? 'selected' : ''
                                            @endphp
                                            <option value="{{ $item->id }}" {{ $selected }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('project_id')
                                    <span class="text-red-500 font-bold mt-1 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4 px-4 pt-2 pb-4">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <input datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" name="start_date" value="{{ request()->get('start_date') }}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Start date') }}">
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <input datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" name="end_date" value="{{ request()->get('end_date') }}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('End date') }}">
                                </div>
                                <div>
                                    <x-jet-button class="mt-1">
                                        {{ __('Search') }}
                                    </x-jet-button>
                                    <a href="#" id="export-btn"
                                        class="inline-flex items-center px-4 py-2 bg-green-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-600 focus:outline-none focus:border-green-600 focus:ring focus:ring-green-300 disabled:opacity-25 transition">
                                        {{ __('Export') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if(session()->has('success'))
                        <div class="bg-green-100 p-4 font-bold text-green-600 mb-4">{{ session()->get('success') }}</div>
                    @endif
                    <table class="border border-collapse w-full">
                        <thead>
                        <tr>
                            <th class="border text-left px-2 py-1">{{ __('S.N.') }}</th>
                            <th class="border text-left px-2 py-1">{{ __('User') }}</th>
                            <th class="border text-left px-2 py-1">{{ __('Project') }}</th>
                            <th class="border text-left px-2 py-1">{{ __('Start At') }}</th>
                            <th class="border text-left px-2 py-1">{{ __('End At') }}</th>
                            <th class="border text-left px-2 py-1">{{ __('Total hours') }}</th>
                            <th class="border text-left px-2 py-1">{{ __('Status') }}</th>
                            <th class="border text-left px-2 py-1">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($activities->count() > 0)
                            @foreach($activities as $item)
                                <tr>
                                    <td class="border text-left px-2 py-1">{{ $loop->index + 1 }}</td>
                                    <th class="border text-left px-2 py-1">{{ $item->user->name }}</th>
                                    <th class="border text-left px-2 py-1">{{ $item->project->name }}</th>
                                    <th class="border text-left px-2 py-1">{{ $item->start_date_time }}</th>
                                    <th class="border text-left px-2 py-1">{{ $item->end_date_time }}</th>
                                    <th class="border text-left px-2 py-1">{{ $item->total_hours }}</th>
                                    <th class="border text-left px-2 py-1">{!! $item->activity_status !!}</th>
                                    <td class="border text-left px-2 py-1">
                                        <div class="relative">
                                            <button id="dropdown--{{ $loop->index }}" data-dropdown-toggle="dropdown-{{ $loop->index }}" class="text-gray-600 focus:ring-0 font-medium rounded-lg text-sm px-3 py-1 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </button>
                                            <div id="dropdown-{{ $loop->index }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700" data-popper-placement="left" style="position: absolute; inset: 0px auto auto 0px; margin: 0px;">
                                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown--{{ $loop->index }}">
                                                    <li>
                                                        <a href="{{ route('admin.activities.edit', $item->id) }}" class="block font-bold px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Edit') }}</a>
                                                    </li>
                                                    @if($item->status == 1)
                                                        <li>
                                                            <a href="{{ route('admin.activities.stop', $item->id) }}" class="block font-bold px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Stop working') }}</a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="7">{{ __('No record found..') }}</th>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>

<script>
    const exportBtn = document.querySelector('#export-btn')
    exportBtn.addEventListener('click', (e) => {
        e.preventDefault()
        const form = document.querySelector('#search-form')
        form.setAttribute('action', '{{ route('admin.export', 'activity') }}')
        form.submit();
    })
</script>
