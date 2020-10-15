<?php
class ModelExtensionTotalsisowFeeTotal extends Model {
    public function getTotal($total){
        if (!isset($this->session->data['payment_method']) || substr($this->session->data['payment_method']['code'], 0, 5) != "sisow") {
            return;
        }

        $fee = $this->config->get($this->session->data['payment_method']['code'].'_paymentfee');

        if (empty($fee))
            return;

        $this->load->language('extension/total/sisowfeetotal');

        if ($fee < 0) {
            $fee = round($total['total'] * -$fee / 100.0, 2);
        }

        $total['total'] += $fee;
        $total['totals'][] = array(
            'code'       => 'sisowfeetotal',
            'title'      => $this->language->get('text_sisowfeetotal'),
            'value'      => $fee,
            'sort_order' => $this->config->get('sisowfeetotal_sort_order')
        );

        $tax_rates = $this->tax->getRates($fee, $this->config->get($this->session->data['payment_method']['code'].'_fee_tax'));

        foreach ($tax_rates as $tax_rate) {
            if (!isset($total['taxes'][$tax_rate['tax_rate_id']])) {
                $total['taxes'][$tax_rate['tax_rate_id']] = $tax_rate['amount'];
            } else {
                $total['taxes'][$tax_rate['tax_rate_id']] += $tax_rate['amount'];
            }
        }
    }
}
