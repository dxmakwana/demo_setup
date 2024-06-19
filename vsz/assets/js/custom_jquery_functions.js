function UpdateAjaxDropDown(els,elt)
	{
		if($(els).length && $(elt).length && $(els).length>0 && $(elt).length>0)
		{
		    var source_name=$(els).attr("name");
		    if($(els).data('check_val') && $(els).data('check_val')!="")
		    {
		        var check_param=$(els).data('check_val');
		    }else
		    {
		        var check_param=source_name;
		    }
		    if($(elt).data("selected-attr") && $(elt).data("selected-attr").length && $(elt).data("selected-attr").length>0)
		    {
		    	var selected_attr=$(elt).data("selected-attr");
		    }else
		    {
		    	var selected_attr="";
		    }
		    if($(elt).data("selected-val") && $(elt).data("selected-val").length && $(elt).data("selected-val").length>0)
		    {
		    	var selected_val=$(elt).data("selected-val");
		    }else
		    {
		    	var selected_val="";
		    }
        //console.log(source_name);
		    var method="POST";
		    var submit_val=$(els).val();

		    var url="process/ajax_action_php_function.php";
		    var action=$(els).data('action');
		    if(submit_val!="")
		    {
		        var form_data={};
		        form_data[check_param]=submit_val;
		        form_data['action']=action;
		        if(selected_attr!="" && selected_val!="")
		        {
		        	form_data[selected_attr]=selected_val;
		        }
            // console.log(form_data);
		        //console.log(form_data)
		        $.ajax({
		            type: method,
		            url: url,
		            data: form_data,
		            success: function (data) {
		            	if(data!="")
		            	{
		            		//console.log(data);
		            		data=JSON.parse(data);
		            		// console.log(data);	
		            		if(data.error_code!="0")
		            		{
		            			$(elt).html(data.data);
		            		}
		            	}
		            }
			    });     

		    }
		}
	}
      
	
	function SetEqualHeight(class_name)
	{
	      var total_partners=$("."+class_name).length;
	      var height_arr=[];
	      for(var i=0;i<total_partners;i++)
	      {
	            height_arr[i]=$("."+class_name)[i].clientHeight;
	      }
	      var max_height=Math.max(...height_arr);
	      max_height=max_height+5;
	      $("."+class_name).height(max_height);
	}
	//validate email
	function validateEmail(email)
	{
	        //var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	            var reg=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	        if (reg.test(email) == false) 
	        {
	           
	            return false;
	        }

	        return true;

	}

$(':input[type="email"]').change(function () 
  { 
    // console.log($(this).val());
    var cur_ele_val=$(this).val();
    if(cur_ele_val!="")
    {
      if(!validateEmail(cur_ele_val))
      {
        $(this).addClass("is-invalid");
        $(this).nextAll('.help').text('Invalid Email');
        $(this).nextAll('.help').addClass('text-danger');
        $(this).focus();
        // $(this).attr("")
        // $(this).val("");
      }else
      {
        $(this).removeClass("is-invalid");
        $(this).nextAll('.help').text('');
      }
      
    }

    
  });

  $(':input[type="email"]').blur(function () 
  { 
    // console.log($(this).val());
    var cur_ele_val=$(this).val();
    if(cur_ele_val!="")
    {
      if(!validateEmail(cur_ele_val))
      {
        $(this).addClass("is-invalid");
        $(this).nextAll('.help').text('Invalid Email');
        $(this).nextAll('.help').addClass('text-danger');
        $(this).focus();
        // $(this).attr("")
        // $(this).val("");
      }else
      {
        $(this).removeClass("is-invalid");
        $(this).nextAll('.help').text('');
      }
      
    }

    
  });
  function validateMobile(mobile)
  {
          //var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
          var reg=/^[0][1-9]\d{9}$|^[1-9]\d{9}$/;

          if (reg.test(mobile) == false) 
          {
             
              return false;
          }

          return true;

  }
  function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if ( key < 48 || key > 57 ) {
        return false;
    } else {
      return true;
    }
}
function validateMobileNumber(event) 
{
    // console.log($(this).val());
    
    var key = window.event ? event.keyCode : event.which;
    // console.log(key);
    if ( (key >= 65 && key <= 90) || (key >= 48 && key <= 57) || (key >= 106 && key <= 111) || (key >= 186 && key <= 190) || (key >= 219 && key <= 222) ) 
    {
        if($(this).val().length>9)
        {
            return false;
        }else
        {
            return true;    
        }
        // console.log($(this).val());
        // console.log(key);
        
        
    } 
    else 
    { 
        // console.log('true');
      return false;
      
    }
}

