<?php 


function display_portail(){
    global $pdo;
    try{
    $sql ="SELECT p.full_name, p.link, p.cover, p.role, p.title, m.file_name FROM portail p join media m on p.cover = m.id";
    $stmt = $pdo->query($sql)->fetchAll();
    foreach ($stmt as $portail){
        echo <<<portail
        
       <div class="portailN__inv--bottom">
       <h3 class="portailN__name">Bill Gates</h3>
       <h3 class="portailN__role">PDG Microsoft</h3>
       <h3 class="portailN__titleI">Règles de succès</h3>
       <a href="" class="portailN__play">Lire la vidéo</a>
   </div>
</div>
<div class="portailN__inv" data-aos="flip-down" data-aos-duration="1000">
   <div class="portailN__inv--top">
       <img src="uploads/{$portail->file_name}" alt="{$portail->full_name}">
       <a href=""><i class="fas fa-play"></i></a>
   </div>

portail;
    }
    } catch (PDOException $e) {
    set_message('error','query failed');
    echo 'query failed' . $e->getMessage();
    }
}



?>