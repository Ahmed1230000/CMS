@if(session('success'))
<div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700">
    {{ session('error') }}
</div>
@endif

@if(session('warning'))
<div class="mb-4 rounded-lg border border-yellow-200 bg-yellow-50 p-4 text-yellow-700">
    {{ session('warning') }}
</div>
@endif

@if(session('info'))
<div class="mb-4 rounded-lg border border-blue-200 bg-blue-50 p-4 text-blue-700">
    {{ session('info') }}
</div>
@endif

@if(session('success'))
...
@endif

@if(session('error'))
...
@endif

@if(session('warning'))
...
@endif

@if(session('info'))
...
@endif

@if ($errors->any())

<div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4">

    <p class="font-semibold text-red-700">

        Please review the form.

    </p>

    <ul class="mt-2 list-disc pl-5 text-sm text-red-600">

        @foreach ($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif