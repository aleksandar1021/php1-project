<?php 
    include("../config/konekcija.php");

    $uslov = "";
    $marke="";
    $boje="";
    $kategorije = "";

    if(isset($_POST['marke'])){
        $marke =  $_POST['marke'];
        $uslov .= " AND br.id_brend IN ('".implode("','", $marke)."')"; 
    }
    if(isset($_POST['boje'])){
        $boje =  $_POST['boje'];
        $uslov .= " AND b.id_boja IN ('".implode("','",$boje)."')"; 
    }
    if(isset($_POST['kategorije'])){
        $kategorije =  $_POST['kategorije'];
        $uslov .= " AND k.id_kategorija IN ('".implode("','",$kategorije)."')"; 
    }
    if(isset($_POST['unos'])){   
        $unos = $_POST['unos'];
        $uslov .= " AND p.naziv LIKE'%".$unos."%'";
    }
    if(isset($_POST['sort'])){
        if($_POST['sort']=='1'){
            $uslov .= " ORDER BY naziv ASC";
        }
        if($_POST['sort']=='2'){
            $uslov .= " ORDER BY naziv DESC";
        }
    }
    
    if(!is_numeric(intval($marke)) || !is_numeric(intval($boje)) || !is_numeric(intval($kategorije))){
        header("Location: ../index.php");
        die();
    }
    
    
    $upit = "SELECT DISTINCT  p.* 
                FROM proizvod p 
                INNER JOIN proizvod_boja pb ON p.id_proizvod = pb.id_proizvod
                INNER JOIN boja b ON b.id_boja = pb.id_boja
                INNER JOIN brend br ON br.id_brend = p.id_brend
                INNER JOIN kategorija k ON p.id_kategorija = k.id_kategorija WHERE 1=1".$uslov;
    
    
    
    $res=$konekcija->query($upit);
    $result=$res->fetchAll();

    $stareCene = [];
    $popusti = [];
    $id = [];
    $promocije = [];

    foreach($result as $r){
        $cena = "SELECT cena FROM cena c JOIN proizvod p on c.id_proizvod = p.id_proizvod WHERE p.id_proizvod = $r->id_proizvod ORDER BY datum desc LIMIT 0,1";
        $result2 = $konekcija->query($cena);
        $trenutna = $result2->fetch();
        array_push($stareCene, $trenutna);
    }

    foreach($result as $r){
        $upitPopust = "SELECT procenat FROM popust po JOIN proizvod p on po.id_proizvod = p.id_proizvod WHERE p.id_proizvod = $r->id_proizvod  ORDER BY datum_popust desc LIMIT 0,1";
        $popust = $konekcija->query($upitPopust);
        $pop = $popust->fetch();
        array_push($popusti, $pop);
    }

    foreach($result as $r){
        $upitProm = "SELECT promocija, boja FROM promocija pr JOIN proizvod p on pr.id_promocija = p.id_promocija WHERE p.id_proizvod = $r->id_proizvod";
        $prom = $konekcija->query($upitProm);
        $promocija = $prom->fetch();
        if($promocija){
            array_push($promocije, $promocija);
        }
        else{
            array_push($promocije, null);
        }
    }

    foreach($result as $r){
        array_push($id, $r->id_proizvod);
    }

    $izlaz = array(
        'proizvodi' => $result,
        'staraCena' => $stareCene,
        'popusti' => $popusti,
        'promocije'=>$promocije,
        'id' => $id
    );
    
    
    
    echo json_encode($izlaz);


?>