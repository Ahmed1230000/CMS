<?php

use App\Domains\Pharmacy\DTOs\Medicine\MedicineDTO;
use App\Domains\Pharmacy\Repositories\Contracts\Medicine\MedicineRepositoryInterface;
use App\Domains\Pharmacy\UseCases\Medicine\UpdateMedicineUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected UpdateMedicineUseCase $updateMedicineUseCase;
    protected MedicineRepositoryInterface $repository;

    public int $id;

    public string $code = '';
    public string $name = '';
    public string $generic_name = '';
    public string $manufacturer = '';
    public string $status = 'active';

    public function boot(
        UpdateMedicineUseCase $updateMedicineUseCase,
        MedicineRepositoryInterface $repository
    ): void {
        $this->updateMedicineUseCase = $updateMedicineUseCase;
        $this->repository = $repository;
    }

    public function mount(int $id): void
    {
        $this->id = $id;

        $medicine = $this->repository->find($id);

        $this->code = $medicine->code;
        $this->name = $medicine->name;
        $this->generic_name = $medicine->generic_name ?? '';
        $this->manufacturer = $medicine->manufacturer ?? '';
    }

    public function update(): void
    {
        $this->validate([
            'code' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'generic_name' => ['nullable', 'string', 'max:255'],
            'manufacturer' => ['nullable', 'string', 'max:255'],
        ]);

        $medicine = $this->repository->find($this->id);

        $dto = MedicineDTO::fromArray([
            'code' => $this->code,
            'name' => $this->name,
            'generic_name' => $this->generic_name ?: null,
            'manufacturer' => $this->manufacturer ?: null,
        ]);

        $this->updateMedicineUseCase->execute(
            $medicine,
            $dto
        );

        $this->redirect(
            route('medicines.show', $this->id),
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
                Update Medicine
            </h1>

            <p class="mt-2 text-slate-500">
                Update medicine information.
            </p>
        </div>

        <a
            href="{{ route('medicines.show', $id) }}"
            wire:navigate
            class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">
            Back
        </a>

    </div>


    {{-- Form --}}
    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

        <form wire:submit="update">

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                {{-- Code --}}
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Code
                    </label>

                    <input
                        type="text"
                        wire:model="code"
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
                    href="{{ route('medicines.show', $id) }}"
                    wire:navigate
                    class="rounded-xl bg-slate-100 px-5 py-3 font-medium text-slate-700 transition hover:bg-slate-200">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">
                    Update Medicine
                </button>

            </div>

        </form>

    </div>

</div>