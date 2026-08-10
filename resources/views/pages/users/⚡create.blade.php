<?php

use App\Common\Exceptions\HandlesLivewireExceptions;
use App\Domains\Identity\DTOs\Register\RegisterDTO;
use App\Domains\Identity\UseCases\RegisterUseCase\RegisterUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    use HandlesLivewireExceptions;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    public string $name = '';

    public string $email = '';

    public string $password = '';

    protected RegisterUseCase $registerUseCase;

    /*
    |--------------------------------------------------------------------------
    | Boot
    |--------------------------------------------------------------------------
    */

    public function boot(RegisterUseCase $registerUseCase): void
    {
        $this->registerUseCase = $registerUseCase;
    }

    /*
    |--------------------------------------------------------------------------
    | Validation Rules
    |--------------------------------------------------------------------------
    */

    protected function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Create User
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $data = $this->validateRequest();

        if ($data === null) {
            return;
        }

        try {

            $dto = RegisterDTO::from($data);

            $this->registerUseCase->execute($dto);

            session()->flash(
                'success',
                'User created successfully.'
            );

            return $this->redirectRoute('users.index');
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

                Create User

            </h1>

            <p class="mt-2 text-slate-500">

                Create a new user account.

            </p>

        </div>

        <a
            href="{{ route('users.index') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Cancel

        </a>

    </div>

    <form wire:submit="create">

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-8 py-6">

                <h2 class="text-lg font-semibold">

                    Basic Information

                </h2>

                <p class="mt-1 text-sm text-slate-500">

                    Fill in the user's basic account information.

                </p>

            </div>

            <div class="space-y-6 p-8">

                <div>

                    <label class="mb-2 block text-sm font-medium">

                        Full Name

                    </label>

                    <input
                        type="text"
                        wire:model.live="name"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                </div>

                <div>

                    <label class="mb-2 block text-sm font-medium">

                        Email Address

                    </label>

                    <input
                        type="email"
                        wire:model.live="email"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                </div>

                <div>

                    <label class="mb-2 block text-sm font-medium">

                        Password

                    </label>

                    <input
                        type="password"
                        wire:model.live="password"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                </div>

            </div>

            <div class="flex items-center justify-end gap-4 border-t border-slate-200 bg-slate-50 px-8 py-5">

                <a
                    href="{{ route('users.index') }}"
                    wire:navigate
                    class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">

                    Create User

                </button>

            </div>

        </div>

    </form>

</div>