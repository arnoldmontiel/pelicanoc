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

.bold{font-family:'GudeaBold';}

a {
	outline: 0 none !important;
	color: #333;
}

a:hover {
	color: #666;
}

a:active {
	color: #666;
	background-color: none;
}

a:focus {
	color: #666;
	background-color: none;
}

a:hover,a:active,a:focus {
	outline: 0 none !important;
}

i {
	outline: 0 none !important;
}

button {
	outline: 0 none !important;
}

.noMargin {
	margin: 0px !important;
}

.align-left {
	text-align: left !important;
}

.align-center {
	text-align: center;
}

.align-right {
	text-align: right;
}

.fa-lg{width:1.3em;}

.red{color:#d9534f;}
.modal-footer .btn.pull-right+.btn.pull-right{
margin-right: 5px;
margin-bottom: 0;
}

html {
padding:0px; margin:0px; height:100% !important;
}

body {
	font-family: 'GudeaRegular', Arial, sans-serif;
	font-size: 15px;
	cursor: default;
	line-height: inherit;
	padding:0px;
	 height:100%;
		}


 .container{height:100%; overflow:hidden;}
 
 .container.noWrapper{height:auto;   overflow-x: hidden !important;overflow:auto;}
 
 .wrapper{
   overflow-x: hidden !important;
  overflow-y: auto;
  -webkit-overflow-scrolling:touch;
  margin-left:-15px;
  margin-right:-15px;
  height:100%;  
  }

        
 body #content {
 height:100%;
position:fixed;
top:0px; left:0px; right:0px; bottom:0px;

}

#itemsContainer{margin-left:30px;}
#itemsContainer.centrado{margin:auto; }
#itemsContainer > * {
    -webkit-transform: translateZ(0px);
}

body.modal-open  {
overflow:hidden;}

 .modal-backdrop{
 overflow: scroll; 
  -webkit-overflow-scrolling:touch;
  }
 

body #screenHome {
padding-bottom:20px;
}
#screenHome .wrapper{
padding-top:130px;
}

body #screenSeries {
padding-top:130px;
padding-bottom:20px;
}

body #screenMarketplace {
}
#screenMarketplace .wrapper{
padding-top:130px;
}

body #screenDescargas {
padding-bottom:0px;
}
#screenDescargas .wrapper{
padding-top:80px;
}

body #screenDevices {
padding-top:80px;
padding-bottom:20px;
}


body #screenEscaneo {
padding-bottom:20px;
}
#screenEscaneo .wrapper{
padding-top:80px;
}

body #screenControl {
	padding-top: 80px;
}

body #screenEditMovie .wrapper{
padding-bottom:20px;
padding-top:80px;
}

body #screenEditMovie .wrapper .row{
margin-left:0px !important;
margin-right:0px !important;
}

body #screenConfig .wrapper{
background-color:#26ada1;
padding-bottom:100px;
padding-top:80px;
}

body #screenInit .wrapper{
background-color:#26ada1;
padding-bottom:100px;
padding-top:80px;
text-align:center;
}

/* -------- CONFIG / INIT --------- */

.configForm{ margin:auto;}

.configForm .inlineForm{ padding:5px; padding-bottom:20px; margin:5px 0px; margin-bottom:10px; border-bottom: 1px solid rgba(255,255,255,0.1);}
.configForm .inlineForm .form-group{margin-bottom:5px;}
.configForm .inlineForm .table{margin-bottom:0px; }
.configForm .inlineForm .table td{border: 0px none; }

.configForm .inlineFormLabel{ text-transform:uppercase; color:#056B67;
font-family: "GudeaRegular"; font-size:12px; padding:6px; display:block; padding-left:15px; position:relative;}

.configForm .inlineFormLabel:before{ content: '\2022'; position:absolute; left:5px;}

.configForm .form-group label{color:white; font-size:14px;}

.noShadow{
 -webkit-box-shadow: none; 
box-shadow: none; 
}

.initText{color:white; font-size:24px; margin-top:30px; text-align:center;}
.initId{ font-size:35px;}

#screenInit .btn{ width:400px; text-align:center;}

.formDeviceId{height:45px; font-size:25px; width:500px; text-align:center; margin:auto;}

#screenConfig .buttonGroup .btn:first-child{margin-right:0px !important;}

/* ----- LOGIN ------*/
.loginBody{background:transparent; background-color:#26ada1;}
.loginPanel{
background-color: #f8f8f8;
border: 1px solid #d9d9d9;
-moz-box-shadow: 0 0 16px -4px rgba(0, 0, 0, 0.5);
-webkit-box-shadow: 0 0 16px -4px rgba(0, 0, 0, 0.5);
box-shadow: 0 0 16px -4px rgba(0, 0, 0, 0.5);
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
vertical-align:middle;
text-align:center;
padding:20px;
display:inline-block;
margin:auto;
}
.loginBrand{font-family: 'LatoRegular', sans-serif;
font-size: 28px;
text-transform: uppercase;
letter-spacing: 1px;
line-height: 48px;
 text-align:center;
color:#fff;
margin-bottom:15px;
}

.loginWrapper{ margin-bottom:200px; margin:auto;
margin-top:100px; text-align:center;
}
.loginBody .inputLogin {
margin: 5px;
padding: 0 10px;
width: 300px;
height: 34px;
color: #404040;
background: white;
border: 1px solid;
border-color: #c4c4c4 #d1d1d1 #d4d4d4;
border-radius: 2px;
outline: 5px solid #eff4f7;
-moz-outline-radius: 3px;
-webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.12);
}
.loginForm{display:inline-block; margin:auto;}

