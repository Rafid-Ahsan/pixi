@extends('layouts.auth')

@section('content')
<div class="bg-gray-200 w-full text-xl md:text-2xl text-gray-800 leading-normal rounded-t">
    <div class="grid grid-cols-6 gap-4">
        <div class="col-start-1 col-end-3 ...">
            <h2 class="pt-12 text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                {{ $single->title }} Update Form
            </h2>
        </div>
    </div>

    <div class="flex content-center flex-wrap justify-between pt-2 -mx-6">
        <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
            <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                @include('form_handler.error')
                <form method="post" action="{{ route('single.update', $single->id) }}" class="block p-5">
                    @csrf
                    @method('PUT')
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4" for="inline-full-name">
                                Title
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input name="title" class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" value="{{ $single->title }}">
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4" for="inline-full-name">
                                Description
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <textarea name="description" class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text">{{ $single->description }}</textarea>
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4" for="inline-full-name">
                                Team
                            </label>
                        </div>
                        <div class="relative">
                            <select name="team_id" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                              @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="md:flex md:items-center">
                        <div class="md:w-1/3"></div>
                        <div class="md:w-2/3">
                        <button type="submit" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                            Update
                        </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
