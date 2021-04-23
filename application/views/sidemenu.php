        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url(); ?>home" class="site_title"><span><?php echo $system->website; ?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic ">
                <img src="<?php if($this->loginuser->img != '' && file_exists($this->config->item('users_folder').$this->loginuser->img)) echo base_url().$this->config->item('users_folder').$this->loginuser->img; else echo base_url().$this->config->item('users_folder').'user.png'; ?>" alt="<?php echo $this->loginuser->username; ?>" class="img-circle profile_img" style="max-height:55px;">
              </div>
              <div class="profile_info">
                <span><?php echo lang('welcome'); ?>,</span>
                <h2><?php echo $this->loginuser->username; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

			<br>
			<br>
			<br>
			<br>

            <!-- sidebar menu -->
			<?php if($this->loginuser->dir == 'rtl') { ?>
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <!--<h3>General</h3>-->
                <ul class="nav side-menu" style="text-align:right;">
				  <?php if($this->loginuser->utid ==  '1') { ?><li><a href="<?php echo base_url(); ?>systemy"><?php echo lang('system'); ?> <i class="fa fa-cog"></i></a></li><?php } ?>

				  <?php if(strpos($this->loginuser->privileges, ',scadd,') !== false || strpos($this->loginuser->privileges, ',scsee,') !== false) { ?>
				   <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('sections'); ?> <i class="fa fa-tree"></i></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',scadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>sections/add"><?php echo lang('add_section'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',scsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>sections"><?php echo lang('sections'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>				  				  				  <?php if((in_array('LN',$this->sections)) && (strpos($this->loginuser->privileges, ',lnadd,') !== false || strpos($this->loginuser->privileges, ',lnsee,') !== false)) { ?>				   <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('langs'); ?> <i class="fa fa-language"></i></a>					<ul class="nav child_menu">						<?php if(strpos($this->loginuser->privileges, ',lnadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>langs/add"><?php echo lang('add_lang'); ?></a></li><?php } ?>						<?php if(strpos($this->loginuser->privileges, ',lnsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>langs"><?php echo lang('langs'); ?></a></li><?php } ?>					</ul>				   </li>				  <?php } ?>				  				  				  <?php if((in_array('PC',$this->sections)) && (strpos($this->loginuser->privileges, ',pcadd,') !== false || strpos($this->loginuser->privileges, ',pcsee,') !== false)) { ?>				   <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('places'); ?> <i class="fa fa-map"></i></a>					<ul class="nav child_menu">											<?php if(strpos($this->loginuser->privileges, ',pcadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>places/add"><?php echo lang('add_place'); ?></a></li><?php } ?>						<?php if(strpos($this->loginuser->privileges, ',pcsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>places"><?php echo lang('places'); ?></a></li><?php } ?>					</ul>				   </li>				  <?php } ?>
				  <?php if((in_array('U',$this->sections) || in_array('UT',$this->sections)) && (strpos($this->loginuser->privileges, ',utadd,') !== false || strpos($this->loginuser->privileges, ',utsee,') !== false || strpos($this->loginuser->privileges, ',uadd,') !== false || strpos($this->loginuser->privileges, ',usee,') !== false || strpos($this->loginuser->privileges, ',esee,') !== false || strpos($this->loginuser->privileges, ',cssee,') !== false)) { ?>
				  <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('users'); ?> <i class="fa fa-user"></i></a>
					<ul class="nav child_menu">
						<?php if(in_array('UT',$this->sections)) { if(strpos($this->loginuser->privileges, ',utadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>usertypes/add"><?php echo lang('add_usertype'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',utsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>usertypes"><?php echo lang('usertypes'); ?></a></li><?php } } ?>
						<?php if(in_array('U',$this->sections)) { if(strpos($this->loginuser->privileges, ',uadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>users/add"><?php echo lang('add_user'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',usee,') !== false) { ?><li><a href="<?php echo base_url(); ?>users"><?php echo lang('admins'); ?></a></li><?php } ?>												<?php if(strpos($this->loginuser->privileges, ',esee,') !== false) { ?><li><a href="<?php echo base_url(); ?>users/employees"><?php echo lang('employees'); ?></a></li><?php } ?>												<?php if(strpos($this->loginuser->privileges, ',cssee,') !== false) { ?><li><a href="<?php echo base_url(); ?>users/customers"><?php echo lang('customers'); ?></a></li><?php } } ?>
					</ul>
                  </li>
				  <?php } ?>				  				  				   <?php if((in_array('SV',$this->sections)) && (strpos($this->loginuser->privileges, ',svadd,') !== false || strpos($this->loginuser->privileges, ',svsee,') !== false)) { ?>				   <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('services'); ?> <i class="fa fa-cogs"></i></a>					<ul class="nav child_menu">						<?php if(strpos($this->loginuser->privileges, ',svadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>services/add"><?php echo lang('add_service'); ?></a></li><?php } ?>						<?php if(strpos($this->loginuser->privileges, ',svsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>services"><?php echo lang('services'); ?></a></li><?php } ?>					</ul>				   </li>				  <?php } ?>				  				  				   <?php if((in_array('RE',$this->sections)) && (strpos($this->loginuser->privileges, ',readd,') !== false || strpos($this->loginuser->privileges, ',resee,') !== false || strpos($this->loginuser->privileges, ',rsee,') !== false)) { ?>				   <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('realestates'); ?> <i class="fa fa-home"></i></a>					<ul class="nav child_menu">						<!--<?php //if(strpos($this->loginuser->privileges, ',readd,') !== false) { ?><li><a href="<?php //echo base_url(); ?>realestates/add"><?php //echo lang('add_realestate'); ?></a></li><?php //} ?>-->						<?php if(strpos($this->loginuser->privileges, ',resee,') !== false) { ?><li><a href="<?php echo base_url(); ?>realestates"><?php echo lang('realestates'); ?></a></li><?php } ?>												<?php if(strpos($this->loginuser->privileges, ',rsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>realestates/rents"><?php echo lang('rents'); ?></a></li><?php } ?>					</ul>				   </li>				  <?php } ?>				  				  				  <?php if((in_array('TM',$this->sections)) && (strpos($this->loginuser->privileges, ',tmadd,') !== false || strpos($this->loginuser->privileges, ',tmsee,') !== false)) { ?>				   <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('terms'); ?> <i class="fa fa-file-text-o"></i></a>					<ul class="nav child_menu">						<?php if(strpos($this->loginuser->privileges, ',tmadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>terms/add"><?php echo lang('add_term'); ?></a></li><?php } ?>						<?php if(strpos($this->loginuser->privileges, ',tmsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>terms"><?php echo lang('terms'); ?></a></li><?php } ?>					</ul>				   </li>				  <?php } ?>				  				  <?php if((in_array('PG',$this->sections)) && (strpos($this->loginuser->privileges, ',pgadd,') !== false || strpos($this->loginuser->privileges, ',pgsee,') !== false)) { ?>				   <li><a><span class="fa fa-chevron-down"></span> <?php echo lang('pages'); ?> <i class="fa fa-files-o"></i></a>					<ul class="nav child_menu">						<?php if(strpos($this->loginuser->privileges, ',pgadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>pages/add"><?php echo lang('add_page'); ?></a></li><?php } ?>						<?php if(strpos($this->loginuser->privileges, ',pgsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>pages"><?php echo lang('pages'); ?></a></li><?php } ?>					</ul>				   </li>				  <?php } ?>				  
                </ul>
              </div>
            </div>
			<?php } else { ?>
			 <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <!--<h3>General</h3>-->
                <ul class="nav side-menu" style="text-align:left;">
				  <?php if($this->loginuser->utid ==  '1') { ?><li><a href="<?php echo base_url(); ?>systemy"><i class="fa fa-cog"></i> <?php echo lang('system'); ?></a></li><?php } ?>

				  <?php if(strpos($this->loginuser->privileges, ',scadd,') !== false || strpos($this->loginuser->privileges, ',scsee,') !== false) { ?>
				   <li><a><i class="fa fa-tree"></i> <?php echo lang('sections'); ?> <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<?php if(strpos($this->loginuser->privileges, ',scadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>sections/add"><?php echo lang('add_section'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',scsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>sections"><?php echo lang('sections'); ?></a></li><?php } ?>
					</ul>
				   </li>
				  <?php } ?>
				  <?php if((in_array('LN',$this->sections)) && (strpos($this->loginuser->privileges, ',lnadd,') !== false || strpos($this->loginuser->privileges, ',lnsee,') !== false)) { ?>				   <li><a><i class="fa fa-language"></i> <?php echo lang('langs'); ?> <span class="fa fa-chevron-down"></span></a>					<ul class="nav child_menu">						<?php if(strpos($this->loginuser->privileges, ',lnadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>langs/add"><?php echo lang('add_lang'); ?></a></li><?php } ?>						<?php if(strpos($this->loginuser->privileges, ',lnsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>langs"><?php echo lang('langs'); ?></a></li><?php } ?>					</ul>				   </li>				  <?php } ?>				  				  				 <?php if((in_array('PC',$this->sections)) && (strpos($this->loginuser->privileges, ',pcadd,') !== false || strpos($this->loginuser->privileges, ',pcsee,') !== false)) { ?>				   <li><a><i class="fa fa-map-marker"></i> <?php echo lang('places'); ?> <span class="fa fa-chevron-down"></span></a>					<ul class="nav child_menu">						<?php if(strpos($this->loginuser->privileges, ',pcadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>places/add"><?php echo lang('add_place'); ?></a></li><?php } ?>											<?php if(strpos($this->loginuser->privileges, ',pcsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>places"><?php echo lang('places'); ?></a></li><?php } ?>					</ul>				   </li>				  <?php } ?>
				  <?php if((in_array('U',$this->sections) || in_array('UT',$this->sections)) && (strpos($this->loginuser->privileges, ',utadd,') !== false || strpos($this->loginuser->privileges, ',utsee,') !== false || strpos($this->loginuser->privileges, ',uadd,') !== false || strpos($this->loginuser->privileges, ',usee,') !== false || strpos($this->loginuser->privileges, ',esee,') !== false || strpos($this->loginuser->privileges, ',cssee,') !== false)) { ?>
				  <li><a><i class="fa fa-user"></i> <?php echo lang('users'); ?> <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<?php if(in_array('UT',$this->sections)) { if(strpos($this->loginuser->privileges, ',utadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>usertypes/add"><?php echo lang('add_usertype'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',utsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>usertypes"><?php echo lang('usertypes'); ?></a></li><?php } } ?>
						<?php if(in_array('U',$this->sections)) { if(strpos($this->loginuser->privileges, ',uadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>users/add"><?php echo lang('add_user'); ?></a></li><?php } ?>
						<?php if(strpos($this->loginuser->privileges, ',usee,') !== false) { ?><li><a href="<?php echo base_url(); ?>users"><?php echo lang('admins'); ?></a></li><?php } ?>												<?php if(strpos($this->loginuser->privileges, ',esee,') !== false) { ?><li><a href="<?php echo base_url(); ?>users/employees"><?php echo lang('employees'); ?></a></li><?php } ?>												<?php if(strpos($this->loginuser->privileges, ',cssee,') !== false) { ?><li><a href="<?php echo base_url(); ?>users/customers"><?php echo lang('customers'); ?></a></li><?php } } ?>
					</ul>
                  </li>
				  <?php } ?>				  <?php if((in_array('SV',$this->sections)) && (strpos($this->loginuser->privileges, ',svadd,') !== false || strpos($this->loginuser->privileges, ',svsee,') !== false)) { ?>				   <li><a><i class="fa fa-cogs"></i> <?php echo lang('services'); ?> <span class="fa fa-chevron-down"></span></a>					<ul class="nav child_menu">						<?php if(strpos($this->loginuser->privileges, ',svadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>services/add"><?php echo lang('add_service'); ?></a></li><?php } ?>						<?php if(strpos($this->loginuser->privileges, ',svsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>services"><?php echo lang('services'); ?></a></li><?php } ?>					</ul>				   </li>				  <?php } ?>				  				  <?php if((in_array('RE',$this->sections)) && (strpos($this->loginuser->privileges, ',readd,') !== false || strpos($this->loginuser->privileges, ',resee,') !== false || strpos($this->loginuser->privileges, ',rsee,') !== false)) { ?>				   <li><a><i class="fa fa-home"></i> <?php echo lang('realestates'); ?> <span class="fa fa-chevron-down"></span></a>					<ul class="nav child_menu">						<!--<?php //if(strpos($this->loginuser->privileges, ',readd,') !== false) { ?><li><a href="<?php //echo base_url(); ?>realestates/add"><?php //echo lang('add_realestate'); ?></a></li><?php //} ?>-->						<?php if(strpos($this->loginuser->privileges, ',resee,') !== false) { ?><li><a href="<?php echo base_url(); ?>realestates"><?php echo lang('realestates'); ?></a></li><?php } ?>												<?php if(strpos($this->loginuser->privileges, ',rsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>realestates/rents"><?php echo lang('rents'); ?></a></li><?php } ?>					</ul>				   </li>				  <?php } ?>				  				  				  <?php if((in_array('TM',$this->sections)) && (strpos($this->loginuser->privileges, ',tmadd,') !== false || strpos($this->loginuser->privileges, ',tmsee,') !== false)) { ?>				   <li><a><i class="fa fa-file-text-o"></i> <?php echo lang('terms'); ?> <span class="fa fa-chevron-down"></span></a>					<ul class="nav child_menu">						<?php if(strpos($this->loginuser->privileges, ',tmadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>terms/add"><?php echo lang('add_term'); ?></a></li><?php } ?>						<?php if(strpos($this->loginuser->privileges, ',tmsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>terms"><?php echo lang('terms'); ?></a></li><?php } ?>					</ul>				   </li>				  <?php } ?>				  				  				  <?php if((in_array('PG',$this->sections)) && (strpos($this->loginuser->privileges, ',pgadd,') !== false || strpos($this->loginuser->privileges, ',pgsee,') !== false)) { ?>				   <li><a><i class="fa fa-files-o"></i> <?php echo lang('pages'); ?> <span class="fa fa-chevron-down"></span></a>					<ul class="nav child_menu">						<?php if(strpos($this->loginuser->privileges, ',pgadd,') !== false) { ?><li><a href="<?php echo base_url(); ?>pages/add"><?php echo lang('add_page'); ?></a></li><?php } ?>						<?php if(strpos($this->loginuser->privileges, ',pgsee,') !== false) { ?><li><a href="<?php echo base_url(); ?>pages"><?php echo lang('pages'); ?></a></li><?php } ?>					</ul>				   </li>				  <?php } ?>

                </ul>
              </div>
            </div>
			<?php } ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!--<div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>-->
            <!-- /menu footer buttons -->
          </div>
        </div>