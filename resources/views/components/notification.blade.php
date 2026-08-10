@php
$notifications = [];

foreach (['success', 'error', 'warning', 'info'] as $type) {
if (session()->has($type)) {
$notifications[] = [
'type' => $type,
'message' => session($type),
'errors' => [],
];
}
}

if ($errors->any()) {
$notifications[] = [
'type' => 'error',
'message' => 'Please review the form.',
'errors' => $errors->all(),
];
}
@endphp
<div
    <div
    x-data="{
        notifications: @js($notifications),

        remove(index) {
            this.notifications.splice(index, 1);
        },

        add(type, message, errors = []) {

            this.notifications.push({
                type,
                message,
                errors
            });

            const current = this.notifications.length - 1;

            setTimeout(() => {
                this.remove(current);
            }, 3500);
        }
    }"

    x-on:notify.window="
        add(
            $event.detail.type,
            $event.detail.message,
            $event.detail.errors ?? []
        )
    "

    class="fixed top-6 right-6 z-50 space-y-3">


    <template x-for="(notification, index) in notifications" :key="index">

        <div


            x-transition:enter="transition transform ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"

            x-transition:leave="transition transform ease-in duration-500"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-2"

            class="flex w-96 items-start gap-3 rounded-xl border p-4 shadow-xl"

            :class="{
                'border-green-200 bg-green-50 text-green-700': notification.type === 'success',
                'border-red-200 bg-red-50 text-red-700': notification.type === 'error',
                'border-yellow-200 bg-yellow-50 text-yellow-700': notification.type === 'warning',
                'border-blue-200 bg-blue-50 text-blue-700': notification.type === 'info',
            }">

            <!-- Icon -->
            <div class="mt-0.5">

                <!-- Success -->
                <svg
                    x-show="notification.type === 'success'"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 13l4 4L19 7" />

                </svg>

                <!-- Error -->
                <svg
                    x-show="notification.type === 'error'"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />

                </svg>

                <!-- Warning -->
                <svg
                    x-show="notification.type === 'warning'"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M10.29 3.86l-8 14A1 1 0 003.14 19h17.72a1 1 0 00.85-1.5l-8-14a1 1 0 00-1.72 0z" />

                </svg>

                <!-- Info -->
                <svg
                    x-show="notification.type === 'info'"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12A9 9 0 1112 3a9 9 0 019 9z" />

                </svg>

            </div>
            <!-- Message -->
            <div class="flex-1">

                <p
                    class="font-semibold"
                    x-text="notification.message">
                </p>

                <template x-if="notification.errors">

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">

                        <template
                            x-for="error in notification.errors"
                            :key="error">

                            <li x-text="error"></li>

                        </template>

                    </ul>

                </template>

            </div>

            <!-- Close -->
            <button
                @click="remove(index)"
                class="text-xl opacity-60 transition hover:opacity-100">

                &times;

            </button>

        </div>

    </template>

</div>