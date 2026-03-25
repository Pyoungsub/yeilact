
<div class="bg-black">
    <livewire:main-video />
    <livewire:courses />
    <livewire:audition />
    <x-promotion />
    @if(auth()->user()?->admin)
        <livewire:tuitions />
        <livewire:facilities />
    @else
        <x-tuitions />
        <x-facilities />
    @endif
    <x-instagram />
    <livewire:components.apply />
    <livewire:components.inquiries />
    <x-map />
    <x-footer.mobile-contact />
    <x-footer.web />
</div>