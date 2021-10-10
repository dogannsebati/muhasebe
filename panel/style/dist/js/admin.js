function postUrl() {
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    var post_url = baseUrl + '/panel/php/admin.php';
    return post_url;
}

function Alert(icon, mesaj, sure = 1500) {
    Swal.fire({
        position: 'top-end',
        icon: icon,
        title: mesaj,
        showConfirmButton: false,
        timer: sure
    })
}

function adminGiris(form_id, islem_turu) {
    var kulad = $('#kulad').val();
    var sifre = $('#sifre').val();
    if (kulad == null || kulad == "") {
        Alert('error', 'Kullanıcı adı boş olamaz !');
        $('#kulad').focus();
    } else if (sifre == null || sifre == "") {
        Alert('error', 'Şifre boş olamaz !');
        $('#sifre').focus();
    } else if (sifre.length < 6) {
        Alert('error', 'Şifreniz 6 haneden kısa olamaz !');
        $('#sifre').focus();
    } else {
        var formData = new FormData($('#' + form_id)[0]);
        formData.append('islem_turu', islem_turu);
        $.ajax({
            type: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            url: postUrl(),
            data: formData,
            beforeSend: function() {
                Alert('success', 'Giriş yapılıyor lütfen bekleyin...', 2000);
            },
            success: function(data) {
                var response = jQuery.parseJSON(data);
                if (response.success) {
                    var getUrl = window.location;
                    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                    Alert('success', response.message);
                    setInterval(function() {
                        $(location).attr('href', baseUrl + '/panel/index.php');
                    }, 1500);

                } else {
                    Alert('error', response.message);
                }

            }
        });
    }
}