//automatic form validation for perticular form input elements
$(document).ready(function() 
{
      // $('input[type=tel]').keypress(validateMobileNumber);

      if($(".validate-form").length)
      {
            var validate_form_class_ele=$(".validate-form");
            var total_forms=validate_form_class_ele.length;
            var allowed_input_types=["text","email","number","phone","radio","password","date","datetime","datetime-local","file","hidden","password","checkbox","tel","time","url","textarea","select-multiple","select-one"];
            //var form_ele_arr=array();
            var all_form_ele_arr=[];
            for (var i = 0; i < total_forms; i++) 
            {
                  var current_form=validate_form_class_ele[i];
                  if($(current_form).attr("id") && $(current_form).attr("id")!="")
                  {
                        var current_form_id=$(current_form).attr("id"); 
                  }else
                  {
                        var current_form_id="form_"+i;
                        $(current_form).attr("id",current_form_id);
                  }
                  var err_msg_ele="error-msg";
                  if($(current_form).data("err_msg_ele") && $(current_form).data("err_msg_ele")!="" && $(current_form).data("err_msg_ele").length && $(current_form).data("err_msg_ele").length>0 && $(current_form).data("err_msg_ele")!=undefined)
                  {
                  	err_msg_ele=$(current_form).data("err_msg_ele");
                  }
                   all_form_ele_arr[current_form_id]=[];     
                  var current_form_elements_raw_arr=$("#"+current_form_id+" :input");
                  var form_ele_arr=[];
                  
                  var form_ele_change_arr=[];
                  if(current_form_elements_raw_arr.length && current_form_elements_raw_arr.length>0)
                  {
                        for (var fre = 0; fre < current_form_elements_raw_arr.length; fre++)
                        {
                              //console.log($(current_form_elements_raw_arr[fre]));
                              var cur_ele_arr=[];
                              var onchange_ele_arr=[];
                              var current_input_type=current_form_elements_raw_arr[fre].type;   
                              if($(current_form_elements_raw_arr[fre]).data('is_validate') && $(current_form_elements_raw_arr[fre]).data('is_validate')=="1" && jQuery.inArray(current_input_type, allowed_input_types) !== -1)
                              {           
                                    var current_input_name=$(current_form_elements_raw_arr[fre]).attr("name");
                                    if(current_form_elements_raw_arr[fre].id && current_form_elements_raw_arr[fre].id!="")
                                    {
                                          var current_input_id=$(current_form_elements_raw_arr[fre]).attr("id");; 
                                    }else
                                    {
                                          var current_input_id=current_form_id+"_input_"+current_input_type+"_"+fre;
                                          $(current_form_elements_raw_arr[fre]).attr("id",current_input_id);
                                    }
                                    
                                    cur_ele_arr['id']=current_input_id;
                                    cur_ele_arr['type']=current_input_type;
                                    form_ele_arr.push(cur_ele_arr);
                                    (all_form_ele_arr[current_form_id]).push(cur_ele_arr);
                              }

                              if($(current_form_elements_raw_arr[fre]).data('is_check_change') && $(current_form_elements_raw_arr[fre]).data('is_check_change')=="1" && jQuery.inArray(current_input_type, allowed_input_types) !== -1)
                              {           
                                    var current_input_name=$(current_form_elements_raw_arr[fre]).attr("name");
                                    if(current_form_elements_raw_arr[fre].id && current_form_elements_raw_arr[fre].id!="")
                                    {
                                          var current_input_id=$(current_form_elements_raw_arr[fre]).attr("id");; 
                                    }else
                                    {
                                          var current_input_id=current_form_id+"_input_"+current_input_type+"_"+fre;
                                          $(current_form_elements_raw_arr[fre]).attr("id",current_input_id);
                                    }
                                    
                                    onchange_ele_arr['id']=current_input_id;
                                    onchange_ele_arr['type']=current_input_type;
                                    form_ele_change_arr.push(onchange_ele_arr);
                              }
                        }
                  }
                  
                  //check validation onchange
                  if(form_ele_change_arr.length>0)
                  {
                        for (var fic = 0; fic < form_ele_change_arr.length; fic++) 
                        {
                              var current_input_ele_id=form_ele_change_arr[fic]['id'];
                              var current_input_ele_type=form_ele_change_arr[fic]['type'];
                              var untrimmed_val=$("#"+current_input_ele_id).val();
                              var cur_ele_val=untrimmed_val.trim();
                              $("#"+current_input_ele_id).val(cur_ele_val);
                              $("#"+current_input_ele_id).change(function(){
                                    if(current_input_ele_type=="text" || current_input_ele_type=="url" || current_input_ele_type=="phone" )
                                    {
                                          if($("#"+current_input_ele_id).val()=="")
                                          {
                                                error = 1;
                                                error_msg="This Field Must Required.";
                                                if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                                {
                                                      error_msg=$("#"+current_input_ele_id).data('error_msg');
                                                }
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                }
                                                $("#"+current_input_ele_id).css("border","1px solid red");
                                          }else
                                          {
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html('');
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html('');
                                                }
                                                $("#"+current_input_ele_id).css("border","");
                                          }
                                    }else if( current_input_ele_type=="tel")
                                    {
                                          if($("#"+current_input_ele_id).val()=="")
                                          {
                                                error = 1;
                                                error_msg="Mobile Number Must Required.";
                                                if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                                {
                                                      error_msg=$("#"+current_input_ele_id).data('error_msg');
                                                }
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                }
                                                $("#"+current_input_ele_id).css("border","1px solid red");
                                          }else
                                          {
                                                if(validateMobile($("#"+current_input_ele_id).val()))
                                                {
                                                      if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                      {
                                                            $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html('');
                                                      }else
                                                      {
                                                            $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html('');
                                                      }
                                                      $("#"+current_input_ele_id).css("border","");
                                                      
                                                }else
                                                {
                                                      error_msg="Please Enter Valid Mobile Number";
                                                      error = 1;
                                                      if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                      {
                                                            $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                      }else
                                                      {
                                                            $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                      }
                                                      $("#"+current_input_ele_id).css("border","1px solid red");
                                                }
                                                
                                          }
                                    }else if(current_input_ele_type=="password")
                                    {
                                          if($("#"+current_input_ele_id).val()=="")
                                          {
                                                error = 1;
                                                error_msg="Password Must Required.";
                                                //(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,15})$  ---- forcheck valid password with alphanumeric check
                                                if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                                {
                                                      error_msg=$("#"+current_input_ele_id).data('error_msg');
                                                }
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                }
                                                $("#"+current_input_ele_id).css("border","1px solid red");
                                          }else
                                          {
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html('');
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html('');
                                                }
                                                $("#"+current_input_ele_id).css("border","");
                                          }
                                    }else if(current_input_ele_type=="number")
                                    {
                                          if($("#"+current_input_ele_id).attr("min") && $("#"+current_input_ele_id).attr("min")!="")
                                          {
                                                var current_min_val=$("#"+current_input_ele_id).attr("min");      
                                          }else
                                          {
                                                var current_min_val="0"
                                          }
                                          if($("#"+current_input_ele_id).attr("max") && $("#"+current_input_ele_id).attr("max")!="" && $("#"+current_input_ele_id).attr("max")>current_min_val)
                                          {
                                                var current_max_val=$("#"+current_input_ele_id).attr("max");
                                          }else
                                          {
                                                var current_max_val="0";
                                          }
                                                
                                          if($("#"+current_input_ele_id).val()=="" || $("#"+current_input_ele_id).val()<="0" || $("#"+current_input_ele_id).val()<current_min_val || $("#"+current_input_ele_id).val()>current_max_val)
                                          {
                                                error = 1;
                                                if($("#"+current_input_ele_id).val()=="" || $("#"+current_input_ele_id).val()<="0")
                                                {     
                                                      error_msg="This Field Must Required.";
            
                                                      if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                                      {
                                                            error_msg=$("#"+current_input_ele_id).data('error_msg');
                                                      }
                                                      if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                      {
                                                            $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                      }else
                                                      {
                                                            $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                      }
                                                }else if($("#"+current_input_ele_id).val()<current_min_val)
                                                {
                                                      error_msg="Enter Value greater than ".current_min_val;
                                                      if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                      {
                                                            $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                      }else
                                                      {
                                                            $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                      }
                                                }else if($("#"+current_input_ele_id).val()<current_min_val)
                                                {
                                                      error_msg="Enter Value smaller than ".current_max_val;
                                                      if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                      {
                                                            $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                      }else
                                                      {
                                                            $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                      }
                                                }
                                                $("#"+current_input_ele_id).css("border","1px solid red");


                                          }else
                                          {
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html('');
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html('');
                                                }
                                                $("#"+current_input_ele_id).css("border","");
                                          }
                                    }else if(current_input_ele_type=="date" || current_input_ele_type=="datetime" || current_input_ele_type=="datetime-local" || current_input_ele_type=="time")
                                    {
                                          if($("#"+current_input_ele_id).val()=="")
                                          {
                                                error = 1;
                                                error_msg="This Field Must Required.";
                                                if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                                {
                                                      error_msg=$("#"+current_input_ele_id).data('error_msg');
                                                }
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                }
                                                $("#"+current_input_ele_id).css("border","1px solid red");
                                          }else
                                          {
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html('');
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html('');
                                                }
                                                $("#"+current_input_ele_id).css("border","");
                                          }
                                    }else if(current_input_ele_type=="textarea")
                                    {
                                          if($.trim($("#"+current_input_ele_id).val())=="")
                                          {
                                                error = 1;
                                                error_msg="This Field Must Required.";
                                                if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                                {
                                                      error_msg=$("#"+current_input_ele_id).data('error_msg');
                                                }
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                }
                                                $("#"+current_input_ele_id).css("border","1px solid red");
                                          }else
                                          {
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html('');
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html('');
                                                }
                                                $("#"+current_input_ele_id).css("border","");
                                          }     
                                    }else if(current_input_ele_type=="select-multiple" || current_input_ele_type=="select-one")
                                    {
                                          if($("#"+current_input_ele_id).val()=="" )
                                          {
                                                error = 1;
                                                error_msg="This Field Must Required.";
                                                if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                                {
                                                      error_msg=$("#"+current_input_ele_id).data('error_msg');
                                                }
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                }
                                                $("#"+current_input_ele_id).css("border","1px solid red");
                                          }else
                                          {
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html('');
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html('');
                                                }
                                                $("#"+current_input_ele_id).css("border","");
                                          }     
                                    }else if(current_input_ele_type=="hidden")
                                    {
                                      var is_valid_hidden_field="0";//focus-ele
                                var hidden_focus_field=$("#"+current_input_ele_id);
                                if($("#"+current_input_ele_id).data('focus-ele') && $("#"+current_input_ele_id).data('focus-ele')!="")
                                {
                                  var data_focus_hidden_field_ele=$("#"+current_input_ele_id).data('focus-ele');
                                  hidden_focus_field=$("#"+data_focus_hidden_field_ele)
                                }
                                if($("#"+current_input_ele_id).data('is_numeric') && $("#"+current_input_ele_id).data('is_numeric')=="1")
                                {
                                  if($("#"+current_input_ele_id).val()!="" && $("#"+current_input_ele_id).val()>"0")
                                  {
                                    is_valid_hidden_field="1";
                                  }
                                }else
                                {
                                  if($("#"+current_input_ele_id).val()!="")
                                  {
                                    is_valid_hidden_field="1";
                                  }
                                }
                                //console.log(hidden_focus_field);
                                    //if($("#"+current_input_ele_id).val()=="" || $("#"+current_input_ele_id).val()=="0")
                                    if(is_valid_hidden_field=="0")
                                    {
                                          error = 1;
                                          error_msg="This Field Must Required.";
                                          if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                          {
                                                error_msg=$("#"+current_input_ele_id).data('error_msg');
                                          }
                                          if(hidden_focus_field.nextAll("."+err_msg_ele) && hidden_focus_field.nextAll("."+err_msg_ele).length=="1")
                                          {
                                                hidden_focus_field.nextAll("."+err_msg_ele).html(error_msg);
                                                //console.log(hidden_focus_field.nextAll("."+err_msg_ele));
                                          }else
                                          {
                                                hidden_focus_field.prev().nextAll("."+err_msg_ele).html(error_msg);
                                          }
                                          hidden_focus_field.css("border","1px solid red");
                                          //console.log(hidden_focus_field);
                                    }else
                                    {
                                          if(hidden_focus_field.nextAll("."+err_msg_ele) && hidden_focus_field.nextAll("."+err_msg_ele).length=="1")
                                          {
                                                hidden_focus_field.nextAll("."+err_msg_ele).html('');
                                          }else
                                          {
                                                hidden_focus_field.prev().nextAll("."+err_msg_ele).html('');
                                          }
                                          hidden_focus_field.css("border","");
                                    }     
                                    }else if(current_input_ele_type=="email")
                                    {
                                          if($("#"+current_input_ele_id).val()=="")
                                          {
                                                error = 1;
                                                error_msg="Email Must Required.";
                                                if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                                {
                                                      error_msg=$("#"+current_input_ele_id).data('error_msg');
                                                }
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                }
                                                $("#"+current_input_ele_id).css("border","1px solid red");
                                          }else
                                          {
                                                if(validateEmail($("#"+current_input_ele_id).val()))
                                                {
                                                      if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                      {
                                                            $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html('');
                                                      }else
                                                      {
                                                            $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html('');
                                                      }
                                                      $("#"+current_input_ele_id).css("border","");
                                                      
                                                }else
                                                {
                                                      error_msg="Please Enter Valid Email";
                                                      if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                      {
                                                            $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                      }else
                                                      {
                                                            $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                      }
                                                      $("#"+current_input_ele_id).css("border","1px solid red");
                                                }
                                                
                                          }
                                    }else if(current_input_ele_type=="file")
                                    {
                                        var other_check_field_val="";
                                        if($("#"+current_input_ele_id).data("old_field") && $("#"+current_input_ele_id).data("old_field")!=undefined )
                                        {
                                          var other_check_field=$("#"+current_input_ele_id).data("old_field");
                                          if($("#"+other_check_field).length)
                                          {
                                            other_check_field_val=$("#"+other_check_field).val();
                                          }
                                        }
                                         if ($("#"+current_input_ele_id).val()=="" && $("#"+current_input_ele_id).files && $("#"+current_input_ele_id).files[0] && other_check_field_val=="") 
                                         {
                                                error_msg="Please Upload Valid File.";
                                                

                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                }
                                                $("#"+current_input_ele_id).css("border","1px solid red");
                                         }else
                                         {
                                                var input=$("#"+current_input_ele_id);
                                                if($(input).data('allowed') && $(input).data('allowed')!="")
                                                {
                                                      //validate allowed type of content
                                                      var allowed=$(input).data('allowed');
                                                      
                                                      var allowed_types=JSON.parse(atob(allowed));
                                                      if(allowed_types.length>0)
                                                      {
                                                            var upload_file_name=input.files[0].name;
                                                            var name_arr=upload_file_name.split('.')
                                                            var extension=name_arr[name_arr.length-1];
                                                            if($.inArray( extension, allowed_types )=="-1")
                                                            {
                                                                  error_msg="Uploaded file type isn't valid.";
                                                                  if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                                  {
                                                                        $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                                  }else
                                                                  {
                                                                        $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                                  }
                                                                  $("#"+current_input_ele_id).css("border","1px solid red");
                                                                  $(input).val("");
                                                            }
                                                      }
                                                      
                                                }else
                                                {
                                                      if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                      {
                                                            $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html("");
                                                      }else
                                                      {
                                                            $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html("");
                                                      }
                                                      $("#"+current_input_ele_id).css("border","");      
                                                }
                                                
                                         }                                    
                                    }else if(current_input_ele_type=="checkbox")
                                    {
                                          if($("#"+current_input_ele_id).prop('checked') != true)
                                          {
                                                error_msg="Please check this checkbox";
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                }
                                                $("#"+current_input_ele_id).css("border","1px solid red");
                                          }else
                                          {
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html("");
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html("");
                                                }
                                                $("#"+current_input_ele_id).css("border","");
                                          }                             
                                    }else if(current_input_ele_type=="radio")
                                    {
                                          var current_input_name=$("#"+current_input_ele_id).attr('name');
                                          if($("[name="+current_input_ele_id+"]").prop('checked') != true)
                                          {
                                                error_msg="please check one of above radios";
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                }
                                                $("#"+current_input_ele_id).css("border","1px solid red");
                                          }else
                                          {
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html("");
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html("");
                                                }
                                                $("#"+current_input_ele_id).css("border","");
                                          }
                                    }
                              });
                        }
                  }
                  

                  //check validation on form submission
                  /*$("#"+current_form_id).submit(function(){
                        
                        if(form_ele_arr.length>0)
                        {
                              
                        }
                        
                        
                  });*/

            }
            //console.log(all_form_ele_arr);      
            $("form").submit(function(){
                  var error = 0;
                  var current_submit_form_id=$(this).attr("id");
                  //console.log(current_submit_form_id);
                  if(all_form_ele_arr[current_submit_form_id]&& all_form_ele_arr[current_submit_form_id].length  && all_form_ele_arr[current_submit_form_id].length>0)
                  {
                        //console.log(all_form_ele_arr[current_submit_form_id]); 
                        for (var fi = 0; fi < all_form_ele_arr[current_submit_form_id].length; fi++) 
                        {
                              var current_input_ele_id=all_form_ele_arr[current_submit_form_id][fi]['id'];
                              var current_input_ele_type=all_form_ele_arr[current_submit_form_id][fi]['type'];

                              var untrimmed_val=$("#"+current_input_ele_id).val();
                              var cur_ele_val=untrimmed_val;
                              $("#"+current_input_ele_id).val(cur_ele_val);

                              if(current_input_ele_type=="text" || current_input_ele_type=="url" || current_input_ele_type=="phone" )
                                    {
                                          if($("#"+current_input_ele_id).val()=="")
                                          {
                                                error = 1;
                                                error_msg="This Field Must Required.";
                                                if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                                {
                                                      error_msg=$("#"+current_input_ele_id).data('error_msg');
                                                }
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                }
                                                $("#"+current_input_ele_id).css("border","1px solid red");
                                          }else
                                          {
                                            
                                            if($("#"+current_input_ele_id).data('validate-other') && $("#"+current_input_ele_id).data('validate-other')!="")
                                            {
                                              //console.log($("#"+current_input_ele_id).data('validate-other'));
                                            }else
                                            {
                                              if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html('');
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html('');
                                                }
                                                $("#"+current_input_ele_id).css("border","");
                                            }   
                                          }
                                    }else if( current_input_ele_type=="tel")
                                    {
                                          if($("#"+current_input_ele_id).val()=="")
                                          {
                                                error = 1;
                                                error_msg="Mobile Number Must Required.";
                                                if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                                {
                                                      error_msg=$("#"+current_input_ele_id).data('error_msg');
                                                }
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                }
                                                $("#"+current_input_ele_id).css("border","1px solid red");
                                          }else
                                          {
                                                if(validateMobile($("#"+current_input_ele_id).val()))
                                                {
                                                      if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                      {
                                                            $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html('');
                                                      }else
                                                      {
                                                            $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html('');
                                                      }
                                                      $("#"+current_input_ele_id).css("border","");
                                                      
                                                }else
                                                {
                                                      error_msg="Please Enter Valid Mobile Number";
                                                      error = 1;
                                                      if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                      {
                                                            $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                      }else
                                                      {
                                                            $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                      }
                                                      $("#"+current_input_ele_id).css("border","1px solid red");
                                                }
                                                
                                          }
                                    }else if(current_input_ele_type=="password")
                              {
                                    if($("#"+current_input_ele_id).val()=="")
                                    {
                                          error = 1;
                                          error_msg="Password Must Required.";
                                          //(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,15})$  ---- forcheck valid password with alphanumeric check
                                          if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                          {
                                                error_msg=$("#"+current_input_ele_id).data('error_msg');
                                          }
                                          if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                          {
                                                $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                          }else
                                          {
                                                $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                          }
                                          $("#"+current_input_ele_id).css("border","1px solid red");
                                    }else
                                    {
                                          if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                          {
                                                $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html('');
                                          }else
                                          {
                                                $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html('');
                                          }
                                          $("#"+current_input_ele_id).css("border","");
                                    }
                              }else if(current_input_ele_type=="number")
                              {
                                    if($("#"+current_input_ele_id).attr("min") && $("#"+current_input_ele_id).attr("min")!="")
                                    {
                                          var current_min_val=parseFloat($("#"+current_input_ele_id).attr("min"));      
                                    }else
                                    {
                                          var current_min_val=0;
                                    }
                                    if($("#"+current_input_ele_id).attr("max") && $("#"+current_input_ele_id).attr("max")!="" && $("#"+current_input_ele_id).attr("max")>current_min_val)
                                    {
                                          var current_max_val=parseFloat($("#"+current_input_ele_id).attr("max"));
                                    }else
                                    {
                                          var current_max_val=100000000;
                                    }
                                          
                                    if($("#"+current_input_ele_id).val()=="" || $("#"+current_input_ele_id).val()<=0 || $("#"+current_input_ele_id).val()<current_min_val || $("#"+current_input_ele_id).val()>current_max_val)
                                    {
                                          error = 1;
                                          console.log($("#"+current_input_ele_id).val());
                                          if($("#"+current_input_ele_id).val()=="" || $("#"+current_input_ele_id).val()<=0)
                                          {     
                                                error_msg="This Field Must Required.";
      
                                                if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                                {
                                                      error_msg=$("#"+current_input_ele_id).data('error_msg');
                                                }
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                }
                                          }else if($("#"+current_input_ele_id).val()<current_min_val)
                                          {
                                                error_msg="Enter Value greater than ".current_min_val;
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                }
                                          }else if($("#"+current_input_ele_id).val()>current_max_val)
                                          {
                                                error_msg="Enter Value smaller than ".current_max_val;
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                }
                                          }
                                          //$("#"+current_input_ele_id).css("border","1px solid red");


                                    }else
                                    {
                                          if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                          {
                                                $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html('');
                                          }else
                                          {
                                                $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html('');
                                          }
                                          $("#"+current_input_ele_id).css("border","");
                                    }
                              }else if(current_input_ele_type=="date" || current_input_ele_type=="datetime" || current_input_ele_type=="datetime-local" || current_input_ele_type=="time")
                              {
                                    if($("#"+current_input_ele_id).val()=="")
                                    {
                                          error = 1;
                                          error_msg="This Field Must Required.";
                                          if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                          {
                                                error_msg=$("#"+current_input_ele_id).data('error_msg');
                                          }
                                          if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                          {
                                                $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                          }else
                                          {
                                                $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                          }
                                          $("#"+current_input_ele_id).css("border","1px solid red");
                                    }else
                                    {
                                          if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                          {
                                                $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html('');
                                          }else
                                          {
                                                $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html('');
                                          }
                                          $("#"+current_input_ele_id).css("border","");
                                    }
                              }else if(current_input_ele_type=="textarea")
                              {
                                    if($.trim($("#"+current_input_ele_id).val())=="")
                                    {
                                          error = 1;
                                          error_msg="This Field Must Required.";
                                          if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                          {
                                                error_msg=$("#"+current_input_ele_id).data('error_msg');
                                          }
                                          if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                          {
                                                $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                          }else
                                          {
                                                $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                          }
                                          $("#"+current_input_ele_id).css("border","1px solid red");
                                    }else
                                    {
                                          if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                          {
                                                $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html('');
                                          }else
                                          {
                                                $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html('');
                                          }
                                          $("#"+current_input_ele_id).css("border","");
                                    }     
                              }else if(current_input_ele_type=="select-multiple" || current_input_ele_type=="select-one"  )
                              {
                                    if($("#"+current_input_ele_id).val()=="" )
                                    {
                                          error = 1;
                                          error_msg="This Field Must Required.";
                                          if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                          {
                                                error_msg=$("#"+current_input_ele_id).data('error_msg');
                                          }
                                          if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                          {
                                                $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                          }else
                                          {
                                                $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                          }
                                          $("#"+current_input_ele_id).css("border","1px solid red");
                                    }else
                                    {
                                          if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                          {
                                                $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html('');
                                          }else
                                          {
                                                $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html('');
                                          }
                                          $("#"+current_input_ele_id).css("border","");
                                    }     
                              }
                              else if(current_input_ele_type=="hidden")
                              {
                                var is_valid_hidden_field="0";//focus-ele
                                var hidden_focus_field=$("#"+current_input_ele_id);
                                if($("#"+current_input_ele_id).data('focus-ele') && $("#"+current_input_ele_id).data('focus-ele')!="")
                                {
                                  var data_focus_hidden_field_ele=$("#"+current_input_ele_id).data('focus-ele');
                                  hidden_focus_field=$("#"+data_focus_hidden_field_ele)
                                }
                                if($("#"+current_input_ele_id).data('is_numeric') && $("#"+current_input_ele_id).data('is_numeric')=="1")
                                {
                                  if($("#"+current_input_ele_id).val()!="" && $("#"+current_input_ele_id).val()>"0")
                                  {
                                    is_valid_hidden_field="1";
                                  }
                                }else
                                {
                                  if($("#"+current_input_ele_id).val()!="")
                                  {
                                    is_valid_hidden_field="1";
                                  }
                                }
                                //console.log(hidden_focus_field);
                                    //if($("#"+current_input_ele_id).val()=="" || $("#"+current_input_ele_id).val()=="0")
                                    if(is_valid_hidden_field=="0")
                                    {
                                          error = 1;
                                          error_msg="This Field Must Required.";
                                          if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                          {
                                                error_msg=$("#"+current_input_ele_id).data('error_msg');
                                          }
                                          if(hidden_focus_field.nextAll("."+err_msg_ele) && hidden_focus_field.nextAll("."+err_msg_ele).length=="1")
                                          {
                                                hidden_focus_field.nextAll("."+err_msg_ele).html(error_msg);
                                                //console.log(hidden_focus_field.nextAll("."+err_msg_ele));
                                          }else
                                          {
                                                hidden_focus_field.prev().nextAll("."+err_msg_ele).html(error_msg);
                                          }
                                          hidden_focus_field.css("border","1px solid red");
                                          //console.log(hidden_focus_field);
                                    }else
                                    {
                                          if(hidden_focus_field.nextAll("."+err_msg_ele) && hidden_focus_field.nextAll("."+err_msg_ele).length=="1")
                                          {
                                                hidden_focus_field.nextAll("."+err_msg_ele).html('');
                                          }else
                                          {
                                                hidden_focus_field.prev().nextAll("."+err_msg_ele).html('');
                                          }
                                          hidden_focus_field.css("border","");
                                    }     
                              }
                              else if(current_input_ele_type=="email")
                              {
                                    if($("#"+current_input_ele_id).val()=="")
                                    {
                                          error = 1;
                                          error_msg="Email Must Required.";
                                          if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                          {
                                                error_msg=$("#"+current_input_ele_id).data('error_msg');
                                          }
                                          if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                          {
                                                $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                          }else
                                          {
                                                $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                          }
                                          $("#"+current_input_ele_id).css("border","1px solid red");
                                    }else
                                    {
                                          if(validateEmail($("#"+current_input_ele_id).val()))
                                          {
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html('');
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html('');
                                                }
                                                $("#"+current_input_ele_id).css("border","");
                                                
                                          }else
                                          {
                                                error_msg="Please Enter Valid Email";
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                }
                                                $("#"+current_input_ele_id).css("border","1px solid red");
                                          }
                                          
                                    }
                              }else if(current_input_ele_type=="file")
                              {
                                  var other_check_field_val="";
                                  if($("#"+current_input_ele_id).data("old_field") && $("#"+current_input_ele_id).data("old_field")!=undefined )
                                  {
                                    var other_check_field=$("#"+current_input_ele_id).data("old_field");
                                    if($("#"+other_check_field).length)
                                    {
                                      other_check_field_val=$("#"+other_check_field).val();
                                    }
                                  }

                                  if ($("#"+current_input_ele_id).val()=="" &&  other_check_field_val=="") 
                                   {
                                          error = 1;
                                          error_msg="Please Upload Valid File.";
                                          if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                          {
                                                $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                          }else
                                          {
                                                $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                          }
                                          $("#"+current_input_ele_id).css("border","1px solid red");
                                   }else
                                   {
                                          var input=$("#"+current_input_ele_id);
                                          if($(input).data('allowed') && $(input).data('allowed')!="")
                                          {
                                                //validate allowed type of content
                                                var allowed=$(input).data('allowed');
                                                
                                                var allowed_types=JSON.parse(atob(allowed));
                                                if(allowed_types.length>0)
                                                {
                                                      var upload_file_name=input.files[0].name;
                                                      var name_arr=upload_file_name.split('.')
                                                      var extension=name_arr[name_arr.length-1];
                                                      if($.inArray( extension, allowed_types )=="-1")
                                                      {
                                                            error = 1;
                                                            error_msg="Uploaded file type isn't valid.";
                                                            if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                            {
                                                                  $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                                            }else
                                                            {
                                                                  $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                                            }
                                                            $("#"+current_input_ele_id).css("border","1px solid red");
                                                            $(input).val("");
                                                      }
                                                }
                                                
                                          }else
                                          {
                                                if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                                {
                                                      $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html("");
                                                }else
                                                {
                                                      $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html("");
                                                }
                                                $("#"+current_input_ele_id).css("border","");      
                                          }
                                          
                                   }                                    
                              }else if(current_input_ele_type=="checkbox")
                              {
                                    if($("#"+current_input_ele_id).prop('checked') != true)
                                    {
                                          error = 1;
                                          error_msg="Please check this checkbox";
                                          if($("#"+current_input_ele_id).data('error_msg') && $("#"+current_input_ele_id).data('error_msg')!="")
                                          {
                                                error_msg=$("#"+current_input_ele_id).data('error_msg');
                                          }
                                          if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                          {
                                                $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                          }else
                                          {
                                                $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                          }
                                          $("#"+current_input_ele_id).css("border","1px solid red");
                                    }else
                                    {
                                          if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                          {
                                                $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html("");
                                          }else
                                          {
                                                $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html("");
                                          }
                                          $("#"+current_input_ele_id).css("border","");
                                    }                             
                              }else if(current_input_ele_type=="radio")
                              {
                                    var current_input_name=$("#"+current_input_ele_id).attr('name');
                                    if($("[name="+current_input_ele_id+"]").prop('checked') != true)
                                    {
                                          error = 1;
                                          error_msg="please check one of above radios";
                                          if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                          {
                                                $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html(error_msg);
                                          }else
                                          {
                                                $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html(error_msg);
                                          }
                                          $("#"+current_input_ele_id).css("border","1px solid red");
                                    }else
                                    {
                                          if($("#"+current_input_ele_id).nextAll("."+err_msg_ele) && $("#"+current_input_ele_id).nextAll("."+err_msg_ele).length=="1")
                                          {
                                                $("#"+current_input_ele_id).nextAll("."+err_msg_ele).html("");
                                          }else
                                          {
                                                $("#"+current_input_ele_id).prev().nextAll("."+err_msg_ele).html("");
                                          }
                                          $("#"+current_input_ele_id).css("border","");
                                    }
                              }
                        }     
                  }
                  //console.log(error);
                  if(error == 1)return false; else return true;
            });
      
      }else
      {
            var validate_form_class_ele="";
      }


});

