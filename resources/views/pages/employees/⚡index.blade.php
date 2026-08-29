<?php

use App\Common\Traits\FlashMessageException;
use App\Domains\Employee\UseCases\Employee\DeleteEmployeeUseCase;
use App\Domains\Employee\UseCases\ListEmplyeesUseCase\ListEmplyeesUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    use FlashMessageException;

    protected ListEmplyeesUseCase $listEmplyeesUseCase;
    protected DeleteEmployeeUseCase $deleteEmployeeUseCase;

    public function boot(
        ListEmplyeesUseCase $listEmplyeesUseCase,
        DeleteEmployeeUseCase $deleteEmployeeUseCase
    ): void {
        $this->listEmplyeesUseCase = $listEmplyeesUseCase;
        $this->deleteEmployeeUseCase = $deleteEmployeeUseCase;
    }

    #[Computed]
    public function employees()
    {
        return $this->listEmplyeesUseCase->execute();
    }

    public function delete(int $id)
    {
        try {
            $this->deleteEmployeeUseCase->execute($id);

            unset($this->employees);

            session()->flash(
                'success',
                'Employee deleted successfully.'
            );
        } catch (\Exception $exception) {
            $this->handleException($exception);
        }
    }
};
?>

<div>

    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Employees
            </h1>

            <p class="mt-2 text-slate-500">
                Manage hospital employees.
            </p>

        </div>

        <a
            href="{{ route('employees.create') }}"
            wire:navigate
            class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 font-medium text-white transition hover:bg-blue-700">

            + Create Employee

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
                        Employee Number
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold">
                        Job Title
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

                @forelse ($this->employees as $employee)

                <tr class="border-b last:border-b-0">

                    <td class="px-6 py-4">
                        {{ $employee->id }}
                    </td>

                    <td class="px-6 py-4">

                        <a
                            href="{{ route('employees.show', $employee->id) }}"
                            wire:navigate
                            class="font-medium text-blue-600 transition hover:underline">

                            {{ $employee->name }}

                        </a>

                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $employee->employee_number }}
                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $employee->job_title }}
                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $employee->phone }}
                    </td>

                    <td class="px-6 py-4">

                        @if ($employee->is_active)

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
                                href="{{ route('employees.show', $employee->id) }}"
                                wire:navigate
                                class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">

                                View

                            </a>

                            <a
                                href="{{ route('employees.update', $employee->id) }}"
                                wire:navigate
                                class="rounded-lg bg-blue-100 px-3 py-2 text-sm font-medium text-blue-700 transition hover:bg-blue-200">

                                Update

                            </a>
                            <button
                                type="button"
                                wire:click="delete({{ $employee->id }})"
                                wire:confirm="Are you sure you want to delete this {{ $employee->name }}?"
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

                        No employees found.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <div class="mt-6">

        {{ $this->employees->links() }}

    </div>

</div>