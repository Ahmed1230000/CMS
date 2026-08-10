<?php

use App\Common\Exceptions\HandlesLivewireExceptions;
use App\Common\Traits\FlashMessageException;
use App\Domains\Authorization\DTOs\Roles\RolesDTO;
use App\Domains\Authorization\UseCases\Roles\CreateRolesUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    use FlashMessageException;

    protected CreateRolesUseCase $createRolesUseCase;

    public function boot(CreateRolesUseCase $createRolesUseCase): void
    {
        $this->createRolesUseCase = $createRolesUseCase;
    }

    public string $name = '';

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    public function create(): void
    {
        $data = [
            'name' => $this->name,
        ];

        $validation = $this->flashValidationMessage(
            $data,
            $this->rules()
        );

        if (!$validation) {
            return;
        }

        try {

            $dto = RolesDTO::fromArray($validation);

            $this->createRolesUseCase->execute($dto);

            session()->flash(
                'success',
                'Role created successfully. ' . $dto->name
            );

            $this->redirectRoute('roles.list');
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

                Create Role

            </h1>

            <p class="mt-2 text-slate-500">

                Create a new role for the system.

            </p>

        </div>

        <a
            href="{{ route('roles.list') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Cancel

        </a>

    </div>

    <form wire:submit="create">

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-8 py-6">

                <h2 class="text-lg font-semibold">

                    Role Information

                </h2>

                <p class="mt-1 text-sm text-slate-500">

                    Enter the basic information for the new role.

                </p>

            </div>

            <div class="space-y-6 p-8">

                <div>

                    <label class="mb-2 block text-sm font-medium">

                        Role Name

                    </label>

                    <input
                        type="text"
                        wire:model.live="name"
                        placeholder="e.g. Administrator"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                </div>

            </div>

            <div class="flex items-center justify-end gap-4 border-t border-slate-200 bg-slate-50 px-8 py-5">

                <a
                    href="{{ route('roles.list') }}"
                    wire:navigate
                    class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">

                    Create Role

                </button>

            </div>

        </div>

    </form>

</div>