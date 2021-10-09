function validateform(form)
	{
	
		if(!/^[a-zA-Z ]*$/.test(document.upd_del_cform.name.value))
		{
			alert("Course name must contain only alphabets");
			document.upd_del_cform.name.focus();
			return false;
		}
		
		else if(isNaN(document.upd_del_cform.duration.value))
		{
		    alert("Duration should be numeric");
		    document.upd_del_cform.duration.focus();
		    return false; 
		}
		else if(isNaN(document.upd_del_cform.fee.value))
		{
		   alert("Fee should be numeric");
		   document.upd_del_cform.fee.focus();
		   return false; 
		}
		
		else
		{
			return true;
		}
		

	}