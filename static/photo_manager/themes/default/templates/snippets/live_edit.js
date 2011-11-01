    <script>
     $(document).ready(function() {
     // Hide all save buttons.
     // Show just the one next to the input on click.
    $('.title_controls .button').hide();
    $('.title_control').addClass('inactive');
   
   $('.title_control').click(function(){
        $(this).parent().children(".button").show();
        $(this).removeClass('inactive');
        $(this).select();
   });
   
   $('.title_controls .button').click(function(){
        // Send AJAX request..
        var data = {'photo_title': $(this).parent().children(".title_control").attr('value'),
                    'photo_id': $(this).parent().children(".photo_id").attr('value')
                    };
        $.ajax({
            url: '{% url photo_manager.views.update_photo_title %}',
            data: data,
            type: 'POST',
            
        });
        $(this).parent().children(".button").hide();
        $(this).parent().children(".title_control").addClass("inactive");
   });
   
 });
 
</script>