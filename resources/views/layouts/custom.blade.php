<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Pixi</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

</head>
<body class="bg-gray-50 font-sans leading-normal tracking-normal">

	<!--Header-->
	<div class="w-full m-0 p-0 bg-cover bg-bottom" style="background-image:url('cover.jpg'); height: 60vh; max-height:460px;">
			<div class="container max-w-4xl mx-auto pt-16 md:pt-32 text-center break-normal">
				<!--Title-->
					<p class="text-white font-extrabold text-3xl md:text-5xl">
						PIXI
					</p>
					<p class="text-xl md:text-2xl text-gray-500">Think, Capture, Innovate</p>
			</div>
		</div>

		<!--Container-->
		<div class="container px-4 md:px-0 max-w-6xl mx-auto -mt-32">

			<div class="mx-0 sm:mx-6">

				<!--Nav-->
				@livewire('navigation-menu')

                <main>
                    @yield('content')
                </main>

	<footer class="bg-white">
		<div class="container max-w-6xl mx-auto flex items-center px-2 py-8">
			<div class="w-full mx-auto flex flex-wrap items-center">
				<div class="flex w-full md:w-1/2 justify-center md:justify-start text-white font-extrabold">
					<a class="text-gray-900 no-underline hover:text-gray-900 hover:no-underline" href="#">
						👻 <span class="text-base text-gray-900">Ghostwind CSS</span>
					</a>
				</div>
                @if (Route::has('login'))
                <div class="flex w-full pt-2 content-center justify-between md:w-1/2 md:justify-end">
                    <ul class="list-reset flex justify-center flex-1 md:flex-none items-center">
                    @auth
                        <li>
                            <a href="{{ url('/dashboard') }}" class="inline-block py-2 px-3 text-gray-900 no-underline">Dashboard</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ url('/login') }}" class="inline-block py-2 px-3 text-gray-900 no-underline">Login</a>
                        </li>

                        @if (Route::has('register'))
                            <li>
                                <a href="{{ url('/register') }}" class="inline-block py-2 px-3 text-gray-900 no-underline">Register</a>
                            </li>
                        @endif
                    @endauth
                    </ul>
                </div>
                @endif
			</div>
		</div>
	</footer>

	<script src="https://unpkg.com/popper.js@1/dist/umd/popper.min.js"></script>
	<script src="https://unpkg.com/tippy.js@4"></script>
	<script>
		//Init tooltips
		tippy('.avatar')
	</script>
</body>
</html>
