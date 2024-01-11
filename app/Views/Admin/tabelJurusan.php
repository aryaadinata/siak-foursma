<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Jurusan</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($jurusan as $row) :
            $no++;
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row["nama_jurusan"] ?></td>
                <td>
                    <a type="button" class="btn btn-flat btn-warning btn-xs" onclick="edit('<?= $row['id_jurusan'] ?>')">edit</i></a>
                    <a type="button" class="btn btn-flat btn-danger btn-xs" onclick="hapus('<?= $row['id_jurusan'] ?>')">hapus</i></a>
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