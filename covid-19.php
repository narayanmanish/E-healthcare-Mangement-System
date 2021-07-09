<!DOCTYPE html>
<html>
<head>
	<?php include_once("headlinks.php")?>
 
     <link rel="stylesheet" href="./resources/css/style.css" />
     <style type="text/css">
       .table-responsive-stack tr {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
      -ms-flex-direction: row;
          flex-direction: row;
}


.table-responsive-stack td,
.table-responsive-stack th {
   display:block;
/*      
   flex-grow | flex-shrink | flex-basis   */
   -ms-flex: 1 1 auto;
    flex: 1 1 auto;
}

.table-responsive-stack .table-responsive-stack-thead {
   font-weight: bold;
}

@media screen and (max-width: 768px) {
   .table-responsive-stack tr {
      -webkit-box-orient: vertical;
      -webkit-box-direction: normal;
          -ms-flex-direction: column;
              flex-direction: column;
      border-bottom: 3px solid #ccc;
      display:block;
      
   }
   /*  IE9 FIX   */
   .table-responsive-stack td {
      float: left\9;
      width:100%;
   }
}

     </style>
</head>
<body>
<?php include_once("header.php");?>
 <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Covid-19 Update</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Covid-19</li>
          </ol>
        </div>

      </div>
    </section>
<!---Body Content---->
<main id="main">

    </section><!-- End Breadcrumbs -->
    <section id="services" class="services services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Covid-19 Update Live</h2>
          <p class="text-justify text-center">Here you can see the Covid-19 Update All over the World with Graph.
              <br><strong>For find another Country Update Click on Change and search or select</strong>
              </p>
        </div>

         <main>
      <div class="stats">
        <div class="latest-report">
          <div class="country">
            <div class="name">Loading...</div>
            <div class="change-country">change</div>
            <div class="search-country hide">
              <div class="search-box">
                <input
                  type="text"
                  id="search-input"
                  placeholder="Search Country..."
                />
                <img class="close" src="./resources/img/close.svg" alt="" />
              </div>
              <div class="country-list"></div>
            </div>
          </div>
          <div class="total-cases">
            <div class="title">Total Cases</div>
            <div class="value">0</div>
            <div class="new-value">+0</div>
          </div>
          <div class="recovered">
            <div class="title">Recovered</div>
            <div class="value">0</div>
            <div class="new-value">+0</div>
          </div>
          <div class="deaths">
            <div class="title">Deaths</div>
            <div class="value">0</div>
            <div class="new-value">+0</div>
          </div>
        </div>
        <div class="chart">
          <canvas id="axes_line_chart"></canvas>
        </div>
      </div>
    </main>

      </div>
    </section><!-- End Services Section -->
   

   
 <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Covid-19 India Vaccintion Live Update </h2>
          <p class="text-center">Here See the vaccination Detalis
              </p>
        </div>

        <div class="row no-gutters">
          <?php
   
   $data = file_get_contents('https://api.covid19india.org/data.json');
    $coronalive = json_decode($data, true);
  

 
$count=count($coronalive['tested']);
 $final=$count-1;



  

    
    ?>

          <div class="col-lg-4 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
             <i class="icofont-patient-file"></i>
              <span data-toggle="counter-up"><?php echo $coronalive['tested'][$final]['totalindividualsregistered'];?></span>
              <p><strong>Total Registered for vaccination</strong></p>
              <a href="#">Find out more &raquo;</a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="icofont-drug-pack"></i>
                 <span data-toggle="counter-up"><?php echo $coronalive['tested'][$final]['totaldosesadministered'];?></span>
              <p><strong>Total Doses Administered </strong></p>
              
              <a href="#">Find out more &raquo;</a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="icofont-injection-syringe"></i>
           
              <span data-toggle="counter-up"><?php echo $coronalive['tested'][$final]['totalindividualsvaccinated'];?></span>
              <p><strong>Total Vaccinated</strong></p>
              <a href="#">Find out more &raquo;</a>
            </div>
          </div>

         
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->
    <!-- ======= Frequently Asked Questioins Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Covid Update States</h2>
         
        </div>

       <div class="accordion" id="accordionExample">
  
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Covid-19 State Wise Update
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <div class="table-responsive-sm">
        <table class="table  table-striped table-responsive-stack" id="tableOne">
  <thead>
    
    <tr>
      <th scope="col" class="text-secondary">Date And Time</th>
      <th scope="col" class="text-warning">State Name</th>
      <th scope="col" class="text-primary">confirmed</th>
      <th scope="col" class="text-info">active</th>
      <th scope="col" class="text-success">recovered</th>
      <th scope="col" class="text-danger">deaths</th>
    </tr>
  </thead>
  <tbody>
     <?php
   
 
  
  

 $statescount =count($coronalive['statewise']);

 $i=1;
 while($i <$statescount)
 {
   ?>
    <tr>
      
   <td class="text-secondary"><?php  echo $coronalive['statewise'][$i]['lastupdatedtime']  ?></td>
   <td class="text-warning"><?php  echo $coronalive['statewise'][$i]['state']  ?></td>
   <td class="text-primary"><?php  echo $coronalive['statewise'][$i]['confirmed']  ?></td>
   <td class="text-info"><?php  echo $coronalive['statewise'][$i]['active']  ?></td>
   <td class="text-success"><?php  echo $coronalive['statewise'][$i]['recovered']  ?></td>
   <td  class="text-danger"><?php  echo $coronalive['statewise'][$i]['deaths']  ?></td>

</tr>
  <?php
 
   $i++;
 }
 
 
 ?>
  </tbody>
