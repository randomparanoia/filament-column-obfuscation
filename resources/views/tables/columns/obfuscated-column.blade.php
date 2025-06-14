@php
    $state = $getState();
    $obfuscated = $column->getObfuscatedValue($state);
    $revealOnClick = $column->getRevealOnClick();
    $revealOnHover = $column->getRevealOnHover();
@endphp

<div
    @if ($revealOnClick) x-data="{ revealed: false }"
        @click="revealed = !revealed"
        class="flex items-center gap-2 cursor-pointer group"
    @elseif($revealOnHover)
        x-data="{ revealed: false }"
        @mouseenter="revealed = true"
        @mouseleave="revealed = false"
        class="flex items-center gap-2 cursor-help group"
    @else
        class="flex items-center gap-2" @endif>
    <span class="text-sm" x-show="!revealed">{{ $obfuscated }}</span>
    @if ($revealOnClick || $revealOnHover)
        <span class="text-sm" x-show="revealed" x-cloak>{{ $state }}</span>
        @if ($state !== null && $state !== '')
            <svg class="w-4 h-4 text-gray-400 group-hover:text-primary-500"
                x-bind:class="{ 'text-primary-500': revealed }" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path x-show="!revealed" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path x-show="!revealed" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                </path>
                <path x-show="revealed" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21\">
                </path>
            </svg>
        @endif
    @else
        <span class="text-sm">{{ $obfuscated }}</span>
    @endif
</div>
