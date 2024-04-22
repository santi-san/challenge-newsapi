<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NewsApi</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="h-full">
        <main class="font-sans text-gray-900  antialiased bg-gray-200 min-h-full">
            <div class="max-w-screen-xxl px-4 mx-auto my-auto sm:px-6 lg:px-8 pt-8">
                <div class="block text-center">
                    <h1 class="inline-block mb-6 pb-2 text-2xl font-black uppercase text-red-700 lg:text-3xl">NewsApi</h1>
                </div>
                {{-- @php
                    var_dump($results->items());
                @endphp --}}
                {{-- {{ dd($results->['articles']) }} --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:grid-cols-4">
                    @foreach ($results->items() as $item)
                    <div class="flex flex-col rounded-md drop-shadow-md bg-gray-200 overflow-hidden hover:drop-shadow-lg">
                        <a href="{{ $item['url'] }}" class="min-h-64 overflow-hidden relative">
                            <img class="object-cover w-full h-full hover:scale-125 transition-all duration-500"  src="{{ $item['urlToImage'] }}" alt="{{ $item['title'] }}">
                            <span class="text-xs text-white px-2 py-1 bg-red-700 rounded-es-md absolute top-0 right-0">
                                {{ \Carbon\Carbon::parse($item['publishedAt'])->diffForhumans() }}
                            </span>
                            <span class="text-xs px-2 py-1 bg-black text-white absolute bottom-0 left-0 rounded-md">{{ $item['author'] }}</span>
                        </a>
                        <div class="h-full p-4">
                            <div class="flex flex-col h-full">
                                <h2 class="mb-2 font-bold lg:text-lg bg-dark text-slate-800 text-balance">
                                    {{ $item['title'] }}
                                </h2>
                                <div class="text-xs lg:text-base text-slate-500 line-clamp-3">
                                    <p>
                                        {{ $item['description'] }}
                                    </p>
                                </div>
                                <div class="mt-auto pt-3 ml-auto">
                                    <a href="{{ $item['url'] }}" class="px-2 py-1 underline">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="py-12  max-w-screen-xxl px-4 mx-auto my-auto sm:px-6 lg:px-8">
                    {{-- {{ dd($results->links()) }} --}}
                    {{ $results->links() }}

                </div>
            </div>
        </main>
    </body>
</html>
