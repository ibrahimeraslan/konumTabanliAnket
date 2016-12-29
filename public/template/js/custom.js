var x=document.getElementById("kAnketler");
function getLocation()
{
    if (navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(showPosition,showError);
    }
    else{x.innerHTML="<div class='alert alert-danger'>Tarayıcınız konum bilgisini desteklemiyor. Bu yüzden anketleri görüntüleme ve katılma işlemini gerçekleştiremezsiniz. Lütfen daha yeni bir tarayıcı edinin..</div>";}
}
function showPosition(position)
{
    $.ajax({
        type:'GET', 						// - POST veya GET
        data:"",							// - Yukarıda data değişkenini tanımladık.
        dataType:'json', 					// - JSON Formatında Gönderilmesini Sağladık.
        url:'http://maps.googleapis.com/maps/api/geocode/json?latlng='+position.coords.latitude+','+position.coords.longitude+'&sensor=true', 					// - Data Bilgisinin Gönderileceği Dosya Adresi.
        success:function(gelen){ 	 	// - Success, complete ve error Fonksiyonları vardır.
            var konum = "";
            $.each(gelen.results, function( i, item ) {
                konum = item.address_components[4].long_name;
                return false;
            });
            $("#kAnketler").html('<center><img src="/template/img/progress-circle-master.svg"></center>');
            anketGetir(konum);
        }
    });

}
function anketGetir(konum) {
   // alert(konum);
    $.ajax({
        type:'POST',
        data:"konum="+konum+"&_token="+$('meta[name="csrf-token"]').attr('content'),
        url:'/kullanici/anketGetir',
        success:function(gelen){
            $("#kAnketler").html(gelen);
        }
    });

}
function showError(error)
{
    switch(error.code)
    {
        case error.PERMISSION_DENIED:
            x.innerHTML="<div class='alert alert-danger'>Tarayıcınızın konum bilgisi almasına izin vermediniz. Konum bilgisi olmadan anketleri görüntüleyemez veya dolduramazsınız. Lütfen tarayıcınızın konum bilgisi isteğine izin veriniz.</div>"
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML="<div class='alert alert-danger'>Tarayıcınız konum bilgisini alırken hata oluştu. Konum bilgisi olmadan anketleri görüntüleyemez veya dolduramazsınız. Lütfen sayfayı yenileyerek tekrar deneyiniz.</div>"
            break;
        case error.TIMEOUT:
            x.innerHTML="<div class='alert alert-danger'>Tarayıcınız konum bilgisini alırken hata oluştu. Konum bilgisi olmadan anketleri görüntüleyemez veya dolduramazsınız. Lütfen sayfayı yenileyerek tekrar deneyiniz."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML="<div class='alert alert-danger'>Tarayıcınız konum bilgisini alırken hata oluştu. Konum bilgisi olmadan anketleri görüntüleyemez veya dolduramazsınız. Lütfen sayfayı yenileyerek tekrar deneyiniz."
            break;
    }
}
getLocation();

$(document).on("input", ".numeric", function() {
    this.value = this.value.replace(/\D/g, '');
});
$(document).on("input", ".money", function() {
    this.value = this.value.replace(/[^\d\.]/g,'');
});

