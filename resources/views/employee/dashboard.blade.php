@extends('layouts.employee')
@section('employee-content')
<div class="">
    <employee-dashboard :employee="{{$employee}}" :complaints="{{$complaints}}" :counts="{{$counts}}"></employee-dashboard>
</div>
@endsection