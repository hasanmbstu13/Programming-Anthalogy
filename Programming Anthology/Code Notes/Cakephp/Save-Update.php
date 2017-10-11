<?php 

// Create new record in db
$data = array(
		'pikdish_vch_no' => $restaurant['0']['Restaurant']['vch_no'] + 1,
		'restaurant_id' =>  $curr_user_restuarant_id,
		'restro_vch_no' => $counter['0']['Counter']['vch_no'] + 1,
		'entry_date' => date("Y-m-d H:i:s",time()),
		'ref' => $restaurant['0']['Restaurant']['vch_no'] + 1,
		'dr_amt' => 0,
		'cr_amt' => (empty($restau_trans_amount['0']['0']['Total']))? 0 : $restau_trans_amount['0']['0']['Total'],
		// 'bank_trans_code' => '',
	);

$this->RestaurantTransaction->create();

if($this->RestaurantTransaction->save($data)){
	$last_inserted_trans_id = $this->RestaurantTransaction->getInsertID();
	$data = array(
		// 'restaurant_id' => $curr_user_restuarant_id, 
		'is_post' => 1,
		'restaurant_transaction_id' => $last_inserted_trans_id
	);
	// This will update RestaurantPayment with restaurant_id
	if($this->RestaurantPayment->updateAll($data, array('RestaurantPayment.restaurant_id' => $curr_user_restuarant_id))){
		$this->Session->setFlash(__('Cash is successfully transferred.'), 'default', array('class'=>'alert alert-success'));
		return $this->redirect(array( 'action' => 'index' ));
	}
}


// Get last inserted id
$last_inserted_trans_id = $this->RestaurantTransaction->getInsertID();