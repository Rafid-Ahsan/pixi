@extends('layouts.contest')

@section('content')
@include('alert.form-validation')
@include('alert.success')

<div class="flex flex-col my-10">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Participant Name
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Email
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Image
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Action
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($participants as $participant)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ $participant->name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $participant->email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('contest.image.show', $participant->image_id) }}">
                        <img src="{{ Storage::url('uploads/contest/'. $participant->image) }}" style="height: 60px">
                    </a>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <form action="{{ route('contest.uploads.status_update', $contest->id)}}" method="post" class="mt-1">
                        @csrf
                        @method('put')
                        <select name="status" class="border-none" onchange='if(this.value != 0) { this.form.submit(); }'>>
                            <option value="unseen">Unseen</option>
                            <option value="first_prize">First Prize</option>
                            <option value="second_prize">Second Prize</option>
                            <option value="no_prize">No Prize</option>
                        </select>
                    </form>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $participant->status }}</div>
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
