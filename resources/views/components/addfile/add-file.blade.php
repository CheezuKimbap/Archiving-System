<div id="add-folder-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between border-b p-4 md:p-5 rounded-t">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Add New Folder
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="add-folder-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4">
                <form id="add-folder-form" class="space-y-4">
                    @csrf
                    <div>
                        <label for="folder_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            Folder Name</label>
                        <input type="text" name="folder_name" id="folder_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="New Folder" required />
                    </div>

                    <div>
                        <label for="existing_folder"
                            class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">-- optional --</label>
                        <select id="existing_folder" name="existing_folder"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            <option value="">-- Select Existing Folder --</option>
                        </select>
                    </div>


                    <div>
                        <input type="hidden" name="folder_type" id="folder_type">
                        <input type="hidden" name="folder_municipality" id="folder_municipality">
                    </div>

                    <button type="submit"
                        class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Create
                        Folder</button>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('add-folder-form').addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = new FormData(this);


        const csrfToken = "{{ csrf_token() }}"; // Assuming you are using Blade for CSRF

        try {
            const response = await fetch('/api/folders/add', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            });

            const data = await response.json();

            if (data.success) {

                console.log('Created Folder:', data.folder); // Log the folder details
            } else {

                console.error(data.error); // Log the error message
            }
        } catch (error) {
            console.error('Form submission error:', error);

        }
    });



    // function fetchFolders(folderType) {
    //     fetch(`/api/folders?folderType=${folderType}`) // Assuming you have a route to fetch the list of folders
    //         .then(response => response.json())
    //         .then(data => {
    //             if (data.success) {
    //                 const folderSelect = document.getElementById('existing_folder');
    //                 // Clear previous options
    //                 folderSelect.innerHTML = '<option value="">-- Select Existing Folder --</option>';

    //                 // Populate dropdown with fetched folders
    //                 data.folders.forEach(folder => {
    //                     const option = document.createElement('option');
    //                     option.value = folder
    //                         .folder_path; // Assuming 'folder' is the folder path or identifier
    //                     option.textContent = folder.folder_path; // Display folder name
    //                     folderSelect.appendChild(option);
    //                 });
    //             } else {

    //             }
    //         })
    //         .catch(error => console.error('Error fetching folders:', error));
    // }

    // Listen for when the modal is shown
    document.getElementById('add-folder-btn').addEventListener('click', function() {
        // Fetch folders when the modal is shown
        const folderType = type || report;
        fetch(`/api/folders?folderType=${type}&municipality=${municipality}`)
            .then(response => response.json())
            .then(data => {
                //renderFolders(data.folders); // Pass the folders array to the render function
            })
            .catch(error => console.error('Error fetching folders:', error));

        console.log(folderType)
        const fieldFolderType = document.getElementById('folder_type');
        const fieldMunicipality = document.getElementById('folder_municipality');


        fieldFolderType.value = folderType;
        fieldMunicipality.value = municipality;


    });
</script>
