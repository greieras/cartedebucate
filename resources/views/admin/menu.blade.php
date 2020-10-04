@extends('layouts.app')
@section('title', '- Menu editor -')
@section('content')
    <menu-editor :categories="{{ $categories }}"></menu-editor>
@endsection
