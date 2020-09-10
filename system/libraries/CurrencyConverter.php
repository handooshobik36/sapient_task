<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class CurrencyConverter
{
   public function __construct(){}   
   
   public function convert($from_currency,$to_currency,$amount)
   {
   /*echo "hi";
   	echo $from_currency;echo "sdjk";echo $amount;exit;*/
   		// convert the base amount of $from_currency SEK which is the base currency of convertion metrics
   		if($from_currency==$to_currency){
   			$final_price=$amount;
		} else {
			   $CI =& get_instance();
		   			if($to_currency!='MYR')
			   		{

			   			$CI->db->select('value');
				        $CI->db->from('currency_converter_usd');
				        $CI->db->where('currency_code', $from_currency);
				        $query = $CI->db->get();
						
						$from_currency_baseprice = $query->row()->value;
						$base_price_to_USD = $amount/$from_currency_baseprice; 
						
						
						$CI =& get_instance();
				   		$CI->db->select('value');
				        $CI->db->from('currency_converter_usd');
				        $CI->db->where('currency_code', $to_currency);
				        $query = $CI->db->get();
						$to_currency_baseprice = $query->row()->value;
						//echo $to_currency_baseprice;exit;
						$final_price = $base_price_to_USD * $to_currency_baseprice;
						$final_price=number_format((double)$final_price, 2, '.', '');
			   		} else if($to_currency=='MYR'){
			   			$CI->db->select('value');
				        $CI->db->from('currency_converter_usd');
				        $CI->db->where('currency_code', $from_currency);
				        $query = $CI->db->get();
						$from_currency_baseprice = $query->row()->value;
						$final_price = $amount/$from_currency_baseprice;
						$final_price=number_format((double)$final_price, 2, '.', '');
			   		}	
					
   		}
   		
		return($final_price);
   }

   public function get_currentCurrency()
   {
   	$CI =& get_instance();
   	$CI->load->library('session');
	$default_currency = $CI->session->userdata('currency');
	$default_currency_array = array();
		
		if(!isset($default_currency) || empty($default_currency)){
			 $config_currency = $CI->config->item('default_currency_language');
			if(!isset($default_currency) || empty($default_currency)){
				$default_currency_array='USD';
			} else {
				$default_currency_array=$config_currency;
			}
		} else {
			$default_currency_array=$default_currency;
		} 
		return $default_currency_array;
   }
}

?>
