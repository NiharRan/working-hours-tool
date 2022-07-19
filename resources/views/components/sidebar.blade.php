<div class="mx-auto sm:pl-4 lg:pl-6">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg h-screen">
        <ul>
            @if(auth()->user()->role == 'admin')
                <li>
                    <a class="mx-2 px-4 py-2 block hover:font-bold hover:bg-gray-100 transition-all ease-in-out delay-400 {{ str_contains($routeName, 'admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a>
                </li>
                <li>
                    <a class="mx-2 px-4 py-2 block hover:font-bold hover:bg-gray-100 transition-all ease-in-out delay-400 {{ str_contains($routeName, 'admin.users') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">{{__('Users')}}</a>
                </li>
                <li>
                    <a class="mx-2 px-4 py-2 block hover:font-bold hover:bg-gray-100 transition-all ease-in-out delay-400 {{ str_contains($routeName, 'admin.projects') ? 'active' : '' }}" href="{{ route('admin.projects.index') }}">{{__('Projects')}}</a>
                </li>
                <li>
                    <a class="mx-2 px-4 py-2 block hover:font-bold hover:bg-gray-100 transition-all ease-in-out delay-400 {{ str_contains($routeName, 'admin.activities') ? 'active' : '' }}" href="{{ route('admin.activities.index') }}">{{__('Activities')}}</a>
                </li>
            @else
                <li>
                    <a class="mx-2 px-4 py-2 block hover:font-bold hover:bg-gray-100 transition-all ease-in-out delay-400 {{ str_contains($routeName, 'dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">{{__('Dashboard')}}</a>
                </li>
                <li>
                    <a class="mx-2 px-4 py-2 block hover:font-bold hover:bg-gray-100 transition-all ease-in-out delay-400 {{ str_contains($routeName, 'activities') ? 'active' : '' }}" href="{{ route('activities.index') }}">{{__('Activities')}}</a>
                </li>
            @endif
        </ul>
    </div>
</div>
