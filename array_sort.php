<?php
	foreach ($company_customer_count as $key => $value) {
			$name[$key] = $value['total'];
		}
	array_multisort($name, SORT_DESC,$company_customer_count);