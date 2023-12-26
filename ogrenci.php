
<?php

    ######################################################  O G R E N C İ  B İ L G İ L E R İ  ######################################################

    $baglanti = mysqli_connect('localhost', 'root', '', 'testdb');
    $sorgu = mysqli_query($baglanti, "select * from ogrenci_verileri");
    
    echo "<!DOCTYPE html>";
    echo "<html lang='tr'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Öğrenci Bilgileri</title>";
    echo "<link rel='stylesheet' href='css.css'>";
    echo "</head>";
    echo "<body>";
    
    echo "<table border=1 i class=stil2 >";  

    ####################################################### ÖĞRENCİ VERİ TABANININ TABLOSU #########################################################
    $sayi = 0;
    
    while ($satir = mysqli_fetch_array($sorgu)) {
        echo $sayi == 0 ? "<tr bgcolor='cyan'>" : "<tr bgcolor='white'>";
        echo "<td>".$satir[0]."</td>
              <td>".$satir[1]."</td>
              <td>".$satir[2]."</td>
              <td>".$satir[3]."</td>
              <td>".$satir[4]."</td>
              <td>".$satir[5]."</td></tr>";
        $sayi = 1 - $sayi;
    }
    echo "</table>";
    
    mysqli_free_result($sorgu);


    ############################################## ÖĞRENCİ VERİLERİNE UYGULANACK EYLEMİN SEÇİLDİĞİ KISIM ###########################################
    
    echo "<form class=solla method=post>";
    echo "<label for=><br>Öğrenci verileri için eylem seçiniz<br></label>";
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
            echo "<form action=ogrenci.php method=post>";
            echo "<input type=text name=isim1 minlength=2 maxlength=32 required placeholder=İsmi><br>";
            echo "<input type=text name=soyisim1 minlength=2 maxlength=32 required placeholder=Soyismi><br>";
            echo "<input type=text name=fakulte minlength=2 maxlength=32 required placeholder=Fakültesi><br>";
            echo "<input type=text name=bolum minlength=2 maxlength=32 required placeholder=Bölümü><br>";
            echo "<input type=text name=ogrencino minlength=2 maxlength=32 required placeholder=Öğrenci Numarası><br>";
            echo "<input type=text name=cinsiyet minlength=2 maxlength=32 required placeholder=Erkek/Kadın><br>";
            echo "<input type=submit name=ekleme_submit>";
            echo "</form>";
        } elseif ($eylem1 == "silme1") {
            echo "<form action=ogrenci.php method=post>";
            echo "<input type=text name=silinecek_ogrencino minlength=2 maxlength=32 required placeholder=Silinecek Öğrenci Numarasını Giriniz><br>";
            echo "<input type=submit name=silme_submit>";
            echo "</form>";
        } elseif ($eylem1 == "degistirme1") {
            echo "<form action=ogrenci.php method=post>";
            echo "<input type=text name=degisecek_ogrencino minlength=2 maxlength=32 required placeholder=Değiştirilecek Öğrenci Numarasını Giriniz><br>";
            echo "<input type=submit name=degistirme_submit>";
            echo"<br>";
            echo "<form action=ogrenci.php method=post>";
            echo "<input type=text name=isim1 minlength=2 maxlength=32 required placeholder=İsmi><br>";
            echo "<input type=text name=soyisim1 minlength=2 maxlength=32 required placeholder=Soyismi><br>";
            echo "<input type=text name=fakulte minlength=2 maxlength=32 required placeholder=Fakültesi><br>";
            echo "<input type=text name=bolum minlength=2 maxlength=32 required placeholder=Bölümü><br>";
            echo "<input type=text name=ogrencino minlength=2 maxlength=32 required placeholder=Öğrenci Numarası><br>";
            echo "<input type=text name=cinsiyet minlength=2 maxlength=32 required placeholder=Erkek/Kadın><br>";
            echo "<input type=submit name=degistirme_submit>";
            echo "</form>";
        }
    }
    
    ################################################################# ÖĞRENCİ EKLEME KISMI #########################################################
    
    if (isset($_POST["ekleme_submit"]))                                   
    {
        $isim1 = $_POST["isim1"];
        $soyisim1 = $_POST["soyisim1"];
        $fakulte = $_POST["fakulte"];
        $bolum = $_POST["bolum"];
        $ogrencino = $_POST["ogrencino"];
        $cinsiyet = $_POST["cinsiyet"];
    
        if (!$baglanti) 
        {
            die("Connection failed: " . mysqli_connect_error());
        }
    
        $stmt = $baglanti->prepare("INSERT INTO ogrenci_verileri (isim1, soyisim1, fakulte, bolum, ogrencino, cinsiyet) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $isim1, $soyisim1, $fakulte, $bolum, $ogrencino, $cinsiyet);
    
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

    ################################################################# ÖĞRENCİ SİLME KISMI ##########################################################
    
    if (isset($_POST["silme_submit"]))                                     
    {
        $silinecek_ogrencino = $_POST["silinecek_ogrencino"];
    
        if (!$baglanti) {
            die("Connection failed: " . mysqli_connect_error());
        }
    
        $stmt = $baglanti->prepare("DELETE FROM ogrenci_verileri WHERE ogrencino = ?");
        $stmt->bind_param("s", $silinecek_ogrencino);
    
        if ($stmt->execute()) {
            echo "Öğrenci silindi";
        } else {
            echo "Hata: " . $stmt->error;
        }
    
        $stmt->close();
    }
    
    ################################################################# ÖĞRENCİ DEĞİŞTİRME KISMI #####################################################

    if (isset($_POST["degistirme_submit"])) {
        $degisecek_ogrencino = $_POST["degisecek_ogrencino"];
    
        if (!$baglanti) {
            die("Connection failed: " . mysqli_connect_error());
        }
    
        //mevcut verileri veri tabanında çekiyoruz
        $selectQuery = "SELECT isim1, soyisim1, fakulte, bolum, ogrencino, cinsiyet FROM ogrenci_verileri WHERE ogrencino=?";
        $selectStmt = $baglanti->prepare($selectQuery);
        $selectStmt->bind_param("s", $degisecek_ogrencino);
        $selectStmt->execute();
        $selectResult = $selectStmt->get_result();
    
        if ($selectResult->num_rows > 0) {
            $row = $selectResult->fetch_assoc();
    
            // Eğer karşılık gelen POST değerleri boşsa alınan değerleri kullanan kod
            $isim1 = empty($_POST["isim1"]) ? $row["isim1"] : $_POST["isim1"];
            $soyisim1 = empty($_POST["soyisim1"]) ? $row["soyisim1"] : $_POST["soyisim1"];
            $fakulte = empty($_POST["fakulte"]) ? $row["fakulte"] : $_POST["fakulte"];
            $bolum = empty($_POST["bolum"]) ? $row["bolum"] : $_POST["bolum"];
            $ogrencino = empty($_POST["ogrencino"]) ? $row["ogrencino"] : $_POST["ogrencino"];
            $cinsiyet = empty($_POST["cinsiyet"]) ? $row["cinsiyet"] : $_POST["cinsiyet"];
    
            // database deki verileri güncelleme
            $updateQuery = "UPDATE ogrenci_verileri SET isim1=?, soyisim1=?, fakulte=?, bolum=?,ogrencino=? ,cinsiyet=? WHERE ogrencino=?";
            $updateStmt = $baglanti->prepare($updateQuery);
            $updateStmt->bind_param("sssssss", $isim1, $soyisim1, $fakulte, $bolum,$ogrencino, $cinsiyet, $degisecek_ogrencino);
    
            if ($updateStmt->execute()) {
                echo "Öğrenci bilgisi değişti";
            } else {
                echo "Hata: " . $updateStmt->error;
            }
    
            $updateStmt->close();
        } else {
            echo "Öğrenci bulunamadı.";
        }
    
        $selectStmt->close();
    }
    


    echo "</body>";
    echo "</html>";


    mysqli_close($baglanti);


?>
