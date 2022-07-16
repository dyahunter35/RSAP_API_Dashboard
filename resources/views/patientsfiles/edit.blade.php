<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Patient : ') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('patients.update', $patient) }}">
                @csrf
                @method('PUT')

                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$patient->name"
                        required autofocus autocomplete="name" />
                </div>

                <div class="flex mt-4">
                    <x-jet-button>
                        {{ __('Save Patients') }}
                    </x-jet-button>
                </div>
        </div>
    </div>

</x-app-layout>
