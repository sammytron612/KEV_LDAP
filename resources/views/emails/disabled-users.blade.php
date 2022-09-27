 <h4>The following is the status of offboarding AD requests</h4>
 <br>

@foreach($users as $user)
{{$user['name']}},  AD Disabled - <b>{{$user['ad']}}</b>
<br>
@endforeach



