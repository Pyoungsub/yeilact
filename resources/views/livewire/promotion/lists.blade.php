<div class="bg-slate-900">
    <div class="py-20">
        <div class="max-w-7xl mx-auto">
            @if(count($promotions)>0)
                <div class="relative h-full w-full md:rounded-lg aspect-video lg:aspect-[3/1] bg-no-repeat bg-center bg-cover" style="background-image:url( {{ asset('storage/'.$promotions->first()->img_path) }} )">
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                    <div class="absolute inset-0 z-20 flex items-center justify-center">
                        <h1 class="text-6xl font-bold text-white">Promotions in Yeil</h1>
                    </div>
                </div>
                <div class="mt-12 grid sm:grid-cols-2 md:grid-cols-3 gap-8 px-2 sm:px-0">
                    @foreach($promotions as $promotion)
                        <a href="{{route('promotion', ['id' => $promotion->id, 'page' => $promotions->currentPage()])}}">
                            <div class="">
                                <div class="aspect-square bg-no-repeat bg-cover bg-center rounded-lg" style="background-image:url({{ asset('storage/'.$promotion->thumbnail_path) }})"></div>
                                <div class="text-white mt-4 grid gap-2">
                                    <h1 class="text-2xl md:text-5xl font-bold">{{ $promotion->title }}</h1>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
            <div class="mt-4">{{$promotions->links()}}</div>
        </div>
    </div>
    <x-footer.web />
</div>