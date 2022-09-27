<div class="mt-2 row row-cols-1 row-cols-lg-2">
    <div class="col mt-3">
        <h2 class="mb-2 text-underline text-center">News headlines
            <button wire:click="world" type="button" class="btn btn-link">World</button>
            <button wire:click="uk" type="button"class="btn btn-link">UK</button>
        </h2>

        <div class="border mt-3 p-2" style="height:400px;overflow-x:hidden; overflow-y:auto;">
            @foreach($results as $result)
                <div class="row mt-3">
                    <div class="col-2">
                        <img style="width:80px" class="shadow mr-5" src="{{$result['image']}}">
                    </div>
                    <div class="col-10">
                        <a class="w-100" href="{{$result['link']}}" target="_blank"><h6 class="ml-2 text-dark">{{$result['title']}}</h6></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col mt-3">
        <h2 class="text-center mt-2">Our location</h2>
        <div class="mapouter"><div class="gmap_canvas"><iframe width="499" height="394" id="gmap_canvas" src="https://maps.google.com/maps?q=NE35%209PE&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://fmovies-online.net">fmovies</a><br><style>.mapouter{position:relative;text-align:right;height:394px;width:499px;}</style><a href="https://www.embedgooglemap.net">embedgooglemap.net</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:394px;width:499px;}</style></div></div>
    </div>

</div>
