function validateform(form)
	{
		
		
	   if(document.form1.nic.value.length!=10 && document.form1.nic.value.length!=12 )
		{
			alert("NIC number is wrong!");
			return false;
		}
		else if(!/^([0-9]{9}[v|V]|[0-9]{12})$/.test(document.form1.nic.value))
		{
			alert("Please enter valid nic number");
			return false;
		}

		else if(!/^[a-zA-Z ]*$/.test(document.form1.fname.value))
		{
			alert("First name must contain only alphabets");
			return false;
		}

		else if(!/^[a-zA-Z ]*$/.test(document.form1.lname.value))
		{
			alert("Last name must contain only alphabets");
			return false;
		}
		else if(isNaN(document.form1.mobile.value))
		{
		    alert("Mobile number should be numeric");
		    return false; 
		}
		else if(document.form1.mobile.value.length!=10)
		{
	        alert("Mobile length is wrong!");
		    return false;
		}
		else if(!/^(?:7|0|(?:\+94))[0-9]{8,9}$/.test(document.form1.mobile.value)) 
		{
		    alert("Please enter a valid mobile number!");
		    return false; 
		}
		 else if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(document.form1.email.value))
        {
            alert("You have entered an invalid email address!")
            return false;
         }
		else
		{
			return true;
		}
		

}