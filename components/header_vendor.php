<?php echo'
    <div class="bg-white shadow sticky top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-1 md:py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-between md:justify-start">
                    <a href="vendor.php" class="font-bold text-gray-700 text-2xl">Feetsh*t.</a>

                    <nav class="hidden md:flex space-x-3 flex-1 lg:ml-8 mx-4">
                        <ul class="hidden md:flex space-x-3 flex-1 lg:ml-8">
                            <li>
                                <a href="vendor.php" class="px-2 py-2 font-bold hover:bg-gray-100 rounded-lg text-gray-400 hover:text-gray-600">View Products</a>
                            </li>
                            <li>
                                <a href="addProduct.php" class="px-2 py-2 font-bold hover:bg-gray-100 rounded-lg text-gray-400 hover:text-gray-600">Add Products</a>
                            </li>
                        
                        </ul>
                    </nav>

                   
                </div> 

                <div class="flex items-center">
                    <p class="mx-8 font-bold text-2xl text-gray-500">Vendor Dashboard</p>

                    <form action="./scripts/logout_script.php" method="POST">
                        <button name="logout" class="flex text-white text-md h-10 items-center px-5 rounded-lg bg-indigo-600 focus:outline-none hover:bg-indigo-500">
                        Log out
                        </button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
';?>