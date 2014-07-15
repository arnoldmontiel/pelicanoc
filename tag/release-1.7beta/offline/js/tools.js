function ChangeBG(path,image)
{
	if(image!="")
	{
		if (document.body) {
			$("body").css("background-image",'url('+path+image+')');
			$("body").addClass("backdrop-on");
//			$('body').css('padding-top','0px');
//			$('body').css('padding-bottom','0px');

	    	//document.body.style.backgroundImage = 'url('+image+')';
		}
	}
}	


function CloseCurtains()
{
	$('.leftcurtain').removeClass('hideClass');
	$('.rightcurtain').removeClass('hideClass');

	$(".leftcurtain").stop().animate({width:'50%'}, 2000 );
	$(".rightcurtain").stop().animate({width:'51%'}, 2000 , function()
	{
		$(".leftcurtain").addClass('hideClass');
		$(".rightcurtain").addClass('hideClass');		
	});
}
function OpenCurtains(speed)
{
	$('.leftcurtain').removeClass('hideClass');
	$('.rightcurtain').removeClass('hideClass');

	$(".leftcurtain").stop().animate({width:'0px'}, speed );
	$(".rightcurtain").stop().animate({width:'0px'},speed, function()
	{
		$(".leftcurtain").addClass('hideClass');
		$(".rightcurtain").addClass('hideClass');		
	});
}