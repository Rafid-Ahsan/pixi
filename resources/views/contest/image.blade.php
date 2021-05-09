@extends('layouts.contest')

@section('content')
@include('alert.form-validation')
@include('alert.success')

<div class="flex flex-col my-10">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <center>
                <img src="{{ Storage::url('uploads/contest/'. $contest->image) }}" style="height: 50vh;">
            </center>
        </div>
      </div>
    </div>
  </div>

@endsection
