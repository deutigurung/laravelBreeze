<x-app-layout>
    <x-slot name="header">

        <div class="relative py-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight absolute top-0 left-0">
                {{ $user->name }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2>Approved Posts</h2>
                    <table class="table-auto border-collapse border w-full text-justify">
                        <thead>
                        <tr>
                            <th class="border border-slate-400">#</th>
                            <th class="border border-slate-400">Title</th>
                            <th class="border border-slate-400">Summary</th>
                            <th class="border border-slate-400">Status</th>
                            <th class="border border-slate-400">Publish Date</th>
                            <th class="border border-slate-400">Author</th>
                            <th class="border border-slate-400">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->posts()->postStatus(1)->get() as $key=>$post)
                            <tr>
                                <td class="border border-slate-300">{{ $key+1 }}</td>
                                <td class="border border-slate-300">{{ $post->title }}</td>
                                <td class="border border-slate-300">{{ substr($post->description,0,50).'...' }}</td>
                                <td class="border border-slate-300">
                                    <button class="rounded-full {{ ($post->approved == 1 ) ? 'bg-red-500' : 'bg-green-500' }} w-20">
                                        {{ ($post->approved == 1 ) ? 'Approved' : 'Unapproved' }}
                                    </button>
                                </td>
                                <td class="border border-slate-300">{{ $post->publish_date->toFormattedDateString() }}</td>
                                <td class="border border-slate-300">{{ $post->author->name }}</td>
                                <td class="border border-slate-300">
                                    <a href="{{ route('posts.edit',$post->id) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 text-gray-900">
                    <h2>UnApproved Posts</h2>
                    <table class="table-auto border-collapse border w-full text-justify">
                        <thead>
                        <tr>
                            <th class="border border-slate-400">#</th>
                            <th class="border border-slate-400">Title</th>
                            <th class="border border-slate-400">Summary</th>
                            <th class="border border-slate-400">Status</th>
                            <th class="border border-slate-400">Publish Date</th>
                            <th class="border border-slate-400">Author</th>
                            <th class="border border-slate-400">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->posts()->postStatus(0)->get() as $key=>$post)
                            <tr>
                                <td class="border border-slate-300">{{ $key+1 }}</td>
                                <td class="border border-slate-300">{{ $post->title }}</td>
                                <td class="border border-slate-300">{{ substr($post->description,0,50).'...' }}</td>
                                <td class="border border-slate-300">
                                    <button class="rounded-full {{ ($post->approved == 1 ) ? 'bg-red-500' : 'bg-green-500' }} w-20">
                                        {{ ($post->approved == 1 ) ? 'Approved' : 'Unapproved' }}
                                    </button>
                                </td>
                                <td class="border border-slate-300">{{ $post->publish_date->toFormattedDateString() }}</td>
                                <td class="border border-slate-300">{{ $post->author->name }}</td>
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
