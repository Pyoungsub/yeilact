@props(['source' => 'video/7cf4958d5002916a5141c3b18de475d8.mp4'])
<div class="">
    <div class="relative h-full w-full aspect-[3/4] rounded-lg overflow-hidden">
        <video class="absolute top-0 left-0 w-full h-full object-cover" playsinline autoplay muted loop>
            <source src="{{ asset('storage/' . $source) }}" type="video/mp4" >
        </video>
    </div>
    <!--iframe class="w-full aspect-video" src="https://www.youtube.com/embed/nBj7cuTq814?rel=0&amp;autoplay=1&mute=1" frameborder="0" allowfullscreen></iframe-->
</div>