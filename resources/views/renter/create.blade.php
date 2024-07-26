<x-app-layout title="Add Renter">
  <section class="lg:ml-64 bg-white">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new Renter</h2>
        <form action="{{ route('rents.store') }}" method="POST">
          @csrf
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="sm:col-span-2">
                  <x-input-label for="renter_name" value="Renter Name" />
                  <x-text-input id="renter_name" name="renter_name" type="text" value="{{ old('renter_name') }}" placeholder="Renter Name" />
                  <x-input-error :messages="$errors->get('renter_name')" class="mt-2" />
                </div>
                <div class="w-full">
                  <x-input-label for="renter_email" value="Renter Email" />
                  <x-text-input id="renter_email" name="renter_email" type="email" value="{{ old('renter_email') }}" placeholder="Renter Email" />
                  <x-input-error :messages="$errors->get('renter_email')" class="mt-2" />
                </div>
                <div class="w-full">
                  <x-input-label for="tools" value="Tools Name" />
                  <select name="tool_id" id="tools" class="bg-gray-50 w-full text-gray-500 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @foreach ($tools as $tool)
                      @if (old('tool_id') == $tool->id)
                        <option class="text-gray-500" value="{{ $tool->id }}" selected>[{{ $tool->serial_number }}] {{ $tool->name }}</option>
                      @else
                        <option class="text-gray-500" value="{{ $tool->id }}">[{{ $tool->serial_number }}] {{ $tool->name }}</option>
                      @endif
                    @endforeach
                  </select>
                  <x-input-error :messages="$errors->get('tool_id')" class="mt-2" />
                </div>
                <div>
                  <x-input-label for="due_date" value="Due Date" />
                  <x-text-input id="due_date" name="due_date" type="date" value="{{ old('due_date') }}" placeholder="Due Date" />
                  <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                </div>
            </div>
            <x-primary-button type="submit" class="mt-4 transition">Submit</x-primary-button>
        </form>
    </div>
  </section>
</x-app-layout>