@props([
    'id' => null,
    'mainClass' => '',
    'header' => "Company Management System",

])
<section 
    id="{{ $id }}" 
    class="section-container {{ $mainClass }}"
>
    <div class="header">
        <h3>{{ $header }}</h3>
    </div>
    {{ $slot }}
</section>