.loginForm .rememberMe{color:#999; line-height:18px;}

.loginForm .rememberMe label{margin:0px; vertical-align:middle;}
.loginForm .rememberMe input{margin:0px; vertical-align:middle;}

.loginForm .btn{margin-top:20px;}

.separatorLine{border-top:1px dotted #ddd;}

.loginFooter{color:white; text-align:center; margin-top:40px;}

.loginBody div.error{color:black;}

.inicioPanel{font-size:20px; color:#999; padding:50px;}

/* ----- END LOGIN ------*/

/* ----- NEW BUTTONS ------*/
.btn{border-radius:2px;}
.btn-primary {
	color: #ffffff;
	background-color: #26ada1;
	border-color: #26ada1;
}
.btn-default {
	color:#15747C;
	background-color: #D0E6DF;
	border-color: #D0E6DF;
}
.btn-default .badge {
	color: #027871;
	background-color:white;
}
.btn-alternate{
	color:white;
	background-color:#206977;
	border-color:#206977;
}
.btn-danger {
	color: #d9534f;
	background-color: #FFD5D3;
	border-color: #FFD5D3;
}
.btn-reproduciendo{	margin-right: 5px;}
.btn-reproduciendo .badge{background-color:white;}
.btn-reproduciendo.reproduciendoOff{
/*en themes*/
}
.btn-reproduciendo.reproduciendoOn{
	color:#fff;
	background-color:#3DB3B3;
	border-color:#3DB3B3;
}
/*define hover for non touch devices.//needs fastclick!*/
.no-touch .btn-primary:hover{
	color: #ffffff;
	background-color: #027871;
	border-color: #027871;
}
.open .dropdown-toggle.btn-primary{
	color: #fff;
	background-color: #027871;
	border-color: #027871;
	}
.open .dropdown-toggle.btn-primary:focus{
	color: #fff;
	background-color: #027871;
	border-color: #027871;
}
.no-touch .btn-primary:focus{
	background-color: #26ada1;
	border-color: #26ada1;
}
.no-touch .btn-primary:active{
	background-color: #26ada1;
	border-color: #26ada1;
}
.no-touch .btn-default:hover{
	color: #fff;
	background-color:#3D88CE;
	border-color:#3D88CE;
}
.no-touch .btn-default:focus {
	background-color: #D0E6DF;
	border-color: #D0E6DF;
}
.no-touch .btn-default:active {
	background-color: #D0E6DF;
	border-color: #D0E6DF;
}
.no-touch .btn-alternate:hover{
	color: #fff;
	background-color:#225464;
	border-color:#225464;
}
.no-touch .btn-alternate:focus{
	background-color:#206977;
	border-color:#206977;
}
.no-touch .btn-alternate:active{
	background-color:#206977;
	border-color:#206977;
}
.no-touch .btn-reproduciendo.reproduciendoOff:hover{
	color: #fff;
	background-color:#3D88CE;
	border-color:#3D88CE;
}
.no-touch .btn-reproduciendo.reproduciendoOff:focus {
	color:#fff;
	background-color: #D2D4D6;
	border-color: #eee;
}
.no-touch .btn-reproduciendo.reproduciendoOff:active {
	color:#fff;
	background-color: #D2D4D6;
	border-color: #eee;
}
.no-touch .btn-reproduciendo.reproduciendoOn:hover{
	color:#fff;
	background-color: #1B8A8A;
	border-color: #1B8A8A;
}
.no-touch .btn-reproduciendo.reproduciendoOn:focus{
	color:#fff;
	background-color:#3DB3B3;
	border-color:#3DB3B3;
}
.no-touch .btn-reproduciendo.reproduciendoOn:active{
	color:#fff;
	background-color:#3DB3B3;
	border-color:#3DB3B3;
}

/*only affect touch devices. active replaces hover. hover replaces bootstrap default styles..//needs fastclick!*/
.btn-primary:hover{
	color: #ffffff;
	background-color: #26ada1;
	border-color: #26ada1;
}
.btn-primary:active{
	color: #ffffff;
	background-color: #027871;
	border-color: #027871;
}
.btn-default:hover {
	color:#15747C;
	background-color: #D0E6DF;
	border-color: #D0E6DF;
}
.btn-default:active{
	color: #fff;
	background-color:#15747C;
	border-color:#15747C;
}
.btn-alternate:hover{
	color:white;
	background-color:#206977;
	border-color:#206977;
}
.btn-alternate:active{
	color: #fff;
	background-color:#225464;
	border-color:#225464;
}
.btn-reproduciendo.reproduciendoOff:hover {
	color:#fff;
	background-color: #D2D4D6;
	border-color: #eee;
}
.btn-reproduciendo.reproduciendoOff:active{
	color: #fff;
	background-color:#3D88CE;
	border-color:#3D88CE;
}
.btn-reproduciendo.reproduciendoOn:hover{
	color:#fff;
	background-color:#3DB3B3;
	border-color:#3DB3B3;
}
.btn-reproduciendo.reproduciendoOn:active{
	color:#fff;
	background-color: #1B8A8A;
	border-color: #1B8A8A;
}

.btn-primary.disabled,.btn-primary[disabled],fieldset[disabled] .btn-primary,.btn-primary.disabled:hover,.btn-primary[disabled]:hover,fieldset[disabled] .btn-primary:hover,.btn-primary.disabled:focus,.btn-primary[disabled]:focus,fieldset[disabled] .btn-primary:focus,.btn-primary.disabled:active,.btn-primary[disabled]:active,fieldset[disabled] .btn-primary:active,.btn-primary.disabled.active,.btn-primary[disabled].active,fieldset[disabled] .btn-primary.active{
	color: #eee;
	background-color: #26ada1;
	border-color: #26ada1;
}
.btn-default.disabled,.btn-default[disabled],fieldset[disabled] .btn-default,.btn-default.disabled:hover,.btn-default[disabled]:hover,fieldset[disabled] .btn-default:hover,.btn-default.disabled:focus,.btn-default[disabled]:focus,fieldset[disabled] .btn-default:focus,.btn-default.disabled:active,.btn-default[disabled]:active,fieldset[disabled] .btn-default:active,.btn-default.disabled.active,.btn-default[disabled].active,fieldset[disabled] .btn-default.active{
	background-color: #ebebeb;
	border-color: #ccc;
	color: #888;
}

.alert-info{
background-color:#D0E6DF;
border-color:#D0E6DF;
color:#027871;
}

.label-success{
background-color:#92CD00;
border-color:#92CD00;
color:white;
}

.label-primary{
background-color:#26ada1;
border-color:#26ada1;
color:white;
}

.scrollable-list {
	max-height: 320px;
	overflow-y: auto;
	overflow-x: hidden;
}
.list-group-item{border-color:#eee;}
.nav-pills {
	font-size: 17px;
}

.nav-pills a {
	color: white;
}

.nav-pills>li.active>a,.nav-pills>li.active>a:hover,.nav-pills>li.active>a:focus
	{
	color: #fff;
	background-color: #26ada1;
}

.nav>li>a:hover,.nav>li>a:focus {
	text-decoration: none;
	background-color: #eee;
	color: #666;
}

/* ------ MAIN MENU / NAV BAR ------- */
.cbp-spmenu {
	z-index: 1999;
}

.navbar {
	min-height: 45px;
}

.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-nav>.active>a:focus{background-color:#eee;}

ul.nav {
	margin-left: 0px;
}

#Menu {
	margin-top: 10px;
	margin-left: 20px;
	margin-right: 20px;
	border-top: 5px solid #26ada1;
	height: 55px;
	z-index: 1060;
	
}

.smallMenuIcon{margin-bottom:2px;}


#pushMain .mobileMenuItem.active{background-color:#e7e7e7;}

#Menu .container-fluid{padding:0px; }

#MenuLogo {
	margin-left: 0px;
	font-family: 'LatoRegular', sans-serif;
	font-size: 18px;
	text-transform: uppercase;
	letter-spacing: 1px;
	padding: 0px 10px;
	line-height: 48px;
	
}

#MenuLogoMobile {
	margin-left: 0px;
	width: 50px;
	line-height: 48px;
	background-image:url('img/logoMobile.png');
	background-repeat:no-repeat;
	background-position:7px center;
}

#Menu .navbar-collapse {
	padding-right: 0px;
}

#Menu .navbar-nav>li>a {
	padding: 2px 15px;
	line-height: 46px;
}

.navbar-nav.navbar-right:last-child {
	margin-right: 0px;
}

#Menu #loginInfo {
	width: 135px;
	height: 50px;
	padding-top: 9px; /*background-color:#ebebeb;*/
	background-image: url(img/userIcon.png);
	background-repeat: no-repeat;
	background-position: 10px 16px;
	padding-left: 35px;
	padding-right: 10px;
	line-height: 16px;
	color: #333;
	color: white;
}

#Menu .points {
	font-size: 14px;
	color: #000;
	font-family: 'GudeaBold';
}

#Menu #newDisc {
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
}

#Menu #externalStorage {
	display: none;
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

