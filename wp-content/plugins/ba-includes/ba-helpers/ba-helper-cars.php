<?php

function helper_carmodels()
{
helper_begin('carbrand', __('Car brand'));
?>
			<select id="carbrand" name="post_carbrand">
				<option <?php if($_POST['post_carbrand']) { ?> selected="selected" <?php } ?> value="0" ><?php _e('Please select') ?></option>

				<option <?php $carbrandid=4000132; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>AC</option>
                <option <?php $carbrandid=1; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Acura</option>
                <option <?php $carbrandid=6; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Alfa Romeo</option>
                <option <?php $carbrandid=11; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Asia Motors</option>
                <option <?php $carbrandid=16; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Aston Martin</option>
                <option <?php $carbrandid=21; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Audi</option>
                <option <?php $carbrandid=26; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Bentley</option>
                <option <?php $carbrandid=4000114; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Berkut</option>
                <option <?php $carbrandid=31; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>BMW</option>
                <option <?php $carbrandid=400093; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Bobcat</option>
                <option <?php $carbrandid=400088; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Bogdan</option>
                <option <?php $carbrandid=4000107; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>BRP Sea-Doo</option>
                <option <?php $carbrandid=36; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Bugatti</option>
                <option <?php $carbrandid=41; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Buick</option>
                <option <?php $carbrandid=74; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>BYD</option>
                <option <?php $carbrandid=46; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Cadillac</option>
                <option <?php $carbrandid=400096; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Case</option>
                <option <?php $carbrandid=400092; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Caterpillar</option>
                <option <?php $carbrandid=400074; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Changfeng</option>
                <option <?php $carbrandid=51; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Chery</option>
                <option <?php $carbrandid=56; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Chevrolet</option>
                <option <?php $carbrandid=61; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Chrysler</option>
                <option <?php $carbrandid=66; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Citroen</option>
                <option <?php $carbrandid=71; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Dacia</option>
                <option <?php $carbrandid=76; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Dadi China</option>
                <option <?php $carbrandid=81; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Daewoo</option>
                <option <?php $carbrandid=400081; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>DAF</option>
                <option <?php $carbrandid=86; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Daihatsu</option>
                <option <?php $carbrandid=91; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Dodge</option>
                <option <?php $carbrandid=96; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Eagle</option>
                <option <?php $carbrandid=101; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>ErAZ</option>
                <option <?php $carbrandid=106; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Ferrari</option>
                <option <?php $carbrandid=111; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Fiat</option>
                <option <?php $carbrandid=400095; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Fiat-Hitachi</option>
                <option <?php $carbrandid=116; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Ford</option>
                <option <?php $carbrandid=121; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>GAZ</option>
                <option <?php $carbrandid=126; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Geely</option>
                <option <?php $carbrandid=131; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>GMC</option>
                <option <?php $carbrandid=136; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Great Wall(hover)</option>
                <option <?php $carbrandid=141; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Hafeibrio</option>
                <option <?php $carbrandid=4000148; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Harbin Hafei</option>
                <option <?php $carbrandid=146; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Honda</option>
                <option <?php $carbrandid=73; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Hongxing Auto</option>
                <option <?php $carbrandid=422; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Huanghai Auto</option>
                <option <?php $carbrandid=151; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Hummer</option>
                <option <?php $carbrandid=156; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Hyundai</option>
                <option <?php $carbrandid=161; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Ikco Iran</option>
                <option <?php $carbrandid=166; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Infiniti</option>
                <option <?php $carbrandid=171; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Isuzu</option>
                <option <?php $carbrandid=400029; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>IVECO</option>
                <option <?php $carbrandid=176; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>IZH</option>
                <option <?php $carbrandid=181; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Jaguar</option>
                <option <?php $carbrandid=400097; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>JCB</option>
                <option <?php $carbrandid=186; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Jeep</option>
                <option <?php $carbrandid=400098; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>John Deere</option>
                <option <?php $carbrandid=400077; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Kamaz</option>
                <option <?php $carbrandid=400033; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Kawasaki</option>
                <option <?php $carbrandid=191; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Kia</option>
                <option <?php $carbrandid=4000112; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>King Fisher</option>
                <option <?php $carbrandid=4000100; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Komatsu</option>
                <option <?php $carbrandid=400091; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>KRAZ</option>
                <option <?php $carbrandid=196; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Lamborghini</option>
                <option <?php $carbrandid=201; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Lancia</option>
                <option <?php $carbrandid=206; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Land Rover</option>
                <option <?php $carbrandid=211; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Lexus</option>
                <option <?php $carbrandid=216; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Lincoln</option>
                <option <?php $carbrandid=221; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Lotus</option>
                <option <?php $carbrandid=226; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Mahindra</option>
                <option <?php $carbrandid=400083; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>MAN</option>
                <option <?php $carbrandid=231; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Maserati</option>
                <option <?php $carbrandid=4000110; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Master</option>
                <option <?php $carbrandid=236; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Maybach</option>
                <option <?php $carbrandid=400090; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>MAZ</option>
                <option <?php $carbrandid=241; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Mazda</option>
                <option <?php $carbrandid=4000125; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Mc Laren</option>
                <option <?php $carbrandid=246; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Mercedes-Benz</option>
                <option <?php $carbrandid=251; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Mercury</option>
                <option <?php $carbrandid=256; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>MG</option>
                <option <?php $carbrandid=261; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Mini</option>
                <option <?php $carbrandid=266; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Mitsubishi</option>
                <option <?php $carbrandid=271; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Moskvich</option>
                <option <?php $carbrandid=400086; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Neoplan</option>
                <option <?php $carbrandid=4000104; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>New Holland</option>
                <option <?php $carbrandid=276; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Nissan</option>
                <option <?php $carbrandid=286; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>OKA</option>
                <option <?php $carbrandid=291; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Oldsmobile</option>
                <option <?php $carbrandid=296; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Opel</option>
                <option <?php $carbrandid=400084; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>PAZ</option>
                <option <?php $carbrandid=301; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Peugeot</option>
                <option <?php $carbrandid=306; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Plymouth</option>
                <option <?php $carbrandid=311; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Pontiac</option>
                <option <?php $carbrandid=316; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Porsche</option>
                <option <?php $carbrandid=321; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>RAF</option>
                <option <?php $carbrandid=326; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Renault</option>
                <option <?php $carbrandid=331; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Rolls Royce</option>
                <option <?php $carbrandid=336; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Rover</option>
                <option <?php $carbrandid=341; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Saab</option>
                <option <?php $carbrandid=346; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Saturn</option>
                <option <?php $carbrandid=400082; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Scania</option>
                <option <?php $carbrandid=351; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Scion</option>
                <option <?php $carbrandid=356; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Seat</option>
                <option <?php $carbrandid=4000102; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Setra</option>
                <option <?php $carbrandid=68; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>SG</option>
                <option <?php $carbrandid=69; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Shanghai Wanfeng Auto</option>
                <option <?php $carbrandid=423; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Shuguang</option>
                <option <?php $carbrandid=361; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Skoda</option>
                <option <?php $carbrandid=366; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Smart</option>
                <option <?php $carbrandid=371; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Ssang-yong</option>
                <option <?php $carbrandid=376; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Subaru</option>
                <option <?php $carbrandid=381; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Suzuki</option>
                <option <?php $carbrandid=400073; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Tata</option>
                <option <?php $carbrandid=4000103; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Terex</option>
                <option <?php $carbrandid=386; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Toyota</option>
                <option <?php $carbrandid=391; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>UAZ</option>
                <option <?php $carbrandid=396; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>VAZ(Lada)</option>
                <option <?php $carbrandid=401; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Volkswagen</option>
                <option <?php $carbrandid=406; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Volvo</option>
                <option <?php $carbrandid=4000113; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>WR</option>
                <option <?php $carbrandid=411; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Xin Kai</option>
                <option <?php $carbrandid=4000106; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Yamaha</option>
                <option <?php $carbrandid=416; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>ZAZ-Tavria</option>
                <option <?php $carbrandid=400099; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Zeppelin</option>
                <option <?php $carbrandid=400080; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>ZIL</option>
                <option <?php $carbrandid=421; echo 'value="' . $carbrandid . '" '; if($_POST['post_carbrand'] == $carbrandid) { ?> selected="selected" <?php } ?>>Zx Auto</option>
		    </select>
<?php
helper_end('', '');

helper_begin('carmodel', __('Car model'));
?>
			<select id="carmodel" name="post_carmodel" disabled="disabled">
			<?php 
				if($_POST['post_carbrand'] > 0)
				{	
					include '../models/auto/model_' . $_POST['post_carbrand'] . '.htm';
					?>
					<optgroup></optgroup><option value="-1" style="color: #910; background-color: #def;"><?php _e('My car\'s model is not in list') ?></option><optgroup></optgroup>
					<?php
				} else {
			?>
				<option value="0"><?php _e('Please select the brand') ?></option>
				<?php } ?>
			</select>

			<div id="loaderror" style="color: red;">

			</div>

<?php
helper_end('', '');

helper_hidden("carbrandname");

helper_text("carmodelname", __('Car model'), __('Please enter the car model.'));

if($_POST['post_carmodel'] != '-1')
{
?>
<style>
#container_carmodelname
{
	display: none;
}
</style>
<?php } ?>

<script type="text/javascript">
$(document).ready(function(){
<?php if($_POST['post_carmodel']) { ?>
	$('#carmodel option[value="<?php echo $_POST['post_carmodel']; ?>"]').attr('selected', 'selected');
	$('#carmodel').removeAttr('disabled');
<?php } ?>

	$('#carbrand').change(function() {
		$('#carbrandname').val($('#carbrand option:selected').text());
		
		var carbrand = parseInt($(this).val());
		if (carbrand != 0) {
			$('#carmodel').load('/models/auto/model_' + carbrand + '.htm', function(response, status, xhr) {
				if (status == "error") {
				    var msg = "<?php _e('Sorry but there was an error:') ?> ";
					    $("#loaderror").html(msg + xhr.status + " " + xhr.statusText);
						$('#carmodel').html('');
						$('#carmodel').attr('disabled', 'disabled');
				} else {
					    $('#loaderror').html('');
						$('#carmodel').prepend("<option value=\"0\"><?php _e('Please select the model') ?></option>");
						$('#carmodel').append("<optgroup></optgroup><option value=\"-1\" style=\"color: #910; background-color: #def;\"><?php _e('My car\'s model is not in list') ?></option><optgroup></optgroup>");
						$('#carmodel').removeAttr('disabled');
				}
			});
		}
		else {
			$('#carmodel').html('<option value="0"><?php _e('Please select the brand') ?></option>');
			$('#carmodel').attr('disabled', 'disabled');
		}
	});
	$('#carmodel').change(function() {
		var carmodel = parseInt($(this).val());
		if (carmodel == -1) {
			$('#carmodelname').val('');
			$('#container_carmodelname').slideDown();
		} else {
			$('#container_carmodelname').slideUp();
			
			if (carmodel != 0) {
				$('#carmodelname').val($('#carmodel option:selected').text());
			} else {
				$('#carmodelname').val('');
			}
		}
	});
});
</script>


<?php
}





