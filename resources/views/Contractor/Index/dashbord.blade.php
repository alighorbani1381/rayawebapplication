@extends('Contractor.Layout.main')
@section('title', 'پنل کاربری')
@section('header', 'پنل کاربری شما')
@section('content')

این پنل پیمانکار است 
@if(session()->has('profile-changed'))
<script>
    var message = "پروفایل شما با موفقیت تغییر کرد.";
    minMbox(message, 250);
</script>
@endif
@endsection