<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-bitspay" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
          <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      
	  <div class="panel-heading">
      <h1><img src="view/image/payment/bitspaylogo.png" alt="" /> <?php echo $heading_title; ?></h1>
     
    </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-bitspay">
        <table class="form">
          <tr>
            <td><?php echo $entry_bitspaymerchant; ?></td>
            <td><input type="text" name="bitspay_bitspaymerchant" id="bitspay_bitspaymerchant" value="<?php echo $bitspay_bitspaymerchant; ?>" />
                <input type="hidden" name="cid" id="cid" value="<?php echo $bitspay_bitspaymerchant; ?>" />
              <?php if ($error_bitspaymerchant) { ?>
              <span class="error"><?php echo $error_bitspaymerchant; ?></span>
              <?php } ?>
               
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_bitspaysecretkey; ?></td>
            <td><input type="text" name="bitspay_bitspaysecretkey" id="bitspay_bitspaysecretkey" value="<?php echo $bitspay_bitspaysecretkey; ?>" />
              <input type="hidden" name="csec" id="csec" value="<?php echo $bitspay_bitspaysecretkey; ?>" />
                <?php if ($error_bitspaysecretkey) { ?>
              <span class="error"><?php echo $error_bitspaysecretkey; ?></span>
              <?php } ?></td>
          </tr>
         
          <tr>
            <td><?php echo $entry_order_status; ?></td>
            <td><select name="bitspay_order_status_id">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $bitspay_order_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_geo_zone; ?></td>
            <td><select name="bitspay_geo_zone_id">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $bitspay_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="bitspay_status">
                <?php if ($bitspay_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="bitspay_sort_order" value="<?php echo $bitspay_sort_order; ?>" size="1" /></td>
          </tr>
          
           
        </table>
      </form>		  
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 