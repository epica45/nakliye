<body class="nav-md">

    <div class="container body">

      <div class="main_container">

        <div class="col-md-3 left_col">

          <div class="left_col scroll-view">

            <div class="navbar nav_title" style="border: 0;">

              <a href="<?php echo base_url(); ?>" class="site_title"><center>Nakliye</center></a>

            </div>

            <div class="clearfix"></div>

            <br />

            <!-- sidebar menu -->

            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

              <div class="menu_section">

                <ul class="nav side-menu">

                  <li><a href="<?php echo base_url(); ?>"><i class="fa fa-plus-square"></i> Proforma Sorgula</a></li>

                  <li><a href="<?php echo site_url('Nakliye/oncekiSorgular'); ?>"><i class="fa fa-list"></i> Önceki Sorgular</a></li>

                  <li><a href="<?php echo site_url('Nakliye/kullanicilar');?>"><i class="fa fa-users"></i> Kullanıcılar</a></li>

                </ul>

              </div>

            </div>

            <!-- /sidebar menu -->

          </div>

        </div>



        <!-- top navigation -->

        <div class="top_nav no-print">

          <div class="nav_menu">

            <nav>

              <div class="nav toggle">

                <a id="menu_toggle"><i class="fa fa-bars"></i></a>

              </div>



              <ul class="nav navbar-nav navbar-right">

                <li class="">

                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                    <span class="user_profile_name"><?php echo $this->session->userdata('user_name'); ?></span>

                    <span class="fa fa-angle-down"></span>

                  </a>

                  <ul class="dropdown-menu dropdown-usermenu pull-right">

                    <?php /*<li><a href="javascript:;"><span class="badge bg-red pull-right">Pasif</span><span>Profil</span></a></li>

                    <li><a href="javascript:;"><span class="badge bg-red pull-right">Pasif</span><span>Ayarlar</span></a></li>

                    <li><a href="javascript:;"><span class="badge bg-red pull-right">Pasif</span><span>Yardım</span></a></li>*/ ?>

                    <li><a href="<?php echo site_url('Nakliye/cikis');?>"><span>Çıkış Yap</span><i class="fa fa-sign-out pull-right"></i></a></li>

                  </ul>

                </li>

              </ul>

            </nav>

          </div>

        </div>

        <!-- /top navigation -->