<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('users list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    @can('manage users')
                        <x-link href="{{ route('users.create') }}" class="m-4">Add new user</x-link>
                    @endcan
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                user name
                            </th>
                            @can('manage users')
                            <th scope="col" class="px-6 py-3">

                            </th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($users as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $user->name }}
                                </td>
                                @can('manage users')
                                <td class="px-6 py-4">
                                    <x-link href="{{ route('users.edit', $user) }}">Edit</x-link>
                                    <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <x-jet-danger-button
                                            type="submit"
                                            onclick="return confirm('Are you sure?')">Delete</x-jet-danger-button>
                                    </form>
                                </td>
                                    @endcan
                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td colspan="2"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ __('No users found') }}
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
