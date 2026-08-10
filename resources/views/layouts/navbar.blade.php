<nav class="flex h-16 items-center justify-between border-b border-slate-200 bg-white px-8">

    <div>

        <h2 class="text-lg font-semibold text-slate-800">

            Dashboard

        </h2>

    </div>

    <div class="flex items-center gap-6">

        @auth

        <div class="text-right">

            <p class="font-medium text-slate-800">

                {{ auth()->user()->email }}

            </p>

            <p class="text-sm text-slate-500">

                {{ auth()->user()->name }}

            </p>

        </div>

        <livewire:layouts.logout />

        @endauth

    </div>

</nav>