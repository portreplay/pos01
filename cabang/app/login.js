$(document).ready(function(){
    $('#form-login-gudang').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: 'Username atau email tidak boleh kosong'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Password tidak boleh kosong'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
        $.ajax({
            url: 'core/send_data/login.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(hasil) {
                if(hasil == 'ok') {
                    window.location = 'index.php';
                    $('.login-box-body').slideDown(3000).after('<div class="alert alert-success text-center" id="success-m"><h5>Anda Berhasil Login.</h5></div>');
                }else {
                   $('.login-box-body').slideDown(3000).after('<div class="alert alert-danger" id="error-m"><h5>Mohon masukan Username/Email atau Password yang valid</h5></div>');
                    setTimeout(function(){
                        $('#error-m').fadeOut(7000);
                    });
                }
            }
        });
    e.preventDefault();
    })
});