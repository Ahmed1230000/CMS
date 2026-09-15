<?php

use App\Domains\Pharmacy\UseCases\ShowMedicineUseCase\ShowMedicineUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ShowMedicineUseCase $showMedicineUseCase;

    public function boot(
        ShowMedicineUseCase $showMedicineUseCase
    ): void {
        $this->showMedicineUseCase = $showMedicineUseCase;
    }
    public int $id;

    public function mount(int $id): void
    {
        $this->id = $id;
    }

    #[Computed]
    public function medicine()
    {
        return $this->showMedicineUseCase->execute($this->id);
    }
};

?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Medicine Details
            </h1>

            <p class="mt-2 text-slate-500">
                View medicine information.
            </p>
        </div>

        <div class="flex items-center gap-2">

            <a
                href="{{ route('medicines.index') }}"
                wire:navigate
                class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">
                Back
            </a>

            <a
                href="{{ route('medicines.update', $this->medicine->id) }}"
                wire:navigate
                class="rounded-lg bg-blue-100 px-4 py-2 text-sm font-medium text-blue-700 transition hover:bg-blue-200">
                Update
            </a>

            <a
                href="{{ route('medicine-items.index', ['medicine' => $this->medicine->id ]) }}"
                wire:navigate
                class="rounded-lg bg-blue-100 px-4 py-2 text-sm font-medium text-blue-700 transition hover:bg-blue-200">
                View Items
            </a>

        </div>

    </div>


    {{-- Medicine Information --}}
    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

            {{-- ID --}}
            <div>
                <p class="text-sm text-slate-500">
                    ID
                </p>

                <p class="mt-1 font-medium text-slate-800">
                    {{ $this->medicine->id }}
                </p>
            </div>

            {{-- Code --}}
            <div>
                <p class="text-sm text-slate-500">
                    Code
                </p>

                <p class="mt-1 font-medium text-slate-800">
                    {{ $this->medicine->code }}
                </p>
            </div>

            {{-- Name --}}
            <div>
                <p class="text-sm text-slate-500">
                    Name
                </p>

                <p class="mt-1 font-medium text-slate-800">
                    {{ $this->medicine->name }}
                </p>
            </div>

            {{-- Generic Name --}}
            <div>
                <p class="text-sm text-slate-500">
                    Generic Name
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->medicine->generic_name ?: '—' }}
                </p>
            </div>

            {{-- Manufacturer --}}
            <div>
                <p class="text-sm text-slate-500">
                    Manufacturer
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->medicine->manufacturer ?: '—' }}
                </p>
            </div>

            {{-- Status --}}
            <div>
                <p class="text-sm text-slate-500">
                    Status
                </p>

                <div class="mt-2">

                    @if ($this->medicine->status?->value === 'active')

                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                        Active
                    </span>

                    @elseif ($this->medicine->status?->value === 'inactive')

                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                        Inactive
                    </span>

                    @endif

                </div>
            </div>

            {{-- Created By --}}
            <div>
                <p class="text-sm text-slate-500">
                    Created By
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->medicine->created_by_name ?: '—' }}
                </p>
            </div>

            {{-- Created At --}}
            <div>
                <p class="text-sm text-slate-500">
                    Created At
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->medicine->created_at }}
                </p>
            </div>

            {{-- Updated At --}}
            <div>
                <p class="text-sm text-slate-500">
                    Updated At
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->medicine->updated_at }}
                </p>
            </div>

        </div>

    </div>

</div>