import './bootstrap';
import swal from 'sweetalert';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// delete confirmation dialogue
window.deleteConfirm = function (e) {
    e.preventDefault();
    const form = e.target.closest('form');
    swal({
        title: "Are you sure you want to delete?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
      });
}
