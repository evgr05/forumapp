@extends('layouts.app')
@section('title', 'Интересные истории')
@section('content')
<span>Интересные истории</span><br>
            <div class="imag">
                <img src='images/image1.png'>
            </div><br>
            <a href="{{ route('admin.post.create') }}">
                <button class="btn" >РАССКАЗАТЬ</button>
            </a><br>
            <a href="{{ route('admin.index') }}" title="">
                <button class="btn">АДМИН-ПАНЕЛЬ</button>
            </a>
            <h1>Лента:</h1><br>
            <aside class="skills aside section">
    <div class="section-inner">
        <h2 class="heading">Хештеги</h2>
        <div class="content">
            <div class="skillset">
                @if(!empty($categories))
                    @foreach($categories as $category)
                        <div class="item">
                            <h3 class="level-title"><a href="{{url("/blog/category/$category->id")}}" class="link_menu">{{$category->title}}</a></h3>
                            <div class="level-bar">
                                <div class="level-bar-inner" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</aside>
<aside class="credits aside section">
</aside>
@forelse($posts as $post)
        <section class="experience section">
            <div class="section-inner">
                <h2 class="heading"><a href="{{route('post', $post->id)}}">{{$post->title}}</a></h2>
                <div class="content">
                    {!! $post->desc !!}
                </div>
            </div>
        </section>
        @empty
            <section class="experience section">
                <div class="section-inner">
                    <div class="content">
                        <p>
                            На сайте нет материалов
                        </p>
                    </div>
                </div>
            </section>
        @endforelse
        @if($posts) {{$posts->links()}} @endif
@endsection
