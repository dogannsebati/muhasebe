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
                console.log(data);
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

function postUrl() {
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    var post_url = baseUrl + '/panel/php/admin.php';
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
                        $(location).attr('href', baseUrl + '/panel/index.php?page=masraflar');
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
                            $(location).attr('href', baseUrl + '/panel/index.php?page=masraflar');
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
                        $(location).attr('href', baseUrl + '/panel/index.php?page=odemeler');
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
                            $(location).attr('href', baseUrl + '/panel/index.php?page=odemeler');
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

function personelEkle(form_id, islem_turu) {
    var calisan_isim = $('#calisan_isim').val();
    var calisan_yas = $('#calisan_yas').val();
    var calisan_bolum = $('#calisan_bolum').val();
    var calisan_maas = $('#calisan_maas').val();
    var ise_baslama_tarih = $('#ise_baslama_tarih').val();

    if (calisan_isim == null || calisan_isim == "") {
        $('#calisan_isim').focus();
        Alert('error', 'Çalışan adı boş olamaz !');
    } else if (calisan_yas == null || calisan_yas == "") {
        Alert('error', 'Çalışan yaş boş olamaz !');
        $('#calisan_yas').focus();
    } else if (calisan_bolum == null || calisan_bolum == "") {
        Alert('error', 'Çalışan bölüm boş olamaz !');
        $('#calisan_bolum').focus();
    } else if (calisan_maas == null || calisan_maas == "") {
        Alert('error', 'Çalışan maaş boş olamaz !');
        $('#calisan_maas').focus();
    } else if (ise_baslama_tarih == null || ise_baslama_tarih == "") {
        Alert('error', 'İşe başlama tarihi boş olamaz !');
        $('#ise_baslama_tarih').focus();
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
                Alert('success', 'Personel ekleniyor lütfen bekleyin...', 2000);
            },
            success: function(data) {
                var response = jQuery.parseJSON(data);
                if (response.success) {
                    var getUrl = window.location;
                    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                    Alert('success', response.message);
                    setInterval(function() {
                        $(location).attr('href', baseUrl + '/panel/index.php?page=personel');
                    }, 1500);
                } else {
                    Alert('error', response.message);
                }

            }
        });

    }

}

function personelSil(id, islem_turu) {
    Swal.fire({
        title: 'Emin misiniz?',
        text: "Personel silinecektir emin misiniz ?",
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
                    Alert('success', 'Personel siliniyor lütfen bekleyin...', 2000);
                },
                success: function(data) {
                    var response = jQuery.parseJSON(data);
                    if (response.success) {
                        var getUrl = window.location;
                        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                        Alert('success', response.message);
                        setInterval(function() {
                            $(location).attr('href', baseUrl + '/panel/index.php?page=personel');
                        }, 1500);
                    } else {
                        Alert('error', response.message);
                    }

                }
            });
        }
    })
}


