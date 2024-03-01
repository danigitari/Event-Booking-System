@component('mail::message')
# Ticket Booked Successfully

Ticket information

Name : {{ $name}}
Event : {{ $event->name }}
Date : {{ $event->date }}
PhoneNumber : {{ $phone}}
Ticket_type: {{ $ticketType }} 


Thanks
@endcomponent