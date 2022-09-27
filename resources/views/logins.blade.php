@extends('layouts.app', ['title' => 'Intake groups'])
@section('content')

<div class="container-fluid bg-white pt-5">

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="h5 eco-red text-white">
                    <th>Campaign</th>
                    <th>Division</th>
                    <th>Site</th>
                    <th>Start date</th>
                    <th>Heads</th>
                    <th class="float-right">Action</th>
                </thead>
                <tbody>
                    @foreach($groups as $group)
                    <tr>
                        <td>{{$group->campaigns->title}}</td>
                        <td> {{$group->division->title}}</td>
                        <td>{{ucfirst($group->site)}}</td>
                        <td>{{ \Carbon\Carbon::parse($group->start_date)->format('d/m/Y') }}</td>
                        <td>{{$totals[$loop->index]}}</td>
                        <td><a href="{{route('showLogins',$group->batch_no)}}" class="btn btn-sm btn-teal">View</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$groups->links()}}
        </div>
</div>

@endsection
