@extends('layouts.auth')

@section('content')
<div class="bg-gray-200 w-full text-xl md:text-2xl text-gray-800 leading-normal rounded-t">
    <!--blog Card-->
    @include('dashboard.layouts.blog')
    <!--/blog Card-->

    <!--Single Image Container-->
    @include('dashboard.layouts.single')
    <!--/ Single Image Container-->

    <!-- catalogs section -->
    @include('dashboard.layouts.catalog')
    <!--/ catalogs section -->
</div>
</div>
@endsection
