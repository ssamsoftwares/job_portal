@extends('partials.backend.app')
@section('adminTitle','Superadmin Dashboard')
@section('content')

    <x-status-message />
    <div class="pd-ltr-20">
        <div class="row">

            {{-- <x-design.card value="{{$total['products']}}" desc="Products" icon="dw dw-shopping-cart1" /> --}}
            <x-design.card value="#" desc="User" icon="dw dw-shopping-cart1" />
            <x-design.card value="#" desc="User" icon="dw dw-shopping-cart1"/>
            <x-design.card value="#" desc="User" icon="dw dw-shopping-cart1" />

        </div>
    </div>

@endsection
