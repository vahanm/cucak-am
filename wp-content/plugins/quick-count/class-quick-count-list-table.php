<?php
if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Quick_Count_List_Table extends WP_List_Table {
    function __construct(){
        parent::__construct( array(
            'singular'  => __('user', 'quick-count'),
            'plural'    => __('users', 'quick-count'),
            'ajax'      => false
        ) );
    }

    function column_default($item, $column_name){
        global $quick_count;

        $date_format = get_option('date_format');
        $time_format = get_option('time_format');
        $gmt_offset = get_option('gmt_offset') * 3600;

        switch($column_name){
            case 'name':
                $actions = array(
                    'delete'    => sprintf('<a href="?page=%s&action=%s&user=%s">Delete</a>',$_REQUEST['page'],'delete',$item['id']),
                );

                return sprintf('%1$s %2$s',
                    $item['name'],
                    $this->row_actions($actions)
                );
                break;
            case 'status':
                switch($item['status']){
                    case 0:
                        return __('Admin', 'quick-count');
                        break;
                    case 1:
                        return __('Subscriber', 'quick-count');
                        break;
                    case 2:
                        return __('Visitor', 'quick-count');
                        break;
                    case 3:
                        return __('Bot', 'quick-count');
                        break;
                }
                break;
            case 'polled':
                return date_i18n($date_format.' - '.$time_format, strtotime($item['polled'].' UTC')+$gmt_offset);
            case 'joined':
                return date_i18n($date_format.' - '.$time_format, strtotime($item['joined'].' UTC')+$gmt_offset);
                break;
            case 'referer':
                if(!empty($item['referer'])){
                    $limit = 50;
                    $referer = $item['referer'];
                    if(strlen($referer) > $limit){
                        $referer = substr($referer, 0, $limit).'...';
                    }
                    return '<a href="'.$item['referer'].'" target="_blank">'.$referer.'</a>';
                } else{
                    return __('Unknown', 'quick-count');
                }
                break;
            case 'online':
                if($item['online'] == 1)
                    return __('Yes', 'quick-count');
                else
                    return __('No', 'quick-count');
                break;
            case 'title':
                return '<a href="'.$item['url'].'" target="_blank">'.$item['title'].'</a>';
                break;
            case 'agent':
                if(!empty($item['agent']))
                    return $item['agent'];
                else
                    return __('Unknown', 'quick-count');
                break;
            case 'browser':
                if(!empty($item['bname'])){
                    if(!empty ($item['bversion']))
                        return sprintf('%s %d', $item['bname'], $item['bversion']);
                    else
                        return $item['bname'];
                } else{
                    return __('Unknown', 'quick-count');
                }
                break;
            case 'platform':
                if(!empty($item['pname'])){
                    if(!empty ($item['pversion']))
                        return sprintf('%s %d', $item['pname'], $item['pversion']);
                    else
                        return $item['pname'];
                } else{
                    return __('Unknown', 'quick-count');
                }
                break;
            case 'country':
                if($quick_count->quick_flag_capable() && !empty($item['cc']) && !empty($item['cn'])){
                    global $quick_flag;
                    return sprintf('%s %s', $item['cn'], '<img class="quick-count-flag" src="'.$quick_flag->flag_url.'/'.$item['cc'].'.gif" />');;
                } else{
                    return __('Unknown', 'quick-count');
                }
                break;
            case 'ip':
                return $item['ip'];
            default:
                return print_r($item,true);
        }
    }

    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            $this->_args['singular'],
            $item['id']
        );
    }

    function get_columns(){
        global $quick_count;

        $columns = array(
            'cb' => '<input type="checkbox" />',
            'name' => __('Name', 'quick-count'),
            'status' => __('Status', 'quick-count'),
            'ip' => __('IP', 'quick-count')
        );

        if($quick_count->quick_flag_capable()){
            $columns['country'] = __('Country', 'quick-count');
        }

        if($quick_count->quick_browscap_capable()){
            $columns['browser'] = __('Browser', 'quick-count');
            $columns['platform'] = __('Platform', 'quick-count');
        }else{
            $columns['agent'] = __('Agent', 'quick-count');
        }

        $columns['title'] = __('Page', 'quick-count');
        $columns['referer'] = __('Referer', 'quick-count');
        $columns['joined'] = __('First Seen', 'quick-count');
        $columns['polled'] = __('Last Seen', 'quick-count');
        $columns['online'] = __('Online', 'quick-count');

        return $columns;
    }

    function get_sortable_columns() {
        global $quick_count;

        $sortable_columns = array(
            'title'     => array('title',false),
            'joined'     => array('joined', false),
            'polled'     => array('polled', false),
            'name'     => array('name', false),
            'status'     => array('status', false),
            'referer'     => array('referer', false),
            'online'     => array('online', false),
        );

        if($quick_count->quick_browscap_capable()){
            $sortable_columns['browser'] = array('bname', false);
            $sortable_columns['platform'] = array('pname', false);
        }else{
            $sortable_columns['agent'] = array('agent', false);
        }

        if($quick_count->quick_flag_capable()){
            $sortable_columns['country'] = array('cn', false);
        }

        return $sortable_columns;
    }

    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }


    function process_bulk_action() {
        global $quick_count;

        $ids = isset($_REQUEST['user']) ? $_REQUEST['user'] : array();

        if($this->current_action() === 'delete'){
            $quick_count->del_stats($ids);
        }
    }

    function prepare_items($start_timestamp, $end_timestamp) {
        global $quick_count;

        $per_page = 20;

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = array($columns, $hidden, $sortable);

        $this->process_bulk_action();

        $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'joined';
        $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'DESC';

        $current_page = $this->get_pagenum();

        $start = (($current_page-1)*$per_page);

        $total_items = $quick_count->get_visitors_count($start_timestamp, $end_timestamp);

        $this->items = $quick_count->get_visitors($start_timestamp, $end_timestamp, $orderby, $order, $start, $per_page);

        $this->set_pagination_args( array(
            'total_items' => $total_items,
            'per_page'    => $per_page,
            'total_pages' => ceil($total_items/$per_page)
        ) );
    }
}
?>