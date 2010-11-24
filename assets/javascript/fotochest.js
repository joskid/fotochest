jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loading_image : '../facebox/loading.gif',
        close_image   : '../facebox/closelabel.gif'});
      //$('a.button').facebox();
      $('a.preview').lightBox();
      
      $("a.reg").click(function(){
        
        var userEmail =$("input#userEmail").val();
        var userPassword =$("input#userPassword").val();
        var userFirstName =$("input#userFirstName").val();
        var userLastName =$("input#userLastName").val();
        var dataString = 'userEmail=' + userEmail + '&userPassword=' + userPassword + '&userFirstName=' + userFirstName + '&userLastName=' + userLastName;
        $('#addUser').html("<div id='load'></div>");
        $('#load').html("<img src='/assets/images/admin/ajax-loader.gif'>");
        $('#load').append("<h3>Processing...</h3>");
        
        $.ajax({
          type: "POST",
          url: "/admin/users/do_register",
          data: dataString,
          success: function(){
            $('#addUser').html("<div id='message'></div>");
            $('#message').html("<div class='notification success'><p>User Added</p></div>")
            .hide()
          }
        });
        return false;
      });
      
      // For adding an album
      
      $("a.addAlbumBtn").click(function(){
        var albumID =$("select#albumID").val();
        var albumName =$("input#albumName").val();
        var albumFriendlyName =$("input#albumFriendlyName").val();
        var dataString = 'albumName=' + albumName + '&albumFriendlyName=' + albumFriendlyName + '&albumID=' + albumID;
        $('#addAlbum').html("<div id='load'></div>");
        $('#load').html("<img src='/assets/images/admin/ajax-loader.gif'>");
        $('#load').append("<h3>Processing...</h3>");
        
        $.ajax({
          type: "POST",
          url: "/admin/albums/createAlbum",
          data: dataString,
          success: function(){
            $('#addAlbum').html("<div id='message'></div>");
            $('#message').html("<div class='notification success'><p>Album Added</p></div>")
            .hide()
            document.location.href="/admin/albums";
          }
        });
        return false;
      });
      

      // Save/update a photo
      
      $("a.savePhotoBtn").click(function(){
        
        var photoTitle = $('input#photoTitle').val();
        var albumID = $('input#albumID').val();
        var photoDesc = $('textarea#photoDescription').val();
        var photoID = $('input#photoID').val();
        var albumName = $('input#albumName').val();
        var isProfilePic = $('input#makeProfile').val();
        var isFrontEnd = $('input#isFront').val();
        var dataString = 'albumID=' + albumID + '&photoTitle=' + photoTitle + '&photoDesc=' + photoDesc + '&photoID=' + photoID + '&makeProfile=' + isProfilePic;
        $('#editPhoto').html("<div id='load'></div>");
        $('#load').html("<img src='/assets/images/admin/ajax-loader.gif'>");
        $('#load').append("<h3>Processing...</h3>");
        $.ajax({
          type: "POST",
          url: "/admin/photos/savePhoto",
          data: dataString,
          success: function(){
            $('#editPhoto').html("<div id='message'></div>");
            $('#message').html("<div class='notification success'><p>Photo Saved</p></div>")
            .hide()
            if (isFrontEnd == 'Y')
                {
                    document.location.href="/photos/view/" + albumName + "/" + photoID;
                }
            else
                {
                    document.location.href="/admin/dashboard";
                }
            
          }
        });
        return false;
      });
      
      // Refresh test
      
      $("a.refreshPhotos").click(function(){
            $('#dashContent').load('/admin/dashboard #dashContent', function() {
            alert('Load was performed.');
            });
            return false;
      });
      
      // save an album
      
      $("a.saveAlbum").click(function(){
        var albumFriendlyName = $('input#albumFriendlyName').val();
        var albumID = $('input#albumID').val();
        var albumDesc = $('textarea#albumDesc').val();
        var dataString = 'albumID=' + albumID + '&albumFriendlyName=' + albumFriendlyName + '&albumDesc=' + albumDesc;
        $('#editAlbum').html("<div id='load'></div>");
        $('#load').html("<img src='/assets/images/admin/ajax-loader.gif'>");
        $('#load').append("<h3>Processing...</h3>");
        $.ajax({
          type: "POST",
          url: "/admin/album/saveAlbum",
          data: dataString,
          success: function(){
            
            document.location.href="/admin/albums";
          }
        });
        return false;
            
      })

      $("a.saveUser").click(function(){

          var email = $('input#userEmail').val();
          var firstName = $('input#userFirstName').val();
          var lastName = $('input#userLastName').val();
          var password = $('input#userPassword').val();
          var userID = $('input#userUserID').val();

          var dataString = 'userEmail=' + email + '&userFirstName=' + firstName + '&userLastName=' + lastName + '&userUserID=' + userID + '&userPassword=' + password;

          $('#addUser').html("<div id='load'></div>");
          $('#load').html("<img src='/assets/images/admin/ajax-loader.gif'>");
          $('#load').append("<h3>Processing...</h3>");
          $.ajax({
          type: "POST",
          url: "/admin/users/do_userSave",
          data: dataString,
          success: function(){
           document.location.href="/admin/users";
           return false;
          }
        });
        return false;

      })

      // Delete User

      $("a.deleteUser").click(function(){

          var userID = $('input#userID').val();

          var dataString = 'userUserID=' + userID;
          $('#deleteUser').html("<div id='load'></div>");
          $('#load').html("<img src='/assets/images/admin/ajax-loader.gif'>");
          $('#load').append("<h3>Processing...</h3>");
          $.ajax({
          type: "POST",
          url: "/admin/users/do_userDelete",
          data: dataString,
          success: function(){
           document.location.href="/admin/users";
           return false;
          }
        });
        return false;
      })


      // Delete album

      $("a.deleteAlbum").click(function(){
          var albumID = $('input#albumID').val();
          
          var dataString = 'albumID=' + albumID;
          $('#deleteAlbum').html("<div id='load'></div>");
          $('#load').html("<img src='/assets/images/admin/ajax-loader.gif'>");
          $('#load').append("<h3>Processing...</h3>");
          $.ajax({
            type: "POST",
            url: "/admin/albums/do_delete",
            data: dataString,
            success: function(){
              $('#albumContent').load('/admin/albums #albumContent');
              jQuery(document).trigger('close.facebox');
           return false;
          }
        });
        return false;

      })

      // Delete User

      $("a.deletePhoto").click(function(){

         var photoID = $('input#photoID').val();

         var dataString = 'photoID=' + photoID;
         $('#deletePhoto').html("<div id='load'></div>");
         $('#load').html("<img src='/assets/images/admin/ajax-loader.gif'>");
         $('#load').append("<h3>Processing...</h3>");
         $.ajax({
            type: "POST",
            url: "/admin/photos/do_photoDelete",
            data: dataString,
            success: function(){
              document.location.href="/admin/dashboard";
           return false;
          }
        });
        return false;


      });

      $("a.arrowRight").click(function(){
         var photoID = $('input#photoID').val();
         var nextPhotoID = parseFloat(photoID) + 1;
         var photoURL = '/admin/viewPhoto/' + nextPhotoID + ' #viewPhoto';
         $('#viewPhoto').html("<img src='/assets/images/admin/ajax-loader.gif'>");
         
         $('#viewPhoto').load(photoURL);
         return false;

      });

      $('a.arrowLeft').click(function(){
         var photoID = $('input#photoID').val();
         var nextPhotoID = parseFloat(photoID) - 1;
         var photoURL = '/admin/viewPhoto/' + nextPhotoID + ' #viewPhoto';
         $('#viewPhoto').html("<img src='/assets/images/admin/ajax-loader.gif'>");

         $('#viewPhoto').load(photoURL);
         return false;

      });

      $('a.chooseAlbum').click(function(){
         var albumID = $('select#albumID').val();
         document.location.href="/admin/upload/" + albumID;
      });

      $('a.moveToAlbum').click(function(){
          var albumID = $('select#albumID').val();
          var photoID = $('input#photoID').val();
          document.location.href= "/admin/photos/movePhotoAction/" + photoID + "/" + albumID;
      })
      
    })