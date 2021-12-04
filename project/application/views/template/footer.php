


        
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

            <script type="text/javascript" src="public/js/datatables.min.js"></script>
            <script type="text/javascript" src="public/js/ddataTables.bootstrap.min.js"></script>

     </script>

        <?php if(isset($scripts))
        {
          foreach ($scripts as $script_name) {
            $src = base_url() . "public/js/" . $script_name;?>
            <script src="<?=$src?>"></script>

          <?php }
        } ?>



 

