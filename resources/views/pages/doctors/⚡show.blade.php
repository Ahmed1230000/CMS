<?php

use App\Domains\Doctor\Entities\Doctor\DoctorEntity;
use App\Domains\Doctor\UseCases\ShowDoctorUseCase\ShowDoctorUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ShowDoctorUseCase $showDoctorUseCase;

    public int $doctor_id;

    public function boot(
        ShowDoctorUseCase $showDoctorUseCase
    ): void {
        $this->showDoctorUseCase = $showDoctorUseCase;
    }

    public function mount(string $id): void
    {
        $this->doctor_id = (int) $id;
    }

    #[Computed]
    public function doctor(): DoctorEntity
    {
        return $this->showDoctorUseCase->execute(
            $this->doctor_id
        );
    }
};
?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Doctor Details
            </h1>

            <p class="mt-2 text-slate-500">
                View doctor information.
            </p>

        </div>

        <a
            href="{{ route('doctors.index') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Back

        </a>

    </div>


    {{-- Doctor Card --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-slate-200 px-8 py-6">

            <div>

                <p class="text-sm font-medium text-slate-500">
                    Doctor
                </p>

                <h2 class="mt-1 text-2xl font-bold text-slate-800">
                    {{ $this->doctor->license_number }}
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    {{ $this->doctor->specialization }}
                </p>

            </div>

            @if ($this->doctor->is_active)

            <span class="rounded-full bg-green-100 px-4 py-2 text-sm font-medium text-green-700">
                Active
            </span>

            @else

            <span class="rounded-full bg-red-100 px-4 py-2 text-sm font-medium text-red-700">
                Inactive
            </span>

            @endif

        </div>


        {{-- Information --}}
        <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2">


            {{-- ID --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    ID
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    #{{ $this->doctor->id }}
                </p>

            </div>


            {{-- User ID --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    User ID
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    #{{ $this->doctor->user_id }}
                </p>

            </div>


            {{-- Department ID --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Department ID
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    #{{ $this->doctor->department_id }}
                </p>

            </div>


            {{-- License Number --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    License Number
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    {{ $this->doctor->license_number }}
                </p>

            </div>


            {{-- Specialization --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Specialization
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    {{ $this->doctor->specialization }}
                </p>

            </div>


            {{-- Phone --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Phone
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->doctor->phone }}
                </p>

            </div>


            {{-- Personal Email --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Personal Email
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->doctor->email }}
                </p>

            </div>


            {{-- Created By --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Created By
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    #{{ $this->doctor->created_by }}
                </p>

            </div>


            {{-- Bio --}}
            <div class="rounded-xl border border-slate-200 p-5 md:col-span-2">

                <p class="text-sm font-medium text-slate-500">
                    Bio
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->doctor->bio ?: 'No bio provided.' }}
                </p>

            </div>


            {{-- Created At --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Created At
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->doctor->created_at->format('Y-m-d H:i:s') }}
                </p>

            </div>


            {{-- Updated At --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Updated At
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->doctor->updated_at->format('Y-m-d H:i:s') }}
                </p>

            </div>

        </div>


        {{-- Actions --}}
        <div class="flex items-center justify-end gap-4 border-t border-slate-200 bg-slate-50 px-8 py-5">

            <a
                href="{{ route('doctors.index') }}"
                wire:navigate
                class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                Back

            </a>

            <a
                href="{{ route('doctors.edit', $this->doctor->id) }}"
                wire:navigate
                class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">

                Update

            </a>

        </div>

    </div>

</div>