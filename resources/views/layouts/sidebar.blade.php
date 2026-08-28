<aside class="flex h-screen w-72 flex-col border-r border-slate-800 bg-slate-900">

    <!-- Logo -->
    <div class="border-b border-slate-800 px-6 py-6">

        <h1 class="text-2xl font-bold tracking-wide text-white">

            CMS

        </h1>

        <p class="mt-1 text-sm text-slate-400">

            Hospital Management System

        </p>

    </div>

    <!-- Navigation -->
    <nav class="flex-1 space-y-6 px-4 py-6">

        <div>

            <p class="mb-2 px-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                General
            </p>

            <a
                href="{{ route('dashboard') }}"
                class="flex items-center rounded-xl px-4 py-3 font-medium transition
    {{ request()->routeIs('dashboard')
        ? 'bg-blue-600 text-white'
        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                Dashboard

            </a>

        </div>

        <div>

            <p class="mb-2 px-4 text-xs font-semibold uppercase tracking-wider text-slate-500">
                Management
            </p>

            <a
                href="{{ route('users.index') }}"
                class="flex items-center rounded-xl px-4 py-3 font-medium transition
    {{ request()->routeIs('users.*')
        ? 'bg-blue-600 text-white'
        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                Users

            </a>
            <a
                href="{{ route('roles.list') }}"
                class="mt-2 flex items-center rounded-xl px-4 py-3 font-medium transition
        {{ request()->routeIs('roles.*')
            ? 'bg-blue-600 text-white'
            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                Roles

            </a>
            <a
                href="{{ route('permissions.list') }}"
                class="mt-2 flex items-center rounded-xl px-4 py-3 font-medium transition
        {{ request()->routeIs('permissions.*')
            ? 'bg-blue-600 text-white'
            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                Permissions

            </a>

            <a
                href="{{ route('departments.list') }}"
                class="mt-2 flex items-center rounded-xl px-4 py-3 font-medium transition
        {{ request()->routeIs('departments.*')
            ? 'bg-blue-600 text-white'
            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                Departments

            </a>
            <a
                href="{{ route('hrs.index') }}"
                class="mt-2 flex items-center rounded-xl px-4 py-3 font-medium transition
        {{ request()->routeIs('hrs.*')
            ? 'bg-blue-600 text-white'
            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                Hrs

            </a>

        </div>

    </nav>

    <!-- User -->
    @auth

    <div class="border-t border-slate-800 p-4">

        <div class="rounded-xl bg-slate-800 p-4">

            <p class="font-semibold text-white">

                {{ auth()->user()->email }}

            </p>

            <p class="mt-1 text-sm text-slate-400">

                {{ auth()->user()->name }}

            </p>

        </div>

    </div>

    @endauth

</aside>