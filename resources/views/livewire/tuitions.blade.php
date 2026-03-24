<div class="max-w-5xl mx-auto"
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
    <div class="flex items-center gap-2">
        <h1 class="text-4xl text-white font-bold"><span class="text-red-700">Y</span>EIL 연기 강사진</h1>
        <button class="border border-white text-white px-2 rounded" wire:click="addTuition">강사진 추가</button>
    </div>
    <div x-ref="tuitions" class="mt-4 w-full overflow-hidden">
        <div class="swiper-wrapper">
            @foreach($tuitions as $tuition)
                <div class="swiper-slide" wire:key="tuition-{{ $tuition->id }}">
                    <div class="w-full rounded-xl aspect-square p-4 bg-cover bg-center bg-no-repeat"
                        style="background-image:url({{ asset('storage/'.$tuition->img_path) }})">

                        <button
                            class="bg-black/50 text-white px-2 rounded"
                            wire:click="addTuition({{ $tuition->id }})"
                        >
                            수정
                        </button>
                        <button
                            class="bg-red-600 text-white px-2 rounded"
                            wire:click="delete({{ $tuition->id }})"
                            wire:confirm="정말 삭제하시겠습니까?"
                        >
                            삭제
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <x-dialog-modal wire:model.live="tuitionModal">
        <x-slot name="title">
            {{ __('강사진 추가') }}
        </x-slot>
        <x-slot name="content">
            <div class="grid sm:grid-cols-2 gap-8"
                x-data="{
                    photoPreview: $wire.entangle('photoPreview')
                }"
            >
                <div class="">
                    <!-- Profile Photo File Input -->
                    <input type="file" id="photo" class="hidden"
                        wire:model.live="photo"
                        x-ref="photo"
                        x-on:change="
                            photoName = $refs.photo.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                photoPreview = e.target.result;
                            };
                            reader.readAsDataURL($refs.photo.files[0]);
                        "
                        accept="image/*"
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
            <x-secondary-button wire:click="$set('tuitionModal', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-secondary-button>
            <x-button class="ms-3" wire:click="save" wire:loading.attr="disabled">
                {{ __('저장') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
@push('scripts')
<script>
    window.addEventListener('swiper-update', () => {
        swiper.update();
    });
</script>
@endpush