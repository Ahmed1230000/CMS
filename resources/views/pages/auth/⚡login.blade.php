<?php

use App\Common\Exceptions\HandlesLivewireExceptions;
use App\Domains\Identity\DTOs\Login\LoginDTO;
use App\Domains\Identity\UseCases\LoginUseCase\LoginUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.auth')] class extends Component
{
    use HandlesLivewireExceptions;
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    protected LoginUseCase $loginUseCase;

    /*
    |--------------------------------------------------------------------------
    | Boot
    |--------------------------------------------------------------------------
    */

    public function boot(LoginUseCase $loginUseCase): void
    {
        $this->loginUseCase = $loginUseCase;
    }

    /*
    |--------------------------------------------------------------------------
    | Validation Rules
    |--------------------------------------------------------------------------
    */

    protected function rules(): array
    {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        $data = $this->validate();
        try {

            $dto = LoginDTO::from([
                ...$data,
            ]);

            $this->loginUseCase->execute($dto);

            return $this->redirectRoute('dashboard');
        } catch (\Throwable $exception) {

            $this->handleException($exception);
        }
    }
};

?>

<form wire:submit="login" class="space-y-6">

    <div>

        <label class="mb-2 block text-sm font-medium">
            Email
        </label>

        <input
            type="email"
            wire:model.live="email"
            class="w-full rounded-lg border px-4 py-2">

        @error('email')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

    </div>

    <div>

        <label class="mb-2 block text-sm font-medium">
            Password
        </label>

        <input
            type="password"
            wire:model.live="password"
            class="w-full rounded-lg border px-4 py-2">

        @error('password')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

    </div>

    <label class="flex items-center gap-2">

        <input
            type="checkbox"
            wire:model="remember">

        <span class="text-sm">
            Remember me
        </span>

    </label>

    <button
        type="submit"
        class="w-full rounded-lg bg-blue-600 px-4 py-3 text-white hover:bg-blue-700">

        Login

    </button>

</form>