<footer class="ml-72 border-t border-slate-200 bg-white">

    <div class="px-8 py-6">

        <div class="flex flex-col items-center justify-between gap-3 sm:flex-row">

            {{-- Brand --}}
            <div class="flex items-center gap-3">

                <div
                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-600 text-white shadow-sm">
                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-semibold text-slate-800">
                        {{ config('app.name') }}
                    </p>

                    <p class="text-xs text-slate-400">
                        Hospital Management System
                    </p>
                </div>

            </div>


            {{-- Copyright --}}
            <div class="text-center sm:text-right">

                <p class="text-xs text-slate-500">
                    © {{ now()->year }} {{ config('app.name') }}
                </p>

                <p class="mt-1 text-[11px] text-slate-400">
                    All rights reserved.
                </p>

            </div>

        </div>

    </div>

</footer>