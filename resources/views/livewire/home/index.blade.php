
<div class="bg-black">
    <div class="relative max-w-2xl aspect-[3/4] rounded-lg overflow-hidden mx-auto">
        <video class="absolute top-0 left-0 w-full h-full object-cover" playsinline autoplay muted loop>
            <source src="{{ asset('storage/video/7cf4958d5002916a5141c3b18de475d8.mp4') }}" type="video/mp4">
        </video>
    </div>`
    <livewire:courses />
    <livewire:audition />
    <x-promotion />
    @if(auth()->user()?->admin)
        <livewire:facilities />
    @else
        <x-facilities />
    @endif
    <x-instagram />
    <livewire:components.apply />
    <livewire:components.inquiries />
    <x-map />
    <x-footer.mobile-contact />
    <x-footer.web />
</div>