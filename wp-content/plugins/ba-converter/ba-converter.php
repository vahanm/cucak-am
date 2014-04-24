<?PHP
/* Plugin Name: BA Currency converter
 * Plugin URI: http://www.vmv-pc.no-ip.org
 * Description: This plugin adds functions for currency conversion
 * Version: 1.0
 * Author: Vahan
 * Author URI: http://www.vmv-pc.no-ip.org
 * License: Vahan
**/

if (isset($_POST['save']) && isset($_POST['json'])) {
    if (!function_exists('replace_quotes_decode'))
    {
        function replace_quotes_decode($text) {
            $healthy = array('\\\'', '\"', '\\\\');
            $yummy   = array('\'', '"', '\\');
        
            $tmp = $text;
        
            $tmp = htmlspecialchars_decode($tmp, ENT_QUOTES);
            $tmp = str_replace($healthy, $yummy, $tmp);
            //$tmp = htmlspecialchars($tmp, ENT_QUOTES);
        
            return $tmp;
        }
    }

    if (file_put_contents(dirname(__FILE__) . "/currencies.json", replace_quotes_decode($_POST['json'])) !== false) {
        $_POST['saved'] = true;
    }
}

add_action('admin_menu', 'baconvert_admin_menus');

function baconvert_admin_menus() {
    add_menu_page('Converter', 'Converter', 1, 'ba-converter', 'renderConverter');
}

function renderConverter() {
    echo '<h1>Converter</h1>';
    
    ?>
    
    <iframe width="314" height="280" src="http://www.currency.am/api/rendertable?lang=en&mode=large&colorscheme=light" frameborder="0" scrolling="no" allowtransparency="true"></iframe>
    
    <?php
    
    currencies_update_form();
}

function cur_numformat($value) {
    $res = number_format(floor($value), 0, '.', ' ');
    $res .= '.';
    $res .= '<span style="font-size:80%">';
    
    $f = floor(100 * ($value - floor($value)));
    if($f < 10) {
        $res .= '0' . $f;
    } else {
        $res .= $f;
    }
    
    $res .= '</span>';
    return $res;
}

function cur_Format($str) {
    $sep = explode(' ', $str, 2);
    
    $value = $sep[0];
    $type = $sep[1];
    
    return cur_FormatVal($value, $type);
}

function cur_FormatVal($value, $type) {
    if(strlen($value) == false || strlen($type) == false)
        return '';
    
    return cur_numformat($value) . ' <span style="color: #992222">' . $type . '</span>';
}

function cur_ConvertedString($str) {
    $sep = explode(' ', $str, 2);
    
    $value = $sep[0];
    $from = $sep[1];
    
    return cur_ConvertedStringVal($value, $from);
}

function cur_ConvertedStringVal($value, $from) {
    $res = '<table style="width: 180px">';
    
    $res .= cur_AddConvetion($from, 'AMD', $value);
    $res .= cur_AddConvetion($from, 'USD', $value);
    $res .= cur_AddConvetion($from, 'EUR', $value);
    $res .= cur_AddConvetion($from, 'RUR', $value);
    
    //$res .= 'updated ' . cur_GetDate();
    $res .=	  '<tr style="border-top: solid 1px #AACCAA; ">'
                . '<td colspan="2" style="font-size: 80%;">'
                    . __('Currency was updated on')
                    . ' '
                    . cur_GetDate() . '</td>'
            . '</tr>'
            . '</table>';
    
    return $res;
}

function cur_ConvertedStringValuesSPAN($value, $from) {
    $res = '<span style="" class="conversions">';
    
    $res .= cur_AddConvetionSPAN($from, 'AMD', $value);
    $res .= cur_AddConvetionSPAN($from, 'USD', $value);
    $res .= cur_AddConvetionSPAN($from, 'EUR', $value);
    $res .= cur_AddConvetionSPAN($from, 'RUR', $value);
    $res .= '</span>';
    
    return $res;
}

function cur_AddConvetion($from, $to, $value) {
    if(!($from == $to) || true) {
        return '<tr>'
                . '<td>' . $to . '</td>'
                . '<td style="text-align: right;">' . cur_Convert($from, $to, $value) . '</td>'
             . '</tr>';
    } else {
        return '';
    }
}

function cur_AddConvetionSPAN($from, $to, $value) {
    return 	'<span class="'
        . (($from == $to) ? 'original' : 'conversion')
        . ' cur-' . $to . '">'
        . cur_Convert($from, $to, $value) . ' <span style="color: #992222">' . $to . '</span>'
        . '</span>';
}

function cur_AddConvetion2($from, $to, $value) {
    //if(!($from == $to))
    //{
        return cur_Convert($from, $to, $value) . ' ' . $to . ', ';
    //}
    //else
    //{
    //	return '';
    //}
}

function cur_GetConvetion($from, $to, $value) {
    return $value * cur_GetCurrency($from) / cur_GetCurrency($to);
}

function cur_GetReal($from, $value, $frequency = '') {
    switch($frequency)
    {
        case 'hourly':
            $value *= 30 * 24;
            break;
        case 'daily':
            $value *= 30;
            break;
        case 'monthly':
            $value *= 1;
            break;
        case 'annually':
            $value *= 1/12;
            break;
        default:
            $value *= 1;
            break;
    }
    return $value * cur_GetCurrency($from) / cur_GetCurrency('AMD');
}

function cur_Convert($from, $to, $value) {
    return cur_numformat($value * cur_GetCurrency($from) / cur_GetCurrency($to));
}

global $currency;

$string = file_get_contents(dirname(__FILE__) . "/currencies.json");
$currency = json_decode($string);

