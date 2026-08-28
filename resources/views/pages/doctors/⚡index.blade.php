<?php

use App\Domains\Doctor\UseCases\Doctor\DeleteDoctorUseCase;
use App\Domains\Doctor\UseCases\ListDoctorsUseCase\ListDoctorsUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ListDoctorsUseCase $listDoctorsUseCase;
    protected DeleteDoctorUseCase $deleteDoctorUseCase;

    public function boot(
        ListDoctorsUseCase $listDoctorsUseCase,
        DeleteDoctorUseCase $deleteDoctorUseCase
    ): void {
        $this->listDoctorsUseCase = $listDoctorsUseCase;
        $this->deleteDoctorUseCase = $deleteDoctorUseCase;
    }

    #[Computed]
    public function doctors()
    {
        return $this->listDoctorsUseCase->execute();
    }

    public function delete(int $id)
    {
        try {

            $this->deleteDoctorUseCase->execute($id);

            unset($this->doctors);

            session()->flash(
                'success',
                'Doctor deleted successfully.'
            );
        } catch (\Throwable $exception) {

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
                Doctors
            </h1>

            <p class="mt-2 text-slate-500">
                Manage all hospital doctors.
            </p>

        </div>

        <a
            href="{{ route('doctors.create') }}"
            wire:navigate
            class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 font-medium text-white transition hover:bg-blue-700">

            + Create Doctor

        </a>

    </div>


    {{-- Doctors Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <table class="min-w-full">

            <thead class="border-b bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        #ID
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        License Number
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Specialization
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Phone
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Email
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Status
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($this->doctors as $doctor)

                <tr class="border-b last:border-b-0">

                    <td class="px-6 py-4">
                        {{ $doctor->id }}
                    </td>

                    <td class="px-6 py-4">

                        <a
                            href="{{ route('doctors.show', $doctor->id) }}"
                            wire:navigate
                            class="font-medium text-blue-600 transition hover:underline">

                            {{ $doctor->license_number }}

                        </a>

                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $doctor->specialization }}
                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $doctor->phone }}
                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $doctor->email }}
                    </td>

                    <td class="px-6 py-4">

                        @if ($doctor->is_active)

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
                                href="{{ route('doctors.show', $doctor->id) }}"
                                wire:navigate
                                class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">

                                View

                            </a>

                            <a
                                href="{{ route('doctors.edit', $doctor->id) }}"
                                wire:navigate
                                class="rounded-lg bg-blue-100 px-3 py-2 text-sm font-medium text-blue-700 transition hover:bg-blue-200">

                                Update

                            </a>

                            <button
                                type="button"
                                wire:click="delete({{ $doctor->id }})"
                                wire:confirm="Are you sure you want to delete this doctor?"
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

                        No doctors found.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    <div class="mt-6">

        {{ $this->doctors->links() }}

    </div>

</div>