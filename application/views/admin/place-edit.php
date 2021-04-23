		<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('edit_place'); ?></h3>
              </div>

              <!--<div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>-->
            </div>
			
            <div class="clearfix"></div>
            
			<div class="row" dir="<?php echo $this->loginuser->dir; ?>">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <!--<h2>Form Design <small>different form elements</small></h2>-->
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
                    <br />
					<?php
						//echo $admessage;
						echo validation_errors();
						$attributes = array('id' => 'submit_form', /*'data-parsley-validate' => '', */'class' => 'form-horizontal form-label-left');
						echo form_open('places/editplace/'.$myplace->id, $attributes);
					?>
                    <!--<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">-->
					<?php
						if($this->loginuser->dir == 'rtl') { $label_class = ' col-md-push-6 col-sm-push-6'; $input_class = ' col-md-pull-1 ol-sm-pull-2'; }
						else { $label_class = ''; $input_class = ''; }
					?>

                      <div class="form-group">
						<?php
							$data = array(								
								'class' => 'control-label col-md-3 col-sm-3 col-xs-12'.$label_class,
							);
							echo form_label(lang('title').' <span class="required">*</span>','title',$data);
						?>
                        <div class="col-md-6 col-sm-6 col-xs-12 <?php echo $input_class; ?>">
						  <?php
							$data = array(
								'type' => 'text',
								'name' => 'title',
								'id' => 'title',
								'placeholder' => lang('title'),
								'class' => 'form-control col-md-7 col-xs-12',
								//'max' => 255,
								//'required' => 'required',
								'value' => $myplace->title
							);
							echo form_input($data);
						?>
                        </div>
                      </div>
					  <div class="form-group">
						<?php
							$data = array(
								'class' => 'control-label col-md-3 col-sm-3 col-xs-12'.$label_class,
							);
							echo form_label(lang('country'),'country',$data);
						?>
                        <div class="col-md-6 col-sm-6 col-xs-12 <?php echo $input_class; ?>">
						<?php													if(count($places) == 1) $parent = $places[0]->parent;							else $parent = $places[0]->id;							$ourtypes = array(lang('country'));							
							if(!empty($countries))
							{
								foreach($countries as $country)
								{
									$ourtypes[$country->id] = $country->title;
								}											
							}																					echo form_dropdown('parent', $ourtypes, array($parent), 'id="country" class="form-control" required="required"');
						?>
                        </div>
                      </div>					  					  					  <?php if(!empty($governorates)) { ?>					  <div id="governorates" class="form-group">						<?php							$data = array(								'class' => 'control-label col-md-3 col-sm-3 col-xs-12'.$label_class,							);							echo form_label(lang('governorate'),'governorate',$data);						?>                        <div class="col-md-6 col-sm-6 col-xs-12 <?php echo $input_class; ?>">						<?php													if(count($places) == 2) $parent1 = $places[1]->parent;							else $parent1 = $places[1]->id;							$ourtypes1 = array(lang('governorate'));							foreach($governorates as $governorate)							{								$ourtypes1[$governorate->id] = $governorate->title;							}																										echo form_dropdown('parent1', $ourtypes1, array($parent1), 'id="governorate" class="form-control" required="required"');													?>                        </div>                      </div>					  <?php } ?>					  					  <!--<?php //if(!empty($districts)) { ?>					  <div id="districts" class="form-group">						<?php							/*$data = array(								'class' => 'control-label col-md-3 col-sm-3 col-xs-12'.$label_class,							);							echo form_label(lang('district'),'district',$data);*/						?>                        <div class="col-md-6 col-sm-6 col-xs-12 <?php //echo $input_class; ?>">						<?php													/*if(count($places) == 3) $parent2 = $places[2]->parent;							else $parent2 = $places[2]->id;							$ourtypes2 = array(lang('district'));														foreach($districts as $district)							{								$ourtypes2[$district->id] = $district->title;							}															echo form_dropdown('parent2', $ourtypes2, array($parent2), 'id="district" class="form-control" required="required"');*/						?>                        </div>                      </div>					  <?php //} ?>-->
                      <div class="form-group">
                        <?php
							$data = array(
								'class' => 'control-label col-md-3 col-sm-3 col-xs-12'.$label_class,
							);
							echo form_label(lang('active'),'active',$data);
						?>
                        <div class="col-md-6 col-sm-6 col-xs-12 <?php echo $input_class; ?>">
						  <?php
							$data = array(
								'name' => 'active',
								'id' => 'active',
								'checked' => 'TRUE',
								'class' => 'js-switch',
								'value' => 1
							);
							echo form_checkbox($data);
						?>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-6 col-xs-12 col-md-offset-3">
						  <?php																				
							$data = array(
								'name' => 'submit',
								'id' => 'submit',
								'class' => 'btn btn-success',																'style' => 'background-color:#2AA3D6;',
								'value' => 'true',
								'type' => 'submit',
								'content' => lang('save')
							);
							echo form_button($data);
						?>
                        </div>
                      </div>

                    <?php
						echo form_close();
					?>
                  </div>
                </div>
              </div>
            </div>
		  </div>
        </div>