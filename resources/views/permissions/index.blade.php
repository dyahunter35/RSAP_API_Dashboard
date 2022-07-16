<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions list') }}
            @can('manage permissions2')
                <x-link href="{{ route('permissions.create') }}" class="m-4 space-x-4">Add new permissions</x-link>
            @endcan
        </h2>

    </x-slot>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Permission name
                        </th>
                        @can('manage permissions2')
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $permission->id }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $permission->name }}
                            </td>
                            @can('manage permissions2')
                                <td class="px-6 py-4">
                                    <x-link href="{{ route('permissions.edit', $permission) }}">Edit</x-link>
                                    <form method="POST" action="{{ route('tasks.destroy', $permission) }}"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <x-jet-danger-button type="submit" onclick="return confirm('Are you sure?')">Delete
                                        </x-jet-danger-button>
                                    </form>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td colspan="2"
                                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ __('No tasks found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
