<?php

use App\Domains\Identity\UseCases\SendVerificationEmailUseCase\SendVerificationEmailUseCase;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts.auth')] #[Title('Verification Email')] class extends Component
{
    protected SendVerificationEmailUseCase $sendVerificationEmailUseCase;

    public function boot(SendVerificationEmailUseCase $sendVerificationEmailUseCase)
    {
        $this->sendVerificationEmailUseCase = $sendVerificationEmailUseCase;
    }
    public function mount()
    {
        if (auth()->user()->hasVerifiedEmail()) {
            $this->redirectRoute('login');
        }
    }
    public function resendVerificationEmail(): void
    {
        $this->sendVerificationEmailUseCase->execute(
            auth()->user()
        );

        session()->flash(
            'status',
            'A new verification link has been sent to your email address.'
        );
    }
};
?>

<div class="min-h-screen bg-slate-50 flex items-center justify-center px-4 py-12">

    <div class="w-full max-w-md">

        {{-- Card --}}
        <div class="rounded-2xl bg-white p-8 shadow-sm ring-1 ring-slate-200">

            {{-- Icon --}}
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-50">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8 text-blue-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>

            {{-- Heading --}}
            <div class="mt-6 text-center">

                <h1 class="text-2xl font-bold text-slate-900">
                    Verify your email
                </h1>

                <p class="mt-3 text-sm leading-6 text-slate-500">
                    We've sent a verification link to your email address.
                    Please check your inbox and click the link to verify your account.
                </p>

            </div>

            {{-- User email --}}
            @auth
            <div class="mt-5 rounded-lg bg-slate-50 px-4 py-3 text-center">
                <p class="text-sm font-medium text-slate-700">
                    {{ auth()->user()->email }}
                </p>
            </div>
            @endauth

            {{-- Success message --}}
            @if (session('status'))
            <div class="mt-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3">
                <p class="text-sm text-green-700">
                    {{ session('status') }}
                </p>
            </div>
            @endif

            {{-- Resend --}}
            <div class="mt-6">

                <button
                    type="button"
                    wire:click="resendVerificationEmail"
                    wire:loading.attr="disabled"
                    wire:target="resendVerificationEmail"
                    class="flex w-full items-center justify-center rounded-lg bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-60">

                    <span wire:loading.remove wire:target="resendVerificationEmail">
                        Resend verification email
                    </span>

                    <span wire:loading wire:target="resendVerificationEmail">
                        Sending...
                    </span>

                </button>

            </div>

        </div>

        {{-- Security notice --}}
        <p class="mt-6 text-center text-xs leading-5 text-slate-400">
            If you didn't create an account, you can safely ignore this email.
        </p>

    </div>

</div>