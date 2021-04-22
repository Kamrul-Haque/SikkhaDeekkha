@component('mail::message')
# Payment Confirmed

Dear {{ $payment->student->name }},

You payment of <strong>{{ $payment->amount }}</strong> for {{ $payment->course->title }} has been <strong>confirmed</strong>. You can now access the course contents through the link given below or from your dashboard.

@component('mail::button', ['url' => 'http://localhost/SikkhaDeekkha/public/course/'.$payment->course->id.'/module'])
Course Contents
@endcomponent

Thanks for your Patience. Happy Learning!
@endcomponent
