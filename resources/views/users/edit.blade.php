<x-app-layout>
    <x-slot name="header">

        <div class="relative py-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight absolute top-0 left-0">
                {{ __('Edit User') }}
            </h2>
            <a class="h-7 w-32 absolute top-0 right-0" href="{{ route('users.index') }}">
                <h4 class="font-semibold text-xl text-center pr-3 text-gray-800 leading-tight rounded-full bg-green-500">
                    <i class="fa-light fa-list px-1"></i>{{ __('All Users') }}
                </h4>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.update',$user->id) }}" method="post" class="form">
                        @csrf
                        @method('put')
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name',$user->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email',$user->email)" required autocomplete="email" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <div>
                            <x-input-label for="is_admin" :value="__('Role')" />
                            <select name="is_admin" id="is_admin" class="mt-1 block w-full">
                                <option disabled selected>Please Select One</option>
                                <option value="0" @if($user->is_admin == 0) selected @endif>User</option>
                                <option value="1" @if($user->is_admin == 1) selected @endif>Admin</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('is_admin')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
