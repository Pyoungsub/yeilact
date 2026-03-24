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
    wire:ignore.self
>
    <div class="flex items-center justify-between text-white"><h1 class="text-2xl font-bold">시설소개</h1><button wire:click="add" class="border border-white">추가</button></div>
    <div x-ref="container" class="swiper w-full overflow-hidden">
        <div class="swiper-wrapper">
            @foreach($facilities as $facility )
                <div class="swiper-slide" :key="$facility->id">
                    <div class="relative w-full aspect-square sm:aspect-video rounded-xl">
                        <h2 class="absolute top-4 left-0 text-2xl font-bold bg-black/30 text-white rounded-sm px-1">{{ $facility->description }}</h2>
                        <div class="rounded-lg mt-4 divide-y divide-gray-100 w-full h-full bg-cover bg-no-repeat bg-center p-8bg-cover bg-no-repeat bg-center p-8 flex items-center jutify-center gap-4" style="background-image:url({{asset('storage/'.$facility->img_path)}})">
                            <button class="bg-white rounded border border-black" wire:click="modify({{$facility->id}})">수정</button>
                            <button class="bg-white rounded border border-black" wire:click="delete({{$facility->id}})" wire:confirm="시설소개 사진을 삭제하시겠습니까?">삭제</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <x-dialog-modal wire:model.live="facilityModal">
        <x-slot name="title">
            {{ __('이미지') }}
        </x-slot>
        <x-slot name="content">
            <div class="grid sm:grid-cols-2 gap-8"
                x-data="{
                    photoPreview: $wire.entangle('photoPreview')
                }"
            >
                <div class="">
                    <div class="">
                        <x-label for="description" value="{{__('설명')}}" />
                        <x-input id="description" type="text" wire:model="description" />
                    </div>
                    <!-- Profile Photo File Input -->
                    <input type="file" id="photo" class="hidden" 
                        wire:model.live="photo"
                        x-ref="photo"
                        accept="image/*"
                        x-on:change="
                            photoName = $refs.photo.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                photoPreview = e.target.result;
                            };
                            reader.readAsDataURL($refs.photo.files[0]);
                        "
                    />
                    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('새 사진 선택') }}
                    </x-secondary-button>
                </div>
                <div class="">
                    <div class="rounded-lg bg-gray-50 p-4">
                        <!-- Current Profile Photo -->
                        <div class="" x-show="!photoPreview">
                            @if($img_path)
                                <img src="{{ asset('storage/'.$img_path) }}" alt="{{ $img_path }}" class="rounded w-full max-w-sm aspect-square object-cover">
                            @endif
                        </div>
                        <!-- New Profile Photo Preview -->
                        <div class="" x-show="photoPreview" style="display: none;">
                            <span class="block rounded w-full max-w-sm aspect-square bg-cover bg-no-repeat bg-center"
                                x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>
                        <x-input-error for="photo" class="mt-2" />
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('facilityModal', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-secondary-button>
            <x-button class="ms-3" wire:click="save" wire:loading.attr="disabled">
                {{ __('저장') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
    <style>

    /* Change the color of the active pagination dot */
    .swiper-pagination-bullet-active {
        background-color: #fff !important;
    }

    /* Example to adjust the size of the pagination dots */
    .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        margin: 0 12px; /* Custom margin for spacing */
    }
    </style>
</div>