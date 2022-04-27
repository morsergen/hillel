<b>New user on site {{ env('APP_URL') }}</b>
<b>Name: </b> {{ $user->name }}
<b>SurName: </b> {{ $user->surname }}
<b>Email: </b> {{ $user->email }}
<b>Birthdate: </b> {{ $user->birthdate }}
<b>Phone: </b> {{ $user->phone }}
<b>Role: </b> {{ $user->role->name }}
