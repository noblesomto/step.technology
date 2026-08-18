{{-- Param: $active (string) — one of 'undergraduate', 'young-professional', 'corporate-professional', 'corporate-organization' --}}
@php
    $links = [
        'undergraduate' => ['label' => 'Undergraduate', 'href' => '/register-undergraduate'],
        'young-professional' => ['label' => 'Young Professional', 'href' => '/register-young-professional'],
        'corporate-professional' => ['label' => 'Corporate Professional', 'href' => '/register-corporate-professional'],
        'corporate-organization' => ['label' => 'Corporate Organization', 'href' => '/register-corporate-organization'],
    ];
@endphp

<div class="bg-gray-50 rounded-lg p-2">
    <ul class="space-y-1">
        @foreach ($links as $key => $link)
            <li>
                <a href="{{ $link['href'] }}" class="block px-4 py-3 rounded-md text-sm font-step-heading font-medium {{ $active === $key ? 'bg-step-primary text-white' : 'text-gray-600 hover:bg-white hover:text-step-primary' }}">
                    {{ $link['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
