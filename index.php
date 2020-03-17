<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php
    $octet1 = 190;
    $octet2 = 160; 
    $octet3 = 60; 
    $octet4 = 25;
    $prefix = 24;
    
    $ip = $octet1.'.'.$octet2.'.'.$octet3.'.'.$octet4.' / '.$prefix;
    echo '<p class="nadpis">IP adresa:</p>'.'<p>'.$ip.'</p>';

    
    $binarni_octet1 = str_pad(decbin($octet1),8,"0", STR_PAD_LEFT);
    $binarni_octet2 = str_pad(decbin($octet2),8,"0", STR_PAD_LEFT);
    $binarni_octet3 = str_pad(decbin($octet3),8,"0", STR_PAD_LEFT);
    $binarni_octet4 = str_pad(decbin($octet4),8,"0", STR_PAD_LEFT);

    $ip_dvojkova_soustava = $binarni_octet1.".".$binarni_octet2.".".$binarni_octet3.".".$binarni_octet4;

    echo '<p class="nadpis">IP adresa v binární podobě:</p>'.'<p>'.$ip_dvojkova_soustava.'</p>';

    $binarni_octety_bez_tecek = $binarni_octet1.$binarni_octet2.$binarni_octet3.$binarni_octet4;

    $maska_binarni = "";
    for($i = 0; $i < 32;$i++){
        if($i == 8 || $i == 16 || $i == 24){
            $maska_binarni = $maska_binarni.".";
        }
        if($i < $prefix){
            $maska_binarni = $maska_binarni."1";  
        }else{
            $maska_binarni = $maska_binarni.$binarni_octety_bez_tecek[$i];
        }
    }

    echo '<p class="nadpis">Maska v binární podobě:</p>'.'<p>'.$maska_binarni.'</p>';

        for($i = 0; $i < 4;$i++){
            if($i == 0){
                $maska_binarni_pole = explode(".",$maska_binarni);
                $maska_desitkova = "";
            }
            $maska_binarni_pole[$i] = bindec($maska_binarni_pole[$i]);
            if($i == 0){
                $maska_desitkova = $maska_desitkova.$maska_binarni_pole[$i];
            }else{
            $maska_desitkova = $maska_desitkova.".".$maska_binarni_pole[$i];
            }
        }

    echo '<p class="nadpis">Maska v desitkove podobě:</p>'.'<p>'.$maska_desitkova.'</p>';

    $broadcast_binarni = "";
    for($i = 0; $i < 32;$i++){
        if($i == 8 || $i == 16 || $i == 24){
            $broadcast_binarni = $broadcast_binarni.".";
        }
        if($i < $prefix){
            $broadcast_binarni = $broadcast_binarni.$binarni_octety_bez_tecek[$i];
        }else{
            $broadcast_binarni = $broadcast_binarni."1";  
        }
    }

    echo '<p class="nadpis">Broadcast v binární podobě:</p>'.'<p>'.$broadcast_binarni.'</p>';


    for($i = 0; $i < 4;$i++){
        if($i == 0){
            $broadcast_binarni_pole = explode(".",$broadcast_binarni);
            $broadcast_desitkovy = "";
        }
        $broadcast_binarni_pole[$i] = bindec($broadcast_binarni_pole[$i]);
        if($i == 0){
            $broadcast_desitkovy = $broadcast_desitkovy.$broadcast_binarni_pole[$i];
        }else{
        $broadcast_desitkovy = $broadcast_desitkovy.".".$broadcast_binarni_pole[$i];
        }
    }

    echo '<p class="nadpis">Broadcast v desitkove podobě:</p>'.'<p>'.$broadcast_desitkovy.'</p>';

    $prvni_tri_octety_v_desitkove_soustave = $octet1.".".$octet2.".".$octet3.".";

    $posledni_octet = "";
    for($i = 24; $i < 32; $i++){
        $posledni_octet = $posledni_octet.$binarni_octety_bez_tecek[$i];
        if($i == 31){
            $prvni_host = bindec($posledni_octet) + 1;
            $posledni_host = 254;
            $pocet_hostu = $posledni_host - $prvni_host;
        }
    }
    echo '<p class="nadpis">První host:</p>'.'<p>'.$prvni_tri_octety_v_desitkove_soustave.$prvni_host.'</p>';

    echo '<p class="nadpis">Poslední host:</p>'.'<p>'.$prvni_tri_octety_v_desitkove_soustave.$posledni_host.'</p>';

    echo '<p class="nadpis">Počet hostů:</p>'.'<p>'.$pocet_hostu.'</p>';
    ?>


</body>