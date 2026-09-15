<?php

use App\Domains\Request\DTOs\Request\RequestDTO;
use App\Domains\Request\UseCases\Request\CreateRequestUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected CreateRequestUseCase $createRequestUseCase;

    public string $type = '';

    public string $reason = '';

    public function boot(
        CreateRequestUseCase $createRequestUseCase
    ): void {
        $this->createRequestUseCase = $createRequestUseCase;
    }

    public function create(): void
    {
        $this->validate([
            'type' => ['required', 'string', 'max:255'],
            'reason' => ['nullable', 'string'],
        ]);

        $dto = RequestDTO::fromArray([
            'type' => $this->type,
            'reason' => $this->reason ?: null,
        ]);

        $request = $this->createRequestUseCase->execute($dto);

        $this->redirect(
            route('requests.show', $request->id),
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
                Create Request
            </h1>

            <p class="mt-2 text-slate-500">
                Create a new system request.
            </p>
        </div>

        <a
            href="{{ route('requests.index') }}"
            wire:navigate
            class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">
            Back
        </a>

    </div>


    {{-- Form --}}
    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

        <form wire:submit="create">

            <div class="grid grid-cols-1 gap-6">

                {{-- Type --}}
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Request Type
                    </label>

                    <input
                        type="text"
                        wire:model="type"
                        placeholder="e.g. leave_request"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">

                    @error('type')
                    <span class="mt-1 block text-sm text-red-600">
                        {{ $message }}
                    </span>
                    @enderror
                </div>


                {{-- Reason --}}
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Reason
                    </label>

                    <textarea
                        wire:model="reason"
                        rows="5"
                        placeholder="Enter the request reason..."
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"></textarea>

                    @error('reason')
                    <span class="mt-1 block text-sm text-red-600">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

            </div>


            {{-- Actions --}}
            <div class="mt-8 flex items-center justify-end gap-3">

                <a
                    href="{{ route('requests.index') }}"
                    wire:navigate
                    class="rounded-xl bg-slate-100 px-5 py-3 font-medium text-slate-700 transition hover:bg-slate-200">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">
                    Create Request
                </button>

            </div>

        </form>

    </div>

</div>