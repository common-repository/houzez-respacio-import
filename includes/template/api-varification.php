<?php 
/* Property API key Verifications */
$property_export = get_option( 'property_export');
$property_verification_api = !empty(sanitize_text_field($_POST['property_verification_api'])) ? sanitize_text_field($_POST['property_verification_api']) : "";
$message_btn = "";
if(!isset($error)){
	$error = "";
}
if(!isset($message)){
	$message = "";
}

global $wpdb, $prop_web_name,$prop_options, $prop_messages;
$sa_apikey_verify = get_option( 'verify_api');
$sa_apikey = get_option( 'property_verification_api');
$sync_type = get_option( 'sync_type');
$message1 = "";
if(sanitize_text_field($_POST['property_sync_property'])){
	$method = 'POST';
	$data['lang_code'] = "en";
	$property_sync = property_syncing_cb();
	$property_sync_json = json_decode($property_sync,true);
	if($property_sync_json['is_record'] != 0){
		$data['json_data']=$property_sync;
		$ws_name = $prop_web_name['prop_sync_website'];
		$result = sa_verify_api_curl($ws_name,$data,$method);
		$finalres = json_decode($result);
		if(!empty($finalres) && $finalres->status == "success"){
			$wpdb->update('properties',
			array(
			    'property_export_success' => 1,
			    'property_export_date' => date('Y-m-d H:i:s')
			),
			array('property_export_success' => 0) );
			update_option('property_export',4);
			$message = '<span class="verifiedmsg verifiedsuccess">'.$prop_messages['prop_export_success'].'</span>';
		}else{
			update_option('property_export',3);
		}
	}else{
		$message = '<span class="verifiedmsg verifiedsuccess">'.$prop_messages['prop_no_synced'].' </span>';
	}	
}
?>


	<div class="respacio-notice">
        <form action="" method="post">
            <h2 class="activation_title">Activate Respacio</h2>
            <p>Enter your website API key from your Respacio CRM. </p>
            
            <?php if(!empty($sa_apikey_verify) && !empty($sa_apikey)) { ?>
				
				<div id="title-wrap" class="input-text-wrap">
					<label id="api_key_prompt_text" class="prompt" for="api_key"></label>
					
					<input type="text" disabled='' name="remove_api" value="<?php echo get_option( 'property_verification_api'); ?>" id="respacio_verification_key" spellcheck="true" autocomplete="on">
				</div>				
				<input type="submit" name="remove_licence_key" value="Remove license key" id="verify_button" class="btn btn-submit verify_button"/>
				
			<?php } else { ?>
			
			<div id="title-wrap" class="input-text-wrap">
                <label id="api_key_prompt_text" class="prompt" for="api_key"> Enter your purchase key </label>
                <input type="text" name="property_verification_api" size="30" autocomplete="off" value="<?php echo get_option( 'property_verification_api'); ?>" id="respacio_verification_key" spellcheck="true" autocomplete="on" placeholder="Enter your API key">
            </div>
			
			<input type="submit" name="property_verification_submit" value="Verify" href="#" id="verify_button" class="btn btn-submit verify_button"/>
		<?php } ?>
        </form>
		
		<div id="sk_options_license_information" class="sa-sub-pane">
		<div class="sa-groupset-holder1 light-groupset1">
			<div class="sa-groupset-heading"></div>
			<div class="sa-single-option">
				<div class="register-product__message res-success-msg"><?php echo $message; ?></div>
				<div class="register-product__message res-error-msg"><?php echo $error; ?></div>
			</div>
		</div>
        </div>
	</div>