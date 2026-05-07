@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand {{ $attributes }}>
        {{-- <x-slot name="logo" class="flex aspect-square  items-center justify-center rounded-md bg-accent-content text-accent-foreground"> --}}
            <x-app-logo-icon class="size-5 fill-current text-white dark:text-black" />
        {{-- </x-slot> --}}
    </flux:sidebar.brand>
@else
    <flux:brand {{ $attributes }}>
        {{-- <x-slot name="logo" class="flex aspect-square items-center justify-center rounded-md bg-accent-content text-accent-foreground"> --}}
            <x-app-logo-light-icon class="size-5 fill-current text-white dark:text-black" />
        {{-- </x-slot> --}}
    </flux:brand>
@endif
