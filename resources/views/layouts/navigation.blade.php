<nav class="bg-white border-gray-200 px-4 lg:px-6 py-6 border-b shadow-lg fixed w-full top-0 z-50">
    <div class="flex flex-wrap justify-between items-center container mx-auto">
        <a href="/" class="flex items-center">
            <img src="https://cdn.discordapp.com/attachments/1221432112444604547/1261543329405866054/heart-rate.png?ex=66935748&is=669205c8&hm=4f30338ee6d1defc8cf7ea1b142bc126bda62f98aac09e7027f65b5030d3e201&" class="mr-3 h-8 sm:h-9" alt="Heartrate Logo" />
            <span class="self-center text-xl font-semibold whitespace-nowrap">{{ config('app.name', 'Laravel') }}</span>
        </a>
        <div class="flex items-center lg:order-2">
            @auth
                <div class="flex items-center lg:order-2">
                    <button type="button" class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gough.png" alt="user photo"/>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="hidden z-50 my-4 w-56 text-base list-none bg-white divide-y divide-gray-100 shadow rounded-xl" id="dropdown">
                        <div class="py-3 px-4">
                            <span class="block text-sm font-semibold text-gray-900">{{ Auth::user()->name ?? ''  }}</span>
                            <span class="block text-sm text-gray-900 truncate">{{ Auth::user()->email ?? ''  }}</span>
                        </div>
                        <ul class="py-1 text-gray-700" aria-labelledby="dropdown">
                            <li>
                                {{-- <a href="{{ route('profile') }}" class="block py-2 px-4 text-sm hover:bg-gray-100">My profile</a> --}}
                            </li>
                        </ul>

                        <ul class="py-1 text-gray-700" aria-labelledby="dropdown">
                            <li>
                                {{-- form logout --}}
                                <form class="hover:bg-gray-100" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="block py-2 px-4 font-normal text-sm" type="submit">{{ __('Sign out') }}</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-gray-800 hover:bg-primary-50 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Log in</a>
            @endauth
            <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>             
            </button>
        </div>
        <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                <li>
                    <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Home</a>
                </li>
                <li>
                    <a href="#" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Add Items</a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>