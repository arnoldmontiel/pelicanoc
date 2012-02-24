function ChangeBG(path,image)
{
	if(image!="")
	{
		if (document.body) {
			$("body").css("background-image",'url('+path+image+')');
	    	//document.body.style.backgroundImage = 'url('+image+')';
		}
	}
}	
