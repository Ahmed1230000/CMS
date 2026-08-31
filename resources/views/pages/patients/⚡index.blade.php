<?php

use App\Common\Traits\FlashMessageException;
use App\Domains\Patient\UseCases\ListPatientsUseCase\ListPatientsUseCase;
use App\Domains\Patient\UseCases\Patient\DeletePatientUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    use FlashMessageException;

    protected ListPatientsUseCase $listPatientsUseCase;
    protected DeletePatientUseCase $deletePatientUseCase;

    public function boot(
        ListPatientsUseCase $listPatientsUseCase,
        DeletePatientUseCase $deletePatientUseCase
    ): void {
        $this->listPatientsUseCase = $listPatientsUseCase;
        $this->deletePatientUseCase = $deletePatientUseCase;
    }

    #[Computed]
    public function patients()
    {
        return $this->listPatientsUseCase->execute();
    }

    public function delete(int $id)
    {
        try {
            $this->deletePatientUseCase->execute($id);
            unset($this->patients);

            session()->flash(
                'success',
                'Patient deleted successfully.'
            );
        } catch (\Exception $e) {
            $this->handleException($e);
        }
    }
};
?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Patients
            </h1>

            <p class="mt-2 text-slate-500">
                Manage all hospital patients.
            </p>

        </div>

        <a
            href="{{ route('patients.create') }}"
            wire:navigate
            class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 font-medium text-white transition hover:bg-blue-700">

            + Create Patient

        </a>

    </div>


    {{-- Patients Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <table class="min-w-full">

            <thead class="border-b bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        #ID
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Patient Number
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Name
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Phone
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Gender
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

                @forelse ($this->patients as $patient)

                <tr class="border-b last:border-b-0">

                    <td class="px-6 py-4">
                        {{ $patient->id }}
                    </td>

                    <td class="px-6 py-4">

                        <a
                            href="{{ route('patients.show', $patient->id) }}"
                            wire:navigate
                            class="font-medium text-blue-600 transition hover:underline">

                            {{ $patient->patient_number }}

                        </a>

                    </td>

                    <td class="px-6 py-4 text-slate-800">
                        {{ $patient->name }}
                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ $patient->phone }}
                    </td>

                    <td class="px-6 py-4 text-slate-600">
                        {{ ucfirst($patient->gender) }}
                    </td>

                    <td class="px-6 py-4">

                        @if ($patient->is_active)

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
                                href="{{ route('patients.show', $patient->id) }}"
                                wire:navigate
                                class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">

                                View

                            </a>

                            <a
                                href="{{ route('patients.update', $patient->id) }}"
                                wire:navigate
                                class="rounded-lg bg-blue-100 px-3 py-2 text-sm font-medium text-blue-700 transition hover:bg-blue-200">

                                Update

                            </a>

                            <button
                                type="button"
                                wire:click="delete({{ $patient->id }})"
                                wire:confirm="Are you sure you want to delete this patient? {{$patient->name}}"
                                class="rounded-lg bg-red-100 px-3 py-2 text-sm font-medium text-red-700 transition hover:bg-red-200">

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

                        No patients found.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    <div class="mt-6">

        {{ $this->patients->links() }}

    </div>

</div>