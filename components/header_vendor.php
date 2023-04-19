<?php echo'
    <div class="bg-white shadow sticky top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-1 md:py-4">
            <div class="flex items-center justify-between">
                <div>
                    <a href="./vendor.php" class="font-bold text-gray-700 text-2xl">Feetsh*t.</a>
                </div>
                <div class="flex flex-row">
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