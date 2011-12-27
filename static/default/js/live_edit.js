
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
   
   $('.title_controls .photo').click(function(){
        // Send AJAX request..
        var data = {'photo_title': $(this).parent().children(".title_control").attr('value'),
                    'photo_id': $(this).parent().children(".photo_id").attr('value'),
                    'csrfmiddlewaretoken': $(this).parent().children(".csrf").attr('value')
                    };
        $.ajax({
            url: '{% url photo_manager.views.update_photo_title %}',
            data: data,
            type: 'POST',
            
        });
        $(this).parent().children(".button").hide();
        $(this).parent().children(".title_control").addClass("inactive");
   });
   
   $('.title_controls .album').click(function(){
    
    var data = {'album_title': $(this).parent().children(".title_control").attr('value'),
                'album_id': $(this).parent().children(".album_id").attr('value'),
                'csrfmiddlewaretoken': $(this).parent().children(".csrf").attr('value')
                };
                
    
    $.ajax({
            url: '{% url photo_manager.views.update_album_title %}',
            data: data,
            type: 'POST',
            
        });
        $(this).parent().children(".album").hide();
        $(this).parent().children(".title_control").addClass("inactive");
    
   });
   
 });
 
});