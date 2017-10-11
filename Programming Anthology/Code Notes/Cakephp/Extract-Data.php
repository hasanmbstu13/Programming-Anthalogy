<?php 

// Load Model if any Model is not available
$this->loadModel('RestaurantPayment');
$this->loadModel('RestaurantTransaction');
$this->loadModel('OrdersH');
$this->loadModel('Restaurant');

// Extract Data in following way
$total = $this->RestaurantPayment->find('all', array(
					'fields' => "SUM(RestaurantPayment.final_restro_amt) as Total ",
					'conditions' => array(
					    'RestaurantPayment.is_post' => 0,
					    'RestaurantPayment.restaurant_transaction_id' => 0   
					    ),
			  	  ));

// Raw query in Cakephp 
$sql = "SELECT SUM(  `OrdersH`.`net_amt` ) AS Total
		FROM  `pikdish_onlinemenu`.`om_orders_h` AS  `OrdersH` 
		LEFT JOIN  `pikdish_onlinemenu`.`om_restaurant_tables` AS  `RestaurantTables` ON (  `OrdersH`.`restaurant_tables_id` =  `RestaurantTables`.`id` ) 
		LEFT JOIN  `pikdish_onlinemenu`.`om_users` AS  `User` ON (  `OrdersH`.`user_id` =  `User`.`id` ) 
		WHERE  `OrdersH`.`order_complete` =1
		AND  `OrdersH`.`payment_recieved` =1
		AND DATE( OrdersH.entry_date ) =  "."'".date("Y-m-d")."'".
		" AND  `OrdersH`.`restaurant_id` = $curr_user_restuarant_id";

$today_collection = $this -> OrdersH -> query($sql);


// if mysql date isn't working in the cakephp query then using following one
$sql = "SELECT COUNT(*) AS Total
				FROM  `pikdish_onlinemenu`.`om_restaurant_transaction` AS  `Transaction`  
				WHERE  `Transaction`.`cr_amt` > 0
				AND DATE( Transaction.entry_date ) =  "."'".date("Y-m-d")."'";

$total_cash = $this -> RestaurantTransaction -> query($sql);

// pass data in View 
$this -> set(compact('pending_payment', 'restaurant_trans_total', 'wallet_payment', 'payment_release_list','today_collection', 'total_rows_trans_cash'));