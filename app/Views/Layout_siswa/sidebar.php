  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url() ?>" class="brand-link">
          <img src="<?= base_url() ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Siwatma</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <?php if ($siswa["foto"] != "") : ?>
                      <img class="img-rounded elevation-2" src="../../dist/img/pasfoto/<?= $siswa["foto"]; ?>" alt="Photo">
                  <?php else : ?>
                      <img class="img-rounded elevation-2" src="../../dist/img/pasfoto/none.jpg" alt="Photo">
                  <?php endif ?>
              </div>
              <div class="info">
                  <?php
                    $nama = explode(' ', $siswa["nama"]);
                    // Mengambil maksimal 5 kata dari array
                    $nama = implode(' ', array_slice($nama, 0, 4));
                    ?>
                  <a href="#" class="d-block"><?= $nama; ?> </a>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-header">MENU</li>
                  <li class="nav-item">
                      <?php $uri = current_url(true); ?>
                      <a href="/Dashboard" class="nav-link <?php if ($uri->getSegment(2) == '') echo 'active';
                                                            else  echo '' ?>">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-item <?php if ($uri->getSegment(1) == 'Siswa') echo 'menu-open';
                                        else  echo '' ?>">
                      <a href="#" class="nav-link <?php if ($uri->getSegment(1) == 'Siswa') echo 'active';
                                                    else  echo '' ?>">
                          <i class="nav-icon fas fa-database"></i>
                          <p>
                              Biodata
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="<?= base_url('/Siswa/biodata/') ?>" class="nav-link <?php if ($uri->getSegment(2) == 'biodata') echo 'active';
                                                                                            else  echo '' ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Biodata</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?= base_url('/Siswa/keluarga/') ?>" class="nav-link <?php if ($uri->getSegment(2) == 'keluarga') echo 'active';
                                                                                            else  echo '' ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Data Keluarga</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="<?= base_url('/Penunjang/prestasi/') ?>" class="nav-link <?php if ($uri->getSegment(2) == 'prestasi') echo 'active';
                                                                                        else  echo '' ?>">
                          <i class="nav-icon fas fa-trophy"></i>
                          <p>
                              Prestasi
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?= base_url('/Penunjang/pelanggaran/') ?>" class="nav-link <?php if ($uri->getSegment(2) == 'pelanggaran') echo 'active';
                                                                                            else  echo '' ?>">
                          <i class="nav-icon fas fa-gavel"></i>
                          <p>
                              Pelanggaran
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-user"></i>
                          <p>
                              Akun
                          </p>
                      </a>
                  </li>
                  <li class="nav-header">NAVIGASI</li>
                  <li class="nav-item bg-danger color-palette">
                      <a href="<?= base_url() ?>/Auth/logoutSiswa" class="nav-link">
                          <i class="nav-icon fas fa-cogs"></i>
                          <p>
                              Keluar
                          </p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>