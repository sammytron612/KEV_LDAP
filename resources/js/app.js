require('./bootstrap');

import Swal from 'sweetalert2';


window.Swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  /*onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  } */
})

Livewire.on('toast', message => {
    Toast.fire(message.text,'', message.type);

})


const Toast1 = Swal.mixin({
    toast: false,
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel!',
  })

  window.Toast1 = Toast1
/*
Toast1.fire().then((result) => {
    if (result.value) {
      return alert('yes')
    } else {return false}
  })
*/

