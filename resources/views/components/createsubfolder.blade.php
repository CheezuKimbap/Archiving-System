<div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
</div><!-- The whole future lies in uncertainty: live immediately. - Seneca -->



<div id="folders-container" class=" flex gap-4 mb-4">
    <!--populate the folder-->
</div>

<template class="folder-template">
    <div class="folder-content w-full max-w-xs bg-white border border-gray-300 rounded-md">
        <div class="flex items-center justify-between px-4 py-3">
            <!-- Content Section -->
            <div class="flex items-center space-x-3">
                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-10 h-10 text-slate-600">
                    <path
                        d="M19.5 21a3 3 0 0 0 3-3v-4.5a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3V18a3 3 0 0 0 3 3h15ZM1.5 10.146V6a3 3 0 0 1 3-3h5.379a2.25 2.25 0 0 1 1.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 0 1 3 3v1.146A4.483 4.483 0 0 0 19.5 9h-15a4.483 4.483 0 0 0-3 1.146Z" />
                </svg>

                <!-- Text Content -->
                <div class="flex flex-col">
                    <h5 class="folder-title text-sm font-medium text-gray-900">Folder Title</h5>
                    <span class="folder-text text-xs text-gray-500">Folder Description</span>
                </div>
            </div>

            <!-- Dropdown Button -->
            <div class="relative">
                <button id="folder-dropdown-btn" data-dropdown-toggle="folder-dropdown"
                    class="folder-dropdown-btn inline-block text-gray-500 hover:bg-gray-100  focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg text-sm p-1.5"
                    type="button">
                    <span class="sr-only">Open dropdown</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 16 3">
                        <path
                            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="folder-dropdown"
                    class="folder-dropdown hidden z-10 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2" aria-labelledby="dropdownButton">
                        <li>
                            <a id="open-folder-id"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Open</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit
                                Data</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Delete</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</template>





<script>
    // Function to clone the template and update it with folder data
    function cloneFolderTemplate(data) {
        const template = document.querySelector('.folder-template');
        const clone = template.content.cloneNode(true);

        // Populate folder title and description
        clone.querySelector('.folder-title').textContent = data.folder_name || 'Folder Title';
        clone.querySelector('.folder-text').textContent = data.folder_type || 'Folder Description';

        // Update dropdown button and menu IDs for uniqueness
        const dropdownMenu = clone.querySelector('.folder-dropdown');
        const dropdownButton = clone.querySelector('.folder-dropdown-btn');
        const openFolderButton = clone.querySelector('#open-folder-id');
        dropdownMenu.id = `folder-dropdown-${data.id}`;
        dropdownButton.setAttribute('data-dropdown-toggle', `folder-dropdown-${data.id}`);
        dropdownButton.setAttribute('data-folder-id', data.id);

        const _type = {!! json_encode($type ?? '') !!};
        const _municipality = {!! json_encode($municipality ?? '') !!};


        const folderUrl =
            `{{ url('/file-manager/repository/folder') }}/${data.id}?type=${_type}&municipality=${_municipality}&folderId=${data.id}`;
        openFolderButton.setAttribute('href', folderUrl)

        return clone;
    }

    // Function to initialize dropdowns for all folders using Flowbite
    function initializedFolderDropdown() {
        const dropdownButtons = document.querySelectorAll('.folder-dropdown-btn');
        dropdownButtons.forEach(button => {
            const dropdownId = button.getAttribute('data-dropdown-toggle');
            const dropdownMenu = document.getElementById(dropdownId);

            if (dropdownMenu) {
                new Dropdown(dropdownMenu, button, {
                    placement: 'bottom',
                    triggerType: 'click',
                    offsetSkidding: 0,
                    offsetDistance: 0,
                });
            }
        });
    }

    // Function to render folders in the DOM
    function renderFolders(folders) {
        const container = document.querySelector('#folders-container');
        container.innerHTML = '';
        folders.forEach(folder => {
            const folderElement = cloneFolderTemplate(folder);
            container.appendChild(folderElement);
        });
        initializedFolderDropdown(); // Initialize dropdowns after rendering
    }

    // Fetch folders from the server and render them
    document.addEventListener('DOMContentLoaded', () => {
        const type = {!! json_encode($type ?? '') !!};
        const municipality = {!! json_encode($municipality ?? '') !!};
        const folderId = {!! json_encode($folderId ?? '') !!}

        console.log(folderId);

        fetch(`/api/folders?folderType=${type}&municipality=${municipality}&folderId=${folderId}`)
            .then(response => response.json())
            .then(data => {
                renderFolders(data.folders); // Pass the folders array to the render function
            })
            .catch(error => console.error('Error fetching folders:', error));
    });
</script>
