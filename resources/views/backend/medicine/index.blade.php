@extends('backend.layouts.master')

@section('css')
@endsection

@section('content')
    <div class="bg-gray-100 p-5">
        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="text-2xl font-medium mb-2 text-gray-800">Medicine Page</h3>
            <hr>

            @if (Session::has('success'))
                <div id="success-alert"
                    class="p-3 mb-3 w-96 mt-1 mx-auto text-sm text-green-700 bg-green-100 border border-green-400 rounded-lg shadow-md flex items-center justify-between dark:bg-green-200 dark:text-green-800"
                    role="alert">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="22" height="22"
                            viewBox="0 0 48 48">
                            <path fill="#c8e6c9"
                                d="M36,42H12c-3.314,0-6-2.686-6-6V12c0-3.314,2.686-6,6-6h24c3.314,0,6,2.686,6,6v24C42,39.314,39.314,42,36,42z">
                            </path>
                            <path fill="#4caf50"
                                d="M34.585 14.586L21.014 28.172 15.413 22.584 12.587 25.416 21.019 33.828 37.415 17.414z">
                            </path>
                        </svg>
                        {{ Session::get('success') }}
                    </div>
                    <button onclick="document.getElementById('success-alert').remove();"
                        class="text-green-700 hover:text-green-800 focus:outline-none">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <script>
                    setTimeout(function() {
                        document.getElementById('success-alert').remove();
                    }, 5000);
                </script>
            @endif

            <div class="flex justify-end mt-5">
                <a href="{{ route('create-medicine') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-1 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><i
                        class='fas fa-plus-square'></i> Create Medicine</a>
            </div>

            <div class="overflow-auto h-[450px] no-scrollbar">
                <table class="min-w-full mt-5">
                    <thead>
                        <tr>
                            <th
                                class="pl-5 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                No.
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Name
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Description
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-center text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Price
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Qty
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Category
                            </th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">

                        @if (count($medicine) > 0)
                            @foreach ($medicine as $medicineItem)
                                <tr>
                                    <td class="px-5 py-2 whitespace-no-wrap border-b border-gray-200 overflow-auto">
                                        <div class="text-sm leading-5 text-gray-900">{{ $medicineItem->id }}</div>
                                    </td>

                                    <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10">
                                                @if ($medicineItem->Image !== '')
                                                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $medicineItem->Image) }}"
                                                        alt="img">
                                                @else
                                                    <img src="{{ asset('/images/no-img.png') }}" alt="image">
                                                @endif
                                            </div>

                                            <div class="ml-4">
                                                <div class="text-sm font-medium leading-5 text-gray-900">
                                                    {{ $medicineItem->MedicineName }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ $medicineItem->MedicineDescription }}</div>
                                    </td>

                                    <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-200 justify-items-end text-right">
                                        {{ number_format($medicineItem->Price, 2) }} ៛
                                    </td>

                                    <td
                                        class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        {{ $medicineItem->Qty }}</td>
                                    <td
                                        class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        {{ $medicineItem['category']['CategoryName'] }}</td>
                                    <td
                                        class="px-6 py-2 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200 flex items-center gap-2">
                                        <a href="{{ route('edit-medicine', [$medicineItem->id]) }}"
                                            class="tooltip text-white font-normal bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 rounded-md text-xs px-3 py-2.5 transition duration-150 ease-in-out dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700"><i
                                                class='fas fa-edit'></i><span class="tooltiptext">Edit</span></a>
                                        <a href="{{ route('view.detail', [$medicineItem->id]) }}"
                                            class="tooltip text-white font-normal bg-green-600 hover:bg-green-700 focus:ring-2 focus:ring-green-400 rounded-md text-xs px-3 py-2.5 transition duration-150 ease-in-out dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-700"><i
                                                class='fas fa-eye'></i><span class="tooltiptext">Detail</span></a>

                                        <form method="POST" action="{{ route('delete.medicine', [$medicineItem->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="tooltip show_confirm focus:outline-none text-white bg-red-600 hover:bg-red-700 focus:ring-2 focus:ring-red-400 font-normal rounded-md text-xs px-3 py-2.5 transition duration-150 ease-in-out dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-700"><i
                                                    class='fas fa-trash-alt'></i><span
                                                    class="tooltiptext">Delete</span></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <span class="">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="flex justify-center mt-10 mb-80 text-gray-500">No Data</th>
                            </span>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