function ReSetInquirySearch()
{
  var url="process/ajax_action_php_function.php";
  var method="post";
  var action="ReSetInquirySearch";

  $.ajax({
          type: method,
          url: url,
          data: {action:action},
          success: function (data) {
            location.reload();
          }
    }); 
}

function RemoveInqAttachment(id_img,suid) 
  {
      swal({
            title: 'Are you sure to delete this file?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#a5dc86',
            cancelButtonColor: '#d57171',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
          $.ajax({
              url: 'process/ajax_action_php_function.php',
              type: 'POST',
              data: {
                  id_img: id_img,
                  suid: suid,
                  action:'RemoveInquiryAttachments'
              },
              error: function() {
                  swal(
                        {
                          title: 'Error',
                          text: 'Error in file removal process.',
                          type: 'error',
                          confirmButtonColor: '#4fa7f3'
                        }  ); 
              },
              success: function(data) {
                  if (data = 'done') {
                      $('.proli_' + id_img).hide();
                      swal(
                        {
                          title: 'Success',
                          text: 'File removed successfully.',
                          type: 'success',
                          confirmButtonColor: '#4fa7f3'
                        }  ); 
                  } else {
                      swal(
                        {
                          title: 'Error',
                          text: 'Error in file removal process.',
                          type: 'error',
                          confirmButtonColor: '#4fa7f3'
                        }  ); 
                  }
              }
          });
      });
  }

  $(document).ready(function(){
    $('input[type=tel]').keypress(validateMobileNumber);
});

  
  function AddLeadContact()
  {
     var total_contact=$("#total_contacts").val();
      var url="process/ajax_action_php_function.php";
      var method="post";
      var action="AddLeadContact";
      //console.log(total_contact);
      total_contact=parseInt(total_contact);
      var form_data={};
            form_data['total']=total_contact;
            form_data['action']=action;
            
            //console.log(form_data)
            $.ajax({
                type: method,
                url: url,
                data: form_data,
                success: function (data) {
                  if(data!="")
                  {
                    //console.log(data);
                    $("#addtional_contact_wrapper").append(data);
                    $("#total_contacts").val(total_contact+1);
                    //$("#cname"+total_contact+1)
                    $(".cname_auto_suggest").keyup(function(){
                      var cli=$(this).data('cli');
                      //console.log(cli);
                      //console.log($(this).nextAll(".suggesstion-box"));
                      var keyword=$(this).val();
                      var cur_ele_id=$(this).attr("id");
                      var suggesstion_box=$(this).nextAll(".suggesstion-box");
                      GetAutoSuggestData(keyword,cur_ele_id,suggesstion_box,cli)    
                    });
                    $(".cname_auto_suggest").blur(function(){
                      //console.log($(this).nextAll(".suggesstion-box"));
                      var keyword=$(this).val();
                      var cur_ele_id=$(this).attr("id");
                      var suggesstion_box=$(this).nextAll(".suggesstion-box");
                      //$(suggesstion_box).hide();
                      //console.log($( document.activeElement));
                      $('body').click(function(evnt) {
                        console.log();
                        if(evnt.target.id=="")
                        {
                          $(".suggesstion-box").hide();
                        }
                      });
                    });
                    $(".cname_auto_suggest").focus(function(){
                      //console.log($(this).nextAll(".suggesstion-box"));
                      var keyword=$(this).val();
                      var cur_ele_id=$(this).attr("id");
                      var suggesstion_box=$(this).nextAll(".suggesstion-box");
                      if(keyword!="")
                      {
                        $(suggesstion_box).show();
                      }
                    });
                  }
                }
          });         
  }
  function RemoveLeadContact(e)
  {
    var val=$(e).data('val');
    //console.log(val);
    //$("#cname"+val).parent().remove();
    //$("#contact_mobile"+val).parent().remove();
    //$("#contact_category"+val).parent().remove();
    $(".lblLeadContact"+val).parent().remove();
    //$(e).remove();
  }

  function RemoveLeadContactDB(e)
  {
    var form_data={};
    var url="process/ajax_action_php_function.php";
      var method="post";
            form_data['cid']=$(e).data('idc');
            form_data['action']="RemoveAddedInquiryContact";
            
            //console.log(form_data)
            swal({
            title: 'Are you sure to delete this contact?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#a5dc86',
            cancelButtonColor: '#d57171',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            $.ajax({
                type: method,
                url: url,
                data: form_data,
                success: function (data) {
                  if(data!="")
                  {
                    RemoveLeadContact($(e));

                    /*var val=$(e).data('val');
                    $(".lblLeadContact"+val).parent().remove();*/
                  }
                }
          }); 
      });
  }
  function RemoveLeadRemarksDB(e)
  {
    var form_data={};
    var url="process/ajax_action_php_function.php";
      var method="post";
            form_data['id_remarks']=$(e).data('idc');
            form_data['action']="RemoveAddedInquiryRemarks";
            
            //console.log(form_data)
            swal({
            title: 'Are you sure to delete this remark?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#a5dc86',
            cancelButtonColor: '#d57171',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
          $.ajax({
                type: method,
                url: url,
                data: form_data,
                success: function (data) {
                  if(data!="")
                  {
                    RemoveLeadRemarks($(e));
                   
                  }
                }
          }); 
      });
            
  }
  function AddLeadRemarks()
  {
    var total_remarks=$("#total_remarks").val();
    total_remarks=parseInt(total_remarks);
    var add_content='<input type="hidden" id="id_remarks'+(total_remarks+1)+'" name="id_remarks[]" value="0"><div class="col-sm-9" id="remark_container_1_'+(total_remarks+1)+'"><label for="firstname" class="control-label">Remark '+(total_remarks+1)+'</label><div class="form-group"><textarea name="remarks[]" data-is_validate="0"  id="remarks'+(total_remarks+1)+'" class="form-control" placeholder="Remarks" value=""></textarea><span class="help" id="msg1"></span></div></div><div class="col-sm-3 text-center" id="remark_container_2_'+(total_remarks+1)+'"><label for="firstname" class="control-label">&nbsp;</label><div class="form-group"><button type="button" onclick="return RemoveLeadRemarks(this);" data-val="'+(total_remarks+1)+'" class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></div></div>';
    $("#addtional_remarks_wrapper").append(add_content);
    $("#total_remarks").val((total_remarks+1));
  }
  function RemoveLeadRemarks(e)
  {
    var val=$(e).data('val');
    $("#id_remarks"+val).remove();
    $("#remark_container_1_"+val).remove();
    $("#remark_container_2_"+val).remove();
  }

  $(".view_large_img").click(function(){
    var img_source=$(this).attr('src');
    
    var width = $("#modal_zoom_image .modal-body").width();
    var height = $("#modal_zoom_image .modal-body").height();
    /*console.log(height);
    console.log(width);*/
    var new_img='<button type="button" class="close" style="position: absolute;right: 10px;top: 2px;" data-dismiss="modal" aria-hidden="true">&times;</button><div class="img-responsive"> <img src="'+img_source+'" style="max-width:100%;max-height:100%;border-radius:5px;" /></div>';
    $("#modal_zoom_image .modal-body").html(new_img);
    
    $("#modal_zoom_image").modal('show');
  });
  $(".column-thumbnail").click(function(){
    console.log('ok');
  });

  $(".fileuploader-item-image canvas").click(function(){
    console.log($(this));
    var img_source=$(this).attr('src');
    
    var width = $("#modal_zoom_image .modal-body").width();
    var height = $("#modal_zoom_image .modal-body").height();
    /*console.log(height);
    console.log(width);*/
    var new_img='<button type="button" class="close" style="position: absolute;right: 10px;top: 2px;" data-dismiss="modal" aria-hidden="true">&times;</button><div class="img-responsive"> <img src="'+img_source+'" style="max-width:100%;max-height:100%;border-radius:5px;" /></div>';
    $("#modal_zoom_image .modal-body").html(new_img);
    
    $("#modal_zoom_image").modal('show');
  });


  function ShowPassword(password_ele,button)
  {
    var hide_icon='<i class="fas fa-eye-slash"></i>';
    var show_icon='<i class="fas fa-eye"></i>';
    var ele_type=$(password_ele).attr("type");
    if(ele_type=="password" || ele_type=="Password" || ele_type=="PASSWORD")
    {
      $(password_ele).attr('type','text');
      $(button).html(hide_icon);
    }else
    {
      $(password_ele).attr('type','password');
      $(button).html(show_icon);
    }
  }
  $("#date_booking").change(function(){
    UpdateAjaxDropDown(date_booking,id_time_slot);
  });

  $("#product_images").change(function(){
   var all_files= $("#product_images")[0].files;
   var _URL = window.URL || window.webkitURL;
   /*for(var i=0;i<all_files.length;i++)
   {
    //console.log(all_files[i]);
    var file=all_files[i];
    img = new Image();
        var objectUrl = _URL.createObjectURL(file);
        console.log(objectUrl);
        img.src=objectUrl;
        img.onload = function () {
            //console.log(this.width + " " + this.height);
            console.log(this.width + " " + this.height);
            if(this.width>300 || this.height>200)
            {
              $("#product_images").val(null);
              $("#product_images").nextAll(".help").html("Please Upload all Images Between 200x300");
            }
            _URL.revokeObjectURL(objectUrl);
        };
   }*/
    /*img = new Image();
        var objectUrl = _URL.createObjectURL(file);
        img.onload = function () {
            alert(this.width + " " + this.height);
            _URL.revokeObjectURL(objectUrl);
        };*/
  });
  function AddOrderItemFields(e)
{
  var total_quotation_product=$("#total_quotation_product").val();
  total_quotation_product=parseInt(total_quotation_product);

  $.ajax({
    type: "POST",
    url:'process/action_get_add_quotation_item_layout.php',
    data:'total_quotation_product='+total_quotation_product,
    
    success: function(data){
      //var cli=$(e).data('cli');
      if(data!="")
          {
            console.log(data);
            $("#item_table").append(data);
            $('.select2').select2();
            ConvertSelect2Readonly();
          }
    }
  }); 
}
function RemoveOrderItemFields(e)
{
  var cli=$(e).data('cli');
  $("#oi_row_"+cli).remove();
}
function PerformOrderCalculations(e)
{
  //var qty=$(e).val();
  var cli=$(e).data('cli');

  var price=$("#price_"+cli).val();
  var qty=$("#qty_"+cli).val();
  var gst=$("#gst").val();

  var total=0;
  price=parseFloat(price);
  qty=parseInt(qty);
  gst=parseInt(gst);
  var is_gst_include= $('input[name="is_gst_include"]:checked').val();
  if(price!="" && price>0 && qty!="" && qty>0 )
  {
    total=qty*price;
  }

  
  $("#total_"+cli).val(total);
  var sub_total=0;
  var grand_total=0;
  var gst_amount=0;
  if($(".total_price").length && $(".total_price").length>0)
  {
    for (var i = 0; i < $(".total_price").length; i++) 
    {
      sub_total+=parseFloat($($(".total_price")[i]).val());
    }
    
    if((is_gst_include=="1" || is_gst_include==1) && gst>0)
    {
      gst_amount=(sub_total*gst)/100;
      gst_amount=parseFloat(gst_amount);
      //gst_amount=gst_amount.toFixed(2);
    }
    // console.log(sub_total);
    // console.log(gst_amount);
    grand_total=sub_total+gst_amount;

    var sub_total=sub_total.toFixed(2);
    var gst_amount=gst_amount.toFixed(2);
    var grand_total=grand_total.toFixed(2);

    $("#sub_total").val(sub_total);
    $("#gst_amount").val(gst_amount);
    $("#grand_total").val(grand_total);
  }

}
function UpdateQuotationTotal()
{
  var gst=$("#gst").val();
  gst=parseInt(gst);
  var is_gst_include= $('input[name="is_gst_include"]:checked').val();
  var sub_total=0;
  var grand_total=0;
  var gst_amount=0;
  if($(".total_price").length && $(".total_price").length>0)
    {
      for (var i = 0; i < $(".total_price").length; i++) 
      {
        sub_total+=parseFloat($($(".total_price")[i]).val());
      }
      
      if((is_gst_include=="1" || is_gst_include==1) && gst>0)
      {
        gst_amount=(sub_total*gst)/100;
        gst_amount=parseFloat(gst_amount);
        //gst_amount=gst_amount.toFixed(2);
      }
      
      grand_total=sub_total+gst_amount;

      var sub_total=sub_total.toFixed(2);
      var gst_amount=gst_amount.toFixed(2);
      var grand_total=grand_total.toFixed(2);

      $("#sub_total").val(sub_total);
      $("#gst_amount").val(gst_amount);
      $("#grand_total").val(grand_total);
    }
}
function UpdateRoleChecklist(e)
{
  if($(e).prop('checked') != true)
  {
    $(".check-item").prop('checked', false);
  }else
  {
    $(".check-item").prop('checked', true);
  }
}
function SelectMultipleCheck(e)
{
      check_class=$(e).data('opt');  
      total_ele=$("."+check_class).length;
      // console.log($(e).is(':checked'));
      if($(e).is(':checked') != true)
      {
            $("."+check_class).prop('checked', false);

      }else
      {
            
            $("."+check_class).prop('checked', true);
            
      }

}
function ValidateAddFare()
{
  var state=$("#state").val();
  var district=$("#district").val();
//   var category=$("#category").val();
var category="1";
  var vehicle_type=$("#vehicle_type").val();
  if(state!="" && district!=""  && vehicle_type!="")
  {
      var method="POST";
        

        var url="process/ajax_action_php_function.php";
        var action="CheckIsFareAdded";
        
            var form_data={};
            form_data['state']=state;
            form_data['district']=district;
            form_data['category']=category;
            form_data['vehicle_type']=vehicle_type;
            form_data['action']=action;
            
            // console.log(form_data);
            //console.log(form_data)
            $.ajax({
                type: method,
                url: url,
                data: form_data,
                success: function (data) {
                  if(data!="")
                  {
                    //console.log(data);
                    data=JSON.parse(data);
                    console.log(data); 
                    if(data.error_code=="0")
                    {
                      $("#all_fields_wrapper").show();
                    }
                    else if(data.error_code=="1")
                    {
                      $("#all_fields_wrapper").hide();
                      alert('Fare Already Added for this details');
                    }
                    
                  }
                }
          });     

          
  }
}

