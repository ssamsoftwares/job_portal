@extends('partials.backend.app')
@section('adminTitle','Candidate Dashboard')
@section('content')

    <x-status-message />
    <div class="pd-ltr-20">
        <div class="row">

            {{-- <x-design.card value="{{$total['products']}}" desc="Products" icon="dw dw-shopping-cart1" /> --}}
            <x-design.card value="#" desc="Categories" icon="dw dw-shopping-cart1" />
            <x-design.card value="#" desc="Sub Categories" icon="dw dw-shopping-cart1"/>
            <x-design.card value="#" desc="Brands" icon="dw dw-shopping-cart1" />

        </div>
    </div>

@endsection
