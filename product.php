<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/icons/favicon-32x32.png">
    <title>Feetsh*t</title>
</head>

<body class="flex flex-col min-h-screen">
    <?php require '../components/header.php'; ?>
    <div class="antialiased">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="flex flex-col md:flex-row -mx-4">
                <img class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4" src="./assets/images/sneakers/whitesneakers.jpg">
                <div class="md:flex-1 px-4">
                    <h2 class="mb-2 leading-tight tracking-tight font-bold text-gray-800 text-2xl md:text-3xl">Greats The Royale</h2>
                    <p class="text-gray-500 text-sm">By <a href="#" class="text-indigo-600 hover:underline">ABC Company</a></p>

                    <div class="flex items-center space-x-4 my-4">
                        <div>
                            <div class="rounded-lg bg-gray-100 flex py-2 px-3">
                                <span class="text-indigo-400 mr-1 mt-1">$</span>
                                <span class="font-bold text-indigo-600 text-3xl">25</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-green-500 text-xl font-semibold">Save 12%</p>
                            <p class="text-gray-400 text-sm">Inclusive of all Taxes.</p>
                        </div>
                    </div>

                    <p class="text-gray-500">This pair’s refined lines elevate any wardrobe choice. And these shoes are equally fitting for a dinner date or a day at the office. The full-grain leather is long-lasting and has a lovely, subtle shine, but they’re hard to break in.</p>

                    <div class="flex ml-6 items-center m-4">
                        <span class="mr-3">Size</span>
                        <div class="relative">
                            <select class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10">
                                <option>SM</option>
                                <option>M</option>
                                <option>L</option>
                                <option>XL</option>
                            </select>
                            <span class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4" viewBox="0 0 24 24">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </span>
                        </div>
                        <button type="button" class="h-12 mx-6 px-6 py-2 font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <?php require './components/footer.php'; ?>
</body>

</html>