.menuTheme{ border-top:3px solid #ccc !important;}
.menuThemeOption { position:relative; padding-left:35px !important;color:#999 !important; background-color:#eee;}
.menuThemeOption:before {
position: absolute;
font-family: FontAwesome;
top: 0;
left: 10px;
top: 50%;
margin-top: -8px;
margin-right: 3px;
content: '\f10c';
color:#999;
}
.menuThemeOptionActive {color:#333 !important;}
.menuThemeOptionActive:before {content: '\f192'; color:#333 !important;}

#Menu #playlist {
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

#Menu .badgeDone {
	background-color: #9d9d00;
	margin-left: 10px;
}

#popover-dispositivos {
	display: block;
	top: 45px;
	left: 50%;
	text-align: center;
}

.popover {
	width: 300px;
	max-width: 300px;
}

.popoverDisTitle {
	font-size: 20px;
}

.popoverButtons {
	border-top: 1px dotted #ccc;
	margin-top: 10px;
	padding-top: 10px;
}

.popoverButtons button {
	width: 110px;
	margin-right: 10px;
}

.reproTableContainer {
	min-width: 400px;
	padding: 5px;
	padding-top: 0px;
}

.reproTableContainer .table {
	margin-bottom: 0px;
}

.reproTableContainer .table td {
	vertical-align: middle;
}

.reproTableContainer .label{font-size:13px;
margin-bottom: 2px;
display: inline-block;}

.reproTableContainer i{color:#666;}
.reproTableContainer button i{color:white;}


.dropdownUsuario .dropdown-menu{ padding:5px 0px;}

.insideUsername{margin-bottom: 5px; margin-top:5px;
border-bottom: 1px #eee solid;
padding: 12px 7px;
padding-top: 3px;
color: #999;}

.dropdownUsuario .dropdown-menu>li>a{ padding:10px;}

.repUser{ position:absolute; right:0px;}

#Menu .navbar-nav>li.dropdownUsuario>a{padding:2px 10px;}

.btnAlarm{margin-right:5px;}

.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th{color:#999; font-family:"GudeaRegular"; font-weight:600;}
.table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{color:#999; font-family:"GudeaRegular";}

/* ------ SECOND MENU / NAV BAR ------- */

.secondNavFixedTop{top:80px; width:100%; position:Absolute; z-index:1099;}
.secondNavFixedTop h2{height:48px;}
.secondNavFixedTop #filtroGenero{margin-top:0px;}
.secondNavFixedTop .btn{margin:0px; margin-top:-2px; margin-left:20px;}
.secondNavFixedTop #toggleMarketplace{margin-top:2px; margin-left:0px;}


.changeType {margin-right:30px;}

.searchMain.marketplace{
}

.searchMain input{
	width: 250px;
}

.searchMain input::-webkit-input-placeholder::before {
	font-family: FontAwesome;
	content: '\f002';
}

.searchMain input::-moz-placeholder::before {
	font-family: FontAwesome;
	content: '\f002';
} /* firefox 19+ */
.searchMain input:-ms-input-placeholder::before {
	font-family: FontAwesome;
	content: '\f002';
} /* ie */
.searchMain input:-moz-placeholder::before {
	font-family: FontAwesome;
	content: '\f002';
}


#menuSecond {
	top: 65px;
	margin-right: 20px;
	margin-left: 20px;
	height: 50px;
	font-size: 0.6em;
	border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px; background-color:#e7e7e7;
}

#Menu .container-fluid{padding-right:10px; padding-left}
#menuSecond .navbar-collapse {
	padding: 0px;
}

#menuSecond .navbar-nav>li>a {
	padding: 2px 15px;
	line-height: 45px;
}

.navbar a {
	font-size: 1.15em;
}

#menuSecond .nav-pills {
	font-size: 15px;
	line-height: 15px;
}

#menuSecond .nav-pills a {
	color: #777;
}

#menuSecond .nav-pills li.active a {
	color: #fff;
}

.form-search {
	border: 1px solid #eee;
}

#filtroGenero {
	margin-top: 7px;
}

#menuSecond #search-query-filter {
	height: auto;
}


