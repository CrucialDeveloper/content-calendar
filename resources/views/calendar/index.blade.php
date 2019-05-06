@extends('layouts.app')


@section('content')

<content-calendar :projects="{{$projects}}" :businessunits="{{$businessUnits}}" :users="{{$users}}"></content-calendar>

@endsection
