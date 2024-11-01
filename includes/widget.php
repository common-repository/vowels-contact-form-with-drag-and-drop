<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;

/**
 * Standard vowelsforminc Widget to display a form
 */
class vowelsformincWidget extends WP_Widget
{
    public function __construct()
    {
        $options = array(
            'description' => __('Display one of your created forms', 'vowels-contact-form-with-drag-and-drop'),
            'classname' => 'vowels-widget'
        );

        parent::__construct('vowels-widget', $name = 'Vowelsform', $options);
    }

    /**
     * Display the widget
     *
     * @param  array  $args      Display arguments
     * @param  array  $instance  The settings for this widget instance
     */
    public function widget($args, $instance)
    {
        if (!isset($instance['title'])) $instance['title'] = '';
        if (!isset($instance['form_id'])) $instance['form_id'] = 0;

        if (vowels_form_builder_form_exists($instance['form_id'])) {
            extract($args);

            echo $before_widget;

            $title = apply_filters('widget_title', $instance['title']);
            if (strlen($title)) {
                echo $before_title . $title . $after_title;
            }

            echo vowels($instance['form_id']);

            echo $after_widget;
        }
    }

    /**
     * Update the widget settings
     *
     * @param   array  $new_instance  New settings for this widget instance
     * @param   array  $old_instance  Old settings for this widget instance
     * @return  array                 New settings for this widget instance
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['form_id'] = $new_instance['form_id'];
        return $instance;
    }

    /**
     * Display the widget settings form
     *
     * @param  array  $instance  The current settings for this widget instance
     */
    public function form($instance)
    {
        $formRows = vowels_form_builder_get_all_form_rows();
        if (!isset($instance['title'])) $instance['title'] = '';
        if (!isset($instance['form_id'])) $instance['form_id'] = 0;
        ?>
        <?php if (count($formRows)) : ?>
        <div>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title (optional)','vowels-contact-form-with-drag-and-drop'); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </div>
        <div style="margin-top: 10px;">
            <label for="<?php echo $this->get_field_id('form_id'); ?>"><?php esc_html_e('Select a form','vowels-contact-form-with-drag-and-drop'); ?></label>
            <select id="<?php echo $this->get_field_id('form_id'); ?>" name="<?php echo $this->get_field_name('form_id'); ?>">
            <?php foreach ($formRows as $formRow) : ?>
                <?php $config = vowels_form_builder_get_form_config($formRow->id); ?>
                <option value="<?php echo absint($config['id']); ?>" <?php selected($instance['form_id'], $config['id']); ?>><?php echo esc_html($config['name']); ?></option>
            <?php endforeach; ?>
            </select>
        </div>
        <?php else : ?>
            <?php printf(esc_html__('You have not created a form yet, %sclick here to create one%s.', 'vowels-contact-form-with-drag-and-drop'), '<a href="' . admin_url('admin.php?page=vowels_form_builder_form_builder') . '">', '</a>'); ?>
        <?php endif; ?>
        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget("vowelsformincWidget");'));

/**
 * Widget to display a form in popup (lightbox)
 */
class vowelsformincPopupWidget extends WP_Widget
{

    public function __construct()
    {
        $options = array(
            'description' => __('Display one of your created forms in a popup (lightbox)', 'vowels-contact-form-with-drag-and-drop'),
            'classname' => 'vowels-popup-widget'
        );

        parent::__construct('vowels-popup-widget', $name = 'Vowelsform Popup', $options);
    }

    /**
     * Display the widget
     *
     * @param  array  $args      Display arguments
     * @param  array  $instance  The settings for this widget instance
     */
    public function widget($args, $instance)
    {
        if (vowels_form_builder_form_exists($instance['form_id'])) {
            extract($args);

            echo $before_widget;

            $title = apply_filters('widget_title', $instance['title']);
            if ($title) {
                echo $before_title . $title . $after_title;
            }

            echo vowels_form_builder_popup($instance['form_id'], $instance['content'], $instance['options']);

            echo $after_widget;
        }
    }

    /**
     * Update the widget settings
     *
     * @param   array  $new_instance  New settings for this widget instance
     * @param   array  $old_instance  Old settings for this widget instance
     * @return  array                 New settings for this widget instance
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['form_id'] = $new_instance['form_id'];
        $instance['content'] = $new_instance['content'];
        $instance['options'] = $new_instance['options'];
        update_option('vowels_form_builder_fancybox_requested', true);
        return $instance;
    }

    /**
     * Display the widget settings form
     *
     * @param  array  $instance  The current settings for this widget instance
     */
    public function form($instance)
    {
        $formRows = vowels_form_builder_get_all_form_rows();
        if (!isset($instance['title'])) $instance['title'] = '';
        if (!isset($instance['form_id'])) $instance['form_id'] = 0;
        if (!isset($instance['content'])) $instance['content'] = '';
        if (!isset($instance['options'])) $instance['options'] = '';
        ?>
        <?php if (count($formRows)) : ?>
        <div>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title (optional)','vowels-contact-form-with-drag-and-drop'); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </div>
        <div style="margin-top: 10px;">
            <label for="<?php echo $this->get_field_id('form_id'); ?>"><?php esc_html_e('Select a form','vowels-contact-form-with-drag-and-drop'); ?></label>
            <select id="<?php echo $this->get_field_id('form_id'); ?>" name="<?php echo $this->get_field_name('form_id'); ?>">
            <?php foreach ($formRows as $formRow) : ?>
                <?php $config = vowels_form_builder_get_form_config($formRow->id); ?>
                <option value="<?php echo absint($config['id']); ?>" <?php selected($instance['form_id'], $config['id']); ?>><?php echo esc_html($config['name']); ?></option>
            <?php endforeach; ?>
            </select>
        </div>
        <div style="margin-top: 10px;">
            <label for="<?php echo $this->get_field_id('content'); ?>"><?php esc_html_e('Text or HTML to trigger the popup','vowels-contact-form-with-drag-and-drop'); ?></label>
            <textarea id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>" class="widefat"><?php echo esc_attr($instance['content']); ?></textarea>
        </div>
        <div style="margin-top: 10px;">
            <label for="<?php echo $this->get_field_id('options'); ?>"><?php esc_html_e('Fancybox options (advanced)','vowels-contact-form-with-drag-and-drop'); ?></label>
            <input type="text" class="widefat" name="<?php echo $this->get_field_name('options'); ?>" id="<?php echo $this->get_field_id('options'); ?>" value="<?php echo esc_attr($instance['options']); ?>" />
            <p class="description" style="margin-bottom: 3px;"><?php printf(esc_html__('Enter any Fancybox options as a JSON formatted string, %sexample%s.', 'vowels-contact-form-with-drag-and-drop'), '<a href="'.admin_url('admin.php?page=vowels_form_builder_help&amp;section=faq#website-lightbox-widget-options').'" onclick="window.open(this.href); return false;">', '</a>'); ?></p>
        </div>
        <?php else : ?>
            <?php printf(esc_html__('You have not created a form yet, %sclick here to create one%s.', 'vowels-contact-form-with-drag-and-drop'), '<a href="' . admin_url('admin.php?page=vowels_form_builder_form_builder') . '">', '</a>'); ?>
        <?php endif; ?>
        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget("vowelsformincPopupWidget");'));
