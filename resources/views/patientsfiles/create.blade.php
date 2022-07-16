<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new PDF File to Patient : ' . $patient->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-jet-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('pfile.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" autofocus autocomplete="name" />
                            <x-jet-input id="name" class="block mt-1 w-full" type="hidden" name="patient_id"
                                value="{{ $_GET['p'] }}" autofocus autocomplete="name" />
                        </div>

                        <div>
                            <x-jet-label for="name" value="{{ __('Check Date') }}" />
                            <x-jet-input id="name" class="block mt-1 w-full" type="date" name="check_date"
                                :value="old('check_date')" autofocus autocomplete="name" />
                        </div>

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                            for="user_avatar">Upload PDF file</label>
                        <input name="file"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="user_avatar_help" id="user_avatar" type="file">

                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">
                            upload file</div>

                        <div class="flex mt-4">
                            <x-jet-button>
                                {{ __('Save PDF file') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
