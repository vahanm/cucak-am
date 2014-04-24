<?php
/**
* replaced : 'dynamic-tools' with 'dt'
*
*
*
*
*/

function dynamic_tools_add() {
?>
<div class="dt-add">
    <div class="dt-add-buttons">
        <div class="dt-add-button dt-add-button-text dt-add-active" type="text">
            <div class="dt-add-button-tip">
                <div class="dt-add-button-tip-text"><?php _e('Simple text') ?></div>
                <div class="dt-add-button-tip-arrow"></div>
            </div>
        </div>
        <div class="dt-add-button dt-add-button-link" type="link">
            <div class="dt-add-button-tip">
                <div class="dt-add-button-tip-text"><?php _e('Link') ?></div>
                <div class="dt-add-button-tip-arrow"></div>
            </div>
        </div>
        <div class="dt-add-button dt-add-button-image" type="image">
            <div class="dt-add-button-tip">
                <div class="dt-add-button-tip-text"><?php _e('Image') ?></div>
                <div class="dt-add-button-tip-arrow"></div>
            </div>
        </div>
        <div class="dt-add-button dt-add-button-post" type="post">
            <div class="dt-add-button-tip">
                <div class="dt-add-button-tip-text"><?php _e('Post') ?></div>
                <div class="dt-add-button-tip-arrow"></div>
            </div>
        </div>
        <div class="dt-add-button dt-add-button-map" type="map">
            <div class="dt-add-button-tip">
                <div class="dt-add-button-tip-text"><?php _e('Map') ?></div>
                <div class="dt-add-button-tip-arrow"></div>
            </div>
        </div>
        <div class="dt-add-button dt-add-button-list" type="list">
            <div class="dt-add-button-tip">
                <div class="dt-add-button-tip-text"><?php _e('List') ?></div>
                <div class="dt-add-button-tip-arrow"></div>
            </div>
        </div>
    </div>
</div>

<div class="dt-edit">
    <div class="dt-add-controls">
        <div class="dt-add-control dt-add-control-text dt-add-active" type="text">
            <div class="dt-options dt-add-control-text-style">
                <div class="dt-option dt-add-control-text-style-normal dt-options-active"><?php _e('Normal') ?></div>
                <div class="dt-option dt-add-control-text-style-header1"><?php _e('Heading') ?> 1</div>
                <div class="dt-option dt-add-control-text-style-header2"><?php _e('Heading') ?> 2</div>
                <div class="dt-option dt-add-control-text-style-title"><?php _e('Title') ?></div>
                <div class="dt-option dt-add-control-text-style-subtitle"><?php _e('Subtitle') ?></div>
            </div>
        </div>
        <div class="dt-add-control dt-add-control-link" type="link">
        </div>
        <div class="dt-add-control dt-add-control-image" type="image">
        </div>
        <div class="dt-add-control dt-add-control-post" type="post">
        </div>
        <div class="dt-add-control dt-add-control-map" type="map">
        </div>
        <div class="dt-add-control dt-add-control-list" type="list">
        </div>
    </div>
</div>


<div class="dt-post dt-post-text dt-post-editmode">
    asdfsad fsdf
</div>
<?php
//<div class="dt-post dt-post-text dt-post-editmode" contenteditable="true">sfgfdgdfhggh dfgh fgdh dfghfgh dfg</div>
}