<?php

use App\Common\Traits\FlashMessageException;
use App\Domains\Hr\DTOs\Hr\HrDTO;
use App\Domains\Hr\Entities\Hr\HrEntity;
use App\Domains\Hr\UseCases\Hr\UpdateHrUseCase;
use App\Domains\Hr\UseCases\ShowHrUseCase\ShowHrUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    use FlashMessageException;

    protected ShowHrUseCase $showHrUseCase;

    protected UpdateHrUseCase $updateHrUseCase;

    public int $hr_id;

    public string $name = '';

    public string $employee_number = '';

    public string $phone = '';

    public string $personal_email = '';

    public string $gender = '';

    public string $date_of_birth = '';

    public string $national_id = '';

    public string $address = '';

    public string $hire_date = '';

    public string $job_title = '';

    public bool $is_active = true;

    public function boot(
        ShowHrUseCase $showHrUseCase,
        UpdateHrUseCase $updateHrUseCase
    ): void {
        $this->showHrUseCase = $showHrUseCase;
        $this->updateHrUseCase = $updateHrUseCase;
    }

    public function mount(int $id): void
    {
        $this->hr_id = $id;

        $hr = $this->showHrUseCase->execute($id);

        $this->employee_number = $hr->employee_number;
        $this->name = $hr->name;
        $this->phone = $hr->phone;
        $this->personal_email = $hr->email;
        $this->gender = $hr->gender;
        $this->date_of_birth = $hr->date_of_birth->format('Y-m-d');
        $this->national_id = $hr->national_id;
        $this->address = $hr->address ?? '';
        $this->hire_date = $hr->hire_date->format('Y-m-d');
        $this->job_title = $hr->job_title;
        $this->is_active = $hr->is_active;
    }

    protected function rules(): array
    {
        return [
            'employee_number' => [
                'required',
                'string',
                'max:100',
                'unique:hrs,employee_number,' . $this->hr_id,
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
            ],

            'personal_email' => [
                'required',
                'email',
                'max:255',
            ],

            'gender' => [
                'required',
                'string',
                'max:20',
            ],

            'date_of_birth' => [
                'required',
                'date',
            ],

            'national_id' => [
                'required',
                'string',
                'max:50',
                'unique:hrs,national_id,' . $this->hr_id,
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'hire_date' => [
                'required',
                'date',
            ],

            'job_title' => [
                'required',
                'string',
                'max:255',
            ],

            'is_active' => [
                'boolean',
            ],
        ];
    }

    public function update()
    {
        $data = [
            'employee_number' => $this->employee_number,
            'name'            => $this->name,
            'phone'           => $this->phone,
            'personal_email'  => $this->personal_email,
            'gender'          => $this->gender,
            'date_of_birth'   => $this->date_of_birth,
            'national_id'     => $this->national_id,
            'address'         => $this->address,
            'hire_date'       => $this->hire_date,
            'job_title'       => $this->job_title,
            'is_active'       => $this->is_active,
        ];

        $validation = $this->flashValidationMessage(
            $data,
            $this->rules()
        );

        if (!$validation) {
            return;
        }

        try {
            $hrEntity = $this->showHrUseCase->execute(
                $this->hr_id
            );

            $dto = HrDTO::fromArray([
                ...$validation,

                // CreateHrDTO fields not editable here.
                'email' => $hrEntity->email,
                'password' => '',
            ]);

            $this->updateHrUseCase->execute(
                $dto,
                $hrEntity
            );

            session()->flash(
                'success',
                'HR updated successfully.'
            );

            return $this->redirectRoute(
                'hrs.show',
                $this->hr_id
            );
        } catch (\Throwable $exception) {

            $this->handleException($exception);
        }
    }
};
?>

<div class="max-w-5xl">

    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Edit HR
            </h1>

            <p class="mt-2 text-slate-500">
                Update HR employee information.
            </p>

        </div>

        <a
            href="{{ route('hrs.show', $hr_id) }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Cancel

        </a>

    </div>

    <form wire:submit="update">

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-8 py-6">

                <p class="text-sm font-medium text-slate-500">
                    Employee #{{ $hr_id }}
                </p>

                <h2 class="mt-1 text-xl font-bold text-slate-800">
                    HR Information
                </h2>

            </div>

            <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2">

                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Employee Number
                    </label>

                    <input
                        type="text"
                        wire:model.live="employee_number"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                    @error('employee_number')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Full Name
                    </label>

                    <input
                        type="text"
                        wire:model.live="name"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                    @error('name')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Phone
                    </label>

                    <input
                        type="text"
                        wire:model.live="phone"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                    @error('phone')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Personal Email
                    </label>

                    <input
                        type="email"
                        wire:model.live="personal_email"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                    @error('personal_email')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Gender
                    </label>

                    <select
                        wire:model.live="gender"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                        <option value="">Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>

                    </select>

                    @error('gender')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Date of Birth
                    </label>

                    <input
                        type="date"
                        wire:model.live="date_of_birth"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                    @error('date_of_birth')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        National ID
                    </label>

                    <input
                        type="text"
                        wire:model.live="national_id"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                    @error('national_id')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Hire Date
                    </label>

                    <input
                        type="date"
                        wire:model.live="hire_date"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                    @error('hire_date')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Job Title
                    </label>

                    <input
                        type="text"
                        wire:model.live="job_title"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3">

                    @error('job_title')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <div class="md:col-span-2">

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Address
                    </label>

                    <textarea
                        wire:model.live="address"
                        rows="4"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3"></textarea>

                    @error('address')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <div class="md:col-span-2">

                    <div class="flex items-center justify-between rounded-xl border border-slate-200 p-4">

                        <div>

                            <p class="font-medium text-slate-800">
                                Active HR
                            </p>

                            <p class="mt-1 text-sm text-slate-500">
                                Allow this HR account to remain active.
                            </p>

                        </div>

                        <input
                            type="checkbox"
                            wire:model="is_active"
                            class="h-5 w-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500">

                    </div>

                </div>

            </div>

            <div class="flex items-center justify-end gap-4 border-t border-slate-200 bg-slate-50 px-8 py-5">

                <a
                    href="{{ route('hrs.show', $hr_id) }}"
                    wire:navigate
                    class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700">

                    Cancel

                </a>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white disabled:opacity-50">

                    <span wire:loading.remove>
                        Update HR
                    </span>

                    <span wire:loading>
                        Updating...
                    </span>

                </button>

            </div>

        </div>

    </form>

</div>