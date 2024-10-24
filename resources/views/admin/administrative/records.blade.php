@extends('layouts.admin.master')

@section('title', 'PENRO Archiving System')

@section('content')


    <div class="bg-slate-300  rounded-md text-black p-4 ">
        <div>
            <nav aria-label="Breadcrumb">
                <ol class="flex space-x-2 text-sm text-gray-600">
                    <li><a href="{{ route('file-manager.show') }}"><span class="">Administrative Reports </span></a>
                    </li>
                    <li><span class="text-gray-400"> &gt; </span></li>
                    <li><a class="font-bold">{{ $record }}</a></li>
                </ol>
            </nav>

            <div class="my-4 space-x-3">
                <button class="bg-white px-2 p-1 rounded-md" id="uploadBtn">Upload File</button>
                <button class="bg-white px-2 p-1 rounded-md">Create a Folder</button>
            </div>


            <x-modal.file-modal />
            <div class="grid">
                <div id="mainTable" class="transition-opacity duration-500 ease-in-out opacity-100">
                    <x-forms.table />
                </div>

                <div id="fileSection" class="transition-opacity duration-500 ease-in-out opacity-0 hidden">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="overflow-auto  rounded-lg bg-white p-5">
                            <table id="minimizeTable" class="">
                                <tbody>
                                    <!-- Minimize table content goes here -->
                                </tbody>
                            </table>
                        </div>

                        <div class=" p-4 col-span-2 bg-white rounded-md ">

                            {{-- this for upload --}}
                            @include('admin.administrative.component.upload-file', [
                                'record' => $record,
                            ])
                            {{-- this for file edit --}}
                            @include('admin.administrative.component.edit-file')
                            @include('admin.administrative.component.file-summary')
                            <div id="toast"
                                class="hidden fixed z-[90] right-0 bottom-0 m-8 bg-red-500 text-white p-4 rounded-lg shadow-lg transition-opacity duration-300 ">
                                <div class="flex justify-between items-center">
                                    <p id="toast-message" class="mr-4"></p>
                                    <button id="toast-close" class="text-white focus:outline-none hover:text-gray-200">
                                        <i class='bx bx-x bx-md'></i>
                                    </button>
                                </div>
                                <div id="toast-timer" class="w-full h-1 bg-green-300 mt-2"></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const record = {!! json_encode($record) !!};
    </script>
    <script src="{{ asset('js/administrative.js') }}"></script>

    <script src="{{ asset('js/file-modal.js') }}"></script>
@endsection
