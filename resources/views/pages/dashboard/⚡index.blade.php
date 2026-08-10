<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    //
};
?>
<div>
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-slate-800">

            Welcome Back 👋

        </h1>

        <p class="mt-2 text-slate-500">

            Here's what's happening in your hospital today.

        </p>

    </div>

    <div class="grid grid-cols-4 gap-6">

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

            <p class="text-sm text-slate-500">

                Patients

            </p>

            <h2 class="mt-3 text-3xl font-bold">

                0

            </h2>

        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

            <p class="text-sm text-slate-500">

                Doctors

            </p>

            <h2 class="mt-3 text-3xl font-bold">

                0

            </h2>

        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

            <p class="text-sm text-slate-500">

                Appointments

            </p>

            <h2 class="mt-3 text-3xl font-bold">

                0

            </h2>

        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

            <p class="text-sm text-slate-500">

                Revenue

            </p>

            <h2 class="mt-3 text-3xl font-bold">

                $0

            </h2>

        </div>

    </div>
</div>