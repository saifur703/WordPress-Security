<?php 

/*Disable right click */
function disable_right_click() {
   ?>
<script>
jQuery(document).ready(function(){
    jQuery(document).bind("contextmenu",function(e){
        return false;
    });
});
</script>
<?php
}
add_action('wp_footer', 'disable_right_click');



