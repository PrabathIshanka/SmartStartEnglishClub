function validateform(form)
	{
		
	   if(document.addTeacherform.nic.value.length!=10 && document.addTeacherform.nic.value.length!=12 )
		{
			alert("Please enter a valid NIC number");
			return false;
		}
		else if(!/^[a-zA-Z ]*$/.test(document.addTeacherform.fname.value))
		{
			alert("First name must contain only alphabets");
			return false;
		}
		else if(!/^[a-zA-Z ]*$/.test(document.addTeacherform.lname.value))
		{
			alert("Last name must contain only alphabets");
			return false;
		}
		
		else if(document.addTeacherform.mobile.value.length!=10)
		{
	        alert("Mobile length is wrong!");
		    return false;
		}
		else if(!/^(?:7|0|(?:\+94))[0-9]{8,9}$/.test(document.addTeacherform.mobile.value)) 
		{
		    alert("Please enter a valid mobile number!");
		    return false; 
		}
		 
		else
		{
			return true;
		}
		
	}
