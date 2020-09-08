@component('mail::message')

    <h1>Olá, {{ auth()->user()->name }}!</h1>
    <h2>{{ $details['title'] }}</h2>
    <p>Número do pedido: {{ $details['idPed'] }}</p>
    <p>{{ $details['body'] }}</p>

@endcomponent