@extends('layouts.contest')

@section('content')
@include('alert.form-validation')
@include('alert.success')


<div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto mt-10">
    @if (isset(Auth::user()->contest))
        <a href="{{ route('contest.personal', Auth::user()->contest->id) }}" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50">
            Check your Contest
        </a>
    @else
        <a href="{{ route('contest.create') }}" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50">
            Add a contest
        </a>
    @endif
</div>

<div class="flex flex-col my-10">
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
                  <div class="text-sm text-gray-900">{{ $contest->name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $contest->first_prize }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $contest->second_prize }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    @if ($contest->uploads->publisher_id == Auth::user()->id)
                        <a href="{{ route('contest.uploads.submissions', $contest->id) }}" class="text-indigo-600 hover:text-indigo-900">
                            Check Submissions
                            <span class=" ml-2 inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">{{ $unseen_contest_uploads }}</span>
                        </a>
                    @elseif ($contest->uploads->participator_id == Auth::user()->id)
                    <a href="{{ route('contest.uploads.submissions', $contest->id) }}" class="text-indigo-600 hover:text-indigo-900">
                        Check Result
                        <span class=" ml-2 inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">{{ $unseen_contest_uploads }}</span>
                    @else
                        <a href="{{ route('contest.personal', $contest->id) }}" class="text-indigo-600 hover:text-indigo-900">See More</a>
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