function personelDuzenle(form_id, islem_turu) {
    var calisan_isim = $('#calisan_isim').val();
    var calisan_yas = $('#calisan_yas').val();
    var calisan_bolum = $('#calisan_bolum').val();
    var calisan_maas = $('#calisan_maas').val();
    var ise_baslama_tarih = $('#ise_baslama_tarih').val();

    if (calisan_isim == null || calisan_isim == "") {
        $('#calisan_isim').focus();
        Alert('error', 'Çalışan adı boş olamaz !');
    } else if (calisan_yas == null || calisan_yas == "") {
        Alert('error', 'Çalışan yaş boş olamaz !');
        $('#calisan_yas').focus();
    } else if (calisan_bolum == null || calisan_bolum == "") {
        Alert('error', 'Çalışan bölüm boş olamaz !');
        $('#calisan_bolum').focus();
    } else if (calisan_maas == null || calisan_maas == "") {
        Alert('error', 'Çalışan maaş boş olamaz !');
        $('#calisan_maas').focus();
    } else if (ise_baslama_tarih == null || ise_baslama_tarih == "") {
        Alert('error', 'İşe başlama tarihi boş olamaz !');
        $('#ise_baslama_tarih').focus();
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
                Alert('success', 'Personel düzenleniyor lütfen bekleyin...', 2000);
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


function personelTopluIslem(form_id, islem_turu) {
    Swal.fire({
        title: 'Emin misiniz?',
        text: "Personeller silinecektir emin misiniz ?",
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
                    Alert('success', 'Personeller siliniyor lütfen bekleyin...', 2000);
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


function alacakEkle(form_id, islem_turu) {
    var alacak_isim = $('#alacak_isim').val();
    var alacak_aciklama = $('#alacak_aciklama').val();
    var alacak_tutar = $('#alacak_tutar').val();
    var alacak_zaman = $('#alacak_zaman').val();

    if (alacak_isim == null || alacak_isim == "") {
        $('#alacak_isim').focus();
        Alert('error', 'Alacak adı boş olamaz !');
    } else if (alacak_aciklama == null || alacak_aciklama == "") {
        Alert('error', 'Açıklama boş olamaz !');
        $('#alacak_aciklama').focus();
    } else if (alacak_tutar == null || alacak_tutar == "") {
        Alert('error', 'Tutar boş olamaz !');
        $('#alacak_tutar').focus();
    } else if (alacak_zaman == null || alacak_zaman == "") {
        Alert('error', 'Zaman boş olamaz !');
        $('#alacak_zaman').focus();
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
                Alert('success', 'Alacak ekleniyor lütfen bekleyin...', 2000);
            },
            success: function(data) {
                var response = jQuery.parseJSON(data);
                if (response.success) {
                    var getUrl = window.location;
                    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                    Alert('success', response.message);
                    setInterval(function() {
                        $(location).attr('href', baseUrl + '/panel/index.php?page=alacaklar');
                    }, 1500);
                } else {
                    Alert('error', response.message);
                }

            }
        });

    }

}

function alacakDuzenleme(form_id, islem_turu) {
    var alacak_isim = $('#alacak_isim').val();
    var alacak_aciklama = $('#alacak_aciklama').val();
    var alacak_tutar = $('#alacak_tutar').val();
    var alacak_zaman = $('#alacak_zaman').val();

    if (alacak_isim == null || alacak_isim == "") {
        $('#alacak_isim').focus();
        Alert('error', 'Alacak adı boş olamaz !');
    } else if (alacak_aciklama == null || alacak_aciklama == "") {
        Alert('error', 'Açıklama boş olamaz !');
        $('#alacak_aciklama').focus();
    } else if (alacak_tutar == null || alacak_tutar == "") {
        Alert('error', 'Tutar boş olamaz !');
        $('#alacak_tutar').focus();
    } else if (alacak_zaman == null || alacak_zaman == "") {
        Alert('error', 'Zaman boş olamaz !');
        $('#alacak_zaman').focus();
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
                Alert('success', 'Alacak düzenleniyor lütfen bekleyin...', 2000);
            },
            success: function(data) {
                var response = jQuery.parseJSON(data);
                if (response.success) {
                    var getUrl = window.location;
                    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                    Alert('success', response.message);
                    setInterval(function() {
                        $(location).attr('href', baseUrl + '/panel/index.php?page=alacaklar');
                    }, 1500);
                } else {
                    Alert('error', response.message);
                }

            }
        });

    }
}

function alacakSil(id, islem_turu) {
    Swal.fire({
        title: 'Emin misiniz?',
        text: "Alacak silinecektir emin misiniz ?",
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
                    Alert('success', 'Alacak siliniyor lütfen bekleyin...', 2000);
                },
                success: function(data) {
                    var response = jQuery.parseJSON(data);
                    if (response.success) {
                        var getUrl = window.location;
                        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                        Alert('success', response.message);
                        setInterval(function() {
                            $(location).attr('href', baseUrl + '/panel/index.php?page=alacaklar');
                        }, 1500);
                    } else {
                        Alert('error', response.message);
                    }

                }
            });
        }
    })
}

