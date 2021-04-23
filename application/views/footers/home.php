        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <!--Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>-->
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
	<div id="custom_notifications" class="custom-notifications dsp_none">      <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">      </ul>      <div class="clearfix"></div>      <div id="notif-group" class="tabbed_notifications"></div>    </div>
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/jquery/dist/jquery.min.js"></script>			<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/Chart.js/dist/Chart.min.js"></script>	<script src="<?php echo base_url(); ?>gentelella-master/vendors/pnotify/dist/pnotify.js"></script>    <script src="<?php echo base_url(); ?>gentelella-master/vendors/pnotify/dist/pnotify.buttons.js"></script>    <script src="<?php echo base_url(); ?>gentelella-master/vendors/pnotify/dist/pnotify.nonblock.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>gentelella-master/build/js/custom.min.js"></script>	<script>		var user_id = <?php echo $this->session->userdata('uid'); ?>;		var socket = io.connect('http://localhost:3001');		socket.on('new_notify',function(data){			if(user_id == data.user)			{				$('body').append('<div class="ui-pnotify  ui-pnotify-fade-normal ui-pnotify-in ui-pnotify-fade-in ui-pnotify-move" aria-live="assertive" aria-role="alertdialog" style="display: none; width: 300px; right: 36px; top: 36px; cursor: auto;"><div class="alert ui-pnotify-container alert-success ui-pnotify-shadow" role="alert" style="min-height: 16px;"><div class="ui-pnotify-closer" aria-role="button" tabindex="0" title="Close" style="cursor: pointer; visibility: visible;"><span class="glyphicon glyphicon-remove notify_close"></span></div><div class="ui-pnotify-sticker" aria-role="button" aria-pressed="false" tabindex="0" title="Stick" style="cursor: pointer; visibility: hidden;"><span class="glyphicon glyphicon-pause" aria-pressed="false"></span></div><div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div><h4 class="ui-pnotify-title">Regular Success</h4><div class="ui-pnotify-text" aria-role="alert">'+data.message+'</div></div></div>');				//$('.x_content').append('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+data.message+'</div>');			}			//console.log(data);		})	</script>		<script>		$(document).ready(function(){			$('.notify_close').click(function() {				$('.alert').hide();			});		});	</script>		<!--<div class="ui-pnotify  ui-pnotify-fade-normal ui-pnotify-in ui-pnotify-fade-in ui-pnotify-move ui_notify" style="display: none; width: 300px; right: 36px; top: 36px; cursor: auto;" aria-live="assertive" aria-role="alertdialog">		<div class="alert ui-pnotify-container alert-success ui-pnotify-shadow" role="alert" style="min-height: 16px;">			<div class="ui-pnotify-closer" aria-role="button" tabindex="0" title="Close" style="cursor: pointer; visibility: visible;">				<span class="glyphicon glyphicon-remove notify_close"></span>			</div>			<div class="ui-pnotify-sticker" aria-role="button" aria-pressed="false" tabindex="0" title="Unstick" style="cursor: pointer; visibility: hidden;">				<span class="glyphicon glyphicon-pause" aria-pressed="false"></span>			</div>			<div class="ui-pnotify-icon">				<span class="glyphicon glyphicon-ok-sign"></span>			</div>			<h4 class="ui-pnotify-title">Regular Success</h4>			<div class="ui-pnotify-text" aria-role="alert">That thing that you were trying to do worked!</div>		</div>	</div>-->
  </body>
</html>