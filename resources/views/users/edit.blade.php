<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <button
                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                <img class="h-10 w-10 rounded-full object-cover"
                    src="{{$user->profile_photo_url}}"
                    alt="Dr. Vincenza Morissette DDS">
            </button>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="post" action="{{ route('users.update', $user->id) }}">
            @method('put')
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                    value="{{ $user->name }}" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                    value="{{ $user->email }}" required />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-jet-label for="password" value="{{ __('ٌRoles') }}" />
                <select id="country" name="role" required autocomplete="country-name"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Select role</option>

                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ in_array($role->name, $userRole) ? 'selected' : '' }}>
                            {{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <!--x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                </div-->

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('users.index') }}">
                        {{ __('back') }}
                    </a>

                    <x-jet-button class="ml-4">
                        {{ __('Update User') }}
                    </x-jet-button>
                </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