function alacakTopluIslem(form_id, islem_turu) {
    Swal.fire({
        title: 'Emin misiniz?',
        text: "Alacaklar silinecektir emin misiniz ?",
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
                    Alert('success', 'Alacaklar siliniyor lütfen bekleyin...', 2000);
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

function satisEkle(form_id, islem_turu) {
    var satis_baslik = $('#satis_baslik').val();
    var satis_aciklama = $('#satis_aciklama').val();
    var satis_zaman = $('#satis_zaman').val();
    var satis_tutar = $('#satis_tutar').val();
    var satis_odeme = $('#satis_odeme').val();


    if (satis_baslik == null || satis_baslik == "") {
        $('#satis_baslik').focus();
        Alert('error', 'Başlık boş olamaz !');
    } else if (satis_aciklama == null || satis_aciklama == "") {
        Alert('error', 'Açıklama boş olamaz !');
        $('#satis_aciklama').focus();
    } else if (satis_tutar == null || satis_tutar == "") {
        Alert('error', 'Tutar boş olamaz !');
        $('#satis_tutar').focus();
    } else if (satis_zaman == null || satis_zaman == "") {
        Alert('error', 'Zaman boş olamaz !');
        $('#satis_zaman').focus();
    } else if (satis_odeme == null || satis_odeme == "") {
        Alert('error', 'Zaman boş olamaz !');
        $('#satis_odeme').focus();
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
                Alert('success', 'Satış ekleniyor lütfen bekleyin...', 2000);
            },
            success: function(data) {
                var response = jQuery.parseJSON(data);
                if (response.success) {
                    var getUrl = window.location;
                    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                    Alert('success', response.message);
                    setInterval(function() {
                        $(location).attr('href', baseUrl + '/panel/index.php?page=satislar');
                    }, 1500);
                } else {
                    Alert('error', response.message);
                }

            }
        });

    }

}

function satisDuzenleme(form_id, islem_turu) {
    var satis_baslik = $('#satis_baslik').val();
    var satis_aciklama = $('#satis_aciklama').val();
    var satis_zaman = $('#satis_zaman').val();
    var satis_tutar = $('#satis_tutar').val();
    var satis_odeme = $('#satis_odeme').val();


    if (satis_baslik == null || satis_baslik == "") {
        $('#satis_isim').focus();
        Alert('error', 'Alacak adı boş olamaz !');
    } else if (satis_aciklama == null || satis_aciklama == "") {
        Alert('error', 'Açıklama boş olamaz !');
        $('#satis_aciklama').focus();
    } else if (satis_tutar == null || satis_tutar == "") {
        Alert('error', 'Tutar boş olamaz !');
        $('#satis_tutar').focus();
    } else if (satis_zaman == null || satis_zaman == "") {
        Alert('error', 'Zaman boş olamaz !');
        $('#satis_zaman').focus();
    } else if (satis_odeme == null || satis_odeme == "") {
        Alert('error', 'Ödeme boş olamaz !');
        $('#satis_odeme').focus();
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
                Alert('success', 'Satışlar düzenleniyor lütfen bekleyin...', 2000);
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

function satisSil(id, islem_turu) {
    Swal.fire({
        title: 'Emin misiniz?',
        text: "Satış silinecektir emin misiniz ?",
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
                    Alert('success', 'Satış siliniyor lütfen bekleyin...', 2000);
                },
                success: function(data) {
                    var response = jQuery.parseJSON(data);
                    if (response.success) {
                        var getUrl = window.location;
                        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                        Alert('success', response.message);
                        setInterval(function() {
                            $(location).attr('href', baseUrl + '/panel/index.php?page=satislar');
                        }, 1500);
                    } else {
                        Alert('error', response.message);
                    }

                }
            });
        }
    })
}