.dropdownAlert {color:#666; width:450px; padding:10px;}
.dropdownAlert ul{ margin:15px 0px;}
.dropdownAlert ul li{ border-color:white !important;}

#menuSecond .navbar-form.navbar-right{padding-right:0px;}

.marketAlternateBtn{margin-right:5px;}

/* ------ END MENU ------- */

/* ------ MOBILE MENU ------- */

.cbp-spmenu .pushMenuSuperGroup{height:100%; padding-bottom:108px;overflow:auto; -webkit-overflow-scrolling:touch;}
.cbp-spmenu .pushMenuGroup{padding-top:10px;}
.cbp-spmenu .pushMenuGroup .pushMenuGroupTitle{
padding-left:15px;
padding-bottom:0px;
font-size: 16px;
font-weight: 700;
color: #bbb;
text-transform: uppercase;
letter-spacing: 2px;}

.cbp-spmenu {
	border-top: 6px solid #26ada1;
}

.cbp-spmenu a:hover {
	background-color:inherit;
	text-decoration: none;
}



.cbp-spmenu .cbp-title {
	font-size: 25px;
	padding: 10px;
	white-space:nowrap;
	padding-right:40px;
}

.cbp-spmenu-left, .cbp-spmenu-push-toleft{left:-100%;}
.cbp-spmenu-right, .cbp-spmenu-push-toright{right:-100%;}

a.close-menu {
	position: absolute;
	height: 40px;
	width: 40px;
	line-height: 40px;
	text-align: center;
	top: 5px;
	right: 5px;
	padding: 0px;
	display: inline-block;
	text-decoration: none;
	border: none;
	vertical-align: middle;
	font-size: 25px;
	cursor: pointer;
	color: rgba(38, 173, 161, 1);
}

a.close-menu:hover {
	background-color: transparent;
	color: rgba(38, 173, 161, 0.5);
}

a.list-group-item {
	font-size: initial;
}

.cbp-spmenu{width:auto; min-width:250px;}
.cbp-spmenu-open{width:auto; min-width:250px;}

.pushSelectable .pushMenuGroup a{position:relative;}
.pushSelectable .pushMenuGroup a:before {
position: absolute;
font-family: FontAwesome;
top: 0;
right: 10px;
top: 50%;
margin-top: -8px;
margin-right: 3px;
content: '\f096';
}


.pushSelectable .pushMenuGroup .pushMenuActive{position:relative;}

.pushSelectable .pushMenuGroup .pushMenuActive:before {
        position:absolute;
		font-family: FontAwesome;
        top:0;
        right:9px;
        top:50%;
        margin-top:-8px;
content: '\f046';
    }
   

.pushSelectable .pushMenuGroup .pushMenuRadio:before {
content: '\f10c';
}
.pushSelectable .pushMenuGroup .pushMenuRadio.pushMenuActive:before {
content: '\f192';
right: 10px;
}
 
 .pushMenuGroupTitle button{margin-bottom:10px;}
   
.sideMenuBotones{ position:absolute; bottom:0px; z-index:1090; padding: 10px 0px; width:100%; text-align:center;}
.btnLimpiar{margin-right:10px;}

/* ------ END MOBILE MENU ------- */

/* ------ BTN INITIAL FONT SIZES ------- */
.btn {
	font-size: 15px;
}

.btn-lg {
	font-size: 18px;
}
/* ------ END BTN SIZES ------- */

/* ------ BODY / MAIN LAYOUT ------- */

h2 {
	font-size: 28px;
	font-weight: normal;
	color: #ccc;
	text-shadow: 0 1px 3px #333;
	font-family: 'GudeaRegular';
	margin: 0px;
	line-height: auto;
	padding-bottom: 10px;
	
	text-shadow:none;
}

h2.sliderTitle {
	font-size: 28px;
	font-weight: normal;
	color: #fff;
	text-shadow: 0 1px 3px #333;
	line-height: 34px;
	margin: auto;
	margin-bottom: 10px;
	font-family: 'GudeaRegular';
	margin-left: 30px;
	min-width: 120px;
	display: inline-block;
	margin-right: 10px;
	margin-bottom: 0px;
	margin-top: 2px;
	
	text-shadow:none;
}

h2.pageSubtitle {
	padding-left:10px;

}
h1.pageTitle {
	font-size: 2em;
	font-weight: normal;
	color: #26ada1;
	text-align: left;
	margin: 0px;
	line-height: auto;
	padding-left:10px;
}

h3 {
	font-size: 24px;
	font-weight: 100;
	color: #ddd;
	margin-bottom: 10px;
	margin-top: 10px;
	text-shadow: 0 1px 3px #000;
	font-family: 'GudeaRegular', Arial, sans-serif;
}

h3.tableTitle {
	color: #666;
	text-shadow: none;
	background-color: #eee;
	padding: 10px;
	margin-bottom: 0px;
}

h3.popover-title {
	padding: 8px 14px;
	margin: 0;
	font-size: 20px;
	font-weight: normal;
	line-height: 20px;
	background-color: #f7f7f7;
	border-bottom: 1px solid #ebebeb;
	border-radius: 5px 5px 0 0;
	text-shadow: none;
	color: #666;
}

.popover {
	width: 300px;
	max-width: 300px;
}

.popoverButtons {
	border-top: 1px dotted #ccc;
	margin-top: 10px;
	padding-top: 10px;
}

.popoverButtons button {
	width: 129px;
	margin-right: 10px;
}

.tableTitle span {
	font-size: 15px;
	margin-left: 10px;
	line-height: 25px;
}

.pageTitleContainer {
	padding-bottom: 10px;
	margin-bottom: 10px;
}



.container,.navbar-static-top .container,.navbar-fixed-top .container,.navbar-fixed-bottom .container
	{
	width: 100% !important;
	max-width: 100% !important;
	min-width: 100% !important;
}

.knob {
	position: absolute;
	top: 50%;
	margin-top: -45px;
	left: 50%;
	margin-left: -45px;
}

.ribbon {
	-webkit-transform: rotate(-45deg);
	-moz-transform: rotate(-45deg);
	-ms-transform: rotate(-45deg);
	-o-transform: rotate(-45deg);
	transform: rotate(-45deg);
	border: 25px solid transparent;
	border-top: 25px solid #26ada1;
	position: absolute;
	color: white;
	font-family: sans-serif;
	size: 11px;
}

.ribbon.ribNuevo{
border-top-color:#26ada1;
bottom: 32px;
right: -32px;
width: 120px;
padding-left: 12px;
}


.ribbon.ribFinalizado{
border-top-color:#26ada1;
right: -40px;
top: 209px;
width: 129px;
}

.ribMisPeliculas{
position:absolute; color:rgba(255,255,255,1); right:7px; bottom:34px; font-size:23px;
z-index:200;
}

.ribDescargando{
position:absolute; color:#666; background-color:rgba(255,255,255,1); border-radius:37px; 
padding:3px 5px; display:inline-block; text-align:center; right:5px; bottom:40px; font-size:15px; letter-spacing:1px; 
z-index:200;
}

.flex-viewport {
	padding-bottom: 5px;
}

.flexslider .liSlider {
	width: 180px !important;
}

.flexslider .liSlider .knob,.flexslider .liSlider .knob canvas, .flexslider .liSlider input, .flexslider .liSlider .frente, .flexslider .liSlider .frente div, .flexslider .liSlider .preparando, .flexslider .liSlider .preparando div, .flexslider .liSlider .fallo, .flexslider .liSlider .fallo div{
cursor:pointer;
}

.ribbon .ribbonTxt {
	position: absolute;
	top: -20px;
	font-size: 12px;
	letter-spacing: 1px;
}

.peliTitulo {
	color: #fff !important;
	padding: 5px;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden; 
  width:auto;

  color:#999 !important;
}

.item{width:180px;}
.peliAfiche {
	width: 180px;
	height: 260px;
}

.peliDesc img {
	opacity: 0.5;
}


/* ------ END BODY / MAIN LAYOUT ------- */


/* -------- ISOTOPE ------------ */

 .grid-sizer{ width: 180px; height: 295px;}
 
 .item{  margin-bottom: 10px; position:relative;
 }
    
    
 .item a{ cursor:pointer; display:block;}
 
 .item a:hover img, .item a:focus img, .item a:active img{
  -webkit-opacity: 0.5;
  -moz-opacity: 0.5;
  opacity: 0.5;
}

/* -------- END ISOTOPE ------------ */

/* ------ MODAL POPUPS SERIES / PELI DETAIL ------- */
.modal {	z-index: 1070;}
.modal-content{border-radius:0px;}
.modal-title {	font-size: 1.7em;	color: #666; color:#999; color:white;}
.modal-header {	padding: 9px 15px; background-color:#fbfbfb;  border:0px none; background-color:#26ada1;}
.modal-header .close {	padding: 0px;	margin-top: 0px;	line-height: 34px; color:white; opacity:.6;}
.modal-footer {	padding: 9px 15px; border-top:0px; background-color:#f8f8f8; margin-top:0px;}
.modal-body { /*overflow:hidden;*/}
.modal-backdrop {	z-index: 1065;}

.ratingStars {	color: orange;	display: inline-block;}
.ratingStars i {	margin-left: 1px;	font-size: 16px;}

.nav-tabs {	margin-bottom: 0px !important;	margin-left: 0px !important; border-bottom:2px solid #f8f8f8;}
.nav-tabs>li>a{border-radius:0px;}
.nav-tabs>li>a:hover{border-color:#eee;}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus{ background-color:#f8f8f8; border-color:#f8f8f8; border-radius:0px;}

.modalDetail {	width: 85%;}
.modalDetail table button {	margin-top: -3px;}

.modalDetail .table tbody>tr>td {	padding: 0px 8px;	/*line-height: 45px;*/}
.modalDetail .alert{margin:15px;}
.modalDetail .table.tablaIndividual{margin-bottom:20px; border-bottom:1px solid #F3F3F3;}
.alert h4{font-size:18px; font-family:'GudeaBold';}
.alert .fa-ul i{line-height:20px;}

.modalDetail .modal-body .row {	line-height: 26px;}

.modalDetail .modal-body .row.detailSummary {	line-height: 20px;}

.aficheDetail { /*height:100% !important;*/
	height: auto !important;
	width: 100% !important;
	/*-moz-box-shadow: 0 1px 4px #333;
-webkit-box-shadow: 0 1px 4px #333;
box-shadow: 0 1px 4px #333;*/
border:4px solid #f8f8f8;
}

.detailMainGroup {
	border-bottom: 1px solid #F3F3F3;
	color: #666;
}

.detailMain {
	font-size: 120%;
	border-left: 1px solid #F3F3F3; 
	padding-top: 3px;
	height: 35px;
	line-height: 30px;
}

.detailMainFirst {
	border-left: none;
}

.detailSecondGroup {
	border-bottom: 1px solid #F3F3F3;
	color: #666;
}

.detailSecond {
	font-size: 100%;
	border-left: 1px solid #F3F3F3;
	padding-top: 4px;
	padding-left: 5px;
}

.detailSecondGroup:last-child{border-bottom:0px none;}

.detailSecondFirst {
	border-left: none;
}

.tableInfo {
	
}

.modalDetail .tab-pane {
	max-height: 390px;
	overflow-y: auto;
	overflow-x: auto;
	-webkit-overflow-scrolling: touch;
}
.modalDetail .tab-pane.removeOverflowTab{
overflow:visible;
}

.modalDetail .tab-pane.tabInfo {
	max-height: auto;
	height:auto;
}
.modalSerie .aficheDetail{margin-top:20px;}

.modalDetail .tab-pane.tabInfo .tabInfoScroll {
	max-height: 390px;
	overflow-y: auto;
	overflow-x: auto;
	-webkit-overflow-scrolling: touch;
	padding-top:20px;
	padding-right:20px;
}

.tableInfo .row {
	margin-left: 0px !important;
	margin-right: 0px !important;
}

.modalSubtitulo {
	padding: 10px;
	padding-left: 0px;
	font-size: 18px;
}

.topDotted {
	border-top: 1px dotted #ccc;
	margin-top: 15px;
}

.bottom-up {
	top: auto;
	bottom: 100%;
}

.dropdown-menu.bottom-up:before {
	border-bottom: 0px solid transparent !important;
	border-top: 7px solid rgba(0, 0, 0, 0.2);
	top: auto !important;
	bottom: -7px;
}

.dropdown-menu.bottom-up:after {
	border-bottom: 0px solid transparent !important;
	border-top: 6px solid white;
	top: auto !important;
	bottom: -6px;
}

.modalPath{
font-size: 14px;
line-height: 18px;
padding: 3px 0px;
}

/* ------ END MODAL DETAIL ------- */

/* ------ POPUP REPRODUCIENDO ------- */
.peliReroduciendo {
	position: fixed;
	bottom: 10px;
	left: 10px;
	width: 210px;
	background-color: rgba(0, 0, 0, 0.9);
	z-index: 1030;
	padding: 10px;
	text-align: center;
	border: 1px dotted #333;
	color: white;
}

.peliReroduciendo .rep {
	text-align: left;
}

.peliReroduciendo .tituloRep {
	font-size: 1.6em;
	margin-bottom: 10px;
	border-bottom: 1px dotted #393939;
	padding-bottom: 10px;
}

#player-status-quantity{color:#666;}

/* ------ END POPUP REPRODUCIENDO ------- */

/*-------- CONTROL REMOTO --------------*/

#screenControl.container {
	text-align: center;
}

#screenControl {
	background-position: center top;
	background-size: cover;
	overflow: hidden;
}

.controlContainer {
	margin: auto;
}

.controlContainer .controlAfiche {
	padding-top: 10px;
	text-align: center;
	padding-bottom:40px;
}
.controlContainer .controlAfiche .aficheImg{
	/*-moz-box-shadow: 0 1px 4px #333;
-webkit-box-shadow: 0 1px 4px #333;
box-shadow: 0 1px 4px #333;*/
	border:4px solid white;
}

.controlTitle {
	font-size: 2.3em;
	font-size:1.8em;
	font-size:28px;
	margin-top:35px;
	font-weight: normal;
	color: #fff;
	text-shadow: 0 1px 4px #929292;
	text-align: left;
	padding-bottom:5px;
	text-shadow:none;
	color:#C0BFBF !important;
}

.controlAudioSub {
	text-align: left;
}

.controlAudioSub button {
	width: 200px;
	height: 50px;
	margin-top: 40px;
	margin-bottom: 30px;
	display: block;
}

.controlFlechas {
	width: 235px;
	margin-bottom: 20px;
	margin-top: 0px;
}
.controlFlechas .btn{
	width: 60px;
	height: 60px;
	font-size:10px;

}
.flechasArriba {
	margin-bottom: 5px;
}

.flechasCemtro .button {
	margin-right: 5px;
}

.flechasAbajo {
	margin-top: 5px;
}

.controlBackground {
	/*background-color: rgba(89, 117, 139, 0.2);
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2);
	border-bottom: 1px solid rgba(255, 255, 255, 0.05);
	*/
	box-shadow:0px 0px 60px -10px rgba(0,0,0,0.15);
	border-radius: 5px;
}

.controlNavegacion {
	padding: 15px 0px;
}

.controlProgress {
	height: 20px;
	padding-top: 45px;
}
.progress{ height:6px;}

.progress-bar {
	background-color: #044F58;
}

.controlLenght {
	height: 50px;
	padding-top: 37px;
	padding-right: 15px;
	font-size: 1.3em;
	font-weight: bold;
	color:white;
}


#enterButton{ font-size:18px;}

#screenControl .controlContainer .controlNavegacion .btn {
	width: 65px;
	height: 65px;
	font-size:10px;
}

.controlNumeros {
	text-align: left;
	padding: 20px 0px;
}
.controlNavegacion {
	text-align: left;
}

.controlNumeros .btn {
	width: 60px;
	height: 60px;
	font-size: 24px;
	margin-right: 5px;
}
.rowControlVariable{width:90%; margin:auto;}

.controlConfig {
	text-align: left;
	padding: 20px 15px;
	text-align: right;
}

.controlConfig .btn {
	width: 60px;
	height: 60px;
	font-size:18px;
	margin-left: 5px;
}

#screenControl .controlConfig .btn {
	height: 60px;
	width: 60px;
}

#screenControl .btn-lg {
	padding: 0px;
}

.controlContainer .aficheImg {
	width: 200px;
	height: 280px;
}

#screenControl .controlTitle {
	color: white;
	border-bottom: 1px solid #ccc;
	border-bottom:0px none;
}

#screenControl .dropdown a.controlTitle:hover {
	color: #fbfbfb;
	text-decoration: none;
}

