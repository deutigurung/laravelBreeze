<x-app-layout>
    <x-slot name="header">

        <div class="relative py-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight absolute top-0 left-0">
                {{ $post->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2>Comment</h2>
                    <table class="table-auto border-collapse border w-full text-justify">
                        <thead>
                        <tr>
                            <th class="border border-slate-400">#</th>
                            <th class="border border-slate-400">Name</th>
                            <th class="border border-slate-400">Comment</th>
                            <th class="border border-slate-400">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($post->comments as $key=>$post)
                            <tr>
                                <td class="border border-slate-300">{{ $key+1 }}</td>
                                <td class="border border-slate-300">{{ $post->name }}</td>
                                <td class="border border-slate-300">{{ $post->content }}</td>
                                <td class="border border-slate-300">
                                    <a href="{{ route('posts.edit',$post->id) }}">Edit</a>
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

