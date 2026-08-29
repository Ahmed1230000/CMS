<?php

use App\Common\Traits\FlashMessageException;
use App\Domains\Department\UseCases\Department\DeleteDepartmentUseCase;
use App\Domains\Department\UseCases\ListDepartmentsUseCase\ListDepartmentsUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    use FlashMessageException;

    protected ListDepartmentsUseCase $listDepartmentsUseCase;

    protected DeleteDepartmentUseCase $deleteDepartmentUseCase;

    public function boot(
        ListDepartmentsUseCase $listDepartmentsUseCase,
        DeleteDepartmentUseCase $deleteDepartmentUseCase
    ): void {
        $this->listDepartmentsUseCase = $listDepartmentsUseCase;
        $this->deleteDepartmentUseCase = $deleteDepartmentUseCase;
    }

    #[Computed]
    public function departments()
    {
        return $this->listDepartmentsUseCase->execute();
    }

    public function delete(int $id): void
    {
        try {

            $this->deleteDepartmentUseCase->execute($id);

            unset($this->departments);

            session()->flash(
                'success',
                'Department deleted successfully.'
            );
        } catch (\Throwable $exception) {

            $this->handleException($exception);
        }
    }
};
?>

<div>

    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Departments
            </h1>

            <p class="mt-2 text-slate-500">
                Manage all hospital departments.
            </p>

        </div>

        <a
            href="{{ route('departments.create') }}"
            wire:navigate
            class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 font-medium text-white transition hover:bg-blue-700">

            + Create Department

        </a>

    </div>

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
                        Code
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold">
                        Status
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold">
                        Created At
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($this->departments as $department)

                <tr class="border-b last:border-b-0">

                    <td class="px-6 py-4">
                        {{ $department->id }}
                    </td>

                    <td class="px-6 py-4">

                        <a
                            href="{{ route('departments.show', $department->id) }}"
                            wire:navigate
                            class="font-medium text-blue-600 transition hover:underline">

                            {{ $department->name }}

                        </a>

                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $department->code }}
                    </td>

                    <td class="px-6 py-4">

                        @if ($department->is_active)

                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                            Active
                        </span>

                        @else

                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">
                            Inactive
                        </span>

                        @endif

                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $department->created_at->format('Y-m-d H:i:s') }}
                    </td>

                    <td class="px-6 py-4">

                        <div class="flex items-center gap-2">

                            <a
                                href="{{ route('departments.show', $department->id) }}"
                                wire:navigate
                                class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">

                                View

                            </a>
                            <a
                                href="{{ route('departments.edit', $department->id) }}"
                                wire:navigate
                                class="rounded-lg bg-blue-600 px-3 py-2 text-sm font-medium text-white transition hover:bg-blue-700">

                                Update

                            </a>

                            <button
                                type="button"
                                wire:click="delete({{ $department->id }})"
                                wire:confirm="Are you sure you want to delete this department?"
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
                        colspan="6"
                        class="px-6 py-12 text-center text-slate-500">

                        No departments found.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">

        {{ $this->departments->links() }}

    </div>

</div>