<div class="mt-12 max-w-5xl mx-auto">
    @foreach ($lessons as $lesson)
        <div class="mb-12">
            <div class="flex gap-2 items-center mb-4 justify-center">
                <a href="{{route('lessons', ['lesson' => $lesson->lesson])}}" class="text-2xl font-bold text-blue-600 hover:text-blue-800 hover:underline transition">
                    {{ $lesson->lesson_ko }} 커리큘럼
                </a>
                @if($admin)
                    <x-button wire:click="addVideo({{ $lesson->id }})">
                        영상추가
                    </x-button>
                @endif
            </div>
            <div class="py-4 px-2 max-w-5xl mx-auto"
                x-data="{swiper:null}"
                x-init="
                    swiper = new Swiper($refs.container, {
                        slidesPerView: 2.3,
                        spaceBetween: 30,
                        breakpoints: {
                            640: { // sm breakpoint
                                slidesPerView: 2.3,
                                spaceBetween: 30,
                            },
                            768: { // md breakpoint
                                slidesPerView: 2.3,
                                spaceBetween: 30,
                            },
                            1024: { // lg breakpoint
                                slidesPerView: 2.5,
                                spaceBetween: 30,
                            },
                            1280: { // xl breakpoint
                                slidesPerView: 3.3,
                                spaceBetween: 30,
                            },
                            1536: { // 2xl breakpoint
                                slidesPerView: 3.5,
                                spaceBetween: 30,
                            }
                        },
                    });
                "
            >
                <div x-ref="container" class="swiper w-full overflow-hidden">
                    <div class="swiper-wrapper">
                        @foreach($lesson->lesson_tuition_videos as $lesson_tuition_video)
                            <div class="swiper-slide relative" wire:key="video-{{ $lesson_tuition_video->id }}">
                                @auth
                                    @if(auth()->user()->admin)
                                        <div class="flex items-cetner gap-2 absolute top-0 right-0 z-20">
                                            <button class="bg-white rounded" wire:click="modifyIdolVideo({{$lesson_tuition_video->id}})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="arcs"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                            </button>
                                            <button class="bg-white rounded" wire:click="deleteIdolVideo({{$lesson_tuition_video->id}})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="arcs"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            </button>
                                        </div>
                                    @endif
                                @endauth
                                {{--<x-video source="{{ $lesson_tuition_video->video_path }}" />--}}
                                <x-rectangle-video source="{{ $lesson_tuition_video->video_path }}" />
                                {{--<x-square-video source="{{ $lesson_tuition_video->video_path }}" />--}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Token Value Modal -->
    <x-dialog-modal wire:model="videoModal">
        <x-slot name="title">
            {{ $editMode ? '영상 수정' : '메인페이지 동영상 관리' }}
        </x-slot>

        <x-slot name="content">
            <div x-data="{ uploading: false, progress: 0 }"
                x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false"
                x-on:livewire-upload-cancel="uploading = false"
                x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
                class=""
            >
                <x-label for="video" value="링크" />
                <x-input accept="video/*" id="video" type="file" class="w-full block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" 
                wire:model="video" placeholder="url을 입력해주세요" />
                <div wire:loading wire:target="video">Uploading...</div>
                <div x-show="uploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
                @if ($video)
                    <p class="mt-4">Video Preview:</p>
                    <video class="w-full" controls>
                        <source src="{{ $video->temporaryUrl() }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('videoModal', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-secondary-button>
            <x-button class="ms-3" wire:click="save" wire:loading.attr="disabled">
                {{ __('저장') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
