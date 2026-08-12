<?php

use App\Common\Traits\FlashMessageException;
use App\Domains\Identity\DTOs\Login\LoginDTO;
use App\Domains\Identity\UseCases\LoginUseCase\LoginUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.auth')] class extends Component
{
    use FlashMessageException;

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
        $data = [
            'email'    => $this->email,
            'password' => $this->password,
        ];

        $validation = $this->flashValidationMessage(
            $data,
            $this->rules()
        );

        if (!$validation) {
            return;
        }

        try {

            $dto = LoginDTO::from($validation);

            $this->loginUseCase->execute($dto);

            return $this->redirectRoute('dashboard');

        } catch (\Throwable $exception) {

            $this->handleException($exception);
        }
    }
};

?>

<div class="min-h-screen bg-slate-100">

    <div class="grid min-h-screen lg:grid-cols-2">

        <!-- ============================================================= -->
        <!-- Left Side -->
        <!-- ============================================================= -->

        <div class="relative hidden overflow-hidden bg-slate-950 lg:flex">

            <!-- Background decoration -->

            <div class="absolute -left-32 -top-32 h-96 w-96 rounded-full bg-blue-600/20 blur-3xl"></div>

            <div class="absolute -bottom-32 -right-32 h-96 w-96 rounded-full bg-cyan-500/10 blur-3xl"></div>

            <div class="relative flex w-full flex-col justify-between p-14">

                <!-- Brand -->

                <div>

                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-600 shadow-lg shadow-blue-600/30">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                class="h-6 w-6 text-white">

                                <path d="M12 5v14" />
                                <path d="M5 12h14" />

                            </svg>

                        </div>

                        <div>

                            <h1 class="text-xl font-bold tracking-wide text-white">

                                HMS

                            </h1>

                            <p class="text-xs text-slate-400">

                                Hospital Management System

                            </p>

                        </div>

                    </div>

                </div>

                <!-- Main Content -->

                <div class="max-w-lg">

                    <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-slate-800 bg-slate-900/70 px-4 py-2">

                        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>

                        <span class="text-sm text-slate-300">

                            Secure Hospital Platform

                        </span>

                    </div>

                    <h2 class="text-5xl font-bold leading-tight tracking-tight text-white">

                        Everything your hospital needs,

                        <span class="text-blue-500">

                            in one place.

                        </span>

                    </h2>

                    <p class="mt-6 max-w-md text-lg leading-8 text-slate-400">

                        Manage patients, doctors, appointments, roles and permissions from a single secure platform.

                    </p>

                    <!-- Features -->

                    <div class="mt-10 space-y-4">

                        <div class="flex items-center gap-4">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 text-blue-500">

                                ✓

                            </div>

                            <div>

                                <p class="font-medium text-white">

                                    Secure access

                                </p>

                                <p class="text-sm text-slate-500">

                                    Role-based authorization

                                </p>

                            </div>

                        </div>

                        <div class="flex items-center gap-4">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 text-blue-500">

                                ✓

                            </div>

                            <div>

                                <p class="font-medium text-white">

                                    Centralized management

                                </p>

                                <p class="text-sm text-slate-500">

                                    Keep your hospital operations organized

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Footer -->

                <div class="text-sm text-slate-600">

                    © {{ date('Y') }} HMS. All rights reserved.

                </div>

            </div>

        </div>


        <!-- ============================================================= -->
        <!-- Right Side -->
        <!-- ============================================================= -->

        <div class="flex items-center justify-center bg-white px-6 py-12 sm:px-10">

            <div class="w-full max-w-md">

                <!-- Mobile Logo -->

                <div class="mb-10 flex items-center gap-3 lg:hidden">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600">

                        <span class="text-xl font-bold text-white">

                            +

                        </span>

                    </div>

                    <div>

                        <h1 class="font-bold text-slate-900">

                            HMS

                        </h1>

                        <p class="text-xs text-slate-500">

                            Hospital Management System

                        </p>

                    </div>

                </div>

                <!-- Heading -->

                <div class="mb-10">

                    <p class="mb-3 text-sm font-semibold uppercase tracking-widest text-blue-600">

                        Welcome back

                    </p>

                    <h2 class="text-4xl font-bold tracking-tight text-slate-900">

                        Sign in to your account

                    </h2>

                    <p class="mt-3 text-slate-500">

                        Enter your credentials to access the hospital dashboard.

                    </p>

                </div>


                <!-- Login Form -->

                <form wire:submit="login" class="space-y-6">

                    <!-- Email -->

                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm font-semibold text-slate-700">

                            Email address

                        </label>

                        <div class="relative">

                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="h-5 w-5 text-slate-400">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25H4.5a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615A2.25 2.25 0 012.25 6.993V6.75" />

                                </svg>

                            </div>

                            <input
                                id="email"
                                type="email"
                                wire:model.live="email"
                                placeholder="you@example.com"
                                autocomplete="email"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">

                        </div>

                        @error('email')

                        <p class="mt-2 text-sm text-red-600">

                            {{ $message }}

                        </p>

                        @enderror

                    </div>


                    <!-- Password -->

                    <div>

                        <div class="mb-2 flex items-center justify-between">

                            <label
                                for="password"
                                class="block text-sm font-semibold text-slate-700">

                                Password

                            </label>

                        </div>

                        <div class="relative">

                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="h-5 w-5 text-slate-400">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0119.5 12.75v6A2.25 2.25 0 0117.25 21H6.75a2.25 2.25 0 01-2.25-2.25v-6a2.25 2.25 0 012.25-2.25z" />

                                </svg>

                            </div>

                            <input
                                id="password"
                                type="password"
                                wire:model.live="password"
                                placeholder="Enter your password"
                                autocomplete="current-password"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">

                        </div>

                        @error('password')

                        <p class="mt-2 text-sm text-red-600">

                            {{ $message }}

                        </p>

                        @enderror

                    </div>


                    <!-- Remember -->

                    <div class="flex items-center justify-between">

                        <label class="flex cursor-pointer items-center gap-3">

                            <input
                                type="checkbox"
                                wire:model="remember"
                                class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">

                            <span class="text-sm text-slate-600">

                                Remember me

                            </span>

                        </label>

                        <span class="text-sm text-slate-400">

                            Secure login

                        </span>

                    </div>


                    <!-- General Error -->

                    @error('general')

                    <div class="rounded-xl border border-red-100 bg-red-50 px-4 py-3">

                        <p class="text-sm font-medium text-red-700">

                            {{ $message }}

                        </p>

                    </div>

                    @enderror


                    <!-- Submit -->

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="login"
                        class="flex w-full items-center justify-center rounded-xl bg-blue-600 px-4 py-3.5 font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-70">

                        <span wire:loading.remove wire:target="login">

                            Sign in

                        </span>

                        <span
                            wire:loading
                            wire:target="login"
                            class="flex items-center gap-2">

                            <svg
                                class="h-5 w-5 animate-spin"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24">

                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4">
                                </circle>

                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                                </path>

                            </svg>

                            Signing in...

                        </span>

                    </button>

                </form>


                <!-- Security Notice -->

                <div class="mt-10 flex items-start gap-3 rounded-xl border border-slate-100 bg-slate-50 p-4">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="mt-0.5 h-5 w-5 shrink-0 text-emerald-500">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75m6.75 2.25a9.75 9.75 0 11-19.5 0 9.75 9.75 0 0119.5 0z" />

                    </svg>

                    <p class="text-xs leading-5 text-slate-500">

                        Your connection is protected. Only authorized hospital staff can access the management dashboard.

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>