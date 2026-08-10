<?php

use App\Common\Traits\FlashMessageException;
use App\Domains\Authorization\DTOs\Permission\PermissionDTO;
use App\Domains\Authorization\UseCases\Permission\CreatePermissionUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    use FlashMessageException;

    protected CreatePermissionUseCase $createPermissionUseCase;

    public function boot(CreatePermissionUseCase $createPermissionUseCase)
    {
        $this->createPermissionUseCase = $createPermissionUseCase;
    }

    public $name = '';

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    public function create()
    {
        $data = [
            'name' => $this->name,
        ];

        $validation =  $this->flashValidationMessage($data, $this->rules());

        if (!$validation) {
            return;
        }
        try {
            $dto = PermissionDTO::fromArray($validation);

            $this->createPermissionUseCase->execute($dto);

            session()->flash(
                'success',
                'Permission created successfully. ' . $dto->name
            );

            $this->redirectRoute('permissions.list');
        } catch (\Throwable $exception) {

            $this->handleException($exception);
        };
    }
};
?>

<div class="max-w-4xl">

    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Create Permission

            </h1>

            <p class="mt-2 text-slate-500">

                Create a new permission for the system.

            </p>

        </div>

        <a
            href="{{ route('permissions.list') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Cancel

        </a>

    </div>

    <form wire:submit="create">

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-8 py-6">

                <h2 class="text-lg font-semibold">

                    Permission Information

                </h2>

                <p class="mt-1 text-sm text-slate-500">

                    Enter the basic information for the new permission.

                </p>

            </div>

            <div class="space-y-6 p-8">

                <div>

                    <label class="mb-2 block text-sm font-medium">

                        Permission Name

                    </label>

                    <input
                        type="text"
                        wire:model.live="name"
                        placeholder="e.g. users.create"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                </div>

            </div>

            <div class="flex items-center justify-end gap-4 border-t border-slate-200 bg-slate-50 px-8 py-5">

                <a
                    href="{{ route('permissions.list') }}"
                    wire:navigate
                    class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">

                    Create Permission

                </button>

            </div>

        </div>

    </form>

</div>