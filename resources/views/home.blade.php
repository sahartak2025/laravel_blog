@extends('layout.mainlayout')
@section('content')
    <div class="container px-4 px-lg-5">
        @if(count($posts))
            <div class="float-end">
                <a href="{{ route('home', ['sort' => $sort]) }}">Sort by publish date</a>
            </div>
        @endif
        <div class="col-md-10 col-lg-8 col-xl-7">
            @foreach($posts as $post)
                <div class="post-preview">
                    <h3 class="post-title">{{ $post->title }}</h3>
                    <h5 class="post-subtitle">{{ $post->description }}</h5>
                    <p class="post-meta">
                        Posted by
                        {{ $post->user->name }}
                        on {{date('d-m-Y', strtotime($post->created_at))}}
                    </p>
                </div>
                <hr class="my-4"/>
            @endforeach
            {!! $posts->links() !!}
        </div>
    </div>
@endsection