function filter_carmodels()
{
    filter_begin('carbrand', __('Car brand'), false, PRIMARY_FILTER);
?>
			<select id="carbrand" name="post_carbrand" class="select_filters">
				<option <?php if($_GET['post_carbrand']) { ?> selected="selected" <?php } ?> value="0" ><?php _e('Does not matter') ?></option>
<?php 
    global $wpdb;    
    $wp_query	= " SELECT
                        pm.`meta_value` AS brand_name,
                        pm2.`meta_value` AS brand,
                        COUNT(pm2.post_id) AS `count`
                    FROM `{$wpdb->prefix}postmeta` pm
                    JOIN `{$wpdb->prefix}postmeta` pm2 ON pm.post_id = pm2.post_id
                    WHERE pm.meta_key = 'post_carbrandname' AND pm2.meta_key = 'post_carbrand'
                    GROUP BY pm2.`meta_value`
                    ORDER BY pm.`meta_value` ASC; ";
    
    $list = $wpdb->get_results($wp_query);

    foreach($list as $item) {
        echo '<option value="' . $item->brand . '"' . ((arg($_GET, 'qcarbrandoeq', 0) == $item->brand) ? 'selected="selected"' : '') . '>' . $item->brand_name . '  (' . $item->count . ' ' . __('cars') . ')</option>';
    }
?>
		    </select>
<?php
    filter_end('', '');

    filter_begin('carmodel', __('Car model'), false, PRIMARY_FILTER);
?>
			<select id="carmodel" name="post_carmodel" disabled="disabled" class="select_filters">
				<option value=""><?php _e('Does not matter') ?></option>
			<?php 
    if(arg($_GET, 'qcarbrandoeq', 0) > 0)
    {
        //include '../models/auto/model_' . $_GET['qcarbrandoeq'] . '.htm';
        $lang_prefix = lang_prefix();
        echo file_get_contents("http://{$lang_prefix}.cucak.am/ajax/car-models.php?brand={$_GET['qcarbrandoeq']}");
    } else {
			?>
				<option value="0"><?php _e('Please select the brand') ?></option>
	<?php } ?>
			</select>

			<div id="loaderror" style="color: red;">
			</div>

<?php filter_end('', ''); ?>

<script type="text/javascript">
$(document).ready(function(){
<?php if(isset($_GET['qcarmodelnameoeq'])) { ?>
	$('#carmodel option[value="<?php echo arg($_GET, 'qcarmodelnameoeq', '') ?>"]').attr('selected', 'selected');
<?php } ?>
<?php if(isset($_GET['qcarbrandoeq'])) { ?>
	$('#carmodel').removeAttr('disabled');
<?php } ?>

	$('#carbrand').change(function() {
		$('#carbrandname').val($('#carbrand option:selected').text());
        
		advancedFilters['carmodelname'] = [{ include: false }];
		
		var carbrand = parseInt($(this).val());
		if (carbrand != 0) {
			advancedFilters['carbrand'] = [{type: 'oeq', value: carbrand, include: true }];
            
			//$('#carmodel').load('/models/auto/model_' + carbrand + '.htm', function(response, status, xhr) {
			$('#carmodel').load('http://cucak.am/ajax/car-models.php?brand=' + carbrand, function(response, status, xhr) {
				if (status == "error") {
				    var msg = "<?php _e('Sorry but there was an error:') ?> ";
					$("#loaderror").html(msg + xhr.status + " " + xhr.statusText);
					$('#carmodel').html('');
					$('#carmodel').attr('disabled', 'disabled');
				} else {
					$('#loaderror').html('');
					$('#carmodel').prepend("<option value=\"0\"><?php _e('Does not matter') ?></option>");
					$('#carmodel').removeAttr('disabled');
				}
			});
		} else {
			advancedFilters['carbrand'] = [{ include: false }];
            
			$('#carmodel').html('<option value="0"><?php _e('Does not matter') ?></option>');
			$('#carmodel').attr('disabled', 'disabled');
		}
	});
	$('#carmodel').change(function() {
		var value = $(this).find('option:checked').val();
		if(value == '') {
			advancedFilters['carmodelname'] = [{ include: false }];
		} else {
			advancedFilters['carmodelname'] = [{type: 'oeq', value: value, include: true }];
		}
	});
});
</script>


<?php
}