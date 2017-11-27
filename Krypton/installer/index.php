<?php
namespace Krypton\installer;

?>
<html>
<head>
  <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
  <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">
  <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script>
  $(document).ready(function() {


    $(".btn-continue").on("click",function(){

      $(".btn-continue").prop("disabled",true);

      $('.card-body').fadeOut('slow', function() {
          $('.card-body').html('<div class="loading loading-lg"></div>');
          $('.card-body').fadeIn('slow');
      });

      var nextStep = $(".btn-continue").val();
      var POSTdata = [];
      POSTdata.push(nextStep);
      POSTdata.push([]);

      if ( nextStep == "2"){
        $('.card-body').find('.form-input').each(function()
        {
          POSTdata[1].push($(this).val());
        });
    }

      $('.card-image').html("Step "+nextStep);
      $.post("Installer.progress.php", {action: JSON.stringify(POSTdata)},
        function(result){
var test = JSON.parse(result);

          console.log(typeof(result));

        $('.card-body').fadeOut('slow', function() {
            $('.card-body').html(result);
            $('.card-body').fadeIn('slow');
        });


          $(".btn-continue").prop("value",Number(nextStep)+1);
          var progressBar = nextStep * 20;
          $(".bar-item").attr('data-tooltip',progressBar+"%");
          $(".bar-item").css("width",progressBar+"%");

        $(".btn-continue").prop("disabled",false);
    });
    });


  });
  </script>
</head>
<body>

  <div class="bar">
    <div class="bar-item tooltip tooltip-bottom" data-tooltip="0%" style="width:0%;background-color:#5cd71a"></div>
  </div>

  <div class="card">
    <div class="card-image">
    </div>
    <div class="card-header">
      <div class="card-title h5">KryptonCMS </div>
      <div class="card-subtitle text-gray">InstallerService</div>
    </div>
    <div class="card-body">
      Welcome to the KryptonCMS InstallerService
    </div>
    <div class="card-footer">
        <button class="btn btn-primary btn-continue" style="background-color:#5cd71a;border: none;" value="1">Continue</button>
    </div>
  </div>
</body>
</html>
