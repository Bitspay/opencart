<?php 
class ControllerPaymentBitspay extends Controller {
	private $error = array(); 

	public function index() {
		$this->language->load('payment/bitspay');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		   if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			         $data['base'] = HTTPS_CATALOG;
		      } else {
			         $data['base'] =HTTP_CATALOG;
      		}	
   
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('bitspay', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		
		$data['entry_bitspaymerchant'] = $this->language->get('entry_bitspaymerchant');
		$data['entry_bitspaysecretkey'] = $this->language->get('entry_bitspaysecretkey');
		$data['entry_bitspaytoken'] = $this->language->get('entry_bitspaytoken');
		$data['entry_order_status'] = $this->language->get('entry_order_status');		
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		 
        
        if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
           $php_version_allowed = true ;
         }
        else{
          $php_version_allowed = false ;
          $this->error['warning'] = 'The minimum PHP version required for bitspay plugin is 5.3.0';
        }
        
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['bitspaymerchant'])) {
			$data['error_bitspaymerchant'] = $this->error['bitspaymerchant'];
		} else {
			$data['error_bitspaymerchant'] = '';
		}	
		
		if (isset($this->error['bitspaysecretkey'])) {
			$data['error_bitspaysecretkey'] = $this->error['bitspaysecretkey'];
		} else {
			$data['error_bitspaysecretkey'] = '';
		}
		
		if (isset($this->error['bitspaytoken'])) {
			$data['error_bitspaytoken'] = $this->error['bitspaytoken'];
		} else {
			$data['error_bitspaytoken'] = '';
		}		
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/bitspay', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
		$data['action'] = $this->url->link('payment/bitspay', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['bitspay_bitspaymerchant'])) {
			$data['bitspay_bitspaymerchant'] = $this->request->post['bitspay_bitspaymerchant'];
		} else {
			$data['bitspay_bitspaymerchant'] = $this->config->get('bitspay_bitspaymerchant');
		}

		if (isset($this->request->post['bitspay_bitspaysecretkey'])) {
			$data['bitspay_bitspaysecretkey'] = $this->request->post['bitspay_bitspaysecretkey'];
		} else {
			$data['bitspay_bitspaysecretkey'] = $this->config->get('bitspay_bitspaysecretkey');
		}
 
				
		if (isset($this->request->post['bitspay_order_status_id'])) {
			$data['bitspay_order_status_id'] = $this->request->post['bitspay_order_status_id'];
		} else {
			$data['bitspay_order_status_id'] = $this->config->get('bitspay_order_status_id'); 
		}
		
		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['bitspay_geo_zone_id'])) {
			$data['bitspay_geo_zone_id'] = $this->request->post['bitspay_geo_zone_id'];
		} else {
			$data['bitspay_geo_zone_id'] = $this->config->get('bitspay_geo_zone_id'); 
		}
		
		$this->load->model('localisation/geo_zone');
										
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['bitspay_status'])) {
			$data['bitspay_status'] = $this->request->post['bitspay_status'];
		} else {
			$data['bitspay_status'] = $this->config->get('bitspay_status');
		}
		
		if (isset($this->request->post['bitspay_sort_order'])) {
			$data['bitspay_sort_order'] = $this->request->post['bitspay_sort_order'];
		} else {
			$data['bitspay_sort_order'] = $this->config->get('bitspay_sort_order');
		}

	
				$data['header'] = $this->load->controller('common/header');
						$data['column_left'] = $this->load->controller('common/column_left');

		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/bitspay.tpl', $data));

	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/bitspay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['bitspay_bitspaymerchant']) {
			$this->error['bitspaymerchant'] = $this->language->get('entry_bitspaymerchant');
		}

		if (!$this->request->post['bitspay_bitspaysecretkey']) {
			$this->error['bitspaysecretkey'] = $this->language->get('entry_bitspaysecretkey');
		}
		
		return !$this->error;
	}
}
?>