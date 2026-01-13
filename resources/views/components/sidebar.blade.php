@props([
    'menus' => collect(),
])

<div class="sidebar-container">
    <div class="sidebar-header">
        <span>Company Management System</span>
    </div>
    <div class="personal-info">
        <div class="img-container">
            <img src="{{ asset('img/phenskiee.jpg') }}" alt="img">
        </div>
        <div class="name-position">
            <p class="name">Stephen E. Espeño</p>
            <p class="pos">Full Stack Developer</p>
        </div>
    </div>
    <div class="personal-btn">
        <span id="personal-btn">Personal Information</span>
    </div>
    <div class="nav-container">
        <nav>
            <ul>
                @foreach ($menus as $item)
                    <li class="sidebar-link" data-target="{{ $item->route_name }}-section">
                        <i class="{{ $item->icon }}"></i>
                        {{ $item->nav_name }}
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</div>
{{-- MODAL --}}
<x-modal
    label="Personal Information"
    modalClass="personal-info-card" 
    :icon="true"
    :buttons="false"
>
    <x-input
        label="Full Name"
        name="name"
        id="name"
        route="{{ route('personal.info') }}"
        :readonly="true"
    />
    <x-input
        label="Email"
        name="email"
        id="email"
        route="{{ route('personal.info') }}"
        :readonly="true"
    />
    <x-input
        label="Phone number"
        name="phone_number"
        id="phoneNumber"
        route="{{ route('personal.info') }}"
        :readonly="true"
    />
    <x-input
        label="Address"
        name="address"
        id="address"
        route="{{ route('personal.info') }}"
        :readonly="true"
    />
    <x-input
        label="Portfolio"
        name="portfolio"
        id="portfolio"
        route="{{ route('personal.info') }}"
        :readonly="true"
    />
    <x-text-area
        label="Introduction"
        name="introduction"
        id="introduction"
        route="{{ route('personal.info') }}"
        :readonly="true"
    />
</x-modal>