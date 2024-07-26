<x-app-layout title="Home">
    <div class="lg:ml-64">
        @include('components.calendar')
        <div class="mb-4 grid lg:grid-flow-col grid-flow-row gap-4">
            <div class="border-2 border-dashed p-6 flex gap-2 items-center">
                <svg class="w-10 h-10 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.408-5.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4a1 1 0 0 0-1-1h-2Z" clip-rule="evenodd"/>
                </svg>
                
                <div class="">
                    <h2 class="font-bold text-lg">Total Tools</h2>
                    <p class="text-lg">
                        {{ $tools->count() }}
                    </p>
                </div>
            </div>
            <div class="border-2 border-dashed p-6 flex gap-2 items-center">
                <svg class="w-10 h-10 text-green-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
                </svg>

                <div class="">
                    <h2 class="font-bold text-lg">Available</h2>
                    <p class="text-lg">
                        {{ $tools->count() - $rents->where('rental_status', 'Rented')->count() }}
                    </p>
                </div>
            </div>
            <div class="border-2 border-dashed p-6 flex gap-2 items-center">
                <svg class="w-10 h-10 text-red-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                </svg>

                <div class="">
                    <h2 class="font-bold text-lg">Unavailable</h2>
                    <p class="text-lg">
                        {{ $rents->where('rental_status', 'Rented')->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="mb-4 border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="me-2" role="presentation">
                    <x-tabs-button id="rents-tab" data-tabs-target="#rents" type="button" role="tab" aria-controls="rents" aria-selected="false">
                        Renter
                    </x-tabs-button>
                </li>
                <li class="me-2" role="presentation">
                    <x-tabs-button id="tools-tab" data-tabs-target="#tools" type="button" role="tab" aria-controls="tools" aria-selected="false">
                        Tools
                    </x-tabs-button>
                </li>
                
                <li class="me-2" role="presentation">
                    <x-tabs-button id="calibrations-tab" data-tabs-target="#calibrations" type="button" role="tab" aria-controls="calibrations" aria-selected="false">
                        Calibrations Status
                    </x-tabs-button>
                </li>
            </ul>
        </div>
        <div id="default-tab-content">
            <div class="hidden rounded-lg bg-gray-50 p-8" id="rents" role="tabpanel" aria-labelledby="rents-tab">

                @if ($rents->count())  
                    <div class="grid gap-3">
                        @foreach ($rents as $rent)
                            <a href="{{ route('rents.show', $rent->id) }}">
                                <div class="border-b-2 border-dashed pb-4">
                                    @php
                                        $rentdate = \Carbon\Carbon::parse($rent->rental_date);
                                        $duedate = \Carbon\Carbon::parse($rent->due_date);
    
                                        // hitung selisih hari dan bulatkan
                                        $diff = $duedate->diffInDays(now(), true);
    
                                        // hitung tanggal ini
                                        $now = \Carbon\Carbon::now();
                                        // hitung hari yang lewat
                                        $pass = $now->diffInDays($duedate, false);
    
                                    @endphp
                                    <h3 class="font-semibold text-gray-900 text-lg">{{ $rent->renter_name }}</h3>
                                    <a href="mailto:{{ $rent->renter_email }}" class="text-gray-500 mb-2 text-sm hover:text-blue-500">[ {{ $rent->renter_email }} ]</a>
                                    <p class="text-gray-500 mb-2 text-sm">Rent {{ $rent->tool->serial_number }} due date [ {{ $duedate->format('D, d M Y') }} ]</p>
    
                                    @if ($rent->rental_status == 'Rented')
                                        @if ($pass <= 0)
                                            <span class="px-2 py-1 text-xs rounded-full bg-gray-500 text-white border-2 border-gray-900">
                                                Late: {{ $duedate->diffForHumans() }}
                                            </span>
                                        @elseif ($diff <= 7)
                                            <span class="px-2 py-1 text-xs rounded-full bg-red-300 text-red-500 border-2 border-red-500">
                                                Due Date: {{ $duedate->diffForHumans() }}
                                            </span>
                                        @elseif ($diff <= 14)
                                            <span class="px-2 py-1 text-xs rounded-full bg-orange-300 text-orange-500 border-2 border-orange-500">
                                                Due Date: {{ $duedate->diffForHumans() }}
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-300 text-green-500 border-2 border-green-500">
                                                Due Date: {{ $duedate->diffForHumans() }}
                                            </span>
                                        @endif
                                    @elseif ($rent->rental_status == 'Returned')
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-300 text-green-500 border-2 border-green-500">
                                            {{ $rent->rental_status }}
                                        </span>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm">No renter found</p>
                @endif

                @auth
                    <x-tertiary-button href="{{ route('rents.create') }}" class="mt-6">
                        <svg aria-hidden="true" class="w-5 h-5 mr-2 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                        </svg>
                        Add Renter
                    </x-tertiary-button>
                @endauth
            </div>
            <div class="hidden rounded-lg bg-gray-50 p-8" id="tools" role="tabpanel" aria-labelledby="tools-tab">
                
                @if ($tools->count())
                    <div class="grid gap-4">
                        @foreach ($tools as $tool)
                            @php
                                $tool_price = number_format($tool->price_per_day, 0, ',', '.');
                            @endphp
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="w-24 h-24" src="https://picsum.photos/200/300/?{{ $tool->name }}" alt="{{ $tool->type }}">
                                </div>
                                <div class="flex-grow ms-3">
                                    <h3 class="font-semibold text-gray-900 text-lg mb-2">{{ $tool->name }} ({{ $tool->serial_number }})</h3>

                                    <span class="text-gray-500 text-sm mr-2">Rp, {{ number_format($tool->price_per_day, 0, ',', '.') }},- per day</span>
                                    @if ($tool->status == 'Rented')
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-300 text-red-500 border-2 border-red-500">
                                            {{ $tool->status }}
                                        </span>
                                    @elseif ($tool->status == 'Available')
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-300 text-green-500 border-2 border-green-500">
                                            {{ $tool->status }}
                                        </span>
                                    @endif
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm">No tools found</p>
                @endif

                @auth
                    <x-tertiary-button href="{{ route('tools.create') }}" class="mt-6">
                        <svg aria-hidden="true" class="w-5 h-5 mr-2 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z" clip-rule="evenodd"/>
                        </svg>
                        Add Tools
                    </x-tertiary-button>
                @endauth

            </div>
            
            <div class="hidden rounded-lg bg-gray-50 p-8" id="calibrations" role="tabpanel" aria-labelledby="calibrations-tab">
                
                @if ($calibrates->count())
                    <div class="grid gap-4">
                        @foreach ($calibrates as $calibrate)
                            <div class="flex gap-3">
                                @php
                                    $calibrate_date = \Carbon\Carbon::parse($calibrate->calibration_date);
                                    $calibrate_due_date = \Carbon\Carbon::parse($calibrate->calibration_due_date);

                                    // hitung selisih hari dan bulatkan
                                    $diff = $calibrate_due_date->diffInDays(now(), true);

                                    
                                @endphp

                                <div class="flex gap-2">
                                    <span class="border-r-2 pr-3">
                                        {{ $loop->iteration }}
                                    </span>

                                    <div>
                                        <h3 class="font-semibold text-gray-900 text-lg">{{ $calibrate->tool->name }} ({{ $calibrate->tool->serial_number }}) </h3>
                                        <div class="mt-1">
                                            <p class="text-gray-500 text-sm mb-1">{{ $calibrate_date->format('d M Y') }} - {{ $calibrate_due_date->format('d M Y') }}</p>

                                            {{-- <p>
                                                {{ $diff }}
                                            </p> --}}
                                            
                                            @if ($diff <= 14)
                                                <span class="px-2 py-1 text-xs rounded-full bg-red-300 text-red-500 border-2 border-red-500">
                                                    Due Date: {{ $calibrate_due_date->diffForHumans() }}
                                                </span>
                                            @elseif ($diff <= 90)
                                                <span class="px-2 py-1 text-xs rounded-full bg-orange-300 text-orange-500 border-2 border-orange-500">
                                                    Due Date: {{ $calibrate_due_date->diffForHumans() }}
                                                </span>
                                            @else
                                                <span class="px-2 py-1 text-xs rounded-full bg-green-300 text-green-500 border-2 border-green-500">
                                                    Due Date: {{ $calibrate_due_date->diffForHumans() }}
                                                </span>
                                            @endif  
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm">No calibration found</p>
                @endif

            </div>
        </div>



    </div>
</x-app-layout>