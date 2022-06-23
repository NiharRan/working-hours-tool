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
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <div class="text-right">
                        <a href="#" id="export-btn"
                           class="inline-flex items-center mx-4 my-4 px-4 py-2 bg-green-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-600 focus:outline-none focus:border-green-600 focus:ring focus:ring-green-300 disabled:opacity-25 transition">
                            {{ __('Export') }}
                        </a>
                    </div>
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
