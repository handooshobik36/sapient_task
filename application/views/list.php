<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SpaceX</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="stylesheet" href="<?php echo WEB_URL.'/uploads/css/bootstrap.min.css' ?>">
        <link rel="stylesheet" href="<?php echo WEB_URL.'/uploads/css/bootstrap-theme.min.css' ?>">
        <link rel="stylesheet" href="<?php echo WEB_URL.'/uploads/css/fontAwesome.css' ?>">
        <link rel="stylesheet" href="<?php echo WEB_URL.'/uploads/css/light-box.css' ?>">
        <link rel="stylesheet" href="<?php echo WEB_URL.'/uploads/css/templatemo-main.css' ?>">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <script src="<?php echo WEB_URL.'/uploads/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js'?>"></script>
        <style type="text/css">
          .info {padding: 5px;font-size: 12px;}
          .btn_yr{padding: 4px;font-size: 16px;font-weight: 700;}
          .btn_sty{padding: 5px;color: white;background: #4f4747;}
          .btn_sty_reset{padding: 5px;color: white;background: #4f4747;}
          .btn_sty.active{padding: 5px;color: #333;background: #cbe2ad;}
        </style>
    </head>

<body>
  
        <nav style="padding: 5px;">
          <div class="">
            <span style="color: #f3f3f3;font-size: 25px;">FILTERS</span>            
          </div>
          <div style="margin-bottom: 5px;">
            <div style="color: #f3f3f3;font-size: 20px;background: #6a6464;border-radius: 6px;padding: 3px;">
              <span><u>Launch Year</u></span>
            </div>
            <div class="col-md-12">
              <?php for ($i=2006; $i < 2021; $i++) { ?>
                <div class="col-sm-6 btn_yr"><button type="button" class="btn_sty click_button_year" data-attr='<?php echo $i; ?>'><?php echo $i; ?></button></div>
              <?php } ?>
            </div>
          </div>

          <span style="color: #f3f3f3;font-size: 20px;background: #6a6464;border-radius: 6px;padding: 3px;">
            <span><u>Successful Launch</u></span>
          </span>
          <div class="col-md-12">
            <div class="col-sm-6 btn_yr"><button type="button" class="btn_sty click_button_lauch" data-attr='yes'>TRUE</button></div>
            <div class="col-sm-6 btn_yr"><button type="button" class="btn_sty click_button_lauch" data-attr='no'>FALSE</button></div>
          </div>

          <div class="col-md-12 btn_yr" style="margin-top: 15px;"><button type="button" class="btn_sty_reset">RESET FILTER</button></div>

        </nav>
        
        <div class="slides">
          <div class="slide" id="1">
            <div class="content fourth-content">
                <div class="container-fluid">
                    <div class="row">
                      <?php  
                        foreach ($format_response as $key => $data) {
                          if($data['launch_success']==1){
                            $launch_su='yes';
                          }else{
                            $launch_su='no';
                          }
                      ?>
                          <div class="col-md-4 col-sm-6 InfoBox" data-year='<?php echo $data['launch_year']; ?>' data-launch='<?php echo $launch_su; ?>'>
                              <div class="item">
                                  <div class="thumb" style="background: #575252; border-radius: 5px;">
                                      <div class="image">
                                          <img src="<?php echo $data['links']['mission_patch_small']; ?>">
                                      </div>
                                      <div style="color: #fff;">
                                        <h4><?php echo $data['mission_name'].' #'.$data['flight_number']; ?></h4>
                                        <div class="info">
                                          <span><b>MIsson Id's</b></span>
                                            <?php 
                                              if(count($data['mission_id'])>0){
                                                foreach ($data['mission_id'] as $key => $value_id) { ?>
                                                  <li><?php echo $value_id; ?></li>
                                                <?php }
                                              }else{
                                                echo "<li>No id available !!</li>";
                                              }
                                            ?>
                                        </div>
                                        <div class="info">
                                          <?php echo '<b>Launch Year : </b>'.$data['launch_year']; ?> 
                                        </div>
                                        <div class="info">
                                          <?php if($data['launch_success']==1){echo '<b>Launch Success :</b> TRUE';}else{echo '<b>Launch Success :</b> FALSE';} ?> 
                                        </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      <?php
                        }
                      ?>
                        

                    </div>
                </div>
            </div>
          </div>
        </div>

       
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo WEB_URL.'/uploads/js/vendor/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo WEB_URL.'/uploads/js/datepicker.js'; ?>"></script>
    <script src="<?php echo WEB_URL.'/uploads/js/plugins.js'; ?>"></script>
    <script src="<?php echo WEB_URL.'/uploads/js/main.js'; ?>"></script>

    <script type="text/javascript">
      $( ".btn_sty_reset" ).bind( "click", function() {
        $('.click_button_year').removeClass('active');
        $('.click_button_lauch').removeClass('active');
        $('.InfoBox').show();
      });

      $( ".click_button_year" ).bind( "click", function() {
        $('.click_button_lauch').removeClass('active');
        $('.click_button_year').removeClass('active');
        $(this).addClass('active');
        filtersort_me();
      });
      $( ".click_button_lauch" ).bind( "click", function() {
        $('.click_button_year').removeClass('active');
        $('.click_button_lauch').removeClass('active');
        $(this).addClass('active');
        filtersort_me_lauch();
      });

      function filtersort_me(){
        $('.InfoBox').hide();
        var year_selected=$('.click_button_year.active').attr('data-attr');
        jQuery('.InfoBox').each(function(){
          var launch_year = $(this).attr('data-year');
          if (year_selected==launch_year) {
            $(this).show() ;
          }
        });
      }
      function filtersort_me_lauch(){
        $('.InfoBox').hide();
        var launch_selected=$('.click_button_lauch.active').attr('data-attr');
        jQuery('.InfoBox').each(function(){
          var launch_div = $(this).attr('data-launch');
          if (launch_selected==launch_div) {
            $(this).show() ;
          }
        });
      }
    </script>
</body>
</html>