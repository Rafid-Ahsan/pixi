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
                  Publisher Name
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Title
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Description
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  First Prize
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Second Prize
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Action
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($contests as $contest)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                      <img class="h-10 w-10 rounded-full" src="{{ $contest->profile_photo_url }}" alt="">
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        {{ $contest->publisher_name }}
                      </div>
                      <div class="text-sm text-gray-500">
                        {{ $contest->email }}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ $contest->name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $contest->description }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if ($contest->status == 'Not Approved')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Not Approved
                        </span>
                    @elseif ($contest->status == 'Approved')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Approved
                        </span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                            End
                        </span>
                    @endif
                    <br>
                    <form action="{{ route('admin.contest.status_update', $contest->id)}}" method="post" class="mt-1">
                        @csrf
                        @method('put')
                        <select name="status" class="border-none" onchange='if(this.value != 0) { this.form.submit(); }'>>
                            <option value="Not Approved">Not Approved</option>
                            <option value="Approved">Approved</option>
                            <option value="End">End</option>
                        </select>
                    </form>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                   {{ $contest->first_prize }}TK
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $contest->second_prize }}TK
                 </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <a href="{{ route('admin.contest.delete', $contest->id) }}" class="text-red-600 hover:text-red-900">Delete</a>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-500">
                    <a href="{{ route('contest.uploads.submissions', $contest->id) }}">Check Results</a>
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
