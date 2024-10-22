<?php 
	$ogimage = $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']) . "/php/image.php?" . $_SERVER['QUERY_STRING'];
	$url = 'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>
<html>
<head>
<meta charset="UTF-8">
<meta property="og:title"
content="Meus candidatos para o Conselho Participativo Municipal" />
<meta property="og:site_name" content="#OCUPACONSELHO"/>
<meta property="og:url" content="<?php echo $url; ?>">
<meta property="og:image" content="<?php echo 'http://' . $ogimage ?>">
<meta property="og:image:type" content="image/png">
<meta property="og:type" content="website">
<meta property="og:image:width" content="600">
<meta property="og:image:height" content="300">

<title>#OCUPACONSELHO</title>

<!-- Load jQuery and Sheetrock from CDNJS -->
<script src="js/jquery.min.js"></script>
<script src="js/sheetrock.min.js"></script>
<script src="js/handlebars.min.js"></script>
<script src="js/typeahead.bundle.js"></script>
<script src="js/config.js"></script>
<script src="js/misc.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

<link rel="stylesheet" href="css/main.css" >
<link rel="stylesheet" href="css/misc.css" >

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

<script>

	Handlebars.registerHelper('split', function(text) {
  		var t = text.split(" ");
  		return "<span class='tag'>" + t.join("</span> <span class='tag'>") + "</span>";
	});
	
	var getQuery = function () {
		q = []
		var candidatos = gup("candidatos").split(",");
		
		for (i in candidatos) {
			q.push(" E = " + candidatos[i])
		}
		return 'select * where ' + q.join(" OR ")
	}

	$().ready(function (){

		// Compile the Handlebars template for HR leaders.
		var HRTemplate = Handlebars.compile($('#hr-template').html());
		var HRLocalTemplate = Handlebars.compile($('#hr-local-template').html());

		// Load top five HR leaders.
		if (gup("candidatos") != '') {
		$('#hr').sheetrock({
		  
		  url: candidatos_sheet,
		  query: getQuery(),
		  rowTemplate: HRTemplate
		
		});
		}
		
		if (gup('nome') != '') {
		$('#hr-local').sheetrock({
				  url: local_sheet,
				  query: "select * where B contains '"+gup('nome')+"'",
				  fetchSize: 2,
				  rowTemplate: HRLocalTemplate
				});
		}
		var ogimage = "http://ocupaconselho.org.br/vote/php/image.php?nome=" + gup("nome") + "&candidatos=" + gup("candidatos");
		$('meta[property="og:image"]').attr('content', ogimage);

	});
</script>

<style>
#hr {
	text-align: center;
	clear:both;
	min-height: 315px;
	width:600px;
	padding-left:0px;
}

.card {
	width:182px;
	height:220px;
	text-align: center;
	float:left;
	margin:3px;
	margin-bottom: 10px;
	background-color: #F2F2F2;
	border:5px solid #F2F2F2;
}

.foto {
	margin-top:3px;
	margin-left:3px;
	width:82px;
	height:82px;
	background-color: #FFF;
	float:left;
}
.numero {
	font-size:23px;
	float:right;
	padding:10px;
}
.numero .lab {
	font-size: 11px;
}
.top {
	height:125px;
	clear:both;
}
.nome {
	height:50px;
	font-size: 15px;
	padding:3px;
	line-height: 1;
}

.bottom {
	height:37px;
	clear:both;
	background-color: #8C3438;
}

.tags { 
	color:#FFF;
}

#hr-local {
	clear:both;
	width:600px;
	text-align: left;
	height:140px;
}

.local { 
	width:600px;
	height:100px;
	background-color: #8C3438;
	color:#FFFFFF;
	text-align: center;
	float:right;
	padding-left:15px;
}

.local-legenda {
	font-size: 15px;
	font-weight: 600;

}
.legenda {
	clear:both;
}

.escolha {
	text-align: center;
	background-color: #8C3438;
	width: 945px;
	height: 47px;
	color:#FFFFFF;
	font-weight: 600;
	font-size: 23px;
	margin:0 auto;
	clear:both;
	vertical-align: middle;
	margin-top:15px;
}

.tagline {
	width:600px;
	color:#FFFFFF;
	background-color: #8C3438;
}

.middle {
	width:600px;
}

.fb-share-button {
	padding-top:10px;
}

@media print {
	.fb-share-button {
		display:none !important;
	}
}
</style>
</head>

<body class="cola">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=803138933106775";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<div class="tagline">
		<h2>AS ELEIÇÕES SERÃO DIA 06/12</h2>
	</div>
	

	<div class="middle">
		
		<div id="hr">
  		<script id="hr-template" type="text/x-handlebars-template">
	    	<div class="card" onclick="javascript:toggle(this);">
	    		
	      		<div class="top">
	      			<img class="foto" src="{{cells.PICT}}" />
	      			<div class="numero">
	      			<span class="lab">Nº DE URNA</span><br />
	      				<span>{{cells.Numero}}</span>
	      				</div>
	      		</div>
	      		<div class="nome">{{cells.Nome}}</div>
	      		<div class="bottom">
		      		<div class="tags">
		      			{{{split cells.Tags}}}
		      		</div>
		      		<!-- <div class="label label-warning">{{cells.Subprefeitura}}</div> -->
	    		</div>
	    	</div>
  		</script>
  		</div>
	
		<div id="hr-local">
  		<script id="hr-local-template" type="text/x-handlebars-template">
    		<div class="local">
    			<div class="local-legenda">Seu local de votação:</div>
    			<b>{{cells.NOME}}</b>
    			<div>{{cells.ENDEREÇO}}</div>
	    	<div class="fb-share-button" data-href="<?php echo $url; ?>" data-layout="button"></div>
	    	</div>
			
  		</script>
		</div>	
		
	</div>
</body>
</html>