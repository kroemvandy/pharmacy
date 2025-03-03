<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
    <title>Phamacy</title>
    @yield('css')
</head>

<body>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
            class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

        @include('backend.components.sidebar')

        <div class="flex flex-col flex-1 overflow-hidden">
            @if ('get/cart' != request()->path())
                
            @include('backend.components.navbar')
            @endif
            <div>
                @yield('content')
            </div>
        </div>
      
    </div>

    @yield('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <script type="text/javascript">
        $('.show_confirm').click(function(e) {
            if(!confirm('Are you sure you want to delete this?')) {
                e.preventDefault();
            }
        });
    </script>
    {{-- <script>
        const products = [
            { name: "Risus Fringilla", price: 19.00, quantity: 0 },
            { name: "Commodo Fusce", price: 19.00, quantity: 0 },
            { name: "Lorem Pharetra", price: 19.00, quantity: 0 },
        ];
    
        const discountPercent = 20;
        const taxPercent = 1.5;
    
        const productsContainer = document.getElementById('products');
        const subtotalElement = document.getElementById('subtotal');
        const taxElement = document.getElementById('tax');
        const totalElement = document.getElementById('total');
        const payButton = document.getElementById('payButton');
    
        function renderProducts() {
            productsContainer.innerHTML = '';
            products.forEach((product, index) => {
                productsContainer.innerHTML += `
                    <div class="flex justify-between items-center">
                        <span>${product.name}</span>
                        <div class="flex items-center">
                            <button class="px-2 bg-gray-300 rounded-md" onclick="updateQuantity(${index}, -1)">-</button>
                            <span class="px-2">${product.quantity}</span>
                            <button class="px-2 bg-gray-300 rounded-md" onclick="updateQuantity(${index}, 1)">+</button>
                        </div>
                        <span>$${(product.price * product.quantity).toFixed(2)}</span>
                    </div>`;
            });
            updateSummary();
        }
    
        function updateQuantity(index, change) {
            products[index].quantity = Math.max(0, products[index].quantity + change);
            renderProducts();
        }
    
        function updateSummary() {
            let subtotal = products.reduce((sum, p) => sum + p.price * p.quantity, 0);
            let discount = (subtotal * discountPercent) / 100;
            let tax = ((subtotal - discount) * taxPercent) / 100;
            let total = subtotal - discount + tax;
    
            subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
            taxElement.textContent = `$${tax.toFixed(2)}`;
            totalElement.textContent = `$${total.toFixed(2)}`;
            payButton.textContent = `Pay ($${total.toFixed(2)})`;
        }
    
        renderProducts();
    </script> --}}
  
</body>

</html>
