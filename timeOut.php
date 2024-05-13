<?php

if (isset($_POST['getTimeOutPhoto'])) {
    getTimeOutPhotos();
}

function getTimeOutPhotos(){
    $temperature = $_POST['temperature'];
    $weatherCode = (int)$_POST['weatherCode'];


    // $imageUrl='timeOutPhotos\cine.jpg';
    
    // $imageTitle='Cinema'." ".$temperature;
    // $imageDesc="
    // Anar al cinema es una oportunitat perfecta per relaxar-se, escapar de la rutina
    //   i gaudir d'una experiència cinematogràfica única.
    //    Pots veure les últimes estrenes, passar temps amb els
    //     teus éssers estimats i crear records inoblidables, tot mentre gaudeixes de l'emoció de la gran pantalla.";
    // $butonText='Cartelera';
    // $butonHref='https://www.filmaffinity.com/es/cat_new_th_es.html';

    // $response = array(
    //     'imageUrl' => $imageUrl,
    //     'imageTitle'=>$imageTitle,
    //     'imageDesc'=>$imageDesc,
    //     'butonText'=>$butonText,
    //     'butonHref'=>$butonHref
        
    // );
     
    $recomendacionTimeOut=calculoRecomendacionTimeOut($temperature,$weatherCode);

    header('Content-Type: application/json');
    echo json_encode($recomendacionTimeOut); 
}


function calculoRecomendacionTimeOut($temp,$weatherCode=0)
{
   
   $totalRecomendacionesTimeOut=recomendacionesTimeOut();
   
   $recomendacionesCandidatas=[];

   //Condiciones de inclusion de cada una de las recomendaciones candidatas
    if($weatherCode!=0)
    {
        array_push($recomendacionesCandidatas, $totalRecomendacionesTimeOut['cine']);
    }
    if(($temp>30)||$weatherCode!=0)
    {
        array_push($recomendacionesCandidatas, $totalRecomendacionesTimeOut['biblio']);
    }
    if(($weatherCode!=0)|| (($temp>30)||$temp<20))
    {
        array_push($recomendacionesCandidatas, $totalRecomendacionesTimeOut['gaming']);
    }

    if(($weatherCode!=0) && (($temp<30)))
    {
        array_push($recomendacionesCandidatas, $totalRecomendacionesTimeOut['cofeeshop']);
    }

    if(($weatherCode<4)&& (($temp<25&&$temp>5)))
    {
        array_push($recomendacionesCandidatas, $totalRecomendacionesTimeOut['deporte']);
    }

    if(($weatherCode!=0))
    {
        array_push($recomendacionesCandidatas, $totalRecomendacionesTimeOut['juegosmesa']);
    }

    if(($weatherCode==71))
    {
        array_push($recomendacionesCandidatas, $totalRecomendacionesTimeOut['nieve']);
    }

    if(($weatherCode==0)&& (($temp<30||$temp>15)))
    {
        array_push($recomendacionesCandidatas, $totalRecomendacionesTimeOut['pasear']);
    }

    if(($weatherCode==0)&& (($temp>30)))
    {
        array_push($recomendacionesCandidatas, $totalRecomendacionesTimeOut['playa']);
    }

    if(($weatherCode<4)&& (($temp<25 && $temp>5)))
    {
        array_push($recomendacionesCandidatas, $totalRecomendacionesTimeOut['running']);
    }

    $indiceAleatorio = array_rand($recomendacionesCandidatas);

    $recomendacionSeleccionada = $recomendacionesCandidatas[$indiceAleatorio];

    return $recomendacionSeleccionada;

}


