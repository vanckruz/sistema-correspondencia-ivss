<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>404 Objeto no localizado</title>
       
<style>
html,body{
	width:100%;
	height:100%;
	margin:0px;
	padding:0px;
	background:#f1f1f1;
}
#wrapper{
 	width: 40%;
 	height: 50%;
 	margin:auto;
 	margin-top:250px;
 	background: transparent;
 }

#mensaje{
	margin:auto;
	width: 90%;
	font-size: 1.5em;
}

#rueda{
	width:100%;
	height:100%;
	position:absolute;
	opacity: 0.9;
	top:0;
	left:2;
	z-index:1;
	animation-duration:25s;
	animation-name:giro;
	-moz-animation-duration:25s;
	-moz-animation-name: giro;
	-webkit-animation-duration:25s;
	-webkit-animation-name: giro;
}

@keyframes giro{
0%{transform:rotate(180deg);}
	1%{transform:rotate(10deg);}
	2%{transform:rotate(15deg);}
	3%{transform:rotate(20deg);}
	4%{transform:rotate(25deg);}
	5%{transform:rotate(30deg);}
	6%{transform:rotate(35deg);}
	7%{transform:rotate(40deg);}
	8%{transform:rotate(45deg);}
	9%{transform:rotate(50deg);}
	10%{transform:rotate(55deg);opacity:0.8;}
	11%{transform:rotate(60deg);}
	12%{transform:rotate(65deg);}
	13%{transform:rotate(70deg);}
	14%{transform:rotate(75deg);}
	15%{transform:rotate(80deg);}
	16%{transform:rotate(85deg);}
	17%{transform:rotate(90deg);}
	18%{transform:rotate(95deg);}
	19%{transform:rotate(100deg);}
	20%{transform:rotate(105deg);opacity:0.5;}
	21%{transform:rotate(110deg);}
	22%{transform:rotate(115deg);}
	23%{transform:rotate(120deg);}
	24%{transform:rotate(125deg);}
	25%{transform:rotate(130deg);}
	26%{transform:rotate(135deg);}
	27%{transform:rotate(140deg);}
	28%{transform:rotate(145deg);}
	29%{transform:rotate(150deg);}
	30%{transform:rotate(155deg);opacity:0.8;}
	31%{transform:rotate(160deg);}
	32%{transform:rotate(165deg);}
	33%{transform:rotate(170deg);}
	34%{transform:rotate(175deg);}
	35%{transform:rotate(180deg);}
	36%{transform:rotate(185deg);}
	37%{transform:rotate(190deg);}
	38%{transform:rotate(200deg);}
	39%{transform:rotate(205deg);}
	40%{transform:rotate(210deg);opacity:0.5;}
	41%{transform:rotate(215deg);}
	42%{transform:rotate(220deg);}
	43%{transform:rotate(225deg);}
	44%{transform:rotate(230deg);}
	45%{transform:rotate(235deg);}
	46%{transform:rotate(240deg);}
	47%{transform:rotate(245deg);}
	48%{transform:rotate(250deg);}
	49%{transform:rotate(255deg);}
	50%{transform:rotate(260deg);opacity:0.8;}
	51%{transform:rotate(265deg);}
	52%{transform:rotate(270deg);}
	53%{transform:rotate(275deg);}
	54%{transform:rotate(280deg);}
	55%{transform:rotate(285deg);}
	56%{transform:rotate(290deg);}
	57%{transform:rotate(295deg);}
	58%{transform:rotate(300deg);}
	59%{transform:rotate(305deg);}
	60%{transform:rotate(310deg);opacity:0.5;}
	61%{transform:rotate(315deg);}
	62%{transform:rotate(320deg);}
	63%{transform:rotate(325deg);}
	64%{transform:rotate(330deg);}
	65%{transform:rotate(335deg);}
	66%{transform:rotate(340deg);}
	67%{transform:rotate(345deg);}
	68%{transform:rotate(350deg);}
	69%{transform:rotate(355deg);}
	70%{transform:rotate(360deg);opacity:0.8;}
	71%{transform:rotate(365deg);}
	72%{transform:rotate(370deg);}
	73%{transform:rotate(375deg);}
	74%{transform:rotate(380deg);}
	75%{transform:rotate(385deg);}
	76%{transform:rotate(390deg);}
	77%{transform:rotate(395deg);}
	78%{transform:rotate(400deg);}
	79%{transform:rotate(405deg);}
	80%{transform:rotate(410deg);opacity:0.5;}
	81%{transform:rotate(415deg);}
	82%{transform:rotate(420deg);}
	83%{transform:rotate(425deg);}
	84%{transform:rotate(430deg);}
	85%{transform:rotate(435deg);}
	86%{transform:rotate(440deg);}
	87%{transform:rotate(445deg);}
	88%{transform:rotate(450deg);}
	89%{transform:rotate(500deg);}
	90%{transform:rotate(1000deg);opacity:0.8;}
	91%{transform:rotate(550deg);}
	92%{transform:rotate(600deg);}
	93%{transform:rotate(650deg);}
	94%{transform:rotate(700deg);}
	95%{transform:rotate(750deg);opacity:0.5;}
	96%{transform:rotate(800deg);}
	97%{transform:rotate(850deg);}
	98%{transform:rotate(900deg);}
	99%{transform:rotate(950deg);}
	100%{transform:rotate(1000deg);opacity:0.8;}
}

