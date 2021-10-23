function postUrl() {
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    var post_url = baseUrl + '/bmg3-muhasebe/panel/php/admin.php';
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
                console.log(data);
                var response = jQuery.parseJSON(data);
                if (response.success) {
                    var getUrl = window.location;
                    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                    Alert('success', response.message);
                    setInterval(function() {
                        $(location).attr('href', baseUrl + '/bmg3-muhasebe/panel/index.php');
                    }, 1500);

                } else {
                    Alert('error', response.message);
                }

            }
        });
    }
}

function postUrl() {
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    var post_url = baseUrl + '/bmg3-muhasebe/panel/php/admin.php';
    return post_url;
}

$('#select_all').click(function() {
    var c = this.checked;
    console.log(c);
    $(':checkbox').prop('checked', c);
    if (c) {
        console.log("Hepsi seçildi");
    } else {
        console.log("Seçililer kalktı");
    }
});

function masrafEkle(form_id, islem_turu) {
    var masraf_baslik = $('#masraf_baslik').val();
    var masraf_aciklama = $('#masraf_aciklama').val();
    var masraf_zaman = $('#masraf_zaman').val();
    var masraf_kategori = $('#masraf_kategori').val();
    var masraf_tutar = $('#masraf_tutar').val();

    if (masraf_baslik == null || masraf_baslik == "") {
        $('#masraf_baslik').focus();
        Alert('error', 'Masraf adı boş olamaz !');
    } else if (masraf_aciklama == null || masraf_aciklama == "") {
        Alert('error', 'Masraf açıklama boş olamaz !');
        $('#masraf_aciklama').focus();
    } else if (masraf_zaman == null || masraf_zaman == "") {
        Alert('error', 'Masraf zaman boş olamaz !');
        $('#masraf_zaman').focus();
    } else if (masraf_kategori == null || masraf_kategori == "") {
        Alert('error', 'Masraf kategori boş olamaz !');
        $('#masraf_kategori').focus();
    } else if (masraf_tutar == null || masraf_tutar == "") {
        Alert('error', 'Masraf tutar boş olamaz !');
        $('#masraf_tutar').focus();
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
                Alert('success', 'Masraf ekleniyor lütfen bekleyin...', 2000);
            },
            success: function(data) {
                var response = jQuery.parseJSON(data);
                if (response.success) {
                    var getUrl = window.location;
                    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                    Alert('success', response.message);
                    setInterval(function() {
                        $(location).attr('href', baseUrl + '/bmg3-muhasebe/panel/index.php?page=masraflar');
                    }, 1500);
                } else {
                    Alert('error', response.message);
                }

            }
        });

    }
}

function masrafSil(id, islem_turu) {
    Swal.fire({
        title: 'Emin misiniz?',
        text: "Masraf silinecektir emin misiniz ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Tamam',
        cancelButtonText: 'İptal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: postUrl(),
                data: { id: id, islem_turu: islem_turu },
                beforeSend: function() {
                    Alert('success', 'Masraf siliniyor lütfen bekleyin...', 2000);
                },
                success: function(data) {
                    var response = jQuery.parseJSON(data);
                    if (response.success) {
                        var getUrl = window.location;
                        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                        Alert('success', response.message);
                        setInterval(function() {
                            $(location).attr('href', baseUrl + '/bmg3-muhasebe/panel/index.php?page=masraflar');
                        }, 1500);
                    } else {
                        Alert('error', response.message);
                    }

                }
            });
        }
    })
}

function masrafTopluIslem(form_id, islem_turu) {
    Swal.fire({
        title: 'Emin misiniz?',
        text: "Masraflar silinecektir emin misiniz ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Tamam',
        cancelButtonText: 'İptal'
    }).then((result) => {
        if (result.isConfirmed) {
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
                    Alert('success', 'Masraflar siliniyor lütfen bekleyin...', 2000);
                },
                success: function(data) {
                    var response = jQuery.parseJSON(data);
                    if (response.success) {
                        Alert('success', response.message);
                        setInterval(function() {
                            window.location.reload();
                        }, 1500);
                    } else {
                        Alert('error', response.message);
                    }

                }
            });
        }
    })
}


function masrafDuzenle(form_id, islem_turu) {
    var masraf_baslik = $('#masraf_baslik').val();
    var masraf_aciklama = $('#masraf_aciklama').val();
    var masraf_zaman = $('#masraf_zaman').val();
    var masraf_kategori = $('#masraf_kategori').val();
    var masraf_tutar = $('#masraf_tutar').val();

    if (masraf_baslik == null || masraf_baslik == "") {
        $('#masraf_baslik').focus();
        Alert('error', 'Masraf adı boş olamaz !');
    } else if (masraf_aciklama == null || masraf_aciklama == "") {
        Alert('error', 'Masraf açıklama boş olamaz !');
        $('#masraf_aciklama').focus();
    } else if (masraf_zaman == null || masraf_zaman == "") {
        Alert('error', 'Masraf zaman boş olamaz !');
        $('#masraf_zaman').focus();
    } else if (masraf_kategori == null || masraf_kategori == "") {
        Alert('error', 'Masraf kategori boş olamaz !');
        $('#masraf_kategori').focus();
    } else if (masraf_tutar == null || masraf_tutar == "") {
        Alert('error', 'Masraf tutar boş olamaz !');
        $('#masraf_tutar').focus();
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
                Alert('success', 'Masraf düzenleniyor lütfen bekleyin...', 2000);
            },
            success: function(data) {
                var response = jQuery.parseJSON(data);
                if (response.success) {
                    Alert('success', response.message);
                    setInterval(function() {
                        window.location.reload();
                    }, 1500);
                } else {
                    Alert('error', response.message);
                }
            }
        });
    }
}



