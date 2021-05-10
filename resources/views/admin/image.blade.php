@extends('layouts.admin')

@section('content')
@include('alert.success')
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Title
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Category
                </th>
                <th scope="col" class="relative px-6 py-3">
                  <span class="sr-only">Delete</span>
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($users as $user)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                          @if ($user->label == "Single Image")
                            <a href="{{ route('single_image.single', $user->single_image_id)}}">{{ $user->name }}</a>
                          @elseif ($user->label == "Blog Image")
                            <a href="{{ route('blog_image.single', $user->blog_image_id)}}">{{ $user->name }}</a>
                          @else
                            <a href="{{ route('catalog_image.single', $user->catalog_id)}}">{{ $user->name }}</a>
                          @endif
                      </div>
                      <div class="text-sm text-gray-500">
                        {{ $user->email }}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $user->label }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-red-700">
                    @if ($user->label == "Single Image")
                        <a href="{{ route('single.delete', $user->single_image_id)}}">Delete</a>
                    @elseif ($user->label == "Blog Image")
                        <a href="{{ route('blog.delete', $user->blog_image_id)}}">Delete</a>
                    @else
                        <a href="{{ route('catalog.delete', $user->catalog_id)}}">Delete</a>
                    @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
