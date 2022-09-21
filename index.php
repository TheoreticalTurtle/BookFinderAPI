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
            function SearchBooks(){
                $("#results").html("");
                $('#loadingSpinner').removeClass('visually-hidden');
                $('#loadingFinished').addClass('visually-hidden');
                $.post( "get_books.php", { search: $('#searchTerms').val() }, function (data){
                    var data = $.parseJSON(data);
                    $('#loadingSpinner').addClass('visually-hidden');
                    $('#loadingFinished').removeClass('visually-hidden');
                    console.log(data);
                    jQuery.each(data.title, function(i, book) {
                        var subtitle = "<h6 class='card-subtitle mb-2 text-muted'>" + book.subtitle + "</h6>";
                        $("#results").append("<div class='card col-3 my-3' style='width: 18rem;'>"+
                            "<img src='cover_art.php?ISBN=" + book.isbn + "' class='card-img-top' alt='ISBN:" + book.isbn + "'>"+
                            "<div class='card-body'>"+
                                "<h5 class='card-title'>" + book.titleweb + "</h5>"+
                                ((book.subtitle == undefined) ? "" : subtitle) +
                                "<p class='card-text'>" + book.authorweb + "</p>"+
                                "<a href='view_book.php?ISBN=" + book.isbn + "' class='btn btn-primary'>Details</a>"+
                            "</div>"+
                            "<div class='card-footer'>"+
                                "$" + book.priceusa + ""+
                            "</div>"+
                        "</div>");
                        
                    });
                    console.log(data.title[0].isbn);
                });
            }
            function SearchAuthors(){
                $("#results2").html("");
                $('#loadingSpinner2').removeClass('visually-hidden');
                $("#Authorresults").html("");
                $.post( "get_authors.php", { fname: $('#fname').val(), lname: $('#lname').val() }, function (data){
                    var data = $.parseJSON(data);
                    $('#loadingSpinner2').addClass('visually-hidden');
                    console.log(data);
                    jQuery.each(data.author, function(i, writer) {
                        $("#Authorresults").append("<div class='card col-3 my-3' style='width: 18rem;'>"+
                        "<img src='https://www.cameronmorrow.com/BookApp/get_author_picture.php?authorID=" + writer.authorid + "' class='card-img-top'>"+
                            "<div class='card-body'>"+
                                "<h5 class='card-title'>" + writer.authordisplay + "</h5>"+
                                "<p class='card-text'>" + writer.spotlight + "</p>"+
                                "<a href='view_author.php?id=" + writer.authorid + "' class='btn btn-primary'>Details</a>"+
                            "</div>"+
                        "</div>");
                        
                    });
                });
            }
        </script>
        
    </head>
    <body>
        <div class="mx-auto px-auto text-center mt-5">
            <h1 class="text-dark">Book App</h1>
            <p>Made with the "Penguin Random House Rest Services API"</p>
        </div>
        
        <main class="container mb-5">
            <div class="px-4 text-center mb-5">
                <img class="d-block mx-auto rounded-circle" src="BookLogo.png" alt="" width="200" height="200">
                <h1 class="display-5 fw-bold"></h1>
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="SearchBooks-tab" data-bs-toggle="tab" data-bs-target="#SearchBooks" type="button" role="tab" aria-controls="SearchBooks" aria-selected="true">Search Books</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="SearchAuthors-tab" data-bs-toggle="tab" data-bs-target="#SearchAuthors" type="button" role="tab" aria-controls="SearchAuthors" aria-selected="false">Search Authors</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="SearchBooks" role="tabpanel" aria-labelledby="SearchBooks-tab">
                        <div class="input-group input-group-lg my-5">
                            <span class="input-group-text" id="inputGroup-sizing-lg">Search</span>
                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" id="searchTerms">
                        </div>
                        <button onclick="SearchBooks()" class="btn btn-primary my-3"><span class="spinner-border spinner-border-sm visually-hidden" aria-hidden="true" id="loadingSpinner"></span> Search</button>
                        <div  id="results" class="row d-flex justify-content-around">
                        </div>
                    </div>
                    <div class="tab-pane fade" id="SearchAuthors" role="tabpanel" aria-labelledby="SearchAuthors-tab">
                        <div class="input-group input-group-lg my-5">
                            <span class="input-group-text" id="inputGroup-sizing-lg">First Name</span>
                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" id="fname">
                            <span class="input-group-text" id="inputGroup-sizing-lg">Last Name</span>
                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" id="lname">
                        </div>
                        <button onclick="SearchAuthors()" class="btn btn-primary my-3"><span class="spinner-border spinner-border-sm visually-hidden" aria-hidden="true" id="loadingSpinner2"></span> Search</button>
                        <div id="Authorresults" class="row d-flex justify-content-around">
                        </div>
                    </div>
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
