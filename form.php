
         
                     <!-- Fonksiyonlar Bitiş -->	
<?php 
    include "baglan.php";

    if ($_POST){
        $soru = strip_tags(trim($_POST['soru']));
        $cevap = strip_tags(trim($_POST['cevap']));
        if(!$soru || !$cevap){
            echo "Boş alan bırakmayınız";
        }else{
            $kaydet=$db->prepare("INSERT INTO anketsoru SET soru =:s");
            $kaydet->execute([':s'=>$soru]);

            $kaydet2=$db->prepare("INSERT INTO anketcevap SET cevap =:c");
            $kaydet2->execute([':c'=>$cevap]);
        }

        $sorgu=$db->prepare("SELECT id FROM anketsoru WHERE soru='$soru'");
        $sorgu->execute();
        $array=$sorgu->fetch();
        $sonuc = implode(",", $array);

        $kaydet3=$db->prepare("UPDATE anketcevap SET soruid='$sonuc' WHERE cevap='$cevap'");
        $kaydet3->execute();
    }
?>
<form action="" method="post">
    <input type="text" class="form-control" name="soru" placeholder="" value="">
    <br/>
    <input type="text" class="form-control" name="cevap" placeholder="" value="">
    <br/>
    <button type="submit" > Kaydet </button>                             
</form>			
