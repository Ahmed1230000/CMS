<?php

use App\Domains\Pharmacy\UseCases\IndexMedicineUseCase\IndexMedicineUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected IndexMedicineUseCase $indexMedicineUseCase;

    public function boot(
        IndexMedicineUseCase $indexMedicineUseCase
    ): void {
        $this->indexMedicineUseCase = $indexMedicineUseCase;
    }

    #[Computed]
    public function medicines()
    {
        return $this->indexMedicineUseCase->execute();
    }
};

?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Medicines
            </h1>

            <p class="mt-2 text-slate-500">
                Manage hospital medicines.
            </p>
        </div>

        <a
            href="{{ route('medicines.create') }}"
            wire:navigate
            class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 font-medium text-white transition hover:bg-blue-700">
            + Create Medicine
        </a>

    </div>


    {{-- Medicines Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <table class="min-w-full">

            <thead class="border-b bg-slate-50">

                <tr>

                    {{-- ID --}}
                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        #ID
                    </th>

                    {{-- Code --}}
                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Code
                    </th>

                    {{-- Name --}}
                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Name
                    </th>

                    {{-- Generic Name --}}
                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Generic Name
                    </th>

                    {{-- Status --}}
                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Status
                    </th>

                    {{-- Actions --}}
                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($this->medicines as $medicine)

                <tr class="border-b last:border-b-0">

                    {{-- ID --}}
                    <td class="px-6 py-4">
                        {{ $medicine->id }}
                    </td>

                    {{-- Code --}}
                    <td class="px-6 py-4">

                        <a
                            href="{{ route('medicines.show', $medicine->id) }}"
                            wire:navigate
                            class="font-medium text-blue-600 transition hover:underline">
                            {{ $medicine->code }}
                        </a>

                    </td>

                    {{-- Name --}}
                    <td class="px-6 py-4 text-slate-600">
                        {{ $medicine->name }}
                    </td>

                    {{-- Generic Name --}}
                    <td class="px-6 py-4 text-slate-600">
                        {{ $medicine->generic_name ?: '—' }}
                    </td>

                    {{-- Status --}}
                    <td class="px-6 py-4">

                        @if ($medicine->status?->value === 'active')

                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                            Active
                        </span>

                        @elseif ($medicine->status?->value === 'inactive')

                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                            Inactive
                        </span>

                        @endif

                    </td>

                    {{-- Actions --}}
                    <td class="px-6 py-4">

                        <div class="flex items-center gap-2">

                            <a
                                href="{{ route('medicines.show', $medicine->id) }}"
                                wire:navigate
                                class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">
                                View
                            </a>

                            <a
                                href="{{ route('medicines.update', $medicine->id) }}"
                                wire:navigate
                                class="rounded-lg bg-blue-100 px-3 py-2 text-sm font-medium text-blue-700 transition hover:bg-blue-200">
                                Update
                            </a>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td
                        colspan="8"
                        class="px-6 py-12 text-center text-slate-500">
                        No medicines found.
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    <div class="mt-6">
        {{ $this->medicines->links() }}
    </div>

</div>