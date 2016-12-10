@extends('layouts.nobar')
@section('content')
    <script src="{{ asset('template/vendor/ckeditor/ckeditor.js') }}"></script>

    <div class="container" style="padding:10px;">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ URL::to('') }}"><img src="{{ asset('template/img/logo.png') }}" style="max-width:50px;"></a>
            </div>
            <div class="col-md-9">
                <img class="pull-right" src="{{ asset('img/avatar/'.Auth::user()->avatar) }}" style="max-width:50px; border:1px solid #c0c0c0; border-radius:5px;">

                <div class="pull-right" style="padding:17px; font-weight: 700; color:#000;">
                    {{ Auth::user()->name }}
                </div>
            </div>
        </div>
        <hr/>
        <div class="col-md-12">
            <h4>Yeni Anket Oluştur</h4>
            <div class="tabs tabs-secondary">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#anketGenel" data-toggle="tab"><i class="icon-info icons"></i> Genel Bilgiler</a>
                    </li>
                    <li>
                        <a href="#anketKural" data-toggle="tab"><i class="fa fa-bars"></i> Anket Kuralları</a>
                    </li>
                    <li>
                        <a href="#anketSoru" data-toggle="tab"><i class="icon-question icons"></i> Anket Soruları</a>
                    </li>
                    <li>
                        <a href="#anketOnay" data-toggle="tab" onclick="soruOnay()"><i class="icon-check icons"></i> Onay</a>
                    </li>
                </ul>
                <form class="form-horizontal form-bordered" method="post" action="{{ URL::to('kullanici/anketOlustur') }}" name="anketFOlustur" id="anketFOlustur" onsubmit="return false;">
                    {{ csrf_field() }}
                    <div class="tab-content">
                    <div id="anketGenel" class="tab-pane active">

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault">Anketinizin İsmini Giriniz *</label>
                                <div class="col-md-9">
                                    <input type="text" name="anket_isim" class="form-control" id="inputDefault">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault">Anketinizi Kaç Kişi Doldurabilir *</label>
                                <div class="col-md-9">
                                    <input type="numeric" name="anket_kisi" class="numeric form-control" id="inputDefault">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault">Dolduran Kişi Başı Ücret *</label>
                                <div class="col-md-9">
                                    <input type="numeric" name="anket_ucret" class="money form-control" id="inputDefault">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault">Her Sayfadaki Soru Sayısı *</label>
                                <div class="col-md-9">
                                    <input type="numeric" name="anket_sayfa_sayisi" class="numeric form-control" id="inputDefault">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault">Şu Konumdakiler Katılsın *</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="anket_konum">
                                            <option value="">Tüm Türkiye</option>
                                            <option value="Adana">Adana</option>
                                            <option value="Adıyaman">Adıyaman</option>
                                            <option value="Afyonkarahisar">Afyonkarahisar</option>
                                            <option value="Ağrı">Ağrı</option>
                                            <option value="Aksaray">Aksaray</option>
                                            <option value="Amasya">Amasya</option>
                                            <option value="Ankara">Ankara</option>
                                            <option value="Antalya">Antalya</option>
                                            <option value="Ardahan">Ardahan</option>
                                            <option value="Artvin">Artvin</option>
                                            <option value="Aydın">Aydın</option>
                                            <option value="Balıkesir">Balıkesir</option>
                                            <option value="Bartın">Bartın</option>
                                            <option value="Batman">Batman</option>
                                            <option value="Bayburt">Bayburt</option>
                                            <option value="Bilecik">Bilecik</option>
                                            <option value="Bingöl">Bingöl</option>
                                            <option value="Bitlis">Bitlis</option>
                                            <option value="Bolu">Bolu</option>
                                            <option value="Burdur">Burdur</option>
                                            <option value="Bursa">Bursa</option>
                                            <option value="Çanakkale">Çanakkale</option>
                                            <option value="Çankırı">Çankırı</option>
                                            <option value="Çorum">Çorum</option>
                                            <option value="Denizli">Denizli</option>
                                            <option value="Diyarbakır">Diyarbakır</option>
                                            <option value="Düzce">Düzce</option>
                                            <option value="Edirne">Edirne</option>
                                            <option value="Elazığ">Elazığ</option>
                                            <option value="Erzincan">Erzincan</option>
                                            <option value="Erzurum">Erzurum</option>
                                            <option value="Eskişehir">Eskişehir</option>
                                            <option value="Gaziantep">Gaziantep</option>
                                            <option value="Giresun">Giresun</option>
                                            <option value="Gümüşhane">Gümüşhane</option>
                                            <option value="Hakkari">Hakkari</option>
                                            <option value="Hatay">Hatay</option>
                                            <option value="Iğdır">Iğdır</option>
                                            <option value="Isparta">Isparta</option>
                                            <option value="İstanbul">İstanbul</option>
                                            <option value="İzmir">İzmir</option>
                                            <option value="Kahramanmaraş">Kahramanmaraş</option>
                                            <option value="Karabük">Karabük</option>
                                            <option value="Karaman">Karaman</option>
                                            <option value="Kars">Kars</option>
                                            <option value="Kastamonu">Kastamonu</option>
                                            <option value="Kayseri">Kayseri</option>
                                            <option value="Kilis">Kilis</option>
                                            <option value="Kırıkkale">Kırıkkale</option>
                                            <option value="Kırklareli">Kırklareli</option>
                                            <option value="Kırşehir">Kırşehir</option>
                                            <option value="Kocaeli">Kocaeli</option>
                                            <option value="Konya">Konya</option>
                                            <option value="Kütahya">Kütahya</option>
                                            <option value="Malatya">Malatya</option>
                                            <option value="Manisa">Manisa</option>
                                            <option value="Mardin">Mardin</option>
                                            <option value="Mersin">Mersin</option>
                                            <option value="Muğla">Muğla</option>
                                            <option value="Muş">Muş</option>
                                            <option value="Nevşehir">Nevşehir</option>
                                            <option value="Niğde">Niğde</option>
                                            <option value="Ordu">Ordu</option>
                                            <option value="Osmaniye">Osmaniye</option>
                                            <option value="Rize">Rize</option>
                                            <option value="Sakarya">Sakarya</option>
                                            <option value="Samsun">Samsun</option>
                                            <option value="Şanlıurfa">Şanlıurfa</option>
                                            <option value="Siirt">Siirt</option>
                                            <option value="Sinop">Sinop</option>
                                            <option value="Sivas">Sivas</option>
                                            <option value="Şırnak">Şırnak</option>
                                            <option value="Tekirdağ">Tekirdağ</option>
                                            <option value="Tokat">Tokat</option>
                                            <option value="Trabzon">Trabzon</option>
                                            <option value="Tunceli">Tunceli</option>
                                            <option value="Uşak">Uşak</option>
                                            <option value="Van">Van</option>
                                            <option value="Yalova">Yalova</option>
                                            <option value="Yozgat">Yozgat</option>
                                            <option value="Zonguldak">Zonguldak</option>
                                        </select>
                                </div>
                            </div>
                    </div>
                    <div id="anketKural" class="tab-pane">
                        <p class="alert alert-info">Anket kuralı istiyorum seçeneğini seçerseniz; "oluşturmuş olduğunuz ankete sadece o kuyala uyan üyeler katılabilecektir. Aksi durumda herkese açık olacaktır."</p>
                        <p>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">Anket Kuralları Olsun Mu *</label>
                            <div class="col-md-9">
                                <select class="form-control" name="kuralDurumu" id="kuralDurumu">
                                    <option value="0">Olmasın, Herkese Açık</option>
                                    <option value="1">Olsun, Sadece Kuralı Sağlayanlar</option>
                                </select>
                            </div>
                        </div>
                        <div id="kurallar" style="display: none">
                            <div class="alert alert-default">
                                <div class="pull-left"><button onclick="kuralEkle()" class="btn btn-sm btn-default"><i class="fa fa-plus"></i> Ekle</button></div>
                                <div class="clearfix"></div>
                                <div id="kuralListesi"></div>
                                <div id="kuralLoad"></div>
                            </div>
                        </div>
                        </p>
                    </div>
                    <div id="anketSoru" class="tab-pane">
                        <p class="alert alert-info">Bu alanda anketinizde sormak istediğiniz soruları belirleyebilirsiniz.</p>
                        <p style="text-align: center">
                            <div id="anketSorulari"></div>
                            <div class="divider">
                                <i class="fa fa-chevron-down"></i>
                            </div>
                        <div style="text-align: center">
                            <button type="button" class="btn btn-tertiary " onclick="yeniSoru(1)"><i class="fa fa-list-alt"></i><br/>Seçim Kutusu Ekle</button>
                            <button type="button" class="btn btn-tertiary " onclick="yeniSoru(2)"><i class="fa fa-text-width"></i><br/>Yazı Alanı Ekle</button>
                            <button type="button" class="btn btn-tertiary " onclick="yeniSoru(3)"><i class="fa fa-align-justify"></i><br/>Metin Alanı Ekle</button>
                            <button type="button" class="btn btn-tertiary " onclick="yeniSoru(4)"><i class="fa fa-circle-o"></i><br/>Radio Alanı Ekle</button>
                            <button type="button" class="btn btn-tertiary " onclick="yeniSoru(5)"><i class="fa fa-check-square-o"></i><br/>CheckBox Alanı Ekle</button>
                        </div>
                        </p>
                    </div>
                    <div id="anketOnay" class="tab-pane">
                        <p class="alert alert-info">Bu aşama anket oluşturmak için son aşamadır. Lütfen aşağıdaki bilgileri kontrol ediniz. Bu işlemlerden sonra ödeme işlemini gerçekleştiriniz.</p>
                        <div class="alert alert-default">
                            <ol class="list list-ordened list-ordened-style-2" id="anketOnayConfirm">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ol>
                            <div class="odemeDurumu">

                            </div>
                        </div>
                        <button class="btn btn-secondary" id="anketOButon" onclick="anketFOlustur.submit();"><i class="fa fa-plus"></i> Anketi Oluştur ve Ödeme Yap</button>
                    </div>
                </div>
                </form>
            </div>

        </div>
    </div>
@endsection