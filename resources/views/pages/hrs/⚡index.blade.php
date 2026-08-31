<?php

use App\Domains\Hr\UseCases\Hr\DeleteHrUseCase;
use App\Domains\Hr\UseCases\ListHrsUseCase\ListHrsUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ListHrsUseCase $listHrsUseCase;
    protected DeleteHrUseCase $deleteHrUseCase;

    public function boot(
        ListHrsUseCase $listHrsUseCase,
        DeleteHrUseCase $deleteHrUseCase

    ): void {
        $this->listHrsUseCase = $listHrsUseCase;
        $this->deleteHrUseCase = $deleteHrUseCase;
    }

    #[Computed]
    public function hrs()
    {
        return $this->listHrsUseCase->execute();
    }

    public function delete(int $id)
    {
        try{
            $this->deleteHrUseCase->execute($id);
            unset($this->hrs);

             session()->flash(
                'success',
                'Department deleted successfully.'
            );

        }catch (\Throwable $exception) {

            $this->handleException($exception);
        }
    }
};
?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                HR
            </h1>

            <p class="mt-2 text-slate-500">
                Manage hospital HR employees.
            </p>

        </div>

        <a
            href="{{ route('hrs.create') }}"
            wire:navigate
            class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 font-medium text-white transition hover:bg-blue-700">

            + Create HR

        </a>

    </div>


    {{-- Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <table class="min-w-full">

            <thead class="border-b bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-left text-sm font-semibold">
                        #ID
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold">
                        Name
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold">
                        Employee Number
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold">
                        Email
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold">
                        Phone
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold">
                        Status
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($this->hrs as $hr)

                <tr class="border-b last:border-b-0">

                    <td class="px-6 py-4">
                        {{ $hr->id }}
                    </td>

                    <td class="px-6 py-4">

                        <a
                            href="{{ route('hrs.show', $hr->id) }}"
                            wire:navigate
                            class="font-medium text-blue-600 transition hover:underline">

                            {{ $hr->name }}

                        </a>

                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $hr->employee_number }}
                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $hr->hospital_email }}
                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $hr->phone }}
                    </td>

                    <td class="px-6 py-4">

                        @if ($hr->is_active)

                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                            Active
                        </span>

                        @else

                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">
                            Inactive
                        </span>

                        @endif

                    </td>

                    <td class="px-6 py-4">

                        <div class="flex items-center gap-2">

                            <a
                                href="{{ route('hrs.show', $hr->id) }}"
                                wire:navigate
                                class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">

                                View

                            </a>

                            <a
                                href="{{ route('hrs.update', $hr->id) }}"
                                wire:navigate
                                class="rounded-lg bg-blue-100 px-3 py-2 text-sm font-medium text-blue-700 transition hover:bg-blue-200">

                                Update

                            </a>

                            <button
                                type="button"
                                wire:click="delete({{ $hr->id }})"
                                wire:confirm="Are you sure you want to delete this {{ $hr->name }}?"
                                wire:loading.attr="disabled"
                                class="rounded-lg bg-red-100 px-3 py-2 text-sm font-medium text-red-700 transition hover:bg-red-200 disabled:opacity-50">

                                Delete

                            </button>


                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td
                        colspan="7"
                        class="px-6 py-12 text-center text-slate-500">

                        No HR records found.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    <div class="mt-6">

        {{ $this->hrs->links() }}

    </div>

</div>