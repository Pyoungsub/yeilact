<div class="pt-12 pb-4 px-2 bg-black max-w-5xl mx-auto"
    x-data="{swiper:null}"
    x-init="
        swiper = new Swiper($refs.tuitions, {
            slidesPerView: 1.3,
            spaceBetween: 15,
            breakpoints: {
                640: { // sm breakpoint
                    slidesPerView: 1.5,
                    spaceBetween: 15,
                },
                768: { // md breakpoint
                    slidesPerView: 2.3,
                    spaceBetween: 15,
                },
                1024: { // lg breakpoint
                    slidesPerView: 2.5,
                    spaceBetween: 15,
                },
                1280: { // xl breakpoint
                    slidesPerView: 3.3,
                    spaceBetween: 15,
                },
                1536: { // 2xl breakpoint
                    slidesPerView: 3.5,
                    spaceBetween: 15,
                }
            },
        });
    "
>
    <h1 class="text-4xl text-white font-bold"><span class="text-red-700">Y</span>EIL 연기 강사진</h1>
    <div x-ref="tuitions" class="mt-4 w-full overflow-hidden">
        <div class="swiper-wrapper">
            @foreach($tuitions as $tuition)
                <div class="swiper-slide" wire:key="tuition-{{ $tuition->id }}">
                    <div class="w-full rounded-xl aspect-square p-4 bg-cover bg-center bg-no-repeat"
                        style="background-image:url({{ asset('storage/'.$tuition->img_path) }})">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>