function add_more_fares()
{

  var y_count=1;
  var m_count=1;
  var total_fare_items=$("#total_fare_items").val();
  total_fare_items=parseInt(total_fare_items);
  y_count=total_fare_items+1;

  var html = '';
  html='<div id="fare_types_wrapper'+y_count+'" class="row col-sm-12">'+ 
               
               '<div class="col-sm-4 col-md-3">'+
                     '<label for="firstname"  class="control-label">From KM</label>'+
                     '<div class="form-group">'+
                      '<input type="number" step="1" min="1"  name="min_km[]"  onchange="" data-cur_pos="'+y_count+'"   id="min_km'+y_count+'" class="form-control min_km" placeholder="From KM" value="">'+
                     '</div>'+
               '</div>'+
               '<div class="col-sm-4 col-md-3">'+
                     '<label for="firstname"  class="control-label">To KM</label>'+
                     '<div class="form-group">'+
                      '<input type="number" step="1" min="1"  name="max_km[]"  onchange="" data-cur_pos="'+y_count+'"  id="max_km'+y_count+'" class="form-control max_km" placeholder="To KM" value="">'+
                     '</div>'+
               '</div>'+
               '<div class="col-sm-4 col-md-3">'+
                     '<label for="firstname"  class="control-label">Amount</label>'+
                     '<div class="form-group">'+
                      '<input type="number"  name="amount[]" step="any" onchange="" data-cur_pos="'+y_count+'" class="form-control amount" placeholder="Amount" value="">'+
                     '</div>'+
               '</div>'+
               '<div  class="col-sm-6 col-md-3" style="margin-top: 10px;">'+
                '<div class="btn-group mb-0">'+
                  '<a href="javascript:;" class="btn btn-sm btn-default pmbutton btn_remove_prod_parts" data-cur_pos="'+y_count+'"  data-val="'+y_count+'" onclick="RemoveFareItem(this);"><i class="fas fa-minus-square"></i></a>'+
               '</div>'+
               '</div>'+
             '</div>';
  y_count++;
  $("#total_fare_items").val(y_count);

  $('#item_table_fare_item').append(html);
}
function RemoveFareItem(e)
{
  var el_val=$(e).data('val');
  $("#fare_types_wrapper"+el_val).remove();
}
function add_more_fare_charges()
{

  var y_count=1;
  var m_count=1;
  var total_fare_charges=$("#total_fare_charges").val();
  total_fare_charges=parseInt(total_fare_charges);
  y_count=total_fare_charges+1;

  var html = '';
  html='<div id="fare_charges_wrapper'+y_count+'" class="row col-sm-12">'+ 
               '<div class="col-sm-4 col-md-3">'+
                     '<label for="firstname"  class="control-label">From Time</label>'+
                     '<div class="form-group">'+
                      '<input type="text"  name="from_time[]"  onchange="" data-cur_pos="'+y_count+'"   id="from_time'+y_count+'" class="form-control from_time timepicker" placeholder="From Time" value="">'+
                     '</div>'+
               '</div>'+
               '<div class="col-sm-4 col-md-3">'+
                     '<label for="firstname"  class="control-label">To Time</label>'+
                     '<div class="form-group">'+
                      '<input type="text"  name="to_time[]"  onchange="" data-cur_pos="'+y_count+'"   id="to_time'+y_count+'" class="form-control to_time timepicker" placeholder="To Time" value="">'+
                     '</div>'+
               '</div>'+
               '<div class="col-sm-4 col-md-3">'+
                     '<label for="firstname"  class="control-label">Charges(%)</label>'+
                     '<div class="form-group">'+
                      '<input type="number"  name="charges_amount[]" step="any" onchange="" data-cur_pos="'+y_count+'" class="form-control amount" placeholder="Charges(%)" value="">'+
                     '</div>'+
               '</div>'+
               '<div  class="col-sm-6 col-md-3" style="margin-top: 10px;">'+
                '<div class="btn-group mb-0">'+
                  '<a href="javascript:;" class="btn btn-sm btn-default pmbutton btn_remove_prod_parts" data-cur_pos="'+y_count+'"  data-val="'+y_count+'" onclick="RemoveFareChargesItem(this);"><i class="fas fa-minus-square"></i></a>'+
               '</div>'+
               '</div>'+
             '</div>';
  y_count++;
  $("#total_fare_charges").val(y_count);

  $('#item_table_fare_charges').append(html);
}
function RemoveFareChargesItem(e)
{
  var el_val=$(e).data('val');
  $("#fare_charges_wrapper"+el_val).remove();
}
function ChangeTeamAccountType(e)
{
  var account_type=$(e).val();
  // volun_section
  // emp_section
  if(account_type=="2")
  {
     $(".volun_section").hide();
     $(".emp_section").show();
  }else
  {
    $(".emp_section").hide();
    $(".volun_section").show();
  }

}

