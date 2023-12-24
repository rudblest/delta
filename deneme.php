
<?php

    ##################################  O G R E N C İ  B İ L G İ L E R İ  ##################################

    $baglanti=mysqli_connect('localhost','root','','testdb');
    $sorgu=mysqli_query($baglanti,"select * from ogrenci_verileri");

    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Tablo</title>";
        echo "<link rel='stylesheet' href='css.css'>";
    echo "</head>";
    echo "<body>";

    echo "<table border=1 i class=stil2 >";                                 //ÖĞRENCİ VERİ TABANININ TABLOSU
    $sayi = 0 ;

    while($satir=mysqli_fetch_array($sorgu))
    {
        if ($sayi == 0) 
        echo"<tr bgcolor='cyan'>";
        else
        echo"<tr bgcolor='white'>";
    
        echo "<td>".$satir[0]."</td>
              <td>".$satir[1]."</td>
              <td>".$satir[2]."</td>
              <td>".$satir[3]."</td>
              <td>".$satir[4]."</td>
              <td>".$satir[5]."</td><br>";
        echo"</tr>";
        $sayi = 1 - $sayi  ;
    }
    echo"</table>";

    mysqli_free_result($sorgu);
    mysqli_close($baglanti);

    echo "<form class=solla method=post>";
        echo "<label for=><br>Öğrenci verileri için eylem seçiniz<br></label>";     //ÖĞRENCİ VERİ TABANINA UYGULANACAK
        echo "<select name=eylem1 id=eylem1>";                                      //EYLEMİN ŞEÇİLMESİ
            echo "<option value=bos>&nbsp;</option>";
            echo "<option value=ekleme1>Ekleme</option>";
            echo "<option value=silme1>Silme</option>";
            echo "<option value=degistirme1>Değiştirme</option>";
        echo "</select>";
        echo "<input type=submit>";
    echo "</form>";

    echo "</body>";
    echo "</html>";


    @$isim1 = $_POST["isim1"];
    @$soyisim1 = $_POST["soyisim1"];
    @$fakulte = $_POST["fakulte"];
    @$bolum = $_POST["bolum"];
    @$ogrencino = $_POST["ogrencino"];
    @$cinsiyet1 =$_POST["cinsiyet1"];

    @$eylem1 = $_POST["eylem1"];
    @$ekleme1 = $_POST["ekleme1"];
    @$silme1 = $_POST["silme1"];
    @$degistirme1 = $_POST["degistirme1"];



    if ($eylem1 == "ekleme1" )                       //ÖĞRENCİ EKLEME DURUMUNDA ÇALIŞACAK FORM
    {
    echo"<form action=odev.php method=post>";
    echo"<input type=text id=isim1 minlength=6 maxlength=32 required placeholder=ismi><br>";
    echo"<input type=text id=soyisim1 minlength=6 maxlength=32 required placeholder=soyismi><br>";
    echo"<input type=text id=fakulte minlength=6 maxlength=32 required placeholder=fakültesi><br>";
    echo"<input type=text id=bolum minlength=6 maxlength=32 required placeholder=bölümü><br>";
    echo"<input type=text id=ogrencino minlength=6 maxlength=32 required placeholder=öğrenci_numarasi><br>";
    echo"<input type=text id=cinsiyet1 minlength=6 maxlength=32 required placeholder=erkek/kadın><br>";

    echo"</form>";
    //alinan bilgiler veri tabanına girilecek
    }

    else if ($eylem1 == "silme1" )                //ÖĞRENCİ SİLME DURUMUNDA ÇALIŞACAK FORM
    {
    echo "<input type=text id=ogrencino minlength=6 maxlength=32 required placeholder=silinecek_öğrencinin_numarasını giriniz>";
    echo "<input type=submit>";
    //girilen numara SELECT isim1,soyisim1,fakulte,bolum,ogrencino FROM ogrenciler where ogrencino='girilen no' ile ögrenci bulunacak
    //seçilen ogrenci silinecek
    }
    else if ($eylem1 == "degistirme1")            //ÖĞRENCİ VERİSİ DEĞİŞTİRME DURUMUNDA ÇALIŞACAK FORM    
    {
    echo "<input type text id=ogrencino minlength=6 maxlength=32 required placeholder=degistirilecek_öğrencinin_numarasını giriniz>";
    echo "<input type=submit>";
    }
    //girilen numara SELECT isim1,soyisim1,fakulte,bolum,ogrencino FROM ogrenciler where ogrencino='girilen no' şeklinde kullanıcının önüne gelecek
    //başka bir formla kullanıcı değiştirmek istediği kısmı seçecek ya da serbest bir şekilde değiştirecek

    
     

    ############################  H A S T A    B İ L G İ L E R İ  ############################

    $baglanti2=mysqli_connect('localhost','root','','testdb');
    $sorgu2=mysqli_query($baglanti2,"select * from hasta_verileri");           // HASTA VERİLERİ OLARAK DEĞİŞTİR BUNU AAAAAAAAAAAAAAAAAAAAAAAAA

    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Tablo</title>";
        echo "<link rel='stylesheet' href='css.css'>";
    echo "</head>";
    echo "<body>";

    echo "<table border=1 i class=stil2>";                                       //HASTA VERİ TABANININ TABLOSU
    echo" <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>";
    $sayi = 0 ;

    while($satir=mysqli_fetch_array($sorgu2))
    {
        if ($sayi == 0) 
        echo"<tr bgcolor='cyan'>";
        else
        echo"<tr bgcolor='white'>";
    
        echo "<td>".$satir[0]."</td>
              <td>".$satir[1]."</td>
              <td>".$satir[2]."</td>
              <td>".$satir[3]."</td>
              <td>".$satir[4]."</td><br>";
        echo"</tr>";
        $sayi = 1 - $sayi  ;
    }
    echo"</table>";

    mysqli_free_result($sorgu2);
    mysqli_close($baglanti2);

    echo "<form  method=post>";                                                     //hasta verilerine uygulanacak eylemin
        echo "<label for=><br>Hasta verileri için eylem seçiniz<br></label>";      //seçildiği form
        echo "<select name=eylem2 id=eylem2>";
            echo "<option value=bos>&nbsp;</option>";
            echo "<option value=ekleme2>Ekleme</option>";
            echo "<option value=silme2>Silme</option>";
            echo "<option value=degistirme2>Değiştirme</option>";
        echo "</select>";
        echo "<input type=submit>";
    echo "</form>";

    echo "</body>";
    echo "</html>";


    @$isim2 = $_POST["isim2"];
    @$soyisim2 = $_POST["soyisim2"];
    @$il = $_POST["il"];
    @$yas = $_POST["yas"];
    @$tcno = $_POST["tcno"];

    @$eylem2 = $_POST["eylem2"];
    @$ekleme2 = $_POST["ekleme2"];
    @$silme2 = $_POST["silme2"];
    @$degistirme2 = $_POST["degistirme2"];

    if ($eylem2 == "ekleme2" )                       //HASTA EKLEME DURUMUNDA ÇALIŞACAK FORM
    {
    echo"<form action=odev.php method=post>";
    echo"<input type=text id=isim2 minlength=6 maxlength=32 required placeholder=ismi><br>";
    echo"<input type=text id=soyisim2 minlength=6 maxlength=32 required placeholder=soyismi><br>";
    echo"<input type=text id=cinsiyet1 minlength=6 maxlength=32 required placeholder=cinsiyeti><br>";
    echo"<input type=text id=yas minlength=6 maxlength=32 required placeholder=yaşı><br>";
    echo"<input type=text id=tcno minlength=6 maxlength=32 required placeholder=tc_kimlik_numarası><br>";
    echo "<input type=submit>";
    echo"</form>";
    //alinan bilgiler veri tabanına girilecek
    }

    else if ($eylem2 == "silme2" )                //HASTA SİLME DURUMUNDA ÇALIŞACAK FORM
    {
    echo "<input type=text id=tcno minlength=6 maxlength=32 required placeholder=silinecek_tc_kimlik_numarası giriniz>";
    echo "<input type=submit>";
    //girilen numara SELECT isim2,soyisim2,cinsiyet1,yas,tcno FROM hastalar where tcno='girilen no' ile ögrenci bulunacak
    //seçilen hasta silinecek
    }
    else if ($eylem2 == "degistirme2")            //HASTA VERİSİ DEĞİŞTİRME DURUMUNDA ÇALIŞACAK FORM    
    {
    echo "<input type text id=tcno minlength=6 maxlength=32 required placeholder=degistirilecek_tc_kimlik_numarası giriniz>";
    echo "<input type=submit>";
    }
    //girilen numara SELECT isim2,soyisim2,cinsiyet1,yas,tcno FROM hastalar where tcno='girilen no' şeklinde kullanıcının önüne gelecek
    //başka bir formla kullanıcı değiştirmek istediği kısmı seçecek ya da serbest bir şekilde değiştirecek

    


?>
