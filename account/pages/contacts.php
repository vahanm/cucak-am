<?php
global $wpdb;


function userContacts()	{
    $user_id = get_current_user_id();

    //echo '<h3>' . __('Contact information') . '</h3>';
?>

<script type="text/javascript">
function scrollTo(el) {
    $(el).ScrollTo({
            duration: 500,
            easing: 'linear'
        });
}
</script>

<?php
    $error = '';

    //$error .= require_selection('location', __('Please select the location.'));
    //$error .= require_numbercomparison('location', '>', 0, __('Please select the location.'));

    if(mb_strlen(_p('aname')) > 60)	{
        $error .= make_error_message('aname',  _t('Name must be contents %s chars maximum.', 60));
    }
    if(mb_strlen(_p('phone')) > 0 && mb_strlen(_p('phone')) < 6)	{
        $error .= make_error_message('phone',  __('Please enter a valid phone number(s).'));
    }
    if(mb_strlen(_p('phone')) > 60)	{
        $error .= make_error_message('phone',  _t('Phone number must be contents %s chars maximum.', 60));
    }
    if(mb_strlen(_p('address')) > 160)	{
        $error .= make_error_message('phone',  _t('Address must be contents %s chars maximum.', 160));
    }
    if(mb_strlen(_p('email')) > 0 && !is_email(_p('email'), true))	{
    $error .= make_error_message('email',  __('Please enter your E-Mail address.'));
    }

    $error .= require_selection('contactperson', __('Please select the contact person.'));

    //if(!_p('aname'))	{
    //	$error .= make_error_message('aname',  __('Please enter a name.'));
    //}


    if(isset($_POST['submitButton']))	{
        echo '<div class="saved" freez>' , __('Saved'), '</div>';
    } else {
        $error = '';
    }

    if(mb_strlen($error))	{
        echo '<div class="error">' . $error . '</div>';
    }
    
    //$user_info = get_userdata($user_id);
    //
    //$user_display_name = $user_info->display_name;
    //$user_first_name = $user_info->first_name;
    //$user_last_name = $user_info->last_name;
    //$user_nickname = $user_info->nickname;
    //
    //$user_email = $user_info->user_email;
    
    //User meta
    $user_display_name = _pu('display_name');
    
    $user_url = _pu('user_url');
    $user_email = _pu('email');
    $user_phone = _pu('phone');
    $user_address = _pu('address');
    
    $user_map_main_enabled = _pu('map_main_enabled', 0);
    $user_map_main_latitude = _pu('map_main_latitude', '40.18577834919571');
    $user_map_main_longitude = _pu('map_main_longitude', '44.51506328582764');
    $user_map_main_zoom = _pu('map_main_zoom', 13);
    
    $user_skype = _pu('skype');
    $user_location = _pu('location');
    $user_contactperson = _pu('contactperson');
    $user_contacttimes_begin = _pu('contacttimes_begin');
    $user_contacttimes_end = _pu('contacttimes_end');
    $user_contactdays = _pu('contactdays', 0);
    
    $user_description = _pu('description');
?>
<div class="account-contacts-form">
<form id="frmaddpost" name="frmaddpost" method="post" enctype="multipart/form-data">
    <div class="addpostmaindiv">
    <?php
        helper_begin('name', __('Name'));					
                ?>
                    <input type="text" name="post_display_name" class="txtbg defaultText" defalutvalue="<?php _e('Please enter your name.') ?>" value="<?php echo $user_display_name ?>">
                <?php
        helper_end('aname', __('Name'));
        
        helper_begin('lname', __('Phone'));
                ?>
                    <input type="text" name="post_phone" class="txtbg defaultText" defalutvalue="<?php _e('Please enter your phone number(s).') ?>" value="<?php echo replace_quotes($user_phone); ?>" />
                <?php
        helper_end('lname', __('Phone'));
        
        helper_begin('skype', 'Skype');
                            ?>
                    <input type="text" name="post_skype" class="txtbg defaultText" defalutvalue="<?php _e('Please enter your Skype name.') ?>" value="<?php echo replace_quotes($user_skype); ?>" />
                <?php
        helper_end('skype', 'Skype');
        
        helper_begin('email' ,__('E-Mail'));
                ?>
                <input type="text" id="email" class="txtbg defaultText" defalutvalue="<?php _e('Please enter your E-Mail address.') ?>" value="<?php echo $user_email; ?>"  name="post_email" />
                <br />
                <span class="hint"><?php _e('Visible to other visitors.'); ?></span>
                </p>
    <?php
        helper_end('email', __('E-Mail'));
        
        helper_begin('user_url', __('Web site'));
    ?>
                <input type="text" id="user_url" name="post_user_url" class="txtbg defaultText" defalutvalue="<?php _e('Please enter your web site.') ?>" value="<?php echo $user_url; ?>"  />
                </p>
    <?php
        helper_end('user_url', __('Web site'));
        
        if (WP_TEST) {
            helper_begin('contactdays', __('Contact Days'));
        
            ?>
            <input type="hidden" id="contactdays" name="post_contactdays" value="<?php echo $user_contactdays ?>" />
    
            <a class="weekdays-specials weekdays-specials-everyday" href="javascript:;"><?php _e('Every day')    ?></a>,
            <a class="weekdays-specials weekdays-specials-workweek" href="javascript:;"><?php _e('Workweek')     ?></a>,
            <a class="weekdays-specials weekdays-specials-weekend"  href="javascript:;"><?php _e('Weekend')      ?></a>,
            <a class="weekdays-specials weekdays-specials-unselect" href="javascript:;"><?php _e('Unselect all') ?></a>
    
            <div class="weekdays">
                <div class="weekdays-day <?php if(($user_contactdays & WD1) == WD1) echo 'weekdays-day-selected'; ?> weekdays-day-workweek" value="<?php echo WD1 ?>"><?php _e('Monday')     ?></div>
                <div class="weekdays-day <?php if(($user_contactdays & WD2) == WD2) echo 'weekdays-day-selected'; ?> weekdays-day-workweek" value="<?php echo WD2 ?>"><?php _e('Tuesday')    ?></div>
                <div class="weekdays-day <?php if(($user_contactdays & WD3) == WD3) echo 'weekdays-day-selected'; ?> weekdays-day-workweek" value="<?php echo WD3 ?>"><?php _e('Wednesday')  ?></div>
                <div class="weekdays-day <?php if(($user_contactdays & WD4) == WD4) echo 'weekdays-day-selected'; ?> weekdays-day-workweek" value="<?php echo WD4 ?>"><?php _e('Thursday')   ?></div>
                <div class="weekdays-day <?php if(($user_contactdays & WD5) == WD5) echo 'weekdays-day-selected'; ?> weekdays-day-workweek" value="<?php echo WD5 ?>"><?php _e('Friday')     ?></div>
                <div class="weekdays-day <?php if(($user_contactdays & WD6) == WD6) echo 'weekdays-day-selected'; ?> weekdays-day-weekend"  value="<?php echo WD6 ?>"><?php _e('Saturday')   ?></div>
                <div class="weekdays-day <?php if(($user_contactdays & WD7) == WD7) echo 'weekdays-day-selected'; ?> weekdays-day-weekend"  value="<?php echo WD7 ?>"><?php _e('Sunday')     ?></div>
            </div>
            <?php
        
            helper_end('contactdays', __('Contact Days'));
        }
        
        helper_begin('contacttimes', __('Desirable contact time'));
                ?>
                        <select id="contacttimes_begin" name="post_contacttimes_begin" style="width: 40%">
                <?php
        
        echo '<option value="">' . __('any time') . '</option>';
        
        for($i = 1; $i <= 24; $i++)
        {
            echo '<option value="' . $i . '" ' . ($user_contacttimes_begin == $i ? 'selected="selected"' : '') . '>' . ($i - 1) . ':00</option>';
        }
        
                ?>
                        </select>
                        <span id="contacttimes_cont"  style="<?php if($user_contacttimes_begin == '') { ?> display: none; <?php } ?>">
                        <span> - </span>
                        <select  id="contacttimes_end" name="post_contacttimes_end" style="width: 40%">
                <?php
        
        for($i = 1; $i <= 24; $i++)
        {
            echo '<option value="' . $i . '" ' . ($user_contacttimes_end == $i ? 'selected="selected"' : '') . '>' . ($i - 1) . ':00</option>';
        }
        
                ?>
                        </select>
                        </span>
                        <script>
                        
                        $(document).ready(function() {
                            $('#contacttimes_begin').change(function(){
                                if($(this).find('option:selected').val().length > 0) {
                                    $('#contacttimes_cont').fadeIn();
                                } else {
                                    $('#contacttimes_cont').fadeOut();
                                }
                            });
                        });
                        
                        </script>
                <?php
        helper_end('contacttimes', __('Contact times'));
        
        
        //helper_radio('contactperson', __('Contact person'), array( 
        //	array(1, __('private')),  
        //	array(2, __('company')),  
        //	array(3, __('intermediary'))
        //	) );

        helper_begin('contactperson', __('Contact person'));
        
        $values = array( 
            array(1, __('private')),  
            array(2, __('company')),  
            array(3, __('intermediary'))
            );
    ?>
        <table class="checkgrid">
        <?php
        $i = 0;
        foreach ( $values as $v ) {
            echo '<td>';
        ?>
            <input type="radio" id="contactperson_<?php echo $v[0]; ?>" name="post_contactperson" class="checkareabgsum" value="<?php echo $v[0]; ?>" <?php if($user_contactperson == $v[0]) { ?> checked="checked" <?php } ?> />
            <label for="contactperson_<?php echo $v[0]; ?>"><?php echo $v[1]; ?></label>
            <?php
            
            echo '</td>';
            
            $i++;
        }
        ?>
        </table>
    <?php
        helper_end('contactperson', __('Contact person'));
        
        //helper_text('link', __('Web link'), __('Please enter a web link for more information.'));
        
        helper_user_location($user_location);
        
        helper_begin('address', __('Address'));
                ?>
                    <input type="text" name="post_address" class="txtbg defaultText" defalutvalue="<?php _e('Please enter your address.') ?>" value="<?php echo replace_quotes($user_address); ?>" />
                <?php
        helper_end('address', __('Address'));
        
        if (WP_TEST) {
            helper_begin('address', __('Map'));
                ?>
                    <div>
                        <style>.gllpMap	{ width: 450px; height: 250px; }</style>
                        <script>(function(e){if(!window.console)window.console={};if(!window.console.log)window.console.log=function(){};var t=function(){var t=this;t.params={defLat:0,defLng:0,defZoom:1,queryLocationNameWhenLatLngChanges:true,queryElevationWhenLatLngChanges:true,mapOptions:{mapTypeId:google.maps.MapTypeId.ROADMAP,mapTypeControl:false,disableDoubleClickZoom:true,zoomControlOptions:true,streetViewControl:false},strings:{markerText:"Drag this Marker",error_empty_field:"Couldn't find coordinates for this place",error_no_results:"Couldn't find coordinates for this place"}};t.vars={ID:null,LATLNG:null,map:null,marker:null,geocoder:null};var n=function(n){t.vars.marker.setPosition(n);t.vars.map.panTo(n);e(t.vars.cssID+".gllpZoom").val(t.vars.map.getZoom());e(t.vars.cssID+".gllpLongitude").val(n.lng());e(t.vars.cssID+".gllpLatitude").val(n.lat());e(t.vars.cssID).trigger("location_changed",e(t.vars.cssID));if(t.params.queryLocationNameWhenLatLngChanges){r(n)}if(t.params.queryElevationWhenLatLngChanges){i(n)}};var r=function(n){var r=new google.maps.LatLng(n.lat(),n.lng());t.vars.geocoder.geocode({latLng:r},function(n,r){if(r==google.maps.GeocoderStatus.OK&&n[1]){e(t.vars.cssID+".gllpLocationName").val(n[1].formatted_address)}else{e(t.vars.cssID+".gllpLocationName").val("")}e(t.vars.cssID).trigger("location_name_changed",e(t.vars.cssID))})};var i=function(n){var r=new google.maps.LatLng(n.lat(),n.lng());var i=[r];var s={locations:i};t.vars.elevator.getElevationForLocations(s,function(n,r){if(r==google.maps.ElevationStatus.OK){if(n[0]){e(t.vars.cssID+".gllpElevation").val(n[0].elevation.toFixed(3))}else{e(t.vars.cssID+".gllpElevation").val("")}}else{e(t.vars.cssID+".gllpElevation").val("")}e(t.vars.cssID).trigger("elevation_changed",e(t.vars.cssID))})};var s=function(r,i){if(r==""){if(!i){o(t.params.strings.error_empty_field)}return}t.vars.geocoder.geocode({address:r},function(r,s){if(s==google.maps.GeocoderStatus.OK){e(t.vars.cssID+".gllpZoom").val(11);t.vars.map.setZoom(parseInt(e(t.vars.cssID+".gllpZoom").val()));n(r[0].geometry.location)}else{if(!i){o(t.params.strings.error_no_results)}}})};var o=function(e){alert(e)};var u={init:function(r){if(!e(r).attr("id")){if(e(r).attr("name")){e(r).attr("id",e(r).attr("name"))}else{e(r).attr("id","_MAP_"+Math.ceil(Math.random()*1e4))}}t.vars.ID=e(r).attr("id");t.vars.cssID="#"+t.vars.ID+" ";t.params.defLat=e(t.vars.cssID+".gllpLatitude").val()?e(t.vars.cssID+".gllpLatitude").val():t.params.defLat;t.params.defLng=e(t.vars.cssID+".gllpLongitude").val()?e(t.vars.cssID+".gllpLongitude").val():t.params.defLng;t.params.defZoom=e(t.vars.cssID+".gllpZoom").val()?parseInt(e(t.vars.cssID+".gllpZoom").val()):t.params.defZoom;t.vars.LATLNG=new google.maps.LatLng(t.params.defLat,t.params.defLng);t.vars.MAPOPTIONS=t.params.mapOptions;t.vars.MAPOPTIONS.zoom=t.params.defZoom;t.vars.MAPOPTIONS.center=t.vars.LATLNG;t.vars.map=new google.maps.Map(e(t.vars.cssID+".gllpMap").get(0),t.vars.MAPOPTIONS);t.vars.geocoder=new google.maps.Geocoder;t.vars.elevator=new google.maps.ElevationService;t.vars.marker=new google.maps.Marker({position:t.vars.LATLNG,map:t.vars.map,title:t.params.strings.markerText,draggable:true});google.maps.event.addListener(t.vars.map,"dblclick",function(e){n(e.latLng)});google.maps.event.addListener(t.vars.marker,"dragend",function(e){n(t.vars.marker.position)});google.maps.event.addListener(t.vars.map,"zoom_changed",function(n){e(t.vars.cssID+".gllpZoom").val(t.vars.map.getZoom());e(t.vars.cssID).trigger("location_changed",e(t.vars.cssID))});e(t.vars.cssID+".gllpUpdateButton").bind("click",function(){var r=e(t.vars.cssID+".gllpLatitude").val();var i=e(t.vars.cssID+".gllpLongitude").val();var s=new google.maps.LatLng(r,i);t.vars.map.setZoom(parseInt(e(t.vars.cssID+".gllpZoom").val()));n(s)});e(t.vars.cssID+".gllpSearchButton").bind("click",function(){s(e(t.vars.cssID+".gllpSearchField").val(),false)});e(document).bind("gllp_perform_search",function(t,n){s(e(n).attr("string"),true)});e(document).bind("gllp_update_fields",function(r){var i=e(t.vars.cssID+".gllpLatitude").val();var s=e(t.vars.cssID+".gllpLongitude").val();var o=new google.maps.LatLng(i,s);t.vars.map.setZoom(parseInt(e(t.vars.cssID+".gllpZoom").val()));n(o)})}};return u};e(document).ready(function(){e(".gllpLatlonPicker").each(function(){(new t).init(e(this))})});e(document).bind("location_changed",function(t,n){console.log("changed: "+e(n).attr("id"))})})(jQuery)</script>
                        
                        <fieldset class="gllpLatlonPicker">
                            <input type="text" class="gllpSearchField">
                            <input type="button" class="gllpSearchButton" value="<?php _e('Search') ?>">
                            <br />
                            <br />
                            <div class="gllpMap">Loading "Google Maps"</div>
                            <br />
                            <input type="hidden" name="post_map_main_latitude" class="gllpLatitude" value="<?php echo $user_map_main_latitude; ?>" />
                            <input type="hidden" name="post_map_main_longitude" class="gllpLongitude" value="<?php echo $user_map_main_longitude; ?>" />
                            <input type="hidden" name="post_map_main_zoom" class="gllpZoom" value="<?php echo $user_map_main_zoom; ?>" />
                            <input type="text" class="gllpLocationName txtbg" readonly="readonly" />
                        </fieldset>
                    </div>
                <?php
            helper_end('address', __('Map'));
        }
        
        ?>
        <div class="addpostinnerdiv">
            <div class="addpostlbl">
                <p>
                    <?php _e('Description') ?>:</p>
                    </div>
                    <div class="addpostctrl">
                    <p>
                    <textarea id="description" name="post_description" class="txtareabgcont" cols="40" rows="20" style="width: 90%" ><?php echo $user_description ?></textarea>
                </p>
            </div>
        </div>
                
        <input type="hidden" value="submit" name="submitButton" />
    </form>
    <div class="account-controls" style="float:left;">
        <input type="button" value="<?php _e('Save') ?>" id="submitButton" name="submitButton" style="cursor:pointer; width:150px; height:35px;" onclick="submitForm()"></p>
    </div>
</div>
<script>
    function submitForm() {
        $('#frmaddpost').submit();
    }
</script>

<?php 
}



userContacts();
