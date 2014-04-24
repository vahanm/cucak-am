<script>
	$(document).ready(function(){
		if($('a[rel^=lightbox], area[rel^=lightbox]').length > 0) {
			$('#mainimage').css('cursor', 'pointer');
		}
	});

	function openImages() {
		//$('a[rel^=lightbox], area[rel^=lightbox]').find(':last').trigger('click');
		$('a[rel^=lightbox]:first, area[rel^=lightbox]:first').trigger('click');
	}
</script>


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
$catfile = _v('thumbnail');

if(!$catfile)
{
	$catfile = '/wp-includes/images/categories/' . _v('cat') . '.png';
	
	if(!file_exists('.' . $catfile))
	{
		$catfile = '/wp-includes/images/categories/default.png';
	}
}

//echo '<div id="mainimage" style="background-image: url(\'' . $catfile . '\');" onclick="scrollTo(\'#filebox\')"></div>';
echo '<div id="mainimage" style="background-image: url(\'' . $catfile . '\');" onclick="openImages()"></div>';

$pcont = '<table id="contacsandsummary">';

$val_userid = _v('userid');
$val_Location = _v('location');
$val_aname = _v('aname');
$val_phone = _v('phone');

$val_aemail_show = _v('email_show') ? true : ((isset($val_phone) && strlen($val_phone) > 3) ? false : true);
$val_aemail = $val_aemail_show ? _v('aemail') : '';

$val_contactperson = _v('contactperson');
$val_contacttimes_begin = _v('contacttimes_begin');
$val_contacttimes_end = _v('contacttimes_end');

if($val_userid > 0 && $val_userid != 2)
{
	$val_Location = get_user_meta($val_userid, 'location', true);
	$val_aname = get_user_meta($val_userid, 'display_name', true);
	$val_phone = get_user_meta($val_userid, 'phone', true);
	$val_aemail = get_user_meta($val_userid, 'email', true);
	$val_contactperson = get_user_meta($val_userid, 'contactperson', true);
	$val_contacttimes_begin = get_user_meta($val_userid, 'contacttimes_begin', true);
	$val_contacttimes_end = get_user_meta($val_userid, 'contacttimes_end', true);
	$val_user_url = get_user_meta($authorId, 'user_url', true);
}

if($val_Location)
	$pcont .= '<tr><td><strong>' . __('Location') . '</strong></td><td>' . getRegionString($val_Location) . '</td></tr>';

if($val_userid == 2)
	$pcont .= '<tr><td><strong>' . __('Name') . '</strong></td><td>' . $val_aname . '</td></tr>';
else
	$pcont .= '<tr><td><strong>' . __('Name') . '</strong></td><td onmouseover="tooltip_m(this,\'tip-author\')" onmouseout="hide_info_m(this,\'tip-author\')">' . $val_aname . ' &nbsp;&nbsp;&nbsp; <a href="?author=' . $val_userid . '">(' . __('view all posts by this user') . ')</a></td></tr>';

$pcont .= '<tr><td><strong>' . __('Phone') . '</strong></td><td><a href="callto:' . $val_phone . '">' . $val_phone . '</a></td></tr>';

if(isset($val_aemail) && strlen($val_aemail) > 3)
	$pcont .= '<tr><td><strong>' . __('E-Mail') . '</strong></td><td><a href="mailto:' . $val_aemail . '">' .  $val_aemail. '</a></td></tr>';

if(isset($val_user_url) && strlen($val_user_url) > 3)
	$pcont .= '<tr><td><strong>' . __('Web page') . '</strong></td><td><a target="_new" href="' . $val_user_url . '">' . $val_user_url . '</a></td></tr>';

$contactpersons = array( 
	1 => __('private'),  
	2 => __('company'),  
	3 => __('intermediary')
	);
	
if($val_contactperson)
	$pcont .= '<tr><td><strong>' . __('Contact person') . '</strong></td><td>' . $contactpersons[$val_contactperson] . '</td></tr>';

if($val_contacttimes_begin)
	$pcont .= '<tr><td><strong>' . __('Desirable contact time') . '</strong></td><td>' . ($val_contacttimes_begin - 1) . ':00<span> - </span>' . ($val_contacttimes_end - 1) . ':00</td></tr>';
else
	$pcont .= '<tr><td><strong>' . __('Desirable contact time') . '</strong></td><td>' . __('any time') . '</td></tr>';



