@extends('layouts.app')



@section('content')
    <section class="experience section">
        <div class="section-inner">
            <h1>{{$post->title}}</h1>
            {!! $post->desc !!}
            <hr>
            <div class="post_footer">
                <dl>
                    <dt>Автор:</dt>
                    <dd>{{ $author->name }}</dd>
                    <dt>Создан:</dt>
                    <dd>{{ $post->created_at }}</dd>
                </dl>
            </div>
        </div>
    </section>
@endsection
