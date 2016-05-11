<form class="ui subscribe form" action="<?php print Juri::current(); ?>" accept-charset="utf-8" method="post">
    <div class="field">
        <div class="ui action input">
            <input type="email" name="subscribe[email]" placeholder="Email address" value="">
            <input type="birthday" name="subscribe[birthday]" placeholder="" style="display:none;">
            <div class="ui subscribe button"><i class="right arrow icon"></i></div>
        </div>
    </div>
</form>

<script>

    // Ready state 
    jQuery(document).ready(function() {

        // Validation
        $('.ui.subscribe.form').form({
            fields: {
                email: {
                identifier  : 'subscribe[email]',
                rules: [{
                        type   : 'empty',
                        prompt : 'Please enter your email address'
                    },{
                        type   : 'email',
                        prompt : 'Please enter a valid email address'
                    }]
                }
            }
        });

        // Submit the form on click
        jQuery(".ui.subscribe.button").click(function(){
            jQuery(".ui.subscribe.form").submit();
        });

    });

</script>