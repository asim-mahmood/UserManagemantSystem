@extends('layouts.admin')
@section('admin-content')
<div class="content-wrapper">
    <admin-dashboard :total_count="{{$totalCount}}" :active_count="{{$activeCount}}" :in_active_count="{{$inActiveCount}}" :pending_bill_count="{{$pendingBillCount}}" :expired_count="{{$expiredCount}}" :expiring_count="{{$expiringCount}}" :paid_count="{{$paidCount}}" :new_count="{{$newCount}}" :totalEmployee="{{$totalEmployee}}" :activeEmployee="{{$activeEmployee}}" :inactiveEmployee="{{$inactiveEmployee}}">
    </admin-dashboard>
</div>
@endsection