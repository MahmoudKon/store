@component('mail::message')
# Thank you For Your message

<strong>Name </strong> {{ $data['name'] }} <br>
<strong>Email </strong> {{ $data['email'] }} <br>
<strong>Phone </strong> {{ $data['phone'] }} <br>
<strong>Message </strong> {{ $data['message'] }} <br>
@endcomponent
