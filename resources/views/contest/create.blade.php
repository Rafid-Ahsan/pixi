@extends('layouts.contest')

@section('content')
<div>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            @foreach ($errors->all() as $error)
                    <strong class="font-bold">{{ $error }}</strong>
            @endforeach
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    @endif
    <div class="md:grid md:grid-cols-3 md:gap-6 my-10">
      <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Add Contest</h3>
          <p class="mt-1 text-sm text-gray-600">
            Your contest will be verified by the admin
          </p>
        </div>
      </div>
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form action="{{ route('contest.store.id', Auth::user()->id) }}" method="POST">
            @csrf

          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Name
                    </label>
                    <div class="my-1">
                        <input type="text" name="name" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="Enter name of your Contest" required>
                    </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mt-5">
                    Description
                    </label>
                    <div class="mt-1">
                        <textarea name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Enter Description" required></textarea>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                    A good Description helps the perticipator and the authority to understand the whole process.
                    </p>
                </div>
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mt-3 mb-2">
                        First Prize
                    </label>
                    <div class="my-1">
                        <input type="text" name="first_prize" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="Amount of First Prize" required>
                    </div>

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mt-3 mb-2">
                        Second Prize
                    </label>
                    <div class="my-1">
                        <input type="text" name="second_prize" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="Amount of Seond Prize" required>
                    </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 mt-5">
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Save
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