@-moz-keyframes giro{
	0%{-moz-transform:rotate(180deg)}
	1%{-moz-transform:rotate(10deg)}
	2%{-moz-transform:rotate(15deg)}
	3%{-moz-transform:rotate(20deg)}
	4%{-moz-transform:rotate(25deg)}
	5%{-moz-transform:rotate(30deg)}
	6%{-moz-transform:rotate(35deg)}
	7%{-moz-transform:rotate(40deg)}
	8%{-moz-transform:rotate(45deg)}
	9%{-moz-transform:rotate(50deg)}
	10%{-moz-transform:rotate(55deg);opacity:0.8;}
	11%{-moz-transform:rotate(60deg)}
	12%{-moz-transform:rotate(65deg)}
	13%{-moz-transform:rotate(70deg)}
	14%{-moz-transform:rotate(75deg)}
	15%{-moz-transform:rotate(80deg)}
	16%{-moz-transform:rotate(85deg)}
	17%{-moz-transform:rotate(90deg)}
	18%{-moz-transform:rotate(95deg)}
	19%{-moz-transform:rotate(100deg)}
	20%{-moz-transform:rotate(105deg);opacity:0.5;}
	21%{-moz-transform:rotate(110deg)}
	22%{-moz-transform:rotate(115deg)}
	23%{-moz-transform:rotate(120deg)}
	24%{-moz-transform:rotate(125deg)}
	25%{-moz-transform:rotate(130deg)}
	26%{-moz-transform:rotate(135deg)}
	27%{-moz-transform:rotate(140deg)}
	28%{-moz-transform:rotate(145deg)}
	29%{-moz-transform:rotate(150deg)}
	30%{-moz-transform:rotate(155deg);opacity:0.8;}
	31%{-moz-transform:rotate(160deg)}
	32%{-moz-transform:rotate(165deg)}
	33%{-moz-transform:rotate(170deg)}
	34%{-moz-transform:rotate(175deg)}
	35%{-moz-transform:rotate(180deg)}
	36%{-moz-transform:rotate(185deg)}
	37%{-moz-transform:rotate(190deg)}
	38%{-moz-transform:rotate(200deg)}
	39%{-moz-transform:rotate(205deg)}
	40%{-moz-transform:rotate(210deg);opacity:0.5;}
	41%{-moz-transform:rotate(215deg)}
	42%{-moz-transform:rotate(220deg)}
	43%{-moz-transform:rotate(225deg)}
	44%{-moz-transform:rotate(230deg)}
	45%{-moz-transform:rotate(235deg)}
	46%{-moz-transform:rotate(240deg)}
	47%{-moz-transform:rotate(245deg)}
	48%{-moz-transform:rotate(250deg)}
	49%{-moz-transform:rotate(255deg)}
	50%{-moz-transform:rotate(260deg);opacity:0.8;}
	51%{-moz-transform:rotate(265deg)}
	52%{-moz-transform:rotate(270deg)}
	53%{-moz-transform:rotate(275deg)}
	54%{-moz-transform:rotate(280deg)}
	55%{-moz-transform:rotate(285deg)}
	56%{-moz-transform:rotate(290deg)}
	57%{-moz-transform:rotate(295deg)}
	58%{-moz-transform:rotate(300deg)}
	59%{-moz-transform:rotate(305deg)}
	60%{-moz-transform:rotate(310deg);opacity:0.5;}
	61%{-moz-transform:rotate(315deg)}
	62%{-moz-transform:rotate(320deg)}
	63%{-moz-transform:rotate(325deg)}
	64%{-moz-transform:rotate(330deg)}
	65%{-moz-transform:rotate(335deg)}
	66%{-moz-transform:rotate(340deg)}
	67%{-moz-transform:rotate(345deg)}
	68%{-moz-transform:rotate(350deg)}
	69%{-moz-transform:rotate(355deg)}
	70%{-moz-transform:rotate(360deg);opacity:0.8;}
	71%{-moz-transform:rotate(365deg)}
	72%{-moz-transform:rotate(370deg)}
	73%{-moz-transform:rotate(375deg)}
	74%{-moz-transform:rotate(380deg)}
	75%{-moz-transform:rotate(385deg)}
	76%{-moz-transform:rotate(390deg)}
	77%{-moz-transform:rotate(395deg)}
	78%{-moz-transform:rotate(400deg)}
	79%{-moz-transform:rotate(405deg)}
	80%{-moz-transform:rotate(410deg);opacity:0.5;}
	81%{-moz-transform:rotate(415deg)}
	82%{-moz-transform:rotate(420deg)}
	83%{-moz-transform:rotate(425deg)}
	84%{-moz-transform:rotate(430deg)}
	85%{-moz-transform:rotate(435deg)}
	86%{-moz-transform:rotate(440deg)}
	87%{-moz-transform:rotate(445deg)}
	88%{-moz-transform:rotate(450deg)}
	89%{-moz-transform:rotate(500deg)}
	90%{-moz-transform:rotate(1000deg);opacity:0.8;}
	91%{-moz-transform:rotate(550deg)}
	92%{-moz-transform:rotate(600deg)}
	93%{-moz-transform:rotate(650deg)}
	94%{-moz-transform:rotate(700deg)}
	95%{-moz-transform:rotate(750deg);opacity:0.5;}
	96%{-moz-transform:rotate(800deg)}
	97%{-moz-transform:rotate(850deg)}
	98%{-moz-transform:rotate(900deg)}
	99%{-moz-transform:rotate(950deg)}
	100%{-moz-transform:rotate(1000deg);opacity:0.8;}
}

