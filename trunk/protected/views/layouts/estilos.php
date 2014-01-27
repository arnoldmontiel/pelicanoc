<style>
/*!
 * Pelicano v1.1.1
 *
 * Copyright 2013 
 */

 @font-face {
font-family: 'GudeaRegular';
src: url('fonts/Gudea-Regular.otf');
font-weight: normal;
font-style: normal;
}
 @font-face {
font-family: 'GudeaItalic';
src: url('fonts/Gudea-Italic.otf');
font-weight: normal;
font-style: normal;
}
 @font-face {
font-family: 'GudeaBold';
src: url('fonts/Gudea-Bold.otf');
font-weight: normal;
font-style: normal;
}
 @font-face {
font-family: 'LatoRegular';
src: url('fonts/Lato-Reg.otf');
font-weight: normal;
font-style: normal;
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

a {
  outline: 0 none !important;
  color:#333 ;
}

a:hover {
  color:#666 ;
}

a:active {
  color:#666 ;
  background-color:none;
}
a:focus {
  color:#666 ;
  background-color:none;
}

a:hover, a:active, a:focus {
	  outline: 0 none !important;
}

i {
  outline: 0 none !important;
}
button {
  outline: 0 none !important;
}

.noMargin{ margin:0px !important;}

.align-left{ text-align:left;}
.align-center{ text-align:center;}
.align-right{ text-align:right;}

body{
	font-family: 'GudeaRegular', Arial, sans-serif; 
	font-size:15px;
	cursor:default;
	line-height:inherit;
	color:#333;
	
	background: rgb(198,198,198); /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover,  rgba(198,198,198,1) 0%, rgba(89,89,89,1) 100%); /* FF3.6+ */
background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,rgba(198,198,198,1)), color-stop(100%,rgba(89,89,89,1))); /* Chrome,Safari4+ */
background: -webkit-radial-gradient(center, ellipse cover,  rgba(198,198,198,1) 0%,rgba(89,89,89,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-radial-gradient(center, ellipse cover,  rgba(198,198,198,1) 0%,rgba(89,89,89,1) 100%); /* Opera 12+ */
background: -ms-radial-gradient(center, ellipse cover,  rgba(198,198,198,1) 0%,rgba(89,89,89,1) 100%); /* IE10+ */
background: radial-gradient(ellipse at center,  rgba(198,198,198,1) 0%,rgba(89,89,89,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c6c6c6', endColorstr='#595959',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
	
	 }
 

body #screenHome {
  padding-top: 125px;
}
body #screenSeries {
  padding-top: 70px;
}

body #screenMarketplace{
  padding-top: 70px;
  }
  
  body #screenDescargas{
  padding-top: 70px;
  }
  
    body #screenDevices{
  padding-top: 70px;
  }
  
body #screenControl{
  padding-top: 80px;
  }
  body #screenEditMovie{
  padding-top: 70px;
  }
  