$( document ).ready(function() 
{
      $(".imagepreview").on("click", function() {
        $('#imagepreview').attr('src', $(this).find('.imageresource').attr('src')); // here asign the image to the modal when the user click the enlarge link
        $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
      });
  });

function SendWhatsappMessage(e)
{
  var pos=$(e).data('val');
  var whatsapp_link=$("#whatsapp_link"+pos).val();
  var whatsapp_message=$("#whatsapp_message"+pos).val();
  console.log($("#whatsapp_message"+pos));
  if(whatsapp_message!="")
  {

      $("#whatsapp_message"+pos).next(".help").html("");
      $("#whatsapp_link"+pos).val("");
      $("#whatsapp_message"+pos).css("border","");
      $("#whatsapp_message"+pos).val("");
      $("#whatsapp"+pos).modal("hide");

      window.open(whatsapp_link+whatsapp_message, '_blank');
  }else
  {
    $("#whatsapp_message"+pos).next(".help").html("Please enter message");
    $("#whatsapp_message"+pos).css("border","1px solid red");
  }
}

function GetAmbulanceFacilityCheck(sub_category)
{
  var sub_category= $(sub_category).val();
  var url="process/ajax_action_php_function.php";
  var action="GetVehicleFacilityList";
  var form_data={};
  var checked_facility=$("#checked_facility").val();
  form_data['sub_cat']=sub_category;
  form_data['checked_facility']=checked_facility;
  form_data['action']=action;
  var method="post";
  // console.log(form_data);
  if(sub_category!="")
  {
      $.ajax({
            type: method,
            url: url,
            data: form_data,
            success: function (data) {
              if(data!="")
              {
                //console.log(data);
                data=JSON.parse(data);
                // console.log(data); 
                $("#facility_container").html(data.data);
                // if(data.error_code!="0")
                // {
                //   $(elt).html(data.data);
                // }
              }
            }
      });
  }

}
function GetRideVehicleFareCalculation()
{
  var district= $("#district").val();
  var category= $("#category").val();
  var vehicle_type= $("#vehicle_type").val();
  var total_km= $("#total_distance").val();
  var date= $("#date").val();
  var time= $("#time").val();
  if(district!="" && category!="" && vehicle_type!="" && total_km!="")
  {
    var url="process/ajax_action_php_function.php";
    var action="GetRideFare";
    var form_data={};
    
    form_data['district']=district;
    form_data['category']=category;
    form_data['vehicle_type']=vehicle_type;
    form_data['total_km']=total_km;
    form_data['date']=date;
    form_data['time']=time;
    form_data['action']=action;
    var method="post";

    $.ajax({
          type: method,
          url: url,
          data: form_data,
          success: function (data) {
            if(data!="")
            {
              //console.log(data);
              data=JSON.parse(data);
              // console.log(data); 
              $("#ride_amount").val(data.amount);
              // if(data.error_code!="0")
              // {
              //   $(elt).html(data.data);
              // }
            }
          }
    });

    var url="process/ajax_action_php_function.php";
    var action="GetRideDrivers";
    var form_data={};
    
    form_data['district']=district;
    form_data['category']=category;
    form_data['vehicle_type']=vehicle_type;
    
    form_data['action']=action;
    var method="post";
    $.ajax({
          type: method,
          url: url,
          data: form_data,
          success: function (data) {
            if(data!="")
            {
              //console.log(data);
              data=JSON.parse(data);
              console.log(data); 
              // $("#ride_amount").val(data.amount);
              // if(data.error_code!="0")
              // {
              //   $(elt).html(data.data);
              // }
              $("#id_driver").html(data.data);
              $("#avail_driver_list").val(data.avail_driver_list);

            }
          }
    });

  }
}

