<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Tagihan (Per Bulan)</th>
            <th>Tahun</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tagihan as $row) :
            $no++;
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row["tagihan"] ?></td>
                <td><?= $row["tagihan.tahun_awal"] ?></td>
                <td>
                    <button type="button" class="btn btn-warning btn-xs" onclick="edit('<?= $row['id_tagihan'] ?>')"><i class="fas fa-pencil-alt"></i></button>
                    <button type="button" class="btn btn-danger btn-xs" onclick="hapus('<?= $row['id_tagihan'] ?>')"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>