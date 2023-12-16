@extends('layout.default')
@section('dashboardActive')
active
@endsection
@section('breadcrumb')
Dashboard
@endsection
@section('content')
<div class="row">
    <h4>Welcome,{{Auth::user()->name}}</h1>
</div>
@endsection