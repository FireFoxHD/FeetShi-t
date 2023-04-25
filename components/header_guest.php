<?php echo'
    <div class="bg-white shadow sticky top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-1 md:py-4">
            <div class="flex items-center justify-between md:justify-start">
                <!-- Menu Trigger -->
                <button type="button" class="md:hidden w-10 h-10 rounded-lg -ml-2 flex justify-center items-center">
                    <svg class="text-gray-500 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <!-- ./ Menu Trigger -->

                <!-- TODO: navigation back to index doesnt work from product page -->
                <a href="index.php" class="font-bold text-gray-700 text-2xl">Feetsh*t.</a>

                <nav class="hidden md:flex space-x-3 flex-1 lg:ml-8 mx-4">
                    <ul class="hidden md:flex space-x-3 flex-1 lg:ml-8">
                        <li>
                            <a href="#" class="px-2 py-2 font-bold hover:bg-gray-100 rounded-lg text-gray-400 hover:text-gray-600">Collections</a>
                        </li>
                        <li>
                            <a href="about.php" class="px-2 py-2 font-bold hover:bg-gray-100 rounded-lg text-gray-400 hover:text-gray-600">About Us</a>
                        </li>
                        <li>
                            <a href="contact.php" class="px-2 py-2 font-bold hover:bg-gray-100 rounded-lg text-gray-400 hover:text-gray-600">Contact Us</a>
                        </li>

                    </ul>
                </nav>

                <div class="flex items-center space-x-4">
                    <div class="relative hidden md:block">
                        <input type="search" class="pl-10 pr-2 h-10 py-1 rounded-lg border border-gray-200 focus:border-gray-300 focus:outline-none focus:shadow-inner leading-none" placeholder="Search">
                        <svg class="h-6 w-6 text-gray-300 ml-2 mt-2 stroke-current absolute top-0 left-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <div class="flex items-center space-x-4">        
                        <a href="cart.php" class="flex text-white text-md h-10 items-center px-5 rounded-lg bg-indigo-600 focus:outline-none hover:bg-indigo-500">
                            View Cart
                        </a>
                        <form class="m-0 p-0" action="./scripts/logout_script.php" method="POST">
                            <input type="submit" value="Log out" name="logout" class="flex h-10 items-center px-5 rounded-lg border border-2 border-gray-200 hover:border-gray-300 focus:outline-none hover:shadow-inner"/>
                        </form>
                    <div>

                </div>
            </div>

            <!-- Search Mobile -->
            <div class="relative md:hidden">
                <input type="search" class="mt-1 w-full pl-10 pr-2 h-10 py-1 rounded-lg border border-gray-200 focus:border-gray-300 focus:outline-none focus:shadow-inner leading-none" placeholder="Search">

                <svg class="h-6 w-6 text-gray-300 ml-2 mt-3 stroke-current absolute top-0 left-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <!-- Search Mobile -->

        </div>
            </div>
        </div>
    </div>
';?>