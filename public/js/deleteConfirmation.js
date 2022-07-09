document.querySelectorAll('.delete').forEach(item => {
    item.addEventListener('submit', function (event) {
        event.preventDefault();
        let form = event.target;
        Swal.fire({
            icon: 'warning',
            title: 'Voulez-vous vraiment supprimer cet élément',
            text: 'Vous ne pourrez plus le récupérer !!',
            showCancelButton: true,
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler',
            iconColor: 'blue',
            confirmButtonColor: '#dc3545',
            cancelButtonColor: 'blue',
            focusCancel: true,
            width: '25em',
            customClass: {
                title: 'swal-title',
                actions: 'swal-actions',
                htmlContainer: 'swal-htmlContainer',
                icon: 'swal-icon',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    })
});
