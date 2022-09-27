@extends('layouts.app', ['title' => 'Jarvis Home'])
@section('content')

<div class="container-fluid bg-white p-2 vh-75 mt-3">
    <section>
        <div style="width:100%; height:800px" class="back d-flex justify-content-center align-items-center">
            <div style="top:-20px; position:relative">
                <p style="font-size:80px" class="text-white">Team ECO</p>
                <div class="red-line mx-auto"></div>
                <h5 class="mt-3 text-center text-white">The UK's fastest growing sales and customer</h5>
                <h5 class="text-center text-white"> service contact centre and #FuelYourFuture</h5>
            </div>
        </div>
    </section>
    <section class="mt-5">
        <h1 style="color:#002856;" class="text-center">Welcome, {{Auth::user()->name}}</h1>
        <div class="red-line mx-auto my-5"></div>
        <h5 class="mt-3 text-center text-dark px-5">Welcome to the new ECO Intranet portal.</h5>
        <h5 class="text-center text-dark px-5">This will be your go to destination for training and applications that can make your workday more productive here at ECO.</h5>
        <h5 class="text-center text-dark px-5">New content and applications are being developed and this portal will continue to grow.</h5>
    <section>
    <div class="red-line mx-auto my-5"></div>

</div>


<script>

function webPushr()
{
    (function(w,d, s, id) {if(typeof(w.webpushr)!=='undefined') return;
    w.webpushr=w.webpushr||function(){(w.webpushr.q=w.webpushr.q||[]).push(arguments)};
    var js, fjs = d.getElementsByTagName(s)[0];
    js = d.createElement(s);
    js.id = id
    ;js.async=1;
    js.src = "https://cdn.webpushr.com/app.min.js";
    fjs.parentNode.appendChild(js);}
    (window,document, 'script', 'webpushr-jssdk'));
    webpushr('setup',{'key':'BDKFzWaBeTt0ciMlnUogdQe90h-DC6eT8DlU_ccvSfzBEAh1GzaUe_FJErPpwkTqRNfmm_7FH1CfIzjzVRP75FE' });
}


function _webpushrScriptReady(){

    var token = $('meta[name="csrf-token"]').attr('content')

    webpushr('fetch_id',function (sid) {
        fetch("/save-token", {
        method: 'post',
        headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-Token":  token,
      },
        body: JSON.stringify({
                    fetch_id: sid,

                }),
      }).then((response) => {
      return response.json();
    })
    .then((data) => {
        console.log(sid);
        console.log(data);
    })
    });
}

document.addEventListener('DOMContentLoaded', function () {
    setTimeout(webPushr(), 1000);
    setTimeout(_webpushrScriptReady(), 1000);
}, false);

</script>
@endsection
