@extends('layouts.app', ['title' => 'Lesson creation'])

@section('content')
<div class="container bg-white p-5">
    <a href ="{{ route('createTraining', $categoryId) }}" type="button" class="float-right btn btn-teal">Back to Main training</a>
    <div>
        <form  action="{{ route('storeLesson') }}" method="post" enctype="multipart/form-data" multiple="multiple">
            @method('POST')
            {{ csrf_field() }}
                <h5 class="w-100 my-5">
                    <label>Lesson title</label>
                    <input name="title" placeholder="Enter title" class="w-100 form-control" required>
                </h5>
                <h5 class="modal-title w-100 my-5">
                    <label>Lesson document</label>
                    <input name="file" type="file" placeholder="File upload" class="w-100 form-control">
                </h5>

                <input id="module_number" type="hidden" name="module_id" value="{{$module_id}}">
                <div>
                    <textarea name="doc_body"></textarea>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-block btn-teal">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>


    /*
    let root = document.querySelector('[drag-root]')
    /*

    root.querySelectorAll('[drag-item]').forEach(el => {
        console.log(el)
        el.addEventListener('dragstart', e => {
            e.target.setAttribute('dragging', true)
            alert("drag start ")
        })

        el.addEventListener('drop', e => {
            e.target.classList.remove('bg-success')
            let draggingEl = root.querySelector('[dragging]')
            e.target.before(draggingEl)

            let component = Livewire.find(
                e.target.closest('[wire\\:id]').getAttribute('wire:id')
            )
            let orderIds = Array.from(root.querySelectorAll('[drag-item]')).map(itemEl => itemEl.getAttribute('drag-item'))
            component.call('reorder', orderIds)
            alert("drag start ")
        })

        el.addEventListener('dragenter', e => {
            e.target.classList.add('bg-success')
            e.preventDefault()
        })

        el.addEventListener('dragover', e => {

            e.preventDefault()
        })

        el.addEventListener('dragleave', e => {
            e.target.classList.remove('bg-success')
        })

        el.addEventListener('dragend', e => {
            e.target.removeAttribute('dragging')
            alert("drag start ")

        })
    })
    */


    </script>
    <script src="https://cdn.tiny.cloud/1/1y1o28gwh8vxvlqfyo3sa4tqicb3d9wd0dsp47bxrvoz95iy/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="application/javascript">




        tinymce.init({
          selector: 'textarea',
          plugins: 'a11ychecker image  casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinymcespellchecker',
          toolbar: 'fontsizeselect alignleft aligncenter alignright alignjustify h1 h2 bold italic  numlist bullist image casechange checklist =formatpainter pageembed permanentpen',
          toolbar_mode: 'floating',
          tinycomments_mode: 'embedded',
          tinycomments_author: 'Author name',
          min_height: 600,
          relative_urls: false,
          autoresize_bottom_margin: 50,

          images_upload_handler: function (blobInfo, success, failure) {
               var xhr, formData;
               xhr = new XMLHttpRequest();
               xhr.withCredentials = false;
               xhr.open('POST', '{{route("imagesUpload")}}');
               var token = '{{ csrf_token() }}';
               xhr.setRequestHeader("X-CSRF-Token", token);
               xhr.onload = function() {
                   var json;
                   if (xhr.status != 200) {
                       failure('HTTP Error: ' + xhr.status);
                       return;
                   }
                   json = JSON.parse(xhr.responseText);
                   console.log(json)
                   if (!json || typeof json.location != 'string') {
                       failure('Invalid JSON: ' + xhr.responseText);
                       return;
                   }

                    //var image = $("#images").val()

                   //image += (json.location);
                   //image += "~";
                   //$('#images').val(image)

                   success(json.location);
               };
               formData = new FormData();
               formData.append('file', blobInfo.blob(), blobInfo.filename());
               xhr.send(formData);
           }

       });


      </script>


</div>
@endsection
