<?php 


function display_innovNews(){
    global $pdo;
    try{
    $sql ="SELECT i.title, i.link, i.cover, m.file_name FROM innov_news i join media m on i.cover = m.id";
    $stmt = $pdo->query($sql)->fetchAll();
    foreach ($stmt as $innovNews){
        echo <<<innov

        <div class="Inews__singleInnov" data-aos="flip-up" data-aos-duration="1500">
        <div class="Inews__imageInnov">
            <img src="uploads/{$innovNews->file_name}" alt="{$innovNews->title}">
            <a href="{$innovNews->link}"><i class="fas fa-play"></i></a>
        </div>
        <div class="Inews__contentInnov">
            <h3><a href="{$innovNews->link}">{$innovNews->title}</a></h3>
            <a href="{$innovNews->link}" class="thm-btn Inews__btnInnov"><span>Lire la vidéo</span></a>
        </div>
    </div>
innov;
    }
    } catch (PDOException $e) {
    set_message('error','query failed');
    echo 'query failed' . $e->getMessage();
    }
}



// submit a partner to database admin area
function submit_innov(){
    global $pdo;
    if(isset($_POST['submit'])){
        try{
        $title = trim($_POST['title']);
        $link = trim($_POST['link']);
        $file = $_FILES['cover']['name'];
        $cover_id = 1;

        //**------  function for handling image upload-------*/
        upload_image('cover', $cover_id);
        $sql = "INSERT INTO `innov_news` (`id`, `title`, `link`, `cover`) VALUES (NULL, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$title, $link, $cover_id]);
        if($result){
            set_message('success','Innovation news created successfully');
            
          } else {
            set_message('error','try again later');
            
          }
        } catch (PDOException $e) {
            set_message('error','query failed');
            
            echo 'query failed' . $e->getMessage();
        }
    }
}










?>