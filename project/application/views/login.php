<!DOCTYPE html>
<html lang="pt-br">

  	<head>
    	<title>Login</title>
    	<meta charset="utf-8">
      <link rel="icon" type="image/png" href="public/logo/Logoescritabranco.png">
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    	<link rel="stylesheet" type="text/css" href="public/css/style.css"> 
      
      <?php if(isset($styles))
      {
        foreach ($styles as $style_name) {
          $href = base_url() . "public/css/" . $style_name; ?>
          <link href= "<?=$href?>" rel= "stylesheet">

        <?php }
      } ?>


  	</head>
  	
    <body >
      <script type="text/javascript">
        
      </script>
      <br/>
      <br/>
      <br/>
      <section class="container-fluid bg">
        <section class="row justify-content-center">
          <section class="col-12  col-sm-6 col-md-3">
            <form class="form-container" id="login_form">
              <div id="logoescrita">
                <img id="logoescrita" src="public/logo/Logoescritabranco.png">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Login</label>
                <input type="text"  class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Insira seu login">
                <span class="help-block text-white"></span>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Senha</label>
                <input   type="password" class="form-control" id="senha" name="senha"  placeholder="Insira sua senha">
              </div>
              <div>
                
                <a class="btn btn-dark btn-lg btn-block" id="btn-login">Avançar</a>
                <span class="help-block text-white"></span>
              </div>
              
            </form>
            
          </section>
          
        </section>
        
      </section>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script> 



      
     </script>

        <?php if(isset($scripts))
        {
          foreach ($scripts as $script_name) {
            $src = base_url() . "public/js/" . $script_name;?>
            <script src="<?=$src?>"></script>

          <?php }
        } ?>
  
<!--   Core JS Files   -->
      

      
  	</body>
</html>

</script>





