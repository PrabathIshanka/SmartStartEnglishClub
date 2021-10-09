// JavaScript Document
function validateform(form)
	{
		if(document.changePassForm.txtNew.value.length<8) 
		{
			alert("Password must contain atleast 8 characters");
			return false;
		}
		else if(!/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(document.changePassForm.txtNew.value))
		{
			alert("Password must contain atleast one letter and one number");
			return false;
		}
		else if(document.changePassForm.txtNew.value!=document.changePassForm.txtConfirm.value)
		{
			alert("Password and confirm password do not match");
			return false; 
		}
		else
		{
			return true;
		}
	}