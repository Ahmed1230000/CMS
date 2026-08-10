<x-layouts.app :title="$title ?? 'Dashboard'">

    @include('layouts.navbar')

    <div class="flex bg-slate-100">

        @include('layouts.sidebar')

        <main class="flex-1 overflow-y-auto p-8">

            <x-notification />

            {{ $slot }}

        </main>

    </div>

    @include('layouts.footer')

</x-layouts.app>