function cur_GetCurrency($type) {
    global $currency;
    
    switch($type) {
        case 'AMD':
            return $currency->values->AMD;
            break;
        case 'USD':
            return $currency->values->USD;
            break;
        case 'RUR':
            return $currency->values->RUR;
            break;
        case 'EUR':
            return $currency->values->EUR;
            break;
        default:
            return 1;
    }
}

function cur_GetDate() {
    global $currency;
    
    return $currency->date; //'13.06.2013';
}

function cur_ConvertedString2($str) {
    $sep = explode(' ', $str, 2);
    
    $value = $sep[0];
    $from = $sep[1];
    
    $res = ' (';
    
    $res .= cur_AddConvetion($from, 'AMD', $value);
    $res .= cur_AddConvetion($from, 'USD', $value);
    $res .= cur_AddConvetion($from, 'EUR', $value);
    $res .= cur_AddConvetion($from, 'RUR', $value);
    
    $res .= __('Currency was updated on') . ' ' . cur_GetDate();
    $res .= ')';
    
    return $res;
}

function updateCurrencies_HTML() {
    $opts = array('http' => array( 'timeout' => 1 ));
    $context  = stream_context_create($opts);
    $html = file_get_html('http://www.currency.am/api/rendertable?lang=en&mode=large&colorscheme=light');

    echo($html->find('.usd_buy .rate .cba_rates', 0));
    
    $currency = (object)array(
        'date'      => '13.06.2013',
        'values'    => (object)array(
            'AMD' => 1,
            'USD' => 414,
            'RUR' => 12.8,
            'EUR' => 550,
        )
    );

    //var_dump(json_encode($currency));
}

function updateCurrencies() {
    $fileContents =    '<?xml version="1.0" encoding="utf-8"?>
                        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                          <soap:Body>
                            <ExchangeRatesLatest xmlns="http://www.cba.am/" />
                          </soap:Body>
                        </soap:Envelope>';
    $contentLength = count($fileContents);
    $opts = array('http' =>
                array(
                'method' => "POST",
                'header' => 'Content-Type: application/soap+xml; charset=utf-8' . "\r\n"
                          . 'UserAgent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31' . "\r\n"
                          //. "Cookie: foo=bar\r\n"
                          . "Content-Length: $contentLength" . "\r\n"
                          . 'SOAPAction: "http://www.cba.am/ExchangeRatesLatest"' . "\r\n"
                          ,
                'timeout' => 1,
                'content' => $fileContents
                )
            );
            
    $context  = stream_context_create($opts);
    $currency_xml = file_get_contents('http://api.cba.am/exchangerates.asmx?WSDL', false, $context);
    
    var_dump($currency_xml);
    
    $currency = (object)array(
        'date'      => '13.06.2013',
        'values'    => (object)array(
            'AMD' => 1,
            'USD' => 414,
            'RUR' => 12.8,
            'EUR' => 550,
        )
    );

    //var_dump(json_encode($currency));
}

function updateCurrencies_WCF() {
    // Function to read the contents of a file
    function GetFileContents( $filename ) {
      $handle = fopen($filename, "r");
      $contents = fread($handle, filesize($filename));
      fclose($handle); 
      return $contents;
    }

    // Create a new soap client based on the service's metadata (WSDL)
    $client = new SoapClient("http://api.cba.am/exchangerates.asmx?wsdl");

    // Specify the file to upload
    $filename = file_get_contents(dirname(__FILE__) . "/cba.xml");

    // Specify the parameters for the Upload(...) method as an associative array
    $parameters = array("stream" => GetFileContents($filename));

    // Upload the file
    
    $result = $client->Upload($parameters);
    
    var_dump($client);
    
    // Check if the upload succeeded
    if ($result) {
        echo $filename . " uploaded";
    } else {
        echo $filename . " upload failed";
    }
    
    //$currency_xml = file_get_contents('http://api.cba.am/exchangerates.asmx', false, $context);
    
    //var_dump($currency_xml);
    
    $currency = (object)array(
        'date'      => '13.06.2013',
        'values'    => (object)array(
            'AMD' => 1,
            'USD' => 414,
            'RUR' => 12.8,
            'EUR' => 550,
        )
    );

    //var_dump(json_encode($currency));
}

function currencies_update_form() {
    $opts = array('http' => array( 'timeout' => 1 ));
    $context  = stream_context_create($opts);
    $currency_json = file_get_contents('http://services.currency.am/api/rates?jsonp=', false, $context);
    $currency_new = json_decode($currency_json);
    
    foreach($currency_new->CbaRates as $rate) {
        switch ($rate->Currency) {
            case 'USD':
                $USD = $rate->Price;
                break;
            case 'EUR':
                $EUR = $rate->Price;
                break;
            case 'RUR':
                $RUR = $rate->Price;
                break;
        }
    }
    
    $currency_new = (object)array(
        'date'      => date('d.m.Y'),
        'values'    => (object)array(
            'AMD' => 1,
            'USD' => $USD,
            'RUR' => $RUR,
            'EUR' => $EUR,
        )
    );
    
    global $currency;

?>
    <form method="post">
        <label for="">Old:</label></br><textarea rows="1" cols="120" name="old_json"><?php echo json_encode($currency) ?></textarea></br>
        <label for="">New:</label></br><textarea rows="1" cols="120" name="json"><?php echo json_encode($currency_new) ?></textarea></br>
        <input value="Save" type="submit" name="save" />
        <b><?php if (isset($_POST['saved'])) echo 'Saved' ?></b>
    </form>
<?php
}