@-webkit-keyframes giro{
	0%{-webkit-transform:rotate(180deg)}
	1%{-webkit-transform:rotate(10deg)}
	2%{-webkit-transform:rotate(15deg)}
	3%{-webkit-transform:rotate(20deg)}
	4%{-webkit-transform:rotate(25deg)}
	5%{-webkit-transform:rotate(30deg)}
	6%{-webkit-transform:rotate(35deg)}
	7%{-webkit-transform:rotate(40deg)}
	8%{-webkit-transform:rotate(45deg)}
	9%{-webkit-transform:rotate(50deg)}
	10%{-webkit-transform:rotate(55deg);opacity:0.8;}
	11%{-webkit-transform:rotate(60deg)}
	12%{-webkit-transform:rotate(65deg)}
	13%{-webkit-transform:rotate(70deg)}
	14%{-webkit-transform:rotate(75deg)}
	15%{-webkit-transform:rotate(80deg)}
	16%{-webkit-transform:rotate(85deg)}
	17%{-webkit-transform:rotate(90deg)}
	18%{-webkit-transform:rotate(95deg)}
	19%{-webkit-transform:rotate(100deg)}
	20%{-webkit-transform:rotate(105deg);opacity:0.5;}
	21%{-webkit-transform:rotate(110deg)}
	22%{-webkit-transform:rotate(115deg)}
	23%{-webkit-transform:rotate(120deg)}
	24%{-webkit-transform:rotate(125deg)}
	25%{-webkit-transform:rotate(130deg)}
	26%{-webkit-transform:rotate(135deg)}
	27%{-webkit-transform:rotate(140deg)}
	28%{-webkit-transform:rotate(145deg)}
	29%{-webkit-transform:rotate(150deg)}
	30%{-webkit-transform:rotate(155deg);opacity:0.8;}
	31%{-webkit-transform:rotate(160deg)}
	32%{-webkit-transform:rotate(165deg)}
	33%{-webkit-transform:rotate(170deg)}
	34%{-webkit-transform:rotate(175deg)}
	35%{-webkit-transform:rotate(180deg)}
	36%{-webkit-transform:rotate(185deg)}
	37%{-webkit-transform:rotate(190deg)}
	38%{-webkit-transform:rotate(200deg)}
	39%{-webkit-transform:rotate(205deg)}
	40%{-webkit-transform:rotate(210deg);opacity:0.5;}
	41%{-webkit-transform:rotate(215deg)}
	42%{-webkit-transform:rotate(220deg)}
	43%{-webkit-transform:rotate(225deg)}
	44%{-webkit-transform:rotate(230deg)}
	45%{-webkit-transform:rotate(235deg)}
	46%{-webkit-transform:rotate(240deg)}
	47%{-webkit-transform:rotate(245deg)}
	48%{-webkit-transform:rotate(250deg)}
	49%{-webkit-transform:rotate(255deg)}
	50%{-webkit-transform:rotate(260deg);opacity:0.8;}
	51%{-webkit-transform:rotate(265deg)}
	52%{-webkit-transform:rotate(270deg)}
	53%{-webkit-transform:rotate(275deg)}
	54%{-webkit-transform:rotate(280deg)}
	55%{-webkit-transform:rotate(285deg)}
	56%{-webkit-transform:rotate(290deg)}
	57%{-webkit-transform:rotate(295deg)}
	58%{-webkit-transform:rotate(300deg)}
	59%{-webkit-transform:rotate(305deg)}
	60%{-webkit-transform:rotate(310deg);opacity:0.5;}
	61%{-webkit-transform:rotate(315deg)}
	62%{-webkit-transform:rotate(320deg)}
	63%{-webkit-transform:rotate(325deg)}
	64%{-webkit-transform:rotate(330deg)}
	65%{-webkit-transform:rotate(335deg)}
	66%{-webkit-transform:rotate(340deg)}
	67%{-webkit-transform:rotate(345deg)}
	68%{-webkit-transform:rotate(350deg)}
	69%{-webkit-transform:rotate(355deg)}
	70%{-webkit-transform:rotate(360deg);opacity:0.8;}
	71%{-webkit-transform:rotate(365deg)}
	72%{-webkit-transform:rotate(370deg)}
	73%{-webkit-transform:rotate(375deg)}
	74%{-webkit-transform:rotate(380deg)}
	75%{-webkit-transform:rotate(385deg)}
	76%{-webkit-transform:rotate(390deg)}
	77%{-webkit-transform:rotate(395deg)}
	78%{-webkit-transform:rotate(400deg)}
	79%{-webkit-transform:rotate(405deg)}
	80%{-webkit-transform:rotate(410deg);opacity:0.5;}
	81%{-webkit-transform:rotate(415deg)}
	82%{-webkit-transform:rotate(420deg)}
	83%{-webkit-transform:rotate(425deg)}
	84%{-webkit-transform:rotate(430deg)}
	85%{-webkit-transform:rotate(435deg)}
	86%{-webkit-transform:rotate(440deg)}
	87%{-webkit-transform:rotate(445deg)}
	88%{-webkit-transform:rotate(450deg)}
	89%{-webkit-transform:rotate(500deg)}
	90%{-webkit-transform:rotate(1000deg);opacity:0.8;}
	91%{-webkit-transform:rotate(550deg)}
	92%{-webkit-transform:rotate(600deg)}
	93%{-webkit-transform:rotate(650deg)}
	94%{-webkit-transform:rotate(700deg)}
	95%{-webkit-transform:rotate(750deg);opacity:0.5;}
	96%{-webkit-transform:rotate(800deg)}
	97%{-webkit-transform:rotate(850deg)}
	98%{-webkit-transform:rotate(900deg)}
	99%{-webkit-transform:rotate(950deg)}
	100%{-webkit-transform:rotate(1000deg);opacity:0.8;}
}

