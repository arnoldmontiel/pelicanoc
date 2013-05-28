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
  padding-top: 60px;
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
	height:240px;
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
    visibility: hidden;  
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
	height:240px;
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
</style>