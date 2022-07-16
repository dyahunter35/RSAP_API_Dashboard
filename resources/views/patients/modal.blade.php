<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Patient') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- The button to open modal -->
            <label for="my-modal-6" class="btn modal-button">open modal</label>

            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="my-modal-6" class="modal-toggle" />
            <div class="modal modal-bottom sm:modal-middle">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Congratulations random Internet user!</h3>
                    <p class="py-4">You've been selected for a chance to get one year of subscription to use Wikipedia
                        for free!</p>
                    <div class="modal-action">
                        <label for="my-modal-6" class="btn">Yay!</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
