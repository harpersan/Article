@extends('layouts.app')

@section('content')

<div class="bg-gray-200 font-sans leading-normal tracking-normal">
    <br>
    @foreach (App\Post::blogPost() as $view)
    <a href="/view/{{ $view->id }}">
    <div class="flex h-full bg-white rounded  shadow-lg  w-3/4 mx-auto mb-10">
        <div class="w-full md:w-1/2 rounded-t">
            <img src="/images/blogpost/{{$view->images}}" class="h-full w-full shadow object-cover">
        </div>
        <div class="w-full md:w-1/2 flex flex-col flex-grow flex-shrink">
            <div class="flex-1 bg-white rounded-t rounded-b-none  shadow-lg px-10">
                <p class="text-gray-800 font-serif text-base px-6 mb-5">
                    {!! $view->content !!}
                </p>
            </div>

            <div class="flex-none mt-auto bg-white rounded-b rounded-t-none  shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div class="flex">
                    <img class="w-8 h-8 rounded-full mr-4 avatar"
                        src="/images/profile/{{ $view->user->profile_images }}" alt="Avatar of Author">
                        <p>{{ $view->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-xs md:text-sm">{{$view->created_at->diffForHumans()}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>

    @endforeach



    <footer class="bg-gray-900 mt-16">
        <div class="container max-w-6xl mx-auto flex items-center px-2 py-8">

            <div class="w-full mx-auto flex flex-wrap items-center">
                <div class="flex w-full md:w-1/2 justify-center md:justify-start text-white font-extrabold">
                    <a class="text-gray-900 no-underline hover:text-gray-900 hover:no-underline" href="#">
                        👻 <span class="text-base text-gray-200"></span>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>
@endsection