function UpdateRideLocation()
{
  var source=$("#source").val();
  var destination=$("#destination").val();

  var url="http://localhost/RidoCab/API/calculate_ride_distance.php";
  // var url="https://ridocabs.com/API/calculate_ride_distance.php";

  var form_data={};
  var checked_facility=$("#checked_facility").val();
  form_data['origin']=source;
  form_data['destination']=destination;
  // var url="https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins="+source+"&destinations="+destination+"&key="+API_KEY;
  // console.log(url);
  if(source!="" && destination!="")
  {
    
    // console.log(url);
    $.ajax({
          type: "POST",
          url: url,
          data: form_data,
          success: function (data) {
            if(data!="")
            {
              console.log(data);

              // data=JSON.parse(data);
              // data=$.parseJSON(data);
              $("#total_time").val(data.duration);
              $("#total_distance").val(data.distance);
              
              // console.log(data); 
              // $("#facility_container").html(data.data);
              // if(data.error_code!="0")
              // {
              //   $(elt).html(data.data);
              // }
            }
          }
    });   
  }
  
}
function AssignRideVehicle(e)
{
  if($(e).find(':selected').data('vehicle'))
  {
    var vehicle=$(e).find(':selected').data('vehicle');  
    var mobile=$(e).find(':selected').data('mobile');
  }else
  {
    var vehicle="";
    var mobile="";
  }
  
  

  // console.log(vehicle)
  $("#id_car").val(vehicle);
  $("#driver_mobile").val(mobile);
}
function ChangeVehicleOptionDisplay(e)
{
      var selected_option=$('input[name="crime_type_fields[Vehicle Involved]"]:checked').val();
      // console.log(selected_option);
      if(selected_option=="Yes")
      {
            // console.log($("#Vehicle Make"));
            $("#Vehicle-Make-wrapper").show();
            $("#Vehicle-Modal-wrapper").show();
            $("#Vehicle-Color-wrapper").show();
            $("#Vehicle-License-Plate-wrapper").show();
      }else
      {
            $("#Vehicle-Make-wrapper").hide();
            $("#Vehicle-Modal-wrapper").hide();
            $("#Vehicle-Color-wrapper").hide();
            $("#Vehicle-License-Plate-wrapper").hide();

      }
}

