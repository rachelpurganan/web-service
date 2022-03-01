<html>
<head>
<title>Bond Web Service Demo</title>
<style>
  
    body {font-family:georgia;}
  
    .film{
      border:1px solid #E77DC2;
      border-radius: 5px;
      padding: 5px;
      margin-bottom:5px;
      position:relative;   
    }
   
    .pic{
      position:absolute;
      right:10px;
      top:10px;
    }

</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">

function bondTemplate(film) {
  return `<div class="film">
        <b>Film: </b> ${film.Film}<br />
        <b>Title: </b> ${film.Title}<br />
        <b>Year: </b> ${film.Year}<br />
        <b>Director: </b> ${film.Director}<br />
        <b>Producers: </b> ${film.Producers}<br />
        <b>Writers: </b> ${film.Writers}<br />
        <b>Composer: </b> ${film.Composer}<br />
        <b>Bond: </b> ${film.Bond}<br />
        <b>Budget: </b> ${film.Budget}<br />
        <b>BoxOffice: </b> ${film.BoxOffice}<br />
        <div class="pic">
          <img src="thumbnails/${film.Image}" />
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
      $("#filmtitle").html(data.title);

      //clears the previous films 
      $("#films").html("");

      //loops through films and adds to page
      $.each(data.films, function(key, value){ //data.films is the array
      let str = bondTemplate(value);

      $("<div></div>").html(str).appendTo("#films");
        
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
	<h1>Bond Web Service</h1>
		<a href="year" class="category">Bond Films By Year</a><br />
		<a href="box" class="category">Bond Films By International Box Office Totals</a>
		<h3 id="filmtitle">Title Will Go Here</h3>
		<div id="films">
			<p>Films will go here</p>
		</div>
    <!--
      <div class="film">
        <b>Film: </b> 1<br />
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