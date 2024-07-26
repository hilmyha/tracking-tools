<x-app-layout title="Report">
    <div class="lg:ml-64">
        <h2 class="mb-3 text-xl font-bold text-gray-900">Report</h2>
        
        

        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-4 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Rent Cost
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Late Fee
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rents as $rent)   
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $rent->renter_name }}
                        </th>
                        <td class="px-4 py-4">
                            Rp.{{ number_format(($rent->total_cost), 0, '.', '.') }},-
                        </td>
                        <td class="px-4 py-4">
                            Rp.{{ number_format(($rent->late_fee), 0, '.', '.') }},-
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
            <tfoot>
                <tr class="font-semibold text-primary-700 bg-primary-50">
                    <th scope="row" class="px-4 py-2 text-xs uppercase">Total Cost</th>
                    <td class="px-4 py-2 underline">Rp.{{ number_format(($totalIncome), 0, '.', '.') }},-</td>
                    <td class="px-4 py-2 underline">Rp.{{ number_format(($totalLateFee), 0, '.', '.') }},-</td>
                </tr>
            </tfoot>
        </table>

    </div>
</x-app-layout>