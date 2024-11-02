<header class="h-20 w-full bg-white fixed top-0 left-0 z-10">
    <nav class="flex justify-between space-x-4 h-full mx-8">
        <div class="flex space-x-4 items-center">
            <img src="{{ asset('images/logo.png') }}" class="w-14" alt="">
            <div class="font-medium text-xl text-black">
                <h1>Document Security and Digital Archiving System</h1>

            </div>
        </div>





        <div class="flex space-x-4 items-center relative">
            <div>
                <button id="dropdownNotificationButton"
                    class="relative inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400"
                    type="button">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 14 20">
                        <path
                            d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z" />
                    </svg>

                    <div
                        class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0.5 start-2.5 dark:border-gray-900">
                    </div>
                </button>

                <div id="dropdownNotificationContent"
                    class="border absolute right-10 top-16  bg-white shadow-lg rounded mt-2 w-72">
                    <div
                        class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                        Notifications
                    </div>
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                        <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <div class="flex-shrink-0">
                                <img class="rounded-full w-11 h-11 bg-whtei" alt="Jese image">
                                <div
                                    class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-blue-600 border border-white rounded-full dark:border-gray-800">
                                    <svg class="w-2 h-2 text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                        <path
                                            d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z" />
                                        <path
                                            d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="w-full ps-3">
                                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">New message from <span
                                        class="font-semibold text-gray-900 dark:text-white">Jese Leos</span>: "Hey,
                                    what's up? All set for the presentation?"</div>
                                <div class="text-xs text-blue-600 dark:text-blue-500">a few moments ago</div>
                            </div>
                        </a>
                    </div>
                    <a href="#"
                        class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                        <div class="inline-flex items-center ">
                            <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                <path
                                    d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                            </svg>
                            View all
                        </div>
                    </a>
                </div>


            </div>

            <div>


                <button class="bg-white px-4 flex items-center py-1 rounded-md" id="adminBtn">
                    <i class='bx bxs-user-circle bx-md mr-2'></i> Admin
                    <i class='bx bx-chevron-down'></i>
                </button>

                <!-- Dropdown Menu -->
                <div id="dropdown"
                    class="border border-black absolute right-0 top-16 hidden bg-white shadow-lg rounded mt-2 w-48">
                    <ul class="flex flex-col m-2">
                        <li>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Options</a>
                        </li>
                        <li>
                            <form action="{{ route('logout.post') }}" method="post">
                                @csrf
                                <button type="submit"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>

                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>
</header>



<script>
    // JavaScript to toggle dropdown visibility
    const adminBtn = document.getElementById('adminBtn');
    const dropdown = document.getElementById('dropdown');
    const notificationButton = document.getElementById('dropdownNotificationButton');
    const notificationDropdown = document.getElementById('dropdownNotificationContent');

    adminBtn.addEventListener('click', () => {
        dropdown.classList.toggle('hidden');
    });

    notificationButton.addEventListener('click', () => {
        notificationDropdown.classList.toggle('hidden');
    });

    // Optional: Close dropdowns if clicked outside
    window.addEventListener('click', (event) => {
        if (!adminBtn.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
        if (!notificationButton.contains(event.target) && !notificationDropdown.contains(event.target)) {
            notificationDropdown.classList.add('hidden');
        }
    });
</script>
