<?php
if (!function_exists('pricetype_tooltip_final'))
{
	function pricetype_tooltip_final()
	{
		return '<div class="pricetype_tooltip pricetype_final">' . __('final') . '</div>';
	}
}
if (!function_exists('pricetype_tooltip_approximate'))
{
	function pricetype_tooltip_approximate()
	{
		return '<div class="pricetype_tooltip pricetype_approximate">' . __('approximate') . '</div>';
	}
}
if (!function_exists('pricetype_tooltip_negotiation'))
{
	function pricetype_tooltip_negotiation()
	{
		return '<div class="pricetype_tooltip pricetype_negotiation" style="width: 160px; margin: 0;">' . __('by negotiation') . '</div>';
	}
}

$authorId = _v('userid');

$user_id = get_current_user_id();

$post_id = get_the_ID();
$post = & get_post($post_id);
$post_type = $post->post_type;
$post_type_object = get_post_type_object( $post_type );

$isOwner = $user_id > 0 && ($post->post_author == $user_id);
$canEdit = $user_id > 0 && ($isOwner || current_user_can($post_type_object->cap->delete_post, $post_id));

$pcont = '<div id="itemprices_sidebar">';

$val_userid = _v('userid');

if(_v('allow_donation'))
{
	$pcont .= '<div><div colspan="2">' . __('This is a donation..!!!') . '';
	$pcont .= '</div><strong></strong></div>';
} else {
	if(_v('allow_sale'))
	{
		$pcont .= '<div class="item-price">';
		
		$pcont .= '<div class="itemprice-title">';
        $pcont .= __('Sale price');
        
		if ($canEdit && _v('sale_contract') < 2) {
			$pcont .= '<a style="margin-left: 4px;" href="javascript:updatePrice(' . $post_id . ', \'' . getEditKey($post_id) . '\', ' . _v('sale_price') . ', \'sale_price\')" title="' . __( 'Change sale price' ) . '">';
            $pcont .= '<img class="sidebar-contacts-icon" style="float: right;" alt="" src="' . site_url('/wp-includes/images/sidebar-controls/1364240521_pencil.png') . '" />';
            $pcont .= '</a>';
        }
        
        $pcont .= '</div>';
		
			$pcont .= '<div>';
				$pcont .= '<span onmouseover="tooltip_m(this,\'tip-sale\')" onmouseout="hide_info_m(this,\'tip-sale\')">';
                
				switch(_v('sale_contract'))
				{
					case 0: case 1:
                        
                        if (_v('sale_price_previous')) {
						    $pcont .= '<span style="font-size: 115%; color: #030"><strong>' . cur_Format(_v('sale_price') . ' ' . _v('sale_currency')) . '</strong></span><br/>';
                            /*
						    if ($canEdit) {
						        $pcont .= '<a style="margin-left: 4px;" href="javascript:updatePrice(' . $post_id . ', \'' . getEditKey($post_id) . '\', ' . _v('sale_price') . ')">(' . __( 'change' ) . ')</a><br/>';
                            }
                            */
                            $pcont .= '<span style="font-size: 90%; text-decoration: line-through; color: #734"><strong> ' . cur_Format(_v('sale_price_previous') . ' ' . _v('sale_currency')) . ' </strong></span><br/>';
                        } /*elseif ($canEdit) {
						    $pcont .= '<strong>' . cur_Format(_v('sale_price') . ' ' . _v('sale_currency')) . '</strong>';
						    $pcont .= '<a style="margin-left: 4px;" href="javascript:updatePrice(' . $post_id . ', \'' . getEditKey($post_id) . '\', ' . _v('sale_price') . ')">(' . __( 'change' ) . ')</a><br/>';
                        }*/ else {
						    $pcont .= '<strong>' . cur_Format(_v('sale_price') . ' ' . _v('sale_currency')) . '</strong><br/>';
                        }
						break;
				}
				
				switch(_v('sale_contract'))
				{
					case 0:
						$pcont .= pricetype_final();
						break;
					case 1:
						$pcont .= pricetype_approximate();
						break;
					case 2:
						$pcont .= pricetype_negotiation();
						break;
				}
		
				$pcont .= '</span>';
		
				//$pcont .= '<div id="tip-sale" class="abs">';
				//
				//if(_v('sale_contract') == 0)
				//	$pcont .= pricetype_tooltip_final();
				//
				//if(_v('sale_contract') == 1)
				//	$pcont .= pricetype_tooltip_approximate();
				//
				//$pcont .= str_replace('\r', '', cur_ConvertedStringVal(_v('sale_price'), _v('sale_currency')));
				//
				//$pcont .= '</div>';
		
			$pcont .= '</div>';
			
		$pcont .= '</div>';
	}
	
	if(_v('allow_rent'))
	{
		$pcont .= '<div class="item-price">';
		$pcont .= '<div class="itemprice-title">';
        $pcont .= __('Rent price');
        
		if ($canEdit && _v('rent_contract') < 2) {
			$pcont .= '<a style="margin-left: 4px;" href="javascript:updatePrice(' . $post_id . ', \'' . getEditKey($post_id) . '\', ' . _v('rent_price') . ', \'rent_price\')" title="' . __( 'Change rent price' ) . '">';
            $pcont .= '<img class="sidebar-contacts-icon" style="float: right;" alt="" src="' . site_url('/wp-includes/images/sidebar-controls/1364240521_pencil.png') . '" />';
            $pcont .= '</a>';
        }
        
        $pcont .= '</div>';
        
		$pcont .= '<div><span onmouseover="tooltip_m(this,\'tip-rent\')" onmouseout="hide_info_m(this,\'tip-rent\')">';
		
		switch(_v('rent_contract'))
		{
			case 0: case 1:
				$pcont .= '<strong>' . __(_v('rent_frequency')) . ' ' . cur_Format(_v('rent_price') . ' ' . _v('rent_currency')) . '</strong><br/>';
				$pcont .= ( _v('rent_minleaseterm') > 0 ? __('minimal') . ' ' . _v('rent_minleaseterm') . ' ' . _a('[rent_measure]') . '<br />' : '');
				break;
		}
		
		switch(_v('rent_contract'))
		{
			case 0:
				$pcont .= pricetype_final();
				break;
			case 1:
				$pcont .= pricetype_approximate();
				break;
			case 2:
				$pcont .= pricetype_negotiation();
				break;
		}
		
		$pcont .= '</span>';
		
		//$pcont .= '<div id="tip-rent" class="abs">';
		//
		//if(_v('sale_contract') == 0)
		//	$pcont .= pricetype_tooltip_final();
		//
		//if(_v('sale_contract') == 1)
		//	$pcont .= pricetype_tooltip_approximate();
		//
		//$pcont .= str_replace('\r', '', cur_ConvertedStringVal(_v('rent_price'), _v('rent_currency')));
		//$pcont .= '</div>';
		
		$pcont .= '</div>';
		
		$pcont .= '</div>';
	}
	
	if(_v('allow_exchange'))
	{
		if(_v('exchange_with'))
		{
			$pcont .= '<div class="item-price"><div class="itemprice-title">' . __('Exchange with') . '</div><div><strong>' . _v('exchange_with') . '</strong></div></div>';
		}
		else
		{
			$pcont .= '<div class="item-price"><div class="itemprice-title">' . __('Possibility for exchange') . '</div><div><strong></strong></div></div>';
		}
	}
	
	if(_v('allow_payment'))
	{
		$pcont .= '<div class="item-price"><div class="itemprice-title">' . __('Payment') . '</div><div>';

		if( ! (_v('payment_type') == 2 && _v('payment') == '') )
		{
			$pcont .= '<strong>' . __(_v('payment_frequency')) . ' ' . cur_Format(_v('payment') . ' ' . _v('payment_currency')) . '</strong>';
		}

		$pcont .= '<br />';

		switch(_v('payment_type'))
		{
			case 0:
				$pcont .= paymenttype_final();
				break;
			case 1:
				$pcont .= paymenttype_piecework();
				break;
			case 2:
				$pcont .= paymenttype_negotiation();
				break;
		}
		$pcont .= '</div>';
		$pcont .= '</div>';
	}
	
	if(_v('allow_salary'))
	{
		$pcont .= '<div class="item-price"><div class="itemprice-title">' . __('Salary') . '</div><div>';

		if( ! (_v('salary_type') == 2 && _v('salary') == '') )
		{
			$pcont .= '<strong>' . __(_v('payment_frequency')) . ' ' . cur_Format(_v('salary') . ' ' . _v('payment_currency')) . '</strong>';
		}
		
		$pcont .= '<br />';
		
		switch(_v('salary_type'))
		{
			case 0:
				$pcont .= paymenttype_final();
				break;
			case 1:
				$pcont .= paymenttype_piecework();
				break;
			case 2:
				$pcont .= paymenttype_negotiation();
				break;
		}
		$pcont .= '</div>';
		$pcont .= '</div>';
	}
}

$pcont .= '</div>';

echo $pcont;
