<?php
    $authorID = $_GET['id'];
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "https://reststop.randomhouse.com/resources/authors/$authorID");
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "testuser:testpassword");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
   
    $api_return = curl_exec($ch);
    $api_return = json_decode($api_return);
    
    curl_close($ch);
    
    function getTitle($isbn){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://reststop.randomhouse.com/resources/titles/$isbn");
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "testuser:testpassword");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
        $api_return = curl_exec($ch);
        curl_close($ch);
        $api_return = json_decode($api_return);
        return $api_return->titleweb;
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="gb18030">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Cameron Morrow">
        
        
        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
        
        <!-- JQuery -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        
        <script>
            function showExcerpt(){
                $("#ExcerptModal").modal('show');
            }
        </script>
        
    </head>
    <body>
        <div class="mx-auto px-auto text-center mt-5">
            <h1 class="text-dark">Book App</h1>
            <p>Made with the "Penguin Random House Rest Services API"</p>
        </div>
        
        <main class="container mb-5">
            <div class="px-4 mb-5 row">
                <div class="mx-3 col-12 col-md-4">
                    <img class="d-block mx-auto rounded" src="https://www.cameronmorrow.com/BookApp/get_author_picture.php?authorID=<?php echo $authorID;?>" alt="" width="auto" height="400">
                </div>
                <div class="card col-12 col-md-7">
                    <h2 class="card-header"><?php echo $api_return->authordisplay; ?></h2>
                    <div class="card-body">
                        <p class="card-text"><?php echo $api_return->spotlight; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-12 my-4 mx-auto px-auto">
                <h3 class="col-12 mx-auto px-auto text-center">Books:</h3>
                <hr>
                <div class="row">
                    <?php foreach($api_return->titles->isbn as $isbn):  ?>
                    <div class="col-3 px-2 py-2 d-flex flex-column justify-content-evenly">
                        <a class="d-flex flex-column justify-content-evenly" href="view_book.php?ISBN=<?php echo get_object_vars($isbn)['$']; ?>">
                            <img class="d-block mx-auto rounded" src="cover_art.php?ISBN=<?php echo get_object_vars($isbn)['$']; ?>" style="width: auto; height: auto; max-width:100px; max-height:200px;">
                            <p class="d-block mx-auto"><?php echo get_object_vars($isbn)['$']; ?></p>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
        
        <footer class="blog-footer mx-auto px-auto text-center mt-5">
            <p>Cameron's Book Search App</p>
            <p>
                <a href="https://www.cameronmorrow.com">Back to Cameron's main site</a>
            </p>
            <p>
                <a href="#">Back to top</a>
            </p>
        </footer>
    </body>
</html>
