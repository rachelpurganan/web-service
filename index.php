<html>
<head>
<title>Korean Drama Web Service Demo</title>
<style>
  
    body {font-family:georgia;}
  
    .drama{
      border:1px solid #E77DC2;
      border-radius: 5px;
      padding: 5px;
      margin-bottom:5px;
      position:relative;   
    }
   
    div.pic img{
      position:absolute;
      right:10px;
      top:10px;
      max-width: 75px;
      height: auto;
    }

</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">

function kdramaTemplate(drama) {
  return `<div class="drama">
        <b>Title: </b> ${drama.Title}<br />
        <b>Year: </b> ${drama.Year}<br />
        <b>Cast: </b> ${drama.Cast}<br />
        <b>Director: </b> ${drama.Director}<br />
        <b>Status: </b> ${drama.Status}<br />
        <b>Episodes: </b> ${drama.Episodes}<br />
        <div class="pic">
          <img src="thumbnails/${drama.Image}" />
        </div>
    </div>`;
}

  
$(document).ready(function() {  

	$('.category').click(function(e){
        e.preventDefault(); //stop default action of the link
		cat = $(this).attr("href");  //get category from URL

    var request = $.ajax({
      url: "api.php?cat=" + cat,
      method: "GET",
      dataType: "json"
    });
    request.done(function( data ) {
      console.log(data);
      //place the title on the page
      $("#dramatitle").html(data.title);

      //clears the previous dramas 
      $("#dramas").html("");

      //loops through dramas and adds to page
      $.each(data.dramas, function(key, value){ //data.dramas is the array
      let str = kdramaTemplate(value);

      $("<div></div>").html(str).appendTo("#dramas");
        
      });

      //view JSON as a string on the page
      /*
      let myData = JSON.stringify(data, null, 4);
      myData = "<pre>" + myData + "</pre>";
      $("#output").html(myData);
      */
      
    });
    request.fail(function( jqXHR, textStatus ) {
      alert( "Request failed: " + textStatus );
    });
    
	});
});	

</script>
</head>
	<body>
	<h1>Korean Drama Web Service</h1>
		<a href="year" class="category">Korean Dramas By Year</a><br />
		<a href="box" class="category">Korean Dramas By International Box Office Totals</a>
		<h3 id="dramatitle">Title Will Go Here</h3>
		<div id="dramas">
			<p>Dramas will go here</p>
		</div>
    <!--
      <div class="drama">
        <b>Drama: </b> 1<br />
        <b>Title: </b> Dr. YES<br />
        <b>Year: </b> 1962<br />
        <b>Director: </b> Terence Young<br />
        <b>Producers: </b> Harry Saltzman and Albert R. Broccoli<br />
        <b>Writers: </b> Richard Maibaum, Johanna Harwood and Berkely Mather<br />
        <b>Composer: </b> Monty Norman<br />
        <b>Bond: </b> Sean Connery<br />
        <b>Budget: </b> $1,000,000.00<br />
        <b>BoxOffice: </b> $59,567,035.00<br />
        <div class="pic">
          <img src="thumbnails/dr-no.jpg" />
        </div>
    </div>
    -->
		<div id="output">Results go here</div>
	</body>
</html>