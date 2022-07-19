<x-master-layout>
    <div class="flex-1">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Activities') }}
            </h2>
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
                            <th class="border text-left px-2 py-1">{{ __('Project') }}</th>
                            <th class="border text-left px-2 py-1">{{ __('Start At') }}</th>
                            <th class="border text-left px-2 py-1">{{ __('End At') }}</th>
                            <th class="border text-left px-2 py-1">{{ __('Total hours') }}</th>
                            <th class="border text-left px-2 py-1">{{ __('Status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($activities->count() > 0)
                            @foreach($activities as $item)
                                <tr>
                                    <td class="border text-left px-2 py-1">{{ $loop->index + 1 }}</td>
                                    <th class="border text-left px-2 py-1">{{ $item->project->name }}</th>
                                    <th class="border text-left px-2 py-1">{{ $item->start_date_time }}</th>
                                    <th class="border text-left px-2 py-1">{{ $item->end_date_time }}</th>
                                    <th class="border text-left px-2 py-1">{{ $item->total_hours }}</th>
                                    <th class="border text-left px-2 py-1">{!! $item->activity_status !!}</th>
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