body #screenMarketplace #content{
  padding-bottom: 40px;
  }
  
  body #screenDescargas #content{
  padding-bottom: 40px;
  }

  /* ----- NEW BUTTONS ------*/
  .btn-primary{
  color: #ffffff;
background-color: #26ada1;
border-color: #21988e;
}

  .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary {
color: #ffffff;
background-color: #027871;
border-color: #16665f;}

.btn-primary.disabled, .btn-primary[disabled], fieldset[disabled] .btn-primary, .btn-primary.disabled:hover, .btn-primary[disabled]:hover, fieldset[disabled] .btn-primary:hover, .btn-primary.disabled:focus, .btn-primary[disabled]:focus, fieldset[disabled] .btn-primary:focus, .btn-primary.disabled:active, .btn-primary[disabled]:active, fieldset[disabled] .btn-primary:active, .btn-primary.disabled.active, .btn-primary[disabled].active, fieldset[disabled] .btn-primary.active {
color:#eee;
background-color: #26ada1;
border-color: #21988e;
}
    .btn-default{
  color: #027871;
background-color: #D0E6DF;
border-color: #C8E6DB;
}
.btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open .dropdown-toggle.btn-default {
color: #fff;
background-color: #038C79;
border-color: #007064;
}
    .btn-danger{
  color: #d9534f;
background-color: #FFE4E3;
border-color: #FFDEDC;
}


.btn-default.disabled, .btn-default[disabled], fieldset[disabled] .btn-default, .btn-default.disabled:hover, .btn-default[disabled]:hover, fieldset[disabled] .btn-default:hover, .btn-default.disabled:focus, .btn-default[disabled]:focus, fieldset[disabled] .btn-default:focus, .btn-default.disabled:active, .btn-default[disabled]:active, fieldset[disabled] .btn-default:active, .btn-default.disabled.active, .btn-default[disabled].active, fieldset[disabled] .btn-default.active {
background-color:#ebebeb;
border-color: #ccc;
color:#888;
}


.scrollable-list{ max-height:320px; overflow-y:auto; overflow-x:hidden;}


.nav-pills{ font-size:17px;}

.nav-pills a{ color:white;}

.nav-pills>li.active>a, .nav-pills>li.active>a:hover, .nav-pills>li.active>a:focus {
color: #fff;
background-color: #26ada1;}

.nav>li>a:hover, .nav>li>a:focus {
text-decoration: none;
background-color: #eee;
color:#666;
}

/* hack to avoid backround from scrolling when modal open */
/**/
html.modal-open  {
}

body.modal-open {
    overflow: hidden;
    overflow-x: hidden;
    overflow-y: hidden;
    position:absolute;
}

/* end of hack */


/* ------ MAIN MENU / NAV BAR ------- */
.navbar{ min-height:45px;}

ul.nav{ margin-left:0px;}

#Menu{ margin-top: 10px; margin-left:10px; margin-right:10px; border-top: 5px solid #26ada1; height:55px;z-index:1060;}
#MenuLogo{
	margin-left: 0px;
font-family: 'LatoRegular', sans-serif;
font-size: 18px;
text-transform: uppercase;
letter-spacing: 1px;
padding: 0px 15px;
line-height:48px;
	}

#Menu .navbar-collapse{ padding-right:0px;}
#Menu .navbar-nav>li>a{padding: 2px 15px;line-height: 45px;}

#Menu #loginInfo{ width:135px;height: 50px;padding-top: 9px; background-color:#ebebeb;  background-image:url(img/userIcon.png); background-repeat:no-repeat; background-position:10px 16px; padding-left:35px; padding-right:10px; line-height:16px;color:#333; }
#Menu .points{ font-size:14px; color:#000; font-family: 'GudeaBold'; }

#Menu #newDisc{
width: 105px;
height: 50px;
padding-top: 9px;
background-color: #ebebeb;
background-image: url(img/discIcon.png);
background-repeat: no-repeat;
background-position: 10px 16px;
padding-left: 33px;
padding-right: 10px;
line-height: 15px;
color: #333;
border-right: 1px solid #ccc;
}
#Menu #externalStorage{
display:none;
width: 61px;
height: 35px;
padding-top: 5px;
background-color: #ebebeb;
background-image: url(img/usb_black.png);
background-size: 16px 16px;
background-repeat: no-repeat;
background-position: 10px 12px;
padding-left: 33px;
padding-right: 10px;
line-height: 15px;
color: #333;
border-right: 1px solid #ccc;
cursor: pointer;
}
#Menu #playlist{
width: 61px;
height: 35px;
padding-top: 5px;
background-color: #ebebeb;
background-repeat: no-repeat;
background-position: 10px 12px;
padding-left: 33px;
padding-right: 10px;
line-height: 15px;
color: #333;
border-right: 1px solid #ccc;
cursor: pointer;
}

#Menu .badgeDone{	background-color:#9d9d00; margin-left:10px;}

#popover-dispositivos{ display:block; top:45px; left:50%; text-align:center;}
.popover{width:300px; max-width:300px;}
.popoverDisTitle{font-size:20px;}
.popoverButtons{ border-top:1px dotted #ccc; margin-top:10px; padding-top:10px;}
.popoverButtons button{  width:110px; margin-right:10px;}

/* ------ SECOND MENU / NAV BAR ------- */

#menuSecond{ top:65px; margin-right:10px; margin-left:10px; height:50px;}
#menuSecond .navbar-collapse{ padding:0px;}
#menuSecond .navbar-nav>li>a{padding: 2px 15px;line-height: 45px;}
.navbar a{ font-size:1.15em;}

#filtroGeneroMob{ display:none;}

#menuSecond #search-query-filter { height:auto;}
	
/* ------ END MENU ------- */

/* ------ BTN INITIAL FONT SIZES ------- */
.btn{ font-size:15px;}
.btn-lg{ font-size:18px;}
/* ------ END BTN SIZES ------- */

/* ------ BODY / MAIN LAYOUT ------- */
#content {
	/* this line is needed fot center aligning isotope*/
   margin: 0 auto !important;
   margin-left:0px;
}

