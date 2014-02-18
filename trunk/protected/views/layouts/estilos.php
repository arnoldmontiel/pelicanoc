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
	text-align: left;
}

.align-center {
	text-align: center;
}

.align-right {
	text-align: right;
}

.fa-lg{width:1.3em;}

html {
padding:0px; margin:0px;
}

body {
	font-family: 'GudeaRegular', Arial, sans-serif;
	font-size: 15px;
	cursor: default;
	line-height: inherit;
	color: #333;
	background: rgb(198, 198, 198); /* Old browsers */
	background: -moz-radial-gradient(center, ellipse cover, rgba(198, 198, 198, 1)
		0%, rgba(89, 89, 89, 1) 100%); /* FF3.6+ */
	background: -webkit-gradient(radial, center center, 0px, center center, 100%,
		color-stop(0%, rgba(198, 198, 198, 1)),
		color-stop(100%, rgba(89, 89, 89, 1))); /* Chrome,Safari4+ */
	background: -webkit-radial-gradient(center, ellipse cover, rgba(198, 198, 198, 1)
		0%, rgba(89, 89, 89, 1) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-radial-gradient(center, ellipse cover, rgba(198, 198, 198, 1)
		0%, rgba(89, 89, 89, 1) 100%); /* Opera 12+ */
	background: -ms-radial-gradient(center, ellipse cover, rgba(198, 198, 198, 1)
		0%, rgba(89, 89, 89, 1) 100%); /* IE10+ */
	background: radial-gradient(ellipse at center, rgba(198, 198, 198, 1) 0%,
		rgba(89, 89, 89, 1) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c6c6c6', endColorstr='#595959', GradientType=1);
	/* IE6-9 fallback on horizontal gradient */
	padding:0px;
	}


/* no ncesesarios?
body{overflow:hidden; height:100%; width:100%;}
html{overflow:hidden; height:100%; width:100%;}
*/
body #content {
height:100%;
/*position:fixed;
top:0px; left:0px; right:0px; bottom:0px;
*/overflow:hidden;
}
.modal-open #content {
height:100%;
overflow:hidden;
}

body .container{
 display: block;
 height:100%;
overflow:auto;
-webkit-overflow-scrolling: touch;
 }
.modal-open .container {
overflow:hidden;
}

body #screenHome {
padding-top:130px;
padding-bottom:20px;
}

body #screenSeries {
padding-top:130px;
padding-bottom:20px;
}

body #screenMarketplace {
padding-top:130px;
padding-bottom:20px;
}

body #screenDescargas {
padding-top:80px;
padding-bottom:20px;
}

body #screenDevices {
padding-top:80px;
padding-bottom:20px;
}

body #screenControl {
	padding-top: 80px;
}

body #screenEditMovie {
padding-top:80px;
padding-bottom:20px;
}

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

.loginForm .checkbox{text-align:left; color:#999; margin-left:5px; margin-top:2px;}

.loginForm .btn{margin-top:20px;}

.separatorLine{border-top:1px dotted #ddd;}
/* ----- END LOGIN ------*/

/* ----- NEW BUTTONS ------*/
.btn-primary {
	color: #ffffff;
	background-color: #26ada1;
	border-color: #26ada1;
}

.btn-primary:hover,.btn-primary:focus,.btn-primary:active,.btn-primary.active,.open .dropdown-toggle.btn-primary
	{
	color: #ffffff;
	background-color: #027871;
	border-color: #16665f;
}

.btn-primary.disabled,.btn-primary[disabled],fieldset[disabled] .btn-primary,.btn-primary.disabled:hover,.btn-primary[disabled]:hover,fieldset[disabled] .btn-primary:hover,.btn-primary.disabled:focus,.btn-primary[disabled]:focus,fieldset[disabled] .btn-primary:focus,.btn-primary.disabled:active,.btn-primary[disabled]:active,fieldset[disabled] .btn-primary:active,.btn-primary.disabled.active,.btn-primary[disabled].active,fieldset[disabled] .btn-primary.active
	{
	color: #eee;
	background-color: #26ada1;
	border-color: #21988e;
}

.btn-default {
	color: #027871;
	background-color: #D0E6DF;
	border-color: #C8E6DB;
}

.btn-default:hover,.btn-default:focus,.btn-default:active,.btn-default.active,.open .dropdown-toggle.btn-default
	{
	color: #fff;
	background-color: #038C79;
	border-color: #007064;
}

.btn-default .badge {
	color: #027871;
	background-color:white;
}

.btn-danger {
	color: #d9534f;
	background-color: #FFE4E3;
	border-color: #FFDEDC;
}

.btn-default.disabled,.btn-default[disabled],fieldset[disabled] .btn-default,.btn-default.disabled:hover,.btn-default[disabled]:hover,fieldset[disabled] .btn-default:hover,.btn-default.disabled:focus,.btn-default[disabled]:focus,fieldset[disabled] .btn-default:focus,.btn-default.disabled:active,.btn-default[disabled]:active,fieldset[disabled] .btn-default:active,.btn-default.disabled.active,.btn-default[disabled].active,fieldset[disabled] .btn-default.active
	{
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

#pushMain .mobileMenuItem.active{background-color:#e7e7e7;}

#Menu .container-fluid{padding:0px;}
#MenuLogo {
	margin-left: 0px;
	font-family: 'LatoRegular', sans-serif;
	font-size: 18px;
	text-transform: uppercase;
	letter-spacing: 1px;
	padding: 0px 15px;
	line-height: 48px;
}

#Menu .navbar-collapse {
	padding-right: 0px;
}

#Menu .navbar-nav>li>a {
	padding: 2px 15px;
	line-height: 45px;
}
#Menu .navbar-nav>li>a:hover, #Menu .navbar-nav>li>a:focus {
color: #555;
background-color: #e7e7e7;
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