#screenControl .dropdown a.controlTitle:active {
	background-color: transparent !important;
}

#screenControl .dropdown.open a.controlTitle {
	color: #ccc;
	text-decoration: none !important;
}

#screenControl .dropdown.open a.controlTitle:hover {
	color: #ccc;
	text-decoration: none !important;
}

#screenControl .dropdown.open a.controlTitle:active {
	background-color: transparent !important;
}

#screenControl .dropdown ul li {
	font-size: 1.6em;
}
 
 

#screenControl .dropdown {
	text-align: left;
}
.chooseFile{color:white; font-size:1.5em; padding:0px; margin-top:5px;  text-shadow:0 1px 3px #333; text-align:left; margin-bottom:-10px;}
.chooseFile .dropdown{display:inline-block; font-size:1.1em;}
.chooseFile .dropdown .fa{display:inline;}
.chooseFile .dropdown > a{text-shadow:none;color:white; padding: 5px; text-decoration:none; margin-right:5px;background-color:rgba(0,0,0,0.7);border-radius:5px;}
.chooseFile .dropdown a:hover{color:#999; text-decoration:none;}
.dropdown-menu>li>a{ padding:0px 7px;}
#drop{display:inline-block;}
.chooseFile ul li{color:#333; text-shadow:none;}


.chooseFile .dropdown.open > a{background-color:#666; color:white}


.chooseFile .dropdown-menu a{ line-height:2em;}

.chooseFile .dropdown-menu a:hover, .chooseFile .dropdown a:focus{ background-color:#ccc; color:white;}

.scrollable-dropdown{   height: 250px;
    max-height: 250px;
    overflow-x: hidden;
    min-width:100%;}
    
    .controlTitleLoading{text-shadow: none;
color: #666;
font-size: 1em;
padding-left: 4px;}

#screenControl .dropdown-menu .divider{margin:0px;}


/*-------- END CONTROL REMOTO --------------*/

/* ----- MARKETPLACE --------*/
#screenMarketplace .peliTitulo {
	margin-top: 0px;
}

#screenMarketplace .nav-pills {
	margin-bottom: 10px;
	display: inline-block;
	height: 20px;
}

#screenMarketplace .flex-next:active {
	background-color: transparent;
}

#market-area{overflow-x:hidden !important;}

.scrollItems{
          display: table-cell; }
          
.botonTodas {
	float: right;
	margin-right: 30px;
}

.botonTodas .btn-lg {
	font-size: 15px;
}

.filterDesc{font-size:14px; 
line-height:51px; letter-spacing:1px;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden; 
  width:auto;
  padding-left:10px;
  padding-right:10px;
  display:block;
}

/* ----- END MARKETPLACE --------*/

/* ----- DISPOSITIVOS --------*/
.tablaIndividual {
	margin-bottom: 20px;
	background-color: rgba(255, 255, 255, 1);
	max-height: 100px;
	overflow: auto;
}

.devicesSelector {
	padding-bottom: 10px;
	margin-bottom: 10px;
}

#wizardDispositivos h3 { /*margin-top:10px;*/
	margin-top: 0px;
}

.nav-pills.nav-stacked>li>a {
	border-radius: 18px;
	color: white;
}

.nav-pills.nav-stacked>li.active>a {
	background-color: #eee;
	color: #333;
}

.nav-pills.nav-stacked>li>a:hover {
	background-color: #428bca;
	color: white;
}

.nav>li>a.ejectBTN {
	width: 35px;
	height: 35px;
	padding: 6px;
	position: absolute;
	top: 3px;
	right: 3px;
	color: #428bca;
	background-color: #fff;
}

.table.tablaIndividual {
	margin-bottom: 30px;
}

.tablaIndividual .tdPath {
	font-size: 14px;
}

.tablePeliTitle {
	font-family: 'GudeaBold';
	font-size: 18px;
}

.tablaIndividual td button {
	margin: 5px;
	margin-left: 0px;
	vertical-align: middle;
}

.table.tablaIndividual th {
font-weight: 600;
font-size: 15px;
line-height: 15px;
color: #555;
background-color: #ddd;
}

.table.tablaIndividual th .radio, .table.tablaIndividual th .checkbox{
margin:0px;
}

.table.tablaIndividual td.small{
font-size:  90% !important;
}

.table.tablaIndividual th .checkbox label{
vertical-align:middle;
}

.table.tablaIndividual thead>tr>th,.table.tablaIndividual tbody>tr>th,.table.tablaIndividual tfoot>tr>th,.table.tablaIndividual thead>tr>td,.table.tablaIndividual tbody>tr>td,.table.tablaIndividual tfoot>tr>td
	{
	vertical-align: middle;
	padding: 5px;
}

.devicesHeader{color:white; vertical-align:middle; margin-bottom:-1px;}
.devicesHeader .pull-right{display:flex; min-height:40px; vertical-align:middle;}
.devicesHeader .pull-right.justtext{ text-align:right; width:420px;}
.devicesHeader .pull-right p{ vertical-align:middle; margin:auto;}
.devicesHeader .nav-tabs{margin-top:10px; border-bottom:0px transparent; font-size:16px;}
.deviceDropdownName {
	border: 0px none !important;
	font-size: 28px;
	padding: 5px;
	margin-bottom:10px;
	border: 0px none;
	font-weight: 100;
	color: #ddd;
	margin: 0px;
	text-shadow: 0 1px 3px #000;
	font-family: 'GudeaRegular', Arial, sans-serif;
	display:inline-table;
}

.dropdown-menu li a{cursor:pointer;}
.deviceDropdown .dropdown-menu>li>a{font-size:16px;}
.deviceDropdown{	margin-bottom:10px;}
.deviceDropdown i {
	margin-left: 10px;
	margin-right: 5px;
}

.deviceDropdown:hover {
text-decoration:none !important;
background-color:none !important;
}
.deviceDropdown.open .deviceDropdownName{
text-decoration:none !important;
border-radius:5px;
}
.deviceDropdown:hover .deviceDropdownName {
text-decoration:none;
background-color:none;
}

.deviceDropdownName:hover {
	background-color: #fff !important;
	border-radius:5px;
	border: 0px none;
	color: #666;
	text-shadow: none;
}

.deviceDropdownName:focus {
	background-color: #fff !important;
	border: 0px none;
	color: #666 !important;
	text-shadow: none;
}


#wizardDispositivos .nav-tabs .pull-right {
	margin-top: 10px;
}

