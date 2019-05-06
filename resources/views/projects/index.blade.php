@extends('layouts.app')


@section('content')
<content-projects :projects="{{$projects}}" :businessUnits="{{$businessUnits}}" :users="{{$users}}"></content-projects>
@endsection
