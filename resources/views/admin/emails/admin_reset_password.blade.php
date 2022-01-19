@component('mail::message')
    # Reset Account Password

    Welcome, {{ $data['data']->name }}
    Here You Can Reset Password By Clicking This Button Down Or By Copying This Link And Put In Any Browser .

    @component('mail::button', ['url' => adminUrl('reset/password/'.$data['token'])])
        Click Here To Reset Your Password
    @endcomponent
    Or <br>
    Copy This Link : <a href="{{ adminUrl('reset/password/'.$data['token']) }}">{{ adminUrl('reset/password/'.$data['token']) }}</a>

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
