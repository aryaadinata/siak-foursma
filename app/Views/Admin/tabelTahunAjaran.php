<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Tahun Ajaran</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tahun_ajaran as $row) :
            $no++;
        ?>
            <tr class="tengah">
                <td><?= $no ?></td>
                <td><b><?= $row["tahun_awal"] ?>/<?= $row["tahun_akhir"] ?></b>
                    <?php if ($row["status"] == 1) : ?>
                        <div class="badge badge-success">
                            Aktif
                        </div>
                    <?php else : ?>
                        <div class="badge badge-danger">
                            Nonaktif
                        </div>
                    <?php endif ?>
                </td>
                <td>
                    <button type="button" class="btn btn-flat btn-warning btn-xs" onclick="edit('<?= $row['id_tahun'] ?>')">Edit</button>
                    <button type="button" class="btn btn-flat btn-danger btn-xs" onclick="hapus(<?php echo $row['id_tahun'] . ',' . $row['status']; ?>)">Hapus</button>
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