<x-layouts.app :title="$title ?? 'login'">

    <main class="min-h-screen flex items-center justify-center bg-slate-100">

        {{ $slot }}

    </main>

</x-layouts.app>