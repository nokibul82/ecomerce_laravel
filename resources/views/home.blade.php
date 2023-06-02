<x-app-layout>

    <?php
    if( isset($_SESSION['status'])){
      ?>
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
          <span class="font-medium"> <?php echo $_SESSION['status'];?>
        </div>
      <?php
      unset($_SESSION['status']);
    }
    ?>
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Our Trnding Products</h2>
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">

                @foreach ($products as $product)
                <div class="group relative shadow-md p-5 rounded-md hover:shadow-xl">
                    <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                        <img src={{ $product->imageUrl}} alt="Front of men&#039;s Basic Tee in black." class="h-full w-full
            object-cover object-center lg:h-full lg:w-full">
                    </div>
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-lg text-gray-700">
                                {{ $product->title }}
                            </h3>
                        </div>
                        <p class="text-lg font-medium text-gray-900">${{$product->price}}</p>
                        <div>
                            <form action="/add_to_cart" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value={{$product->id}}>
                                <button class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-thin rounded-lg text-sm px-2 py-1 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                    Add to cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- More products... -->
            </div>
        </div>
    </div>
</x-app-layout>
