<!-- Breadcrumb -->
@if (!Route::is('admin.home.show') && !Route::is('show.setting') && !Route::is('file-manager.folder.show'))
    <nav class="w-max flex py-2 text-gray-700 rounded-lg" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 rtl:space-x-reverse">

            <!-- Check if $type is set and not null/false -->
            <li class="inline-flex items-center">
                <a href="{{ url()->to(request()->segment(1)) }}"
                    class="{{ Route::is('file-manager.show') || Route::is('administrative.show') || Route::is('archived-file.show') ? 'text-blue-600 inline-flex items-center text-sm font-medium hover:text-blue-600 ' : ' inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z"
                            clip-rule="evenodd" />
                        <path
                            d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                    </svg>

                    {{ ucwords(str_replace('-', ' ', request()->segment(1))) }}
                </a>
            </li>




            @if ($type && $archivedType == null)
                @if ($type == 'land-titles')
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ route('file-manager.land-title.show', ['type' => $type, 'category' => $category ?? null]) }}"
                                class="{{ Route::is('file-manager.land-title.show') ? 'text-blue-600 inline-flex items-center text-sm font-medium hover:text-blue-600 ms-2' : 'ms-2 inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-700' }}
                            {{ !$type && !Route::is('file-manager.municipality.show') ? 'pointer-events-none cursor-not-allowed' : 'text-blue-600' }}">
                                {{ ucwords(str_replace('-', ' ', $type)) }}
                            </a>
                        </div>
                    </li>
                    @if ($category)
                        <li>
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <a href="{{ route('file-manager.municipality.show', ['type' => $type, 'category' => $category]) }}"
                                    class="{{ Route::is('file-manager.municipality.show') ? 'text-blue-600 inline-flex items-center text-sm font-medium hover:text-blue-600 ms-2' : 'ms-2 inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-700' }}"
                                    {{ Route::is('file-manager.municipality.show') ? 'pointer-events-none cursor-not-allowed' : 'text-blue-600' }}">
                                    {{ ucwords(str_replace('-', ' ', $category ?: 'Category')) }}
                                </a>
                            </div>
                        </li>
                    @endif
                @else
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ route('file-manager.municipality.show', ['type' => $type, 'category' => $category ?? null]) }}"
                                class="{{ Route::is('file-manager.municipality.show') ? 'text-blue-600 inline-flex items-center text-sm font-medium hover:text-blue-600 ms-2' : 'ms-2 inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-700' }}
                            {{ !$type && !Route::is('file-manager.municipality.show') ? 'pointer-events-none cursor-not-allowed' : 'text-blue-600' }}">
                                {{ ucwords(str_replace('-', ' ', $type)) }}
                            </a>
                        </div>
                    </li>
                @endif
                @if ($municipality)
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ $municipality }}"
                                class="{{ Route::is('file-manager.table.show') || Route::is('file-manager.table.with-category.show') ? 'text-blue-600 inline-flex items-center text-sm font-medium hover:text-blue-600 ms-2' : 'ms-2 inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-700' }}
                            pointer-events-none cursor-not-allowed">
                                {{ ucwords(str_replace('-', ' ', $municipality)) }}
                            </a>
                        </div>
                    </li>
                @endif

            @endif


            @if ($archivedType)

                @if ($archivedType == 'File Manager')
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ route('archived-file.file-manager.show') }}"
                                class="{{ Route::is('archived-file.file-manager.show', $archivedType) || Route::is('archived-file.administrative.show') ? 'text-blue-600 inline-flex items-center text-sm font-medium hover:text-blue-600 ms-2' : 'ms-2 inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-700' }}
                            {{ Route::is('archived-file.file-manager.show') ? 'pointer-events-none cursor-not-allowed' : 'text-blue-600' }}">
                                {{ ucwords(str_replace('-', ' ', $archivedType)) }}
                            </a>
                        </div>
                    </li>
                @elseif ($archivedType == 'Administrative Document')
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ route('archived-file.administrative.show') }}"
                                class="{{ Route::is('archived-file.administrative.show', $archivedType) || Route::is('archived-file.administrative.show') ? 'text-blue-600 inline-flex items-center text-sm font-medium hover:text-blue-600 ms-2' : 'ms-2 inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-700' }}
                            {{ Route::is('archived-file.administrative.show') ? 'pointer-events-none cursor-not-allowed' : 'text-blue-600' }}">
                                {{ ucwords(str_replace('-', ' ', $archivedType)) }}
                            </a>
                        </div>
                    </li>
                @endif

                @if ($type)
                    @if ($type == 'land-titles')
                        <li>
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <a href="{{ route('archived-file.file-manager.land-title.show', [$archivedType, $type]) }}"
                                    class="{{ Route::is('archived-file.file-manager.land-title.show') ? 'text-blue-600 inline-flex items-center text-sm font-medium hover:text-blue-600 ms-2' : 'ms-2 inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-700' }}
                            {{ Route::is('archived-file.file-manager.land-title.show') ? 'pointer-events-none cursor-not-allowed' : 'text-blue-600' }}">
                                    {{ ucwords(str_replace('-', ' ', $type)) }}
                                </a>
                            </div>
                        </li>
                        @if ($category)
                            <li>
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <a href="{{ route('archived-file.file-manager.municipality.with-category.show', ['archivedType' => $archivedType, 'type' => $type, 'category' => $category]) }}"
                                        class="{{ Route::is('archived-file.file-manager.municipality.with-category.show') ? 'text-blue-600 inline-flex items-center text-sm font-medium hover:text-blue-600 ms-2' : 'ms-2 inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-700' }}"
                                        {{ Route::is('archived-file.file-manager.municipality.with-category.show') ? 'pointer-events-none cursor-not-allowed' : 'text-blue-600' }}">
                                        {{ ucwords(str_replace('-', ' ', $category ?: 'Category')) }}
                                    </a>
                                </div>
                            </li>
                        @endif
                    @else
                        <li>
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>

                                <a href="{{ route('archived-file.file-manager.municipality.show', ['type' => $type]) }}"
                                    class="{{ Route::is('archived-file.file-manager.municipality.show') ? 'text-blue-600 inline-flex items-center text-sm font-medium hover:text-blue-600 ms-2' : 'ms-2 inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-700' }}
                            {{ Route::is('archived-file.file-manager.municipality.show') ? 'pointer-events-none cursor-not-allowed' : 'text-blue-600' }}">
                                    {{ ucwords(str_replace('-', ' ', $type)) }}
                                </a>
                            </div>
                        </li>
                    @endif
                    @if ($municipality && $record == null)
                        <li>
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <a href=""
                                    class="{{ Route::is('archived-file.file-manager.table.show') ? 'text-blue-600 inline-flex items-center text-sm font-medium hover:text-blue-600 ms-2' : 'ms-2 inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-700' }}
                            pointer-events-none cursor-not-allowed">
                                    {{ ucwords(str_replace('-', ' ', $municipality)) }}
                                </a>
                            </div>
                        </li>
                    @endif
                @endif
            @endif

            @if ($record && $type == null)
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ $record }}"
                            class="{{ Route::is('administrative.record.show') || Route::is('archived-file.administrative.record.show') ? 'text-blue-600 inline-flex items-center text-sm font-medium hover:text-blue-600 ms-2' : 'ms-2 inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-700' }}
                            pointer-events-none cursor-not-allowed">
                            {{ ucwords(str_replace('-', ' ', $record)) }}
                        </a>
                    </div>
                </li>
            @endif

        </ol>
    </nav>
@endif
