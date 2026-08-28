<x-layouts.app :title="$title ?? 'Dashboard'">

    @include('layouts.navbar')

    <div class="min-h-screen bg-slate-100">

        @include('layouts.sidebar')

        <main class="ml-72 min-h-screen p-8">

            <x-notification />

            {{ $slot }}

        </main>

    </div>

    @include('layouts.footer')

</x-layouts.app>