<x-app-layout>
    <x-slot name="header">

        <div class="relative py-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight absolute top-0 left-0">
                {{ __('Edit Post') }}
            </h2>
            <a class="h-7 w-32 absolute top-0 right-0" href="{{ route('posts.index') }}">
                <h4 class="font-semibold text-xl text-center pr-3 text-gray-800 leading-tight rounded-full bg-green-500">
                    <i class="fa-light fa-list px-1"></i>{{ __('All Posts') }}
                </h4>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('posts.update',$post->id) }}" method="post" class="form">
                        @csrf
                        @method('put')
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title',$post->title)" required autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description',$post->description)" autofocus autocomplete="description" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                        <div>
                            <x-input-label for="publish_date" :value="__('Publish Date')" />
                            <x-text-input id="publish_date" name="publish_date" type="text" class="mt-1 block w-full" :value="old('publish_date',$post->publish_date)" autofocus autocomplete="publish_date" />
                            <x-input-error class="mt-2" :messages="$errors->get('publish_date')" />
                        </div>
                        <div>
                            <x-input-label for="image" :value="__('Image')" />
                            <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" :value="old('image')" autofocus autocomplete="image" />
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>
                        <div>
                            <x-input-label for="approved" :value="__('Status')" />
                            <select name="approved" id="approved" class="mt-1 block w-full">
                                <option disabled selected>Please Select One</option>
                                <option value="1" @selected($post->approved == 1)>Approved</option>
                                <option value="0" @selected($post->approved == 0)>Unapproved</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('approved')" />
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
