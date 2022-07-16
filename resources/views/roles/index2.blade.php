<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('roles') }}
            @can('manage roles')
                <x-link href="{{ route('roles.create') }}" class="float-right">Add new Role</x-link>
            @endcan
        </h2>
    </x-slot>

    @if ($message = session('message'))
        <x-slot name="message">
            {{ $message }}
        </x-slot>
    @endif
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3"colspan="11">Name</th>
                            <th class="px-4 py-3 float-right" colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                        @forelse ($roles as $task)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-xs">
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                        {{ $task->id }}
                                    </span>
                                </td>
                                <td class="px-11 py-3" colspan="11">
                                    <div class="flex items-center text-md">
                                        <!-- Avatar with inset shadow -->
                                        <div>
                                            <p class="font-semibold">
                                                {{ $task->name }}
                                            </p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                {{ $task->created_at }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm float-right">
                                        <x-link href="{{ route('roles.show', $task) }}">
                                            <button
                                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                aria-label="Show">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="white"
                                                    viewBox="0 0 20 20">
                                                    <svg class="w-6 h-6" fill="white" stroke="white"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                                    </svg>
                                                </svg>
                                            </button>
                                        </x-link>

                                        <x-link href="{{ route('roles.edit', $task) }}">
                                            <button
                                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                aria-label="Edit">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="white"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </x-link>

                                        <form method="POST" action="{{ route('roles.destroy', $task) }}"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <x-jet-danger-button type="submit"
                                                onclick="return confirm('Are you sure?')">
                                                <a
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="white"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>

                                                    </svg>
                                                </a>
                                            </x-jet-danger-button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td class="px-4 py-3 text-xs">
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                    No Data Available
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                    Showing {{ $i }}-30 of {{ $roles->total() }}

                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    <nav aria-label="Table navigation">
                        <ul class="inline-flex items-center">
                            <li>
                                <a href="{{ $roles->previousPageUrl() }}">

                                    <button
                                        class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                        aria-label="Previous">
                                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                            <path
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </a>
                            </li>
                            @foreach ($roles->links() as $link)
                                <li>
                                    <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                        {{ $link->label() }}
                                    </button>
                                </li>
                            @endforeach
                            <li>
                                <a href="{{ $roles->nextPageUrl() }}">
                                    <button
                                        class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                                        aria-label="Next">
                                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                            <path
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" fill-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </span>
            </div>
        </div>

    </div>

</x-app-layout>
