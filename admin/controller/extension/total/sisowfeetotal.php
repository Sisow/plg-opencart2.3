<?php
class ControllerExtensionTotalSisowFeeTotal extends Controller {
    public function index() {
        $this->load->language('extension/total/sisowfeetotal');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('sisowfeetotal', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=total', true));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_none'] = $this->language->get('text_none');

        $data['entry_total'] = $this->language->get('entry_total');
        $data['entry_fee'] = $this->language->get('entry_fee');
        $data['entry_tax_class'] = $this->language->get('entry_tax_class');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=total', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/total/sisowfeetotal', 'token=' . $this->session->data['token'], true)
        );

        $data['action'] = $this->url->link('extension/total/sisowfeetotal', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=total', true);

        if (isset($this->request->post['sisowfeetotal_status'])) {
            $data['sisowfeetotal_status'] = $this->request->post['sisowfeetotal_status'];
        } else {
            $data['sisowfeetotal_status'] = $this->config->get('sisowfeetotal_status');
        }

        if (isset($this->request->post['sisowfeetotal_sort_order'])) {
            $data['sisowfeetotal_sort_order'] = $this->request->post['sisowfeetotal_sort_order'];
        } else {
            $data['sisowfeetotal_sort_order'] = $this->config->get('sisowfeetotal_sort_order');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/total/sisowfeetotal', $data));
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'extension/total/sisowfeetotal')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}