<?php

use App\Domains\Pharmacy\DTOs\MedicineItem\MedicineItemDTO;
use App\Domains\Pharmacy\Repositories\Contracts\Medicine\MedicineRepositoryInterface;
use App\Domains\Pharmacy\UseCases\MedicineItem\CreateMedicineItemUseCase;
use App\Models\Medicine;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected CreateMedicineItemUseCase $createMedicineItemUseCase;
    protected MedicineRepositoryInterface $medicineRepository;

    public int $medicine_id;
    public string $medicine_name = '';

    public string $code = '';
    public string $name = '';
    public string $strength = '';
    public string $dosage_form = '';
    public string $unit = '';
    public string $barcode = '';
    public string $selling_price = '';


    public function boot(
        CreateMedicineItemUseCase $createMedicineItemUseCase,
        MedicineRepositoryInterface $medicineRepository,
    ): void {
        $this->createMedicineItemUseCase = $createMedicineItemUseCase;
        $this->medicineRepository =  $medicineRepository;
    }

    public function mount(int $medicine): void
    {
        $this->medicine_id = $medicine;

        $medicine = $this->medicineRepository->findMedicineName($medicine);

        $this->medicine_name = $medicine->name;
    }

    public function create(): void
    {
        $this->validate([
            'medicine_id'   => ['required', 'integer', 'exists:medicines,id'],
            'code'          => ['required', 'string', 'max:255', 'unique:medicine_items,code'],
            'name'          => ['required', 'string', 'max:255'],
            'strength'      => ['nullable', 'string', 'max:255'],
            'dosage_form'   => ['nullable', 'string', 'max:255'],
            'unit'          => ['nullable', 'string', 'max:255'],
            'barcode'       => ['nullable', 'string', 'max:255', 'unique:medicine_items,barcode'],
            'selling_price' => ['required', 'numeric', 'decimal:0,2'],
        ]);

        $dto = MedicineItemDTO::fromArray([
            'medicine_id'   => $this->medicine_id,
            'code'          => $this->code,
            'name'          => $this->name,
            'strength'      => $this->strength ?: null,
            'dosage_form'   => $this->dosage_form ?: null,
            'unit'          => $this->unit ?: null,
            'barcode'       => $this->barcode ?: null,
            'selling_price' => $this->selling_price,
        ]);

        $medicineItem = $this->createMedicineItemUseCase->execute($dto);

        $this->redirect(
            route('medicine-items.show', [
                'medicine' => $this->medicine_id,
                'id' => $medicineItem->id,
            ]),
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
                Create Medicine Item
            </h1>

            <p class="mt-2 text-slate-500">
                Add a new medicine variant.
            </p>
        </div>

        <a
            href="{{ route('medicine-items.index', ['medicine' => $this->medicine_id]) }}"
            wire:navigate
            class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">
            Back
        </a>

    </div>


    {{-- Form --}}
    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

        <form wire:submit="create">

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                {{-- Medicine --}}
                <div class="md:col-span-2">

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Medicine
                    </label>
                    <p class="font-medium text-slate-800">
                        {{ $this->medicine_name }}
                    </p>

                    @error('medicine_id')
                    <span class="mt-1 block text-sm text-red-600">
                        {{ $message }}
                    </span>
                    @enderror

                </div>

                {{-- Code --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Code
                    </label>

                    <input
                        type="text"
                        wire:model="code"
                        placeholder="e.g. PAN-EXTRA-500"
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
                        placeholder="e.g. Panadol Extra"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">

                    @error('name')
                    <span class="mt-1 block text-sm text-red-600">
                        {{ $message }}
                    </span>
                    @enderror

                </div>

                {{-- Strength --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Strength
                    </label>

                    <input
                        type="text"
                        wire:model="strength"
                        placeholder="e.g. 500 mg"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">

                    @error('strength')
                    <span class="mt-1 block text-sm text-red-600">
                        {{ $message }}
                    </span>
                    @enderror

                </div>


                {{-- Dosage Form --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Dosage Form
                    </label>

                    <input
                        type="text"
                        wire:model="dosage_form"
                        placeholder="e.g. Tablet"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">

                    @error('dosage_form')
                    <span class="mt-1 block text-sm text-red-600">
                        {{ $message }}
                    </span>
                    @enderror

                </div>


                {{-- Unit --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Unit
                    </label>

                    <input
                        type="text"
                        wire:model="unit"
                        placeholder="e.g. Box"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">

                    @error('unit')
                    <span class="mt-1 block text-sm text-red-600">
                        {{ $message }}
                    </span>
                    @enderror

                </div>


                {{-- Barcode --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Barcode
                    </label>

                    <input
                        type="text"
                        wire:model="barcode"
                        placeholder="Optional"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">

                    @error('barcode')
                    <span class="mt-1 block text-sm text-red-600">
                        {{ $message }}
                    </span>
                    @enderror

                </div>

            </div>


            {{-- selling_price --}}
            <div>

                <label class="mb-2 block text-sm font-medium text-slate-700">
                    selling_price
                </label>

                <input
                    type="text"
                    wire:model="selling_price"
                    placeholder="100 EG"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">

                @error('selling_price')
                <span class="mt-1 block text-sm text-red-600">
                    {{ $message }}
                </span>
                @enderror

            </div>

    </div>


    {{-- Actions --}}
    <div class="mt-8 flex items-center justify-end gap-3">

        <a
            href="{{ route('medicine-items.index', ['medicine' => $this->medicine_id]) }}"
            wire:navigate
            class="rounded-xl bg-slate-100 px-5 py-3 font-medium text-slate-700 transition hover:bg-slate-200">
            Cancel
        </a>

        <button
            type="submit"
            class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">
            Create Medicine Item
        </button>

    </div>

    </form>

</div>

</div>