@extends('layouts.app', ['title' => 'Site settings'])
@push('material-scripts')
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"
></script>
@endpush
@push('material-css')
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
  rel="stylesheet"
/>
@endpush
@section('content')

<div class="container bg-white py-5">
        @livewire('it.settings')
</div>
@endsection
