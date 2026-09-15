<?php

use App\Domains\Request\UseCases\ShowRequestUseCase\ShowRequestUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ShowRequestUseCase $showRequestUseCase;

    public int $id;

    public function boot(
        ShowRequestUseCase $showRequestUseCase
    ): void {
        $this->showRequestUseCase = $showRequestUseCase;
    }

    public function mount(int $id): void
    {
        $this->id = $id;
    }

    #[Computed]
    public function request()
    {
        return $this->showRequestUseCase->execute($this->id);
    }
};

?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Request Details
            </h1>

            <p class="mt-2 text-slate-500">
                View request information and status.
            </p>
        </div>

        <a
            href="{{ route('requests.index') }}"
            wire:navigate
            class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">
            Back
        </a>

    </div>


    {{-- Request Information --}}
    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

            {{-- ID --}}
            <div>
                <p class="text-sm text-slate-500">
                    ID
                </p>

                <p class="mt-1 font-medium text-slate-800">
                    {{ $this->request->id }}
                </p>
            </div>


            {{-- Requester --}}
            <div>
                <p class="text-sm text-slate-500">
                    Requester
                </p>

                <p class="mt-1 font-medium text-slate-800">
                    {{ $this->request->requester_name }}
                </p>
            </div>


            {{-- Type --}}
            <div>
                <p class="text-sm text-slate-500">
                    Type
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->request->type }}
                </p>
            </div>


            {{-- Status --}}
            <div>
                <p class="text-sm text-slate-500">
                    Status
                </p>

                <div class="mt-2">

                    @if ($this->request->status?->value === 'pending')

                    <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-medium text-amber-700">
                        Pending
                    </span>

                    @elseif ($this->request->status?->value === 'approved')

                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                        Approved
                    </span>

                    @elseif ($this->request->status?->value === 'rejected')

                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">
                        Rejected
                    </span>

                    @elseif ($this->request->status?->value === 'cancelled')

                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                        Cancelled
                    </span>

                    @endif

                </div>
            </div>


            {{-- Reason --}}
            <div class="md:col-span-2">

                <p class="text-sm text-slate-500">
                    Reason
                </p>

                <p class="mt-1 whitespace-pre-line text-slate-700">
                    {{ $this->request->reason ?: '—' }}
                </p>

            </div>


            {{-- Approved By --}}
            <div>
                <p class="text-sm text-slate-500">
                    Approved By
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->request->approved_by_name ?: '—' }}
                </p>
            </div>


            {{-- Approved At --}}
            <div>
                <p class="text-sm text-slate-500">
                    Approved At
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->request->approved_at ?: '—' }}
                </p>
            </div>


            {{-- Rejected By --}}
            <div>
                <p class="text-sm text-slate-500">
                    Rejected By
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->request->rejected_by_name ?: '—' }}
                </p>
            </div>


            {{-- Rejected At --}}
            <div>
                <p class="text-sm text-slate-500">
                    Rejected At
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->request->rejected_at ?: '—' }}
                </p>
            </div>


            {{-- Created At --}}
            <div>
                <p class="text-sm text-slate-500">
                    Created At
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->request->created_at }}
                </p>
            </div>


            {{-- Updated At --}}
            <div>
                <p class="text-sm text-slate-500">
                    Updated At
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->request->updated_at }}
                </p>
            </div>

        </div>

    </div>

</div>