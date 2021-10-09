function validateform(form)

{

        if(!/^[a-zA-Z]+$/.test(document.contactUsform.fullname.value))
		{
			alert("Full name must contain only alphabets");
			return false;
  		}
  

         else if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(document.contactUsform.email.value))
        {
            alert("You have entered an invalid email address!")
            return false;
         }
		else
		{
			return true;
		}
		




}