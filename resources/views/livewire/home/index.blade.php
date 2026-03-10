
<div class="bg-black">
    <x-mp4 source="/video/7cf4958d5002916a5141c3b18de475d8.mp4" />
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