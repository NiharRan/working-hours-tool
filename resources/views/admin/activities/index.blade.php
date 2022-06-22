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
