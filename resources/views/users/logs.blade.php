<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events By ' . $id) }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-4" scope="col">#</th>
                            <th class="px-4 py-4">Event</th>
                            <th class="px-4 py-3">Roles</th>
                            <th class="px-4 py-3 float-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                        @forelse ($logs as $log)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-xs">
                                    {{ $log->id }}
                                </td>
                                <td class="px-11 py-2">
                                    <div class="flex items-center text-md">
                                        <!-- Avatar with inset shadow -->
                                        <div>
                                            <p class="font-semibold">
                                                {{ $log->description }}
                                            </p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                {{ $log->created_at }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-xs">
                                    @if ($log->event)
                                        @switch($log->event)
                                            @case('created')
                                                {{-- <span
                                                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                    created
                                                </span> --}}
                                                <div class="badge badge-primary badge-outline">created</div>

                                            @break

                                            @case('deleted')
                                                {{-- <span
                                                    class="px-2 py-1 font-semibold leading-tight text-white-700 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-green-100">

                                                </span> --}}
                                                <div class="badge badge-secondary badge-outline">deleted</div>

                                            @break

                                            @case('searching')
                                                {{-- <span
                                                    class="px-2 py-1 font-semibold leading-tight text-white-700 bg-blue-700 rounded-full dark:bg-pink-700 dark:text-green-100">
                                                    search
                                                </span> --}}
                                                <div class="badge">search</div>

                                            @break

                                            @default
                                                {{ '' }}
                                        @endswitch
                                    @endif
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
                        Showing
                        {{ $i }}-{{ $i + $logs->perPage() - 1 > $logs->total() ? $logs->total() : $i + $logs->perPage() - 1 }}
                        of {{ $logs->total() }}
                    </span>
                    <span class="col-span-2"></span>
                    <!-- Pagination -->
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                        <nav aria-label="Table navigation">
                            <ul class="inline-flex items-center">
                                <li>
                                    <a href="{{ $logs->previousPageUrl() }}">

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
                                @foreach ($logs->links() as $link)
                                    <li>
                                        <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                            {{ $link->url() }}
                                        </button>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{ $logs->nextPageUrl() }}">
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
