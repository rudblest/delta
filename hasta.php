
<?php

    ######################################################  O G R E N C İ  B İ L G İ L E R İ  ######################################################

    $baglanti = mysqli_connect('localhost', 'root', '', 'testdb');
    $sorgu = mysqli_query($baglanti, "select * from hasta_verileri");
    
    echo "<!DOCTYPE html>";
    echo "<html lang='tr'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Hasta Bilgileri</title>";
    echo "<link rel='stylesheet' href='css.css'>";
    echo "</head>";
    echo "<body>";
    
    echo "<table border=1 i class=stil2 >";  

    ####################################################### HASTA VERİ TABANININ TABLOSU #########################################################
    $sayi = 0;
    
    while ($satir = mysqli_fetch_array($sorgu)) {
        echo $sayi == 0 ? "<tr bgcolor='cyan'>" : "<tr bgcolor='white'>";
        echo "<td>".$satir[0]."</td>
              <td>".$satir[1]."</td>
              <td>".$satir[2]."</td>
              <td>".$satir[3]."</td>
              <td>".$satir[4]."</td></tr>";
        $sayi = 1 - $sayi;
    }
    echo "</table>";
    
    mysqli_free_result($sorgu);


    ############################################## HASTA VERİLERİNE UYGULANACK EYLEMİN SEÇİLDİĞİ KISIM ###########################################
    
    echo "<form class=solla method=post>";
    echo "<label for=><br>Hasta verileri için eylem seçiniz<br></label>";
    echo "<select name=eylem1 id=eylem1>";
    echo "<option value=bos>&nbsp;</option>";
    echo "<option value=ekleme1>Ekleme</option>";
    echo "<option value=silme1>Silme</option>";
    echo "<option value=degistirme1>Değiştirme</option>";
    echo "</select>";
    echo "<input type=submit name=submit>";
    echo "</form>";
    
    if (isset($_POST["submit"]))                     
    
    {
        $eylem1 = $_POST["eylem1"];
    
        if ($eylem1 == "ekleme1") {
            echo "<form action=hasta.php method=post>";
            echo "<input type=text name=isim1 minlength=2 maxlength=32 required placeholder=İsmi><br>";
            echo "<input type=text name=soyisim1 minlength=2 maxlength=32 required placeholder=Soyismi><br>";
            echo "<input type=text name=cinsiyet minlength=2 maxlength=32 required placeholder=Erkek/Kadın><br>";
            echo "<input type=text name=yas minlength=2 maxlength=32 required placeholder=yaşı><br>";
            echo "<input type=text name=tcno minlength=2 maxlength=32 required placeholder=tc_kimlik_no><br>";
            echo "<input type=submit name=ekleme_submit>";
            echo "</form>";
        } elseif ($eylem1 == "silme1") {
            echo "<form action=hasta.php method=post>";
            echo "<input type=text name=silinecek_tcno minlength=2 maxlength=32 required placeholder=Silinecek_kimlik_Numarasını_Giriniz><br>";
            echo "<input type=submit name=silme_submit>";
            echo "</form>";
        } elseif ($eylem1 == "degistirme1") {
            echo "<form action=hasta.php method=post>";
            echo "<input type=text name=degistirilecek_tcno minlength=2 maxlength=32 required placeholder=Değiştirilecek Hasta Numarasını Giriniz><br>";
            echo "<input type=submit name=degistirme_submit>";
            echo "</form>";
        }
    }
    
    ################################################################# HASTA EKLEME KISMI #########################################################
    
    if (isset($_POST["ekleme_submit"]))                                   
    {
        $isim1 = $_POST["isim1"];
        $soyisim1 = $_POST["soyisim1"];
        $cinsiyet = $_POST["cinsiyet"];
        $yas = $_POST["yas"];
        $tcno = $_POST["tcno"];

    
        if (!$baglanti) 
        {
            die("Connection failed: " . mysqli_connect_error());
        }
    
        $stmt = $baglanti->prepare("INSERT INTO hasta_verileri (isim1, soyisim1, cinsiyet, yas, tcno) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $isim1, $soyisim1, $cinsiyet, $yas, $tcno); //burdaki s ler parametre sayisini ifade ediyormuş :D
    
        if ($stmt->execute()) 
        {
            echo "Kayıt başarılı";
        } 
        
        else 
        
        {
            echo "Hata: " . $stmt->error;
        }
    
        $stmt->close();
    }

    ################################################################# HASTA SİLME KISMI ##########################################################
    
    if (isset($_POST["silme_submit"]))                                     
    {
        $silinecek_tcno = $_POST["silinecek_tcno"];
    
        if (!$baglanti) 
        {
            die("Connection failed: " . mysqli_connect_error());
        }
    
        $stmt = $baglanti->prepare("DELETE FROM hasta_verileri WHERE tcno = ?");
        $stmt->bind_param("s", $silinecek_tcno);
    
        if ($stmt->execute()) 
        {
            echo "Hasta silindi";
        } 
        else 
        {
            echo "Hata: " . $stmt->error;
        }
    
        $stmt->close();
    }
    
    ################################################################# HASTA DEĞİŞTİRME KISMI #####################################################

    // Burada değiştirme işlemi için gerekli kodu EKLEMEN LAZIM UNUTMA UNUTMAAAAAAAAAAAAAAAAAAA

    echo "</body>";
    echo "</html>";


    mysqli_close($baglanti);


?>