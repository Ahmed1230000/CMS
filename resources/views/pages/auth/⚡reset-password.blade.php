<?php

use App\Domains\Identity\DTOs\ForgetPassword\ResetPasswordDTO;
use App\Domains\Identity\UseCases\ForgetPasswordUseCase\ForgetPasswordUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.auth')] class extends Component
{
    public string $token = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function mount(string $token): void
    {
        $this->token = $token;
        $this->email = request()->query('email', '');
    }

    protected function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function resetPassword(
        ForgetPasswordUseCase $forgetPasswordUseCase
    ): void {


        $validated = $this->validate();

        $dto = ResetPasswordDTO::fromArray([
            'email' => $validated['email'],
            'token' => $this->token,
            'password' => $validated['password'],
            'password_confirmation' => $this->password_confirmation,
        ]);

        $forgetPasswordUseCase->resetPassword($dto);

        session()->flash(
            'success',
            'Your password has been reset successfully. You can now log in.'
        );

        $this->redirectRoute('login', navigate: true);
    }
};
?>

<div class="min-h-screen bg-white">
    <div class="grid min-h-screen lg:grid-cols-2">

        {{-- Left Side --}}
        <div class="hidden bg-slate-950 lg:flex lg:flex-col lg:justify-between lg:p-12">
            <div>
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-lg font-bold text-white">
                        H
                    </div>

                    <span class="text-xl font-bold text-white">
                        HMS
                    </span>
                </div>
            </div>

            <div>
                <h1 class="max-w-lg text-5xl font-bold leading-tight text-white">
                    Reset your password
                </h1>

                <p class="mt-6 max-w-lg text-lg leading-8 text-slate-400">
                    Create a new secure password for your account and get back
                    to managing your healthcare securely.
                </p>
            </div>

            <p class="text-sm text-slate-500">
                Secure healthcare management system
            </p>
        </div>

        {{-- Right Side --}}
        <div class="flex items-center justify-center px-6 py-12 sm:px-10 lg:px-16">
            <div class="w-full max-w-md">

                <div class="mb-10">
                    <h2 class="text-4xl font-bold tracking-tight text-slate-950">
                        Reset your password
                    </h2>

                    <p class="mt-3 text-base leading-7 text-slate-500">
                        Enter your new password below to reset your account password.
                    </p>
                </div>

                @if (session()->has('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
                @endif

                <form wire:submit="resetPassword" class="space-y-6">

                    {{-- Email --}}
                    <div>
                        <label
                            for="email"
                            class="mb-2 block text-sm font-semibold text-slate-800">
                            Email address
                        </label>

                        <input
                            id="email"
                            type="email"
                            wire:model="email"
                            readonly
                            class="block w-full rounded-xl border border-slate-200 bg-slate-100 px-4 py-3.5 text-slate-600 outline-none" />

                        @error('email')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label
                            for="password"
                            class="mb-2 block text-sm font-semibold text-slate-800">
                            New password
                        </label>

                        <input
                            id="password"
                            type="password"
                            wire:model="password"
                            autocomplete="new-password"
                            placeholder="Enter your new password"
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100" />

                        @error('password')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label
                            for="password_confirmation"
                            class="mb-2 block text-sm font-semibold text-slate-800">
                            Confirm new password
                        </label>

                        <input
                            id="password_confirmation"
                            type="password"
                            wire:model="password_confirmation"
                            autocomplete="new-password"
                            placeholder="Confirm your new password"
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100" />

                        @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="flex w-full items-center justify-center rounded-xl bg-blue-600 px-4 py-3.5 text-base font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-60">
                        <span wire:loading.remove>
                            Reset password
                        </span>

                        <span wire:loading>
                            Resetting password...
                        </span>
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <a
                        href="{{ route('login') }}"
                        wire:navigate
                        class="text-sm font-semibold text-slate-500 transition hover:text-blue-600">
                        ← Back to login
                    </a>
                </div>

                <div class="mt-10 rounded-xl border border-slate-200 bg-slate-50 px-5 py-4">
                    <div class="flex gap-3">
                        <div class="mt-0.5 text-emerald-500">
                            ✓
                        </div>

                        <p class="text-sm leading-6 text-slate-500">
                            Your password reset link is temporary and can only
                            be used within the allowed reset period.
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>