#wizardDispositivos .nav-tabs>li>a {
	color: white;
}

.nav-tabs>li>a {
	color: #999;
}

.nav-tabs>li.active>a {
	color: #333 !important;
}

.nav-tabs>li>a:hover {
	color: #666 !important;
}

#wizardDispositivos button {
	min-width: 120px;
}

.nav-tabs .dropdown-menu {
	font-size: 20px;
}
/* ----- END DISPOSITIVOS --------*/

/*-------- DESCARGAS --------------*/
/*no logre encontrar el error, la solucion por ahora para evitar overflow lateral es forzarlos a hidden:*/
#finished-area{overflow:hidden !important; }
#market-area{overflow:hidden !important; }

#screenDescargas .nav-pills {
	margin-bottom: 10px;
	display: inline-block;
	height: 20px;
}

.noSliderResults {/*
	background-color: rgba(255, 255, 255, 0.1);
	background-color:rgba(214, 214, 214, 0.1);*/
	color: #999;
	/*	text-shadow: 0 1px 1px #666;*/
	font-size: 18px;
	width: 95%;
	margin: auto;
	height: 295px;
	text-align: center;
	line-height: 180px;
	text-transform: uppercase;
	padding: 4px;
}

.rowBackground{margin-bottom:15px;}
	
.rowBackground:last-of-type{margin-bottom:0px; border-bottom:0px none;}
	
.labelDescargando{ font-size:17px; line-height:40px; color:#26ada1;}

.preparando{width:180px; height:40px;
text-transform:uppercase; letter-spacing:1px; color:white; font-size:18px; 
position:absolute;
text-align:center;
 top:50%; margin-top:-20px;
}

.frente{width:180px; height:40px;
text-transform:uppercase; letter-spacing:1px; color:white; font-size:18px; 
position:absolute;
text-align:center;
 top:45%; margin-top:-60px;
text-shadow: 0px 0px 3px rgba(0,0,0,0.3);
}
.frente .btn{ position: absolute;
bottom: -144px;
right: 8px;}

.fallo{width:180px; height:40px;
text-transform:uppercase; letter-spacing:1px; color:white; font-size:18px; 
position:absolute;
text-align:center;
 top:45%; margin-top:-20px;
}

.fallo .label{display: inline-block;
width:140px;
white-space: pre-wrap;
margin:auto;
line-height:20px;
background-color:rgba(217, 83, 79, 0.73);}

.fallo .btn{ margin-top:10px;}

.velocidadDescarga{line-height:40px; padding-right:45px;}

/*-------- END DESCARGAS --------------*/

/*---------- FLEXSLIDER STYLE OVERRIDE -------*/

.flexslider {
	height: 295px;
	height: 350px;
	width: 93%;
	margin: 0 auto;
	/*margin-bottom: 30px;*/
	background: none repeat scroll 0 0;
	/*	background-color: rgba(255, 255, 255, 0.1);*/
	border: none;
	padding: 15px 0px;
	box-shadow: none;
}
.flexslider .peliTitulo{height: 30px;
line-height: 21px;}

.flexslider .slides img{width:180px; height:260px;}

#flexsliderMarket{height:269px;}
.flex-direction-nav a {
	opacity: 1;
}

.flexslider .slides>li {
	position: relative;
}
.flexslider .slides>li a{
	cursor: pointer;
}
.flexslider .flex-next {
	right: -34px !important;
	background-position:100% 0;
}
.flexslider .flex-prev {
	left: -34px !important;
}

.flexslider:hover .flex-next {
	right: -34px !important;
	background-position:100% 0;
}

.flexslider:hover .flex-prev {
	left: -34px !important;
}

.flex-direction-nav .flex-disabled{display:none;}

.flexslider .flex-next {
}

.flexslider .flex-prev {
}

.flex-control-nav {
bottom: 5px;
position: absolute;
width: 100%;
padding-top: 12px;
}
.flex-control-nav:empty{border:0px none; padding:0px;}

@media ( max-width : 1024px) {
	.flex-control-paging li a {
		width: 15px;
		height: 15px;
	}
	.flexslider {
		margin-bottom: 10px;
	}
}

/*---------- END FLEXSLIDER STYLE OVERRIDE -------*/

/*---------- BOOKMARKS -------------*/
.tableInfoBookmark {
	max-height: 350px;
	overflow-y: scroll;
}

.controlBookmark {
	text-align: right;
	width: 30%;
	float: right;
	display: inline-block;
}

.controlBookmark button {
	width: 100px;
	height: 60px;
	margin-top: 10px;
	margin-bottom: 20px;
	display: block;
}

.tableInfoBookmark {
	max-height: 350px;
	overflow-y: scroll;
}

/*---------- END BOOKMARKS -------------*/

/*---------- EDIT PELICULA -------------*/

#screenEditMovie .form-group label{color:#666;}
.editAfiche {	text-align: center;}

.editAfiche .peliAfiche {
	width: 100%;
	height: auto;
	margin-bottom: 10px;
}

.editImagesButtons {
	text-align: center;
}

.editImagesButtons .btn {
	margin: auto;
	margin-bottom: 10px;
	display: block;
	width: 100%;
}

.buttonGroup {
	margin-top: 10px;
	text-align: right;
}

.buttonGroup button {
	margin-right: 10px;
}


#myModalCambiarAfiche .modal-dialog {
	width: 80%;
}