function satisTopluIslem(form_id, islem_turu) {
    Swal.fire({
        title: 'Emin misiniz?',
        text: "Satışlar silinecektir emin misiniz ?",
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
                    Alert('success', 'Satışlar siliniyor lütfen bekleyin...', 2000);
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


function nakitEkle(form_id, islem_turu) {
    var para_baslik = $('#para_baslik').val();
    var para_aciklama = $('#para_aciklama').val();
    var para_gelen = $('#para_gelen').val();
    var para_giden = $('#para_giden').val();
    var para_zaman = $('#para_zaman').val();


    if (para_baslik == null || para_baslik == "") {
        $('#para_baslik').focus();
        Alert('error', 'Başlık boş olamaz !');
    } else if (para_aciklama == null || para_aciklama == "") {
        Alert('error', 'Açıklama boş olamaz !');
        $('#para_aciklama').focus();
    } else if (para_gelen == null || para_gelen == "") {
        Alert('error', 'Gelen tutar boş olamaz !');
        $('#para_gelen').focus();
    } else if (para_giden == null || para_giden == "") {
        Alert('error', 'Giden tutar boş olamaz !');
        $('#para_giden').focus();
    } else if (para_zaman == null || para_zaman == "") {
        Alert('error', 'Zaman boş olamaz !');
        $('#para_zaman').focus();
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
                Alert('success', 'Nakit ekleniyor lütfen bekleyin...', 2000);
            },
            success: function(data) {
                var response = jQuery.parseJSON(data);
                if (response.success) {
                    var getUrl = window.location;
                    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                    Alert('success', response.message);
                    setInterval(function() {
                        $(location).attr('href', baseUrl + '/panel/index.php?page=nakit');
                    }, 1500);
                } else {
                    Alert('error', response.message);
                }

            }
        });

    }

}


function nakitDuzenle(form_id, islem_turu) {
    var para_baslik = $('#para_baslik').val();
    var para_aciklama = $('#para_aciklama').val();
    var para_gelen = $('#para_gelen').val();
    var para_giden = $('#para_giden').val();
    var para_zaman = $('#para_zaman').val();


    if (para_baslik == null || para_baslik == "") {
        $('#para_baslik').focus();
        Alert('error', 'Başlık boş olamaz !');
    } else if (para_aciklama == null || para_aciklama == "") {
        Alert('error', 'Açıklama boş olamaz !');
        $('#para_aciklama').focus();
    } else if (para_gelen == null || para_gelen == "") {
        Alert('error', 'Gelen tutar boş olamaz !');
        $('#para_gelen').focus();
    } else if (para_giden == null || para_giden == "") {
        Alert('error', 'Giden tutar boş olamaz !');
        $('#para_giden').focus();
    } else if (para_zaman == null || para_zaman == "") {
        Alert('error', 'Zaman boş olamaz !');
        $('#para_zaman').focus();
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
                Alert('success', 'Nakit düzenleniyor lütfen bekleyin...', 2000);
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



function nakitSil(id, islem_turu) {
    Swal.fire({
        title: 'Emin misiniz?',
        text: "Nakit silinecektir emin misiniz ?",
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
                    Alert('success', 'Nakit siliniyor lütfen bekleyin...', 2000);
                },
                success: function(data) {
                    var response = jQuery.parseJSON(data);
                    if (response.success) {
                        var getUrl = window.location;
                        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                        Alert('success', response.message);
                        setInterval(function() {
                            $(location).attr('href', baseUrl + '/panel/index.php?page=nakit');
                        }, 1500);
                    } else {
                        Alert('error', response.message);
                    }

                }
            });
        }
    })
}

function nakitTopluIslem(form_id, islem_turu) {
    Swal.fire({
        title: 'Emin misiniz?',
        text: "Nakitler silinecektir emin misiniz ?",
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
                    Alert('success', 'Nakitler siliniyor lütfen bekleyin...', 2000);
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