<?php 

include 'sisow/sisow.php';

class ControllerExtensionPaymentSisowKlaAcc extends ControllerExtensionPaymentSisow {
	public function index() {
		$this->_index('sisowklaacc');
	}

	public function validate() {
		return $this->_validate('sisowklaacc');
	}
}
?>
