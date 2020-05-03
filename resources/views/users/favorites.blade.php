@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            @include('users.card',['user' => $user])
        </aside>
        <div class="col-sm-8">
            @include('users.navtabs',['user' => $user])
            @foreach ($favorites as $micropost)
                <li class="media mb-3">
                    <img class="mr-2 rounded" src="{{ Gravatar::src($micropost->user->email,50) }}" alt="">
                    <div class="media-body row">
                        <div class="col-sm-12">
                            {!! link_to_route('users.show',$micropost->user->name,['id' => $micropost->user->id]) !!} <span class="text-muted">posted at {{ $micropost->created_at }}</span>  
                        </div>
                        <div class="col-sm-12">
                            <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>    
                        </div>
                        <div class="col-sm-2">
                            @include('favorites.favorite_button',['user' => $user])
                        </div>
                        <div class="col-sm-1">
                            @if (Auth::id() == $micropost->user_id)
                                {!! Form::open(['route' => ['microposts.destroy',$micropost->id],'method' => 'delete']) !!}
                                    {!! Form::submit('Delete',['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </div>
    </div>
@endsection