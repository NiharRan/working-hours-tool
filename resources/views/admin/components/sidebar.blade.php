<div class="mx-auto sm:pl-4 lg:pl-6">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg h-screen">
        <ul>
            <li>
                <a class="mx-2 px-4 py-2 block hover:font-bold hover:bg-gray-100 transition-all ease-in-out delay-400 {{ str_contains($routeName, 'admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li>
                <a class="mx-2 px-4 py-2 block hover:font-bold hover:bg-gray-100 transition-all ease-in-out delay-400 {{ str_contains($routeName, 'admin.users') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">Users</a>
            </li>
            <li>
                <a class="mx-2 px-4 py-2 block hover:font-bold hover:bg-gray-100 transition-all ease-in-out delay-400 {{ str_contains($routeName, 'admin.projects') ? 'active' : '' }}" href="{{ route('admin.projects.index') }}">Projects</a>
            </li>
            <li>
                <a class="mx-2 px-4 py-2 block hover:font-bold hover:bg-gray-100 transition-all ease-in-out delay-400 {{ str_contains($routeName, 'admin.activities') ? 'active' : '' }}" href="{{ route('admin.activities.index') }}">Activities</a>
            </li>
        </ul>
    </div>
</div>
