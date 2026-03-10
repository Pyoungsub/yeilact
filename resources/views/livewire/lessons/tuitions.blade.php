<div class="bg-black">
    <div class="py-8 max-w-5xl mx-auto p-2">
        <div class="flex items-center justify-center gap-2">
            <h1 class="text-4xl text-center text-white font-bold"><span class="text-red-700">Y</span>EIL {{$lesson->lesson_ko}}</h1>
            @auth
                @if(auth()->user()->admin)
                    <button wire:click="add" class="relative border border-white text-white rounded px-2 z-10">추가</button>
                    <!--button wire:click="addYoutube" class="relative border border-white text-white rounded px-2 z-10">유투브영상추가</button-->
                    <!--button wire:click="addVideo" class="relative border border-white text-white rounded px-2 z-10">강사진영상추가</button-->
                @endif
            @endauth
        </div>
        <div class="mt-8 grid sm:grid-cols-3 gap-8">
            @foreach($lesson->lesson_tuition_photos as $tuition)
                @auth
                    @if(auth()->user()->admin)
                        <!-- Render as a <div> for admin users -->
                        <div class="relative overflow-hidden rounded-2xl border w-full aspect-square bg-cover bg-no-repeat bg-center p-8 text-white"
                            style="background-image:url({{ $tuition->img_path ? asset('storage/'.$tuition->img_path ) : asset('storage/company/7cf4958d5002916a5141c3b18de475d8.png') }}" loading="lazy">
                            <div class="flex justify-between w-full z-10">
                                <div>
                                    <button wire:click.stop="modify({{ $tuition->id }})" class="relative border border-white text-white rounded px-2 z-10">수정</button>
                                    <button wire:click.stop="delete({{ $tuition->id }})" class="relative border border-white text-white rounded px-2 z-10">삭제</button>
                                </div>
                                <div>
                                    <button wire:click.stop="addYoutube({{ $tuition->id }})" class="relative border border-white text-white rounded px-2 z-10">Youtube</button>
                                </div>
                            </div>
                            @if($tuition->lesson_tuition_photo_url)
                                <div class="mt-4">
                                    <p>{{ $tuition->lesson_tuition_photo_url->link }}</p>
                                    <button wire:click.stop="deleteYoutube({{ $tuition->id }})" class="relative border border-white text-white rounded px-2 z-10">Youtube 링크 삭제</button>
                                </div>
                            @endif
                        </div>
                    @else
                        <!-- Render as a <a> for non-admin users -->
                            {{--
                            <a href="{{ $tuition->lesson_tuition_photo_url ? $tuition->lesson_tuition_photo_url->link : '#' }}" target="_blank" class="relative overflow-hidden rounded-2xl border w-full aspect-square bg-cover bg-no-repeat bg-center p-8 text-white" style="background-image:url({{ $tuition->img_path ? asset('storage/'.$tuition->img_path ) : asset('storage/company/7cf4958d5002916a5141c3b18de475d8.png') }}" loading="lazy"></a>
                            --}}
                            <div class="relative overflow-hidden rounded-2xl border w-full aspect-square bg-cover bg-no-repeat bg-center p-8 text-white" style="background-image:url({{ $tuition->img_path ? asset('storage/'.$tuition->img_path ) : asset('storage/company/7cf4958d5002916a5141c3b18de475d8.png') }}" loading="lazy"></div>
                    @endif
                @endauth

                @guest
                    <!-- Render as a <a> for guests -->
                    {{--<a href="{{ $tuition->lesson_tuition_photo_url ? $tuition->lesson_tuition_photo_url->link : '#' }}" target="_blank" class="relative overflow-hidden rounded-2xl border w-full aspect-square bg-cover bg-no-repeat bg-center p-8 text-white" style="background-image:url({{ $tuition->img_path ? asset('storage/'.$tuition->img_path ) : asset('storage/company/7cf4958d5002916a5141c3b18de475d8.png') }}" loading="lazy"></a>--}}
                    <div class="relative overflow-hidden rounded-2xl border w-full aspect-square bg-cover bg-no-repeat bg-center p-8 text-white" style="background-image:url({{ $tuition->img_path ? asset('storage/'.$tuition->img_path ) : asset('storage/company/7cf4958d5002916a5141c3b18de475d8.png') }}" loading="lazy"></div>
                @endguest
            @endforeach
        </div>
        {{--
            <div class="mt-8 grid sm:grid-cols-3 gap-8">
                @foreach($lesson->lesson_tuition_videos as $lesson_tuition_video)
                    <div class="relative">
                        @auth
                            @if(auth()->user()->admin)
                                <div class="absolute flex right-2 top-2 gap-2 z-20">
                                    <button wire:click="modifyVideo({{ $lesson_tuition_video->id }})" class="relative border border-white text-white rounded px-2 z-10">수정</button>
                                    <button wire:click="deleteVideo({{ $lesson_tuition_video->id }})" class="relative border border-white text-white rounded px-2 z-10">삭제</button>
                                </div>
                            @endif
                        @endauth
                        <x-square-video :source="$lesson_tuition_video->video_path" />
                    </div>
                @endforeach
            </div>
        --}}
        
        {{--
            <div class="mt-8 grid sm:grid-cols-3 gap-8">
                @foreach($lesson->lesson_tuition_youtubes as $youtube)
                    <div class="relative">
                        @auth
                            @if(auth()->user()->admin)
                                <div class="absolute flex right-2 top-2 gap-2">
                                    <button wire:click="modifyYoutube({{ $youtube->id }})" class="relative border border-white text-white rounded px-2 z-10">수정</button>
                                    <button wire:click="deleteYoutube({{ $youtube->id }})" class="relative border border-white text-white rounded px-2 z-10">삭제</button>
                                </div>
                            @endif
                        @endauth
                        <iframe class="rounded-lg w-full aspect-[9/16] pointer-events-none" src="https://www.youtube-nocookie.com/embed/{{$youtube->link}}?autoplay=1&mute=1&loop=1&playlist={{$youtube->link}}&controls=0&modestbranding=1&fs=0&rel=0&autohide=1&iv_load_policy=3" frameborder="0"></iframe>
                    </div>
                @endforeach
            </div>
        --}}
    </div>
    <x-dialog-modal wire:model.live="tuitionModal">
        <x-slot name="title">
            {{ __('이미지 추가') }}
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
    <x-dialog-modal wire:model.live="tuitionPhotoYoutubeModal" maxWidth="md">
        <x-slot name="title">
            <h1 class="font-bold">{{ __('유투브 링크 추가') }}</h1>
        </x-slot>
        <x-slot name="content">
            <div class="">
                <x-label for="link" value="링크" />
                <x-input id="link" type="text" class="w-full" wire:model="link" placeholder="url을 입력해주세요"/>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('tuitionPhotoYoutubeModal', false)" wire:loading.attr="disabled">
                {{ __('취소') }}
            </x-secondary-button>
            <x-button class="ms-3" wire:click="savePhotoYoutubeLink" wire:loading.attr="disabled">
                {{ __('저장') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
    {{--
        <x-dialog-modal wire:model.live="tuitionYoutubeModal" maxWidth="sm">
            <x-slot name="title">
                <h1 class="font-bold">{{ __('유투브 영상 관리') }}</h1>
            </x-slot>
            <x-slot name="content">
                <div class="">
                    <x-label for="link" value="링크" />
                    <x-input id="link" type="text" class="w-full" wire:model="link" placeholder="url을 입력해주세요"/>
                    @if ($link)
                        <iframe class="mt-4 rounded-lg w-full aspect-[9/16] pointer-events-none" src="https://www.youtube-nocookie.com/embed/{{$link}}?autoplay=1&mute=1&loop=1&playlist={{$link}}&controls=0&modestbranding=1&fs=0&rel=0&autohide=1&iv_load_policy=3" frameborder="0"></iframe>
                    @else
                        <div class="mt-4 rounded-lg w-full aspect-[9/16] bg-gray-200"></div>
                    @endif
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="$set('tuitionYoutubeModal', false)" wire:loading.attr="disabled">
                    {{ __('취소') }}
                </x-secondary-button>
                <x-button class="ms-3" wire:click="saveLink" wire:loading.attr="disabled">
                    {{ __('저장') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>
    --}}
    <x-dialog-modal wire:model.live="tuitionVideoModal" maxWidth="sm">
        <x-slot name="title">
            <h1 class="font-bold">{{ __('영상 추가') }}</h1>
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
                @if ($video_path)
                    
                @endif
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('tuitionVideoModal', false)" wire:loading.attr="disabled">
                {{ __('취소') }}
            </x-secondary-button>
            <x-button class="ms-3" wire:click="saveVideo" wire:loading.attr="disabled">
                {{ __('저장') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
