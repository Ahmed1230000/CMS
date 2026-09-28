<aside
    class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col border-r border-slate-800 bg-slate-950">

    {{-- Logo --}}
    <div class="shrink-0 border-b border-slate-800 px-6 py-6">

        <div class="flex items-center gap-3">

            <div
                class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600 shadow-lg shadow-blue-600/20">
                <svg
                    class="h-6 w-6 text-white"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 2v20M2 12h20" />
                </svg>
            </div>

            <div>
                <h1 class="text-xl font-bold tracking-wide text-white">
                    HMS
                </h1>

                <p class="mt-0.5 text-xs text-slate-400">
                    Hospital Management System
                </p>
            </div>

        </div>

    </div>


    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6">

        {{-- GENERAL --}}
        <div class="mb-7">

            <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-[0.15em] text-slate-500">
                General
            </p>

            <a
                href="{{ route('dashboard') }}"
                wire:navigate
                class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                {{ request()->routeIs('dashboard')
                    ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20'
                    : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">

                <svg
                    class="h-5 w-5 shrink-0
                    {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l9-9 9 9M5 10v10h14V10M9 20v-6h6v6" />
                </svg>

                <span>Dashboard</span>

            </a>

        </div>


        {{-- AUTHENTICATION --}}
        <div class="mb-7">

            <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-[0.15em] text-slate-500">
                Authentication
            </p>

            <div class="space-y-1">

                {{-- Users --}}
                <a
                    href="{{ route('users.index') }}"
                    wire:navigate
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                    {{ request()->routeIs('users.*')
                        ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20'
                        : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">

                    <svg
                        class="h-5 w-5 shrink-0"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />

                        <circle
                            cx="9"
                            cy="7"
                            r="4"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2" />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                    </svg>

                    <span>Users</span>

                </a>


                {{-- Roles --}}
                <a
                    href="{{ route('roles.list') }}"
                    wire:navigate
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                    {{ request()->routeIs('roles.*')
                        ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20'
                        : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">

                    <svg
                        class="h-5 w-5 shrink-0"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 15a3 3 0 100-6 3 3 0 000 6z" />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.33 2.66l-.08-.04a1.65 1.65 0 00-1.81.33A1.65 1.65 0 0015 21v.1a2 2 0 01-4 0V21a1.65 1.65 0 00-1.51-1.65 1.65 1.65 0 00-1.81.33l-.08.04a2 2 0 01-2.33-2.66l.06-.06A1.65 1.65 0 005.6 15 1.65 1.65 0 004 13.5v-.1a2 2 0 014 0A1.65 1.65 0 009.5 12a1.65 1.65 0 001.5-1.5V10a2 2 0 014 0v.5a1.65 1.65 0 001.5 1.5 1.65 1.65 0 001.5-1.5V10a2 2 0 014 0v.5A1.65 1.65 0 0019.4 15z" />
                    </svg>

                    <span>Roles</span>

                </a>


                {{-- Permissions --}}
                <a
                    href="{{ route('permissions.list') }}"
                    wire:navigate
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                    {{ request()->routeIs('permissions.*')
                        ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20'
                        : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">

                    <svg
                        class="h-5 w-5 shrink-0"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 15a3 3 0 100-6 3 3 0 000 6z" />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 12a7 7 0 01-7 7m0-14a7 7 0 017 7M5 12a7 7 0 017-7m0 14a7 7 0 01-7-7" />
                    </svg>

                    <span>Permissions</span>

                </a>

            </div>

        </div>


        {{-- MANAGEMENT --}}
        <div class="mb-7">

            <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-[0.15em] text-slate-500">
                Management
            </p>

            <div class="space-y-1">

                {{-- Doctors --}}
                <a
                    href="{{ route('doctors.index') }}"
                    wire:navigate
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                    {{ request()->routeIs('doctors.*')
                        ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20'
                        : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 20a6 6 0 00-12 0M9 10a4 4 0 100-8 4 4 0 000 8zm7-7v6m3-3h-6" />
                    </svg>

                    <span>Doctors</span>
                </a>


                {{-- Departments --}}
                <a
                    href="{{ route('departments.list') }}"
                    wire:navigate
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                    {{ request()->routeIs('departments.*')
                        ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20'
                        : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 21V5a2 2 0 012-2h12a2 2 0 012 2v16M2 21h20M8 7h2m4 0h2M8 11h2m4 0h2M8 15h2m4 0h2" />
                    </svg>

                    <span>Departments</span>
                </a>


                {{-- Appointments --}}
                <a
                    href="{{ route('appointments.index') }}"
                    wire:navigate
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                    {{ request()->routeIs('appointments.*')
                        ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20'
                        : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <rect x="3" y="5" width="18" height="16" rx="2" fill="none" stroke="currentColor" stroke-width="2" />
                        <path stroke-linecap="round" stroke-width="2" d="M16 3v4M8 3v4M3 10h18" />
                    </svg>

                    <span>Appointments</span>
                </a>


                {{-- Employees --}}
                <a
                    href="{{ route('employees.index') }}"
                    wire:navigate
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                    {{ request()->routeIs('employees.*')
                        ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20'
                        : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 21v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2M10 11a4 4 0 100-8 4 4 0 000 8zm7-8v6m3-3h-6" />
                    </svg>

                    <span>Employees</span>
                </a>


                {{-- HR --}}
                <a
                    href="{{ route('hrs.index') }}"
                    wire:navigate
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                    {{ request()->routeIs('hrs.*')
                        ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20'
                        : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 21V5a2 2 0 012-2h12a2 2 0 012 2v16M2 21h20M8 7h2m4 0h2M8 11h8M8 15h8" />
                    </svg>

                    <span>HR</span>
                </a>

            </div>

        </div>


        {{-- CLINICAL --}}
        <div class="mb-7">

            <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-[0.15em] text-slate-500">
                Clinical
            </p>

            <div class="space-y-1">

                {{-- Patients --}}
                <a
                    href="{{ route('patients.index') }}"
                    wire:navigate
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                    {{ request()->routeIs('patients.*')
                        ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20'
                        : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 11a4 4 0 100-8 4 4 0 000 8zM3 21a6 6 0 0112 0M19 8v6m3-3h-6" />
                    </svg>

                    <span>Patients</span>
                </a>


                {{-- Medical Records --}}
                <a
                    href="{{ route('medical-records.index') }}"
                    wire:navigate
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                    {{ request()->routeIs('medical-records.*')
                        ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20'
                        : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M7 3h8l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2zM14 3v5h5M9 13h6M9 17h6" />
                    </svg>

                    <span>Medical Records</span>
                </a>


                {{-- Prescriptions --}}
                <a
                    href="{{ route('prescriptions.index') }}"
                    wire:navigate
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                    {{ request()->routeIs('prescriptions.*')
                        ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20'
                        : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M7 4a4 4 0 018 0v3a4 4 0 01-8 0V4zM17 20H7a4 4 0 010-8h10a4 4 0 010 8z" />
                    </svg>

                    <span>Prescriptions</span>
                </a>

            </div>

        </div>


        {{-- PHARMACY --}}
        <div class="mb-7">

            <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-[0.15em] text-slate-500">
                Pharmacy
            </p>

            <a
                href="{{ route('medicines.index') }}"
                wire:navigate
                class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                {{ request()->routeIs('medicines.*')
                    ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20'
                    : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 3h4v5l5 8a4 4 0 01-3.5 6h-7A4 4 0 015 16l5-8V3zM8 14h8" />
                </svg>

                <span>Medicines</span>
            </a>

        </div>


        {{-- REQUESTS --}}
        <div class="mb-7">

            <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-[0.15em] text-slate-500">
                Requests
            </p>

            <a
                href="{{ route('requests.index') }}"
                wire:navigate
                class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                {{ request()->routeIs('requests.*')
                    ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20'
                    : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5h6M9 9h6M9 13h4M6 3h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5a2 2 0 012-2z" />
                </svg>

                <span>Requests</span>
            </a>

        </div>


        {{-- BILLING --}}
        <div class="mb-7">

            <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-[0.15em] text-slate-500">
                Billing
            </p>

            <a
                href="{{ route('invoices.index') }}"
                wire:navigate
                class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition
                {{ request()->routeIs('invoices.*')
                    ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20'
                    : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M7 3h10a2 2 0 012 2v16l-7-3-7 3V5a2 2 0 012-2z" />
                </svg>

                <span>Invoices</span>
            </a>

        </div>

    </nav>


    {{-- Authenticated User --}}
    @auth

    <div class="shrink-0 border-t border-slate-800 p-4">

        <div class="flex items-center gap-3 rounded-2xl border border-slate-800 bg-slate-900 p-3">

            {{-- Avatar --}}
            <div
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>

            {{-- User Info --}}
            <div class="min-w-0 flex-1">

                <p class="truncate text-sm font-semibold text-white">
                    {{ auth()->user()->name }}
                </p>

                <p class="truncate text-xs text-slate-400">
                    {{ auth()->user()->email }}
                </p>

            </div>

            {{-- Online --}}
            <span
                class="h-2.5 w-2.5 shrink-0 rounded-full bg-emerald-500 ring-4 ring-emerald-500/10"
                title="Online"></span>

        </div>

    </div>

    @endauth

</aside>