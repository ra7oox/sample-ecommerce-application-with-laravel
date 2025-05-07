@extends('master')
@section('content')

<form action="{{route("categories.store")}}" method="POST">
    @csrf
    <input type="text" name="category_name" placeholder="category name" value="{{old("category_name",$category->category_name)}}">
    <button type="submit">modifier</button>
</form>
    
@endsection