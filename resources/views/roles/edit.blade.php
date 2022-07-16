<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>

    @if ($message = session('message'))
        <x-slot name="message">
            {{ $message }}
        </x-slot>
    @endif

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('roles.update', $role) }}">
                @csrf
                @method('PUT')

                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$role->name"
                        required autofocus autocomplete="name" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="password" value="{{ __('Color') }}" />
                    <select id="country" name="color" required autocomplete="country-name"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select Color</option>
                        <option value="0">Green</option>
                        <option value="1">Gray</option>
                    </select>
                </div>

                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Permission name
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permissions as $permission)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    <input type="checkbox" name="permission[{{ $permission->name }}]"
                                        value="{{ $permission->name }}" class='permission'
                                        {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $permission->name }}
                                </td>

                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td colspan="2"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ __('No roles found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="flex mt-4">
                    <x-jet-button>
                        {{ __('Save Role') }}
                    </x-jet-button>
                </div>
        </div>
    </div>

</x-app-layout>
