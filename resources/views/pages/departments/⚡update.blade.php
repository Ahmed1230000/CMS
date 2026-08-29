<?php

use App\Common\Traits\FlashMessageException;
use App\Domains\Department\DTOs\Department\DepartmentDTO;
use App\Domains\Department\Entities\Department\DepartmentEntity;
use App\Domains\Department\UseCases\Department\UpdateDepartmentUseCase;
use App\Domains\Department\UseCases\ShowDepartmentUseCase\ShowDepartmentUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    use FlashMessageException;

    protected UpdateDepartmentUseCase $updateDepartmentUseCase;

    protected ShowDepartmentUseCase $showDepartmentUseCase;

    public int $department_id;

    public string $name = '';

    public string $code = '';

    public string $description = '';

    public bool $is_active = true;

    public function boot(
        UpdateDepartmentUseCase $updateDepartmentUseCase,
        ShowDepartmentUseCase $showDepartmentUseCase
    ): void {
        $this->updateDepartmentUseCase = $updateDepartmentUseCase;
        $this->showDepartmentUseCase = $showDepartmentUseCase;
    }

    public function mount(int $id): void
    {
        $this->department_id = $id;

        $department = $this->showDepartmentUseCase->execute($id);

        $this->name = $department->name;
        $this->code = $department->code;
        $this->description = $department->description ?? '';
        $this->is_active = $department->is_active;
    }

    protected function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'code' => [
                'required',
                'string',
                'max:50',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'is_active' => [
                'boolean',
            ],
        ];
    }

    public function update()
    {
        $data = [
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'is_active' => $this->is_active,
        ];

        $validation = $this->flashValidationMessage(
            $data,
            $this->rules()
        );

        if (!$validation) {
            return;
        }

        try {

            $departmentEntity = $this->showDepartmentUseCase->execute(
                $this->department_id
            );

            $dto = DepartmentDTO::fromArray($validation);

            $this->updateDepartmentUseCase->execute(
                $dto,
                $departmentEntity
            );

            session()->flash(
                'success',
                'Department updated successfully.'
            );

            return $this->redirectRoute(
                'departments.show',
                $this->department_id
            );

        } catch (\Throwable $exception) {

            $this->handleException($exception);
        }
    }
};
?>

<div class="max-w-4xl">

    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Edit Department
            </h1>

            <p class="mt-2 text-slate-500">
                Update department information.
            </p>

        </div>

        <a
            href="{{ route('departments.show', $department_id) }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Cancel

        </a>

    </div>

    <form wire:submit="update">

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-8 py-6">

                <p class="text-sm font-medium text-slate-500">
                    Department #{{ $department_id }}
                </p>

                <h2 class="mt-1 text-xl font-bold text-slate-800">
                    Department Information
                </h2>

            </div>

            <div class="space-y-6 p-8">

                {{-- Name --}}

                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Department Name
                    </label>

                    <input
                        type="text"
                        wire:model.live="name"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                    @error('name')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Code --}}

                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Department Code
                    </label>

                    <input
                        type="text"
                        wire:model.live="code"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 uppercase focus:border-blue-500 focus:outline-none">

                    @error('code')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Description --}}

                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Description
                    </label>

                    <textarea
                        wire:model.live="description"
                        rows="4"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none"></textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Active --}}

                <div class="flex items-center justify-between rounded-xl border border-slate-200 p-4">

                    <div>

                        <p class="font-medium text-slate-800">
                            Active Department
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            Allow this department to be used in the system.
                        </p>

                    </div>

                    <input
                        type="checkbox"
                        wire:model="is_active"
                        class="h-5 w-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500">

                </div>

            </div>

            <div class="flex items-center justify-end gap-4 border-t border-slate-200 bg-slate-50 px-8 py-5">

                <a
                    href="{{ route('departments.show', $department_id) }}"
                    wire:navigate
                    class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                    Cancel

                </a>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700 disabled:opacity-50">

                    <span wire:loading.remove>
                        Update Department
                    </span>

                    <span wire:loading>
                        Updating...
                    </span>

                </button>

            </div>

        </div>

    </form>

</div>