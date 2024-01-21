<table class="table table-head-fixed text-nowrap table-striped">
    <thead>
        <tr>
            <th style="width: 10px">#</th>
            <th class="tengah">Nama</th>
            <th class="tengah">Status</th>
            <th class="tengah">Jam Berkunjung</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        foreach ($siswa as $row) : $no++ ?>
            <tr>
                <td class="tengah"><?= $no; ?></td>
                <?php if ($row["nisn"] != "") : ?>
                    <td><?= $row["nama"]; ?></td>
                    <td class="tengah"><span class="badge bg-info">Siswa</span></td>
                <?php else : ?>
                    <td><?= $row["nama_ptk"]; ?></td>
                    <?php if ($row["jenis_ptk"] == 0) : ?>
                        <td class="tengah"><span class="badge bg-primary">Guru</span></td>
                    <?php elseif ($row["jenis_ptk"] == 1) : ?>
                        <td class="tengah"><span class="badge bg-primary">Pegawai</span></td>
                    <?php endif ?>
                <?php endif ?>
                <td class="tengah"><?= $row["jam"]; ?></td>
            </tr>
        <?php endforeach ?>
        <?php if ($no <= 0) : ?>
            <tr>
                <td class="text-center lead" colspan="10">Belum ada kunjungan !</td>
            </tr>
        <?php endif ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        scrollTableToBottom();
    });

    function scrollTableToBottom() {
        var tableContainer = document.querySelector('.table-responsive');
        tableContainer.scrollTop = tableContainer.scrollHeight;
    }
</script>