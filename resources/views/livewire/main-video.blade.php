<div>

    @php
    $videoSrc = $mainVideo
        ? asset('storage/'.$mainVideo->video_path)
        : asset('storage/video/7cf4958d5002916a5141c3b18de475d8.mp4');
    @endphp


    <div class="relative max-w-2xl aspect-[3/4] rounded-lg overflow-hidden mx-auto group">
        <video class="absolute top-0 left-0 w-full h-full object-cover"
            playsinline autoplay muted loop>
            <source src="{{ $videoSrc }}" type="video/mp4">
        </video>
        {{-- ADMIN CONTROLS --}}
        @auth
            @if(auth()->user()->admin)

            <div class="absolute inset-0 flex items-center justify-center gap-3 bg-black/40 opacity-0 group-hover:opacity-100 transition">

                <button
                    class="bg-white text-black px-3 py-1 rounded"
                    wire:click="openModal"
                >
                    영상 변경
                </button>

                @if($mainVideo)
                <button
                    class="bg-red-600 text-white px-3 py-1 rounded"
                    x-on:click="if(confirm('삭제하시겠습니까?')) $wire.delete()"
                >
                    삭제
                </button>
                @endif

            </div>

            @endif
        @endauth

    </div>


    {{-- MODAL --}}
    <x-dialog-modal wire:model="videoModal">

        <x-slot name="title">
        메인페이지 동영상 관리
        </x-slot>

        <x-slot name="content">

        <div
            x-data="{ uploading:false, progress:0 }"

            x-on:livewire-upload-start="uploading=true"
            x-on:livewire-upload-finish="uploading=false"
            x-on:livewire-upload-error="uploading=false"
            x-on:livewire-upload-progress="progress=$event.detail.progress"
        >


        <x-label for="video" value="영상 업로드" />


        <input
            id="video"
            type="file"
            accept="video/mp4,video/webm"
            wire:model="video"

            class="w-full text-sm text-slate-500
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-violet-50 file:text-violet-700
            hover:file:bg-violet-100"
        />


        <div wire:loading wire:target="video" class="mt-2">
        Uploading...
        </div>


        <div x-show="uploading" class="mt-2">
        <progress max="100" x-bind:value="progress"></progress>
        </div>


        {{-- 새 영상 preview --}}
        @if ($video)

        <div class="mt-4">

        <p class="font-bold mb-2">새 영상 미리보기</p>

        <div class="flex justify-center">
            <div class="aspect-[3/4] h-96 overflow-hidden rounded">
                <video class="w-full h-full object-cover" controls>
                    <source src="{{ $video->temporaryUrl() }}">
                </video>
            </div>
        </div>

        <source src="{{ $video->temporaryUrl() }}">

        </video>

        </div>

        @endif


        {{-- 기존 영상 preview --}}
        @if (!$video && $currentVideo)

        <div class="mt-4">

        <p class="font-bold mb-2">현재 영상</p>
        <div class="flex justify-center">
            <div class="aspect-[3/4] h-96 overflow-hidden rounded">
                <video class="w-full h-full object-cover" controls>
                    <source src="{{ asset('storage/'.$currentVideo) }}">
                </video>
            </div>
        </div>

        </div>

        @endif


        </div>

        </x-slot>


        <x-slot name="footer">

        <x-secondary-button
            wire:click="$set('videoModal', false)"
        >
        Close
        </x-secondary-button>


        <x-button
            class="ms-3"
            wire:click="save"
            wire:loading.attr="disabled"
        >
        저장
        </x-button>

        </x-slot>

    </x-dialog-modal>

</div>