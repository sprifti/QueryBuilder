<?php
	require_once('connect.php');

	if(isset($_POST["product"])){
		$product = $_POST["product"];
	}

	if(isset($_POST["current"])){
		$from_col = $_POST["current"];
	}

	if(isset($_POST["request"])){
		$to_col = $_POST["request"];
	}


	$db = Db::getInstance();
	$result = $db->prepare("SELECT rule FROM rules WHERE from_col = :from_col AND to_col = :to_col ");
	$result->execute(array(':from_col' => $from_col, ':to_col' => $to_col ));
	$rule = $result->fetch();

	
	$result = $db->prepare("SELECT name FROM phase WHERE id = :from_col ");
	$result->execute(array(':from_col' => $from_col));
	$from = $result->fetch();



	$result = $db->prepare("SELECT name FROM phase WHERE id = :to_col ");
	$result->execute(array(':to_col' => $to_col));
	$to = $result->fetch();
	

	
	$rules = json_decode($rule["rule"],TRUE);
	
$i=0; 
	
foreach ($rules["rules"] as $key => $rule) {

	if( $rules["condition"] == "AND" ){
		
			//IS EMPTY OR IS NULL

			if($rule["operator"] == "is_not_empty" ){
				if(!empty($product[$rule["field"]])){
					$i++;
					$error = false;
				}
				else{
					echo $rule["field"]." "."cannot be empty";
					$error = true;
				}
			}

			if( $rule["operator"] == "begins_with" ){
				if( strpos($product[$rule["field"]], $rule["value"]) === 0   ){
					$i++;
					$error = false;
				}
				else{ 
					if($error != true) {
						echo $rule["field"]." "."should begin with"." ".$rule["value"];
						$error = true;
					}
				}
			}
			if( $rule["operator"] == "equal" ){
				if( $product[$rule["field"]] == $rule["value"] ){
					$i++;
					$error = false;
				}
				else{ 
					if($error != true) {
						echo $rule["field"]." "."should be equal to"." ".$rule["value"];
						$error = true;
					}
				}
				
			}
			if( $rule["operator"] == "less_or_equal" ){
				if( $product[$rule["field"]] <= $rule["value"] ){
					$i++;
					$error = false;
				}
				else{ 
					if($error != true) {
						echo $rule["field"]." "."should be less than"." ".$rule["value"];
						$error = true;
					}
				}
			}
			if( $rule["operator"] == "greater_or_equal" ){
				if( $product[$rule["field"]] <= $rule["value"] ){
					$i++;
					$error = false;
				}
				else{ 
					if($error != true) {
						echo $rule["field"]." "."should be greater than"." ".$rule["value"];
						$error = true;
					}
				}
			}

			if($i == count($rules["rules"])){
				$product["status"] = $to["name"];
				print_r($product);
			}

		}

else if( $rules["condition"] == "OR" ){
		
			//IS EMPTY OR IS NULL

		if($rule["operator"] == "is_not_empty" ){
				if(!empty($product[$rule["field"]])){
					$i++;
					$error = false;
				}
				else{
					echo $rule["field"]." "."cannot be empty";
					$error = true;
				}
			}

			else if( $rule["operator"] == "begins_with" ){
				if( strpos($product[$rule["field"]], $rule["value"]) === 0   ){
					$i++;
					$error = false;
				}
				else{ 
					if($error != true) {
						echo $rule["field"]." "."should begin with"." ".$rule["value"];
						$error = true;
					}
				}
			}
			else if( $rule["operator"] == "equal" ){
				if( $product[$rule["field"]] == $rule["value"] ){
					$i++;
					$error = false;
				}
				else{ 
					if($error != true) {
						echo $rule["field"]." "."should be equal to"." ".$rule["value"];
						$error = true;
					}
				}
				
			}

			else if( $rule["operator"] == "less_or_equal" ){
				if( $product[$rule["field"]] <= $rule["value"] ){
					$i++;
					$error = false;
				}
				else{ 
					if($error != true) {
						echo $rule["field"]." "."should be less than"." ".$rule["value"];
						$error = true;
					}
				}
			}
			else if( $rule["operator"] == "greater_or_equal" ){
				if( $product[$rule["field"]] <= $rule["value"] ){
					$i++;
					$error = false;
				}
				else{ 
					if($error != true) {
						echo $rule["field"]." "."should be greater than"." ".$rule["value"];
						$error = true;
					}
				}
			}
			if($i <= count($rules["rules"]) && $i != 0){
			$product["status"] = $to["name"];

			}
		}

		

		
	}
	

		



	
	?>