#myModalCambiarAfiche ul.thumbnails.image_picker_selector li {
	width: 165px;
	height: 240px;
	cursor: pointer;
}

#myModalCambiarBackdrop ul.thumbnails.image_picker_selector li {
	width: 240px;
	height: 155px;
	cursor: pointer;
}

#myModalCambiarBackdrop .modal-dialog {
	width: 80%;
}
#myModalEditarAsoc .helpText{
overflow: hidden;
width: auto;
display: block;
text-align:left;
color:#777;
}

#myModalConfigPassword .modal-body {
padding-top:40px;}

.modal-scroll {
	max-height: 430px;
	overflow-y: auto;
}

.backdrop-on {
	background: no-repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
	background-image:none !important;
	
	background:#f8f8f8 !important;
	
 	background:#ECF0F1 !important;
}

ul.thumbnails.image_picker_selector {
	overflow: hidden;
}

#fieldDuracion {
	width: 78%;
	display: inline-block;
}

.form-group {
	color: white;
}

.form-group input {
	font-size: 16px;
}

.form-group textarea {
	font-size: 16px;
}

.form-group label {
	font-size: 17px;
	color: white;
	font-weight:400;
	text-align: right;
}

.modal .form-group label {
	font-size: 17px;
	color: #333;
	text-align: right;
}

.form-group select,.form-group ul.select2-choices {
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
	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
	-webkit-transition: border-color ease-in-out .15s, box-shadow
		ease-in-out .15s;
	transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}

.form-group ul.select2-choices {
	padding: 2px;
}

.select2-container-multi .select2-choices .select2-search-choice {
	line-height: 20px;
}

.select2-search-choice-close {
	top: 6px;
	width: 13px
}

.superContainer {
	background-color:rgba(255, 255, 255, 0.56);
	padding-top: 20px;
	padding-bottom: 20px;
}

.fileName{padding-top: 7px;font-size:17px;}

#screenEditMovie .noLeftPad{padding-left:0px;text-align:left;}

/*---------- END EDIT PELICULA -------------*/

/* ------ PAGINADOR------- */
.grid-view .pager {
margin: 5px 0 0 0;
text-align: right;
}

ul.yiiPager .page a {
font-weight: normal;
height: 32px;
width: 30px;
margin: 0px;
font-size: 16px;
border-radius: 4px;
line-height: 26px;
text-align: center;
color: #26ada1;
background-color: #fff;
border-color: #ddd;
}
ul.yiiPager .page a:hover{
color: #fff;
background-color: #26ada1;
border-color: #26ada1;
}

ul.yiiPager{ padding-bottom:40px; margin-left:10px;}

.pager{color:white;}
.pager .next>a, .pager .previous>a{
font-weight: normal;
height: 32px;
margin: 0px;
font-size: 16px;
border-radius: 4px;
line-height: 26px;
text-align: center;
margin-left:5px;
color: #26ada1;
background-color: #eee;
border-color: #ddd;
}

.pager .next>a:hover, .pager .previous>a:hover{
color: #fff;
background-color: #26ada1;
border-color: #26ada1;
}


ul.yiiPager a:link, ul.yiiPager a:visited {

color: #26ada1;
background-color: #fff;
border-color: #ddd;
}

ul.yiiPager .selected a{color: #ffffff;
background-color: #26ada1;
font-weight: 600;
border-color: #26ada1;
}
ul.yiiPager .selected a:hover{color: #ffffff;
background-color: #26ada1;
font-weight: 600;
border-color: #26ada1;
cursor:inherit;
}




/* ------ END PAGINADOR------- */


/*-------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------*/
/*------------------------   Estilos RESPONSIVE    ----------------------------*/
/*----------------------------------------------------------------------------*/
/*---------------------------------------------------------------------------*/

/* Large desktop */
@media screen  ( min-width : 1024px) {

	 .grid-sizer{ width: 180px; height: 295px;}

	.peliAfiche { width: 180px; height: 260px; }

		
}

/*ALL MOBILE*/
@media screen  ( max-width : 1024px){

.table.tablaIndividual th {
font-family: 600;
font-size: 18px;
line-height: 18px;
}

.table.tablaIndividual td {
font-size: 17px;
line-height: 17px;
}

#Menu, #menuSecond{
font-size:  110% !important;
}

.deviceDropdown .dropdown-menu>li>a{font-size:18px;}

.justtext{font-size:16px;}

}

/*IPAD LANDSCAPE*/
@media screen ( min-width : 768px) and (max-width: 1024px) and (orientation:landscape){
	.controlContainer {
		width: 100%;
	}
	
	 .grid-sizer{ width: 180px; height: 295px;}

	.peliAfiche { width: 180px; height: 260px; }
	
	.ribbon {
		right: -103px;
		bottom: 84px;
	}
		.devicesHeader .nav-tabs{font-size:115%;}

	.rowControlVariable{width:99%; margin:auto;}
	.controlNavegacion{text-align:center;}
	
	.flexslider {
		width: 90%;		
	}

}
/*IPAD PORTRAIT*/
@media only screen and (min-width : 765px) and (max-width : 768px)  and (orientation:portrait){

#Menu .btn { padding:6px;}

.flexslider {
	width: 88%;		
}
	
.ribbon.ribNuevo{
		right: -32px;
		bottom: 32px;
}


.ribbon.ribFinalizado{
right: -38px;
top: 209px;
}

.ribMisPeliculas{
right:9px; bottom:35px;
}

.ribDescargando{
right:8px; bottom:39px;
}

.navbar .nav>li>a {
	padding: 10px 10px 10px;
	font-size:100%;
}
	
/*asi se muestran de a 4 por fila */
	
.item{ width:160px;}
.grid-sizer{ width: 160px; height: 267px;}
.peliAfiche { width: 160px; height: 232px; }
		

/*asi se muestran de a 3 por fila */
/* .grid-sizer{ width: 220px; height: 355px;}

.peliAfiche { width: 220px; height: 320px; }
*/
	
.controlContainer {
	width: 100%;
}
.controlContainer .span6 {
	width: 100%;
}
.controlNavegacion {
	width: 680px;
	margin: auto;
}
.controlContainer .controlNavegacion .btn {
	width: 70px;
	height: 70px;
}
.controlProgress {
	width: 90%;
	margin: auto;
}
.controlNumeros .btn {
	margin-right: 5px;
	margin-bottom: 15px;
}
.controlProgress{padding-top:20px;}
.controlLenght{padding-top:16px;}
.rowControlVariable{width:99%; margin:auto;}
	
#tab1 {
	max-height: 650px;
}
.modalDetail {
	width: 95%;
}
	
