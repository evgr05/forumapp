@extends('layouts.app')

@section('title', $category->title)

@section('content')

    <section class="experience section">
        <div class="section-inner">
        @forelse($posts as $post)
            <h2><a href="{{route('post', $post->id)}}">{{$post->title}}</a></h2>
            <p>{!! $post->desc !!}</p>

        @empty
            <h2 class="text-center">В данном хештеге нет постов</h2>
        @endforelse
        </div>
    </section>
    @if($posts) {{$posts->links()}} @endif

@endsection