$(document).ready( function ()
{

    $("#kuralDurumu").change(function(){
        if($("#kuralDurumu").val() == 0) $("#kurallar").hide();
        else $("#kurallar").show();
    });


});
var kuralSayi=1;
function kuralEkle() {
    $('#kuralLoad').show();
    $('#kuralLoad').html('<center><img src="/template/img/progress-circle-master.svg"></center>');
    $.ajax({
        type:'GET',
        data:"islem=1&sayi="+kuralSayi,
        url:'/kullanici/anket/kuralIslemleri',
        success:function(gelen){
            kuralSayi++;
            $('#kuralLoad').hide();
            $('#kuralListesi').append(gelen);
        }
    });

}
function kuralSectim(sayi){
    $('#kuralSecenek'+sayi).show();
    $('#kuralSecenek'+sayi).html('<center><img src="/template/img/progress-circle-master.svg"></center>');
    $.ajax({
        type:'GET',
        data:"islem=2&soru="+$("#kuralSoruSecenek"+sayi).val()+"&sayi="+sayi,
        url:'/kullanici/anket/kuralIslemleri',
        success:function(gelen){
            $('#kuralSecenek'+sayi).html(gelen);
        }
    });
}
var soruSayisi=1;
function yeniSoru(sorutip){
    if(sorutip==1) goruntu = "<label>Görünecek Metin</label><select class='form-control'><option>Seçiniz</option></select>";
    else if(sorutip==2) goruntu = "<label>Görünecek Metin</label><input type='text' class='form-control'>";
    else if(sorutip==3) goruntu = "<label>Görünecek Metin</label><textarea class='form-control'></textarea>";
    else if(sorutip==4) goruntu = "<label>Görünecek Metin</label> <input type='radio'>";
    else if(sorutip==5) goruntu = "<label>Görünecek Metin</label> <input type='checkbox'>";
    $("#anketSorulari").append("<div class='alert alert-default'><div class='soruSayisi'><span>" +soruSayisi+".</span> Soru Metni</div>"+
            "<textarea name='yeniSoru"+soruSayisi+"'></textarea>" +
        "<div class='alert alert-info'><div class='pull-left'><button onclick='soruSecenekEkle("+sorutip+","+soruSayisi+")' class='btn btn-sm btn-secondary'><i class='fa fa-plus'></i> Seçenek Ekle</button></div>" +
        "<div class='clearfix'></div>" +
        "<div class='ekranGoruntu alert alert-admin alert-warning'>Örnek Seçenek Görüntüsü:<br/>"+goruntu+"</div>" +
        "<input type='hidden' name='soruTip"+soruSayisi+"' value='"+sorutip+"'>"+
        "<div id='secenekler"+soruSayisi+"'></div>" +
        "</div></div>");
    CKEDITOR.replace( 'yeniSoru'+soruSayisi );
    soruSayisi++;
}
function soruSecenekEkle(sorutip,sorusayisi) {
        $("#secenekler"+sorusayisi).append("<div class='alert alert-default'>" +
            "<input type='text' name='secenek"+sorusayisi+"[]' class='form-control' placeholder='Seçenek Metni'>" +
            "</div>");

}
function soruOnay() {
    var btn = $("#anketOButon");
    btn.attr("disabled",true);
    var isim = $("input[name=anket_isim]").val();
    var kisi = $("input[name=anket_kisi]").val();
    var ucret = $("input[name=anket_ucret]").val();
    var sayfa_sayi = $("input[name=anket_sayfa_sayisi]").val();
    var konum = $("select[name=anket_konum]").val();
    if($("select[name=anket_konum]").val()=="") konum = "Türkiye";
    if(isim=="" || kisi=="" || ucret=="" || sayfa_sayi=="" || konum==""){
        $("#anketOnayConfirm").hide();
        $(".odemeDurumu").html("<div class='alert alert-danger'>Boş alan bıraktınız. Lütfen tüm alanları doldurunuz.</div>");
    }else{
        $("#anketOnayConfirm").show();
        $("#anketOnayConfirm li").eq(0).html("<b>Anket İsmi: </b>"+isim);
        $("#anketOnayConfirm li").eq(1).html("<b>Ankete Katılabilecek : </b>"+kisi);
        $("#anketOnayConfirm li").eq(2).html("<b>Ankete Katılım Ücreti : </b>"+ucret);
        $("#anketOnayConfirm li").eq(3).html("<b>Sayfa Başı Soru Gösterimi : </b>"+sayfa_sayi);
        $("#anketOnayConfirm li").eq(4).html("<b>Anket Konumu : </b>"+konum);
        btn.attr("disabled",false);
        $(".odemeDurumu").html("<button class='btn btn-default'>Ödenmesi Gereken:<br/><b>"+(kisi*ucret)+" <i class='fa fa-try'></i></br></button>");
    }


}

function zamanBaslat(){
    $("#zaman").html("0 : 0 : 0");
    var saniye=0, dakika =0, saat=0;
    setInterval(function(){
        if(saniye<59){
            saniye = saniye + 1;
        }
        else{
            saniye=0;
            if(dakika <59) dakika = dakika +1
            else {
                dakika = 0; saat = saat +1;
            }
        }
        $("#zaman").html(saat + " : " + dakika + " : " + saniye);
    }, 1000);

}
$(".sonraki").click(function(){
    var sayi =  $(".pageList li").length;
   var page = $(this).attr("data-page");
    if(page<=sayi){
        $("#anketSira"+(page-1)).hide();
        $("#anketSira"+(page)).show();
        $(".pageList li").eq(page-2).removeClass("active");
        $(".pageList li").eq(page-1).addClass("active");

        if(page==sayi){
         alert("naber");
            $(this).next("sonraki").html("Cevabımı Gönder");
        }
    }

});

function imgToLight(){
    $("img").addClass("lightbox-portfolio");
}
$("#anketDuzenleSoru").change(function () {
    $('#duzenleSonuc').html('<center><img src="/template/img/progress-circle-master.svg"></center>');
    $.ajax({
        type:'GET',
        data:"soru="+$(this).val(),
        url:'/kullanici/anket/soruDuzenle',
        success:function(gelen){
            $('#duzenleSonuc').html(gelen);
            $(".secenekSilBtn").click(function () {
                $.ajax({
                    type:'GET',
                    data:"id="+$(this).attr('data-id'),
                    url:'/kullanici/anket/soruSecenekSil',
                    success:function(gelen){
                        $('#duzenleSonuc').html(gelen);
                        $(".secenekSilBtn").click(function () {
                            $(".secenekSil"+$(this).attr('data-id')).html(gelen);
                        });
                    }
                });

              $(this).parent().closest(".secenekSil").hide();
            });
        }
    });

});
function yeniEkle() {
    $("#yeniSecenek").html("<div class='clearfix'></div><div class='alert alert-warning'><input type='text' name='bunuEkle' class='form-control' placeholder='Yeni Seçenek Metni'></div>");
}