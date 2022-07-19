<x-master-layout>
    <div class="flex-1">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div>
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
                            <div class="mt-6 text-gray-500">
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
                                        <td class="border px-2 py-1">Working</td>
                                    </tr>
                                    <tr>
                                        <th class="border text-left px-2 py-1">{{ __('Active project') }}</th>
                                        <td class="border px-2 py-1">Demo Project</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="mt-6 text-gray-500">
                                <form action="" method="post">
                                    <div>
                                        <select class="border border-gray-200 w-full rounded-md">
                                            <option value="">{{ __('Choose  a project') }}</option>
                                            <option value="1">Project One</option>
                                            <option value="2">Project Two</option>
                                        </select>
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
    </div>
</x-master-layout>
