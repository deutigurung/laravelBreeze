<x-app-layout>
    <x-slot name="header">

        <div class="relative py-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight absolute top-0 left-0">
                {{ __('Users') }}
            </h2>
            <a class="h-7 w-32 absolute top-0 right-0" href="{{ route('users.create') }}">
                <h4 class="font-semibold text-xl text-center pr-3 text-gray-800 leading-tight rounded-full bg-green-500">
                    <i class="fa-light fa-plus px-1"></i>{{ __('Add User') }}
                </h4>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto border-collapse border w-full text-justify">
                        <thead>
                        <tr>
                            <th class="border border-slate-400">Id</th>
                            <th class="border border-slate-400">Name</th>
                            <th class="border border-slate-400">Email</th>
                            <th class="border border-slate-400">IsAdmin</th>
                            <th class="border border-slate-400">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="border border-slate-300">{{ $user->id }}</td>
                                    <td class="border border-slate-300">{{ $user->name }}</td>
                                    <td class="border border-slate-300">{{ $user->email }}</td>
                                    <td class="border border-slate-300">
                                        <button class="rounded-full {{ ($user->is_admin == 1 ) ? 'bg-red-500' : 'bg-green-500' }} w-20">
                                           {{ ($user->is_admin == 1 ) ? 'Yes' : 'No' }}
                                        </button>
                                    </td>
                                    <td class="border border-slate-300">
                                        <a href="{{ route('users.edit',$user->id) }}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
