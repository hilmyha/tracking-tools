<x-app-layout title="Renter Detail">
  <div class="lg:ml-64">
    {{-- hitung harga --}}
    @php
        // parse tanggal
        $rentdate = \Carbon\Carbon::parse($rent->rental_date);
        $duedate = \Carbon\Carbon::parse($rent->due_date);
        $returndate = \Carbon\Carbon::parse($rent->return_date);
  
        // selisih dan bulatkan
        $diff = $duedate->diffInDays($rentdate, true);
        $diffDay = round($diff) + 1;

        // hitung dari rentdate ke returndate
        $diffReturn = $returndate->diffInDays($rentdate, true);
        $diffReturn = round($diffReturn);

        // hari ini
        $now = \Carbon\Carbon::now();

        $estimatePrice = $diffDay * $rent->tool->price_per_day;

        // hitung hari terlewat
        $pass = $now->diffInDays($duedate, false);
        $passed = round($pass);

        $lateFee = $passed <= 0 ? $rent->tool->price_per_day * $passed : 0;
        
    @endphp

    <h2 class="mb-3 text-xl font-bold text-gray-900 dark:text-white">Renter Detail</h2>
    
    <p>
      Renter Name: {{ $rent->renter_name }}
    </p>
    
    <ol class="relative border-s border-gray-200 dark:border-gray-700 mt-12 mx-8">                  
      <li class="mb-10 ms-6">
          <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
              <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
              </svg>
          </span>
          <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">
            Registered [{{ $rent->tool->serial_number }}]
          </h3>
          <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
            {{ $rentdate->diffForHumans() }}
          </time>
          
          <p class="text-base font-normal text-gray-500">
            Price Per Day Rp.{{ $rent->tool->price_per_day }},-
          </p>
          
      </li>
      <li class="mb-10 ms-6">            
          <span class="absolute flex items-center justify-center w-6 h-6 bg-orange-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-orange-900">
              <svg class="w-2.5 h-2.5 text-orange-800 dark:text-orange-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
              </svg>
          </span>
          <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
            On Rent [{{ $rent->tool->serial_number }}]
          </h3>
          <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Rented on {{ $rentdate->diffForHumans() }}</time>
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
          <p class="mt-2 text-base font-normal text-gray-500">
            Estimated cost Rp.{{ $estimatePrice }},-
          </p>
          
      </li>
      
      @if ($rent->rental_status == 'Returned')
        <li class="ms-6">
            <span class="absolute flex items-center justify-center w-6 h-6 bg-green-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-green-900">
                <svg class="w-2.5 h-2.5 text-green-800 dark:text-green-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                </svg>
            </span>
            <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">
              Returned [{{ $rent->tool->serial_number }}]
            </h3>
            <time class="block mb-3 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Returned on {{ $returndate->diffForHumans() }}</time>
            
            <table class="md:w-full w-1/2 text-sm text-left rtl:text-right text-gray-500">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                  <tr>
                      <th scope="col" class="px-6 py-2">
                          Rent Cost
                      </th>
                      <th scope="col" class="px-6 py-2">
                          Late Fee
                      </th>
                  </tr>
              </thead>
              <tbody>
                  <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                      <td class="px-6 py-4">
                          Rp.{{ number_format($rent->total_cost, 0, '.', '.') }},-
                      </td>
                      <td class="px-6 py-4">
                          Rp.{{ number_format($rent->late_fee, 0, '.', '.') }},-
                      </td>
                  </tr>
              </tbody>
              <tfoot>
                <tr class="font-semibold text-green-700 bg-green-50">
                    <th scope="row" class="px-6 py-2 text-xs uppercase">Total Cost</th>
                    <td class="px-6 py-2 underline">Rp.{{ number_format(($rent->total_cost + $rent->late_fee), 0, '.', '.') }},-</td>
                </tr>
              </tfoot>
          </table>

          <x-tertiary-button href="{{ route('rents.invoice', $rent->id) }}" class="mt-4">
            <svg class="w-5 h-5 mr-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
              <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd"/>
              <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd"/>
            </svg>
          
            {{ $invoiceNumber = '[RNT-' . $rent->id . '-' . now()->format('dmy') . ']'; }}
          </x-tertiary-button>

        </li>
      @endif
    </ol>

    @auth
      @if ($rent->rental_status == 'Rented')
          <form action="{{ route('rents.update', $rent->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="flex">
                <div class="w-23 mr-4">
                  <x-text-input type="datetime-local" name="return_date" placeholder="Tanggal Kembali" required />
                </div>
                <x-primary-button type="submit" class="btn btn-success">Kembalikan</x-primary-button>
              </div>
          </form>
      @endif  
    @endauth

  </div>
  
</x-app-layout>