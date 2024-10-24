<div id="file-summary" class="">
    <div class="flex justify-between items-center mb-2">
        <h2 class="text-lg font-bold">File Summary</h2> {{-- add summary --}}
        <button type="button" id="close-summary-btn"
            class="text-red-500 hover:text-red-700 focus:outline-none hover:cursor-pointer">
            <i class='bx bx-x bx-md'></i>
        </button>
    </div>

    <div class="flex space-x-4">
        <div class="flex-1">
            <div>
                <label for="view-office_source" class="block mb-2 text-sm font-medium text-gray-700">Office
                    Source</label>
                <input type="text" id="view-office_source" name="office_source"
                    class="bg-gray-50 border border-gray-500 text-gray-900 placeholder-gray-700 text-sm rounded-lg 
                        block w-full p-2.5 
                       "
                    placeholder="Enter office Source" disabled>

                <p class="mt-2 text-sm text-red-600 h-6 invisible"><span class="font-medium">Please!</span> Enter
                    valid input!</p>
            </div>
            <!-- Category Field -->
            <div>
                <label for="view-category" class="block mb-2 text-sm font-medium text-gray-700">Category</label>
                <select id="view-category" name="category"
                    class="bg-gray-50 border border-gray-500 text-gray-900 text-sm rounded-lg valid:ring-green-500 valid:border-green-500 block w-full p-2.5 required:border-red-500 required:ring-red-500 required:text-red-500 valid:text-gray-900 "
                    disabled>
                    <option value="">Select a Category</option>
                    <option value="incoming">Incoming</option>
                    <option value="outgoing">Outgoing</option>
                    <!-- Add more categories as needed -->
                </select>
                <p class="mt-2 text-sm text-red-600 h-6 invisible"><span class="font-medium">Please!</span> Enter
                    valid
                    input!
                </p>
            </div>

            <!-- Classification Field -->
            <div>
                <label for="view-classification"
                    class="block mb-2 text-sm font-medium text-gray-700">Classification</label>
                <select id="view-classification" name="classification"
                    class="bg-gray-50 border border-gray-500 text-gray-900 text-sm rounded-lg valid:ring-green-500 valid:border-green-500 block w-full p-2.5 required:border-red-500 required:ring-red-500 required:text-red-500 valid:text-gray-900 "
                    disabled>
                    <option value="">Select Classification</option> <!-- Default empty option -->
                    <option value="high-technical">High Technical</option>
                    <option value="simple">Simple</option>
                </select>
                <p class="mt-2 text-sm text-red-600 h-6 invisible"><span class="font-medium">Please!</span> Select a
                    valid classification.</p>
            </div>

            <!-- Status Field -->
            <div>
                <label for="view-status" class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                <select id="view-status" name="status"
                    class="bg-gray-50 border border-gray-500 text-gray-900 text-sm rounded-lg valid:ring-green-500 valid:border-green-500 block w-full p-2.5 required:border-red-500 required:ring-red-500 required:text-red-500 valid:text-gray-900 "
                    disabled>
                    <option value="">Select Status</option> <!-- Default empty option -->
                    <option value="received">Received</option>
                    <option value="outgoing">Outgoing</option>
                </select>
                <p class="mt-2 text-sm text-red-600 h-6 invisible"><span class="font-medium">Please!</span> Select a
                    valid status.</p>
            </div>

        </div>

    </div>



</div>
