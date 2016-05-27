<?php 
class ControllerPaymentGocoin extends Controller {
	private $error = array(); 

	public function index() {
		$this->language->load('payment/gocoin');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		   if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			         $data['base'] = HTTPS_CATALOG;
		      } else {
			         $data['base'] =HTTP_CATALOG;
      		}	
   
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('gocoin', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		
		$data['entry_gocoinmerchant'] = $this->language->get('entry_gocoinmerchant');
		$data['entry_gocoinsecretkey'] = $this->language->get('entry_gocoinsecretkey');
		$data['entry_gocointoken'] = $this->language->get('entry_gocointoken');
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
          $this->error['warning'] = 'The minimum PHP version required for GoCoin plugin is 5.3.0';
        }
        
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['gocoinmerchant'])) {
			$data['error_gocoinmerchant'] = $this->error['gocoinmerchant'];
		} else {
			$data['error_gocoinmerchant'] = '';
		}	
		
		if (isset($this->error['gocoinsecretkey'])) {
			$data['error_gocoinsecretkey'] = $this->error['gocoinsecretkey'];
		} else {
			$data['error_gocoinsecretkey'] = '';
		}
		
		if (isset($this->error['gocointoken'])) {
			$data['error_gocointoken'] = $this->error['gocointoken'];
		} else {
			$data['error_gocointoken'] = '';
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
			'href'      => $this->url->link('payment/gocoin', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
		$data['action'] = $this->url->link('payment/gocoin', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['gocoin_gocoinmerchant'])) {
			$data['gocoin_gocoinmerchant'] = $this->request->post['gocoin_gocoinmerchant'];
		} else {
			$data['gocoin_gocoinmerchant'] = $this->config->get('gocoin_gocoinmerchant');
		}

		if (isset($this->request->post['gocoin_gocoinsecretkey'])) {
			$data['gocoin_gocoinsecretkey'] = $this->request->post['gocoin_gocoinsecretkey'];
		} else {
			$data['gocoin_gocoinsecretkey'] = $this->config->get('gocoin_gocoinsecretkey');
		}
 
				
		if (isset($this->request->post['gocoin_order_status_id'])) {
			$data['gocoin_order_status_id'] = $this->request->post['gocoin_order_status_id'];
		} else {
			$data['gocoin_order_status_id'] = $this->config->get('gocoin_order_status_id'); 
		}
		
		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['gocoin_geo_zone_id'])) {
			$data['gocoin_geo_zone_id'] = $this->request->post['gocoin_geo_zone_id'];
		} else {
			$data['gocoin_geo_zone_id'] = $this->config->get('gocoin_geo_zone_id'); 
		}
		
		$this->load->model('localisation/geo_zone');
										
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['gocoin_status'])) {
			$data['gocoin_status'] = $this->request->post['gocoin_status'];
		} else {
			$data['gocoin_status'] = $this->config->get('gocoin_status');
		}
		
		if (isset($this->request->post['gocoin_sort_order'])) {
			$data['gocoin_sort_order'] = $this->request->post['gocoin_sort_order'];
		} else {
			$data['gocoin_sort_order'] = $this->config->get('gocoin_sort_order');
		}

	
				$data['header'] = $this->load->controller('common/header');
						$data['column_left'] = $this->load->controller('common/column_left');

		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/gocoin.tpl', $data));

	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/gocoin')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['gocoin_gocoinmerchant']) {
			$this->error['gocoinmerchant'] = $this->language->get('entry_gocoinmerchant');
		}

		if (!$this->request->post['gocoin_gocoinsecretkey']) {
			$this->error['gocoinsecretkey'] = $this->language->get('entry_gocoinsecretkey');
		}
		
		return !$this->error;
	}
}
?>