<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Patien NO: ' . $patient->id . ' Information') }}
        </h2>
    </x-slot>


    @if ($message = session('message'))
        <x-slot name="message">
            {{ $message }}
        </x-slot>
    @endif

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-2">

                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $patient->name }}</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500"><b>Birth Date :</b>
                        {{ $patient->birth_date }}</p>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Full name</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $patient->name }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Phone Number</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $patient->phone }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Gender</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $patient->gender == 0 ? 'male' : 'femail' }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Age</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $patient->age }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Blood Group</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $patient->blood_type }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Diseases

                                <x-link href="{{ route('patients.edit', $patient) }}" class="float-right">

                                    <svg class="w-6 h-6" fill="none" stroke="white" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>

                                </x-link>

                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                    @foreach ($patient->diseases as $data)
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <div class="w-0 flex-1 flex items-center">
                                                <!-- Heroicon name: solid/paper-clip -->
                                                <svg class="w-6 h-6" fill="none" stroke="gray" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                <span class="ml-2 flex-1 w-0 truncate">
                                                    {{ $data->name }}
                                                </span>
                                                <span class="ml-2 flex-1 w-0 truncate">
                                                    {{ $data->treatment }}
                                                </span>
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <a href="{{ route('pfile.show', $data) }}" target="_plank"
                                                    x-on:click="$wire.startConfirmingPassword('ab2d1de5297198533ed96f794eb99eac')"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500"
                                                    {{-- onclick="return confirm('{{ $data->name . '\n' . $data->name }}')" --}}>
                                                    Details
                                                </a>
                                            </div>

                                        </li>
                                    @endforeach
                                </ul>

                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Allergies</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <div class="stats shadow w-full">

                                    @foreach (explode(',', $patient->allergies) as $data)
                                        <div class="stat">
                                            <span
                                                class="px-4 py-2 rounded-full text-black-500 bg-gray-200 font-semibold text-sm flex align-center w-max cursor-pointer active:bg-gray-300 transition duration-300 ease">
                                                {{ $data }}
                                            </span>

                                        </div>
                                    @endforeach
                                </div>
                            </dd>
                        </div>

                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Attachments
                                <x-link href="{{ route('pfile.create', ['p' => $patient->id]) }}" class="float-right">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </x-link>
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 divide-y divide-gray-200">
                                @if (isset($patient->file['doc']))
                                    <h1>Documents</h1>
                                    <ul role="list"
                                        class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                        @foreach ($patient->file['doc'] as $file)
                                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                                <div class="w-0 flex-1 flex items-center">
                                                    <!-- Heroicon name: solid/paper-clip -->
                                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="ml-2 flex-1 w-0 truncate">
                                                        {{ $file->name }}
                                                    </span>
                                                    <span class="ml-2 flex-1 w-0 truncate">
                                                        {{ $file->create_at }}
                                                    </span>
                                                </div>
                                                <div class="ml-4 flex-shrink-0">
                                                    <p class="font-small text-gray-600 hover:text-indigo-500">
                                                        {{ $file->readableSize }}
                                                    </p>
                                                </div>
                                                <div class="ml-4 flex-shrink-0">
                                                    <label for="my-modal-4" class="btn modal-button">Details</label>
                                                </div>
                                                <div class="ml-4 flex-shrink-0">
                                                    <a href="{{ $file->fileUrl }}" target="_plank"
                                                        class="font-medium text-indigo-600 hover:text-indigo-500">
                                                        Download
                                                    </a>
                                                </div>
                                                <div class="ml-4 flex-shrink-0">
                                                    <form action="{{ route('pfile.destroy', $file->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit"
                                                            onclick="return confirm('are you sure ??')"
                                                            class="font-medium text-indigo-600 hover:text-indigo-500">
                                                            Delete
                                                        </button>
                                                </div>
                                            </li>

                                            <!-- Put this part before </body> tag -->
                                            <input type="checkbox" id="my-modal-4" class="modal-toggle" />
                                            <label for="my-modal-4" class="modal cursor-pointer">
                                                <label class="modal-box relative" for="">
                                                    <h3 class="text-lg font-bold">{{ $file->name }}</h3>
                                                    <ul class="py-4">
                                                        <li>
                                                            <a
                                                                class="animate-spin font-small text-indigo-600 hover:text-indigo-500">
                                                                Name =
                                                            </a>
                                                            <a class="font-small text-gray-600 hover:text-indigo-500">

                                                                {{ $file->name }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                class="font-small text-indigo-600 hover:text-indigo-500">
                                                                Size =
                                                            </a>
                                                            <a class="font-small text-gray-600 hover:text-indigo-500">

                                                                {{ $file->readableSize }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                class="font-small text-indigo-600 hover:text-indigo-500">
                                                                Type =
                                                            </a>
                                                            <a class="font-small text-gray-600 hover:text-indigo-500">

                                                                {{ $file->type }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                class="font-small text-indigo-600 hover:text-indigo-500">
                                                                Extension =
                                                            </a>
                                                            <a class="font-small text-gray-600 hover:text-indigo-500">
                                                                .
                                                                {{ $file->extention }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                class="font-small text-indigo-600 hover:text-indigo-500">
                                                                Create-At =
                                                            </a>
                                                            <a class="font-small text-gray-600 hover:text-indigo-500">

                                                                {{ $file->created_at }}
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </label>
                                            </label>
                                        @endforeach
                                    </ul>
                                @endif

                                @if (isset($patient->file['image']))
                                    <h1 style="py- divide-y divide-gray-200">Images</h1>
                                    <div class="container grid grid-cols-3 gap-2 mx-auto">
                                        @foreach ($patient->file['image'] as $file)
                                            <div class="py-5 w-full rounded">
                                                <a href="{{ $file->fileUrl }}" target="_plank">
                                                    <img src="{{ $file->fileUrl }}" alt="image">
                                                </a>
                                            </div>
                                        @endforeach

                                    </div>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
