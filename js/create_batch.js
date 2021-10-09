
// JavaScript Document

function validateform(form)
	{
		
	    if(document.createBatchForm.cmbCourse.selectedIndex==0)
	      {  alert("Please select a Course");
	         createBatchForm.cmbCourse.focus();
	         return false;
	      }
	      
		  else if(document.createBatchForm.cmbTeacher.selectedIndex==0)
	      {  alert("Please select a Teacher");
	         createBatchForm.cmbTeacher.focus();
	         return false;
	      }
	      else if(isNaN(document.createBatchForm.startDate.value))
		  {
		    alert("Start Date should be numeric");
		    createBatchForm.startDate.focus();
		    return false; 
		  }
		   else if(document.createBatchForm.day.selectedIndex==0)
	      {  alert("Please select a Day");
	         createBatchForm.day.focus();
	         return false;
	      }
	       else if(isNaN(document.createBatchForm.maxStd.value))
	      {
		    alert("Maximum Students should be numeric");
		    createBatchForm.maxStd.focus();
		    return false; 
		  }
	      else
		  {
			return true;
		  }
		
		
		

	}