import sweetalert2 from 'sweetalert2';
window.Swal = sweetalert2;

const TrashAlert = Swal.mixin({
    text: "Are you sure to remove to trash?",
    width: 350,
    showCancelButton: true,
    reverseButtons: true,
    confirmButtonColor: '#d33',
    confirmButtonText: 'Trash',
    customClass: {
        popup: 'p-0 shadow dark:tw-text-white dark:tw-bg-slate-700',
        actions: 'mt-1 mb-3 p-0',
        confirmButton: 'py-2',
        cancelButton: 'bg-secondary py-2',
    }
});
window.TrashAlert = TrashAlert;

const RestoreAlert = Swal.mixin({
    text: "Are you sure to store?",
    width: 350,
    showCancelButton: true,
    reverseButtons: true,
    // confirmButtonColor: '#d33',
    confirmButtonText: 'Restore',
    customClass: {
        popup: 'p-0 shadow dark:tw-text-white dark:tw-bg-slate-700',
        actions: 'mt-1 mb-3 p-0',
        confirmButton: 'py-2 bg-primary',
        cancelButton: 'bg-secondary py-2',
    }
});
window.RestoreAlert = RestoreAlert;

const DeleteAlert = Swal.mixin({
    text: "Are you sure to delete permanently?",
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

const HtmlAlert = Swal.mixin({
    focusConfirm: false,
    showCancelButton: true,
    reverseButtons: true,
    customClass: {
        popup: 'p-0 shadow dark:tw-text-white dark:tw-bg-slate-700',
        actions: 'mt-1 mb-3 p-0',
        confirmButton: 'py-2 bg-primary',
        cancelButton: 'bg-secondary py-2',
    }
});
window.HtmlAlert = HtmlAlert;

const ErrorAlert = Swal.mixin({
    icon: 'error',
    width: 350,
    showCloseButton: true,
    showCancelButton: false,
    showConfirmButton: false,
    customClass: {
        popup: 'shadow dark:tw-text-white dark:tw-bg-slate-700',
        closeButton: 'border border-0',
    }
});
window.ErrorAlert = ErrorAlert;

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
