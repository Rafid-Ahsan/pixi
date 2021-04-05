@extends('layouts.auth')

@section('content')
<div class="bg-gray-200 w-full text-xl md:text-2xl text-gray-800 leading-normal rounded-t">

    <!--Lead Card-->
    <div class="flex h-full bg-white rounded overflow-hidden shadow-lg">
        @if ($blog == null)
            <div class="">
                Write a Blog to see here
            </div>
        @else
            <a href="/single_blog/{{ $blog->id }}" class="flex flex-wrap no-underline hover:no-underline">
                <div class="w-full md:w-2/3 h-90 rounded-t">
                    <img src="{{ asset('uploads/blog_image/'. head(json_decode($blog->image)))}}" class="h-full w-full shadow">
                </div>

                <div class="w-full md:w-1/3 flex flex-col flex-grow flex-shrink">
                    <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                        <p class="w-full text-gray-600 text-xs md:text-sm pt-6 px-6">{{ $blog->name }}</p>
                        <div class="w-full font-bold text-xl text-gray-900 px-6">{{ $blog->title }}</div>
                        <p class="text-gray-800 font-serif text-base px-6 mb-5">
                            {{ Str::limit($blog->description, 200) }}
                            <br><br>
                            <a class="text-blue-800" href="/single_blog/{{ $blog->id }}">Read More</a>
                        </p>
                    </div>

                    <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="{{ $blog->name }}" src="{{ asset('storage/'. $blog->profile_photo_path)}}" alt="Avatar of Author">
                            <p class="text-gray-600 text-xs md:text-sm">{{ $blog->team_name }}</p>
                        </div>
                    </div>
                </div>
            </a>
        @endif
    </div>
    <!--/Lead Card-->


    <!--Single Image Container-->
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
                            <img src="{{ asset('storage/' . $single->image) }}" class="h-64 w-full rounded-t pb-6">
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
    <!--/ Single Image Content-->
    </div>

    <div class="grid grid-cols-6 gap-4">
        <div class="col-start-1 col-end-3 ...">
            <h2 class="pt-12 text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Catalogs
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
    <!-- catalogs section -->
    <div class="flex flex-wrap justify-between pt-2 -mx-6">
        @if ($catalogs->isEmpty() == true)
            Add Catalogs to See Here
        @else
            <div class="owl-carousel owl-theme">
                @foreach ($catalogs as $catalog)
                <div class="item mx-6">
                    <div class="my-2 flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                        <a href="/catalog_image/{{ $catalog->id }}" class="flex flex-wrap no-underline hover:no-underline">
                            <img src="{{ asset('uploads/catalog_image/'.head(json_decode($catalog->image))) }}" class="h-64 w-full rounded-t pb-6">
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
    <!--/ catalogs section -->
</div>


</div>

@endsection
