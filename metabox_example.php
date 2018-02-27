
<?php
class add_metabox_name{
    protected static $metabox_config = array(
        'metabox_name', // Metabox Name
        'Titulo do metabox', // Metabox Title
        'post', // PostType do Metabox
        'normal'
    );
    static function init() {
        add_action('add_meta_boxes', array(__CLASS__, 'addMetaBox'));
        add_action('save_post', array(__CLASS__, 'savePost'));
    }
    static function addMetaBox() {
        add_meta_box(
            self::$metabox_config[0],
            self::$metabox_config[1],
            array(__CLASS__, 'metabox'),
            self::$metabox_config[2],
            self::$metabox_config[3]
        );
    }
    static function metabox(){
        global $post;
        wp_nonce_field( 'save_'.__CLASS__, __CLASS__.'_noncename' );
        $metadata = get_metadata('post', $post->ID);
        if(!isset($metadata['metabox_name'])){ //Name do Metabox
           $content = "";
        }else{
            $content = $metadata['metabox_name'][0]; //Name do Metabox
        };
    ?>  
        <!-- Tipos de Campos-->
        <textarea name="<?php echo __CLASS__ ?>[metabox_name]" style="background-color: #fff; font-size: 1.7em; height: 4em; line-height: 100%; margin: 0; outline: 0; padding: 3px 8px; width: 100%;">
        	<?php echo $content; ?>
        </textarea>

        <!-- Tipos de Campos-->
        <input type="number" name="<?php echo __CLASS__ ?>[metabox_name]" value="<?php echo $content; ?>" style="background-color: #fff; font-size: 1.7em; height: 1.7em; line-height: 100%; margin: 0; outline: 0; padding: 3px 8px; width: 100%;" />

          <!-- Tipos de Campos-->
        <input type="text" name="<?php echo __CLASS__ ?>[metabox_name]" value="<?php echo  $content; ?>" style="background-color: #fff; font-size: 1.7em; height: 1.7em; line-height: 100%; margin: 0; outline: 0; padding: 3px 8px; width: 100%;" />

         <!-- Tipos de Campos -  Campo para adicionar icones, adicionar js de fontawesome-->
        <input data-hide-on-select="true" name="<?php echo __CLASS__ ?>[icone_awesome]" class="js-icon-rede-social form-control pck pck-auto picker-element picker-input " value="<?php echo $icone; ?>" type="text">
        <span class="input-group-addon iconpicker-component"><i class="fa fa-fw fa-archive"></i></span>

        <?php
    }
    static function savePost($post_id) {
        // verify if this is an auto save routine.
        // If it is our form has not been submitted, so we dont want to do anything
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;
        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if(!isset($_POST[__CLASS__.'_noncename']))
            return;
        if (!wp_verify_nonce($_POST[__CLASS__.'_noncename'], 'save_'.__CLASS__))
            return;
        // Check permissions
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id))
                return;
        }
        else {
            if (!current_user_can('edit_post', $post_id))
                return;
        }
        // OK, we're authenticated: we need to find and save the data
        if(isset($_POST[__CLASS__])){
            foreach($_POST[__CLASS__] as $meta_key => $value)
                update_post_meta($post_id, $meta_key, $value);
        }
    }
}
add_metabox_name::init();
