<?php
$conexion = new mysqli('localhost', DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Combos dependientes Demo</title>
<meta name="description" content="Combos dependientes - Ejemplo de marcas y modelos sacados de una base de datos de Jose Aguilar."/>
<meta name="author" content="Jose Aguilar">
<link rel="shortcut icon" href="https://www.jose-aguilar.com/blog/wp-content/themes/jaconsulting/favicon.ico" />
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css">
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script language="javascript">
$(document).ready(function(){
    $("#category").on('change', function () {
        $("#category option:selected").each(function () {
            var id_category = $(this).val();
            $.post("subcategories.php", { id_category: id_category }, function(data) {
                $("#subcategory").html(data);
            });			
        });
   });
});
</script>
</head>

<body>
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <a class="navbar-brand" href="https://www.jose-aguilar.com/">
        <img src="https://www.jose-aguilar.com/blog/wp-content/themes/jaconsulting/images/jose-aguilar.png" width="30" height="30" alt="Jose Aguilar">
      </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="https://www.jose-aguilar.com/scripts/jquery/combos-dependientes/categories.php">Demo <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="https://www.jose-aguilar.com/scripts/jquery/combos-dependientes/combos-dependientes.zip">Descargar</a>
            <a class="nav-item nav-link" href="https://www.jose-aguilar.com/blog/combos-dependientes-con-jquery-ajax-y-php/">Tutorial</a>
            <a class="nav-item nav-link" href="https://www.jose-aguilar.com/">&copy; Jose Aguilar</a>
        </div>
    </div>
</nav>
<div class="container">
    <h1>Combos dependientes</h1>
    <h2 class="lead">Ejemplo de marcas y modelos sacados de una base de datos</h2>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="https://www.jose-aguilar.com/blog/">Blog</a></li>
          <li class="breadcrumb-item"><a href="https://www.jose-aguilar.com/blog/combos-dependientes-con-jquery-ajax-y-php/">Combos dependientes con jQuery, Ajax y PHP</a></li>
          <li class="breadcrumb-item active">Demo</li>
        </ol>
    </nav>
    
    <div class="row">
        <div id="content" class="col-lg-12">
            <form class="row" action="" method="post">
                <div class="form-group col-lg-3">
                    <label for="category">Marca</label>
                    <select name="category" id="category" class="form-control">
                        <?php
                        $result = $conexion->query(
                            "SELECT c.id_category, name FROM ps_category c
                            LEFT JOIN ps_category_lang cl ON (cl.id_category = c.id_category AND cl.id_lang = 1)
                            WHERE id_parent = 2 ORDER BY name ASC"
                        );
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {                
                                echo '<option value="'.$row['id_category'].'">'.$row['name'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-lg-3">
                    <label for="subcategory">Modelo</label>
                    <select name="subcategory" id="subcategory" class="form-control"></select>
                </div>
            </form>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Bloque de anuncios adaptable -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-6676636635558550"
                 data-ad-slot="8523024962"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
    
    <div class="card">
        <h5 class="card-header">Comparte en las redes sociales</h5>
        <div class="card-body">
            <h5 class="card-title">¿Te ha servido este ejemplo? Comparte con tus amigos</h5>
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4ecc1a47193e29e4" async="async"></script>
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="addthis_sharing_toolbox"></div>
        </div>
    </div>

    <div class="footer-content row">
        <div class="col-lg-12">
            <div class="pull-right">
                <a href="https://www.jose-aguilar.com/blog/combos-dependientes-con-jquery-ajax-y-php/" class="btn btn-secondary">
                    <i class="fa fa-reply"></i> volver al tutorial
                </a>
                <a href="https://www.jose-aguilar.com/scripts/jquery/combos-dependientes/combos-dependientes.zip" class="btn btn-primary">
                    <i class="fa fa-download"></i> Descargar
                </a>
            </div>
        </div>
    </div>
    
</div>
<footer class="footer bg-dark">
    <div class="container">
        <span class="text-muted"><a href="https://www.jose-aguilar.com/">&copy; Jose Aguilar</a></span>
    </div>
</footer>
</body>
</html>
