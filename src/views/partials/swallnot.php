<script>
    Swal.fire({
        position: 'top-end',
        icon: '<?php if (isset($_SESSION['type'])) {
                    echo $_SESSION['type'];
                } else {
                    echo 'success';
                } ?>',
        title: '<?= $_SESSION['swal'] ?>',
        showConfirmButton: false,
        timer: 2500
    })
</script>