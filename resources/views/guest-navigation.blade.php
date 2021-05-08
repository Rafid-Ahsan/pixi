<div class="flex flex-wrap">
    <div class="w-full">
      <nav class="relative flex flex-wrap items-center justify-between px-2 py-3 bg-white rounded">
        <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
          <div class="w-full relative flex justify-between lg:w-auto px-4 lg:static lg:block lg:justify-start">
            <a href="{{ route('contest.index') }}" class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase text-gray-800" href="#pablo">
              Contest
            </a>
            <button class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none" type="button">
              <span class="block relative w-6 h-px rounded-sm bg-white"></span>
              <span class="block relative w-6 h-px rounded-sm bg-white mt-1"></span>
              <span class="block relative w-6 h-px rounded-sm bg-white mt-1"></span>
            </button>
          </div>
          <div class="flex lg:flex-grow items-center" id="example-navbar-info">
            <ul class="flex flex-col lg:flex-row list-none ml-auto">
              <li class="nav-item">
                <a href="{{ url('login') }}" class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-gray-800 hover:opacity-75">
                  Login
                </a>
              </li>
              <li class="nav-item">
                <a href="/register" class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug text-gray-800 hover:opacity-75">
                  Register
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
