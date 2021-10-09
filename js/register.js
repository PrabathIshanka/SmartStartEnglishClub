// JavaScript Document

function validateform(form)
	{
		var today = new Date();
			
		var birthDate = new Date(document.regForm.bDate.value);
		var age = today.getFullYear() - birthDate.getFullYear();
		var m = today.getMonth() - birthDate.getMonth();
		if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
			age--;
		}    
		
		if(!(/^([0-9]{9}[x|X|v|V])$/.test(document.regForm.txtNIC.value) || /^([0-9]{12})$/.test(document.regForm.txtNIC.value)))
		{
			alert("Please enter a valid NIC number");
			return false;
		}
		else if(!/^[a-zA-Z ]*$/.test(document.regForm.txtFName.value))
		{
			alert("First name must contain only alphabets");
			return false;
		}
		else if(!/^[a-zA-Z ]*$/.test(document.regForm.txtLName.value))
		{
			alert("Last name must contain only alphabets");
			return false;
		}
		else if(age<16)
		{
			alert("Your age must be 16 or over");
			return false;
		}
				  //^0[0-9]{9,10}$   ^(?:7|0|(?:\+94))[0-9]{8,9}$
		else if(!/^07[0,1,2,5,6,7,8][0-9]{7}$/.test(document.regForm.txtMobile.value)) 
		{
		alert("Please enter a valid mobile number");
		return false; 
		}
		/*else if(document.regForm.txtMobile.value.length!=10)
		{
			alert("Mobile length is wrong!");
			return false;
		}*/
		
		else if(document.regForm.pDate.value>new Date().toISOString().slice(0, 10))
		{
			alert("Payment date cannot be after today's date!");
			return false;
		}
		else if(!document.getElementById('check_1').checked)
		{
			alert("Please check the declaration checkbox at the end of the form");
			return false;
		}
		else
		{
			return true;
		}
		

	}