<?php
$i=0;
$x=0;
?>


<script type="text/javascript" src="https://code.jquery.com/jquery-1.5.2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        var i=0;
        $(".cEkle").click(function(){
            $("#cevap"+i).append('<input type="text" class="form-control" name="cevap[]" placeholder="" value=""> <br/> <br/>');
            });
        $(".sEkle").click(function(){
            i++;
            $("#soru<?php echo $x; ?>").append('<div><input type="text" class="form-control" name="soru[]" placeholder="" value=""><br/> <br/><div id="cevap'+i+'"><input type="text" class="form-control" name="cevap[]" placeholder="" value=""><br/> <br/></div> <div style="min-height:30px;min-width:35px;text-align:center;margin:2px;color: #fff;background-color: #F39C35;border-color: #4cae4c;  padding: 10px 16px;font-size: 18px;line-height: 1.33;border-radius: 6px;}"> <button class="cEkle"  href="javascript:void(0)" type="button"> Yeni Cevap Ekle </button> </div> </div> <br/> <br/>');
            $(".cEkle").click(function(){
                $("#cevap"+i).append('<input type="text" class="form-control" name="cevap[]" placeholder="" value=""> <br/> <br/>');
             });

            });
    });	
</script>

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

    <div id="soru<?php echo $x; ?>" >
        <input type="text" class="form-control" name="soru[]" placeholder="" value="">
        <br/> <br/>
        <div id="cevap<?php echo $i; ?>">
            <input type="text" class="form-control" name="cevap[]" placeholder="" value="">
            <br/> <br/>
        </div> 
        <div style="min-height:30px;
            min-width:35px;
            text-align:center;
            margin:2px;
            color: #fff;
            background-color: #F39C35;
            border-color: #4cae4c;  
            padding: 10px 16px;
            font-size: 18px;
            line-height: 1.33;
            border-radius: 6px;}"> 
            <button class="cEkle"  href="javascript:void(0)" type="button"> Yeni Cevap Ekle </button> 
        </div> 
    </div>

    <div style="min-height:30px;
    min-width:35px;
    text-align:center;
    margin:2px;
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;  
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.33;
    border-radius: 6px;}"> 
    <button class="sEkle"  href="javascript:void(0)" type="button"> Yeni Soru Ekle </button> 
    </div> 
    <button type="submit" > Kaydet </button>                             
</form>			
