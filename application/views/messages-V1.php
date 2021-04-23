<!--<style>
.modal-backdrop.in
{
	background-color: #fff;
	opacity: 0.2;
}
</style>--><link href="<?php echo base_url(); ?>css/custom.<?php echo $this->loginuser->dir; ?>.css" rel="stylesheet"><?php if(isset($docs) && !empty($docs)) { for($cc=1;$cc<=count($docs);$cc++) { ?><div class="modal fade" id="myModal<?php echo $cc; ?>" role="dialog" data-backdrop="static" data-keyboard="false">    <div class="modal-dialog doc_modal">      <!-- Modal content-->      <div class="cnt_mdl mdl<?php echo $cc; ?>">        <div class="modal-header">          <center class="tit_mdl"><h5 class="modal-title"><?php echo lang($docs[$cc-1]); ?></h5></center>        </div>		<div class="modal-footer">			<?php if($cc != count($docs)) { ?><button type="button" class="but_mdl" data-dismiss="modal"><?php echo lang('cancel'); ?></button>			<button type="button" id="but_mdl<?php echo $cc+1; ?>" class="but_mdl" data-dismiss="modal"><?php echo lang('next'); ?></button><?php } else { ?>			<button type="button" class="but_mdl" data-dismiss="modal"><?php echo lang('close'); ?></button><?php } ?>		</div>      </div>    </div>  </div><?php } ?><script type="text/javascript">	$(document).ready(function(){		var doc_mdl1_pos = $('#doc_mdl1').position();		$('.mdl1').css('position', 'absolute');		$('.mdl1').css('top', doc_mdl1_pos.top);		$('.mdl1').css('left', doc_mdl1_pos.left);		$('.mdl1').css('width', 255);		$('#myModal1').modal({show: true, backdrop: 'static', keyboard: false});		<?php for($cc=2;$cc<=count($docs);$cc++) { ?>		$('#but_mdl<?php echo $cc; ?>').click(function() {			var doc_mdl1_pos = $('#doc_mdl<?php echo $cc; ?>').position();			$('.mdl<?php echo $cc; ?>').css('position', 'absolute');			$('.mdl<?php echo $cc; ?>').css('top', doc_mdl1_pos.top);			$('.mdl<?php echo $cc; ?>').css('left', doc_mdl1_pos.left);			$('.mdl<?php echo $cc; ?>').css('width', 255);			$('#myModal<?php echo $cc; ?>').modal({show: true, backdrop: 'static', keyboard: false});		});		<?php } ?>	});</script><?php } ?><?php if(isset($docs_title) && !empty($docs_title)) { ?>
<script type="text/javascript">	<?php for($cc=0;$cc<count($docs_title);$cc++) { ?>	$(document).ready(function(){			$('<?php echo $docs_title[$cc]['selector']; ?>').attr('data-toggle', 'tooltip');			$('<?php echo $docs_title[$cc]['selector']; ?>').attr('data-placement', 'top');			$('<?php echo $docs_title[$cc]['selector']; ?>').attr('title', '<?php echo lang($docs_title[$cc]['title']); ?>');	});	<?php } ?>		$(function () {		$('[data-toggle="tooltip"]').tooltip()	})</script><?php } ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#submit_form').submit(function() {
			$('#loader').modal({show: true, backdrop: 'static', keyboard: false});
			//e.preventDefault();
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#action_buttom').click(function() {
			$('#loader').modal({show: true, backdrop: 'static', keyboard: false});
		});
	});
</script>

<script>
<?php 
//$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
if(isset($_SESSION['message'],$_SESSION['time'],$_SERVER['REQUEST_TIME']) && ($_SERVER['REQUEST_TIME'] < ($_SESSION['time']+3))) {
?>
$(document).ready(function(){
	$("#<?php echo $_SESSION['message']; ?>").modal('show');
	setTimeout(function() { $("#<?php echo $_SESSION['message']; ?>").modal('hide'); }, 3000);
});
<?php  /*unset($_SESSION['message']);*/ } ?>
</script>

<div id="loader" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top: 55px;">
	<img src="<?php echo base_url(); ?>imgs/loader.gif" id="gif" style="display: block; margin: 0 auto; width: 100px;">
</div>

<div id="success" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content"  style="background-color: green;">
			<div class="modal-body">
				<center style="color: #fff; font-size:25px;">
					<?php echo lang('success_saved'); ?>
				</center>
			</div>
		</div>
	</div>
</div>

<div id="cantdelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content"  style="background-color: red;">
			<div class="modal-body">
				<center style="color: #fff; font-size:25px;">
					<?php echo lang('cant_delete'); ?>
				</center>
			</div>
		</div>
	</div>
</div>

<div id="somthingwrong" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content"  style="background-color: red;">
			<div class="modal-body">
				<center style="color: #fff; font-size:25px;">
					<?php echo lang('somthing_wrong'); ?>
				</center>
			</div>
		</div>
	</div>
</div>

<div id="inputnotcorrect" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content"  style="background-color: orange;">
			<div class="modal-body">
				<center style="color: #fff; font-size:25px;">
					<?php echo lang('input_not_correct'); ?>
				</center>
			</div>
		</div>
	</div>
</div>

<div id="invalidinput" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content"  style="background-color: orange;">
			<div class="modal-body">
				<center style="color: #fff; font-size:25px;">
					<?php echo lang('invalid_input'); ?>
				</center>
			</div>
		</div>
	</div>
</div>

<div id="usernameexist" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content"  style="background-color: orange;">
			<div class="modal-body">
				<center style="color: #fff; font-size:25px;">
					<?php echo lang('username_exist'); ?>
				</center>
			</div>
		</div>
	</div>
</div>

<div id="nameexist" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content"  style="background-color: orange;">
			<div class="modal-body">
				<center style="color: #fff; font-size:25px;">
					<?php echo lang('name_exist'); ?>
				</center>
			</div>
		</div>
	</div>
</div>

<div id="emailexist" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content"  style="background-color: orange;">
			<div class="modal-body">
				<center style="color: #fff; font-size:25px;">
					<?php echo lang('email_exist'); ?>
				</center>
			</div>
		</div>
	</div>
</div>

<div id="emailnotexist" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content"  style="background-color: orange;">
			<div class="modal-body">
				<center style="color: #fff; font-size:25px;">
					<?php echo lang('email_not_exist'); ?>
				</center>
			</div>
		</div>
	</div>
</div>

<div id="codeexist" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content"  style="background-color: orange;">
			<div class="modal-body">
				<center style="color: #fff; font-size:25px;">
					<?php echo lang('code_exist'); ?>
				</center>
			</div>
		</div>
	</div>
</div>