h2{font-size: 28px;
font-weight: normal;
color: #ccc;
text-shadow: 0 1px 3px #333;
font-family: 'GudeaRegular';
margin:0px;
line-height:auto;
padding-bottom:10px;
 }

 h2.sliderTitle{ 
font-size:28px; font-weight:normal;
color: #fff;
text-shadow: 0 1px 3px #333;
 line-height:34px; margin:auto; margin-bottom:10px; font-family:'GudeaRegular';
margin-left:30px; min-width:120px; display:inline-block; margin-right:10px; margin-bottom:0px; margin-top:2px;}
 
h1.pageTitle{font-size: 2em;
font-weight: normal;
color: #fff;
text-shadow: 0 1px 3px #333;
text-align:left;
margin:0px;
line-height:auto;}

h3{font-size: 24px;
font-weight: 100;
color: #ddd;
margin-bottom:10px; margin-top:10px;text-shadow: 0 1px 3px #000;
font-family:'GudeaRegular', Arial, sans-serif;
}

h3.tableTitle{ color: #666; text-shadow:none; background-color:#eee; padding:10px; margin-bottom:0px;}

h3.popover-title {
padding: 8px 14px;
margin: 0;
font-size: 20px;
font-weight: normal;
line-height: 20px;
background-color: #f7f7f7;
border-bottom: 1px solid #ebebeb;
border-radius: 5px 5px 0 0;
text-shadow:none;
color:#666;
}

.popover{width:300px; max-width:300px;}
.popoverButtons{ border-top:1px dotted #ccc; margin-top:10px; padding-top:10px;}
.popoverButtons button{  width:129px; margin-right:10px;}

.tableTitle span{ font-size:15px; margin-left:10px; line-height:25px;}

.pageTitleContainer{
padding-bottom:10px;
margin-bottom:10px;}

#wall{ text-align:center;}
.items{ margin: 0 auto !important;}
.container,.navbar-static-top .container,.navbar-fixed-top .container,.navbar-fixed-bottom .container{ width:100% !important; max-width:100% !important; min-width:100% !important;}

.element{
	width:180px;
	height:295px;
	background-color:none !important;
	background:none !important;
	position:relative;
	overflow:visible;
	border-top-right-radius:none !important;
	}
	.element *{
position:relative !important;
	}
	
	.knob{ position:absolute; top:50%; margin-top:-45px; left:50%; margin-left:-45px;}

	.ribbon {
  -webkit-transform: rotate(-45deg); 
     -moz-transform: rotate(-45deg); 
      -ms-transform: rotate(-45deg); 
       -o-transform: rotate(-45deg); 
          transform: rotate(-45deg); 
    border: 25px solid transparent;
    border-top: 25px solid #26ada1;
    position: absolute;
    bottom: 79px;
	right: -103px;
    padding: 0 10px;
    width: 120px;
    color: white;
    font-family: sans-serif;
    size: 11px;
}

.flex-viewport{padding-bottom:5px;}
.flexslider .ribbon{right:-42px; top:202px; width:150px; }	

.ribbon .ribbonTxt{
position:absolute;
top:-20px;
font-size:12px;
letter-spacing:1px;
}


.peliTitulo {  
	color:#fff !important;
	padding:5px;
	overflow:hidden; 
  }
  
  .peliAfiche{ width:180px; height:260px;
-moz-box-shadow: 0 1px 4px #333;
-webkit-box-shadow: 0 1px 4px #333;
box-shadow: 0 1px 4px #333;
}

.peliDesc img{opacity:0.5;}


/*afiche small usado en descargas*/
.peliAficheSmall{ width:130px; height:174px;
-moz-box-shadow: 0px 0px 15px #000;
-webkit-box-shadow: 0px 0px 15px #000;
box-shadow: 0px 0px 15px rgba(0,0,0,0.8);}

/* ------ BODY / MAIN LAYOUT ------- */

	
/* ------ MARKETPLACE ------- */
 #screenMarketplace .peliTitulo {  
	margin-top:0px;
  }
/* ------ END MARKETPLACE ------- */

  
/* ------ MODAL POPUPS SERIES / PELI DETAIL ------- */
.modal{z-index:1070;}
.modal-title{ font-size:1.6em; color:#666; }
.modal-header {padding: 9px 15px;}
.modal-header .close{padding: 0px; margin-top:0px; line-height:34px;}
.modal-footer {padding: 9px 15px;}
.modal-body{ /*overflow:hidden;*/  }
.modal-backdrop{z-index:1065;}

.ratingStars{ color:orange; display:inline-block;}
.ratingStars i{ margin-left:1px; font-size:16px;}

.nav-tabs { margin-bottom:0px !important ;margin-left:0px !important;}

.modalDetail{ width:85%;}

.modalDetail table button{ margin-top:-3px;}
.modalDetail .table tbody>tr>td{ padding:0px 8px; line-height:45px;}

.modalDetail .table thead>tr>th, .modalDetail .table tbody>tr>th, .modalDetail .table tfoot>tr>th, .modalDetail .table thead>tr>td, .modalDetail .table tfoot>tr>td{ padding:0px 8px; line-height:38px; font-family:'GudeaBold';}

.modalDetail .modal-body .row{ line-height:26px;}
.modalDetail .modal-body .row.detailSummary{ line-height:20px;}

.aficheDetail{ /*height:100% !important;*/ height:auto !important; width:100% !important;
-moz-box-shadow: 0px 0px 5px #000;
-webkit-box-shadow: 0px 0px 5px #000;
box-shadow: 0px 0px 5px rgba(0,0,0,0.8);
}

.detailMainGroup{
	border-bottom:1px solid #ccc; color:#666;}
.detailMain { font-size:120%;  border-left:1px solid #ccc;#ccc; padding-top:3px;height: 35px;
line-height: 30px;}
.detailMainFirst{ border-left:none;}

.detailSecondGroup{
	border-bottom:1px solid #ccc; color:#666;}
.detailSecond { font-size:100%; border-left:1px solid #ccc;#ccc; padding-top:4px; padding-left:5px;}
.detailSecondFirst{ border-left:none;}

.tableInfo{}

#tab1 {
max-height: 390px;
overflow-y: auto;
overflow-x: auto;
-webkit-overflow-scrolling: touch;}

#tab2 {
overflow-y: visible;
overflow-x: visible;}

.tableInfo .row{ margin-left:0px !important; margin-right:0px !important;}

.modalSubtitulo{padding:10px; padding-left:0px; font-size:18px;}

.topDotted{ border-top:1px dotted #ccc; margin-top:15px;}
/* ------ END MODAL DETAIL ------- */

/* ------ POPUP REPRODUCIENDO ------- */

.peliReroduciendo{ position:fixed; bottom:10px; left:10px; width:210px;  background-color:rgba(0,0,0,0.9); z-index:1030; padding:10px; text-align:center; border:1px dotted #333; color:white;}

.peliReroduciendo .rep{text-align:left;}

.peliReroduciendo .tituloRep{ font-size:1.6em; margin-bottom:10px; border-bottom:1px dotted #393939; padding-bottom:10px;}


/* ------ END POPUP REPRODUCIENDO ------- */


/*-------- CONTROL REMOTO --------------*/

#screenControl.container{ text-align:center;}

#screenControl{ background-position:center top;    background-size: cover; overflow:hidden;
}

.controlContainer{
margin:auto;
}

.controlContainer .controlAfiche{ padding-top:10px; text-align:center;}

.controlTitle{font-size: 2em;
font-weight: normal;
color: #fff;
text-shadow: 0 1px 3px #333;
text-align:left;
padding-top:20px;
padding-bottom:10px;
margin-bottom:20px;
border-bottom:1px solid #ccc;}

.controlAudioSub{ text-align:left;}
.controlAudioSub button{ width:200px; height:60px; 
margin-top: 35px;
margin-bottom: 30px; display:block;}

.controlFlechas{ width:235px; margin-bottom:20px; margin-right:}

.flechasArriba{ margin-bottom:5px;}

.flechasCemtro .button{ margin-right:5px;}

.flechasAbajo{ margin-top:5px;}

.controlBackground{
	background-color:rgba(89,117,139,0.2);
	-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
box-shadow: inset 0 1px 0 rgba(255,255,255,0.2);
border-bottom: 1px solid rgba(255, 255, 255, 0.05);
	}

.controlNavegacion{padding:15px 0px;}

.controlProgress{height: 60px;
padding-top: 40px;}

.progress-bar{ background-color:#1f8c82;}

.controlLenght{height: 60px;
padding-top: 37px; padding-right:15px; 
font-size: 1.3em;
font-weight: bold;}

#screenControl .controlContainer .btn-warning{ width:70px; height:70px;}
#screenControl .controlContainer .controlNavegacion .btn{ width:70px; height:70px;}

.controlNumeros{ text-align:left; padding:20px 0px;}
.controlNumeros .btn{ width:60px; height:60px; font-size:2em; margin-right:5px;}

.controlConfig{ text-align:left; padding:20px 15px; text-align:right;}
.controlConfig .btn{ width:60px; height:60px; font-size:2em; margin-left:5px;}


#screenControl .controlConfig .btn{ height:60px; width:60px; }

#screenControl .btn-lg{ padding:0px; }

.controlContainer .aficheImg {
width: 200px;
height: 280px;
}

/*-------- END CONTROL REMOTO --------------*/

/* ----- MARKETPLACE --------*/


#screenMarketplace .nav-pills { margin-bottom:10px; display:inline-block; height:20px;}


#screenMarketplace .flex-next:active{ background-color:transparent;}

.botonTodas{ float:right; margin-right:30px;}
.botonTodas .btn-lg{font-size:15px;}

/* ----- END MARKETPLACE --------*/

/* ----- DISPOSITIVOS --------*/
.tablaIndividual{ margin-bottom:20px; background-color:rgba(255,255,255,1); max-height:100px; overflow:auto;}

.devicesSelector{ padding-bottom:10px; margin-bottom:10px;}

#wizardDispositivos h3{ /*margin-top:10px;*/ margin-top:0px;}
.nav-pills.nav-stacked>li>a{border-radius:18px; color:white;}
.nav-pills.nav-stacked>li.active>a{background-color:#eee;color:#333;}
.nav-pills.nav-stacked>li>a:hover{ background-color:#428bca;color:white;}
.nav>li>a.ejectBTN{ width:35px; height:35px; padding:6px; position:absolute; top:3px; right:3px; color: #428bca;
background-color: #fff;}

.table.tablaIndividual { margin-bottom:30px;}
.tablaIndividual .tdPath{font-size:14px;}
.tablePeliTitle{ font-family:'GudeaBold';  font-size:18px;}
.tablaIndividual td button{ margin:5px; margin-left:0px; vertical-align:middle;}
.table.tablaIndividual th{ font-family:'GudeaBold';  font-size:16px; color:#555;}
.table.tablaIndividual thead>tr>th, .table.tablaIndividual tbody>tr>th, .table.tablaIndividual tfoot>tr>th, .table.tablaIndividual thead>tr>td, .table.tablaIndividual tbody>tr>td, .table.tablaIndividual tfoot>tr>td{vertical-align:middle; padding:5px;}

.deviceDropdownName{border:0px none !important; font-size: 24px;padding:5px; border:0px none; 
font-weight: 100;
color: #ddd;
margin:0px;
text-shadow: 0 1px 3px #000;
font-family: 'GudeaRegular', Arial, sans-serif;}
.deviceDropdown i{ margin-left:10px; margin-right:5px;}
.deviceDropdown:hover .deviceDropdownName{}


.deviceDropdownName:hover{background-color:#fff !important;border:0px none; color:#666; text-shadow:none;}
.deviceDropdownName:focus{background-color:#fff !important;border:0px none; color:#666 !important; text-shadow:none;}

#wizardDispositivos .nav-tabs .pull-right{margin-top:10px;}
#wizardDispositivos .nav-tabs>li>a{color:white;}
.nav-tabs>li>a{color:#999 ;}
.nav-tabs>li.active>a{color:#333 !important;}
.nav-tabs>li>a:hover{ color:#666 !important;}


#wizardDispositivos button{min-width:120px;}

.nav-tabs .dropdown-menu{ font-size:20px;}
/* ----- END DISPOSITIVOS --------*/


/*-------- DESCARGAS --------------*/

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

#screenDescargas .nav-pills { margin-bottom:10px; display:inline-block; height:20px;}

.noSliderResults{background-color:rgba(255,255,255,0.1); color:#fff; text-shadow:0 1px 1px #666; font-size:18px; width:97%; margin:auto;  height:268px; text-align:center; line-height:180px; text-transform:uppercase;margin-bottom: 30px; padding:4px;} 


/*-------- END DESCARGAS --------------*/


/*---------- FLEXSLIDER STYLE OVERRIDE -------*/

.flexslider{height:295px;width: 97%; margin: 0 auto; margin-bottom: 30px; background:none repeat scroll 0 0;background-color:rgba(255,255,255,0.1); border:none;padding: 4px;box-shadow:none;}
.flex-direction-nav a{opacity:1;}

.flexslider .slides > li{position:relative;}


.flexslider:hover .flex-next {right: -36px; }
.flexslider:hover .flex-prev {left: -36px; }

.flex-control-nav {margin-bottom:-10px;}

@media (max-width: 1024px) {
	.flex-control-paging li a {width: 15px; height: 15px; }
	.flexslider { margin-bottom:40px;}
}  


/*---------- END FLEXSLIDER STYLE OVERRIDE -------*/

/*---------- BOOKMARKS -------------*/
.tableInfoBookmark{
	max-height: 350px;
overflow-y: scroll;}

.controlBookmark{ text-align:right;width:30%;float:right;display: inline-block;}
.controlBookmark button{ width:100px; height:60px; margin-top:10px; margin-bottom:20px; display:block;}

.tableInfoBookmark{
	max-height: 350px;
overflow-y: scroll;}

/*---------- END BOOKMARKS -------------*/

/*---------- EDIT PELICULA -------------*/

.editAfiche { text-align:center;}
.editAfiche .aficheImg{width: 200px;
height: 280px; margin-bottom:10px;
}
.editImagesButtons{ text-align:center;}
.editImagesButtons .btn{margin:auto; margin-bottom:10px; 
display: block;
width: 199px;}

.buttonGroup{ margin-top:10px; text-align:right; }
.buttonGroup button{ margin-right:10px;}
#myModalCambiarAfiche .modal-dialog{ width:80%;}

#myModalCambiarAfiche ul.thumbnails.image_picker_selector li{width: 165px; height:240px;
cursor:pointer;}

#myModalCambiarBackdrop ul.thumbnails.image_picker_selector li {width:240px; height:155px;cursor:pointer;}
#myModalCambiarBackdrop .modal-dialog{ width:80%;}

.modal-scroll{ max-height:430px; overflow-y:auto;}
.backdrop-on{ 	

background: no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

ul.thumbnails.image_picker_selector{overflow:hidden;}

#fieldDuracion{ width:78%; display:inline-block;}
.form-group { color:white;}
.form-group input{font-size:16px; }
.form-group textarea{font-size:16px; }
.form-group label{font-size:17px; color:white; text-align:right;}
.modal .form-group label{font-size:17px; color:#333; text-align:right;}

.form-group select, .form-group ul.select2-choices{
display: block;
width: 100%;
height: 34px;
padding: 6px 12px;
font-size: 16px;
line-height: 1.428571429;
color: #555;
vertical-align: middle;
background-color: #fff;
background-image: none;
border: 1px solid #ccc;
border-radius: 4px;
-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
-webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
.form-group ul.select2-choices{padding:2px;}
.select2-container-multi .select2-choices .select2-search-choice{
line-height:20px;}

.select2-search-choice-close{top:6px; width:13px}

.superContainer{-moz-box-shadow: 0px 0px 2px #000;
-webkit-box-shadow: 0px 0px 2px #000;
box-shadow: 0px 0px 2px rgba(0,0,0,0.8); background-color:rgba(0,0,0,0.5); padding-top:20px; padding-bottom:20px;}


/*---------- END EDIT PELICULA -------------*/

/*---------- TEXTO MARQUESINA -------------*/
p.slide-text26 {
position:relative;
animation:mymove26 2s infinite;
-webkit-animation:mymove26 2s infinite; /*Safari and Chrome*/
width: auto;
white-space:nowrap;
}

p.slide-text30 {
position:relative;
animation:mymove30 5s infinite;
-webkit-animation:mymove30 5s infinite; /*Safari and Chrome*/
width: auto;
white-space:nowrap;
}

p.slide-text35 {
position:relative;
animation:mymove35 5s infinite;
-webkit-animation:mymove35 5s infinite; /*Safari and Chrome*/
width: auto;
white-space:nowrap;
}

p.slide-text40 {
position:relative;
animation:mymove40 5s infinite;
-webkit-animation:mymove40 5s infinite; /*Safari and Chrome*/
width: auto;
white-space:nowrap;
}

p.slide-text41 {
position:relative;
animation:mymove41 5s infinite;
-webkit-animation:mymove41 5s infinite; /*Safari and Chrome*/
width: auto;
white-space:nowrap;
}

@keyframes mymove26
{
from {right:0px;}
to {right:18px;}
}

@-webkit-keyframes mymove26 /*Safari and Chrome*/
{
from {right:0px;}
to {right:18px;}
}

@keyframes mymove30
{
from {right:0px;}
to {right:70px;}
}

@-webkit-keyframes mymove30 /*Safari and Chrome*/
{
from {right:0px;}
to {right:70px;}
}

@keyframes mymove35
{
from {right:0px;}
to {right:80px;}
}

@-webkit-keyframes mymove35 /*Safari and Chrome*/
{
from {right:0px;}
to {right:80px;}
}

@keyframes mymove40
{
from {right:0px;}
to {right:100px;}
}

@-webkit-keyframes mymove40 /*Safari and Chrome*/
{
from {right:0px;}
to {right:100px;}
}

@keyframes mymove41
{
from {right:0px;}
to {right:150px;}
}

@-webkit-keyframes mymove41 /*Safari and Chrome*/
{
from {right:0px;}
to {right:150px;}
}
/*-------------- END TEXTO MARQUESINA -------------- */

/*-------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------*/
/*------------------------   Estilos RESPONSIVE    ----------------------------*/
/*----------------------------------------------------------------------------*/
/*---------------------------------------------------------------------------*/


/* Large desktop */
@media (min-width: 1024px) {
	.element{
	width:180px;
	height:295px;
	background-color:none !important;
	background:none !important;
	}
	.peliAfiche{ width:180px; height:260px;}
	
	.controlContainer{
		/*width:70%;*/
	}
}
/*IPAD LANDSCAPE*/
@media (min-width: 768px) and (max-width: 1024px) {
	.controlContainer{
		width:100%;
	}
	
	.element{
	width:180px;
	height:295px;
	background-color:none !important;
	background:none !important;
	}
	
	.peliAfiche{ width:180px; height:260px;}
	
	
	.ribbon{
	right: -103px;
	bottom: 84px;}

}

/*IPAD PORTRAIT*/
@media (max-width: 768px) { 
	.navbar .nav>li>a{
		padding:10px 10px 10px;
	}
		
	.element{
	width:220px;
	height:355px;
	background-color:none !important;
	background:none !important;
	}
	
	.peliAfiche{ width:220px; height:320px;}
	
	.ribbon{
	right: -143px;
	bottom: 83px;}

	.controlContainer{
		width:100%;
	}
	
	.controlContainer .span6{
		width:100%;
	}
	.controlNavegacion{
		width:680px;
		margin:auto;
	}
	.controlContainer .controlNavegacion .btn {
	width: 70px;
	height: 70px;
	}
	.controlProgress{
	width: 90%;
	margin: auto;
	}
	
	.controlNumeros .btn{
		margin-right: 25px;
		margin-bottom: 15px;
	}
	
	#filtroGenero li.menuItem{ display:none;}
	#filtroGenero li.dropdown{ display:inline-block;}
	#filtroEdad li.menuItem{ display:none;}
	#filtroEdad li.dropdown{ display:inline-block;}
	
	#tab1{ max-height:650px;}
	.modalDetail{width:95%;}
}


  @media only screen and (max-width: 767px) {  
  /*esto arma el menu mobile*/
  /* .mobile-two .span2 { width: 50% !important; float: left; padding: 0 15px; }*/

}

</style>