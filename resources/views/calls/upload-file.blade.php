@extends('layouts.admin')

@section('content')

<form action="/uploads" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="mycsv" id="mycsv">
    <input type="submit" value="Upload">

</form>


@endsection