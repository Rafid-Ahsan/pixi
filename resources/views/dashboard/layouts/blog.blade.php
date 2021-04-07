<div class="flex h-full bg-white rounded overflow-hidden shadow-lg">
    @if ($blog == null)
        <div class="">
            Write a Blog to see here
        </div>
    @else
        <a href="{{ route('blog.single', $blog->id) }}" class="flex flex-wrap no-underline hover:no-underline">
            <div class="w-full md:w-2/3 h-90 rounded-t">
                <img src="{{ Storage::url('uploads/blog-image/'. head(json_decode($blog->image))) }}" class="h-full w-full shadow">
            </div>

            <div class="w-full md:w-1/3 flex flex-col flex-grow flex-shrink">
                <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                    <p class="w-full text-gray-600 text-xs md:text-sm pt-6 px-6">{{ $blog->name }}</p>
                    <div class="w-full font-bold text-xl text-gray-900 px-6">{{ $blog->title }}</div>
                    <p class="text-gray-800 font-serif text-base px-6 mb-5">
                        {{ Str::limit($blog->description, 200) }}
                        <br><br>
                        <a class="text-blue-800" href="{{ route('blog.single', $blog->id) }}">Read More</a>
                    </p>
                </div>


                <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="{{ $blog->name }}" src="{{ asset('storage/'. $blog->profile_photo_path)}}" alt="Avatar of Author">
                        <p class="text-gray-600 text-xs md:text-sm">{{ $blog->team_name }}</p>
                    </div>
                    <a class="text-blue-800" href="{{ route('blog.all') }}">Show All Blogs</a>
                </div>
            </div>
        </a>
    @endif
</div>
