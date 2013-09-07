<style>
/*!
 * Pelicano v1.1.1
 *
 * Copyright 2013 
 */

body#screenHome {
  padding-top: 125px;
}
body#screenSeries {
  padding-top: 105px;
}

body#screenMarketplace{
  padding-top: 80px;
  }
  
  body#screenDescargas{
  padding-top: 80px;
  }
  
  body#screenControl{
  padding-top: 80px;
  background-repeat:no-repeat;
  background-size:cover;  
  }
  
body#screenMarketplace #content{
  padding-bottom: 50px;
  }
  
  body#screenDescargas #content{
  padding-bottom: 50px;
  }

body{ background-color:darkgrey;}

#Menu{ margin-top: 10px; margin-left:10px; margin-right:10px; border-top: 5px solid #9d9d00;}
#MenuLogo{ margin-left:10px;}

#Menu .navbar-search{ margin-right:10px;}

#Menu #loginInfo{ width:100px; height:35px; padding-top:5px; background-color:#ebebeb;  background-image:url(img/userIcon.png); background-repeat:no-repeat; background-position:10px 12px; padding-left:35px; padding-right:10px; line-height:16px;color:#333; }

.points{ font-size:11px; color:#000; font-weight:bold;}

#filtroGenero{ margin-left:10px;}
#filtroEdad{ margin-right:10px;}

.navbarSecond{ top:55px; margin-right:10px; margin-left:10px;}
.btn-group{ margin-top:0px !important;}
.modal{ color:#333;}
#content{ margin-left:0px;}
.element{
	width:165px;
	height:250px;
	background-color:none !important;
	background:none !important;
	}
	.element *{
position:relative !important;
	}
	.peliIcon{ 
position:absolute !important;
}
.peliTitulo {  
	color:#333333 !important;
	background-color:#ccc;
	padding:5px;
	display:none;
  }

  
 #screenMarketplace .peliTitulo {  
    visibility:visible;
	color:#333333 !important;
	background-color:#ccc;
	padding:5px;
	color:black; margin-top:5px;

  }
   #screenMarketplace2 .peliTitulo {  
    visibility:visible;
	color:#333333 !important;
	background-color:#ccc;
	padding:5px;
	color:black; margin-top:5px;
  }
  


.peliPlay{
top:165px !important;
left:50px !important;
	font-size: 105px;
}
.peliDetail{
top:5px !important;
left:130px !important;
	font-size: 50px;
}

.peliAfiche{ width:165px; height:220px;
-moz-box-shadow: 0px 0px 15px #000;
-webkit-box-shadow: 0px 0px 15px #000;
box-shadow: 0px 0px 15px rgba(0,0,0,0.8);}

.peliAficheSmall{ width:130px; height:174px;
-moz-box-shadow: 0px 0px 15px #000;
-webkit-box-shadow: 0px 0px 15px #000;
box-shadow: 0px 0px 15px rgba(0,0,0,0.8);}

	.peliTitulo{ color:#ccc; margin-top:-5px;}
	.pagination{ margin:5px 0px;}

/*	.navbar-inner{ border:1px solid magenta !important; padding-left:10px !important;}
*/	.navbar a{ font-size:1.15em;}

.nav-tabs { margin-bottom:0px !important;}
#carousel-image-and-text {
	width: 97% !important;
	height: 260px;
	margin: 0 auto;	
	top: 0px;
	margin-bottom:20px;
}	

.sliderSubtitle{ color:white; font-size:19px;  margin-left:20px; padding:0px;; margin-right:20px; }
  @media only screen and (max-width: 767px) {  
   .mobile-two .span2 { width: 50% !important; float: left; padding: 0 15px; }

}
/* Large desktop */
@media (min-width: 1200px) {
	.element{
	width:165px;
	height:250px;
	background-color:none !important;
	background:none !important;
	}
/*	.navbar-inner{  border:1px solid orange !important;}
*/
.peliAfiche{ width:165px; height:220px;}

	}
 