#ivss{
position:absolute;
top:0;
left:50px;
opacity:0.1;
animation-duration:16s;
animation-name: logo_volatil;
-moz-animation-duration:16s;
-moz-animation-name: logo_volatil;
-webkit-animation-duration:16s;
-webkit-animation-name: logo_volatil;
}

@keyframes logo_volatil{
	1%{margin-top:50px;}
	2%{margin-top:100px;}
	3%{margin-top:150px;}
	4%{margin-top:200px;}
	5%{margin-top:250px;}
	6%{margin-top:300px;}
	7%{margin-top:350px;}
	8%{margin-top:400px;}
	
	10%{opacity:1;}
	30%{transform:rotate(180deg)}
	50%{transform:rotate(360deg)}
	60%{margin-top:0px;opacity:0.5;}
	61%{margin-top:50px;}
	62%{margin-top:100px;}
	63%{margin-top:150px;}
	64%{margin-top:200px;}
	65%{margin-top:250px;}
	66%{margin-top:300px;}
	67%{margin-top:350px;}
	68%{margin-top:400px;}
	70%{opacity:1;}
}

@-moz-keyframes logo_volatil{
	1%{margin-top:50px;}
	2%{margin-top:100px;}
	3%{margin-top:150px;}
	4%{margin-top:200px;}
	5%{margin-top:250px;}
	6%{margin-top:300px;}
	7%{margin-top:350px;}
	8%{margin-top:400px;}
	
	10%{opacity:1;}
	30%{-moz-transform:rotate(180deg)}
	50%{-moz-transform:rotate(360deg)}
	60%{margin-top:0px;opacity:0.5;}
	61%{margin-top:50px;}
	62%{margin-top:100px;}
	63%{margin-top:150px;}
	64%{margin-top:200px;}
	65%{margin-top:250px;}
	66%{margin-top:300px;}
	67%{margin-top:350px;}
	68%{margin-top:400px;}
	70%{opacity:1;}
}