.reproTableContainer .table th {
	font-family: "GudeaBold";
}

.reproTableContainer .table td {
	vertical-align: middle;
}
/* ------ SECOND MENU / NAV BAR ------- */

.secondNavFixedTop{top:80px; width:100%; position:Absolute; z-index:1099;}
.secondNavFixedTop h2{height:48px;}
.secondNavFixedTop #filtroGenero{margin-top:0px;}
.secondNavFixedTop .btn{margin:0px; margin-top:-2px; margin-left:20px;}
.secondNavFixedTop #toggleMarketplace{margin-top:2px; margin-left:0px;}


.changeType {margin-right:30px;}

.searchMain.marketplace{
	margin-right: 10px;
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

/* ------ END MENU ------- */

/* ------ MOBILE MENU ------- */

.pushMenuActive{position:relative;}

.pushMenuActive:before {
        position:absolute;
		font-family: FontAwesome;
        top:0;
        right:10px;
        top:50%;
        margin-top:-8px;
        content: '\f00c';
    }
.cbp-spmenu .pushMenuSuperGroup{height:100%; padding-bottom:50px;overflow:auto; -webkit-overflow-scrolling:touch;}
.cbp-spmenu .pushMenuGroup{border-bottom:1px solid #ddd;padding-top:10px;}
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
	background-color: #f8f8f8;
	color: #777;
}

.cbp-spmenu a {
	color: #777;
	border-bottom: 1px solid #fff;
}

.cbp-spmenu a:hover {
	color: #5e5e5e;
	background-color: transparent;
	text-decoration: none;
}

.cbp-spmenu .cbp-title {
	background-color: #f8f8f8;
	font-size: 25px;
	padding: 10px;
	background-color: #fbfbfb;
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
#content {
	/* this line is needed fot center aligning isotope*/
	margin: 0 auto !important;
	margin-left: 0px;
}

h2 {
	font-size: 28px;
	font-weight: normal;
	color: #ccc;
	text-shadow: 0 1px 3px #333;
	font-family: 'GudeaRegular';
	margin: 0px;
	line-height: auto;
	padding-bottom: 10px;
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
}

h1.pageTitle {
	font-size: 2em;
	font-weight: normal;
	color: #fff;
	text-shadow: 0 1px 3px #333;
	text-align: left;
	margin: 0px;
	line-height: auto;
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


#wall {
	text-align: center;
}

.items {
	margin: 0 auto !important;
}

.container,.navbar-static-top .container,.navbar-fixed-top .container,.navbar-fixed-bottom .container
	{
	width: 100% !important;
	max-width: 100% !important;
	min-width: 100% !important;
}

.element {
	width: 180px;
	height: 295px;
	background-color: none !important;
	background: none !important;
	position: relative;
	overflow: visible;
	border-top-right-radius: none !important;
}

.element a{
display:block;
}


.element a:hover img, .element a:focus img, .element a:active img{
  -webkit-opacity: 0.5;
  -moz-opacity: 0.5;
  opacity: 0.5;
	background-color: none !important;
	background: none !important;
}

.element * {
	position: relative !important;
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
	bottom: 79px;
	right: -103px;
	padding: 0 10px;
	width: 120px;
	color: white;
	font-family: sans-serif;
	size: 11px;
}

.flex-viewport {
	padding-bottom: 5px;
}

.flexslider .ribbon {
	right: -42px;
	top: 202px;
	width: 150px;
}

.flexslider .liSlider {
	width: 180px !important;
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
overflow: hidden;
white-space: nowrap;
}

    
.peliAfiche {
	width: 180px;
	height: 260px;
	-moz-box-shadow: 0 1px 4px #333;
	-webkit-box-shadow: 0 1px 4px #333;
	box-shadow: 0 1px 4px #333;
}

.peliDesc img {
	opacity: 0.5;
}

/*afiche small usado en descargas*/
.peliAficheSmall {
	width: 130px;
	height: 174px;
	-moz-box-shadow: 0px 0px 15px #000;
	-webkit-box-shadow: 0px 0px 15px #000;
	box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.8);
}

	/* ------ BODY / MAIN LAYOUT ------- */

