@extends('layout/layout')

@section('content')

  {{-- @include('components/main')--}}
  {{-- @include('components/book') --}}
  {{-- @include('components/add-edit') --}}
  {{-- @include('components/profile') --}}
  {{-- @include('components/users') --}}
  {{--  <p>{{ $request }}</p> --}}
  @include($content)

@endsection