function ChangeVehicleOptionDisplay(e)
{
      var selected_option=$('input[name="crime_type_fields[Vehicle Involved]"]:checked').val();
      // console.log(selected_option);
      if(selected_option=="Yes" || selected_option=="Sí")
      {
            // console.log($("#Vehicle Make"));
            $("#Vehicle-Make-wrapper").show();
            $("#Vehicle-Modal-wrapper").show();
            $("#Vehicle-Color-wrapper").show();
            $("#Vehicle-License-Plate-wrapper").show();
      }else
      {
            $("#Vehicle-Make-wrapper").hide();
            $("#Vehicle-Modal-wrapper").hide();
            $("#Vehicle-Color-wrapper").hide();
            $("#Vehicle-License-Plate-wrapper").hide();

      }
}
function HideShowFireTypeVehicle(e)
{
      var selected_option=$(e).val();
      // Vehicle
      if(selected_option=="Vehicle" || selected_option=="Vehículo")
      {
            // console.log($("#Vehicle Make"));
            $("#Vehicle-Make-wrapper").show();
            $("#Vehicle-Modal-wrapper").show();
            $("#Vehicle-Color-wrapper").show();
            $("#Vehicle-License-Plate-wrapper").show();
      }else
      {
            $("#Vehicle-Make-wrapper").hide();
            $("#Vehicle-Modal-wrapper").hide();
            $("#Vehicle-Color-wrapper").hide();
            $("#Vehicle-License-Plate-wrapper").hide();

      }
}
function AddMoreRTWFiles()
{
      var total_elements=$("#total_rtw_compliance").val();
      total_elements=parseInt(total_elements);
      var new_index=total_elements+1;
      var file_ele_id="rtw_doc_file"+new_index;
      var date_ele_id="rtw_doc_file_expiry_date"+new_index;
      var warpper_id="rtw_compliance_inner_wrapper"+new_index;

      var html_content='<div class="row col-md-12" id="'+warpper_id+'">'+
                              '<div class="col-sm-5">'+
                                    '<label for="firstname" class="control-label">Document File '+new_index+' </label>'+
                                    '<div class="form-group">'+
                                          '<input type="file" name="rtw_doc_file[]" id="'+file_ele_id+'" data-is_validate="1" class="single-upload-file form-control" placeholder="Document File 1" value="">'+
                                          '<span class="help" id="msg2"></span>'+
                                    '</div>'+
                              '</div>'+
                              '<div class="col-sm-5">'+
                                    '<label for="firstname" class="control-label">Document Expiry Date '+new_index+' </label>'+
                                    '<div class="form-group">'+
                                          '<input type="text" name="rtw_doc_file_expiry_date[]" id="'+date_ele_id+'" data-is_validate="1" class="form-control datepicker" placeholder="Document Expiry Date" value="">'+
                                          '<span class="help" id="msg2"></span>'+
                                    '</div>'+
                              '</div>'+ 
                              '<div class="col-sm-2">'+
                                    '<button type="button" style="margin-top:15px;" onclick="AddMoreRTWFiles()" class="btn btn-sm btn-default"><i class="fas fa-plus"></i></button>'+
                                    '<button type="button" style="margin-top:15px;" onclick="RemoveRTWFiles(this)" data-ele="'+warpper_id+'" class="btn btn-sm btn-default"><i class="fas fa-trash"></i></button>'+
                              '</div>'+
                        '</div>';

      $("#right_to_work_compliance_wrapper").append(html_content);
      $("#total_rtw_compliance").val(new_index);
      $("#"+file_ele_id).fileuploader({
            addMore: false,
            extensions: ['jpg', 'jpeg', 'png', 'gif','pdf','doc','txt','docx'] // allowed extensions or types {Array}
        });
      $('#'+date_ele_id).datepicker({
            format: 'dd-mm-yyyy',
            autoclose:!0,
            showOtherMonths: true,
            selectOtherMonths: true
       });                  
}
function RemoveRTWFiles(e)
{
      var ele=$(e).data('ele');
      $("#"+ele).remove();
}
function AddMoreComplianceFiles()
{
      var total_elements=$("#total_compliance").val();
      total_elements=parseInt(total_elements);
      var new_index=total_elements+1;
      var file_ele_id="compliance_doc_file"+new_index;
      var date_ele_id="compliance_doc_file_expiry_date"+new_index;
      var warpper_id="compliance_inner_wrapper"+new_index;

      var html_content='<div class="row col-md-12" id="'+warpper_id+'">'+
                              '<div class="col-sm-5">'+
                                    '<label for="firstname" class="control-label">Document File '+new_index+' </label>'+
                                    '<div class="form-group">'+
                                          '<input type="file" name="compliance_doc_file[]" id="'+file_ele_id+'" data-is_validate="1" class="single-upload-file form-control" placeholder="Document File 1" value="">'+
                                          '<span class="help" id="msg2"></span>'+
                                    '</div>'+
                              '</div>'+
                              '<div class="col-sm-5">'+
                                    '<label for="firstname" class="control-label">Document Expiry Date '+new_index+' </label>'+
                                    '<div class="form-group">'+
                                          '<input type="text" name="compliance_doc_file_expiry_date[]" id="'+date_ele_id+'" data-is_validate="1" class="form-control datepicker" placeholder="Document Expiry Date" value="">'+
                                          '<span class="help" id="msg2"></span>'+
                                    '</div>'+
                              '</div>'+ 
                              '<div class="col-sm-2">'+
                                    '<button type="button" style="margin-top:15px;" onclick="AddMoreComplianceFiles()" class="btn btn-sm btn-default"><i class="fas fa-plus"></i></button>'+
                                    '<button type="button" style="margin-top:15px;" onclick="RemoveComplianceFiles(this)" data-ele="'+warpper_id+'" class="btn btn-sm btn-default"><i class="fas fa-trash"></i></button>'+
                              '</div>'+
                        '</div>';

      $("#compliance_wrapper").append(html_content);
      $("#total_compliance").val(new_index);
      $("#"+file_ele_id).fileuploader({
            addMore: false,
            extensions: ['jpg', 'jpeg', 'png', 'gif','pdf','doc','txt','docx'] // allowed extensions or types {Array}
        });
      $('#'+date_ele_id).datepicker({
            format: 'dd-mm-yyyy',
            autoclose:!0,
            showOtherMonths: true,
            selectOtherMonths: true
       });                  
}
function RemoveComplianceFiles(e)
{
      var ele=$(e).data('ele');
      $("#"+ele).remove();
}
function AddMoreTrainingFiles()
{
      var total_elements=$("#total_training").val();
      total_elements=parseInt(total_elements);
      var new_index=total_elements+1;
      var file_ele_id="training_doc_file"+new_index;
      var date_ele_id="training_doc_file_expiry_date"+new_index;
      var warpper_id="training_inner_wrapper"+new_index;

      var html_content='<div class="row col-md-12" id="'+warpper_id+'">'+
                              '<div class="col-sm-5">'+
                                    '<label for="firstname" class="control-label">Document File '+new_index+' </label>'+
                                    '<div class="form-group">'+
                                          '<input type="file" name="training_doc_file[]" id="'+file_ele_id+'" data-is_validate="1" class="single-upload-file form-control" placeholder="Document File 1" value="">'+
                                          '<span class="help" id="msg2"></span>'+
                                    '</div>'+
                              '</div>'+
                              '<div class="col-sm-5">'+
                                    '<label for="firstname" class="control-label">Document Expiry Date '+new_index+' </label>'+
                                    '<div class="form-group">'+
                                          '<input type="text" name="training_doc_file_expiry_date[]" id="'+date_ele_id+'" data-is_validate="1" class="form-control datepicker" placeholder="Document Expiry Date" value="">'+
                                          '<span class="help" id="msg2"></span>'+
                                    '</div>'+
                              '</div>'+ 
                              '<div class="col-sm-2">'+
                                    '<button type="button" style="margin-top:15px;" onclick="AddMoreTrainingFiles()" class="btn btn-sm btn-default"><i class="fas fa-plus"></i></button>'+
                                    '<button type="button" style="margin-top:15px;" onclick="RemoveTrainingFiles(this)" data-ele="'+warpper_id+'" class="btn btn-sm btn-default"><i class="fas fa-trash"></i></button>'+
                              '</div>'+
                        '</div>';

      $("#training_wrapper").append(html_content);
      $("#total_training").val(new_index);
      $("#"+file_ele_id).fileuploader({
            addMore: false,
            extensions: ['jpg', 'jpeg', 'png', 'gif','pdf','doc','txt','docx'] // allowed extensions or types {Array}
        });
      $('#'+date_ele_id).datepicker({
            format: 'dd-mm-yyyy',
            autoclose:!0,
            showOtherMonths: true,
            selectOtherMonths: true
       });                  
}
function RemoveTrainingFiles(e)
{
      var ele=$(e).data('ele');
      $("#"+ele).remove();
}

