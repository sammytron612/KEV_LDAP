<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width">
<title>Recruitment Report</title>
<style></style>
</head>
<body style="width:600px">
<h3>Todays recuritment numbers</h3>
<br>

<div style="width:100%">
    <table>
        <thead style="background-color:crimson;color:white">
            <th style="width:200px;padding:3px 10px 10px 3px">Campaign</th>
            <th style="width:100px;padding:3px 10px 10px 3px">Site</th>
            <th style="width:100px;padding:3px 10px 10px 3px">Start date</th>
            <th style="width:150px;padding:3px 10px 10px 3px">Recruiter</th>
            <th style="padding:3px 10px 10px 3px">Heads required</th>
            <th style="padding:3px 10px 10px 3px">Recruited Today</th>
            <th style="padding:3px 10px 10px 3px">Total</th>
            <th style="width:40px;padding:3px 10px 10px 3px">%</th>
        </thead>
        <tbody>

        @foreach($data as $campaign)
        @if($campaign['completed'])
        <tr style="background-color:lightgreen;padding-top:3px;padding-bottom:3px">
            @else
            <tr style="padding-top:3px;padding-bottom:3px">
        @endif

                <td style="text-align:center">{{$campaign['campaign']}}</td>

                <td style="text-align:center">{{ucfirst($campaign['site'])}}</td>

                <td style="text-align:center">{{\Carbon\Carbon::parse($campaign['startDate'])->format('d/m/Y')}}</td>

                <td style="text-align:center">{{$campaign['recruiter']}}</td>

                <td style="text-align:center">{{$campaign['headTotal']}}</td>

                <td style="text-align:center">{{$campaign['today']}}</td>

                <td style="text-align:center">{{$campaign['total']}}</td>

                <td style="text-align:center">{{$campaign['pct']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px">
        <h4>Thanks, Jarvis</h4>
    </div>
</div>

</body>
</html>

