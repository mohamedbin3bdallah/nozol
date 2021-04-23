		<div class="right_col" role="main">
          <div class="" >
            <div class="page-title">
              <div class="title_left" style="width:100%;">
                <h3 style="text-align:center;"><?php echo lang('files'); ?></h3>
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
                    <ul class="nav navbar-right panel_toolbox">
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
                  <div class="x_content">					<br />					<div class="" role="tabpanel" data-example-id="togglable-tabs">                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">                          <li role="presentation" class="active"><a href="#lang_file" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><?php echo lang('lang_file'); ?></a>                          </li>                          <li role="presentation" class=""><a href="#validation_file" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false"><?php echo lang('validation_file'); ?></a>                          </li>                        </ul>                        <div id="myTabContent" class="tab-content">                          <div role="tabpanel" class="tab-pane fade active in" id="lang_file" aria-labelledby="home-tab">						  <?php							$language_array = $this->lang->load($lang->code.'_lang',$lang->code, TRUE);							$en_array = $this->lang->load('en_lang','en', TRUE);							if(isset($language_array) && !empty($language_array))							{							echo validation_errors();							$attributes = array('id' => 'submit_form', /*'data-parsley-validate' => '', */'class' => 'form-horizontal form-label-left');							echo form_open('langs/editlangfile/'.$lang->id, $attributes);														if($this->loginuser->dir == 'rtl') { $label_class = ' col-md-push-6 col-sm-push-6'; $input_class = ' col-md-pull-6 ol-sm-pull-6'; }							else { $label_class = ''; $input_class = ''; }						?>						<?php foreach($language_array as $language_key => $language_item) { ?>							<div class="form-group">							<?php								$data = array(									'class' => 'control-label col-md-6 col-sm-6 col-xs-12'.$label_class,								);								echo form_label($en_array[$language_key].' <span class="required">*</span>',$language_key,$data);							?>								<div class="col-md-6 col-sm-6 col-xs-12 <?php echo $input_class; ?>">								<?php									$data = array(										'type' => 'text',										'name' => 'title['.$language_key.']',										'id' => 'title',										//'placeholder' => lang('title'),										'class' => 'form-control col-md-6 col-sm-6 col-xs-12',										'value' => $language_item									);									echo form_input($data);								?>								</div>							</div>						<?php } ?>							<div class="ln_solid"></div>							<div class="form-group">								<div class="col-md-3 col-sm-3 col-md-offset-6 col-sm-offset-6 col-xs-12">								<?php																													$data = array(										'name' => 'submit',										'id' => 'submit',										'class' => 'btn btn-success',										'style' => 'background-color:#2AA3D6;',										'value' => 'true',										'type' => 'submit',										'content' => lang('edit')									);									echo form_button($data);								?>								</div>							</div>							<?php	echo form_close();	} ?>                          </div>                          <div role="tabpanel" class="tab-pane fade" id="validation_file" aria-labelledby="profile-tab">						  <?php							$validation_language_array = $this->lang->load('form_validation_lang',$lang->code, TRUE);							$validation_en_array = $this->lang->load('form_validation_lang','en', TRUE);							if(isset($validation_language_array) && !empty($validation_language_array))							{							echo validation_errors();							$attributes = array('id' => 'submit_form', /*'data-parsley-validate' => '', */'class' => 'form-horizontal form-label-left');							echo form_open('langs/editvalidationlang/'.$lang->id, $attributes);														if($this->loginuser->dir == 'rtl') { $label_class = ' col-md-push-6 col-sm-push-6'; $input_class = ' col-md-pull-6 ol-sm-pull-6'; }							else { $label_class = ''; $input_class = ''; }						?>						<?php foreach($validation_language_array as $validation_language_key => $validation_language_item) { ?>							<div class="form-group">							<?php								$data = array(									'class' => 'control-label col-md-6 col-sm-6 col-xs-12'.$label_class,								);								echo form_label($validation_en_array[$validation_language_key].' <span class="required">*</span>',$validation_language_key,$data);							?>								<div class="col-md-6 col-sm-6 col-xs-12 <?php echo $input_class; ?>">								<?php									$data = array(										'type' => 'text',										'name' => 'title['.$validation_language_key.']',										'id' => 'title',										//'placeholder' => lang('title'),										'class' => 'form-control col-md-6 col-sm-6 col-xs-12',										'value' => $validation_language_item									);									echo form_input($data);								?>								</div>							</div>						<?php } ?>							<div class="ln_solid"></div>							<div class="form-group">								<div class="col-md-3 col-sm-3 col-md-offset-6 col-sm-offset-6 col-xs-12">								<?php																													$data = array(										'name' => 'submit',										'id' => 'submit',										'class' => 'btn btn-success',										'style' => 'background-color:#2AA3D6;',										'value' => 'true',										'type' => 'submit',										'content' => lang('edit')									);									echo form_button($data);								?>								</div>							</div>							<?php	echo form_close();	} ?>                          </div>                        </div>                      </div>
                  </div>
                </div>
              </div>
            </div>
		  </div>
        </div>