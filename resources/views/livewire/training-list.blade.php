<div>
    <ul class="list-unstyled">
    @foreach($lessons as $lesson)
        <div>
            <li class="shadow m-1 pl-2 border py-2" style="background-color: ghostwhite;"  class="m-1 pl-2 border py-2" >
            {{$lesson->title}}
            </div>
        </li>
    @endforeach
    </ul>
</div>
