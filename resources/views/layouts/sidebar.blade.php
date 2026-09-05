<aside class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col overflow-y-auto border-r border-slate-800 bg-slate-900">

    {{-- Logo --}}
    <div class="shrink-0 border-b border-slate-800 px-6 py-6">

        <h1 class="text-2xl font-bold tracking-wide text-white">
            HMS
        </h1>

        <p class="mt-1 text-sm text-slate-400">
            Hospital Management System
        </p>

    </div>


    {{-- Navigation --}}
    <nav class="flex-1 space-y-3 px-4 py-6">


        {{-- General --}}
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


        {{-- Authentication --}}
        <details
            class="group"
            {{ request()->routeIs('users.*', 'roles.*', 'permissions.*') ? 'open' : '' }}>

            <summary class="flex cursor-pointer list-none items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold uppercase tracking-wider text-slate-500 transition hover:bg-slate-800 hover:text-white">

                <span>
                    Authentication
                </span>

                <svg
                    class="h-4 w-4 transition-transform group-open:rotate-180"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7" />

                </svg>

            </summary>


            <div class="mt-2 space-y-1">

                {{-- Users --}}
                <a
                    href="{{ route('users.index') }}"
                    class="flex items-center rounded-xl px-4 py-3 font-medium transition
                    {{ request()->routeIs('users.*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                    Users

                </a>


                {{-- Roles --}}
                <a
                    href="{{ route('roles.list') }}"
                    class="flex items-center rounded-xl px-4 py-3 font-medium transition
                    {{ request()->routeIs('roles.*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                    Roles

                </a>


                {{-- Permissions --}}
                <a
                    href="{{ route('permissions.list') }}"
                    class="flex items-center rounded-xl px-4 py-3 font-medium transition
                    {{ request()->routeIs('permissions.*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                    Permissions

                </a>

            </div>

        </details>


        {{-- Management --}}
        <details
            class="group"
            {{ request()->routeIs('departments.*', 'hrs.*', 'doctors.*','employees.*') ? 'open' : '' }}>

            <summary class="flex cursor-pointer list-none items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold uppercase tracking-wider text-slate-500 transition hover:bg-slate-800 hover:text-white">

                <span>
                    Management
                </span>

                <svg
                    class="h-4 w-4 transition-transform group-open:rotate-180"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7" />

                </svg>

            </summary>


            <div class="mt-2 space-y-1">

                {{-- Departments --}}
                <a
                    href="{{ route('departments.list') }}"
                    class="flex items-center rounded-xl px-4 py-3 font-medium transition
                    {{ request()->routeIs('departments.*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                    Departments

                </a>


                {{-- HR --}}
                <a
                    href="{{ route('hrs.index') }}"
                    class="flex items-center rounded-xl px-4 py-3 font-medium transition
                    {{ request()->routeIs('hrs.*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                    HR

                </a>


                {{-- Doctors --}}
                <a
                    href="{{ route('doctors.index') }}"
                    class="flex items-center rounded-xl px-4 py-3 font-medium transition
                    {{ request()->routeIs('doctors.*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                    Doctors

                </a>
                {{-- Employee --}}
                <a
                    href="{{ route('employees.index') }}"
                    class="flex items-center rounded-xl px-4 py-3 font-medium transition
                    {{ request()->routeIs('employees.*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                    Employees

                </a>

            </div>

        </details>


        {{-- Clinical --}}
        <details
            class="group" {{ request()->routeIs('patients.*','appointments.*','medical-records.*') ? 'open': '' }}>

            <summary class="flex cursor-pointer list-none items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold uppercase tracking-wider text-slate-500 transition hover:bg-slate-800 hover:text-white">

                <span>
                    Clinical
                </span>

                <svg
                    class="h-4 w-4 transition-transform group-open:rotate-180"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7" />

                </svg>

            </summary>


            <div class="mt-2 space-y-1">

                {{-- Patients --}}
                <a
                    href="{{ route('patients.index') }}"
                    class="flex items-center rounded-xl px-4 py-3 font-medium transition
                    {{ request()->routeIs('patients.*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                    Patients

                </a>
                {{-- Appointments --}}
                <a
                    href="{{ route('appointments.index') }}"
                    class="flex items-center rounded-xl px-4 py-3 font-medium transition
                    {{ request()->routeIs('appointments.*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                    Appointments

                </a>
                {{-- Medical Records --}}
                <a
                    href="{{ route('medical-records.index') }}"
                    class="flex items-center rounded-xl px-4 py-3 font-medium transition
                    {{ request()->routeIs('medical-records.*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                    Medical Records

                </a>
                {{-- Prescriptions --}}
                <a
                    href="{{ route('prescriptions.index') }}"
                    class="flex items-center rounded-xl px-4 py-3 font-medium transition
                    {{ request()->routeIs('prescriptions.*')
                        ? 'bg-blue-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                    Prescriptions

                </a>

            </div>

        </details>


        {{-- Billing --}}
        <details
            class="group">

            <summary class="flex cursor-pointer list-none items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold uppercase tracking-wider text-slate-500 transition hover:bg-slate-800 hover:text-white">

                <span>
                    Billing
                </span>

                <svg
                    class="h-4 w-4 transition-transform group-open:rotate-180"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7" />

                </svg>

            </summary>


            <div class="mt-2 space-y-1">

                <span class="block rounded-xl px-4 py-3 text-slate-500">
                    Medicines
                </span>

                <span class="block rounded-xl px-4 py-3 text-slate-500">
                    Billing
                </span>

                <span class="block rounded-xl px-4 py-3 text-slate-500">
                    Payments
                </span>

            </div>

        </details>


    </nav>


    {{-- Authenticated User --}}
    @auth

    <div class="shrink-0 border-t border-slate-800 p-4">

        <div class="rounded-xl bg-slate-800 p-4">

            <p class="truncate font-semibold text-white">
                {{ auth()->user()->email }}
            </p>

            <p class="mt-1 truncate text-sm text-slate-400">
                {{ auth()->user()->name }}
            </p>

        </div>

    </div>

    @endauth

</aside>