@-webkit-keyframes logo_volatil{
	1%{margin-top:50px;}
	2%{margin-top:100px;}
	3%{margin-top:150px;}
	4%{margin-top:200px;}
	5%{margin-top:250px;}
	6%{margin-top:300px;}
	7%{margin-top:350px;}
	8%{margin-top:400px;}
	
	10%{opacity:1;}
	30%{-webkit-transform:rotate(180deg)}
	50%{-webkit-transform:rotate(360deg)}
	60%{margin-top:0px;opacity:0.5;}
	61%{margin-top:50px;}
	62%{margin-top:100px;}
	63%{margin-top:150px;}
	64%{margin-top:200px;}
	65%{margin-top:250px;}
	66%{margin-top:300px;}
	67%{margin-top:350px;}
	68%{margin-top:400px;}
	70%{opacity:1;}
}

h2 {
animation-duration: 5s;
animation-name: slidein;
-moz-animation-duration: 5s;
-moz-animation-name: slidein;
-webkit-animation-duration: 5s;
-webkit-animation-name: slidein;
}

@keyframes slidein {
  from {
    margin-left: 100%;
    width: 300%
  }

  to {
    margin-left: 0%;
    width: 100%;
  }
} 

@-moz-keyframes slidein {
  from {
    margin-left: 100%;
    width: 300%
  }

  to {
    margin-left: 0%;
    width: 100%;
  }
} 

