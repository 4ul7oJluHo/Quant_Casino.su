<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="keywords" content="вёрстка, HTML, CSS, блог">
    <meta name="description" content="Блог о процессе обучения веб-технологиям">
    <title> QuantCasino </title>\
    <style>body {
      background: url(11.png) no-repeat;
      -moz-background-size: 100%; 
      -webkit-background-size: 100%; 
      -o-background-size: 100%; 
      background-size: 100%; 
      display:flex;
      align-items: column;
    }
    #h{
      display:flex;
      flex-direction:column
      ;
     } </style>
    <link rel="stylesheet" href="outlines-alternate.css">
    
  </head>
  <body>
    
    <div id="chart"></div>

    <div id="question"><h1></h1></div>
    <form method="POST">
    <input type="submit" name="nazvanie_knopki" value="Нажмите" />
</form>
     

    <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>

 
    <div id="h">
    <header> 
 
    <span style="color: white;
  font-size: 40px;
  text-shadow: 0 0 5px white, 0 0 10px white, 0 0 15px white, 0 0 20px blue, 0 0 35px blue, 0 0 40px blue, 0 0 50px blue, 0 0 75px blue;">  QuantCasino  </span>
      
    </header>	<form method="post" action="index.php">
		<input name="name" placeholder="имя"></input>
		<input name="email" placeholder="email"></input>
    <input name="password" placeholder="пароль"></input>
      
    <button class="btn btn-success" type="sudmit"> Зарегестироваться </button>

  </form>
</div>
    <main>
      <nav>
        
      </nav>
      <section>
         
 <span style="
  color: white;
  font-size: 25px;
  text-shadow: 0 0 5px white, 0 0 10px white, 0 0 15px white, 0 0 20px blue, 0 0 35px blue, 0 0 40px blue, 0 0 50px blue, 0 0 75px blue;
"> В данном режиме нужно поставить на определённый цвет,разные цвета увеличивают вашу сумму при выйгрыше по разному  </span>
 <span style="
  color: white;
  font-size: 25px;
  text-shadow: 0 0 5px white, 0 0 10px white, 0 0 15px white, 0 0 20px blue, 0 0 35px blue, 0 0 40px blue, 0 0 50px blue, 0 0 75px blue;">поставьте свои кванткоины и увеличте их! </span>
      </section>
    
    </main>
    <footer>
   
    </footer>

 

 <script type="text/javascript" charset="utf-8">

  var padding = {top:20, right:40, bottom:0, left:0},

      w = 500 - padding.left - padding.right,

      h = 500 - padding.top  - padding.bottom,

      r = Math.min(w, h)/2,

      rotation = 0,

      oldrotation = 0,

      picked = 100000,

      oldpick = [],

      color = d3.scale.category20();//category20c()

      //randomNumbers = getRandomNumbers();

  var data = [
    {"label":"2X",  "value":1,  "question":"What CSS property is used for specifying the area between the content and its border?"}, // padding

            {"label":"CRASH",  "value":1,  "question":"What CSS property is used for specifying the area between the content and its border?"}, // padding

              {"label":"4X",  "value":1,  "question":"What CSS property is used for changing the font?"}, //font-family

              

              

  ];

  var svg = d3.select('#chart')

      .append("svg")

      .data([data])

      .attr("width",  w + padding.left + padding.right)

      .attr("height", h + padding.top + padding.bottom);

  var container = svg.append("g")

      .attr("class", "chartholder")

      .attr("transform", "translate(" + (w/2 + padding.left) + "," + (h/2 + padding.top) + ")");

  var vis = container

      .append("g");

       

  var pie = d3.layout.pie().sort(null).value(function(d){return 1;});
// declare an arc generator function

  var arc = d3.svg.arc().outerRadius(r);

  // select paths, use arc generator to draw

  var arcs = vis.selectAll("g.slice")

      .data(pie)

      .enter()

      .append("g")

      .attr("class", "slice");
      

  arcs.append("path")

      .attr("fill", function(d, i){ return color(i); })

      .attr("d", function (d) { return arc(d); });

  // add the text
  arcs.append("text").attr("transform", function(d){

          d.innerRadius = 0;

          d.outerRadius = r;

          d.angle = (d.startAngle + d.endAngle)/2;

          return "rotate(" + (d.angle * 180 / Math.PI - 90) + ")translate(" + (d.outerRadius -10) +")";

      })

      .attr("text-anchor", "end")
      .attr("color","white")
      .attr("margin","250px")
      .attr("font-size","25px")
      .attr("font-color","red")
      .text( function(d, i) {

          return data[i].label;
   });
container.on("click", spin);

function spin(d){
  container.on("click", null);
   //all slices have been seen, all done
    console.log("OldPick: " + oldpick.length, "Data length: " + data.length);
   if(oldpick.length == data.length){
        console.log("done");
       container.on("click", null);
      return;

      }

      var  ps       = 360/data.length,

           pieslice = Math.round(1440/data.length),

           rng      = Math.floor((Math.random() * 1440) + 360);

           

      rotation = (Math.round(rng / ps) * ps);

       

      picked = Math.round(data.length - (rotation % 360)/ps);

      picked = picked >= data.length ? (picked % data.length) : picked;

      if(oldpick.indexOf(picked) !== -1){

          d3.select(this).call(spin);

          return;

      } else {

          oldpick.push(picked);

      }

      rotation += 90 - Math.round(ps/2);
     vis.transition()                .duration(3000)

          .attrTween("transform", rotTween)

          .each("end", function(){

              //mark question as seen
         d3.select(".slice:nth-child(" + (picked + 1) + ") path")
               .attr("fill", "#111");
            //populate question

            text(data[picked].question);

              oldrotation = rotation;

           

              container.on("click", spin );

          });

  }

  //make arrow
svg.append("g")

      .attr("transform", "translate(" + (w + padding.left + padding.right) + "," + ((h/2)+padding.top) + ")")

      .append("path")

      .attr("d", "M-" + (r*.15) + ",0L0," + (r*.05) + "L0,-" + (r*.05) + "Z")

      .style({"fill":"black"});

  //draw spin circle

  container.append("circle")

      .attr("cx", 0)

      .attr("cy", 0)

      .attr("r", 60)

      .style({"fill":"white","cursor":"pointer"});

  //spin text

  container.append("text")

      .attr("x", 0)
  .attr("y", 15)

      .attr("text-anchor", "middle")

      .text("SPIN")

      .style({"font-weight":"bold", "font-size":"30px"});

   

   

  function rotTween(to) {

    var i = d3.interpolate(oldrotation % 360, rotation);

    return function(t) {
  return "rotate(" + i(t) + ")";
};

  }

   

   

  function getRandomNumbers(){
    var array = new Uint16Array(1000);
 var scale = d3.scale.linear().range([360, 1440]).domain([0, 100000]);

      if(window.hasOwnProperty("crypto") && typeof window.crypto.getRandomValues === "function"){

          window.crypto.getRandomValues(array);

          console.log("works");

      } else {

          //no support for crypto, get crappy random numbers

          for(var i=0; i < 1000; i++){

              array[i] = Math.floor(Math.random() * 100000) + 1;

          }

      }

      return array;

  }

</script>

<?php
 if( isset( $_POST['nazvanie_knopki'] ) )
 {
   
    

echo rand(1, 15);
 }

?>
  </body>
</html>
