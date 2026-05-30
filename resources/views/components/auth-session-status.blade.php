@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-lg text-lg text-success dark:text-green-400']) }}>
        {{ $status }}
    </div>
@endif
