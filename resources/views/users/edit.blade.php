<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="post" action="{{ route('users.update', $user->id) }}">
            @method('put')
            @csrf
            
            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$user->name}}"
                    required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"  value="{{$user->email}}"
                    required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('ٌRoles') }}" />
                <select class="form-control"
                        name="role" required>
                        <option value="">Select role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ in_array($role->name, $userRole)
                                    ? 'selected'
                                    : '' }}>{{ $role->name }}</option>
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