function recomendacionesTimeOut()
{
    $recomendaciones = array();


    $recomendaciones['cine']=array(
        'imageUrl' => 'timeOutPhotos\cine.jpg',
        'imageTitle'=>'Cinema',
        'imageDesc'=>"Anar al cinema es una oportunitat perfecta per relaxar-se, escapar de la rutina i gaudir d'una experiència cinematogràfica única. Pots veure les últimes estrenes, passar temps amb els teus éssers estimats i crear records inoblidables, tot mentre gaudeixes de l'emoció de la gran pantalla.",
        'butonText'=>'Cartellera',
        'butonHref'=>'https://www.filmaffinity.com/es/cat_new_th_es.html'
    );



    $recomendaciones['biblio']=array(
        'imageUrl' => 'timeOutPhotos\biblio.jpg',
        'imageTitle'=>'Biblioteca',
        'imageDesc'=>"Endinsa't en un món de coneixement i aventura visitant la teva biblioteca local. Explora llibres fascinants, participa en activitats i descobreix un refugi tranquil per a la teva ment.",
        'butonText'=>'Cerca',
        'butonHref'=>'https://ajuntament.barcelona.cat/biblioteques/ca/content/horaris-3'
    );
    

    $recomendaciones['gaming']=array(
        'imageUrl' => 'timeOutPhotos\gaming.jpg',
        'imageTitle'=>'Videojocs',
        'imageDesc'=>"Explora mons virtuals captivadors, desafia't en emocionants batalles i connecta amb altres jugadors en línia per a experiències úniques. Endinsa't en un univers de diversió i entreteniment sense límits.",
        'butonText'=>'Tenda Steam',
        'butonHref'=>'https://store.steampowered.com/'
    );

    $recomendaciones['cofeeshop']=array(
        'imageUrl' => 'timeOutPhotos\cofeeshop.jpg',
        'imageTitle'=>'Cafeteria',
        'imageDesc'=>"Anar a prendre un cafè ofereix una pausa revitalitzant en el dia. És una oportunitat per connectar amb amics, fer una pausa en la rutina o simplement gaudir d'un moment de tranquil·litat. A més, els cafès ofereixen una àmplia varietat de begudes i un ambient acollidor que et fa sentir com a casa.",
        'butonText'=>'Millors cafeteries',
        'butonHref'=>'https://www.timeout.es/barcelona/es/comer-y-beber/las-mejores-cafeterias-de-barcelona'
    );

    $recomendaciones['deporte']=array(
        'imageUrl' => 'timeOutPhotos\deporte.jpg',
        'imageTitle'=>'Esport',
        'imageDesc'=>"Fer esport és un bon plan perquè millora la salut física i mental, reduint el risc de malalties i l'estrès. A més, promou la connexió social a través de l'experiència compartida amb altres entusiastes de l'activitat física. És una inversió en el teu benestar global, proporcionant beneficis duradors i una sensació de realització personal.",
        'butonText'=>'Time Out Esport',
        'butonHref'=>'https://www.timeout.cat/barcelona/ca/esport-salut'
    );

    $recomendaciones['juegosmesa']=array(
        'imageUrl' => 'timeOutPhotos\juegosmesa.jpg',
        'imageTitle'=>'Jocs de taula',
        'imageDesc'=>'"Per una experiència divertida i enriquidora, considera jugar a jocs de taula. Des de clàssics com el "Monopoly" fins a opcions més modernes com "Ticket to Ride", hi ha una gran varietat per a tots els gustos i edats. És una manera perfecta de passar temps de qualitat amb amics i família, fomentant la cooperació, la estratègia i la diversió sense límits."',
        'butonText'=>'Tenda zacatrus',
        'butonHref'=>'https://zacatrus.es/juegos-de-mesa.html'
    );

    $recomendaciones['nieve']=array(
        'imageUrl' => 'timeOutPhotos\nieve.jpg',
        'imageTitle'=>'Actividades en la nieve',
        'imageDesc'=>'Aprofita el temps hivernal jugant amb la neu! Construeix forts de neu amb la família o amics, una activitat que promou la creativitat i la col·laboració mentre us divertiu al aire lliure. Un clàssic és fer batalles de boles de neu, que proporcionen una emoció saludable i reforçant els llaços socials. A més, no oblidis explorar les meravelles de la natura hivernal, com fer una passejada per un paisatge nevat o fer un bonhome de neu per recordar.',
        'butonText'=>'Ideas Barcelona Turisme',
        'butonHref'=>'https://www.barcelonaturisme.com/wv3/es/page/1855/actividades-en-la-nieve.html'
    );

    $recomendaciones['pasear']=array(
        'imageUrl' => 'timeOutPhotos\pasear.jpg',
        'imageTitle'=>'Passejar',
        'imageDesc'=>"'Explorar la natura és una experiència enriquidora i relaxant. Gaudeix d'un passeig pel parc local o per un sender forestal per connectar amb la tranquil·litat de l'entorn natural. Caminar també és una manera excel·lent de millorar la salut física i mental, ja que promou l'exercici lleuger i redueix l'estrès. Aprofita aquest temps per respirar aire fresc, observar la bellesa dels voltants i recarregar les teves energies.'",
        'butonText'=>'Ideas Time out',
        'butonHref'=>'https://www.timeout.cat/barcelona/ca/que-fer/passejar-per-barcelona'
    );

    $recomendaciones['playa']=array(
        'imageUrl' => 'timeOutPhotos\playa.jpg',
        'imageTitle'=>'Platja',
        'imageDesc'=>"Una visita a la platja ofereix una escapada relaxant i revitalitzadora. Gaudeix del sol, la sorra i el mar mentre et refresques i recarregues les teves energies. És l'entorn perfecte per a activitats com fer una passejada per la costa, prendre el sol, nedar o practicar esports aquàtics com surf o kayak. A més, la platja ofereix un entorn tranquil per a la meditació o la lectura, permetent-te desconnectar del món i connectar amb la natura i el teu propi ser.",
        'butonText'=>'25 millors platges Time Out',
        'butonHref'=>'https://www.timeout.cat/barcelona/ca/viatge/les-millors-platges-de-catalunya'
    );

    $recomendaciones['running']=array(
        'imageUrl' => 'timeOutPhotos\running.jpg',
        'imageTitle'=>'Running',
        'imageDesc'=>" Practica running per a una experiència d'entrenament revitalitzadora. Amb només un parell de sabatilles i l'aire lliure, pots gaudir dels beneficis de l'exercici cardiovascular mentre explores nous llocs i alliberes l'estrès. És una oportunitat perfecta per connectar amb tu mateix/a, ja sigui escoltant música inspiradora o simplement escoltant els teus propis pensaments mentre corres. A més, el running és una manera efectiva de millorar la salut física i mental, afavorint el benestar global del cos i la ment.",
        'butonText'=>'Rutes Time Out',
        'butonHref'=>'https://www.timeout.es/barcelona/es/deportes/tres-rutas-para-correr-por-barcelona'
    );


    return $recomendaciones;

}