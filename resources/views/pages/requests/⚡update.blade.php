<?php

use App\Domains\Request\DTOs\Request\RequestDTO;
use App\Domains\Request\Repositories\Contracts\Request\RequestRepositoryInterface;
use App\Domains\Request\UseCases\Request\UpdateRequestUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected UpdateRequestUseCase $updateRequestUseCase;
    protected RequestRepositoryInterface $repository;

    public int $id;

    public string $type = '';
    public string $reason = '';

    public function boot(
        UpdateRequestUseCase $updateRequestUseCase,
        RequestRepositoryInterface $repository
    ): void {
        $this->updateRequestUseCase = $updateRequestUseCase;
        $this->repository = $repository;
    }

    public function mount(int $id): void
    {
        $this->id = $id;

        $request = $this->repository->find($id);

        $this->type = $request->type;
        $this->reason = $request->reason ?? '';
    }

    public function update(): void
    {
        $this->validate([
            'type' => ['required', 'string', 'max:255'],
            'reason' => ['nullable', 'string'],
        ]);

        $request = $this->repository->find($this->id);

        $dto = RequestDTO::fromArray([
            'type' => $this->type,
            'reason' => $this->reason ?: null,
        ]);

        $this->updateRequestUseCase->execute(
            $request,
            $dto
        );

        $this->redirect(
            route('requests.show', $this->id),
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
                Update Request
            </h1>

            <p class="mt-2 text-slate-500">
                Update request information.
            </p>
        </div>

        <a
            href="{{ route('requests.show', $id) }}"
            wire:navigate
            class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">
            Back
        </a>

    </div>


    {{-- Form --}}
    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

        <form wire:submit="update">

            <div class="grid grid-cols-1 gap-6">

                {{-- Type --}}
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Request Type
                    </label>

                    <input
                        type="text"
                        wire:model="type"
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
                    href="{{ route('requests.show', $id) }}"
                    wire:navigate
                    class="rounded-xl bg-slate-100 px-5 py-3 font-medium text-slate-700 transition hover:bg-slate-200">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">
                    Update Request
                </button>

            </div>

        </form>

    </div>

</div>