/* Portrait tablet to landscape and desktop */
@media (min-width: 980px) and (max-width: 1199px) { 

/*.navbar-inner{  border:1px solid magenta !important;}
*/.element{
	width:180px;
	height:260px;
	background-color:none !important;
	background:none !important;
	}
.peliAfiche{ width:180px; height:240px;}

	}
 
/* Portrait tablet to landscape and desktop */
@media (min-width: 768px) and (max-width: 979px) { 

/*.navbar-inner{  border:1px solid red !important;}
*/

.element{
	width:165px;
	height:240px;
	background-color:none !important;
	background:none !important;
	}
.peliAfiche{ width:165px; height:220px;}

	}
/* Landscape phone to portrait tablet */
@media (max-width: 768px) { 
/*.navbar-inner{  border:1px solid blue!important;}
*/input.search-query{ width:185px;}
.peliAfiche{ width:170px; height:228px;}
.element{
	width:170px;
	height:248px;
	background-color:none !important;
	background:none !important;
	}
}
/* Landscape phone to portrait tablet */
@media (max-width: 767px) { 
.navbar-inner{  border:1px solid yellow !important;}
.container, .navbar-static-top .container, .navbar-fixed-top .container, .navbar-fixed-bottom .container{ width:100% !important;}


.element{
	width:170px; 
	height:248px;
	background-color:none !important;
	background:none !important;
	}
.peliAfiche{ width:170px; height:228px;}

	}
 
/* Landscape phones and down */
@media (max-width: 480px) { 
.element{
	width:120px; 
	height:230px;
	background-color:none !important;
	background:none !important;
	}
.peliAfiche{ width:165px; height:221px;}

	}
	
	@font-face {
font-family: 'EntypoRegular';
src: url('fonts/entypo-webfont.eot');
src: url('fonts/entypo-webfont.eot?#iefix') format('embedded-opentype'),
     url('fonts/entypo-webfont.woff') format('woff'),
     url('fonts/entypo-webfont.ttf') format('truetype'),
     url('fonts/entypo-webfont.svg#EntypoRegular') format('svg');
font-weight: normal;
font-style: normal;
}

.iconFontButton{
		font-family: 'EntypoRegular';
		margin:0;
		border:0;
		padding:0;
}
.iconClose{
		font-size:50px;
		0 -1px 0 rgba(0, 0, 0, 0.25)
}
.iconPlay{
		font-size:40px;
		line-height:10px;
		vertical-align:top;
}

