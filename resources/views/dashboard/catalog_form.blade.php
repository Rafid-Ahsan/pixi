@extends('layouts.auth')

@section('content')
<div class="bg-gray-300">
    <div class="bg-white rounded-lg overflow-hidden">
        <div class="md:flex">
            <div class="w-full">
                <div class="p-4 border-b-2"> <span class="text-lg font-bold text-gray-600">Add documents</span> </div>
                <div class="p-3">
                    <form action="/store_catalog/{{ Auth::user()->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <span class="text-sm">Name</span>
                            <input type="text" name="name" :value="old('name')" required autofocus class="h-12 px-3 w-full border-gray-200 border rounded focus:outline-none focus:border-gray-300">
                        </div>
                        <div class="mb-2 hdtuto clone ">
                            <span>Attachments</span>
                            <div class="relative h-40 rounded-lg border-dashed border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer lst increment" >
                                <div class="absolute">
                                    <div class="flex flex-col items-center ">
                                        <i class="fa fa-cloud-upload fa-3x text-gray-200"></i>
                                        <span class="block text-gray-400 font-normal">Attach you files here</span>
                                        <span class="block text-gray-400 font-normal">or</span>
                                        <span class="block text-blue-400 font-normal">Browse files</span>
                                    </div>
                                </div>
                                <input type="file" name="images[]" class="myfrm h-full w-full opacity-0" required autofocus multiple>
                            </div>
                        </div>
                        <span class="block text-blue-400 font-normal btn btn-success">
                            <a type="button">Add</a>
                        </span>
                        <span class="block text-blue-400 font-normal btn btn-danger">
                            <a type="button">Remove</a>
                        </span>
                        <div class="mt-3 text-center pb-3">
                            <button class="w-full h-12 text-lg w-32 bg-blue-600 rounded text-white hover:bg-blue-700">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
