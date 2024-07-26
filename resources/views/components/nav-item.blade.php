<div>
  <a href="{{ $route }}" class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group">
      <svg aria-hidden="true" class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900">
          {{ $slot }}
      </svg>
      <span class="ml-3">{{ $name }}</span>
  </a>
</div>