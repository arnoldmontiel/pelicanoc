function ChangeBG(image)
{
	if (document.body) {
		$("body").css("background-image",'url('+image+')');
    	//document.body.style.backgroundImage = 'url('+image+')';
	}
}	
