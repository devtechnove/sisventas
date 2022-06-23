$(document).ready(function(){

  $('#main-form').submit(function(){

        $('.missing_alert').css('display', 'none');

        if ($('#main-form #email-username').val() === '') {
            $('#main-form #email-username_alert').text('Ingrese correo electrónico o el usuario').show();
            $('#main-form #email-username').addClass('is-invalid');
            $('#main-form #email-username').focus();
            return false;
        }

        valor = document.getElementById("email-username").value;

         if(  /^\s+$/.test(valor) || /\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)/.test(valor) ) {

            $('#main-form #email-username_alert').text('Sólo se admiten letras').show();
            $('#main-form #email-username').addClass('is-invalid');
            $('#main-form #email-username').focus();

            return false;
          }
         

        if ($('#main-form #password').val() === '') {
            $('#main-form #password').focus();
            $('#main-form #password_alert').text('Ingrese contraseña').show();
            return false;
        }

        var data = $('#main-form').serialize();
        $('#main-form input, #main-form button').attr('disabled','true');
        $('#ajax-icon').removeClass('fa fa-sign-in').addClass('fa fa-spin fa-refresh');

       
            $.ajax({
              url: $('#main-form #_url').val(),
    		      headers: {'X-CSRF-TOKEN': $('#main-form #_token').val()},
    		      type: 'POST',
              cache: false,
    	        data: data,
              success: function (response) {
                 if(response === 'authenticated.true'){
                   $('#ajax-icon').removeClass('fa fa-spin fa-refresh').addClass('fa fa-sign-in');
                   toastr.success('Usuario logueado exitosamente');
                   $(location).attr('href', $('#main-form #_redirect').val());
                  }
              },error: function (data) {
                var errors = data.responseJSON;
                $.each( errors.errors, function( key, value ) {
                  toastr.error(value);
                  return false;
                });
                $('#main-form input, #main-form button').removeAttr('disabled');
                $('#ajax-icon').removeClass('fa fa-spin fa-refresh').addClass('fa fa-sign-in');
            }
           });

       return false;

    });
});