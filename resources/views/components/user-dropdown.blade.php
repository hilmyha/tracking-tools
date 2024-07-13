{{-- user menu --}}
<button type="button" class="flex mx-3 text-sm bg-gray-800 w-8 h-8 rounded-full lg:mr-0 focus:ring-4 focus:ring-primary" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
    <span class="sr-only">Open user menu</span>
    <img class="object-cover rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
</button>
<!-- Dropdown menu -->
<div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 border shadow-md" id="dropdown">
    <div class="py-3 px-4">
        <span class="block text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</span>
        <span class="block text-sm font-light text-gray-500 truncate">{{ Auth::user()->email }}</span>
    </div>
    <ul class="user-dropdown py-1 font-light text-gray-500" aria-labelledby="dropdown">
        <li>
            <a href="{{ route('dashboard') }}" class="block py-2 px-4 text-sm text-gray-500 hover:bg-gray-100">Dashboard</a>
        </li>
    </ul>
    <ul class="py-1 font-light text-gray-500" aria-labelledby="dropdown">
        <form class="hover:bg-gray-100" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="block py-2 px-4 text-sm" type="submit">{{ __('Logout') }}</button>
        </form>
    </ul>
</div>