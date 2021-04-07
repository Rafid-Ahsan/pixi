<div class="grid grid-cols-6 gap-4">
    <div class="col-start-1 col-end-3 ...">
        <h2 class="pt-12 text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
            Single Images
        </h2>
    </div>
    @if ($singles->isEmpty() == false)
        <div class="col-end-7 col-span-2 ...">
            <h2 class="p-5 ml-20 mt-6 text-2xl font-bold leading-7 text-white bg-blue-900 sm:text-xl sm:truncate">
                <a href="/all_single_images">View All</a>
            </h2>
        </div>
    @endif
</div>

<div class="flex flex-wrap justify-between pt-2 -mx-6">
    @if ($singles->isEmpty() == true)
        <div class="w-full md:w-3/3 p-2 flex flex-col flex-grow flex-shrink">
            <div class="flex-2 py-6 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                Add single image to see here
            </div>
        </div>
    @else
        <!--1/3 col -->
        @foreach ($singles as $single)
            <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
                <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                    <a href="" class="flex flex-wrap no-underline hover:no-underline">
                        <img src="{{ Storage::url('uploads/single-image/'.$single->image) }}" class="h-64 w-full rounded-t pb-6">
                        <p class="w-full text-gray-600 text-xs md:text-sm px-6">{{ $single->name }}</p>
                        <div class="w-full font-bold text-xl text-gray-900 px-6">{{ $single->title }}</div>
                        <p class="text-gray-800 font-serif text-base px-6 mb-5">
                            {{ $single->description }}
                        </p>
                    </a>
                </div>
                <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="{{ $single->name }}" src="{{ asset('storage/'. $single->profile_photo_path)}}" alt="Avatar of Author">
                        <p class="text-gray-600 text-xs md:text-sm">{{ $single->team_name }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
