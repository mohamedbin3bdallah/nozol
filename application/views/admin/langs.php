        <!-- page content -->		
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('langs'); ?></h3>
              </div>

              <div class="">
                <div class="col-md-3 col-sm-3 col-xs-5 <?php if($this->loginuser->dir == 'rtl') echo 'col-md-offset-9 col-sm-offset-9 col-xs-offset-7'; //else echo 'col-md-offset-2 col-sm-offset-2 col-xs-offset-1'; ?> form-group top_search" dir="<?php echo $this->loginuser->dir; ?>">
                  <div class="input-group">
					<?php if(strpos($this->loginuser->privileges, ',lnadd,') !== false) { ?><button type="button" class="btn btn-primary" style="background-color:#143E66;" onclick="location.href = 'langs/add'"><?php echo lang('add_lang'); ?></button><?php } ?>
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
                    <?php if(!empty($langs)) { ?>
					<table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th><?php echo lang('title'); ?></th>
						  <th><?php echo lang('code'); ?></th>
						  <th><?php echo lang('dir'); ?></th>						  						  <?php if(strpos($this->loginuser->privileges, ',lnedit,') !== false) { ?><th></th><?php } ?>
						  <th><?php echo lang('editemployee'); ?></th>
						  <th><?php echo lang('edittime'); ?></th>
						  <th><?php echo lang('active'); ?></th>
						  <?php if(strpos($this->loginuser->privileges, ',lnedit,') !== false) { ?><th><?php echo lang('edit'); ?></th><?php } ?>
						  <?php if(strpos($this->loginuser->privileges, ',lndelete,') !== false) { ?><th><?php echo lang('delete'); ?></th><?php } ?>
                        </tr>
                      </thead>


                      <tbody>
					  <?php foreach($langs as $lang) { ?>
                        <tr>
                          <td align="center"><?php echo $lang->title; ?></td>
						  <td align="center"><?php echo $lang->code; ?></td>
						  <td align="center"><?php echo lang($lang->dir); ?></td>						  						  <?php if(strpos($this->loginuser->privileges, ',lnedit,') !== false) { ?><td align="center">						  <a href="<?php echo base_url(); ?>langs/files/<?php echo $lang->id; ?>" class="files"><?php echo lang('files'); ?></a>						  <!--<a class="" href="#" data-toggle="modal" data-target="#open-<?php echo $lang->lnid; ?>"><?php echo lang('files'); ?></a>						   <div id="open-<?php echo $lang->lnid; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">								<div class="modal-dialog modal-lg">									<div class="modal-content">										<div class="modal-header">											<button type="button" class="close" data-dismiss="modal">&times;</button>											<br>											<h3><?php echo lang('langs'); ?></h3>        								</div>										<div class="modal-body">											<table id="datatable-buttons" class="table table-striped table-bordered"  dir="<?php echo $this->loginuser->dir; ?>">												<thead>													<tr>														<td><?php echo lang('lang'); ?></td>														<td><?php echo lang('title'); ?></td>													</tr>												</thead>												<tbody>													<tr>														<td><?php //echo $item['lang']; ?></td>														<td><?php //echo $item['cgtitle']; ?></td>													</tr>												</tbody>											</table>										</div>									</div>								</div>							</div>-->						  </td><?php } ?>
						  <td align="center"><?php echo $employees[$lang->uid]; ?></td>
						  <td align="center"><?php if($lang->time != '') { echo ArabicTools::arabicDate($system->calendar.' Y-m-d', $lang->time).' , '.date('h:i:s', $lang->time); if(date('H', $lang->time) < 12) echo ' '.lang('am'); else echo ' '.lang('pm'); } ?></td>
						  <td align="center"><input type="checkbox" <?php if($lang->active == 1) echo 'checked'; ?> disabled></td>
						  <?php if(strpos($this->loginuser->privileges, ',lnedit,') !== false) { ?><td align="center"><a href="<?php echo base_url(); ?>langs/edit/<?php echo $lang->id; ?>" style="color: green;"><i style="color:#2AA3D6;" class="glyphicon glyphicon-edit"></i></a></td><?php } ?>
						  <?php if(strpos($this->loginuser->privileges, ',lndelete,') !== false) { ?><td align="center">
							<i id="<?php echo $lang->id; ?>" style="color:red;" class="del glyphicon glyphicon-remove-circle"></i>
							<div id="del-<?php echo $lang->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-sm">
									<div class="modal-content">
										<div class="modal-header">
											<?php echo lang('deletemodal'); ?>
											<br>
        								</div>
										<div class="modal-body">
										<center>
											<button class="btn btn-danger" id="action_buttom" onclick="location.href = 'langs/del/<?php echo $lang->id; ?>'" data-dismiss="modal"><?php echo lang('yes'); ?></button>
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