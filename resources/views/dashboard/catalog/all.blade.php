@extends('layouts.auth')

@section('content')
<div class="bg-gray-200 w-full text-xl md:text-2xl text-gray-800 leading-normal rounded-t">
    <div class="grid grid-cols-6 gap-4">
        <div class="col-start-1 col-end-3 ...">
            <h2 class="pt-12 text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                All Catalogs
            </h2>
        </div>
    </div>

    <div class="flex flex-wrap justify-between pt-2 -mx-6">
        @foreach ($catalogs as $catalog)
            <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
                <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                    <a href="{{ route('catalog_image.single', $catalog->id) }}" class="flex flex-wrap no-underline hover:no-underline">
                        <img src="{{ Storage::url('uploads/catalog-image/'.head(json_decode($catalog->image))) }}" class="h-64 w-full rounded-t pb-6">
                        <p class="w-full text-gray-600 text-xs md:text-sm px-6">{{ $catalog->name }}</p>
                        <div class="w-full font-bold text-xl text-gray-900 px-6">{{ $catalog->title }}</div>
                    </a>
                </div>
                <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="{{ $catalog->name }}" src="{{ asset('storage/'. $catalog->profile_photo_path)}}" alt="Avatar of Author">
                        <p class="text-gray-600 text-xs md:text-sm">{{ $catalog->team_name }}</p>
                    </div>
                </div>
                <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('catalog.show_update_form', $catalog->id) }}" class="bg-blue-800 text-white p-3 text-xs md:text-sm">Update</a>
                        {{-- <a href="{{ route('blog.download', $blog->id) }}" class="bg-green-800 text-white p-3 text-xs md:text-sm">Downlaod</a> --}}
                        <a href="{{ route('catalog.delete', $catalog->id) }}" class="bg-red-800 text-white p-3 text-xs md:text-sm">Delete</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $catalogs->links() }}
</div>

@endsection
