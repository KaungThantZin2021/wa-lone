import sweetalert2 from 'sweetalert2';
window.Swal = sweetalert2;

const DeleteAlert = Swal.mixin({
    width: 350,
    showCancelButton: true,
    reverseButtons: true,
    confirmButtonColor: '#d33',
    // cancelButtonColor: '#596267',
    confirmButtonText: 'Delete',
    customClass: {
        popup: 'p-0 shadow dark:tw-text-white dark:tw-bg-slate-700',
        actions: 'mt-1 mb-3 p-0',
        confirmButton: 'py-2',
        cancelButton: 'bg-secondary py-2',
    }
});
window.DeleteAlert = DeleteAlert;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    customClass: {
        popup: 'shadow dark:tw-text-white dark:tw-bg-slate-700',
        timerProgressBar: 'dark:tw-bg-slate-500'
    },
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.Toast = Toast;