@-webkit-keyframes slidein {
  from {
    margin-left: 100%;
    width: 300%
  }

  to {
    margin-left: 0%;
    width: 100%;
  }
} 
#link{
	background: transparent;
	border-radius:0%;
	width: 200px;
	height: 30px;
	cursor:pointer;
	position:absolute;
	top:70%;
	right:5%;
	z-index:1;
	padding:7px;
	color: blue;
	font-size:1.2em;
	animation-name: inicio;
	animation-duration:16s;
}

#link a{
	text-decoration: none;
}

#caja_link{
	width: 80%;
	margin:auto;
	margin-top:10px;
}

@keyframes inicio{
	1%{padding:25px;}
	10%{padding:10px;}
	30%{padding:25px;}
	40%{padding:10px;}
	50%{padding:25px;}
	60%{padding:10px;}
	70%{padding:25px;}
	80%{padding:10px;}
	90%{padding:25px;}
	100%{padding:10px;}
}
</style>

</head>
<body>
  
 <h2>
	<?php echo $heading; ?>
	<?php echo $message; ?>
</h2>	 
  <div id="wrapper">
  	<div id="mensaje">
  		<h2>¡ Error 404 Pagina no encontrada !</h2>
  	</div>
  </div>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px"  viewBox="0 0 160 160" enable-background="new 0 0 160 160" xml:space="preserve" id="rueda">
				<g id="Layer_1">
				    <path fill="#613A82" d="M136.595,23.43C122.131,8.956,102.116,0,80.011,0c-22.127,0.018-42.131,8.956-56.6,23.43   c-6.782,6.786-12.293,14.824-16.296,23.726C2.575,57.181,0,68.294,0,80.003c0,22.091,8.971,42.072,23.411,56.546   C37.88,151.016,57.884,160,80.011,160c22.105,0,42.109-8.984,56.584-23.452C151.061,122.075,160,102.094,160,80.003   c0-11.947-2.666-23.241-7.355-33.421C148.66,37.958,143.244,30.098,136.595,23.43z M24.281,120.854   c-3.84-5.212-6.961-10.978-9.225-17.133c1.721,0.416,3.658,0.533,5.151,0.923c2.556,0.632,5.096,4.636,6.154,5.08   C27.391,110.122,25.339,119.463,24.281,120.854z M128.934,128.916c-12.541,12.503-29.84,20.263-48.923,20.263   c-11.343,0-22.025-2.761-31.482-7.626c1.162-2.295,1.956-8.984,1.956-8.984s1.672-16.723,1.039-17.753   c-0.617-1.077-4.856-5.093-7.603-6.347c-2.746-1.287-5.283,0.211-7.605-0.679c-2.33-0.817-3.391-4.434-5.09-5.696   c-1.678-1.267-4.245-1.267-6.851-1.973c-2.614-0.734-4.355-3.939-4.994-5.221c-0.661-1.252-0.276-4.36,1.68-4.632   c1.991-0.312,4.03-0.657,11.255-4.191c7.206-3.536-0.876-5.755-0.457-10.826c0.424-5.091,7.197-4.69,9.935-7.654   c2.763-2.951-1.906-4.853-4.013-6.52c-2.099-1.71-5.498,0.412-6.762,2.737c-1.253,2.302-1.702,4.241-4.28,3.748   c-2.573-0.483-3.361-0.931-4.807-3.748c-1.479-2.795,1.005-2.977,6.542-6.762c5.548-3.811,2.118-3.811,1.906-5.309   c-0.204-1.455-2.534-0.847-5.289-1.887l-0.113-0.095c-2.534-1.124-1.121-3.967,0.54-4.972c1.686-1.068,3.592-1.272,5.302-0.229   c1.656,1.07,1.656,1.888,6.115,0.229c4.454-1.717,4.652-0.229,6.148,1.885c0.95,1.355,2.154,3.368,3.333,5.218   c0.689,1.084,1.33,2.037,1.939,2.805c1.686,2.13,5.928,0,9.523-2.081l0.091-0.076c3.479-2.134,2.256-5.474,2.449-8.408   c0.217-2.969-2.104-2.969-3.383-4.014c-1.259-1.044-1.477-4.856-2.947-6.986c-1.482-2.123-4.454-1.915-6.374-1.286   c-1.884,0.658-5.068,3.416-5.688,3.191c-0.636-0.219-0.438-3.386-1.917-4.439c-0.89-0.624-4.22-0.734-7.115-1.234   C45.34,17.892,61.845,10.821,80.011,10.821c19.083,0,36.382,7.745,48.923,20.275c2.802,2.802,5.352,5.886,7.625,9.146   c-6.919,2.228-19.136,6.47-20.061,7.687c-1.256,1.696-5.696,2.558-7.82,1.498c-2.104-1.036-3.597-2.31-5.719-2.106   c-2.104,0.201-2.983,0.414-4.443,2.106c-0.925,1.06-2.675,2.579-4.438,3.321c-1.052,0.475-2.102,0.756-2.969,0.266   c-0.267-0.134-0.518-0.128-0.771-0.198c-0.722-0.176-1.388-0.143-1.939,0.064c-0.928,0.32-1.556,0.888-1.556,0.888   c-2.143,3.026,0.46,6.875,2.171,6.668c1.669-0.226,3.79-3.609,4.862-3.609c1.05,0,3.424,1.93,3.829,2.646   c0.397,0.737-1.711,5.407-2.977,5.621c-1.267,0.198-5.933,1.677-7.013,1.677c-1.038,0-5.704-1.89-6.759-0.654   c-1.063,1.305-3.171,1.089-2.138,4.043c1.074,2.96,0,5.285-0.829,5.511c-0.843,0.203-7.839,2.125-0.843,2.325   c6.988,0.204,8.688-2.122,10.159-2.325c1.49-0.226,4.019-2.126,5.707-1.267c1.716,0.847,4.325-0.472,5.749-0.025   c1.471,0.433,4.6-3.529,6.085-2.073c1.504,1.447,1.066,4.409,0.686,5.49c-0.449,1.028-2.98,1.893-2.385,3.367   c0.658,1.476,1.937,3.381,3.848,4.871c1.89,1.479,3.162,3.358,4.429,1.884c1.259-1.463,1.259-3.373,1.917-4.244   c0.634-0.822,6.55,0.217,6.771,1.489c0.204,1.292,3.162,4.037,3.774,4.23c0.669,0.219,2.986,1.297,2.986,1.297   s0.669,0.749,1.711,2.992c1.047,2.292,3.157,2.292,4.639,1.872c1.485-0.442,2.677-3.602,4.663-3.376   c1.978,0.198,2.966-0.666,5.057,1.47c2.019,2.001,2.523,2.499,4.005,3.622C143.822,109.401,137.542,120.293,128.934,128.916z"/>
				</g>
				<g id="Layer_2">
				</g>
			</svg>

     <img src="http://localhost/Cor_ivss/logo.png" alt="" id="ivss">
    
    <div id="link">
    	<div id="caja_link">
    		<a href="http://localhost/Cor_ivss/">Ir al inicio</a>&nbsp&nbsp&nbsp<img src="http://localhost/Cor_ivss/exit.png" alt="">
    	</div>
    </div>
</body>
</html>