function TrimText(e)
{
      var cval=$("#"+e).val();
      
      var trimmed_val=cval.trim();
      // console.log(cval);
      // console.log(trimmed_val);
      $("#"+e).val(trimmed_val).trigger('change');
      // $("#"+e).focus();
}
function CloseAlert(e)
{
      $(e).parent('.alert').hide();
}

function AddMoreTaskTimeEntries(e) 
{
      var total_task_duration=$("#total_task_duration").val();
      total_task_duration=parseInt(total_task_duration);
      cnt=total_task_duration+1;

      var html_content=''+ 
            '<div class="row"  id="task_duration_wrapper'+cnt+'">'+
                  '<div class="col-md-3">'+
                        '<div class="form-group">'+
                              '<label for="task_duration_date'+cnt+'">Date</label>'+
                              '<input type="date" class="form-control" name="task_duration_date[]" id="task_duration_date'+cnt+'" placeholder="Date" value="">'+
                        '</div>'+
                  '</div>'+
                  '<div class="col-md-2">'+
                        '<div class="form-group">'+
                              '<label for="task_duration_start_time'+cnt+'">Start Time</label>'+
                              '<input type="time" class="form-control" name="task_duration_start_time[]" id="task_duration_start_time'+cnt+'" placeholder="Start Time" value="">'+
                        '</div>'+
                  '</div>'+
                  '<div class="col-md-2">'+
                        '<label for="task_duration_end_time'+cnt+'">End Time</label>'+
                        '<div class="form-group">'+
                              '<input type="time" class="form-control" name="task_duration_end_time[]" id="task_duration_end_time'+cnt+'" placeholder="End Time" value="">'+
                        '</div>'+
                  '</div>'+
                  '<div class="col-md-3">'+
                        '<div class="form-group">'+
                              '<label for="task_duration_duration_description'+cnt+'"> Description</label>'+
                              '<input type="text" class="form-control" name="task_duration_duration_description[]" id="task_duration_duration_description'+cnt+'" placeholder="Description" value="">'+
                        '</div>'+
                  '</div>'+
                  '<div class="col-md-2">'+
                        '<div class="btn-group">'+
                              '<button type="button" data-val="'+cnt+'" onclick="AddMoreTaskTimeEntries(this);" style="background: #294351;margin-top: 40px;" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i></button>'+
                              '<button type="button" data-val="'+cnt+'" onclick="RemoveTaskTimeEntries(this);" style="background: #294351;margin-top: 40px;" class="btn btn-sm btn-primary"><i class="fas fa-trash"></i></button>'+
                        '</div>'+    
                  '</div>'+
            '</div>'+
      '';
      $("#task_duration_container").append(html_content);
      $("#total_task_duration").val(cnt);
}
function RemoveTaskTimeEntries(e) 
{
      var cnt=$(e).data('val');     
      $("#task_duration_wrapper"+cnt).remove(); 
}