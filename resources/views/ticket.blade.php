@component('mail::message')
# Ticket Booked Successfully<br>

Ticket information<br>

Name : {{ $name}}<br>
Event : {{ $event->name }}<br>
Date : {{ $event->date }}<br>
PhoneNumber : {{ $phone}}<br>
Ticket_type: {{ $ticketType }} <br>


Thanks
@endcomponent