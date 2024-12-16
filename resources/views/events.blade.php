@extends('layout')
@section('title','Dashboard')
@push('styles')
<link rel="stylesheet" href="{{asset('css/events.css')}}">
@endpush
@section('content')
    <div id="eventsSection" class="content-section events-section">
        <h1>Events section </h1>
        @foreach($events as $event)
            <div class="cards-container">
                <div class="animated-card">
                    <h3 class="card-title">{{$event->event_name}}</h3>
                    <div class="card-data">
                        <div class="data-left">
                            <p>{{$event->event_type}}</p>
                            <p>{{$event->stock_name}}</p>
                        </div>
                        <div class="data-right">
                            <p>{{$event->price}}</p>
                            <p>{{$event->event_date}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <h1> hello there</h1>
            <h2>hi there this is events section</h2>
        @endforeach
    </div>
    @endsection

    @push('script')
    <link rel="stylesheet" href="{{asset('js/script.js')}}">      
    @endpush