/* ------ MODAL POPUPS SERIES / PELI DETAIL ------- */
.modal {
	z-index: 1070;
}
.modal-title {
	font-size: 1.6em;
	color: #666;
}

.modal-header {
	padding: 9px 15px;
}

.modal-header .close {
	padding: 0px;
	margin-top: 0px;
	line-height: 34px;
}

.modal-footer {
	padding: 9px 15px;
}

.modal-body { /*overflow:hidden;*/
	
}

.modal-backdrop {
	z-index: 1065;
}

.ratingStars {
	color: orange;
	display: inline-block;
}

.ratingStars i {
	margin-left: 1px;
	font-size: 16px;
}

.nav-tabs {
	margin-bottom: 0px !important;
	margin-left: 0px !important;
}

.modalDetail {
	width: 85%;
}
.modalDetail table button {
	margin-top: -3px;
}

.modalDetail .table tbody>tr>td {
	padding: 0px 8px;
	/*line-height: 45px;*/
}
.modalDetail .alert{margin:15px;}
.modalDetail .table.tablaIndividual{margin-bottom:20px; border-bottom:1px solid #eee;}
.alert h4{font-size:18px; font-family:'GudeaBold';}
.alert .fa-ul i{line-height:20px;}

.modalDetail .modal-body .row {
	line-height: 26px;
}

.modalDetail .modal-body .row.detailSummary {
	line-height: 20px;
}

.aficheDetail { /*height:100% !important;*/
	height: auto !important;
	width: 100% !important;
	-moz-box-shadow: 0px 0px 5px #000;
	-webkit-box-shadow: 0px 0px 5px #000;
	box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.8);
}

.detailMainGroup {
	border-bottom: 1px solid #ccc;
	color: #666;
}

.detailMain {
	font-size: 120%;
	border-left: 1px solid #ccc; 
	padding-top: 3px;
	height: 35px;
	line-height: 30px;
}

.detailMainFirst {
	border-left: none;
}

.detailSecondGroup {
	border-bottom: 1px solid #ccc;
	color: #666;
}

.detailSecond {
	font-size: 100%;
	border-left: 1px solid #ccc;
	padding-top: 4px;
	padding-left: 5px;
}

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

.btnReproduciendo {
	margin-right: 5px;
}

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
}

.controlTitle {
	font-size: 2.3em;
	font-weight: normal;
	color: #fff;
	text-shadow: 0 1px 3px #333;
	text-align: left;
	padding-bottom:5px;
}

.controlAudioSub {
	text-align: left;
}

.controlAudioSub button {
	width: 200px;
	height: 60px;
	margin-top: 35px;
	margin-bottom: 30px;
	display: block;
}

.controlFlechas {
	width: 235px;
	margin-bottom: 20px;
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
	background-color: rgba(89, 117, 139, 0.2);
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2);
	border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.controlNavegacion {
	padding: 15px 0px;
}

.controlProgress {
	height: 60px;
	padding-top: 40px;
}

.progress-bar {
	background-color: #1f8c82;
}

.controlLenght {
	height: 60px;
	padding-top: 37px;
	padding-right: 15px;
	font-size: 1.3em;
	font-weight: bold;
}

#screenControl .controlContainer .btn-warning {
	width: 70px;
	height: 70px;
}