.navbar-header {
float: left;
}
.navbar-right {
float: right;
}
.navbar-left {
float: left;
}
.navbar-nav{margin:0px;}
#menuSecond .navbar-form{padding: 10px 15px;
padding-top:8px;
margin-top: 0px;
margin-bottom: 0px;
margin-left: -15px;
border-top: 1px solid transparent;
border-bottom: 1px solid transparent;
-webkit-box-shadow:none;
box-shadow: none;
}

.devicesHeader .nav-tabs{font-size:15px;}

.controlNavegacion{text-align:center;}
.controlNumeros{text-align:center;}

}

/*NEXUS*/
/* Nexus 7 (603x963) y 800x600 (portrait) ----------- */
@media only screen and (min-device-width : 600px) and (max-device-width : 601px) {

.col-md-1,
.col-md-2,
.col-md-3,
.col-md-4,
.col-md-5,
.col-md-6,
.col-md-7,
.col-md-8,
.col-md-9,
.col-md-10,
.col-md-11 {
  float: left;
}.col-sm-1,
.col-sm-2,
.col-sm-3,
.col-sm-4,
.col-sm-5,
.col-sm-6,
.col-sm-7,
.col-sm-8,
.col-sm-9,
.col-sm-10,
.col-sm-11 {
  float: left;
}

.col-md-1 {width: 8.333333333333332%;}
.col-md-2 {width: 16.666666666666664%;}
.col-md-3 {width: 25%;}
.col-md-4 {width: 33.33333333333333%;}
.col-md-5 {width: 41.66666666666667%;}
.col-md-6 {width: 50%;}
.col-md-7 {width: 58.333333333333336%;}
.col-md-8 {width: 66.66666666666666%;}
.col-md-9 {width: 75%;}
.col-md-10 {width: 83.33333333333334%;}
.col-md-11 {width: 91.66666666666666%;}
.col-md-12 {width: 100%;}

.col-sm-12 { width: 100%;}
.col-sm-11 {width: 91.66666667%;}
.col-sm-10 {width: 83.33333333%;}
.col-sm-9 {width: 75%;}
.col-sm-8 {width: 66.66666667%;}
.col-sm-7 {width: 58.33333333%;}
.col-sm-6 {width: 50%;}
.col-sm-5 {width: 41.66666667%;}
.col-sm-4 {width: 33.33333333%;}
.col-sm-3 {width: 25%;}
.col-sm-2 { width: 16.66666667%;}
.col-sm-1 {width: 8.33333333%;}

.col-nexus-1,
.col-nexus-2,
.col-nexus-3,
.col-nexus-4,
.col-nexus-5,
.col-nexus-6,
.col-nexus-7,
.col-nexus-8,
.col-nexus-9,
.col-nexus-10,
.col-nexus-11 {
  float: left;
}

.col-nexus-1 {width: 8.333333333333332%;}
.col-nexus-2 {width: 16.666666666666664%;}
.col-nexus-3 {width: 25%;}
.col-nexus-4 {width: 33.33333333333333%;}
.col-nexus-5 {width: 41.66666666666667%;}
.col-nexus-6 {width: 50%;}
.col-nexus-7 {width: 58.333333333333336%;}
.col-nexus-8 {width: 66.66666666666666%;}
.col-nexus-9 {width: 75%;}
.col-nexus-10 {width: 83.33333333333334%;}
.col-nexus-11 {width: 91.66666666666666%;}
.col-nexus-12 {width: 100%;}
    
.modal-dialog{ margin:auto; margin-top:60px;}

.modal-dialog .nav>li>a{padding:10px 7px;}


#Menu{margin-left:0px; margin-right:0px; }
#menuSecond{margin-left:0px; margin-right:0px; border-radius:0px;}

.hidden-xs{display:block !important;}

.hidden-nexus{display:none !important;}
.hidden-nexus-p{display:none !important;}

.visible-nexus{display:block !important;}
.visible-nexus-p{display:block !important;}

.visible-nexus-p.visible-inline{display:inline-block !important;}

.hidden-sm.hidden-xs.visible-nexus{display: inline-block!important;}

.visible-xs.visible-inline{display:inline-block!important;}

.navbar-nav{ margin:0px;}

#toggleMain{margin-left:10px; margin-right:5px;}

.container-fluid{ padding-left:10px; padding-right:10px;}

.navbar-left {
float: left!important;
}
.navbar-right {
float: right!important;
margin-right:0px;
margin-left:0px;
}

.navbar-default .navbar-collapse, .navbar-default .navbar-form{border-color:transparent; border-top:0px; border-bottom:0px; padding:0px;}

.searchMain input {
width: 100%;
}

.item{ width:135px;}
.grid-sizer{ width: 135px !important; height: 231px !important;}
.peliAfiche { width: 135px !important; height: 196px !important; }

.navbar-nav .open .dropdown-menu{
position:absolute;
background-color: #fff;
border: none;
-webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
box-shadow: 0 6px 12px rgba(0,0,0,.175);
left: auto;
right: 0;
}

}

/* Nexus 7 (603x963) y 800x600 (landscape) ----------- */
@media screen and (min-width : 603px)  and (max-width : 963px) and (orientation: landscape) {

.col-md-1,
.col-md-2,
.col-md-3,
.col-md-4,
.col-md-5,
.col-md-6,
.col-md-7,
.col-md-8,
.col-md-9,
.col-md-10,
.col-md-11 {
  float: left;
}

.col-md-1 {width: 8.333333333333332%;}
.col-md-2 {width: 16.666666666666664%;}
.col-md-3 {width: 25%;}
.col-md-4 {width: 33.33333333333333%;}
.col-md-5 {width: 41.66666666666667%;}
.col-md-6 {width: 50%;}
.col-md-7 {width: 58.333333333333336%;}
.col-md-8 {width: 66.66666666666666%;}
.col-md-9 {width: 75%;}
.col-md-10 {width: 83.33333333333334%;}
.col-md-11 {width: 91.66666666666666%;}
.col-md-12 {width: 100%;}



.hidden-xs{display:block !important;}
.hidden-sm{display:block !important;}
.hidden-sm.visible-inline{display:inline-block !important;}

.hidden-nexus{display:none !important;}
.hidden-nexus-l{display:none !important;}

.visible-nexus{display:block !important;}

.modalDetail{ margin-top:10px;}
.modalDetail .tab-content{ height: 180px;
overflow: auto;
}

.item{ width:140px;}
.grid-sizer{ width: 140px; height: 237px;}
.peliAfiche { width: 140px; height: 202px; }

  #screenControl .controlContainer .controlNavegacion .btn {
width: 55px;
height: 55px;
}
.controlProgress{ height:55px; padding-top:25px;}

.controlNavegacion {
padding: 5px 0px;
}


.progress{ height:10px;}
 .controlNumeros .btn {
width: 45px;
height: 45px;
font-size: 1.5em;
margin-right: 5px;
}
#screenControl .controlConfig .btn {
height: 45px;
width: 45px;
font-size: 1.5em;
}
}

/*CELUS*/
/*Landscape*/
@media screen and (min-width : 360px) and (max-width: 599px) and (orientation: landscape) {

	.grid-sizer{ width: 150px; height: 250px;}
body{background-color:green;}
	
	.peliAfiche { width: 150px; height: 215px; }
}

/*Portrait*/
@media screen and (max-width: 350px) and (orientation: portrait) { 
body{background-color:red ;}
	 .grid-sizer{ width: 140px; height: 235px;}

	.peliAfiche { width: 140px; height: 200px; }
}

</style>