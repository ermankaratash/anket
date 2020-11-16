<?php
$i=0;
$y=0;
?>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.5.2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        var i=0;
        var y=0;
        var a=0;
        $(".cEkle").click(function(){
            $("#cevap"+i).append('<input type="text" class="form-control" name="cevap'+i+'[]" placeholder="" value=""> <br/> <br/>');
            });
        $(".sEkle").click(function(){
            i++;
            $("#"+y).hide();
            y++;
            $("#soru").append('<div id="soru>" ><div><input type="text" class="form-control" name="soru'+i+'" placeholder="" value=""><br/> <br/><div id="cevap'+i+'"><input type="text" class="form-control" name="cevap'+i+'[]" placeholder="" value=""><br/> <br/></div> <div style="min-height:30px;min-width:35px;text-align:center;margin:2px;color: #fff;background-color: #F39C35;border-color: #4cae4c;  padding: 10px 16px;font-size: 18px;line-height: 1.33;border-radius: 6px;}"> <button class="cEkle" id='+y+' href="javascript:void(0)" type="button"> Yeni Cevap Ekle </button> </div> </div> <br/> <br/><input type="hidden" class="form-control" name="n" placeholder="" value="'+i+'"></div>');
            $(".cEkle").click(function(){
                $("#cevap"+i).append('<input type="text" class="form-control" name="cevap'+i+'[]" placeholder="" value=""> <br/> <br/>');
             });
            });
    });	
</script>

<?php 
    include "baglan.php";

    if ($_POST){
        
            $n = ($_POST['n'] );
            $n = $n + 1;
             for ($sayi = 0; $sayi < $n ; $sayi++) {
            $soru = ($_POST['soru'.$sayi] );
            $cevap = ($_POST['cevap'.$sayi] );

            $kaydet=$db->prepare("INSERT INTO anketsoru SET soru =:s");
            $kaydet->execute([':s'=>$soru]);
            foreach($cevap as $y){
                $kaydet2=$db->prepare("INSERT INTO anketcevap SET cevap =:c");
                $kaydet2->execute([':c'=>$y]);

                $kaydet3=$db->prepare("SELECT id FROM anketsoru ORDER BY id DESC LIMIT 1");
                $kaydet3->execute();
                $sorgu5=$kaydet3->fetch();

                $kaydet5=$db->prepare("SELECT id FROM anketcevap ORDER BY id DESC LIMIT 1");
                $kaydet5->execute();
                $sorgu2=$kaydet5->fetch();

                $kaydet4=$db->prepare("UPDATE anketcevap SET soruid='$sorgu5[0]' WHERE id='$sorgu2[0]' ");
                $kaydet4->execute();
            }
         }
    }
?>
<form action="" method="post">

    <div id="soru" >
        <input type="text" class="form-control" name="soru<?php echo $i; ?>" placeholder="" value="">
        <br/> <br/>
        <div id="cevap<?php echo $i; ?>">
            <input type="text" class="form-control" name="cevap<?php echo $i; ?>[]" placeholder="" value="">
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
            <button class="cEkle" id="<?php echo $y; ?>" href="javascript:void(0)" type="button"> Yeni Cevap Ekle </button> 
        </div> 
        <input type="hidden" class="form-control" name="n" placeholder="" value="0">
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
