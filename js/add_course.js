
// JavaScript Document

function validateform(form)
	{
		if(document.addCourseform.courseNo.value.length!=2 ) {
			alert("Course number must contain only 2 letters");
			return false;
		}
		else if(!/^[a-zA-Z]+$/.test(document.addCourseform.courseNo.value))
		{
			alert("Course number must contain only alphabets");
			return false;
		}

		else if(!/^[a-zA-Z ]*$/.test(document.addCourseform.name.value))
		{
			alert("Course name must contain only alphabets");
			return false;
		}
		
		
		else
		{
			return true;
		}
		

	}