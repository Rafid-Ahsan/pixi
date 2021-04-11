<div class="grid grid-cols-6 gap-4">
    <div class="col-start-1 col-end-3 ...">
        <h2 class="pt-12 text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
            Catalogs
        </h2>
    </div>
    @if ($catalogs->isEmpty() == false)
        <div class="col-end-7 col-span-2 ...">
            <h2 class="p-5 ml-20 mt-6 text-2xl font-bold leading-7 text-white bg-blue-900 sm:text-xl sm:truncate">
                @if (Route::currentRouteName() == "home")
                    <a href="{{ route('random.catalog.all') }}">View All</a>
                @else
                    <a href="{{ route('catalog.all') }}">View All</a>
                @endif
            </h2>
        </div>
    @endif
</div>

<div class="flex flex-wrap justify-between pt-2 -mx-6">
    @if ($catalogs->isEmpty() == true)
    <div class="w-full md:w-3/3 p-2 flex flex-col flex-grow flex-shrink">
        <div class="flex-2 py-6 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
            Add Catalog
        </div>
    </div>
    @else
        <div class="owl-carousel owl-theme">
            @foreach ($catalogs as $catalog)
            <div class="item mx-6">
                <div class="my-2 flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                    <a href="{{ route('catalog_image.single', $catalog->id)}}" class="flex flex-wrap no-underline hover:no-underline">
                        <img src="{{ Storage::url('uploads/catalog-image/'. head(json_decode($catalog->image))) }}" class="h-64 w-full rounded-t pb-6">
                        <p class="w-full text-gray-600 text-xs md:text-sm px-6">{{ $catalog->name }}</p>
                        <div class="w-full font-bold text-xl text-gray-900 px-6">{{ $catalog->title }}
                            <p class="text-gray-800 font-serif text-base px-6 mb-5">
                                Catalog by {{ $catalog->team_name }}
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
</div>
