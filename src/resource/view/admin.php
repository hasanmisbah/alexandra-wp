<div class="wrap">
    <h1>Hello World</h1>
    <?php settings_errors() ;?>
        <?php
            echo \Alexandra\Base\Form::open('options.php', 'post');
                settings_fields(ALEXANDRA_PREFIX . '_options_group');
                do_settings_sections('alexandra');
                submit_button();
            echo \Alexandra\Base\Form::close();
        ?>
</div>