</table>
</div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="btn button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" value="button" >
           Vaccin Details (Updated on <?php echo $coronalive['tested'][$final]['updatetimestamp'];?>)    
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
       <table class="table table-bordered table-striped table-responsive-stack">
  <thead>
    
    <tr>

      <th scope="col" class="text-primary">45years1stdose</th>
      <th scope="col" class="text-primary">45years2nddose</th>
      <th scope="col" class="text-primary">60years1stdose</th>
      <th scope="col" class="text-primary">60years2nddose</th>
      <th scope="col" class="text-primary">totalsamplestested</th>
    </tr>
  </thead>
  <tbody>
    <tr>
     
      <td class="text-primary"><?php echo $coronalive['tested'][$final]['over45years1stdose'];?></td>
      <td class="text-primary"><?php echo $coronalive['tested'][$final]['over45years2nddose'];?></td>
      <td class="text-primary"><?php echo $coronalive['tested'][$final]['over60years1stdose'];?></td>
            <td class="text-primary"><?php echo $coronalive['tested'][$final]['over60years2nddose'];?></td>
            <td class="text-primary"><?php echo $coronalive['tested'][$final]['totalsamplestested'];?></td>

    </tr>
  </tbody>
</table></div>
    </div>
  </div>
</div>

      </div>
    </section><!-- End Frequently Asked Questioins Section -->

     
   

   </main>
<!---Body Content End--->
<?php include_once("footer.php");?>
<script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI="
      crossorigin="anonymous"
    ></script>
    <script
      language="JavaScript"
      src="http://www.geoplugin.net/javascript.gp"
      type="text/javascript"
    ></script>
    <script src="resources/js/countries.js"></script>
    <script src="resources/js/app.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {

   
   // inspired by http://jsfiddle.net/arunpjohny/564Lxosz/1/
   $('.table-responsive-stack').each(function (i) {
      var id = $(this).attr('id');
      //alert(id);
      $(this).find("th").each(function(i) {
         $('#'+id + ' td:nth-child(' + (i + 1) + ')').prepend('<span class="table-responsive-stack-thead">'+             $(this).text() + ':</span> ');
         $('.table-responsive-stack-thead').hide();
         
      });
      

      
   });

   
   
   
   
$( '.table-responsive-stack' ).each(function() {
  var thCount = $(this).find("th").length; 
   var rowGrow = 100 / thCount + '%';
   //console.log(rowGrow);
   $(this).find("th, td").css('flex-basis', rowGrow);   
});
   
   
   
   
function flexTable(){
   if ($(window).width() < 768) {
      
   $(".table-responsive-stack").each(function (i) {
      $(this).find(".table-responsive-stack-thead").show();
      $(this).find('thead').hide();
   });
      
    
   // window is less than 768px   
   } else {
      
      
   $(".table-responsive-stack").each(function (i) {
      $(this).find(".table-responsive-stack-thead").hide();
      $(this).find('thead').show();
   });
      
      

   }
// flextable   
}      
 
flexTable();
   
window.onresize = function(event) {
    flexTable();
};
   
   
   
   

  
// document ready  
});
    </script>
    
</body>
</html>