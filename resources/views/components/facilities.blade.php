<div class="pt-12 pb-4 px-2 max-w-5xl mx-auto"
    x-data="{swiper:null}"
    x-init="
        swiper = new Swiper($refs.container, {
            pagination: {
                el: '.swiper-pagination',
                dynamicBullets: true,
                clickable: true
            },
            slidesPerView: 1.3,
            spaceBetween: 50,
        });
    "
>
    <h1 class="text-2xl font-bold text-white">시설소개</h1>
    <div x-ref="container" class="swiper w-full overflow-hidden">
        <div class="swiper-wrapper">
            @foreach($facilities as $facility)
                <div class="swiper-slide">
                    <div class="relative w-full aspect-square sm:aspect-video rounded-xl">
                        <h2 class="absolute top-4 left-0 text-2xl font-bold bg-black/30 text-white rounded-sm px-1">{{ $facility->description }}</h2>
                        <div class="rounded-lg mt-4 divide-y divide-gray-100 w-full h-full bg-cover bg-no-repeat bg-center p-8bg-cover bg-no-repeat bg-center p-8" style="background-image:url({{asset('storage/'.$facility->img_path)}})"></div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>