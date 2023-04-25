<?php echo'
    <div class="bg-white shadow sticky top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-1 md:py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-between md:justify-start">
                    <a href="admin.php" class="font-bold text-gray-700 text-2xl">Feetsh*t.</a>

                    <nav class="hidden md:flex space-x-3 flex-1 lg:ml-8 mx-4">
                        <ul class="hidden md:flex space-x-3 flex-1 lg:ml-8">
                            <li>
                                <a href="admin.php" class="px-2 py-2 font-bold hover:bg-gray-100 rounded-lg text-gray-400 hover:text-gray-600">View Users</a>
                            </li>
                            
                            <li>
                                <a href="admin_registerUser.php" class="px-2 py-2 font-bold hover:bg-gray-100 rounded-lg text-gray-400 hover:text-gray-600">Add User</a>
                            </li>

                            <li>
                                <a href="admin_viewProducts.php" class="px-2 py-2 font-bold hover:bg-gray-100 rounded-lg text-gray-400 hover:text-gray-600">View Products</a>
                            </li>

                            <li>
                                <a href="viewOrders.php" class="px-2 py-2 font-bold hover:bg-gray-100 rounded-lg text-gray-400 hover:text-gray-600">View Orders</a>
                            </li>
                           
                        </ul>
                    </nav>

                </div>

                <div class="flex items-center">
                    <p class="mx-8 font-bold text-2xl text-gray-500">Admin Dashboard</p>
                    <form action="./scripts/logout_script.php" method="POST">     
                        <input type="submit" value="Log out" name="logout" class="flex text-white text-md h-10 items-center px-5 rounded-lg bg-indigo-600 focus:outline-none hover:bg-indigo-500" />
                    </form>
                </div>

                
            </div>
        </div>
    </div>
';?>