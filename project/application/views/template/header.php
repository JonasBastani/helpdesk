<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel= "apple-touch-icon" sizes="76x76" href="public/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="public/logo/Logoescritabranco.png">
  <title>
    Help Desk
  </title>
  <link rel="stylesheet" type="text/css" href="public/css/stylefuncionario.css"> 
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="public/assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="public/assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="public/assets/demo/demo.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="public/css/datatables.min.css"/>
  <link rel="stylesheet" type="text/css" href="public/css/dataTables.bootstrap.min.css"/>
 
  

  <?php if(isset($styles))
  {
      foreach ($styles as $style_name) {
        $href = base_url() . "public/css/" . $style_name; ?>
        <link href= "<?=$href?>" rel= "stylesheet">

      <?php }
  } ?>

</head>


      <!-- End Navbar -->
