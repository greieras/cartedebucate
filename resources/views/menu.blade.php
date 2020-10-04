@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($categories as $category)
            <h1>{{$category->name}}</h1>
            <hr class="bg-primary">
            @foreach($category->menuItems as $item)
                <h5>{{$item->name}}</h5>
                <img src="{{$item->image}}">
                <p>{{$item->description}}</p>
                <small>${{round($item->price, 2)}}</small>
            @endforeach
        @endforeach
    </div>
@endsection
