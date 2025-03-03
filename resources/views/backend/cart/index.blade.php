@extends('backend.layouts.master')

@section('css')
@endsection

@section('content')
    <div class="h-dvh p-5">
        <main class="flex flex-1 bg-white p-5 rounded-lg shadow-md">
            <section class="flex-1 p-5 bg-white">
                <div class="flex mb-5">

                    <form class="w-full mx-auto">
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-onl">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            {{-- button search --}}
                            <input type="search" id="default-search"
                                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search Mockups, Logos..." required />
                            <button type="submit"
                                class="text-white absolute end-2 flex items-center bottom-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                        </div>
                    </form>
                </div>
                <div class="flex justify-start bg-gray-50 py-2 px-2 rounded-lg shadow-md overflow-auto no-scrollbar p-1">
                    <div class="flex space-x-4 w-[800px] ">
                        @foreach ($category as $categoryItem)
                            <button class="px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 whitespace-nowrap mb-1">{{ $categoryItem->CategoryName }}</button>                      
                        @endforeach
                      {{-- <button class="px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 whitespace-nowrap">Starters</button>
                      <button class="px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 whitespace-nowrap">Breakfast</button>
                      <button class="px-4 py-2 text-blue-600 border border-blue-500 bg-blue-100 rounded-md whitespace-nowrap">Lunch</button>
                      <button class="px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 whitespace-nowrap">Supper</button>
                      <button class="px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 whitespace-nowrap">Desserts</button>
                      <button class="px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 whitespace-nowrap">Beverages</button>
                      <button class="px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 whitespace-nowrap">Desserts</button>
                      <button class="px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 whitespace-nowrap">Beverages</button>
                      <button class="px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 whitespace-nowrap">Desserts</button>
                      <button class="px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 whitespace-nowrap">Beverages</button>
                      <button class="px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 whitespace-nowrap">Desserts</button>
                      <button class="px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 whitespace-nowrap">Beverages</button>
                      <button class="px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 whitespace-nowrap">Desserts</button>
                      <button class="px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 whitespace-nowrap">Beverages</button>
                      <button class="px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 whitespace-nowrap">Desserts</button>
                      <button class="px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 whitespace-nowrap">Beverages</button> --}}
                      <!-- Add more buttons as needed -->
                    </div>
                  </div>
                  
                  
                  
                  
                {{-- product card --}}
                <div class="grid lg:grid-cols-4 gap-4 overflow-auto h-[570px] no-scrollbar p-1">

                    @if (count($medicineModel) > 0)
                        @foreach ($medicineModel as $item)
                            <div
                                class="relative flex w-full max-w-48 flex-col rounded-lg border border-gray-100 bg-white shadow-md">
                                <a class="relative mx-3 mt-3 flex h-40 overflow-hidden rounded-xl" href="{{ route('view.detail', [$item->id]) }}">
                                    {{-- @if ($item->Image !== '')
                                        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $item->Image) }}"
                                            alt="img">
                                    @else
                                        <img src="{{ asset('/images/no-img.png') }}" alt="image">
                                    @endif --}}
                                    <img src="{{ asset('/images/no-img.png') }}" alt="image">
                                </a>
                                <div class="mt-4 px-4 pb-4">
                                    <a href="#">
                                        <h6 class="text-xs tracking-tight text-slate-900">{{ $item->MedicineName }}</h6>
                                    </a>
                                    <div class="mt-2 mb-5 flex items-center justify-between">
                                        <span class="text-xs font-bold text-slate-900">{{ $item->Price }} ៛</span>
                                    </div>
                                    {{-- counter button --}}
                                    <div class="flex items-center space-x-2 justify-self-end">
                                            <button
                                              class="bg-gray-200  w-5 h-5 rounded-full flex items-center justify-center hover:bg-gray-300"
                                              onclick="decrementItem({{ $item->id }}, '{{ $item->MedicineName }}', {{ $item->Price }})"
                                            >
                                              -
                                            </button>
                                            <span id="{{$item->id}}" class="text-gray-700 font-medium w-3">0</span>
                                            <button
                                              class="bg-blue-600 w-5 h-5 rounded-full flex items-center justify-center hover:bg-blue-400  text-slate-50 text-xs"
                                              onclick="incrementItem({{ $item->id }}, '{{ $item->MedicineName }}', {{ $item->Price }})"
                                            >
                                              +
                                            </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <tr class="flex justify-center">
                            <span>No Data</span>
                        </tr>
                    @endif

                </div>
            </section>

                   {{-- end product card --}}

            <aside class="w-1/3 p-5 bg-white border-l shadow-lg rounded-lg border h-[650px] mt-10 justify-between">
                <h2 class="text-lg font-semibold mb-4">Checkout</h2>
                <div class="space-y-4 no-scrollbar overflow-auto h-[420px] bg-zinc-100 rounded-lg">
                    <!-- Product Items -->
                    <table class="w-full">
                        <tbody id="medicine">

                        </tbody>
                    </table>
                </div>

                <div class="mt-6 space-y-3">
                    {{-- <div class="flex justify-between">
                        <span>Discount (%)</span>
                        <span id="discount">0</span>
                    </div> --}}
                    <div class="flex justify-between ">
                        <span>Sub Total</span>
                        <span id="subtotal">0</span>
                    </div>
                    <div class="flex justify-between font-bold">
                        <span>Total</span>
                        <span id="total">0</span>
                    </div>
                </div>
                <button id="payButton" class="w-full bg-green-500 rounded-lg text-white py-2 mt-4 content-end">Pay (0)</button>
            </aside>
        </main>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script>
        
        
        let cart = []; // Initialize cart array
        let checkout =[];
    function incrementItem(id, name, price) {
        console.log(id, name, price);
        
        id = parseInt(id); 
            const existingMedicine = cart.find(item => item.id === id);

            if (existingMedicine) {
                existingMedicine.quantity += 1; // Increase quantity
                document.getElementById(id).textContent = existingMedicine.quantity;
            } else {
                cart.push({
                    id,
                    name,
                    price,
                    quantity: 1
                }); // Add new medicine
                document.getElementById(id).textContent = 1;
            }
            updateCart();
            
            
        // quantity++;
        // document.getElementById('quantity-display').textContent = quantity;
    }

  function decrementItem(id, name, price) {
    console.log(id, name, price);
        
        id = parseInt(id); 
            const existingMedicine = cart.find(item => item.id === id);

            if (existingMedicine.quantity > 1) {
                existingMedicine.quantity --; // Increase quantity
                document.getElementById(id).textContent = existingMedicine.quantity;
            } else {
                cart = cart.filter(item => item.id !== id); // Add new medicine
                document.getElementById(id).textContent = 0;
            }

            updateCart();
  }
        // Add to Cart Function
        // function addToCart(id, name, price) {
        //     id = parseInt(id); 
        //     const existingMedicine = cart.find(item => item.id === id);

        //     if (existingMedicine) {
        //         existingMedicine.quantity += 1; // Increase quantity
        //     } else {
        //         cart.push({
        //             id,
        //             name,
        //             price,
        //             quantity: 1
        //         }); // Add new medicine
        //     }

        //     updateCart(); // Refresh cart UI
        // }

        // Update Cart UI
        function updateCart() {
            const medicineContainer = document.getElementById('medicine');
            medicineContainer.innerHTML = ''; // Clear existing content

            let subtotal = 0;

            cart.forEach(item => {
                const medicineHTML = `
            <tr class="border-b border-gray-200 text-xs mx-1.5">
                <td class="text-gray-700 p-2 w-44">${item.name}</td>
                <td class="text-gray-500 p-2">x${item.quantity}</td>
                <td class="text-gray-700 text-right p-2">${(item.quantity*item.price).toFixed(2)}៛</td>
                <td class="text-right p-2">
                <button class="text-red-500 ml-2" onclick="removeFromCart(${item.id})">cancel</button>
                </td>
            </tr>
        `;
                medicineContainer.insertAdjacentHTML('beforeend', medicineHTML);
                subtotal += item.price * item.quantity;
            });

            calculateTotal(subtotal); // Update totals
        }

        // Remove Item from Cart
        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            updateCart(); // Refresh cart UI
            document.getElementById(id).textContent = 0;
        }

        // Calculate and Display Totals
        function calculateTotal(subtotal) {
            const discountRate = 20; // 20% discount
            const discount = (subtotal * discountRate) / 100;
            const total = subtotal - discount;

            document.getElementById('subtotal').innerText = `${subtotal.toFixed(2)} ៛`;
            document.getElementById('total').innerText = `${total.toFixed(2)} ៛`;

            document.getElementById('payButton').innerText = `Pay (${total.toFixed(2)}) ៛`;
        }

        // Event Listener for "Add to Cart" buttons
        // document.addEventListener('click', function(e) {
        //     const button = e.target.closest('.add-to-cart'); // Detect button click

        //     if (button) {
        //         e.preventDefault(); // Prevent default behavior

        //         const id = button.getAttribute('data-id');
        //         const name = button.getAttribute('data-name');
        //         const price = parseFloat(button.getAttribute('data-price'));

        //         addToCart(id, name, price); // Add item to cart
        //     }
        // });

        // Pay Button Event
        document.getElementById('payButton').addEventListener('click', function() {
            if (cart.length === 0) {
                alert('Please add some medicine to cart');
                return;
            }
           for (let i = 0; i < cart.length; i++) {
            checkout.push({id: cart[i].id, quantity: cart[i].quantity});

            document.getElementById(cart[i].id).textContent = 0;}
            console.log(checkout);
            
            $.ajax({
                type: 'POST',
                url: '/checkout',
                data: {
                    cart: checkout
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response.message);
                    alert('Payment successful');
                },
                error: function(error) {
                    console.error(error);
                }
            })
            /*
            axios.post('/checkout', {
                cart: checkout,
            })
            .then(function (response) {
                alert(response.data.message);
                })
                    .catch(function (error) {
                    if (error.response) {
                        console.error(error.response.data.message);
                    }
                 });
 

            */
           
            cart = []; // Clear cart after payment
            updateCart(); // Refresh cart UI
        });
    </script>
@endsection