if(_v('allow_donation'))
{
	$pcont .= '<tr><td colspan="2"><strong>' . __('This is a donation..!!!') . '</strong>';
	$pcont .= '</td></tr>';
} else {
	if(_v('allow_sale'))
	{
		$pcont .= '<tr><td><strong>';
		$pcont .= __('Sale price') . '</td><td>';
		$pcont .= '<span onmouseover="tooltip_m(this,\'tip-sale\')" onmouseout="hide_info_m(this,\'tip-sale\')">';
		
		switch(_v('sale_contract'))
		{
			case 0:
				$pcont .= cur_Format(_v('sale_price') . ' ' . _v('sale_currency')) . ' ' . pricetype_final();
				break;
			case 1:
				$pcont .= cur_Format(_v('sale_price') . ' ' . _v('sale_currency')) . ' ' . pricetype_approximate();
				break;
			case 2:
				$pcont .= pricetype_negotiation();
				break;
		}
		
		$pcont .= '</span>';
		
		$pcont .= '<div id="tip-sale" class="abs">';
		
		if(_v('sale_contract') == 0)
			$pcont .= pricetype_tooltip_final();
		
		if(_v('sale_contract') == 1)
			$pcont .= pricetype_tooltip_approximate();
		
		$pcont .= str_replace('\r', '', cur_ConvertedStringVal(_v('sale_price'), _v('sale_currency')));
		
		$pcont .= '</div>';
	}
	
	if(_v('allow_rent'))
	{
		$pcont .= '<tr><td><strong>';
		$pcont .= __('Rent price') . '</td><td>';
		$pcont .= '<span onmouseover="tooltip_m(this,\'tip-rent\')" onmouseout="hide_info_m(this,\'tip-rent\')">';
		
		switch(_v('rent_contract'))
		{
			case 0:
				$pcont .= __(_v('rent_frequency')) . ' ' . cur_Format(_v('rent_price') . ' ' . _v('rent_currency')) . ' ' . ( _v('rent_minleaseterm') > 0 ? __('minimal') . ' ' . _v('rent_minleaseterm') . ' ' . _a('[rent_measure]') : '') . ' ' . pricetype_final();
				break;
			case 1:
				$pcont .= __(_v('rent_frequency')) . ' ' . cur_Format(_v('rent_price') . ' ' . _v('rent_currency')) . ' ' . ( _v('rent_minleaseterm') > 0 ? __('minimal') . ' ' . _v('rent_minleaseterm') . ' ' . _a('[rent_measure]') : '') . ' ' . pricetype_approximate();
				break;
			case 2:
				$pcont .= pricetype_negotiation();
				break;
		}
		
		$pcont .= '</span>';
		
		$pcont .= '<div id="tip-rent" class="abs">';
		
		if(_v('sale_contract') == 0)
			$pcont .= pricetype_tooltip_final();
		
		if(_v('sale_contract') == 1)
			$pcont .= pricetype_tooltip_approximate();
		
		$pcont .= str_replace('\r', '', cur_ConvertedStringVal(_v('rent_price'), _v('rent_currency')));
		
		$pcont .= '</div>';
	}
	
	if(_v('allow_exchange'))
	{
		if(_v('exchange_with'))
		{
			$pcont .= '<tr><td><strong>' . __('Exchange with') . '</td><td></strong>' . _v('exchange_with');
		}
		else
		{
			$pcont .= '<tr><td><strong>' . __('Possibility for exchange') . '</td><td></strong>';
		}
	}
	
	if(_v('allow_payment'))
	{
		$pcont .= '<tr><td><strong>' . __('Payment') . '</td><td></strong>';

		if( ! (_v('payment_type') == 2 && _v('payment') == '') )
		{
			$pcont .= __(_v('payment_frequency')) . ' ' . cur_Format(_v('payment') . ' ' . _v('payment_currency'));
		}

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
	}
	
	if(_v('allow_salary'))
	{
		$pcont .= '<tr><td><strong>' . __('Salary') . '</td><td></strong>';

		if( ! (_v('salary_type') == 2 && _v('salary') == '') )
		{
			$pcont .= __(_v('payment_frequency')) . ' ' . cur_Format(_v('salary') . ' ' . _v('payment_currency'));
		}

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
	}
}

$link = _v('link');
if($link)
{
	if( ! ( preg_match("/\bhttp\b/i", $link) || preg_match("/\bhttps\b/i", $link) ) )
	{
		$link = 'http://' . $link;
	}
	$pcont .= '<tr><td><strong>' . __('Web link') . '</td><td></strong><a target="_blank" href="' . $link . '">' . _v('link') . '</a></td></tr>';
}







$pcont .= '</table>';

echo $pcont;

?>
<div id="tip-author" class="post-meta-author abs" style="width: 400px;">
	<div class="author-info">
		<div style="float: left;">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpmuorg_author_bio_avatar_size', 50 ) ); ?>
		</div>
		<div style="float: left;">
			<h3><?php echo get_the_author(); ?></h3>
			<p><?php the_author_meta( 'description' ); ?></p>
		</div>
	</div>
</div>
