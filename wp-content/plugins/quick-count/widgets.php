<?php
class Quick_Count_Widget extends WP_Widget {
    public function __construct() {
        $widget_ops = array('classname' => __CLASS__, 'description' => sprintf(__('%s is ajax WordPress plugin that informs you and your users about how many people is currently browsing your site.', 'quick-count'), 'Quick Count'));
        parent::__construct('quick-count-widget', 'Quick Count', $widget_ops);
        $this->alt_option_name = 'quick_count_widget';
    }

    function widget ($args,$instance) {
        global $quick_count;
        extract($args);
        $title = empty($instance['title']) ? 'Quick Count' : $instance['title'];
        $online_count = $instance['online_count'];
        $count_each = $instance['count_each'];
        $by_country = $instance['by_country'];
        $most_count =$instance['most_count'];
        $user_list = $instance['user_list'];
        $visitors_map = $instance['visitors_map'];

        echo $before_widget;
        echo $before_title.$title.$after_title;
        echo $quick_count->show($online_count, $count_each, $most_count, $user_list, $by_country, $visitors_map, 'quick-count-widget', 0);
        echo $after_widget;
    }

    function update ($new_instance, $old_instance){
        global $quick_count;
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['online_count'] = $new_instance['online_count'];
        $instance['count_each'] = $new_instance['count_each'];
        $instance['by_country'] = $new_instance['by_country'];
        $instance['most_count'] = $new_instance['most_count'];
        $instance['user_list'] = $new_instance['user_list'];
        $instance['visitors_map'] = $new_instance['visitors_map'];

        $quick_count->clear_cache();

        return $instance;
    }

    function form ($instance){
        $defaults = array('title'=> '', 'online_count' => 1, 'count_each' => 1, 'by_country' => 1, 'most_count' => 1, 'visitors_map' => 1);
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>

        <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title') ?>:</label>
        <input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?> " value="<?php echo $instance['title'] ?>" size="10">
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('online_count'); ?>"><?php _e('Include total count:', 'quick-count') ?></label>
        <input id="<?php echo $this->get_field_id('online_count') ?>" name="<?php echo $this->get_field_name('online_count') ?>" type="checkbox" value="1"
        <?php if(isset($instance['online_count'])) echo 'checked="checked"' ?> />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('count_each'); ?>"><?php _e('Include count per group:', 'quick-count') ?></label>
        <input id="<?php echo $this->get_field_id('count_each') ?>" name="<?php echo $this->get_field_name('count_each') ?>" type="checkbox" value="1"
        <?php if(isset($instance['count_each'])) echo 'checked="checked"' ?> />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('by_country'); ?>"><?php _e('Include count by country:', 'quick-count') ?></label>
        <input id="<?php echo $this->get_field_id('by_country') ?>" name="<?php echo $this->get_field_name('by_country') ?>" type="checkbox" value="1"
        <?php if(isset($instance['by_country'])) echo 'checked="checked"' ?> />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('most_count'); ?>"><?php _e('Include most online count:', 'quick-count') ?></label>
        <input id="<?php echo $this->get_field_id('most_count') ?>" name="<?php echo $this->get_field_name('most_count') ?>" type="checkbox" value="1"
        <?php if(isset($instance['most_count'])) echo 'checked="checked"' ?> />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('visitors_map'); ?>"><?php _e('Include visitors map:', 'quick-count') ?></label>
        <input id="<?php echo $this->get_field_id('visitors_map') ?>" name="<?php echo $this->get_field_name('visitors_map') ?>" type="checkbox" value="1"
        <?php if(isset($instance['visitors_map'])) echo 'checked="checked"' ?> />
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('user_list'); ?>"><?php _e('Include detailed user list:', 'quick-count') ?></label>
        <input id="<?php echo $this->get_field_id('user_list') ?>" name="<?php echo $this->get_field_name('user_list') ?>" type="checkbox" value="1"
        <?php if(isset($instance['user_list'])) echo 'checked="checked"' ?> />
        </p>
        <?php
    }
}
?>