.modalDetail{ width:85%;
margin-left:0px; left:7%;}
.modal-backdrop{ /*background-image:url(images/01back.jpg);*/}
/*.aficheDetail{ height:380px !important; width:282px !important;}*/
.aficheDetail{ height:100% !important; width:100% !important;}
.detailMainGroup{
	border-bottom:1px solid #ccc; color:#666;}
.detailMain { font-size:120%;  border-left:1px solid #ccc;#ccc; padding-top:3px;}
.detailMainFirst{ border-left:none;}

.detailSecondGroup{
	border-bottom:1px solid #ccc; color:#666;}
.detailSecond { font-size:100%; border-left:1px solid #ccc;#ccc; padding-top:4px; padding-left:5px;}
.detailSecondFirst{ border-left:none;}

.container,.navbar-static-top .container,.navbar-fixed-top .container,.navbar-fixed-bottom .container{ width:100% !important; max-width:100% !important; min-width:100% !important;}


/*-------- CONTROL REMOTO --------------*/

body#screenControl .container{ text-align:center;}

body#screenControl{ background-color:black; overflow:hidden; }


.controlContainer{ width:100%;
margin:auto;
}


.controlContainer .controlAfiche{ padding-top:10px; text-align:right;}


.controlTitle{font-size: 2em;
font-weight: normal;
color: #fff;
text-shadow: 0 1px 0 #666;
text-align:left;
padding-top:20px;
padding-bottom:10px;
margin-bottom:20px;
border-bottom:1px solid #ccc;}


.controlAudioSub{ text-align:left;}
.controlAudioSub button{ width:200px; height:60px; margin-top:10px; margin-bottom:20px; display:block;}

.controlFlechas{ width:165px; margin-bottom:20px;}

.flechasArriba{ margin-bottom:5px;}

.flechasCemtro .button{ margin-right:5px;}

.flechasAbajo{ margin-top:5px;}

.controlBackground{
	/*background-color:rgba(31,81,139,0.2);*/
	background-color:rgba(89,117,139,0.2);
	-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
box-shadow: inset 0 1px 0 rgba(255,255,255,0.2);
border-bottom: 1px solid rgba(255, 255, 255, 0.05);
	}

.controlNavegacion{padding:15px;}

.controlProgress{height: 60px;
padding-top: 40px;}
.controlLenght{height: 60px;
padding-top: 37px; padding-right:15px; font-size:1em;}

body#screenControl .controlContainer .btn-warning{ width:50px; height:50px;}
body#screenControl .controlContainer .controlNavegacion .btn-inverse{ width:70px; height:70px;}

.controlNumeros{ text-align:left; padding:20px 15px;}
.controlNumeros .btn{ width:50px; height:50px; font-size:2em; margin-right:5px;}

.controlConfig{ text-align:left; padding:20px 15px; text-align:right;}
.controlConfig .btn{ width:50px; height:50px; font-size:2em; margin-left:5px;}


body#screenControl .controlConfig .btn-inverse{ height:50px; width:50px; }

body#screenControl .btn-large{ padding:0px;}

/*-------- DESCARGAS --------------*/

.descDone{ display:inline-block; color:white;
font-size:0.8em; text-align:center;
font-weight:normal;
background-image:url(img/iconGreen.png);
background-repeat:no-repeat;
background-position:-1px;
margin-left:5px;padding:0px 10px;
line-height:10px;
line-height:17px;}
.descIP{display:inline-block; color:white;
font-size:0.8em; text-align:center;
font-weight:normal;
background-image:url(img/iconGrey.png);
background-repeat:no-repeat;
background-position:-1px;
margin-left:5px;
padding:0px 10px;
line-height:10px;
line-height:17px;}


.pelisFinalizadas{ padding:10px 40px; margin-bottom:20px;}
.peliFinalizada{ width:140px; text-align:center; display:inline-block; margin-bottom:10px;}
.peliFinalizadaBt{ padding:5px; text-align:center;}
.peliFinalizada button{margin:auto; }
.peliFinalizada img{margin:auto; }


.pelisDescargadas{ padding:10px 40px;}
.peliDescargando{ width:170px; text-align:center; display:inline-block; margin-bottom:10px;}
.peliDescargandoProgress{ padding:5px; text-align:center;}
.peliDescargando img{margin:auto; }

.progress{ margin-bottom:0px !important; height:15px;}
.progress .bar{ text-align:right; line-height:16px;}

/*-------- SLIDER --------------*/
h2.sliderTitle{ font-size:1.7em; font-weight:normal;  color:#666; text-shadow:0 1px 0 #ccc; line-height:25px; width:90%; margin:auto; margin-bottom:10px;}

h2.sliderTitle.modified{ margin-left:75px; width:120px; float:left; margin-bottom:0px; margin-top:2px;}

.marketTitle { width:88%; margin:auto;}
.marketTitle .nav { margin-bottom:10px;}
.marketTitle h2.sliderTitle{ float:left; width:120px; margin-bottom:0px; margin-top:2px;}

.nav-pills>.active>a, .nav-pills>.active>a:hover {
color: #ffffff;
background-color: #9d9d00;
}
.nav-pills a {
	color: #333;

}

.botonTodas{ float:right; margin-right:70px;}

#MenuSecond{ top:55px; margin-left: 10px; margin-right:10px; font-size:0.95em;}

.noMargin{ margin:0px !important;}
</style>