<?php

use App\Domains\Pharmacy\DTOs\Medicine\MedicineDTO;
use App\Domains\Pharmacy\UseCases\Medicine\CreateMedicineUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected CreateMedicineUseCase $createMedicineUseCase;

    public string $code = '';
    public string $name = '';
    public string $generic_name = '';
    public string $manufacturer = '';

    public function boot(
        CreateMedicineUseCase $createMedicineUseCase
    ): void {
        $this->createMedicineUseCase = $createMedicineUseCase;
    }

    public function create(): void
    {
        $this->validate([
            'code'         => ['required', 'string', 'max:255', 'unique:medicines,code'],
            'name'         => ['required', 'string', 'max:255'],
            'generic_name' => ['nullable', 'string', 'max:255'],
            'manufacturer' => ['nullable', 'string', 'max:255'],
        ]);

        $dto = MedicineDTO::fromArray([
            'code' => $this->code,
            'name' => $this->name,
            'generic_name' => $this->generic_name ?: null,
            'manufacturer' => $this->manufacturer ?: null,
        ]);

        $medicine = $this->createMedicineUseCase->execute($dto);

        $this->redirect(
            route('medicines.show', $medicine->id),
            navigate: true
        );
    }
};

?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Create Medicine
            </h1>

            <p class="mt-2 text-slate-500">
                Add a new medicine to the pharmacy.
            </p>
        </div>

        <a
            href="{{ route('medicines.index') }}"
            wire:navigate
            class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">
            Back
        </a>

    </div>


    {{-- Form --}}
    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

        <form wire:submit="create">

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                {{-- Code --}}
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Code
                    </label>

                    <input
                        type="text"
                        wire:model="code"
                        placeholder="e.g. MED-0001"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">

                    @error('code')
                    <span class="mt-1 block text-sm text-red-600">
                        {{ $message }}
                    </span>
                    @enderror
                </div>


                {{-- Name --}}
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Name
                    </label>

                    <input
                        type="text"
                        wire:model="name"
                        placeholder="e.g. Panadol"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">

                    @error('name')
                    <span class="mt-1 block text-sm text-red-600">
                        {{ $message }}
                    </span>
                    @enderror
                </div>


                {{-- Generic Name --}}
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Generic Name
                    </label>

                    <input
                        type="text"
                        wire:model="generic_name"
                        placeholder="e.g. Paracetamol"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">

                    @error('generic_name')
                    <span class="mt-1 block text-sm text-red-600">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                {{-- Manufacturer --}}
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Manufacturer
                    </label>

                    <input
                        type="text"
                        wire:model="manufacturer"
                        placeholder="e.g. GSK"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">

                    @error('manufacturer')
                    <span class="mt-1 block text-sm text-red-600">
                        {{ $message }}
                    </span>
                    @enderror
                </div>


            </div>


            {{-- Actions --}}
            <div class="mt-8 flex items-center justify-end gap-3">

                <a
                    href="{{ route('medicines.index') }}"
                    wire:navigate
                    class="rounded-xl bg-slate-100 px-5 py-3 font-medium text-slate-700 transition hover:bg-slate-200">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">
                    Create Medicine
                </button>

            </div>

        </form>

    </div>

</div>