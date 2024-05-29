@extends('layouts.admin')
@section('admin-content')
<div class="content-wrapper">
    <real-users-component :type="{{ json_encode($type) }}"></real-users-component>
</div>
@endsection