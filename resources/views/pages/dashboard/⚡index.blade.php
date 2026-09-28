<?php

use App\Domains\Dashboard\UseCases\GetDashboardStatsUseCase\GetDashboardStatsUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts.dashboard')] #[Title('Dashboard')]class extends Component
{
    protected GetDashboardStatsUseCase $getDashboardStatsUseCase;

    public function boot(
        GetDashboardStatsUseCase $getDashboardStatsUseCase
    ): void {
        $this->getDashboardStatsUseCase = $getDashboardStatsUseCase;
    }

    #[Computed]
    public function stats(): array
    {
        return $this->getDashboardStatsUseCase->execute();
    }
};
?>

<div class="space-y-8">

    {{-- ========================================================= --}}
    {{-- Header --}}
    {{-- ========================================================= --}}

    <div class="relative overflow-hidden rounded-3xl bg-slate-950 px-8 py-8 shadow-xl">

        {{-- Background decoration --}}
        <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-blue-600/20 blur-3xl"></div>
        <div class="absolute -bottom-24 left-1/3 h-64 w-64 rounded-full bg-cyan-500/10 blur-3xl"></div>

        <div class="relative flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-4">

                <div
                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-600 text-white shadow-lg shadow-blue-600/30">
                    <svg
                        class="h-7 w-7"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>

                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                        Welcome Back 👋
                    </h1>

                    <p class="mt-1 text-sm text-slate-400">
                        Here's what's happening in your hospital today.
                    </p>
                </div>

            </div>

            {{-- System status --}}
            <div
                class="flex w-fit items-center gap-2 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-4 py-2">
                <span class="relative flex h-2.5 w-2.5">
                    <span
                        class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>

                    <span
                        class="relative inline-flex h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                </span>

                <span class="text-xs font-medium text-emerald-300">
                    System Operational
                </span>
            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- Statistics --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">


        {{-- Users --}}
        <div
            class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Users
                    </p>

                    <h2 class="mt-3 text-4xl font-bold tracking-tight text-slate-900">
                        {{ number_format($this->stats['users']) }}
                    </h2>

                    <p class="mt-2 text-xs text-slate-400">
                        Registered system users
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition-all duration-300 group-hover:bg-blue-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-blue-600/20">
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m6-10a4 4 0 100-8 4 4 0 000 8zm10 10v-2a4 4 0 00-3-3.87m-1-8.13a4 4 0 010 7.75" />
                    </svg>
                </div>

            </div>

            <div
                class="absolute -bottom-10 -right-10 h-28 w-28 rounded-full bg-blue-500/5 transition-transform duration-500 group-hover:scale-150"></div>

        </div>


        {{-- Patients --}}
        <div
            class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-cyan-200 hover:shadow-xl">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Patients
                    </p>

                    <h2 class="mt-3 text-4xl font-bold tracking-tight text-slate-900">
                        {{ number_format($this->stats['patients']) }}
                    </h2>

                    <p class="mt-2 text-xs text-slate-400">
                        Registered patients
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 transition-all duration-300 group-hover:bg-cyan-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-cyan-600/20">
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19a4 4 0 00-8 0m4-8a4 4 0 100-8 4 4 0 000 8zm8 8a4 4 0 00-4-4m2-4a3 3 0 100-6" />
                    </svg>
                </div>

            </div>

            <div
                class="absolute -bottom-10 -right-10 h-28 w-28 rounded-full bg-cyan-500/5 transition-transform duration-500 group-hover:scale-150"></div>

        </div>


        {{-- Doctors --}}
        <div
            class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-emerald-200 hover:shadow-xl">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Doctors
                    </p>

                    <h2 class="mt-3 text-4xl font-bold tracking-tight text-slate-900">
                        {{ number_format($this->stats['doctors']) }}
                    </h2>

                    <p class="mt-2 text-xs text-slate-400">
                        Registered doctors
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition-all duration-300 group-hover:bg-emerald-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-emerald-600/20">
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 6v12m6-6H6" />
                    </svg>
                </div>

            </div>

            <div
                class="absolute -bottom-10 -right-10 h-28 w-28 rounded-full bg-emerald-500/5 transition-transform duration-500 group-hover:scale-150"></div>

        </div>


        {{-- Appointments --}}
        <div
            class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-violet-200 hover:shadow-xl">

            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Appointments
                    </p>

                    <h2 class="mt-3 text-4xl font-bold tracking-tight text-slate-900">
                        {{ number_format($this->stats['appointments']) }}
                    </h2>

                    <p class="mt-2 text-xs text-slate-400">
                        Total appointments
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-violet-600 transition-all duration-300 group-hover:bg-violet-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-violet-600/20">
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 7V3m8 4V3M4 11h16M5 21h14a1 1 0 001-1V7a1 1 0 00-1-1H5a1 1 0 00-1 1v13a1 1 0 001 1z" />
                    </svg>
                </div>

            </div>

            <div
                class="absolute -bottom-10 -right-10 h-28 w-28 rounded-full bg-violet-500/5 transition-transform duration-500 group-hover:scale-150"></div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- Hospital Overview --}}
    {{-- ========================================================= --}}

    <div
        class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div
            class="flex flex-col gap-2 border-b border-slate-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-lg font-bold text-slate-900">
                    Hospital Overview
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Current statistics across your hospital system.
                </p>
            </div>

            <div
                class="flex items-center gap-2 text-xs font-medium text-slate-400">
                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 8v4l3 2" />
                </svg>

                Live statistics
            </div>

        </div>


        <div class="grid grid-cols-1 divide-y divide-slate-100 sm:grid-cols-2 lg:grid-cols-4 lg:divide-x lg:divide-y-0">


            {{-- Users --}}
            <div class="group flex items-center gap-4 p-6 transition-colors hover:bg-slate-50">

                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m6-10a4 4 0 100-8 4 4 0 000 8zm10 10v-2a4 4 0 00-3-3.87m-1-8.13a4 4 0 010 7.75" />
                    </svg>
                </div>

                <div>
                    <p class="text-sm text-slate-500">
                        Users
                    </p>

                    <p class="text-xl font-bold text-slate-900">
                        {{ number_format($this->stats['users']) }}
                    </p>
                </div>

            </div>


            {{-- Patients --}}
            <div class="group flex items-center gap-4 p-6 transition-colors hover:bg-slate-50">

                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600">
                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19a4 4 0 00-8 0m4-8a4 4 0 100-8 4 4 0 000 8zm8 8a4 4 0 00-4-4m2-4a3 3 0 100-6" />
                    </svg>
                </div>

                <div>
                    <p class="text-sm text-slate-500">
                        Patients
                    </p>

                    <p class="text-xl font-bold text-slate-900">
                        {{ number_format($this->stats['patients']) }}
                    </p>
                </div>

            </div>


            {{-- Doctors --}}
            <div class="group flex items-center gap-4 p-6 transition-colors hover:bg-slate-50">

                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 6v12m6-6H6" />
                    </svg>
                </div>

                <div>
                    <p class="text-sm text-slate-500">
                        Doctors
                    </p>

                    <p class="text-xl font-bold text-slate-900">
                        {{ number_format($this->stats['doctors']) }}
                    </p>
                </div>

            </div>


            {{-- Appointments --}}
            <div class="group flex items-center gap-4 p-6 transition-colors hover:bg-slate-50">

                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 7V3m8 4V3M4 11h16M5 21h14a1 1 0 001-1V7a1 1 0 00-1-1H5a1 1 0 00-1 1v13a1 1 0 001 1z" />
                    </svg>
                </div>

                <div>
                    <p class="text-sm text-slate-500">
                        Appointments
                    </p>

                    <p class="text-xl font-bold text-slate-900">
                        {{ number_format($this->stats['appointments']) }}
                    </p>
                </div>

            </div>

        </div>

    </div>

</div>