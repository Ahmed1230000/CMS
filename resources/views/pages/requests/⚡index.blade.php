<?php

use App\Domains\Request\UseCases\IndexRequestUseCase\IndexRequestUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected IndexRequestUseCase $indexRequestUseCase;

    public function boot(
        IndexRequestUseCase $indexRequestUseCase
    ): void {
        $this->indexRequestUseCase = $indexRequestUseCase;
    }

    #[Computed]
    public function requests()
    {
        return $this->indexRequestUseCase->execute();
    }
};

?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Requests
            </h1>

            <p class="mt-2 text-slate-500">
                Manage system requests.
            </p>
        </div>

        <a
            href="{{ route('requests.create') }}"
            wire:navigate
            class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 font-medium text-white transition hover:bg-blue-700">
            + Create Request
        </a>

    </div>


    {{-- Requests Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <table class="min-w-full">

            <thead class="border-b bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        #ID
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Requester
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Type
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Reason
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Status
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Created At
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($this->requests as $request)

                <tr class="border-b last:border-b-0">

                    {{-- ID --}}
                    <td class="px-6 py-4">
                        {{ $request->id }}
                    </td>

                    {{-- Requester --}}
                    <td class="px-6 py-4">

                        <a
                            href="{{ route('requests.show', $request->id) }}"
                            wire:navigate
                            class="font-medium text-blue-600 transition hover:underline">

                            {{ $request->requester_name }}

                        </a>

                    </td>

                    {{-- Type --}}
                    <td class="px-6 py-4 text-slate-600">
                        {{ $request->type }}
                    </td>

                    {{-- Reason --}}
                    <td class="px-6 py-4 text-slate-600">
                        {{ $request->reason ?: '—' }}
                    </td>

                    {{-- Status --}}
                    <td class="px-6 py-4">

                        @if ($request->status?->value === 'pending')

                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-medium text-amber-700">
                            Pending
                        </span>

                        @elseif ($request->status?->value === 'approved')

                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                            Approved
                        </span>

                        @elseif ($request->status?->value === 'rejected')

                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">
                            Rejected
                        </span>

                        @elseif ($request->status?->value === 'cancelled')

                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                            Cancelled
                        </span>

                        @endif

                    </td>

                    {{-- Created At --}}
                    <td class="px-6 py-4 text-slate-600">
                        {{ $request->created_at }}
                    </td>

                    {{-- Actions --}}
                    <td class="px-6 py-4">

                        <div class="flex items-center gap-2">

                            <a
                                href="{{ route('requests.show', $request->id) }}"
                                wire:navigate
                                class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">
                                View
                            </a>
                            <a
                                href="{{ route('requests.update', $request->id) }}"
                                wire:navigate
                                class="rounded-lg bg-blue-100 px-3 py-2 text-sm font-medium text-blue-700 transition hover:bg-blue-200">
                                Update
                            </a>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td
                        colspan="7"
                        class="px-6 py-12 text-center text-slate-500">

                        No requests found.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    <div class="mt-6">
        {{ $this->requests->links() }}
    </div>

</div>