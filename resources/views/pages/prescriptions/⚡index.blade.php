<?php

use App\Domains\Prescription\DTOs\Prescription\IndexPrescriptionDTO;
use App\Domains\Prescription\UseCases\IndexPrescriptionUseCase\IndexPrescriptionUseCase;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts.dashboard')] class extends Component
{
    use WithPagination;

    protected IndexPrescriptionUseCase $indexPrescriptionUseCase;

    public function boot(
        IndexPrescriptionUseCase $indexPrescriptionUseCase
    ): void {
        $this->indexPrescriptionUseCase = $indexPrescriptionUseCase;
    }
    public function index()
    {
        return $this->indexPrescriptionUseCase->execute();
    }
};
?>

<div>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Prescriptions
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage prescriptions.
            </p>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">

                <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-6 py-4">#</th>
                        <th class="px-6 py-4">Patient</th>
                        <th class="px-6 py-4">Doctor</th>
                        <th class="px-6 py-4">Appointment</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Created At</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse ($this->index() as $prescription)

                    <tr wire:key="prescription-{{ $prescription->id }}">

                        <td class="px-6 py-4 font-medium text-slate-800">
                            #{{ $prescription->id }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $prescription->patient_name }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $prescription->doctor_name }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $prescription->appointment_date }}
                        </td>

                        <td class="px-6 py-4">
                            <span
                                @class([ 'inline-flex rounded-full px-3 py-1 text-xs font-medium' , 'bg-green-100 text-green-700'=>
                                $prescription->status === 'active',
                                'bg-red-100 text-red-700' =>
                                $prescription->status === 'cancelled',
                                ])
                                >
                                {{ ucfirst($prescription->status) }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            {{ $prescription->created_at }}
                        </td>

                        <td class="px-6 py-4 text-right">
                            <a
                                href="{{ route('prescriptions.show', $prescription->id) }}"
                                wire:navigate
                                class="font-medium text-blue-600 hover:text-blue-800">
                                View
                            </a>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td
                            colspan="7"
                            class="px-6 py-10 text-center text-slate-500">
                            No prescriptions found.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

        <div class="border-t border-slate-100 px-6 py-4">
            {{ $this->index()->links() }}
        </div>

    </div>
</div>