function odemeEkle(form_id, islem_turu) {
    var odeme_baslik = $('#odeme_baslik').val();
    var odeme_aciklama = $('#odeme_aciklama').val();
    var odeme_kime = $('#odeme_kime').val();
    var odeme_zaman = $('#odeme_zaman').val();
    var odeme_tutar = $('#odeme_tutar').val();
    var para_alinan_zaman = $('#para_alinan_zaman').val();

    if (odeme_baslik == null || odeme_baslik == "") {
        $('#odeme_baslik').focus();
        Alert('error', 'Ödeme adı boş olamaz !');
    } else if (odeme_aciklama == null || odeme_aciklama == "") {
        Alert('error', 'Ödeme açıklama boş olamaz !');
        $('#odeme_aciklama').focus();
    } else if (odeme_kime == null || odeme_kime == "") {
        Alert('error', 'İsim boş olamaz !');
        $('#odeme_kime').focus();
    } else if (odeme_zaman == null || odeme_zaman == "") {
        Alert('error', 'Ödeme zaman boş olamaz !');
        $('#odeme_zaman').focus();
    } else if (odeme_tutar == null || odeme_tutar == "") {
        Alert('error', 'Ödeme tutar boş olamaz !');
        $('#odeme_tutar').focus();
    } else if (para_alinan_zaman == null || para_alinan_zaman == "") {
        Alert('error', 'Ödeme alınan zaman boş olamaz !');
        $('#para_alinan_zaman').focus();
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
                Alert('success', 'Ödeme ekleniyor lütfen bekleyin...', 2000);
            },
            success: function(data) {
                var response = jQuery.parseJSON(data);
                if (response.success) {
                    var getUrl = window.location;
                    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                    Alert('success', response.message);
                    setInterval(function() {
                        $(location).attr('href', baseUrl + '/bmg3-muhasebe/panel/index.php?page=odemeler');
                    }, 1500);
                } else {
                    Alert('error', response.message);
                }

            }
        });

    }
}

function odemeSil(id, islem_turu) {
    Swal.fire({
        title: 'Emin misiniz?',
        text: "Ödeme silinecektir emin misiniz ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Tamam',
        cancelButtonText: 'İptal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: postUrl(),
                data: { id: id, islem_turu: islem_turu },
                beforeSend: function() {
                    Alert('success', 'Ödeme siliniyor lütfen bekleyin...', 2000);
                },
                success: function(data) {
                    var response = jQuery.parseJSON(data);
                    if (response.success) {
                        var getUrl = window.location;
                        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                        Alert('success', response.message);
                        setInterval(function() {
                            $(location).attr('href', baseUrl + '/bmg3-muhasebe/panel/index.php?page=odemeler');
                        }, 1500);
                    } else {
                        Alert('error', response.message);
                    }

                }
            });
        }
    })
}


function odemeTopluIslem(form_id, islem_turu) {
    Swal.fire({
        title: 'Emin misiniz?',
        text: "Ödemeler silinecektir emin misiniz ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Tamam',
        cancelButtonText: 'İptal'
    }).then((result) => {
        if (result.isConfirmed) {
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
                    Alert('success', 'Ödemeler siliniyor lütfen bekleyin...', 2000);
                },
                success: function(data) {
                    var response = jQuery.parseJSON(data);
                    if (response.success) {
                        Alert('success', response.message);
                        setInterval(function() {
                            window.location.reload();
                        }, 1500);
                    } else {
                        Alert('error', response.message);
                    }

                }
            });
        }
    })
}


function odemeDuzenle(form_id, islem_turu) {
    var odeme_baslik = $('#odeme_baslik').val();
    var odeme_aciklama = $('#odeme_aciklama').val();
    var odeme_kime = $('#odeme_kime').val();
    var odeme_zaman = $('#odeme_zaman').val();
    var odeme_tutar = $('#odeme_tutar').val();
    var para_alinan_zaman = $('#para_alinan_zaman').val();

    if (odeme_baslik == null || odeme_baslik == "") {
        $('#odeme_baslik').focus();
        Alert('error', 'Ödeme adı boş olamaz !');
    } else if (odeme_aciklama == null || odeme_aciklama == "") {
        Alert('error', 'Ödeme açıklama boş olamaz !');
        $('#odeme_aciklama').focus();
    } else if (odeme_kime == null || odeme_kime == "") {
        Alert('error', 'İsim boş olamaz !');
        $('#odeme_kime').focus();
    } else if (odeme_zaman == null || odeme_zaman == "") {
        Alert('error', 'Ödeme zaman boş olamaz !');
        $('#odeme_zaman').focus();
    } else if (odeme_tutar == null || odeme_tutar == "") {
        Alert('error', 'Ödeme tutar boş olamaz !');
        $('#odeme_tutar').focus();
    } else if (para_alinan_zaman == null || para_alinan_zaman == "") {
        Alert('error', 'Ödeme alınan zaman boş olamaz !');
        $('#para_alinan_zaman').focus();
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
                Alert('success', 'Ödeme düzenleniyor lütfen bekleyin...', 2000);
            },
            success: function(data) {
                var response = jQuery.parseJSON(data);
                if (response.success) {
                    Alert('success', response.message);
                    setInterval(function() {
                        window.location.reload();
                    }, 1500);
                } else {
                    Alert('error', response.message);
                }

            }
        });

    }
}