        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('users'); ?></h3>
              </div>

              <div class="">
                <div class="col-md-3 col-sm-3 col-xs-5 <?php if($this->loginuser->dir == 'rtl') echo 'col-md-offset-9 col-sm-offset-9 col-xs-offset-7'; //else echo 'col-md-offset-2 col-sm-offset-2 col-xs-offset-1'; ?> form-group top_search" dir="<?php echo $this->loginuser->dir; ?>">
                  <div class="input-group">
					<?php if(strpos($this->loginuser->privileges, ',uadd,') !== false) { ?><button type="button" class="btn btn-primary" style="background-color:#143E66;" onclick="location.href = 'users/add'"><?php echo lang('add_user'); ?></button><?php } ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row" dir="<?php echo $this->loginuser->dir; ?>">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <!--<h2>Button Example <small>Users</small></h2>-->
                    <ul class="nav navbar-<?php if($this->loginuser->dir == 'rtl') echo 'left'; else echo 'right'; ?> panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <!--<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>-->
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <!--<p class="text-muted font-13 m-b-30">
                      The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                    </p>-->
                    <?php if(!empty($users)) { ?>
					<table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th><?php echo lang('username'); ?></th>
						  <th><?php echo lang('image'); ?></th>
						  <th><?php echo lang('name'); ?></th>
                          <th><?php echo lang('email'); ?></th>
						  <th><?php echo lang('mobile'); ?></th>						  						  <th><?php echo lang('place'); ?></th>
                          <th><?php echo lang('address'); ?></th>
						  <th><?php echo lang('usertype'); ?></th>						  						  <th><?php echo lang('lang'); ?></th>						  						  <th><?php echo lang('creditcards'); ?></th>
						  <th><?php echo lang('editemployee'); ?></th>
						  <th><?php echo lang('edittime'); ?></th>
						  <th><?php echo lang('active'); ?></th>
						  <?php if(strpos($this->loginuser->privileges, ',uedit,') !== false) { ?><th><?php echo lang('edit'); ?></th><?php } ?>
						  <?php if(strpos($this->loginuser->privileges, ',udelete,') !== false) { ?><th><?php echo lang('delete'); ?></th><?php } ?>
                        </tr>
                      </thead>


                      <tbody>
					  <?php foreach($users as $user) { ?>
                        <tr>
                          <td align="center"><?php echo $user['username']; ?></td>
						  <td align="center"><?php if(isset($user['uimage']) && $user['uimage'] != '' && file_exists($this->config->item('users_folder').$user['uimage'])) { ?><img src="<?php echo base_url().$this->config->item('users_folder').$user['uimage']; ?>" class="img-responsive" style="max-width:150px;max-height:150px;border-radius:15%;"/><?php } ?></td>
						  <td align="center"><?php echo $user['uname']; ?></td>
                          <td align="center"><?php echo $user['uemail']; ?></td>
						  <td align="center"><?php if($user['umobile'] != '') echo '+'.$user['pcphone'].'-'.$user['umobile']; ?></td>						  						  <td align="center"><?php echo $user['uplace']; ?></td>
                          <td align="center"><?php echo $user['uaddress']; ?></td>
						  <td align="center"><?php echo $user['utname']; ?></td>						  						  <td align="center"><?php echo $user['lntitle']; ?></td>						  						  <td align="center">						  <?php if(isset($user['items']) && !empty($user['items'])) { ?>						  <a class="" href="#" data-toggle="modal" data-target="#open-<?php echo $user['uid']; ?>"><?php echo lang('details'); ?></a>						   <div id="open-<?php echo $user['uid']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">								<div class="modal-dialog modal-lg">									<div class="modal-content">										<div class="modal-header">											<button type="button" class="close" data-dismiss="modal">&times;</button>											<br>											<h3><?php echo lang('creditcards'); ?></h3>        								</div>										<div class="modal-body">											<table id="datatable-buttons" class="table table-striped table-bordered"  dir="<?php echo $this->loginuser->dir; ?>">												<?php if(!empty($user['items'])) { ?>												<thead>													<tr>														<td><?php echo lang('code'); ?></td>														<td><?php echo lang('expire'); ?></td>														<td><?php echo lang('cvv'); ?></td>													</tr>												</thead>												<?php } ?>												<tbody>												<?php foreach($user['items'] as $item) { ?>													<tr>														<td align="center"><?php echo $item['cccode']; ?></td>														<td align="center"><?php echo $item['ccexpire']; ?></td>														<td align="center"><?php echo $item['cccvv']; ?></td>													</tr>												<?php } ?>												</tbody>											</table>										</div>									</div>								</div>							</div>						  <?php } ?>						  </td>
						  <td align="center"><?php if($user['uuid'] != '' && isset($employees[$user['uuid']])) echo $employees[$user['uuid']]; ?></td>
						  <td align="center"><?php if($user['utime'] != '') { echo ArabicTools::arabicDate($system->calendar.' Y-m-d', $user['utime']).' , '.date('h:i:s', $user['utime']); if(date('H', $user['utime']) < 12) echo ' '.lang('am'); else echo ' '.lang('pm'); } ?></td>
						  <td align="center"><input type="checkbox" <?php if($user['uactive'] == 1) echo 'checked'; ?> disabled></td>
						  <?php if(strpos($this->loginuser->privileges, ',uedit,') !== false) { ?><td align="center"><a href="<?php echo base_url(); ?>users/edit/<?php echo $user['uid']; ?>" style="color: #2AA3D6;"><i style="color:#2AA3D6;" class="glyphicon glyphicon-edit"></i></a></td><?php } ?>
						  <?php if(strpos($this->loginuser->privileges, ',udelete,') !== false) { ?><td align="center">
							<i id="<?php echo $user['uid']; ?>" style="color:red;" class="del glyphicon glyphicon-remove-circle"></i>
							<div id="del-<?php echo $user['uid']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-sm">
									<div class="modal-content">
										<div class="modal-header">
											<?php echo lang('deletemodal'); ?>
											<br>
        								</div>
										<div class="modal-body">
										<center>
											<button class="btn btn-danger" id="action_buttom" onclick="location.href = 'users/del/<?php echo $user['uid']; ?>'" data-dismiss="modal"><?php echo lang('yes'); ?></button>
											<button class="btn btn-success" data-dismiss="modal" aria-hidden="true"><?php echo lang('no'); ?></button>
										</center>
										</div>
									</div>
								</div>
							</div>
						</td><?php } ?>
                        </tr>
					  <?php } ?>
                      </tbody>
                    </table>
					<?php } else echo lang('no_data');?>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- /page content -->