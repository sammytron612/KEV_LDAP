 <h4>The following is the status of Account creation requests</h4>
 <br>
 @if(isset($users[0]))
    <h3>Location - {{$users[0]['location']}}</h3>
    <h3>Start date - {{$users[0]['start_date']}}</h3>
    <h3>Campaign - {{$users[0]['campaign']}}</h3>
    <br>
    @foreach($users as $user)
    Name - {{$user['name']}}, <span style="font-size: 20px;"><b>Login - <i>{{$user['login']}}</i></b></span> - {{$user['AD']}}, Workplace account - {{$user['workplace']}}
    <br>
    @endforeach
@else
    <h3>There has been a problem creating the accounts for that group</h3>
@endif
