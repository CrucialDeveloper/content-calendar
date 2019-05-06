@extends('layouts.app')

@section('content')

<business-config :businesses="{{$businessUnits}}"></business-config>

@endsection
