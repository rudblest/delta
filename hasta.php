<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hasta verileri admin</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>

    <div ontouchstart="">
        <div class="button" target="_blank">
          <a href="http://localhost/website/anasayfa.html"> <img width="50px" height="50px" src="menu.png"> </a>
        </div>
      </div>
    
</body>
</html>

<?php

    ######################################################  H A S T A   B İ L G İ L E R İ  ########################################################

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

    echo"<center>";
    
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

    echo"</center>";
    
    mysqli_free_result($sorgu);


    ############################################## HASTA VERİLERİNE UYGULANACK EYLEMİN SEÇİLDİĞİ KISIM ###########################################

    echo"<center>";
    
    echo "<form class=stil1 method=post>";
    echo "<label for=><br>Hasta verileri için eylem seçiniz<br></label>";
    echo "<select name=eylem1 id=eylem1>";
    echo "<option value=bos>&nbsp;</option>";
    echo "<option value=ekleme1>Ekleme</option>";
    echo "<option value=silme1>Silme</option>";
    echo "<option value=degistirme1>Değiştirme</option>";
    echo "</select>";
    echo "<input type=submit name=submit>";
    echo "</form>";

    echo"</center>";
    
    if (isset($_POST["submit"]))                     
    
    {
        $eylem1 = $_POST["eylem1"];
    
        if ($eylem1 == "ekleme1") 
        {
            echo "<center>";
            echo "<form action=hasta.php method=post class=stil1>";
            echo "<input type=text name=isim1 minlength=2 maxlength=32 required placeholder=İsmi><br>";
            echo "<input type=text name=soyisim1 minlength=2 maxlength=32 required placeholder=Soyismi><br>";
            echo "<input type=text name=cinsiyet minlength=2 maxlength=32 required placeholder=Erkek/Kadın><br>";
            echo "<input type=text name=yas minlength=2 maxlength=32 required placeholder=yaşı><br>";
            echo "<input type=text name=tcno minlength=2 maxlength=32 required placeholder=tc_kimlik_no><br>";
            echo "<input type=submit name=ekleme_submit>";
            echo "</form>";
            echo "</center>";
        } elseif ($eylem1 == "silme1") 
        {
            echo "<center>";
            echo "<form action=hasta.php method=post class=stil1>";
            echo "<input type=text name=silinecek_tcno minlength=2 maxlength=32 required placeholder=Silinecek_kimlik_Numarasını_Giriniz><br>";
            echo "<input type=submit name=silme_submit>";
            echo "</form>";
            echo "</center>";
        } elseif ($eylem1 == "degistirme1") 
        {
            echo "<center>";
            echo "<form action=hasta.php method=post class=stil1>";
            echo "<input type=text name=degisecek_tcno minlength=2 maxlength=32 required placeholder=Değiştirilecek_tc_numarası Giriniz><br>";
            echo "<input type=submit name=degistirme_submit>";
            echo "<br>";
            echo "<form action=hasta.php method=post class=stil1>";
            echo "<input type=text name=isim1 minlength=2 maxlength=32 required placeholder=İsmi><br>";
            echo "<input type=text name=soyisim1 minlength=2 maxlength=32 required placeholder=Soyismi><br>";
            echo "<input type=text name=cinsiyet minlength=2 maxlength=32 required placeholder=Erkek/Kadın><br>";
            echo "<input type=text name=yas minlength=2 maxlength=32 required placeholder=yaşı><br>";
            echo "<input type=text name=tcno minlength=2 maxlength=32 required placeholder=tc_kimlik_no><br>";
            echo "<input type=submit name=degistirme_submit>";
            echo "</form>";
            echo "</form>";
            echo "</center>";
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
            die("Bağlantı hatası: " . mysqli_connect_error());
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
            die("Bağlantı hatası: " . mysqli_connect_error());
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

    if (isset($_POST["degistirme_submit"])) {
        $degisecek_tcno = $_POST["degisecek_tcno"];


    if (!$baglanti) {
        die("Bağlantı hatası: " . mysqli_connect_error());
    }

    //mevcut verileri veri tabanında çekiyoruz
    $selectQuery = "SELECT isim1,soyisim1,cinsiyet,yas ,tcno  FROM hasta_verileri WHERE tcno=?";
    $selectStmt = $baglanti->prepare($selectQuery);
    $selectStmt->bind_param("s", $degisecek_tcno);
    $selectStmt->execute();
    $selectResult = $selectStmt->get_result();

    if ($selectResult->num_rows > 0) {
        $row = $selectResult->fetch_assoc();

        // Eğer karşılık gelen POST değerleri boşsa, alınan değerleri kullanan kod
        $isim1 = empty($_POST["isim1"]) ? $row["isim1"] : $_POST["isim1"];
        $soyisim1 = empty($_POST["soyisim1"]) ? $row["soyisim1"] : $_POST["soyisim1"];
        $cinsiyet = empty($_POST["cinsiyet"]) ? $row["cinsiyet"] : $_POST["cinsiyet"];
        $yas = empty($_POST["yas"]) ? $row["yas"] : $_POST["yas"];
        $tcno = empty($_POST["tcno"]) ? $row["tcno"] : $_POST["tcno"];
        
        

        // database deki verileri güncelleme
        $updateQuery = "UPDATE hasta_verileri SET isim1=?, soyisim1=?, cinsiyet=?, yas=?, tcno=? WHERE tcno=?";
        $updateStmt = $baglanti->prepare($updateQuery);
        $updateStmt->bind_param("ssssss", $isim1, $soyisim1,$cinsiyet,$yas,$tcno, $degisecek_tcno); 

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
