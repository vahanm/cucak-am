<?php

function helper_carmodels()
{
?>

<div class="addpostinnerdiv" id="container_<?php echo $id; ?>" <?php the_hint($id); ?>>
	<div class="addpostlbl">
		<p> <?php _e('Brand') ?>:</p>
	</div>
	<div class="addpostctrl">
		<p>
			<select id="brand_id" name="post_brand_id">
				<option value="" <?php if($_POST['post_brand_id']) { ?> selected="selected" <?php } ?> ><?php _e('Please select') ?></option>
					
				<option value="153">Marcos</option>
				<option value="132">AC</option>
				<option value="2">Acura</option>
				<option value="4">Alfa Romeo</option>
				<option value="3">Aston Martin</option>
				<option value="1">Audi</option>
				<option value="6">Bentley</option>
				<option value="114">Berkut</option>
				<option value="8">BMW</option>
				<option value="93">Bobcat</option>
				<option value="88">Bogdan</option>
				<option value="107">BRP Sea-Doo</option>
				<option value="124">Bugatti</option>
				<option value="9">Buick</option>
				<option value="7">BYD</option>
				<option value="10">Cadillac</option>
				<option value="96">Case</option>
				<option value="92">Caterpillar</option>
				<option value="74">Changfeng</option>
				<option value="11">Chery</option>
				<option value="12">Chevrolet</option>
				<option value="13">Chrysler</option>
				<option value="14">Citroen</option>
				<option value="15">Daewoo</option>
				<option value="81">DAF</option>
				<option value="16">Daihatsu</option>
				<option value="17">Dodge</option>
				<option value="18">Ferrari</option>
				<option value="19">Fiat</option>
				<option value="95">Fiat-Hitachi</option>
				<option value="20">Ford</option>
				<option value="21">GAZ</option>
				<option value="75">Geely</option>
				<option value="22">GMC</option>
				<option value="23">Great Wall</option>
				<option value="148">Harbin Hafei</option>
				<option value="24">Honda</option>
				<option value="25">Hummer</option>
				<option value="26">Hyundai</option>
				<option value="27">Infiniti</option>
				<option value="28">Isuzu</option>
				<option value="29">Iveco</option>
				<option value="31">Jaguar</option>
				<option value="97">JCB</option>
				<option value="32">Jeep</option>
				<option value="98">John Deere</option>
				<option value="77">Kamaz</option>
				<option value="33">Kawasaki</option>
				<option value="34">Kia</option>
				<option value="112">King Fisher</option>
				<option value="100">Komatsu</option>
				<option value="91">KRAZ</option>
				<option value="35">Lamborghini</option>
				<option value="36">Lancia</option>
				<option value="37">Land Rover</option>
				<option value="38">Lexus</option>
				<option value="39">Lincoln</option>
				<option value="40">Lotus</option>
				<option value="83">MAN</option>
				<option value="41">Maserati</option>
				<option value="110">Master</option>
				<option value="42">Maybach</option>
				<option value="90">MAZ</option>
				<option value="43">Mazda</option>
				<option value="125">Mc Laren</option>
				<option value="44">Mercedes-Benz</option>
				<option value="45">Mercury</option>
				<option value="46">MG</option>
				<option value="47">Mini</option>
				<option value="48">Mitsubishi</option>
				<option value="49">Moskvich</option>
				<option value="86">Neoplan</option>
				<option value="104">New Holland</option>
				<option value="50">Nissan</option>
				<option value="53">Opel</option>
				<option value="84">PAZ</option>
				<option value="54">Peugeot</option>
				<option value="55">Pontiac</option>
				<option value="56">Porsche</option>
				<option value="57">Renault</option>
				<option value="58">Rolls Royce</option>
				<option value="59">Rover</option>
				<option value="60">Saab</option>
				<option value="89">Saturn</option>
				<option value="82">Scania</option>
				<option value="62">Scion</option>
				<option value="63">Seat</option>
				<option value="102">Setra</option>
				<option value="64">SG</option>
				<option value="65">Skoda</option>
				<option value="120">Smart</option>
				<option value="66">Ssangyong</option>
				<option value="67">Subaru</option>
				<option value="68">Suzuki</option>
				<option value="73">Tata</option>
				<option value="103">Terex</option>
				<option value="69">Toyota</option>
				<option value="78">UAZ</option>
				<option value="70">VAZ</option>
				<option value="71">Volkswagen</option>
				<option value="72">Volvo</option>
				<option value="113">WR</option>
				<option value="106">Yamaha</option>
				<option value="79">ZAZ</option>
				<option value="99">Zeppelin</option>
				<option value="80">ZIL</option>
			</select>
		</p>
	</div>
</div>


<div class="addpostinnerdiv" id="container_<?php echo $id; ?>" <?php the_hint($id); ?>>
	<div class="addpostlbl">
		<p> <?php _e('Model') ?>:</p>
	</div>
	<div class="addpostctrl">
		<p>
			<select id="model_id" name="post_model_id">
				<option value="0">---</option>
			</select>
		</p>
	</div>
</div>

<?php

helper_text("carmodel", __('Car model'), __('Please enter the model.'));

?>


<script type="text/javascript">
$(document).ready(function(){
	$('#brand_id').change(function() {
		var brand_id = parseInt($(this).val());
		if (brand_id != 0) {
			$('#model_id').load('/models/en/en' + brand_id + '.html');
			$('#carmodel').val($('#brand_id option:selected').text());
			//$('#carmodel').attr('defalutvalue', $('#brand_id option:selected').text());
		}
		else {
			$('#model_id').html('<option value="0">---</option>');
		}
	});
	$('#model_id').change(function() {
		var model_id = parseInt($(this).val());
		if (model_id != 0) {
			$('#carmodel').val($('#brand_id option:selected').text() + ' ' + $('#model_id option:selected').text());
			//$('#carmodel').attr('defalutvalue', $('#brand_id option:selected').text() + ' ' + $('#model_id option:selected').text());
		}
	});
});
</script>


<?php
}