#screenControl .controlContainer .controlNavegacion .btn {
	width: 70px;
	height: 70px;
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
	font-size: 2em;
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
	font-size: 2em;
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
.chooseFile{color:white; font-size:2em; padding:15px; margin-top:5px;  text-shadow:0 1px 3px #333;}
.chooseFile .dropdown{display:inline-block;}
.chooseFile .dropdown .fa{display:inline;}
.chooseFile .dropdown > a{text-shadow:none;color:white; padding: 5px; text-decoration:none; margin:5px;background-color:rgba(0,0,0,0.7);border-radius:5px;}
.chooseFile .dropdown a:hover{color:#999; text-decoration:none;}

.chooseFile ul li{color:#333; text-shadow:none;}

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


.scrollItems{
          display: table-cell; }
          
.botonTodas {
	float: right;
	margin-right: 30px;
}

.botonTodas .btn-lg {
	font-size: 15px;
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
.pelisFinalizadas {
	padding: 10px 40px;
	margin-bottom: 20px;
}

.peliFinalizada {
	width: 140px;
	text-align: center;
	display: inline-block;
	margin-bottom: 10px;
}

.peliFinalizadaBt {
	padding: 5px;
	text-align: center;
}

.peliFinalizada button {
	margin: auto;
}

.peliFinalizada img {
	margin: auto;
}

.pelisDescargadas {
	padding: 10px 40px;
}

.peliDescargando {
	width: 170px;
	text-align: center;
	display: inline-block;
	margin-bottom: 10px;
}

.peliDescargandoProgress {
	padding: 5px;
	text-align: center;
}

.peliDescargando img {
	margin: auto;
}

.progress {
	margin-bottom: 0px !important;
	height: 15px;
}

.progress .bar {
	text-align: right;
	line-height: 16px;
}

#screenDescargas .nav-pills {
	margin-bottom: 10px;
	display: inline-block;
	height: 20px;
}

.noSliderResults {
	background-color: rgba(255, 255, 255, 0.1);
	color: #fff;
	text-shadow: 0 1px 1px #666;
	font-size: 18px;
	width: 95%;
	margin: auto;
	height: 295px;
	text-align: center;
	line-height: 180px;
	text-transform: uppercase;
	margin-bottom: 30px;
	padding: 4px;
}

/*-------- END DESCARGAS --------------*/

/*---------- FLEXSLIDER STYLE OVERRIDE -------*/
.flexslider {
	height: 295px;
	width: 95%;
	margin: 0 auto;
	margin-bottom: 30px;
	background: none repeat scroll 0 0;
	background-color: rgba(255, 255, 255, 0.1);
	border: none;
	padding: 4px;
	box-shadow: none;
}

.flex-direction-nav a {
	opacity: 1;
}

.flexslider .slides>li {
	position: relative;
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


.flexslider .flex-next {
}

.flexslider .flex-prev {
}

.flex-control-nav {
	margin-bottom: -10px;
}

@media ( max-width : 1024px) {
	.flex-control-paging li a {
		width: 15px;
		height: 15px;
	}
	.flexslider {
		margin-bottom: 40px;
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
.editAfiche {
	text-align: center;
}

.editAfiche .aficheImg {
	width: 200px;
	height: 280px;
	margin-bottom: 10px;
}

.editImagesButtons {
	text-align: center;
}

.editImagesButtons .btn {
	margin: auto;
	margin-bottom: 10px;
	display: block;
	width: 199px;
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
	-moz-box-shadow: 0px 0px 2px #000;
	-webkit-box-shadow: 0px 0px 2px #000;
	box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.8);
	background-color: rgba(0, 0, 0, 0.5);
	padding-top: 20px;
	padding-bottom: 20px;
}

/*---------- END EDIT PELICULA -------------*/

/*---------- TEXTO MARQUESINA -------------*/

p.slide-text26 {
	position: relative;
	animation: mymove26 2s infinite;
	-webkit-animation: mymove26 2s infinite; /*Safari and Chrome*/
    -moz-animation: mymove26 2s infinite;
    -ms-animation: mymove26 2s infinite;
    -o-animation: mymove26 2s infinite;
    width: auto;
	white-space: nowrap;
}

p.slide-text30 {
	position: relative;
	animation: mymove30 5s infinite;
	-webkit-animation: mymove30 5s infinite; /*Safari and Chrome*/
    -moz-animation: mymove30 2s infinite;
    -ms-animation: mymove30 2s infinite;
    -o-animation: mymove30 2s infinite;
	width: auto;
	white-space: nowrap;
}

p.slide-text35 {
	position: relative;
	animation: mymove35 5s infinite;
	-webkit-animation: mymove35 5s infinite; /*Safari and Chrome*/
    -moz-animation: mymove35 2s infinite;
    -ms-animation: mymove35 2s infinite;
    -o-animation: mymove35 2s infinite;
	width: auto;
	white-space: nowrap;
}

p.slide-text40 {
	position: relative;
	animation: mymove40 5s infinite;
	-webkit-animation: mymove40 5s infinite; /*Safari and Chrome*/
    -moz-animation: mymove40 2s infinite;
    -ms-animation: mymove40 2s infinite;
    -o-animation: mymove40 2s infinite;
	width: auto;
	white-space: nowrap;
}

p.slide-text41 {
	position: relative;
	animation: mymove41 5s infinite;
	-webkit-animation: mymove41 5s infinite; /*Safari and Chrome*/
    -moz-animation: mymove41 2s infinite;
    -ms-animation: mymove41 2s infinite;
    -o-animation: mymove41 2s infinite;
	width: auto;
	white-space: nowrap;
}
@keyframes mymove26 {	from {right: 0px;}  to {right: 18px;} }
@-webkit-keyframes mymove26 /*Safari and Chrome*/  {	from {right: 0px;}  to {right: 18px;} }
@-moz-keyframes mymove26 { from {right: 0px;}  to {right: 18px;} }
@-ms-keyframes mymove26 { from {right: 0px;}  to {right: 18px;} }
@-o-keyframes mymove26 { from {right: 0px;}  to {right: 18px;} }


@keyframes mymove30  {	from {right: 0px;}  to {right: 70px;} }
@-webkit-keyframes mymove30 /*Safari and Chrome*/  {	from {right: 0px;}  to {right: 70px;} }
@-moz-keyframes mymove30 { from {right: 0px;}  to {right: 70px;} }
@-ms-keyframes mymove30 { from {right: 0px;}  to {right: 70px;} }
@-o-keyframes mymove30 { from {right: 0px;}  to {right: 70px;} }

@keyframes mymove35  {	from {right: 0px;}  to {right: 80px;} }
@-webkit-keyframes mymove35 /*Safari and Chrome*/  {	from {right: 0px;}  to {right: 80px;} }
@-moz-keyframes mymove35 { from {right: 0px;}  to {right: 80px;} }
@-ms-keyframes mymove35 { from {right: 0px;}  to {right: 80px;} }
@-o-keyframes mymove35 { from {right: 0px;}  to {right: 80px;} }

@keyframes mymove40  {	from {right: 0px;}  to {right: 100px;} }
@-webkit-keyframes mymove40 /*Safari and Chrome*/  {	from {right: 0px;}  to {right: 100px;} }
@-moz-keyframes mymove40 { from {right: 0px;}  to {right: 100px;} }
@-ms-keyframes mymove40 { from {right: 0px;}  to {right: 100px;} }
@-o-keyframes mymove40 { from {right: 0px;}  to {right: 100px;} }

@keyframes mymove41  {	from {right: 0px;}  to {right: 150px;} }
@-webkit-keyframes mymove41 /*Safari and Chrome*/  {	from {right: 0px;}  to {right: 150px;} }
@-moz-keyframes mymove41 { from {right: 0px;}  to {right: 150px;} }
@-ms-keyframes mymove41 { from {right: 0px;}  to {right: 150px;} }
@-o-keyframes mymove41 { from {right: 0px;}  to {right: 150px;} }

/*-------------- END TEXTO MARQUESINA -------------- */

/*-------------------------------------------------------------------------------*/
/*------------------------------------------------------------------------------*/
/*------------------------   Estilos RESPONSIVE    ----------------------------*/
/*----------------------------------------------------------------------------*/
/*---------------------------------------------------------------------------*/

/* Large desktop */
@media ( min-width : 1024px) {
	.element {
		width: 180px;
		height: 295px;
		background-color: none !important;
		background: none !important;
	}
	.peliAfiche {
		width: 180px;
		height: 260px;
	}
	.controlContainer {
		/*width:70%;*/
		
	}
		
}

/*ALL MOBILE*/
@media ( max-width : 1024px){

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
@media ( min-width : 769px) and (max-width: 1024px) {
	.controlContainer {
		width: 100%;
	}
	.element {
		width: 180px;
		height: 295px;
		background-color: none !important;
		background: none !important;
	}
	.peliAfiche {
		width: 180px;
		height: 260px;
	}
	.ribbon {
		right: -103px;
		bottom: 84px;
	}
		.devicesHeader .nav-tabs{font-size:115%;}

	.rowControlVariable{width:99%; margin:auto;}
	.controlNavegacion{text-align:center;}
		
}

/*IPAD PORTRAIT*/
@media ( max-width : 768px) {
	.navbar .nav>li>a {
		padding: 10px 10px 10px;
	}
	.element {
		width: 220px;
		height: 355px;
		background-color: none !important;
		background: none !important;
	}
	.peliAfiche {
		width: 220px;
		height: 320px;
	}
	.ribbon {
		right: -143px;
		bottom: 83px;
	}
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
margin-right: -15px;
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


@media only screen and (max-width: 767px) { /*esto arma el menu mobile*/
	/* .mobile-two .span2 { width: 50% !important; float: left; padding: 0 15px; }*/
}


</style>