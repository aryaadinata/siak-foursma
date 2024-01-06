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
                  <img src="<?= base_url() ?>/dist/img/user.png" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">Administrator </a>
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
                  <li class="nav-item <?php if ($uri->getSegment(1) == 'Ptk') echo 'menu-open';
                                        else  echo '' ?>">
                      <a href="#" class="nav-link <?php if ($uri->getSegment(1) == 'Ptk') echo 'active';
                                                    else  echo '' ?>">
                          <i class="nav-icon fas fa-user-tie"></i>
                          <p>
                              Data PTK
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="<?php if ($uri->getSegment(2) != 'data_guru') echo base_url('/Ptk/data_guru/');
                                        else echo '#' ?>" class="nav-link <?php if ($uri->getSegment(2) == 'data_guru' || $uri->getSegment(2) == 'viewimport') echo 'active';
                                                                            else  echo '' ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Guru</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php if ($uri->getSegment(2) != 'data_pegawai') echo base_url('/Ptk/data_pegawai/');
                                        else echo '#' ?>" class="nav-link <?php if ($uri->getSegment(2) == 'data_pegawai') echo 'active';
                                                                            else  echo '' ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Pegawai</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item <?php if ($uri->getSegment(2) == 'tahun_ajaran' || $uri->getSegment(2) == 'jurusan' || $uri->getSegment(2) == 'kelas') echo 'menu-open';
                                        else  echo '' ?>">
                      <a href="#" class="nav-link <?php if ($uri->getSegment(2) == 'tahun_ajaran' || $uri->getSegment(2) == 'jurusan' || $uri->getSegment(2) == 'kelas') echo 'active';
                                                    else  echo '' ?>">
                          <i class="nav-icon fas fa-school"></i>
                          <p>
                              Data Sekolah
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="<?php if ($uri->getSegment(2) != 'identitas_sekolah') echo base_url('/Admin/identitas_sekolah/');
                                        else echo '#' ?>" class="nav-link <?php if ($uri->getSegment(2) == 'identitas_sekolah') echo 'active';
                                                                            else  echo '' ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Identitas Sekolah</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php if ($uri->getSegment(2) != 'tahun_ajaran') echo base_url('/Admin/tahun_ajaran/');
                                        else echo '#' ?>" class="nav-link <?php if ($uri->getSegment(2) == 'tahun_ajaran') echo 'active';
                                                                            else  echo '' ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Tahun Ajaran</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php if ($uri->getSegment(2) != 'jurusan') echo base_url('/Admin/jurusan/');
                                        else echo '#' ?>" class="nav-link <?php if ($uri->getSegment(2) == 'jurusan') echo 'active';
                                                                            else  echo '' ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Jurusan | Peminatan</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php if ($uri->getSegment(2) != 'kelas') echo base_url('/Admin/kelas/');
                                        else echo '#' ?>" class="nav-link <?php if ($uri->getSegment(2) == 'kelas') echo 'active';
                                                                            else  echo '' ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Kelas</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item <?php if ($uri->getSegment(2) == 'data_siswa' || $uri->getSegment(2) == 'viewimport' || $uri->getSegment(2) == 'kenaikan' || $uri->getSegment(2) == 'kelulusan' || $uri->getSegment(2) == 'keluar') echo 'menu-open';
                                        else  echo '' ?>">
                      <a href="#" class="nav-link <?php if ($uri->getSegment(2) == 'data_siswa' || $uri->getSegment(2) == 'viewimport' || $uri->getSegment(2) == 'kenaikan' || $uri->getSegment(2) == 'kelulusan' || $uri->getSegment(2) == 'keluar') echo 'active';
                                                    else  echo '' ?>">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              Data Siswa
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="<?php if ($uri->getSegment(2) != 'data_siswa') echo base_url('/Admin/data_siswa/');
                                        else echo '#' ?>" class="nav-link <?php if ($uri->getSegment(2) == 'data_siswa' || $uri->getSegment(2) == 'viewimport') echo 'active';
                                                                            else  echo '' ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Siswa</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php if ($uri->getSegment(2) != 'kenaikan') echo base_url('/Admin/kenaikan/');
                                        else echo '#' ?>" class="nav-link <?php if ($uri->getSegment(2) == 'kenaikan') echo 'active';
                                                                            else  echo '' ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Rombel</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php if ($uri->getSegment(2) != 'kelulusan') echo base_url('/Admin/kelulusan/');
                                        else echo '#' ?>" class="nav-link <?php if ($uri->getSegment(2) == 'kelulusan') echo 'active';
                                                                            else  echo '' ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Kelulusan</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php if ($uri->getSegment(2) != 'keluar') echo base_url('/Admin/keluar/');
                                        else echo '#' ?>" class="nav-link <?php if ($uri->getSegment(2) == 'keluar') echo 'active';
                                                                            else  echo '' ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Siswa Keluar</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item <?php if ($uri->getSegment(1) == 'User') echo 'menu-open';
                                        else  echo '' ?>">
                      <a href="#" class="nav-link <?php if ($uri->getSegment(1) == 'USer') echo 'active';
                                                    else  echo '' ?>">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              User
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="<?php if ($uri->getSegment(2) != 'user_admin') echo base_url('/User/user_admin/');
                                        else echo '#' ?>" class="nav-link <?php if ($uri->getSegment(2) == 'user_admin' || $uri->getSegment(2) == 'viewimport') echo 'active';
                                                                            else  echo '' ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Admin</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php if ($uri->getSegment(2) != 'ptk') echo base_url('/User/user_ptk/');
                                        else echo '#' ?>" class="nav-link <?php if ($uri->getSegment(2) == 'user_ptk') echo 'active';
                                                                            else  echo '' ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>User PTK</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="<?php if ($uri->getSegment(2) != 'user_siswa') echo base_url('/User/user_siswa/');
                                        else echo '#' ?>" class="nav-link <?php if ($uri->getSegment(2) == 'user_siswa') echo 'active';
                                                                            else  echo '' ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>User Siswa</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <!-- <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-wallet"></i>
                          <p>
                              Transaksi
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="<?php //if ($uri->getSegment(2) != 'tagihan') echo base_url('/Transaksi/tagihan/');
                                        //else echo '#' 
                                        ?>" class="nav-link <?php //if ($uri->getSegment(2) == 'tagihan') echo 'active';
                                                            //else  echo '' 
                                                            ?>" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Tagihan SPP</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Pembayaran SPP</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Pemasukan</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Pengeluaran</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Siswa</p>
                              </a>
                          </li>
                      </ul>
                  </li> -->
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-cogs"></i>
                          <p>
                              Pengaturan
                          </p>
                      </a>
                  </li>
                  <li class="nav-header">NAVIGASI</li>
                  <li class="nav-item bg-danger color-palette">
                      <a href="<?= base_url() ?>/Auth/logoutAdmin" class="nav-link">
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