@component('mail::message')
# Hello {{ $data['user']->name }}

@component('mail::button', ['url' => route('admin.password.reset', $data['token'])])
Click To Reset Your Password
@endcomponent

Thanks,<br>
{{--{{ config('app.name') }}--}}
@endcomponent
