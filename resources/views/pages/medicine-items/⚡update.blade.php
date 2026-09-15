<?php

use App\Domains\Pharmacy\DTOs\MedicineItem\MedicineItemDTO;
use App\Domains\Pharmacy\Repositories\Contracts\MedicineItem\MedicineItemRepositoryInterface;
use App\Domains\Pharmacy\UseCases\MedicineItem\UpdateMedicineItemUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected UpdateMedicineItemUseCase $updateMedicineItemUseCase;
    protected MedicineItemRepositoryInterface $repository;

    public int $id;

    public int $medicine_id;

    public string $code = '';
    public string $name = '';
    public string $strength = '';
    public string $dosage_form = '';
    public string $unit = '';
    public string $barcode = '';
    public string $selling_price = '';


    public function boot(
        UpdateMedicineItemUseCase $updateMedicineItemUseCase,
        MedicineItemRepositoryInterface $repository
    ): void {
        $this->updateMedicineItemUseCase = $updateMedicineItemUseCase;
        $this->repository = $repository;
    }



    public function mount(int $id): void
    {
        $this->id = $id;
        $medicineItem = $this->repository->find($id);

        $this->medicine_id = $medicineItem->medicine_id;
        $this->code = $medicineItem->code;
        $this->name = $medicineItem->name;
        $this->strength = $medicineItem->strength ?? '';
        $this->dosage_form = $medicineItem->dosage_form ?? '';
        $this->unit = $medicineItem->unit ?? '';
        $this->barcode = $medicineItem->barcode ?? '';
        $this->selling_price = $medicineItem->selling_price;
    }

    public function update(): void
    {
        $this->validate([
            'medicine_id' => ['required', 'integer', 'exists:medicines,id'],
            'code' => ['required', 'string', 'max:255', 'unique:medicine_items,code,' . $this->id],
            'name' => ['required', 'string', 'max:255'],
            'strength' => ['nullable', 'string', 'max:255'],
            'dosage_form' => ['nullable', 'string', 'max:255'],
            'unit' => ['nullable', 'string', 'max:255'],
            'barcode' => [
                'nullable',
                'string',
                'max:255',
                'unique:medicine_items,barcode,' . $this->id,
            ],
            'selling_price' => ['nullable', 'numeric', 'decimal:0,2'],
        ]);

        $dto = MedicineItemDTO::fromArray([
            'medicine_id' => $this->medicine_id,
            'code' => $this->code,
            'name' => $this->name,
            'strength' => $this->strength ?: null,
            'dosage_form' => $this->dosage_form ?: null,
            'unit' => $this->unit ?: null,
            'barcode' => $this->barcode ?: null,
            'selling_price' => $this->selling_price,
        ]);

        $this->updateMedicineItemUseCase->execute(
            $this->id,
            $dto
        );

        $this->redirect(
            route('medicine-items.show', ['medicine' => $this->medicine_id, 'id' => $this->id]),
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
                Update Medicine Item
            </h1>

            <p class="mt-2 text-slate-500">
                Update medicine item information.
            </p>
        </div>

        <a
            href="{{ route('medicine-items.show', ['medicine' => $this->medicine_id,'id' => $this->id]) }}"
            wire:navigate
            class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">
            Back
        </a>

    </div>

    {{-- Form --}}
    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

        <form wire:submit="update">

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                {{-- Medicine --}}
                <div class="md:col-span-2">

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Medicine
                    </label>

                    <select
                        wire:model="medicine_id"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">

                        @foreach (\App\Models\Medicine::query()->where('status', 'active')->orderBy('name')->get() as $medicine)

                        <option value="{{ $medicine->id }}">
                            {{ $medicine->name }}
                        </option>

                        @endforeach

                    </select>

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

                {{-- Selling Price --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Selling
                    </label>

                    <input
                        type="text"
                        wire:model="selling_price"
                        placeholder="Optional"
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
                    href="{{ route('medicine-items.show', ['medicine' => $this->medicine_id,'id' => $this->id]) }}"
                    wire:navigate
                    class="rounded-xl bg-slate-100 px-5 py-3 font-medium text-slate-700 transition hover:bg-slate-200">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">
                    Update Medicine Item
                </button>

            </div>

        </form>

    </div>

</div>